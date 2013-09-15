<?php
class Add_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Entry_model');
	}
	
    function index($id)
    {
		$data['title'] = 'Writing in Group';
		if ($this->session->userdata('username') == '')
			redirect('login_controller');
		$data['login_user'] = $this->session->userdata('username');
		$this->load->view('header', $data);
		
		$data['add_book'] = 0;
		
		if ($id == 0)
		{
			$data['add_book'] = 1;
		}

		$data['query'] = $this->Entry_model->get_entry($id);
        $this->load->view('addview', $data);
        
        $this->load->view('footer');
    }
}
?>
