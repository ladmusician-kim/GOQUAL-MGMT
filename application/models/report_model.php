<?php

class Report_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function gets()
    {
        $this->db->select('*');
        $this->db->from('report');
        $this->db->order_by('_reportid', 'desc');
        return $this->db->get()->result();
    }

    function add($data)
    {
        $input_data = array(
            'institution' => $data['institution'],
            'published' => $data['published'],
            'title' => $data['title'],
            'summary' => $data['summary'],
            'url' => $data['url'],
            'created' => date("Y-m-d"),
            'updated' => date("Y-m-d"),
            'for_userid' => $this->session->userdata('user_id'),
            'isdeprecated' => FALSE,
        );

        $this->db->insert('report', $input_data);
        $result = $this->db->insert_id();

        return $result;
    }

    function update($data)
    {
        try {
            $report_id = $data['reportid'];
            $data = array(
                'institution' => $data['institution'],
                'published' => $data['published'],
                'title' => $data['title'],
                'summary' => $data['summary'],
                'url' => $data['url'],
                'updated' => date("Y-m-d"),
                'for_userid' => $this->session->userdata('user_id'),
                'isdeprecated' => FALSE,
            );

            $this->db->where('_reportid', $report_id);
            $this->db->update('report', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function get_by_id($report_id)
    {
        $this->db->select('*');
        $this->db->where(array('_reportid' => $report_id));
        $this->db->join('user', 'user._id = report.for_userid');
        $rtv = $this->db->get('report');
        $reports = array_shift($rtv->result());

        return $reports;
    }

    function change_isdeprecated($report_id, $isdeprecated)
    {
        try {
            $data = array(
                'isdeprecated' => $isdeprecated
            );

            $this->db->where('_reportid', $report_id);
            $this->db->update('report', $data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}