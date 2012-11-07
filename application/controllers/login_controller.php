<?php
class Login_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}
	
    function index()
    {
		$data['title'] = 'Writing in Group';
		$data['login_user'] = $this->session->userdata('username');
		$this->load->view('header', $data);
        
        $data['tips'] = '';
        $this->load->view('login_view', $data);
        $this->load->view('footer');
    }
    
    function login()
    {
		$row = $this->User_model->login_check();
		if ($row)
		{
			$this->session->set_userdata('username', $row->name);
			redirect('');
		}
		else
		{
			$data['title'] = 'Writing in Group';
			$data['login_user'] = $this->session->userdata('username');
			$this->load->view('header', $data);
			
			$data['tips'] = 'Incorrect username or password. Please try again!';
			$this->load->view('login_view', $data);
			$this->load->view('footer');
		}
	}
}
?>
