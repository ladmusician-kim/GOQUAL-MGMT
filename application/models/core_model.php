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

    function get_all_count () {
        return $this->db->count_all_results('project');
    }
    function get_by_id($project_id){
        return $this->db->get_where('project', array('_projectid'=>$project_id))->row();
    }
    function get_items($sorting, $filter, $page = 1, $per_page = 10) {
        $base_dto = new BASE_DTO;

        if ($page === 1) {
            $this->db->limit($per_page);

        } else {
            $this->db->limit($per_page, ($page - 1) * $per_page);
        }

        $this->db->select('*');
        $this->db->from('project');
        $this->db->join('user', 'user._id = project.admin_userid');

        $result = $this->db->get()->result();

        $base_dto->set_value($result);
        return $base_dto;
    }
}   