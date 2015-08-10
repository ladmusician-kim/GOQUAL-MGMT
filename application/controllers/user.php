<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MGMT_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->__require_login();
        $this->load->model('user_model');
    }

    function index()
    {
        $users = $this->user_model->gets();
        $this->__get_views('_USER/index.php', array('users' => $users));
    }

    function detail()
    {
        $user_id = $this->input->get('userid');
        $user = $this->user_model->get_by_id($user_id);

        if ($user != null) {
            $this->__get_views('_USER/detail.php', array('item' => $user));

        } else {
            $this->session->set_flashdata('message', '선택하신 회원이 없습니다.');
            redirect('user/index');
        }
    }

    function create()
    {
        $this->__get_views('_USER/create.php', array('data' => null));
    }

    function submit()
    {
        $input_data = array(
            'email' => $this->input->post('email'),
            'usernmae' => explode('@', $this->input->post('email'))[0],
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
        );

        $rtv = $this->user_model->add($input_data);

        if ($rtv != null && $rtv > 0) {
            $this->session->set_flashdata('message', '회원을 성공적으로 저장하였습니다.');
            redirect('user/index');
        } else {
            $this->session->set_flashdata('message', '회원 추가하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            $this->__get_views('_USER/create.php', array('data' => $input_data));
        }
    }

    /*
    *  userid
    *  isdeprecated :: 삭제시는 true로, 부활시는 false로
    */
    function change_isdeprecated()
    {
        $user_id = $this->input->get('userid');
        $isdeprecated = $this->input->get('isdeprecated') == 'true' ? true : false;

        $rtv = $this->user_model->change_isdeprecated($user_id, $isdeprecated);
        if ($rtv) {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '회원을 성공적으로 삭제하였습니다.');
            } else {
                $this->session->set_flashdata('message', '회원을 성공적으로 부활하였습니다.');
            }

            redirect('user/index');
        } else {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '회원을 삭제하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            } else {
                $this->session->set_flashdata('message', '회원을 부활하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            }

            redirect('user/detail?userid=' . $user_id);
        }
    }


    function category()
    {
        $categories = $this->user_category_model->gets();
        $this->__get_views('_USER/category.php', array('times' => $categories));
    }
}
