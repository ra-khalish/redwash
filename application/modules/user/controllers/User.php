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

    //Kontrol Antrian
    public function queue()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Queue Page';
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

    //Kontrol Pemesanan
    public function fbooking()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Booking';
        $data['user'] = $this->m_user->getUser('users', $useremail);
        $data['typemc'] = $this->m_user->gettype();
        $data['codebooking'] = $this->m_user->bkcode();

        $rules = array(
            array(
                'field' => 'code_booking',
                'label' => 'Code Booking',
                'rules' => 'is_unique[tbl_washing.code_booking]',
                'errors' => array(
                    'is_unique' => 'Please send the booking again'
                ),
            ),
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
                    'rules' => 'required|trim|min_length[3]'
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

    //Kontrol transaksi
    public function transaction()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Transaction';
        $data['user'] = $this->m_user->getUser('users', $useremail);

        $this->load->view('templates/user_header',$data);
        $this->load->view('v_transaction', $data);
        $this->load->view('templates/user_footer');
    }

    //Fungsi ambil data transaksi dengan json
    function userTransaction()
    {
        $id = $this->session->userdata('id');
        header('Content-Type: application/json');
        echo $this->m_user->getTransaction($id);
    }

    //Fungsi delete data transaksi
    function deleteTransaction(){ //delete record method
        $this->m_user->delTransaction();
        redirect('user/transaction');
    }

    //Kontrol profile
    public function user_profile()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Profile';
        $data['user'] = $this->m_user->getUser('users', $useremail);

        $this->load->view('templates/user_header',$data);
        $this->load->view('v_userprofile', $data);
        $this->load->view('templates/user_footer');
    }

    //Fungsi edit profile
    public function editProfile()
    {
        $useremail = $this->session->userdata('email');
        $data = array('success' => false, 'messages' => array());

        $rules = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required',
            ),
            array(
                'field' => 'contact',
                'label' => 'Contact',
                'rules' => 'required|trim|min_length[11]',
                'errors' => array(
                    'min_length' => 'Contact Number too short'
                )
            )
        );
        $this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == false) {
            foreach ($this->input->post() as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}
		}
		else {
            $data['success'] = true;
            $datauser = array(
                'user_name' => htmlspecialchars($this->input->post('name',true)),
                'user_contact' => htmlspecialchars($this->input->post('contact',true)),
            );
            $this->m_user->updateData('users',$datauser,$useremail);
			$data['message'] = $this->session->set_flashdata('alert',success("Profile has been updated."));
            $data['view'] = 'user_profile';
		}
		echo json_encode($data);
    }

    //Fungsi edit password
    public function editPass()
    {
        $useremail = $this->session->userdata('email');
        $user =  $this->m_user->getUser('users', $useremail);
        $data = array('success' => false, 'error' => false, 'messages' => array());

        $rules = array(
            array(
                    'field' => 'current_password',
                    'label' => 'Current Password',
                    'rules' => 'required|trim'
            ),
            array(
                    'field' => 'new_password',
                    'label' => 'New Password',
                    'rules' => 'required|trim|min_length[8]|matches[new_conpassword]'
            ),
            array(
                'field' => 'new_conpassword',
                'label' => 'New Confrim Password',
                'rules' => 'required|trim|min_length[8]|matches[new_password]'
            )
        );
        $this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == false) {
            foreach ($this->input->post() as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}
		} else {
            $current_password = htmlspecialchars($this->input->post('current_password',true));
            $new_password = htmlspecialchars($this->input->post('new_password', true));

            if(!password_verify($current_password, $user['user_password'])){
                $data['error'] = true;
                $data['message'] = $this->session->set_flashdata('alert',error("Wrong current password!"));
                $data['view'] = 'user_profile';
            }else {
                if($current_password == $new_password){
                    $data['error'] = true;
                    $data['message'] = $this->session->set_flashdata('alert',error("New password cannot be the same as current password"));
                    $data['view'] = 'user_profile';
                }else {
                    $data['success'] = true;
                    //pass ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $datauser = array(
                        'user_password' => $password_hash
                    );
                    $this->m_user->updateData('users',$datauser,$useremail);
                    $data['message'] = $this->session->set_flashdata('alert',success("Password Changed!"));
                    $data['view'] = 'user_profile';
                }
            }
        }
        echo json_encode($data);
    }
}