<?php

class Core_category_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function gets()
    {
        $this->db->select('_categoryid, label, isdeprecated');
        $this->db->from('core_category');
        return $this->db->get()->result();
    }

    function gets_non_isdeprecated()
    {
        $this->db->select('_categoryid, label, isdeprecated');
        $this->db->where(array('isdeprecated' => false));
        $this->db->from('core_category');
        return $this->db->get()->result();
    }

    function get_by_id($category_id)
    {
        $this->db->select('_categoryid, label, isdeprecated');
        $this->db->where(array('_categoryid' => $category_id));
        $rtv = $this->db->get('core_category');
        $categories = array_shift($rtv->result());

        return $categories;
    }

    function add($data)
    {
        $input_data = array(
            'label' => $data['label'],
            'isdeprecated' => FALSE,
        );

        $this->db->insert('core_category', $input_data);
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
            $this->db->update('core_category', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}