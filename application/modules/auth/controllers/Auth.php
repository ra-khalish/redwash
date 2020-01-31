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
      if($this->session->userdata('status') == 'admin'){
        redirect('admin');
      }else if($this->session->userdata('status') == 'user'){
        redirect('user');
      }
      $rules = array(
        array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|trim'
        ),
        array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim'
        )
      );
      $this->form_validation->set_error_delimiters('<small class="text-danger pl-3">','</small>');
      $this->form_validation->set_rules($rules);
      if($this->form_validation->run() == false){
        $data['title'] = 'Login Page';
        $this->load->view('templates/auth_header',$data);
        $this->load->view('v_login');
        $this->load->view('templates/auth_footer');

      } else {
        $this->_login();
      }
    }

    private function _login()
    {
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      $user = $this->m_auth->getUser('users', $username);

      //Jika user ada
      if($user){
        //Jika usernya aktif
        if($user['user_is_active'] == 1){
          //Cek password
          if(password_verify($password, $user['user_password'])){
            $data = [
              'username' => $user['user_username'],
              'name' => $user['user_name'],
              'email' => $user['user_email'],
              'role_id' => $user['user_role_id']
            ];
            if ($user['user_role_id'] == 1) {
              $data['status'] = 'admin';
              $this->session->set_userdata($data);
              redirect('admin');
            } else if ($user['user_role_id'] == 2) {
              $data['status'] = 'user';
              $this->session->set_userdata($data);
              redirect('user');
            }
            

          }else{
            $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Wrong password!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
          }

        }else{
          $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            This username has not been activated! Please check your email.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }
      }else{
        $this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Username is not registered! Please register.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
      }
    }

    public function registration()
    {
      if($this->session->userdata('status') == 'admin'){
        redirect('admin');
      }else if($this->session->userdata('status') == 'user'){
        redirect('user');
      }

      $rules = array(
        array(
          'field' => 'username',
          'label' => 'Username',
          'rules' => 'required|trim|is_unique[users.user_username]'
        ),
        array(
          'field' => 'name',
          'label' => 'Full Name',
          'rules' => 'required|trim'
        ),
        array(
          'field' => 'email',
          'label' => 'Email',
          'rules' => 'required|trim|valid_email|is_unique[users.user_email]',
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
      $this->form_validation->set_error_delimiters('<small class="text-danger pl-3">','</small>');
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == false){
            $data['title'] = 'BlueWash Registration';
            $this->load->view('templates/auth_header',$data);
            $this->load->view('v_registration');
            $this->load->view('templates/auth_footer');
        }else {
            $data = [
                'user_name' => htmlspecialchars($this->input->post('name',ture)),
                'user_username' => htmlspecialchars($this->input->post('username',true)),
                'user_email' => htmlspecialchars($this->input->post('email',true)),
                'user_image' => 'default.jpg',
                'user_password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
                'user_role_id' => 2,
                'user_is_active' => 1,
                'user_ctime' => time()
            ];
            $this->m_auth->insertReg('users',$data);
            $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congratulation!</strong> Your account has been created, Please Login.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
      $this->session->unset_userdata('username');
      $this->session->unset_userdata('name');
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('role_id');
      $this->session->unset_userdata('status');

      $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible fade show" role="alert">
            You have been logged out!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
    }

    public function block()
    {
      $this->load->view('templates/blocked');
    }

}