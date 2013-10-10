<?php
class Edit_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Entry_model');
		date_default_timezone_set("PRC");
	}
	
    function index($id)
    {
		$data['title'] = 'Writing in Group';
		$data['login_user'] = $this->session->userdata('username');
		$this->load->view('header', $data);
        
		$data['query'] = $this->Entry_model->get_entry($id);
        $this->load->view('editview', $data);
        $this->load->view('footer');
    }
    
    function insert()
    {
		$this->Entry_model->insert_entry();
	}
    
    function update()
    {
		$this->Entry_model->update_entry();
	}
}
?>
