<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Core extends MGMT_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('core_model');
    }

    function index () {
        $cores = $this->core_model->gets();
        $this->__get_views('_Core/index.php', array ('cores' => $cores));
}

    function create () {
        $this->__get_views('_Core/create.php', array ('data' => null));
    }

    function detail () {
        $core_id = $this->input->get('coreid');
        $core = $this->core_model->get_by_id($core_id);

        if ($core != null) {
            $this->__get_views('_Core/detail.php', array ('item' => $core));

        } else {
            $this->session->set_flashdata('message', '게시글이 없습니다.');
            redirect('core/index');
        }
    }

    function submit() {
        $input_data = array (
            'title' => $this->input->post('title'),
            'summary' => $this->input->post('summary'),
            'content' => $this->input->post('content'),
        );
        $rtv = $this->core_model->add($input_data);

        if ($rtv != null && $rtv > 0) {
            $this->session->set_flashdata('message', '글작성에 성공적으로 저장하였습니다.');
            redirect('core/index');
        } else {
            $this->session->set_flashdata('message', '글작성하는데 오류가 발생했습니다. 개발자에게 문의하세요');
            $this->__get_views('_Core/create.php', array ( 'data' => $input_data ));
        }
    }
}
