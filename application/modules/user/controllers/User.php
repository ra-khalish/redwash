<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'user') {
            redirect('block');
        }
        $this->load->model('m_user');
    }

    public function queue()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Queue';
        $data['user'] = $this->m_user->getUser('users', $useremail);

        $statusQ        = 'Queue';
        $statusP        = 'Processed';
        $statusC        = 'Completed';
        $date           = date("Y-m-d");

        $data['queue']  = $this->m_user->getqueue('tbl_washing', $statusQ,$date);
        $data['processed']  = $this->m_user->getprocess('tbl_washing', $statusP,$date);
        $data['completed']  = $this->m_user->getcompleted('tbl_washing', $statusC,$date);

        $this->load->view('templates/user_header',$data);
        $this->load->view('v_rwqueue', $data);
        $this->load->view('templates/user_footer');
    }

    public function fbooking()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Booking';
        $data['user'] = $this->m_user->getUser('users', $useremail);
        $data['typemc'] = $this->m_user->gettype();
        $data['codebooking'] = $this->m_user->bkcode();

        $rules = array(
            array(
                    'field' => 'nm_consumer',
                    'label' => 'Consumer',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'contact',
                    'label' => 'Contact',
                    'rules' => 'required|trim|max_length[12]|integer',
                    'errors' => array(
                            'max_length' => 'Your number is too short',
                    ),
            ),
            array(
                    'field' => 'noplat',
                    'label' => 'Plat Number',
                    'rules' => 'required|trim|min_length[3]',
                    'errors' => array(
                        'is_unique' => 'This No Plat has already Booked up!'
                    ),
            ),
            array(
                    'field' => 'typemotor',
                    'label' => 'Type',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'tot_cost',
                    'label' => 'Total Cost',
                    'rules' => 'required|trim'
            )
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<small class="text-danger pl-3">','</small>');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header',$data);
            $this->load->view('v_booking', $data);
            $this->load->view('templates/user_footer');
        } else {
            $data = [
                'user_id' => htmlspecialchars($this->input->post('user_id',true)),
                'nm_consumer' => htmlspecialchars($this->input->post('nm_consumer',true)),
                'contact' => htmlspecialchars($this->input->post('contact',true)),
                'code_booking' => htmlspecialchars($this->input->post('code_booking',true)),
                'noplat' => htmlspecialchars($this->input->post('noplat',true)),
                'tot_cost' => htmlspecialchars($this->input->post('tot_cost',true)),
                'status' => 'Queue',
                'ctime' => date("Y-m-d H:i:s")
            ];
            $this->m_user->insertBook('tbl_washing',$data);
            $this->session->set_flashdata('alert',success("<strong>Congratulation!</strong> Motorcycle is already in the queue."));
            redirect('user/queue');
        }
    }

    public function transaction()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Queue';
        $data['user'] = $this->m_user->getUser('users', $useremail);

        $this->load->view('templates/user_header',$data);
        $this->load->view('v_transaction', $data);
        $this->load->view('templates/user_footer');
    }

}