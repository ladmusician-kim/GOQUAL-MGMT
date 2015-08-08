<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Designer extends MGMT_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->__require_login();
        $this->load->model('designer_model');
    }

    function index()
    {
        $designers = $this->designer_model->gets();
        $this->__get_views('_Designer/index.php', array('designers' => $designers));
    }

    function create()
    {
        $this->__get_views('_Designer/create.php', array('data' => null));
    }

    function detail()
    {
        $designer_id = $this->input->get('designerid');
        $designer = $this->designer_model->get_by_id($designer_id);

        if ($designer != null) {
            $this->__get_views('_Designer/detail.php', array('item' => $designer));

        } else {
            $this->session->set_flashdata('message', '게시글이 없습니다.');
            redirect('designer/index');
        }
    }

    function update()
    {
        $designer_id = $this->input->get('designerid');
        $designer = $this->designer_model->get_by_id($designer_id);
        $this->__get_views('_Designer/update.php', array('item' => $designer));
    }


    function submit()
    {
        $input_data = array(
            'title' => $this->input->post('title'),
            'summary' => $this->input->post('summary'),
            'content' => $this->input->post('content'),
        );
        $rtv = $this->designer_model->add($input_data);

        if ($rtv != null && $rtv > 0) {
            $this->session->set_flashdata('message', '글작성에 성공적으로 저장하였습니다.');
            redirect('designer/index');
        } else {
            $this->session->set_flashdata('message', '글작성하는데 오류가 발생했습니다. 개발자에게 문의하세요');
            $this->__get_views('_Designer/create.php', array('data' => $input_data));
        }
    }

    function update_submit()
    {
        $input_data = array(
            'designerid' => $this->input->post('designerid'),
            'title' => $this->input->post('title'),
            'summary' => $this->input->post('summary'),
            'content' => $this->input->post('content'),
        );

        $rtv = $this->designer_model->update($input_data);

        if ($rtv != null && $rtv > 0) {
            $this->session->set_flashdata('message', '글 수정에 성공적으로 저장하였습니다.');
            redirect('designer/index');
        } else {
            $this->session->set_flashdata('message', '글 수정하는데 오류가 발생했습니다. 개발자에게 문의하세요');
            $this->__get_views('_Designer/create.php', array('data' => $input_data));
        }
    }

    /*
    *  designerid
    *  isdeprecated :: 삭제시는 true로, 부활시는 false로
    */
    function change_isdeprecated()
    {
        $designer_id = $this->input->get('designerid');
        $isdeprecated = $this->input->get('isdeprecated') == 'true' ? true : false;

        $rtv = $this->designer_model->change_isdeprecated($designer_id, $isdeprecated);
        if ($rtv) {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '게시글을 성공적으로 삭제하였습니다.');
            } else {
                $this->session->set_flashdata('message', '게시글을 성공적으로 부활하였습니다.');
            }

            redirect('designer/index');
        } else {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '게시글을 삭제하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            } else {
                $this->session->set_flashdata('message', '게시글을 부활하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            }

            redirect('designer/detail?designerid=' . $designer_id);
        }
    }
}
