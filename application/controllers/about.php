<?php
class About extends CI_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set("PRC");
	}
	
	function index(){
		$data['title'] = '关于 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		
		
		
		$this->load->view('header', $data);
		$this->load->view('about');
        $this->load->view('footer');
	}
}
