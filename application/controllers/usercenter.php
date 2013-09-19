<?php
class UserCenter extends CI_Controller {

	private $tips;
	
	function __construct()
	{
		parent::__construct();
		$this->tips = array('', "Incorrect Username or Password.Please try again!");
	}	

    function index()
    {
    	if($this->session->userdata('user') == false)
    		redirect('usercenter/login');
		$data['title'] = 'Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		$this->load->view('header', $data);

        $this->load->model('Entry_model');
        var_dump($this->session->userdata('user'));
		$data['array'] = $this->Entry_model->get_entry($data['login_user']['uid']);
		$data['flag'] = 0;
		$data['id'] = 0;
        $this->load->view('entryview', $data);
        $this->load->view('footer');
    }

	function login($tipid = 0){
		if($this->session->userdata('user') != false)
    		redirect('usercenter/index');
		$this->load->model('User_model');
		$data['title'] = 'Writing in Group';
		$data['login_user'] = false;
		$this->load->view('header', $data);
        
        $data['tips'] = $this->tips[$tipid];
        $this->load->view('login_view', $data);
        $this->load->view('footer');
	}

    function dologin()
    {
		$this->load->model('User_model');
		$row = $this->User_model->login_check($_POST['username'], $_POST['password']);
		if ($row)
		{
			$this->session->set_userdata('user', array("username"=>$row->name, "uid"=>$row->id));
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
		$data['title'] = 'Writing in Group';
		$data['login_user'] = $this->session->userdata('user')['username'];
		$this->load->view('header', $data);
        
        $this->load->view('register_view');
		
        $this->load->view('footer');
	}
	
	function doregister(){
		$this->User_model->add_user();
		$this->load->view('congratulation');
	}
}

