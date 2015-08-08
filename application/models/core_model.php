<?php
class Core_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function gets() {
        $this->db->select('_coreid, title, core.updated, user.username');
        $this->db->from('core');
        $this->db->where('core.isdeprecated = false');
        $this->db->join('user', 'user._id = core.for_userid');
        return $this->db->get()->result();
    }

    function add($data) {
        $input_data = array(
            'title'     =>  $data['title'],
            'summary'     =>  $data['summary'],
            'content'    =>  $data['content'],
            'created'    =>  date("Y-m-d"),
            'updated'    =>  date("Y-m-d"),
            'for_userid' => $this->session->userdata('user_id'),
            'isdeprecated' => FALSE,
        );

        $this->db->insert('core', $input_data);
        $result = $this->db->insert_id();

        return $result;
    }

    function get_by_id($core_id){
        $this->db->select('_coreid, title, summary, content, core.updated, user.username');
        $this->db->where(array ('_coreid'=> $core_id, 'core.isdeprecated' => false));
        $this->db->join('user', 'user._id = core.for_userid');
        $rtv = $this->db->get('core');
        $cores = array_shift($rtv->result());

        return $cores;
        //echo($data['age']);
        //return $this->db->get_where('core', array('_coreid'=>$core_id, 'isdeprecated' => false))->row();
    }
}