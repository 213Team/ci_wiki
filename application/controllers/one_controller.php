<?php
class One_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Entry_model');
		$this->load->model('Comment_model');
		$this->load->helper('smiley');
		$this->load->library('table');
		date_default_timezone_set("PRC");
	}
	
    function index($id)
    {
		$data['title'] = 'Writing in Group';
		$data['login_user'] = $this->session->userdata('username');
		$this->load->view('header', $data);
		
		$image_array = get_clickable_smileys('http://localhost/ci_wiki/smileys/', 'body');
		$col_array = $this->table->make_columns($image_array, 14);
		$data['smiley_table'] = $this->table->generate($col_array);
        
		$data['query'] = $this->Entry_model->get_entry($id);
		$data['c_query'] = $this->Comment_model->get_comment($id);
		
		$row = $this->Entry_model->get_author($id);
		if ($row) 
			$data['author'] = $row->uname;
		else
			$data['author'] = null;
		
        $this->load->view('oneview', $data);
        $this->load->view('footer');
    }
}
?>
