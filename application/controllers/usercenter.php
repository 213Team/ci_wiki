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
		
		$this->load->view('header', $data);
        $this->load->view('usercenter/dashboard');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
	}
	
	function mybooks($tipid = 0){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	$data['title'] = '用户首页 - Writing in Group';
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
    	if($this->book_model->addBook(array('uid' => $this->session->userdata('user')['uid'], 'title' => $_POST['title']))){
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
    	//if($this->book_model->getBooks(array('uid'=>$this->session->userdata['user']['uid'], 'id'=>$bookid)) == false)
    		//redirect('usercenter/mybooks');
    	$this->load->model('catalog_model');
    	$this->load->model('body_model');
    	$this->load->model('book_model');
    	
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
	
	function doupdatebody($cataid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	$this->load->model('body_model');
    	
    	if(!$this->body_model->_checkAuthor($this->session->userdata['user']['uid'], $cataid))
    		redirect('usercenter/mybooks');
    		
    	$this->load->model('catalog_model');
    	$cata = $this->catalog_model->getCatalog(array('id'=>$cataid))[0];
    	if($this->body_model->updateBody(array('uid'=>$this->session->userdata['user']['uid'], 'cid'=>$cataid, 'body'=>$this->input->post('body', true)))){
    		$this->load->model('book_model');
    		$this->book_model->updateBook(array('id'=>$cata->bookid, 'uid'=>$this->session->userdata['user']['uid']));
    		redirect("usercenter/catalog/{$cata->bookid}");
    	}else{
    		redirect("usercenter/catalog/{$cata->bookid}/3");
    	}
	}

	function login($tipid = 0){
		if($this->session->userdata('user') != false)
    		redirect('usercenter/index');
		$data['title'] = '登陆 - Writing in Group';
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
		
		$tips = array('', '两次密码输入不一致。', '用户名或邮箱已注册。', '验证码错误。');
		$data['tips'] = $tips[$tipid];
		
		$this->load->view('header', $data);
        
        $this->load->view('usercenter/register_view', $data);
		
        $this->load->view('footer');
	}
	
	function doregister(){
		$this->load->model('user_model');
		if(strtolower($_POST['captcha']) != strtolower($this->session->userdata('captcha')))
			redirect('usercenter/register/3');
		if($_POST['password'] != $_POST['password2'])
			redirect('usercenter/register/1');
		if($this->user_model->addUser($_POST) == false){
			redirect('usercenter/register/2');
		}
		$this->load->view('congratulation');
	}
}

