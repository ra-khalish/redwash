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
      $where = "user_email='$username' OR user_username='$username'";

      $user = $this->m_auth->getUserlogin('users', $where);

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
            }else if($user['user_role_id'] == 2) {
              $data['status'] = 'user';
              $this->session->set_userdata($data);
              $this->session->set_flashdata('alert',success("<strong>Login Successfully</strong>"));
              redirect('user/queue');
            }
          }else{
            $this->session->set_flashdata('alert',error('Email/Username and Password is not correct!'));
            redirect('login');
          }
        }else{
          $this->session->set_flashdata('alert',error('This Email/Username has not been activated! Please check your email.'));
          redirect('login');
        }
      }else{
        $this->session->set_flashdata('alert',error('Email/Username is not registered! Please register.'));
        redirect('login');
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
          'field' => 'contact',
          'label' => 'Contact Number',
          'rules' => 'required|trim|is_unique[users.user_contact]',
          'errors' => array(
            'is_unique' => 'This contact number has already was taken!'
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
            $data['title'] = 'RedWash Registration';
            $this->load->view('templates/auth_header',$data);
            $this->load->view('v_registration');
            $this->load->view('templates/auth_footer');
        }else {
            $email = $this->input->post('email',true);
            $data = [
                'user_name' => htmlspecialchars($this->input->post('name',true)),
                'user_username' => htmlspecialchars($this->input->post('username',true)),
                'user_email' => htmlspecialchars($email),
                'user_image' => 'default.jpg',
                'user_password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
                'user_role_id' => 2,
                'user_is_active' => 0,
                'user_ctime' => time()
            ];

            //token
            $token = base64_encode(random_bytes(32));
            $users_token = [
              'user_email' => $email,
              'user_token' => $token,
              'user_cdate' => time()
            ];
            $this->m_auth->insertReg('users',$data);
            $this->m_auth->insertTkn('users_token',$users_token);
            
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('alert',success('<strong>Congratulation!</strong> Your account has been created, Please Check your email.'));
            redirect('login');
        }
    }

    private function _sendEmail($token, $type)
    {
      $config = array(
        'protocol'  => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_user' => 'radevman403@gmail.com',
        'smtp_pass' => 'devraf430',
        'smtp_port' => 465,
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'newline'   => "\r\n"
      );

      //$this->load->library('email',$config);
      $this->email->initialize($config);

      $this->email->from('radevman403','Admin RedWash');
      $this->email->to($this->input->post('email'));

      if($type == 'verify'){
        $this->email->subject('Account Verification');
        $this->email->message('Click this link to verify your account : 
          <a href="'.base_url() . 'auth/verify?email=' . $this->input->post('email') 
          . '&token=' . urlencode($token) . '">Activate</a>');
      } else if($type == 'forgot'){
        $this->email->subject('Reset Password');
        $this->email->message('Click this link to reset your password : 
          <a href="'.base_url() . 'auth/resetpassword?email=' . $this->input->post('email') 
          . '&token=' . urlencode($token) . '">Reset Password</a>');
      }

      if($this->email->send()){
        return true;
      }else{
        echo $this->email->print_debugger();
        die;
      }
    }

    public function verify()
    {
      $email = $this->input->get('email');
      $token = $this->input->get('token');

      $user = $this->m_auth->getUser('users', $email);

      if($user){
        $users_token = $this->m_auth->getToken('users_token', $token);

        if($users_token){
          if(time() - $users_token['user_cdate'] < (60*60*24)){
            $this->db->set('user_is_active', 1);
            $this->db->where('user_email', $email);
            $this->db->update('users');
            $this->db->delete('users_token', ['user_email' => $email]);
            
            $this->session->set_flashdata('alert',success('<strong>'.$email.'</strong> has been activated! Please login.'));
            redirect('login');

            }else{
              $this->db->delete('users', ['user_email' => $email]);
              $this->db->delete('users_token', ['user_email' => $email]);
              $this->session->set_flashdata('alert',error('Account activation failed! Token expired.'));
              redirect('auth');
          }
        }else{
          $this->session->set_flashdata('alert',error('Account activation failed! Token Invalid.'));
          redirect('login');
        }
      }else{
        $this->session->set_flashdata('alert',error('Account activation failed! Wrong email.'));
        redirect('login');
      }
    }

    public function logout()
    {
      $this->session->unset_userdata('username');
      $this->session->unset_userdata('name');
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('role_id');
      $this->session->unset_userdata('status');

      $this->session->set_flashdata('alert',success('You have been logged out!'));
      redirect('home');
    }

    public function block()
    {
      $this->load->view('templates/blocked');
    }

    public function forgotPass()
    {
      $this->form_validation->set_rules('email','Email','trim|required|valid_email');
      $this->form_validation->set_error_delimiters('<small class="text-danger pl-3">','</small>');
      if($this->form_validation->run() == false){
        $data['title'] = 'Forgot Password';
        $this->load->view('templates/auth_header',$data);
        $this->load->view('v_forgotpassword');
        $this->load->view('templates/auth_footer');
      }else{
        $email  = $this->input->post('email');
        $user   = $this->db->get_where('users', ['user_email' => $email, 'user_is_active' => 1])->row_array();

        if($user){
          $token = base64_encode(random_bytes(32));
          $users_token = [
            'user_email' => $email,
            'user_token' => $token,
            'user_cdate' => time()
          ];

          $this->m_auth->insertTkn('users_token',$users_token);
          $this->_sendEmail($token,'forgot');
          $this->session->set_flashdata('alert',success('Please check your email to reset your password!'));
          redirect('login');
        }else{
          $this->session->set_flashdata('alert',error('Email is not registered or activated!'));
          redirect('forgot-password');
        }
      }
    }

    public function resetpassword()
    {
      $email = $this->input->get('email');
      $token = $this->input->get('token');

      $user = $this->m_auth->getUser('users', $email);

      if($user){
        $users_token = $this->m_auth->getToken('users_token', $token);

        if($users_token){
          $this->session->set_userdata('reset_email', $email);
          $this->changePass();
        }else{
          $this->session->set_flashdata('alert',error('Reset password failed! Wrong token.'));
          redirect('login');
        }
      }else{
        $this->session->set_flashdata('alert',error('Reset password failed! Wrong email.'));
        redirect('login');
      }
    }

    public function changePass()
    {
      if(!$this->session->userdata('reset_email')){
        redirect('login');
      }
      $rules = array(
        array(
                'field' => 'password1',
                'label' => 'Password',
                'rules' => 'required|trim|min_length[8]|matches[password2]'
        ),
        array(
                'field' => 'password2',
                'label' => 'Password',
                'rules' => 'required|trim|min_length[8]|matches[password1]'
        )
      );
      $this->form_validation->set_error_delimiters('<small class="text-danger pl-3">','</small>');
      $this->form_validation->set_rules($rules);
      if($this->form_validation->run() == false){
        $data['title'] = 'Change Password';
        $this->load->view('templates/auth_header',$data);
        $this->load->view('v_changepassword');
        $this->load->view('templates/auth_footer');
      }else{
        $password = password_hash($this->input->post('password1'),PASSWORD_DEFAULT);
        $email = $this->session->userdata('reset_email');

        $this->db->set('user_password', $password);
        $this->db->where('user_email', $email);
        $this->db->update('users');

        $this->session->unset_userdata('reset_email');
        $this->session->set_flashdata('alert',success('Password has been changed! Please login.'));
        redirect('login');
      }
    }
}