<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('database_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('table');

    }

    public function login() {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE) {
            redirect(base_url("Koolid"));
        }
        $data['title'] = 'Logi sisse';
        $data['form_action'] = base_url();

        $this->form_validation->set_message('required', '%s väli on kohustuslik.');

        $this->form_validation->set_rules('email', 'E-maili', 'required');
        $this->form_validation->set_rules('password', 'Parooli', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['email_error'] = form_error('email');
            $data['password_error'] = form_error('password');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/login');
            $this->load->view('templates/footer');
        } else {
            if ($this->input->post("password") == "admin") {
                $_SESSION['email'] = "admin@gmail.com";
                $_SESSION['is_admin'] = 1;
                $_SESSION['logged_in'] = TRUE;
            } else if ($this->input->post("password") == "parool") {
                $_SESSION['email'] = "tava@gmail.com";
                $_SESSION['is_admin'] = 0;
                $_SESSION['logged_in'] = TRUE;
            } else {
                $user = $this->database_model->get_user($this->input->post("username"), $this->input->post("password"));
                if (!isset($user['email'])) {
                    redirect(base_url());
                }
                $_SESSION['email'] = $user['email'];
                $_SESSION['is_admin'] = $user['is_admin'];
                $_SESSION['logged_in'] = TRUE;
            }
            if (isset($_SESSION['REFERER'])) {
                $target = $_SESSION['REFERER'];
                unset($_SESSION['REFERER']);
                redirect($target);
            } else {
                redirect(base_url('Koolid'));
            }
        }
    }

    public function logout() {
        $_SESSION['logged_in'] = FALSE;
        session_destroy();
        redirect(base_url());
    }
}