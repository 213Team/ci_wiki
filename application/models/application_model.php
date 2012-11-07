<?php
class Application_model extends CI_Model {

    var $id = '';
    var $eid = '';
    var $uname = '';
    var $details = '';
    var $time = '';

    function __construct()
    {
        parent::__construct();
    }
    
    function get_app()
    {
		$query = $this->db->get('applications');
		return $query->result();
	}
    
    function add_app()
    {
		$this->eid = $_POST['eid'];
        $this->uname = $_POST['uname'];
        $this->details = $_POST['details'];
        $this->time = date("Y-m-d H:i:s",time());
        
        $this->db->insert('applications', $this);
        redirect('/one_controller/index/'.$_POST['eid']);
	}
	
	function agree_app($eid, $uname)
	{
		$this->db->insert('work_for', array('eid' => $eid, 'uname' => $uname));
		$this->db->delete('applications', array('eid' => $eid));
		redirect('/app_controller/get');
	}
	function disagree_app($eid, $uname)
	{
		$this->db->delete('applications', array('eid' => $eid));
		redirect('/app_controller/get');
	}
}
?>
