<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{
  public function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Login Page';
        $this->load->view('templates/auth_header',$data);
        $this->load->view('v_login');
        $this->load->view('templates/auth_footer');
    }

    public function registration()
    {
      $rules = array(
        array(
                'field' => 'name',
                'label' => 'Full Name',
                'rules' => 'required|trim'
        ),
        array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|trim|valid_email|is_unique[user.user_email]',
                'errors' => array(
                  'is_unique' => 'This email has already registered!'
                ),
        ),
        array(
                'field' => 'password1',
                'label' => 'Password',
                'rules' => 'required|trim|min_length[8]|matches[password2]',
                'errors' => array(
                  'matches' => 'Password dont match!',
                  'min_length' => 'Password too short!'
                ),
        ),
        array(
                'field' => 'password2',
                'label' => 'Password',
                'rules' => 'required|trim|matches[password1]'
        )
      );
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == false){
            $data['title'] = 'BlueWash Registration';
            $this->load->view('templates/auth_header',$data);
            $this->load->view('v_registration');
            $this->load->view('templates/auth_footer');
        }else {
            $data = [
                'user_name' => htmlspecialchars($this->input->post('name',ture)),
                'user_email' => htmlspecialchars($this->input->post('email',true)),
                'user_image' => 'default.jpg',
                'user_password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
                'user_role_id' => 2,
                'user_is_active' => 1,
                'user_ctime' => time()
            ];
            $this->m_auth->insertReg('user',$data);
            $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congratulation!</strong> Your account has been created, Please Login.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }
    }

}