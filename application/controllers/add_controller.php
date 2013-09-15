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
<<<<<<< HEAD
		if ($this->session->userdata('username') == '')
			redirect('login_controller');
=======
>>>>>>> 1ce023b859ea4624a1389ffeba52cf2c84e9777a
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
