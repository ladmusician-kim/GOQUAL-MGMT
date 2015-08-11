<?php

class MGMT_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->input->is_cli_request())
            $this->load->library('session');

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    }

    function __get_views($viewStr, $data = null)
    {
        if (strpos($viewStr, 'Auth')) {
            $this->load->view('_Layout/auth_header.php');
            $this->load->view($viewStr);
            $this->load->view('_Layout/auth_footer.php');
        } else {
            $this->load->view('_Layout/header.php');

            $this->load->view('_Layout/navbar.php');

            if ($data != null) {
                $this->load->view($viewStr, $data);
            } else {
                $this->load->view($viewStr);
            }

            $this->load->view('_Layout/footer.php');
        }

    }


    function __get_partial_view($viewStr, $data = null)
    {
        if ($data != null) {
            $this->load->view($viewStr, $data);
        } else {
            $this->load->view($viewStr);
        }
    }


    function __require_login($return_url = "")
    {
        // 로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
        if (!$this->session->userdata('is_login')) {
            if ($return_url == "") {
                redirect('/auth/login');
            }
            redirect('/auth/login?returnURL=' . rawurlencode($return_url));
        }
    }

    function __require_admin_login($return_url = "")
    {
        // 로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
        if (!$this->session->userdata('is_login')) {
            if ($return_url == "") {
                redirect('/Auth/login');
            }
            redirect('/Auth/login?returnURL=' . rawurlencode($return_url));
        }

        if (!$this->session->userdata('is_admin')) {
            if ($return_url == "") {
                redirect('/Home/index');
            }
            redirect(rawurlencode($return_url));
        }
    }

    function __is_logined($return_url = "")
    {
        if ($this->session->userdata('is_login')) {
            if ($return_url == "") {
                redirect('/home/index');
            }
            redirect($return_url);
        }
    }


    /* handler */
    function handle_date($date)
    {
        // 00/00/2015 -> 2015-00-00
        $arr_date = explode('/', $date);
        return $arr_date[2] . '-' . $arr_date[1] . '-' . $arr_date[0];
    }

    function hadle_short_date($date)
    {
        // 2015-08-03 00:00: -> 2015-08-03
        return substr($date, 0, 10);
    }

    /* 게시글 쓸때 대표이미지 handling 함수 */
    function handle_main_img($content)
    {
        $split_by_src = explode('src="', $content);
        $main_img_uri = explode('" title=', $split_by_src[1])[0];

        return $main_img_uri;
    }

    function handle_file_error($file, $return_error_url)
    {
        $file_error = $file['error'];
        if ($file_error === 0) {
            $upload_dir = '/home/hosting_users/goqualweb/www/static/img/profile/';
            $upload_file = $upload_dir . basename($file['name']);

            if (file_exists($upload_file)) {
                return explode('www', $upload_file)[1];
            } else {
                if (move_uploaded_file($file['tmp_name'], $upload_file)) {
                    return explode('www', $upload_file)[1];
                } else {
                    $this->session->set_flashdata('message', '사진을 저장하는데 오류가 발생했습니다.');
                    redirect($return_error_url);
                }
            }

        } else if ($file_error === 2) {
            $this->session->set_flashdata('message', '사진이 너무 큼니다.');
            redirect($return_error_url);
        } else if ($file_error === 3) {
            $this->session->set_flashdata('message', '사진 중 일부만 전송되었습니다.');
            redirect($return_error_url);
        } else if ($file_error === 4) {
            $this->session->set_flashdata('message', '사진을 설정해주세요.');
            redirect($return_error_url);
        } else {
            $this->session->set_flashdata('message', '사진을 저장하는데 오류가 발생했습니다.');
            redirect($return_error_url);
        }
    }
}