<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_home');
    }

    public function index()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Dashboard';
        $data['user'] = $this->m_home->getUser('users', $useremail);
        
        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/home_header',$data);
        $this->load->view('v_home', $data);
        $this->load->view('templates/home_footer');
    }

}