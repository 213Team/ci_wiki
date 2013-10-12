<?php
class UserCenter extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("PRC");
	}	

    function index()
    {
    	if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
		else
			redirect('usercenter/dashboard');
    }

	function dashboard(){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	$data['title'] = '用户首页 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		$this->load->model('user_model');
		$this->load->model('book_model');
		$this->load->model('contrib_model');
		$data['user'] = $this->user_model->getUsers(array('id'=>$data['login_user']['uid']))[0];
		$data['mybooks'] = $this->book_model->getBooks(array('uid'=>$data['login_user']['uid']));
		$data['mycontrib'] = $this->contrib_model->getContrib(array('uid'=>$data['login_user']['uid']));
		
		$this->load->view('header', $data);
        $this->load->view('usercenter/dashboard');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
	}
	
	function mybooks($tipid = 0){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	$data['title'] = '我创作的书籍 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		
		$this->load->model('book_model');
		$data['mybooks'] = $this->book_model->getBooks(array('uid' => $data['login_user']['uid']));
		//var_dump($data['mybooks']);
		$tips = array('', '添加书籍失败', '修改书名失败', '删除书籍失败');
		$data['tips'] = $tips[$tipid];
		
		$this->load->view('header', $data);
		$this->load->view('usercenter/mybooks');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
	}
	
	function doaddbook(){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	if(!isset($_POST['title']) || $_POST['title'] == "") 
    		redirect('usercenter/mybooks/1');
    	$this->load->model('book_model');
    	if($this->book_model->addBook(array(
    		'uid' => $this->session->userdata('user')['uid'], 				'title' => $this->input->post('title', true)))){
    		redirect('usercenter/mybooks');
    	}else{
    		redirect('usercenter/mybooks/1');
    	}
	}
	
	function domodbook($bookid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	if($bookid == "" || !isset($_POST['newtitle']) || $_POST['newtitle'] == "")
			redirect('usercenter/mybooks');
		$this->load->model('book_model');
		if($this->book_model->updateBook(array('id'=>$bookid,'uid' => $this->session->userdata('user')['uid'], 'title' => $_POST['newtitle']))){
    		redirect('usercenter/mybooks');
    	}else{
    		redirect('usercenter/mybooks/2');
    	}
		
	}
	
	function dodelbook($bookid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	$this->load->model('book_model');
		if($this->book_model->deleteBook(array('id'=>$bookid,'uid' => $this->session->userdata('user')['uid']))){
    		redirect('usercenter/mybooks');
    	}else{
    		redirect('usercenter/mybooks/3');
    	}
	}
	
	function catalog($bookid, $tipid = 0){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');

		$data['title'] = '书籍目录 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		
		$this->load->model('book_model');
		if($bookid == "" || !$this->book_model->getBooks(array('id' => $bookid, 'uid'=>$this->session->userdata('user')['uid'])))
			redirect('usercenter/mybooks');
		

		$this->load->model('catalog_model');

		$data['book'] = $this->book_model->getBooks(array('id' => $bookid))[0];
		$tmp = $this->catalog_model->getCatalog(array("bookid"=>$bookid));
		//echo $this->db->last_query();
		$tips = array('', '添加目录失败');
		$data['tips'] = $tips[$tipid];
		
		$data['catalog'] = array();
		if($tmp){
		foreach($tmp as $row){
			if(!isset($data['catalog'][$row->fid])){
				$data['catalog'][$row->fid] = array();
			}
			array_push($data['catalog'][$row->fid], $row);

		}
		}
		//var_dump($data['catalog']);
		$this->load->view('header', $data);
		$this->load->view('usercenter/catalog');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
	}
	
	function doaddcatalog($bookid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
		$this->load->model('catalog_model');
		if($this->catalog_model->addCatalog(array('bookid'=>$bookid, 'uid'=>$this->session->userdata['user']['uid'], 'title'=>$_POST['title'])))
			redirect("usercenter/catalog/{$bookid}");
		else
			redirect("usercenter/catalog/{$bookid}/1");
	}
	
	function edit($bookid, $cataid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
   
    	$data['title'] = '编辑文章 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');	
    	
    	$this->load->model('book_model');
    	$this->load->model('catalog_model');
    	$this->load->model('body_model');
    	
    	if(!$this->body_model->_checkAuthor($this->session->userdata['user']['uid'], $cataid))
    		redirect('usercenter/mybooks');
    	
    	$data['cata'] = $this->catalog_model->getCatalog(array('id'=>$cataid))[0];
    	$data['body'] = $this->body_model->getBody(array('cid'=>$cataid))[0];
    	$data['book'] = $this->book_model->getBooks(array('id'=>$bookid))[0];
    	
    	$this->load->view('header', $data);
        $this->load->view('usercenter/edit');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
    	
	}
	
	function doupdatebody($cataid, $checkpoint = ""){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	$this->load->model('body_model');
    	
    	if(!$this->body_model->_checkAuthor($this->session->userdata['user']['uid'], $cataid))
    		redirect('usercenter/mybooks');

    	$this->load->model('catalog_model');
    	$cata = $this->catalog_model->getCatalog(array('id'=>$cataid))[0];
    	if($this->body_model->updateBody(array('uid'=>$this->session->userdata['user']['uid'], 'cid'=>$cataid, 'body'=>$this->input->post('body', true)))){
    		$this->load->model('book_model');
    		$this->load->model('checkpoint_model');
    		$this->book_model->updateBook(array('id'=>$cata->bookid, 'uid'=>$this->session->userdata['user']['uid']));
    		if($checkpoint == "checkpoint")
	    		$this->checkpoint_model->addCheckpoint(array("cid"=>$cataid, "bid"=>$cata->bookid, "body"=>$this->input->post('body', true)));
    		
    		redirect("usercenter/catalog/{$cata->bookid}");
    	}else{
    		redirect("usercenter/catalog/{$cata->bookid}/3");
    	}
	}

	function pullrequest(){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	
    	$data['title'] = '修改申请 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');	
    	
    	$this->load->model('pullrequest_model');
    	$data['pullrequest'] = $this->pullrequest_model->getPullrequests(array('uid'=>$data['login_user']['uid']));
    	
    	$this->load->view('header', $data);
        $this->load->view('usercenter/pullrequest');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
	}

	function viewdiff($pid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    		
    	if(!isset($pid))
    		redirect('usercenter/pullrequest');
    		
    	
    	$data['title'] = '修改申请 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');	
    	
    	$this->load->model('pullrequest_model');
    	$data['pullrequest'] = $this->pullrequest_model->getPullrequests(array('id'=>$pid, 'uid'=>$data['login_user']['uid']))[0];
    	
    	if(!$data['pullrequest'])
    		redirect('usercenter/pullrequest');
    		
    	$this->load->model('body_model');
    	$data['body'] = $this->body_model->getBody(array('cid'=>$data['pullrequest']->cid))[0];
    	
    	$this->load->view('header', $data);
        $this->load->view('usercenter/viewdiff');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
	}

	function doacpr($pid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    		
    	if(!isset($pid))
    		redirect('usercenter/pullrequest');	
    		
    	$this->load->model('pullrequest_model');
    	$pr = $this->pullrequest_model->getPullrequests(array('id'=>$pid, 'uid'=>$this->session->userdata('user')['uid']));
    	if(!$pr)
    		redirect('usercenter/pullrequest');
    		
    	$this->load->model('body_model');
    	
    	$this->body_model->updateBody(array('body'=>$pr[0]->newbody, 'cid'=>$pr[0]->cid, 'uid'=>$pr[0]->uid));
    	
    	$this->load->model('contrib_model');

    	$this->contrib_model->addContrib(array('uid'=>$pr[0]->puid, 'cid'=>$pr[0]->cid, 'bid'=>$pr[0]->bid));
    	
    	$this->pullrequest_model->deletePullrequest(array('id'=>$pid));
    	redirect('usercenter/pullrequest');
	}
	
	function dodcpr($pid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    		
    	if(!isset($pid))
    		redirect('usercenter/pullrequest');	
    		
    	$this->load->model('pullrequest_model');
    	$pr = $this->pullrequest_model->getPullrequests(array('id'=>$pid, 'uid'=>$this->session->userdata('user')['uid']));
    	
    	if(!$pr)
    		redirect('usercenter/pullrequest');
    	
    	$this->pullrequest_model->deletePullrequest(array('id'=>$pid));
    	redirect('usercenter/pullrequest');
	}

	function mycontrib(){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	
    	$data['title'] = '我贡献的书籍 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');	
    	
    	$this->load->model('contrib_model');
    	$data['mycontrib'] = $this->contrib_model->getContrib(array('uid'=>$data['login_user']['uid']));
    	
    	$this->load->view('header', $data);
        $this->load->view('usercenter/mycontrib');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
	}
	
	function account($tipid = 0){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	
    	$data['title'] = '修改用户信息 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		$this->load->model('user_model');
		$data['userinfo'] = $this->user_model->getUsers(array('id'=>$data['login_user']['uid']))[0];
		$tips = array('', '两次密码输入不一致。', '用户名或邮箱已注册。', '验证码错误。', '用户名或密码为空');
		$data['tips'] = $tips[$tipid];
		
		
		$this->load->view('header', $data);
        $this->load->view('usercenter/account');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
	}
	
	function domodaccount(){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	
    	if(strtolower($_POST['captcha']) != strtolower($this->session->userdata('captcha')))
			redirect('usercenter/account/3');
		if($_POST['password'] == "")
			redirect('usercenter/account/4');
		if($_POST['password'] != $_POST['password2'])
			redirect('usercenter/account/1');
   		
    	$this->load->model('user_model');
    	$this->user_model->updateUser(array('id'=>$this->session->userdata('user')['uid'], 'profile'=>$_POST['profile'], 'password'=>$_POST['password']));
    	
    	redirect('usercenter');
	}

	function checkpoints($cid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	if(!isset($cid))
    		redirect('usercenter/mybooks');
    		
    	$data['title'] = '查看历史还原点 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		$this->load->model('checkpoint_model');
		$this->load->model('catalog_model');
		$data['cata'] = $this->catalog_model->getCatalog(array('id'=>$cid, 'uid'=>$this->session->userdata('user')['uid']));
		if(!$data['cata'])
			redirect('usercenter/mybooks');
		else
			$data['cata'] = $data['cata'][0];
		$data['cp'] = $this->checkpoint_model->getCheckpoints(array('cid'=>$cid));
		
		$this->load->view('header', $data);
        $this->load->view('usercenter/checkpoints');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
	}
	
	function viewcp($cpid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	if(!isset($cpid))
    		redirect('usercenter/mybooks');
    	$data['title'] = '查看历史还原点 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		
    	$this->load->model('checkpoint_model');
    	$this->load->model('catalog_model');
		$data['cp'] = $this->checkpoint_model->getCheckpoints(array('id'=>$cpid));
		$data['cata'] = $this->catalog_model->getCatalog(array('id'=>$data['cp'][0]->cid));
		
		if(!$data['cp'] || !$this->catalog_model->_checkAuthor($this->session->userdata('user')['uid'], $data['cata'][0]->bookid))
			redirect("usercenter/mybooks");
		$data['cp'] = $data['cp'][0];
		$data['cata'] = $data['cata'][0];
		
		$this->load->view('header', $data);
        $this->load->view('usercenter/viewcp');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
	}
	
	function dofallback($cpid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	if(!isset($cpid))
    		redirect('usercenter/mybooks');
		
    	$this->load->model('checkpoint_model');
    	$this->load->model('catalog_model');
		$cp = $this->checkpoint_model->getCheckpoints(array('id'=>$cpid));
		$cata = $this->catalog_model->getCatalog(array('id'=>$cp[0]->cid));
		
		if(!$cp || !$this->catalog_model->_checkAuthor($this->session->userdata('user')['uid'], $cata[0]->bookid))
			redirect("usercenter/mybooks");
			
		$this->load->model('body_model');
		$this->body_model->updateBody(array('cid'=>$cp[0]->cid, 'uid'=>$this->session->userdata('user')['uid'], 'body'=>$cp[0]->body));
		
		redirect("usercenter/catalog/{$cata[0]->bookid}");
	}
	
	function dodelcp($cpid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	if(!isset($cpid))
    		redirect('usercenter/mybooks');
		$this->load->model('checkpoint_model');
    	$this->load->model('catalog_model');
		$cp = $this->checkpoint_model->getCheckpoints(array('id'=>$cpid));
		$cata = $this->catalog_model->getCatalog(array('id'=>$cp[0]->cid));
		
		if(!$cp || !$this->catalog_model->_checkAuthor($this->session->userdata('user')['uid'], $cata[0]->bookid))
			redirect("usercenter/mybooks");
			
		$this->checkpoint_model->deleteCheckpoint(array('id'=>$cpid));
		redirect("usercenter/checkpoints/{$cp[0]->cid}");
	}

	function login($tipid = 0){
		if($this->session->userdata('user') != false)
    		redirect('usercenter/index');
		$data['title'] = '登录 - Writing in Group';
		$this->load->view('header', $data);
		
        $tips = array('', "用户名密码错误，请重试。", "验证码错误。");
        $data['tips'] = $tips[$tipid];
        $this->load->view('usercenter/login_view', $data);
        $this->load->view('footer');
	}

    function dologin()
    {
		$this->load->model('user_model');
		if(strtolower($_POST['captcha']) != strtolower($this->session->userdata('captcha')))
			redirect('usercenter/login/2');
		
		$row = $this->user_model->getUsers($_POST);
		if ($row)
		{
			$this->session->set_userdata('user', array("username"=>$row[0]->username, "uid"=>$row[0]->id));
			redirect('usercenter/index');
		}
		else
		{
			$this->session->unset_userdata('user');
			redirect('usercenter/login/1');
		}
	}
	
	function dologout(){
		$this->session->unset_userdata('user');
		redirect('');
	}
	
	function register($tipid = 0){
		$data['title'] = '注册 - Writing in Group';
		if($this->session->userdata('user') != false)
			$data['login_user'] = $this->session->userdata('user');
		
		$tips = array('', '两次密码输入不一致。', '用户名或邮箱已注册。', '验证码错误。', '用户名或密码为空');
		$data['tips'] = $tips[$tipid];
		
		$this->load->view('header', $data);
        
        $this->load->view('usercenter/register_view', $data);
		
        $this->load->view('footer');
	}
	
	function doregister(){
		$this->load->model('user_model');
		if(strtolower($_POST['captcha']) != strtolower($this->session->userdata('captcha')))
			redirect('usercenter/register/3');
		if($_POST['username'] == "" || $_POST['password'] == "")
			redirect('usercenter/register/4');
		if($_POST['password'] != $_POST['password2'])
			redirect('usercenter/register/1');
		if($this->user_model->addUser($_POST) == false){
			redirect('usercenter/register/2');
		}
		$this->load->view('congratulation');
	}
}

