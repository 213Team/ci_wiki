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
        $this->load->model('Entry_model');
        
		$data['array'] = $this->Entry_model->get_entry(0);
		$data['flag'] = 0;
		$data['id'] = 0;
        $this->load->view('index', $data);
        $this->load->view('footer');
    }
    function catalogus($id)
    {
    	$data['title'] = 'Writing in Group';
		$data['login_user'] = $this->session->userdata('username');
		$this->load->view('header', $data);
        $this->load->model('Entry_model');
        
		$data['array'] = $this->Entry_model->get_entry(0);
		$data['flag'] = 1;
		$data['id'] = $id;
        $this->load->view('entryview', $data);
        $this->load->view('footer');
    }
}
?>
