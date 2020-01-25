<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

  public function index()
  {
    $this->load->view('templates/auth_header');
    $this->load->view('login');
    $this->load->view('templates/auth_footer');
  }

  public function registration()
  {
    $this->load->view('templates/auth_header');
    $this->load->view('registration');
    $this->load->view('templates/auth_footer');
  }

}