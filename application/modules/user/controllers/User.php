<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
    }

    public function index()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Queue Motorcycle';
        $data['user'] = $this->m_user->getUser('users', $useremail);
        
        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('v_queuetable', $data);
        $this->load->view('templates/footer');
    }

    public function userBooking()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Booking';
        $data['user'] = $this->m_user->getUser('users', $useremail);

        $this->load->view('templates/home_header',$data);
        $this->load->view('v_booking', $data);
        $this->load->view('templates/home_footer');
    }

    public function userTransaction()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Transaction';
        $data['user'] = $this->m_user->getUser('users', $useremail);

        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('v_queuetable', $data);
        $this->load->view('templates/footer');
    }

}