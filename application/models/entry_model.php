<?php

class Entry_model extends CI_Model {

    var $id = '';
    var $subject = '';
    var $body = '';
    var $time = '';

    function __construct() {
        parent::__construct();
    }

    function get_entry($id) {
        if ($id) {
            $query = $this->db->query('select * from entries, catalogus where id = cid and id =' . $id);
            return $query->result();
        } else {
            $query = $this->db->query('select * from entries, catalogus where id = cid');
            foreach ($query->result() as $item) {
                $array[$item->fid][] = $item;
            }
            return $array;
        }
    }

    function insert_entry() {
        $_POST['deadline'] = date("Y-m-d", strtotime($_POST['deadline']));
        $sql = "INSERT INTO entries(subject, deadline) VALUES ('" . $_POST['subject'] . "','" . $_POST['deadline'] . "');";
        mysql_query($sql);

        $sql = "SELECT * FROM entries ORDER BY id DESC LIMIT 1;";
        $result = mysql_query($sql);
        $row = mysql_fetch_assoc($result);

        $data1 = array(
            'entry_id' => $row['id'] ,
            'version_id' => 1,
            'body' => $_POST['body'],
            'dateposted' => date("Y-m-d H:i:s", time()),
            'donepercent' => 0
        );
        $this->db->insert('version_ctrl', $data1);
        $data2 = array(
            'cid' => $row['id'] ,
            'fid' => $_POST['fid'],
            'deepth' => $_POST['fdeepth'] + 1
        );
        $this->db->insert('catalogus', $data2);
        redirect('');
    }

    function update_entry() {
        $sql = "SELECT * FROM version_ctrl WHERE entry_id = ".$_POST['id']." ORDER BY version_id DESC LIMIT 1;";
        $result = mysql_query($sql);
        $row = mysql_fetch_assoc($result);
        
        $data3 = array(
            'entry_id' => $_POST['id'],
            'version_id' => $row['version_id'] + 1,
            'body' => $_POST['body'],
            'dateposted' => date("Y-m-d H:i:s", time()),
            'donepercent' => $_POST['donepercent']
        );
        $this->db->insert('version_ctrl', $data3);

        redirect('/one_controller/index/' . $_POST['id']);
    }

    function get_author($eid) {
        $query = $this->db->get_where('work_for', array('eid' => $eid));
        return $query->row();
    }
}

?>
