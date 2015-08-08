<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require APPPATH . '/libraries/Common_Controller.php';

class Auth extends MGMT_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    function index()
    {
        redirect('/auth/login');
    }

    /* 로그인 */
    function login()
    {
        $this->__is_logined();

        $this->form_validation->set_rules('login_email', '이메일', 'required|valid_email');
        $this->form_validation->set_rules('login_password', '비밀번호', 'required');

        $isValidate = $this->form_validation->run();

        if ($isValidate) {
            $input_data = array('email' => $this->input->post('login_email'));

            $user = $this->user_model->get_user_by_email($input_data);

            // db 정보와 확인
            if ($user != null && $user->email == $input_data['email'] &&
                password_verify($this->input->post('login_password'), $user->password)
            ) {
                $this->handle_login($user);
            } else {
                $this->session->set_flashdata('message', '로그인에 실패하였습니다.');
                redirect('auth/login');
            }
        } else {
            if ($this->input->get('returnURL') === "") {
                $this->__get_views('_Auth/login');
            }
            $this->__get_views('_Auth/login', array('returnURL' => $this->input->get('returnURL')));
        }
    }

    /* 로그아웃 */
    function logout()
    {
        $this->session->sess_destroy();
        redirect('/auth/login');
    }


    function handle_login($user)
    {
        $username = explode('@', $user->email)[0];
        $this->user_model->logined($user);

        $this->session->set_flashdata('message', '로그인에 성공하였습니다.');
        $this->session->set_userdata('user_id', $user->_id);
        $this->session->set_userdata('username', $username);
        $this->session->set_userdata('is_login', TRUE);

        $returnURL = $this->input->get('returnURL');

        if ($returnURL === false || $returnURL === "") {
            redirect('/home/index');
        }

        redirect($returnURL);
    }
}
