<?php
class Register_controller extends CI_Controller {

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
        
        $this->load->view('register_view');
		
        $this->load->view('footer');
    }
    
    function add()
    {
		$this->User_model->add_user();
		$this->load->view('congratulation');
	}
}
?>
