<?php

class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /* read */
    function gets()
    {
        return $this->db->query("SELECT * FROM user ORDER BY _id DESC")->result();
    }

    function get_all_user_count()
    {
        return $this->db->count_all_results('user');
    }

    function getbyid($user_id)
    {
        return $this->db->get_where('user', array('_id' => $user_id))->row();
    }

    function get_user_by_email($option)
    {
        return $this->db->get_where('user', array('email' => $option['email']))->row();
    }

    function add($data)
    {
        $input_data = array(
            'username' => explode("@", $data['email'])[0],
            'email' => $data['email'],
            'password' => $data['password'],
            'created' => date("Y-m-d"),
            'isdeprecated' => FALSE,
            'isadmin' => FALSE
        );

        $this->db->insert('user', $input_data);
        $result = $this->db->insert_id();

        return $result;
    }

    function edit($data)
    {
        $update_data = array(
            'email' => $data['email'],
            'password' => $data['password'],
            'updated' => date("Y-m-d"),
            'isdeprecated' => $data['isdeprecated'],
            'isadmin' => $data['isadmin']
        );

        $this->db->update('user', $update_data, array('_id' => $data['id']));
    }

    function logined($user)
    {
        $user->logined = date("Y-m-d H:i:sa");
        $this->db->update('user', $user, array('_id' => $user->_id));
    }


    /* ngTable */
    function get_users($sorting, $filter, $page = 1, $per_page = 10)
    {
        $base_dto = new BASE_DTO;

        if ($page === 1) {
            $this->db->limit($per_page);

        } else {
            $this->db->limit($per_page, ($page - 1) * $per_page);
        }


        $base_dto->set_value($this->db->get('user')->result());
        return $base_dto;
    }

    function get_admin_users()
    {
        return $this->db->query("SELECT * FROM user WHERE isadmin = true  ORDER BY _id DESC")->result();
    }


}

/*
foreach($users as $use) {
    var_dump($user);
}
*/