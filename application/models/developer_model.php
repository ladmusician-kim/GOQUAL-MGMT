<?php

class Developer_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function gets()
    {
        $this->db->select('_developerid, title, developer.updated, developer.isdeprecated, user.username');
        $this->db->from('developer');
        $this->db->join('user', 'user._id = developer.for_userid');
        return $this->db->get()->result();
    }

    function add($data)
    {
        $input_data = array(
            'title' => $data['title'],
            'summary' => $data['summary'],
            'content' => $data['content'],
            'created' => date("Y-m-d"),
            'updated' => date("Y-m-d"),
            'for_userid' => $this->session->userdata('user_id'),
            'isdeprecated' => FALSE,
        );

        $this->db->insert('developer', $input_data);
        $result = $this->db->insert_id();

        return $result;
    }

    function update($data)
    {
        try {
            $developer_id = $data['developerid'];
            $data = array(
                'title' => $data['title'],
                'summary' => $data['summary'],
                'content' => $data['content'],
                'updated' => date("Y-m-d"),
                'for_userid' => $this->session->userdata('user_id'),
            );

            var_dump($data);

            $this->db->where('_developerid', $developer_id);
            $this->db->update('developer', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function get_by_id($developer_id)
    {
        $this->db->select('_developerid, title, summary, content, developer.updated, developer.isdeprecated, user.username');
        $this->db->where(array('_developerid' => $developer_id));
        $this->db->join('user', 'user._id = developer.for_userid');
        $rtv = $this->db->get('developer');
        $developers = array_shift($rtv->result());

        return $developers;
    }

    function change_isdeprecated($developer_id, $isdeprecated)
    {
        try {
            $data = array(
                'isdeprecated' => $isdeprecated
            );

            $this->db->where('_developerid', $developer_id);
            $this->db->update('developer', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}