<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Core extends MGMT_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->__require_login();
        $this->load->model('core_model');
    }

    function index()
    {
        $cores = $this->core_model->gets();
        $this->__get_views('_Core/index.php', array('cores' => $cores));
    }

    function create()
    {
        $this->__get_views('_Core/create.php', array('data' => null));
    }

    function detail()
    {
        $core_id = $this->input->get('coreid');
        $core = $this->core_model->get_by_id($core_id);

        if ($core != null) {
            $this->__get_views('_Core/detail.php', array('item' => $core));

        } else {
            $this->session->set_flashdata('message', '게시글이 없습니다.');
            redirect('core/index');
        }
    }

    function update()
    {
        $core_id = $this->input->get('coreid');
        $core = $this->core_model->get_by_id($core_id);
        $this->__get_views('_Core/update.php', array('item' => $core));
    }


    function submit()
    {
        $input_data = array(
            'title' => $this->input->post('title'),
            'summary' => $this->input->post('summary'),
            'content' => $this->input->post('content'),
            'main_img_uri' => $this->handle_main_img($this->input->post('content'))
        );
        $rtv = $this->core_model->add($input_data);

        if ($rtv != null && $rtv > 0) {
            $this->session->set_flashdata('message', '글작성에 성공적으로 저장하였습니다.');
            redirect('core/index');
        } else {
            $this->session->set_flashdata('message', '글작성하는데 오류가 발생했습니다. 개발자에게 문의하세요');
            $this->__get_views('_Core/create.php', array('data' => $input_data));
        }
    }

    function update_submit()
    {
        $input_data = array(
            'coreid' => $this->input->post('coreid'),
            'title' => $this->input->post('title'),
            'summary' => $this->input->post('summary'),
            'content' => $this->input->post('content'),
        );

        $rtv = $this->core_model->update($input_data);

        if ($rtv != null && $rtv > 0) {
            $this->session->set_flashdata('message', '글 수정에 성공적으로 저장하였습니다.');
            redirect('core/index');
        } else {
            $this->session->set_flashdata('message', '글 수정하는데 오류가 발생했습니다. 개발자에게 문의하세요');
            $this->__get_views('_Core/create.php', array('data' => $input_data));
        }
    }

    /*
    *  coreid
    *  isdeprecated :: 삭제시는 true로, 부활시는 false로
    */
    function change_isdeprecated()
    {
        $core_id = $this->input->get('coreid');
        $isdeprecated = $this->input->get('isdeprecated') == 'true' ? true : false;

        $rtv = $this->core_model->change_isdeprecated($core_id, $isdeprecated);
        if ($rtv) {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '게시글을 성공적으로 삭제하였습니다.');
            } else {
                $this->session->set_flashdata('message', '게시글을 성공적으로 부활하였습니다.');
            }

            redirect('core/index');
        } else {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '게시글을 삭제하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            } else {
                $this->session->set_flashdata('message', '게시글을 부활하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            }

            redirect('core/detail?coreid=' . $core_id);
        }
    }






    function category()
    {
        $this->load->model('core_category_model');
        $categories = $this->core_category_model->gets();
        $this->__get_views('_Core/category.php', array('items' => $categories));
    }

    function create_category()
    {
        $this->__get_views('_Core/create_category.php');
    }

    function submit_category()
    {
        $label = $this->input->post('label');

        $this->load->model('core_category_model');
        $input_data = array(
            'label' => $this->input->post('label'),
        );

        $rtv = $this->core_category_model->add($input_data);

        if ($rtv != null && $rtv > 0) {
            $this->session->set_flashdata('message', '분류를 성공적으로 저장하였습니다.');
            redirect('core/category');
        } else {
            $this->session->set_flashdata('message', '분류를 추가하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            $this->__get_views('_Core/create.php', array('data' => $input_data));
        }
    }

    function change_category_isdeprecated()
    {
        $this->load->model('core_category_model');
        $category_id = $this->input->get('categoryid');
        $isdeprecated = $this->input->get('isdeprecated') == 'true' ? true : false;

        $rtv = $this->core_category_model->change_isdeprecated($category_id, $isdeprecated);
        if ($rtv) {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '카테고리를 성공적으로 삭제하였습니다.');
            } else {
                $this->session->set_flashdata('message', '카테고리를 성공적으로 부활하였습니다.');
            }

            redirect('core/category');
        } else {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '카테고리를 삭제하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            } else {
                $this->session->set_flashdata('message', '카테고리를 부활하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            }

            redirect('core/category');
        }
    }
}
