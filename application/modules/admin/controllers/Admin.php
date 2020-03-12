<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin') {
            redirect('block');
        }
        $this->load->model('m_admin');
        $this->load->library('pdf');
    }

    public function index()
    {
        $useremail = $this->session->userdata('email');
        $username = $this->session->userdata('username');
        $data['title'] = 'Dashboard';
        $data['user'] = $this->m_admin->getUser('users', $useremail);
        
        $statusQ        = 'Queue';
        $statusP        = 'Processed';
        $statusC        = 'Completed';
        $date           = date("Y-m-d");
        $data['queue']  = $this->m_admin->getctqueue($statusQ,$date);
        $data['process']  = $this->m_admin->getctprocess($statusP,$date);
        $data['annual']  = $this->m_admin->getannual('tbl_washing',$date);
        $data['monthly']  = $this->m_admin->getmonthly('tbl_washing',$date);
        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view('v_dashboard', $data);
        $this->load->view('templates/admin_footer');
    }

    //Motorcycle Queue
    public function mcqueue()
    {
        $useremail      = $this->session->userdata('email');
        $username = $this->session->userdata('username');
        $statusQ        = 'Queue';
        $statusP        = 'Processed';
        $statusC        = 'Completed';
        $date           = date("Y-m-d");
        $data['title']  = 'Motorcycle Queue';
        $data['user']   = $this->m_admin->getUser('users', $useremail);

        $data['queue']  = $this->m_admin->getqueue('tbl_washing', $statusQ,$date);
        $data['processed']  = $this->m_admin->getprocess('tbl_washing', $statusP,$date);
        $data['completed']  = $this->m_admin->getcompleted('tbl_washing', $statusC,$date);
        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view('v_queue', $data);
        $this->load->view('templates/admin_footer');
    }
    //End Motorcycle Queue
    
    //Booking Form
    public function fmbooking()
    {
        $useremail = $this->session->userdata('email');
        $username = $this->session->userdata('username');
        $data['title'] = 'Booking';
        $data['user'] = $this->m_admin->getUser('users', $useremail);
        $data['typemc'] = $this->m_admin->gettype();
        $data['codebooking'] = $this->m_admin->bkcode();
        
        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
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
            $this->load->view('templates/admin_header',$data);
            $this->load->view('templates/admin_sidebar',$data);
            $this->load->view('templates/admin_topbar',$data);
            $this->load->view('v_booking', $data);
            $this->load->view('templates/admin_footer');
        } else {
                $data = [
                    'nm_consumer' => htmlspecialchars($this->input->post('nm_consumer',true)),
                    'contact' => htmlspecialchars($this->input->post('contact',true)),
                    'code_booking' => htmlspecialchars($this->input->post('code_booking',true)),
                    'noplat' => htmlspecialchars($this->input->post('noplat',true)),
                    'tot_cost' => htmlspecialchars($this->input->post('tot_cost',true)),
                    'status' => 'Queue',
                    'cashier' => $this->session->userdata('name'),
                    'ctime' => date("Y-m-d H:i:s")
                ];
                $this->m_admin->insertBook('tbl_washing',$data);
                $this->session->set_flashdata('alert',success("<strong>Congratulation!</strong> Motorcycle is already in the queue."));
                redirect('admin/mcqueue');
        }
    }
    //End Booking Form

    //Order Management
    public function mngbooking()
    {
        $useremail      = $this->session->userdata('email');
        $username = $this->session->userdata('username');
        $data['title']  = 'Order Management';
        $data['user']   = $this->m_admin->getUser('users', $useremail);
        $data['chstatus'] = ['Queue','Processed','Completed'];

        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view('v_mgbooking', $data);
        $this->load->view('templates/admin_footer');
    }

    function get_order()
    {
        header('Content-Type: application/json');
        echo $this->m_admin->getOrder();
    }

    function update_order(){ //update record method
        $this->m_admin->updateOrder();
        redirect('admin/mngbooking');
    }

    function update_payment(){ //update payment record
        $this->m_admin->updatePayment();
        redirect('admin/mngbooking');
    }

    function delete_order(){ //delete record method
        $this->m_admin->deleteOrder();
        redirect('admin/mngbooking');
    }
    //End Order Management

    //Order Archive
    public function order_arc()
    {
        if ($this->session->userdata('role_id') != '1') {
            redirect('admin');
        }
        $useremail      = $this->session->userdata('email');
        $data['title']  = 'Order Archive';
        $data['user']   = $this->m_admin->getUser('users', $useremail);

        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view('v_orderarc', $data);
        $this->load->view('templates/admin_footer');
    }

    public function get_orderarchive()
    {
        header('Content-Type: application/json');
        echo $this->m_admin->getOrderarchive();
    }

    public function data_report()
    {
        if ($this->session->userdata('role_id') != '1') {
            redirect('admin');
        }
        $useremail      = $this->session->userdata('email');
        $data['title']  = 'Data Report';
        $data['user']   = $this->m_admin->getUser('users', $useremail);

        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        $startDate  = htmlspecialchars($this->input->post('startDate',true));
        $endDate    = htmlspecialchars($this->input->post('endDate',true));

        $rules = array(
            array(
                    'field' => 'startDate',
                    'label' => 'Start Date',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'endDate',
                    'label' => 'End Date',
                    'rules' => 'required',
            ),
        );
        $this->form_validation->set_rules($rules);
        if($this->input->post() == false){
            $this->load->view('templates/admin_header',$data);
            $this->load->view('templates/admin_sidebar',$data);
            $this->load->view('templates/admin_topbar',$data);
            $this->load->view('v_report', $data);
            $this->load->view('templates/admin_footer');
        }else{
            $where = "ctime >= '$startDate' AND  etime <= '$endDate'";
            $data['result'] = $this->m_admin->getReport($where);
            $data['date'] = $this->m_admin->getReportdate($where);
            $data['total'] = $this->m_admin->getTotal($where);
            $data['start'] = $startDate;
            $data['end'] = $endDate;
            $this->load->view('v_resultreport', $data);
        }
    }

    public function grtReport()
    {
        $start = $this->input->get('start');
        $end = $this->input->get('end');

        $where = "ctime BETWEEN '$start' AND '$end'";
        $data['result'] = $this->m_admin->getReport($where);
        $data['date'] = $this->m_admin->getReportdate($where);
        $data['total'] = $this->m_admin->getTotal($where);
        // $html = $this->load->view('v_resultreport', $data, true);
        // $this->pdf->generate($html,'contoh');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan-redwash.pdf";
        $this->pdf->load_view('v_resultreport', $data);
    }
    
    //Start Employee
    public function users_emply()
    {
        if ($this->session->userdata('role_id') != '1') {
            redirect('admin');
        }
        $useremail      = $this->session->userdata('email');
        $data['title']  = 'Employee Management';
        $data['user']   = $this->m_admin->getUser('users', $useremail);

        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view('v_emplydata', $data);
        $this->load->view('templates/admin_footer');
    }

    function get_emply()
    {
        header('Content-Type: application/json');
        echo $this->m_admin->getallEmply();
    }

    public function addEmply()
    {
        $data = array('success' => false, 'messages' => array());

        $rules = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required',
            ),
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|trim|is_unique[users.user_username]',
                'errors' => array('is_unique' => 'This username has already was taken!'
                )
            ),
            array(
                'field' => 'contact',
                'label' => 'Contact',
                'rules' => 'required|trim|min_length[11]|is_unique[users.user_contact]',
                'errors' => array(
                    'is_unique' => 'This contact number has already was taken!',
                    'min_length' => 'Contact Number too short'
                )
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
                'label' => 'Confirm Password',
                'rules' => 'required|trim|matches[password1]'
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
            $emply = array(
                'user_name' => htmlspecialchars($this->input->post('name',true)),
                'user_username' => htmlspecialchars($this->input->post('username',true)),
                'user_contact' => htmlspecialchars($this->input->post('contact',true)),
                'user_password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
                'user_role_id' => 3,
                'user_is_active' => 1,
                'user_ctime' => date("Y-m-d")
            );
            $this->m_admin->insertEmply('users',$emply);
			$data['message'] = $this->session->set_flashdata('alert',success("Employee data has been added!"));
            $data['view'] = 'users_emply';
		}
		echo json_encode($data);
    }

    function update_emply(){ //update record method
        $this->m_admin->updateEmply();
        redirect('admin/users_emply');
    }

    function delete_emply(){ //delete record method
        $this->m_admin->deleteEmply();
        redirect('admin/users_emply');
    }
    //End Employee

    public function admin_profile()
    {
        $useremail      = $this->session->userdata('email');
        $data['title']  = 'My Profile';
        $data['user']   = $this->m_admin->getUser('users', $useremail);

        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view('v_adminprofile', $data);
        $this->load->view('templates/admin_footer');
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
            $this->m_admin->editUser('users',$datauser,$useremail);
			$data['message'] = $this->session->set_flashdata('alert',success("Profile has been updated."));
            $data['view'] = 'admin_profile';
		}
		echo json_encode($data);
    }

    //Fungsi edit password
    public function editPass()
    {
        $useremail = $this->session->userdata('email');
        $user =  $this->m_admin->getUser('users', $useremail);
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
                $data['view'] = 'admin_profile';
            }else {
                if($current_password == $new_password){
                    $data['error'] = true;
                    $data['message'] = $this->session->set_flashdata('alert',error("New password cannot be the same as current password"));
                    $data['view'] = 'admin_profile';
                }else {
                    $data['success'] = true;
                    //pass ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $datauser = array(
                        'user_password' => $password_hash
                    );
                    $this->m_admin->editUser('users',$datauser,$useremail);
                    $data['message'] = $this->session->set_flashdata('alert',success("Password Changed!"));
                    $data['view'] = 'admin_profile';
                }
            }
        }
        echo json_encode($data);
    }
}