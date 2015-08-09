<?php

class Designer_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function gets()
    {
        $this->db->select('_designerid, title, designer.updated, designer.isdeprecated, user.username');
        $this->db->from('designer');
        $this->db->join('user', 'user._id = designer.for_userid');
        return $this->db->get()->result();
    }

    function add($data)
    {
        $input_data = array(
            'title' => $data['title'],
            'summary' => $data['summary'],
            'main_img_uri' => $data['main_img_uri'],
            'content' => $data['content'],
            'created' => date("Y-m-d"),
            'updated' => date("Y-m-d"),
            'for_userid' => $this->session->userdata('user_id'),
            'isdeprecated' => FALSE,
        );

        $this->db->insert('designer', $input_data);
        $result = $this->db->insert_id();

        return $result;
    }

    function update($data)
    {
        try {
            $designer_id = $data['designerid'];
            $data = array(
                'title' => $data['title'],
                'summary' => $data['summary'],
                'content' => $data['content'],
                'updated' => date("Y-m-d"),
                'for_userid' => $this->session->userdata('user_id'),
            );

            var_dump($data);

            $this->db->where('_designerid', $designer_id);
            $this->db->update('designer', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function get_by_id($designer_id)
    {
        $this->db->select('_designerid, title, summary, content, designer.updated, designer.isdeprecated, user.username');
        $this->db->where(array('_designerid' => $designer_id));
        $this->db->join('user', 'user._id = designer.for_userid');
        $rtv = $this->db->get('designer');
        $designers = array_shift($rtv->result());

        return $designers;
    }

    function change_isdeprecated($designer_id, $isdeprecated)
    {
        try {
            $data = array(
                'isdeprecated' => $isdeprecated
            );

            $this->db->where('_designerid', $designer_id);
            $this->db->update('designer', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}