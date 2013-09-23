<?php
class Books extends CI_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set("PRC");
	}
	
	function index(){
		$data['title'] = '浏览所有书籍 - Writing in Group';
		$data['login_user'] = $this->session->userdata('user');
		
		$this->load->model('Book');
		$data['mybooks'] = $this->Book->getBooks();
		
		
		$this->load->view('header', $data);
		$this->load->view('books');
        $this->load->view('footer');
	}
}
