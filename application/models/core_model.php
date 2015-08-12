<?php

class Core_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function gets()
    {
        $this->db->select('_coreid, title, core.updated, core.isdeprecated, user.username, core_category.label');
        $this->db->from('core');
        $this->db->join('user', 'user._id = core.for_userid');
        $this->db->join('core_category', 'core_category._categoryid = core.for_categoryid');
        $this->db->order_by('_coreid', 'desc');
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
            'for_categoryid' => $data['for_categoryid']
        );

        $this->db->insert('core', $input_data);
        $result = $this->db->insert_id();

        return $result;
    }

    function update($data)
    {
        try {
            $core_id = $data['coreid'];
            $data = array(
                'title' => $data['title'],
                'summary' => $data['summary'],
                'content' => $data['content'],
                'updated' => date("Y-m-d"),
                'for_userid' => $this->session->userdata('user_id'),
                'for_categoryid' => $data['for_categoryid']
            );

            var_dump($data);

            $this->db->where('_coreid', $core_id);
            $this->db->update('core', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function get_by_id($core_id)
    {
        $this->db->select('_coreid, title, core.summary, content, core.updated, core.isdeprecated, core.for_categoryid, core_category.label, user.username');
        $this->db->where(array('_coreid' => $core_id));
        $this->db->join('user', 'user._id = core.for_userid');
        $this->db->join('core_category', 'core_category._categoryid = core.for_categoryid');
        $rtv = $this->db->get('core');
        $cores = array_shift($rtv->result());

        return $cores;
    }

    function change_isdeprecated($core_id, $isdeprecated)
    {
        try {
            $data = array(
                'isdeprecated' => $isdeprecated
            );

            $this->db->where('_coreid', $core_id);
            $this->db->update('core', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}