<?php
class Index extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}	
    function index()
    {
		$data['title'] = 'Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		$this->load->view('header', $data);
        $this->load->view('index');
        $this->load->view('footer');
    }
}
?>
