<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require APPPATH . '/libraries/Common_Controller.php';

class Auth extends MGMT_Controller {
    function __construct () {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    function index() {
        redirect('/auth/login');
    }

    /* 로그인 */
    function login() {
        $this->__is_logined();

        $this->form_validation->set_rules('login_email', '이메일', 'required|valid_email');
        $this->form_validation->set_rules('login_password', '비밀번호', 'required');

        $isValidate = $this->form_validation->run();

        if($isValidate) {
            $input_data = array ('email' => $this->input->post('login_email'));

            $user = $this->user_model->get_user_by_email($input_data);

            // db 정보와 확인
            if ($user != null && $user->email == $input_data['email'] &&
                password_verify($this->input->post('login_password'), $user->password)) {
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

    /* 회원가입 */
    function register() {
        $this->form_validation->set_rules('register-username', '이메일', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('register-password', '비밀번호', 'required|matches[register-password-confirm]');
        $this->form_validation->set_rules('register-password-confirm', '비밀번호 확인', 'required');

        $isRegister = $this->form_validation->run();

        if($isRegister) {
            $input_data = array (
                'email' => $this->input->post('register-username'),
                'password' => password_hash($this->input->post('register-password'), PASSWORD_BCRYPT)
            );

            $rtv = $this->user_model->add($input_data);
            if($rtv > 0) {
                $this->session->set_flashdata('message', '회원가입에 성공하였습니다.');
                redirect('Auth/login');
            } else {
                $this->session->set_flashdata('message', '회원가입에 실패하였습니다.');
                redirect('Auth/register');
            }

        } else {
            $this->__getViews('Auth/register');
        }
    }

    /* 로그아웃 */
    function logout () {
        $this->session->sess_destroy();
        redirect('/Home/index');
    }

    /* 비밀번호 찾기 */
    function forgot_password () {
        $this->form_validation->set_rules('forgot_email', '이메일', 'required|valid_email');

        $isValidate = $this->form_validation->run();

        if($isValidate) {
            $input_data = array ('email' => $this->input->post('forgot_email'));

            $user = $this->user_model->get_user_by_email($input_data);

            if ($user != null &&
                $user->email == $input_data['email']
            ) {
                $option = array (
                    email => $user->email,
                    password => $user->password
                );

                if ($this->send_email($option)) {
                    $this->session->set_flashdata('message', '이메일이 전송되었습니다.');
                    redirect('Auth/login');
                } else {
                    $this->session->set_flashdata('message', '이메일 전송에 실패하였습니다.');
                    redirect('Auth/forgot_password');
                }
            } else {
                $this->session->set_flashdata('message', '이메일을 잘못입력하셨습니다.');
                redirect('Auth/forgot_password');
            }
        } else {
            $this->__getViews('Auth/forgot_password');
        }
    }



    function send_email ($option) {
        try {
            $this->load->library('email');

            $config['mailtype'] = 'html';
            $config['smtp_host'] = 'newgeneration.kr';
            $config['smtp_user'] = 'admin@newgeneration.kr';
            $config['smtp_pass'] = '1726836rja';

            $this->email->initialize($config);
            //$this->email->initialize(array('mailtype'=>'html'));

            $this->email->from('admin@newgeneration.kr', 'NEWGENERATION MASTER');
            $this->email->to($option['email']);
            $this->email->subject('비밀번호를 까먹다니 ㅉㅉ');
            $this->email->message('<p>당신의 비밀번호는 '. $option['password'].'</p> <a target="_blank" href="http://newgeneration.kr/NEWGENERATION/Auth/login">로그인하기</a>');
            $this->email->send();

            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }

    function handle_login ($user) {
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
