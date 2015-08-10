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
        $this->load->model('user_category_model');
        $categories = $this->user_category_model->gets();
        $this->__get_views('_USER/create.php', array('categories' => $categories));
    }

    function submit()
    {
        $input_data = array(
            'email' => $this->input->post('email'),
            'username' => explode('@', $this->input->post('email'))[0],
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'category' => $this->input->post('category')
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
        $this->load->model('user_category_model');
        $categories = $this->user_category_model->gets();
        $this->__get_views('_USER/category.php', array('items' => $categories));
    }

    function create_category()
    {
        $this->__get_views('_USER/create_category.php');
    }

    function submit_category()
    {
        $file = $_FILES['default_img'];
        $label = $this->input->post('label');
        $file_error = $file['error'];

        if ($file_error === 0) {
            $upload_dir = '/home/hosting_users/goqualweb/www/static/img/profile/';
            $upload_file = $upload_dir . basename($_FILES['default_img']['name']);

            if (move_uploaded_file($_FILES['default_img']['tmp_name'], $upload_file)) {
                $this->load->model('user_category_model');
                $input_data = array(
                    'label' => $this->input->post('label'),
                    'default_img_uri' => explode('www', $upload_file)[1]
                );

                $rtv = $this->user_category_model->add($input_data);

                if ($rtv != null && $rtv > 0) {
                    $this->session->set_flashdata('message', '분류를 성공적으로 저장하였습니다.');
                    redirect('user/category');
                } else {
                    $this->session->set_flashdata('message', '분류를 추가하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
                    $this->__get_views('_USER/create.php', array('data' => $input_data));
                }
            } else {
                $this->session->set_flashdata('message', '기본 사진을 저장하는데 오류가 발생했습니다.');
                redirect('user/create_category');
            }
        } else if ($file_error === 2) {
            $this->session->set_flashdata('message', '기본 사진이 너무 큼니다.');
            redirect('user/create_category');
        } else if ($file_error === 3) {
            $this->session->set_flashdata('message', '기본 사진 중 일부만 전송되었습니다.');
            redirect('user/create_category');
        } else if ($file_error === 4) {
            $this->session->set_flashdata('message', '기본 사진을 설정해주세요.');
            redirect('user/create_category');
        } else {
            $this->session->set_flashdata('message', '기본 사진을 저장하는데 오류가 발생했습니다.');
            redirect('user/create_category');
        }
    }

    function change_category_isdeprecated()
    {
        $this->load->model('user_category_model');
        $category_id = $this->input->get('categoryid');
        $isdeprecated = $this->input->get('isdeprecated') == 'true' ? true : false;

        $rtv = $this->user_category_model->change_isdeprecated($category_id, $isdeprecated);
        if ($rtv) {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '카테고리를 성공적으로 삭제하였습니다.');
            } else {
                $this->session->set_flashdata('message', '카테고리를 성공적으로 부활하였습니다.');
            }

            redirect('user/category');
        } else {
            if ($isdeprecated) {
                $this->session->set_flashdata('message', '카테고리를 삭제하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            } else {
                $this->session->set_flashdata('message', '카테고리를 부활하는데 오류가 발생했습니다. 개발자에게 문의하세요.');
            }

            redirect('user/category');
        }
    }
}
