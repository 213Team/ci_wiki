<?php
class App_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("PRC");
		$this->load->model('Application_model');
	}
	
    function index($eid)
    {
		$data['title'] = 'Writing in Group';
		$data['login_user'] = $this->session->userdata('username');
		$this->load->view('header', $data);
		
		$data['eid'] = $eid;
		$this->load->view('app_view', $data);
		$this->load->view('footer', $data);
    }
    
    function get()
    {
		$data['title'] = 'Writing in Group';
		$data['login_user'] = $this->session->userdata('username');
		$this->load->view('header', $data);
		
		$data['query'] = $this->Application_model->get_app();
		$this->load->view('apps_view', $data);
	}
	
    function add()
    {
		$this->Application_model->add_app();
	}
	
	function agree($eid, $uname)
	{
		$this->Application_model->agree_app($eid, $uname);
	}
	
	function disagree($eid, $uname)
	{
		$this->Application_model->disagree_app($eid, $uname);
	}
}
?>
