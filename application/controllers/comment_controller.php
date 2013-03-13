<?php
class Comment_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("PRC");
	}
	
    function index()
    {
        $this->load->model('Comment_model');
		$this->Comment_model->insert_comment();
    }
}
?>
