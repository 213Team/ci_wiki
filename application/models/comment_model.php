<?php
class Comment_model extends CI_Model {

    var $id = '';
    var $eid = '';
    var $uname = '';
    var $body = '';
    var $time = '';

    function __construct()
    {
        parent::__construct();
    }
    
	function get_comment($eid)
    {
		$query = $this->db->get_where('comments', array('eid' => $eid));
		return $query->result();
	}

    function insert_comment()
    {
        $this->eid = $_POST['eid'];
        $this->uname = $_POST['uname'];
        $this->body = $_POST['body'];
        $this->time = date("Y-m-d H:i:s",time());

        $this->db->insert('comments', $this);
        redirect('one_controller/index/'.$_POST['eid']);
    }
}
?>
