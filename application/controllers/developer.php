<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends MGMT_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->__require_login();
        $this->load->model('developer_model');
    }

    function index()
    {
        $developers = $this->developer_model->gets();
        $this->__get_views('_Developer/index.php', array('developers' => $developers));
    }

    function create()
    {
        $this->__get_views('_Developer/create.php', array('data' => null));
    }

    function detail()
    {
        $developer_id = $this->input->get('developerid');
        $developer = $this->developer_model->get_by_id($developer_id);

        if ($developer != null) {
            $this->__get_views('_Developer/detail.php', array('item' => $developer));

        } else {
            $this->session->set_flashdata('message', '게시글이 없습니다.');
            redirect('developer/index');
        }
    }

    function update()
    {
        $developer_id = $this->input->get('developerid');
        $developer = $this->developer_model->get_by_id($developer_id);
        $this->__get_views('_Developer/update.php', array('item' => $developer));
    }


    function submit()
    {
        $input_data = array(
            'title' => $this->input->post('title'),
            'summary' => $this->input->post('summary'),
            'content' => $this->input->post('content'),
        );

        $rtv = $this->developer_model->add($input_data);

        if ($rtv != null && $rtv > 0) {
            $this->session->set_flashdata('message', '글작성에 성공적으로 저장하였습니다.');
            redirect('developer/index');
        } else {
            $this->session->set_flashdata('message', '글작성하는데 오류가 발생했습니다. 개발자에게 문의하세요');
            $this->__get_views('_Developer/create.php', array('data' => $input_data));
        }
    }

    function update_submit()
    {
        $input_data = array(
            'developerid' => $this->input->post('developerid'),
            'title' => $this->input->post('title'),
            'summary' => $this->input->post('summary'),
            'content' => $this->input->post('content'),
        );

        var_dump($this->input->post('content'));

        $rtv = $this->developer_model->update($input_data);

        if ($rtv != null && $rtv > 0) {
            $this->session->set_flashdata('message', '글 수정에 성공적으로 저장하였습니다.');
            redirect('developer/index');
        } else {
            $this->session->set_flashdata('message', '글 수정하는데 오류가 발생했습니다. 개발자에게 문의하세요');
            $this->__get_views('_Developer/create.php', array('data' => $input_data));
        }
    }

    /*
    *  developerid
    *  isdeprecated :: 삭제시는 true로, 부활시는 false로
    */
    function change_isdeprecated()
    {
        $developer_id = $this->input->get('developerid');
        $isdeprecated = $this->input->get('isdeprecated') == 'true' ? true : false;

        $rtv = $this->developer_model->change_isdeprecated($developer_id, $isdeprecated);
        if ($rtv) {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '게시글을 성공적으로 삭제하였습니다.');
            } else {
                $this->session->set_flashdata('message', '게시글을 성공적으로 부활하였습니다.');
            }

            redirect('developer/index');
        } else {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '게시글을 삭제하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            } else {
                $this->session->set_flashdata('message', '게시글을 부활하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            }

            redirect('developer/detail?developerid=' . $developer_id);
        }
    }
}
