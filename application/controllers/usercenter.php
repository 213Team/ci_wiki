<?php
class UserCenter extends CI_Controller {

	private $tips;
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("PRC");
		$this->tips = array('', "用户名密码错误，请重试。", "验证码错误。");
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
		
		$this->load->model('Entry_model');
		$data['array'] = $this->Entry_model->get_entry($data['login_user']['uid']);
        $this->load->view('usercenter/dashboard', $data);
        $this->load->view('usercenter/sidebar', $data);
        $this->load->view('footer');
	}
	
	function mybooks($tipid = 0){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
    	$data['title'] = '用户首页 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		
		$this->load->model('Book');
		$data['mybooks'] = $this->Book->getBooks(array('uid' => $data['login_user']['uid']));
		
		$tips = array('', '添加书籍失败');
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
    	$this->load->model('Book');
    	if($this->Book->addBook(array('uid' => $this->session->userdata('user')['uid'], 'title' => $_POST['title']))){
    		redirect('usercenter/mybooks');
    	}else{
    		redirect('usercenter/mybooks/1');
    	}
	}
	
	function catalog($bookid){
		if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
		if($bookid == "")
			redirect('usercenter/mybooks');
		$data['title'] = '书籍目录 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		
		$this->load->model('Book');
		$data['book_title'] = $this->Book->getBooks(array('id' => $bookid))[0]->title;
		$tmp = $this->Books->getcatalog($data['login_user']['uid'], $bookid);
		$data['catalog'] = array();
		$data['catalog'][-1] = array();
		foreach($tmp as $row){
			if($row->fid == $row->id){
				array_push($data['catalog'][-1], $row);
			}else{
				if(!isset($data['catalog'][$row->fid])){
					$data['catalog'][$row->fid] = array();
				}
				array_push($data['catalog'][$row->fid], $row);
			}
		}
		
		$this->load->view('header', $data);
		$this->load->view('usercenter/catalog');
        $this->load->view('usercenter/sidebar');
        $this->load->view('footer');
	}

	function login($tipid = 0){
		if($this->session->userdata('user') != false)
    		redirect('usercenter/index');
		$this->load->model('User_model');
		$data['title'] = '登陆 - Writing in Group';
		$this->load->view('header', $data);
        
        $data['tips'] = $this->tips[$tipid];
        $this->load->view('usercenter/login_view', $data);
        $this->load->view('footer');
	}

    function dologin()
    {
		$this->load->model('User_model');
		if(strtolower($_POST['captcha']) != strtolower($this->session->userdata('captcha')))
			redirect('usercenter/login/2');
		
		$row = $this->User_model->login_check($_POST['username'], $_POST['password']);
		if ($row)
		{
			$this->session->set_userdata('user', array("username"=>$row->username, "uid"=>$row->id));
			redirect('usercenter/index');
		}
		else
		{
			$this->session->set_userdata('user', '');
			redirect('usercenter/login/1');
		}
	}
	
	function dologout(){
		$this->session->unset_userdata('user');
		redirect('');
	}
	
	function register(){
		$data['title'] = '注册 - Writing in Group';
		if($this->session->userdata('user') != false)
			$data['login_user'] = $this->session->userdata('user')['username'];
		$this->load->view('header', $data);
        
        $this->load->view('usercenter/register_view', $data);
		
        $this->load->view('footer');
	}
	
	function doregister(){
		$this->load->model('User_model');
		$this->User_model->add_user();
		$this->load->view('congratulation');
	}
}

