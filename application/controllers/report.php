<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MGMT_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->__require_login();
        $this->load->model('report_model');
    }

    function index()
    {
        $reports = $this->report_model->gets();
        $this->__get_views('_Report/index.php', array('reports' => $reports));
    }

    function create()
    {
        $this->__get_views('_Report/create.php', array('data' => null));
    }

            function detail()
            {
                $report_id = $this->input->get('reportid');
                $report = $this->report_model->get_by_id($report_id);

                if ($report != null) {
                    $this->__get_views('_Report/detail.php', array('item' => $report));

                } else {
                    $this->session->set_flashdata('message', '보도자료가 없습니다.');
                    redirect('report/index');
                }
            }

    function update()
    {
        $report_id = $this->input->get('reportid');
        $report = $this->report_model->get_by_id($report_id);
        $this->__get_views('_Report/update.php', array('item' => $report, 'reportid' => $report_id));
    }


    function submit()
    {
        $input_data = array(
            'institution' => $this->input->post('institution'),
            'published' => $this->input->post('published'),
            'title' => $this->input->post('title'),
            'summary' => $this->input->post('summary'),
            'url' => $this->input->post('url'),
        );

        $rtv = $this->report_model->add($input_data);

        if ($rtv != null && $rtv > 0) {
            $this->session->set_flashdata('message', '보도자료를 성공적으로 저장하였습니다.');
            redirect('report/index');
        } else {
            $this->session->set_flashdata('message', '보도자료를 저장하는데 오류가 발생했습니다. 개발자에게 문의하세요');
            $this->__get_views('_Report/create.php', array('data' => $input_data));
        }
    }

    function update_submit()
    {
        $input_data = array(
            'institution' => $this->input->post('institution'),
            'published' => $this->input->post('published'),
            'title' => $this->input->post('title'),
            'summary' => $this->input->post('summary'),
            'url' => $this->input->post('url'),
            'reportid' => $this->input->post('reportid')
        );

        $rtv = $this->report_model->update($input_data);

        if ($rtv != null && $rtv > 0) {
            $this->session->set_flashdata('message', '보도자료를 성공적으로 수정하였습니다.');
            redirect('report/index');
        } else {
            $this->session->set_flashdata('message', '보도자료를 수정하는데 오류가 발생했습니다. 개발자에게 문의하세요');
            $this->__get_views('_Report/create.php', array('data' => $input_data));
        }
    }

    /*
    *  reportid
    *  isdeprecated :: 삭제시는 true로, 부활시는 false로
    */
    function change_isdeprecated()
    {
        $report_id = $this->input->get('reportid');
        $isdeprecated = $this->input->get('isdeprecated') == 'true' ? true : false;

        $rtv = $this->report_model->change_isdeprecated($report_id, $isdeprecated);
        if ($rtv) {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '게시글을 성공적으로 삭제하였습니다.');
            } else {
                $this->session->set_flashdata('message', '게시글을 성공적으로 부활하였습니다.');
            }

            redirect('report/index');
        } else {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '게시글을 삭제하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            } else {
                $this->session->set_flashdata('message', '게시글을 부활하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            }

            redirect('report/detail?reportid=' . $report_id);
        }
    }
}
