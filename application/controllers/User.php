<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
    }

    public function index()
    {
    }

    public function login()
    {
        $this->data['page_title'] = 'Login';
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('identity', 'Identity', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');
            if ($this->form_validation->run() === TRUE) {
                $remember = (bool)$this->input->post('remember');
                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    redirect('dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('user/login', 'refresh');
                }
            }
        }
        $this->load->helper('form');
        $this->render('user/login_view', 'auth_master');
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('user/login', 'refresh');
    }

    public function profile()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('admin');
        }
        $this->data['page_title'] = 'User Profile';
        $user = $this->ion_auth->user()->row();
        $this->data['user'] = $user;
        $this->data['current_user_menu'] = '';
        if ($this->ion_auth->in_group('admin')) {
            $this->data['current_user_menu'] = $this->load->view('templates/_parts/user_menu_admin_view.php', NULL, TRUE);
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First name', 'trim');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim');
        $this->form_validation->set_rules('company', 'Company', 'trim');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->render('user/profile_view', 'auth_master');
        } else {
            $new_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone')
            );
            if (strlen($this->input->post('password')) >= 6) $new_data['password'] = $this->input->post('password');
            $this->ion_auth->update($user->id, $new_data);

            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('user/profile', 'refresh');
        }
    }
}