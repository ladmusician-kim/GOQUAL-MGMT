<?php

class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function gets()
    {
        $this->db->select('_id, email, username, created, user.logined, user.isdeprecated, user_category.label');
        $this->db->from('user');
        $this->db->join('user_category', 'user_category._categoryid = user.for_categoryid');
        return $this->db->get()->result();
    }

    function get_user_by_email($option)
    {
        return $this->db->get_where('user', array('email' => $option['email'], 'isdeprecated' => false))->row();
    }

    function logined($user)
    {
        $user->logined = date("Y-m-d H:i:sa");
        $this->db->update('user', $user, array('_id' => $user->_id));
    }

    function get_by_id($user_id)
    {
        $this->db->select('_id, username, email, updated, user.created, user.isdeprecated, isadmin, user_category.label, user_category._categoryid');
        $this->db->where(array('_id' => $user_id));
        $this->db->join('user_category', 'user_category._categoryid = user.for_categoryid');
        $rtv = $this->db->get('user');
        $users = array_shift($rtv->result());

        return $users;
    }

    function change_isdeprecated($user_id, $isdeprecated)
    {
        try {
            $data = array(
                'isdeprecated' => $isdeprecated
            );

            $this->db->where('_id', $user_id);
            $this->db->update('user', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function add($data)
    {
        $input_data = array(
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'created' => date("Y-m-d"),
            'updated' => date("Y-m-d"),
            'isdeprecated' => FALSE,
            'isadmin' => TRUE,
            'for_categoryid' => $data['category']
        );

        $this->db->insert('user', $input_data);
        $result = $this->db->insert_id();

        return $result;
    }
}