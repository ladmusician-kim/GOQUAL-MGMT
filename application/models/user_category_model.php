<?php

class User_category_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function gets()
    {
        $this->db->select('_categoryid, label, isdeprecated');
        $this->db->from('user_category');
        return $this->db->get()->result();
    }

    function get_by_id($category_id)
    {
        $this->db->select('_categoryid, label, isdeprecated, default_img_uri');
        $this->db->where(array('_categoryid' => $category_id));
        $rtv = $this->db->get('user_category');
        $categories = array_shift($rtv->result());

        return $categories;
    }

    function add($data)
    {
        $input_data = array(
            'label' => $data['label'],
            'default_img_uri' => $data['default_img_uri'],
            'isdeprecated' => FALSE,
        );

        $this->db->insert('user_category', $input_data);
        $result = $this->db->insert_id();

        return $result;
    }

    function change_isdeprecated($category_id, $isdeprecated)
    {
        try {
            $data = array(
                'isdeprecated' => $isdeprecated
            );

            $this->db->where('_categoryid', $category_id);
            $this->db->update('user_category', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}