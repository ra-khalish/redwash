<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    const statusQ = 'Queue',
    statusP = 'Processed',
    statusC = 'Completed';

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin') {
            redirect('block');
        }
        $this->load->model('m_admin');
        $this->load->library('pdf');
    }

    public function get_session()
    {
        $useremail = $this->session->userdata('email');
        $username = $this->session->userdata('username');
        return $this->m_admin->getUser('users', $useremail,$username);
    }

    public function load_view($main_view, $data)
    {
        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view("{$main_view}", $data);
        $this->load->view('templates/admin_footer');
    }
    
    //Dashboard
    function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->get_session();
        $date = date("Y-m-d");
        $data['queue']  = $this->m_admin->getctqueue(Admin::statusQ ,$date);
        $data['process'] = $this->m_admin->getctprocess(Admin::statusP,$date);
        $data['annual'] = $this->m_admin->getannual('tbl_washing',$date);
        $data['monthly'] = $this->m_admin->getmonthly('tbl_washing',$date);
        $this->load_view('v_dashboard', $data);
    }

    //Tabel antrian motor
    public function mcqueue()
    {
        $data['title']  = 'Vehicle Queue';
        $data['user'] = $this->get_session();
        $date = date("Y-m-d");
        $data['queue']  = $this->m_admin->getqueue('tbl_washing', Admin::statusQ,$date);
        $data['processed']  = $this->m_admin->getprocess('tbl_washing', Admin::statusP,$date);
        $data['completed']  = $this->m_admin->getcompleted('tbl_washing', Admin::statusC,$date);
        $this->load_view('v_queue', $data);
    }
    //Tabel antrian motor
    
    //Form Pemesanan
    public function fmbooking()
    {
        $data['title'] = 'Booking';
        $data['user'] = $this->get_session();
        $data['typemc'] = $this->m_admin->gettype();
        $data['codebooking'] = $this->m_admin->bkcode();
        
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
            $this->load_view('v_booking', $data);
        } else {
                $data = [
                    'user_id' => htmlspecialchars($this->input->post('user_id',true)),
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
    //Form Pemesanan

    //Pengolahan Pemesanan
    public function mngbooking()
    {
        $data['title']  = 'Booking Management';
        $data['user'] = $this->get_session();
        $data['chstatus'] = [Admin::statusP,Admin::statusC];
        $this->load_view('v_mgbooking', $data);
    }

    //DataTable ambil data tbl_washing
    function get_order()
    {
        header('Content-Type: application/json');
        echo $this->m_admin->getOrder();
    }

    function update_order(){ //update record method
        $record = $this->m_admin->updateOrder();
        $useremail = $this->m_admin->getUsernemail($record['user_id']);
        $motor_type = $this->m_admin->getPacket($record['tot_cost']);
        $this->send_email($record, $useremail, $motor_type);
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
    //Pengolahan Pemesanan

    //Arsip Pemesanan
    public function booking_arc()
    {
        if ($this->session->userdata('role_id') != '1') {
            redirect('admin');
        }
        $data['title']  = 'Booking Archive';
        $data['user'] = $this->get_session();
        $this->load_view('v_bookarc', $data);
    }

    //DataTable ambil arsip pemesanan
    public function get_orderarchive()
    {
        header('Content-Type: application/json');
        echo $this->m_admin->getOrderarchive();
    }

    //Halaman pengambilan datal laporan
    public function data_report()
    {
        if ($this->session->userdata('role_id') != '1') {
            redirect('admin');
        }
        $data['title']  = 'Data Report';
        $data['user'] = $this->get_session();
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
            $this->load_view('v_report', $data);
        }else{
            $where = "ctime >= '$startDate' AND  ctime <= '$endDate 23:59:59'";
            $data['result'] = $this->m_admin->getReport($where);
            $data['date'] = $this->m_admin->getReportdate($where);
            $data['total'] = $this->m_admin->getTotal($where);
            $data['start'] = $startDate;
            $data['end'] = $endDate;
            $this->load->view('v_resultreport', $data);
        }
    }

    //Menampilkan bentuk pdf dari hasil laporan
    public function grtReport()
    {
        $start = $this->input->get('start');
        $end = $this->input->get('end');

        $where = "ctime >= '$start' AND  ctime <= '$end 23:59:59'";
        $data['result'] = $this->m_admin->getReport($where);
        $data['date'] = $this->m_admin->getReportdate($where);
        $data['total'] = $this->m_admin->getTotal($where);
        // $html = $this->load->view('v_resultreport', $data, true);
        // $this->pdf->generate($html,'contoh');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan-redwash.pdf";
        $this->pdf->load_view('v_resultreport', $data);
    }
    
    //Data Karyawan
    public function users_emply()
    {
        if ($this->session->userdata('role_id') != '1') {
            redirect('admin');
        }
        $data['title']  = 'Employee Management';
        $data['user'] = $this->get_session();
        $this->load_view('v_emplydata', $data);
    }

    //DataTable ambil data user yang status karyawan
    function get_emply()
    {
        header('Content-Type: application/json');
        echo $this->m_admin->getallEmply();
    }

    //Fungsi membuat user karyawan
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
                'user_email' => NULL,
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

    //Update status karyawan aktif atau tidak
    function update_emply(){ //update record method
        $this->m_admin->updateEmply();
        redirect('admin/users_emply');
    }

    function delete_emply(){ //delete record method
        $this->m_admin->deleteEmply();
        redirect('admin/users_emply');
    }
    //Data Karyawan

    //Profile
    public function admin_profile()
    {
        $data['title']  = 'My Profile';
        $data['user'] = $this->get_session();
        $this->load_view('v_adminprofile', $data);
    }

    //Fungsi edit profile
    public function editProfile()
    {
        $data['user'] = $this->get_session();
        $username = $data['user']['user_username'];
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
            $this->m_admin->editUser('users',$datauser,$username);
			$data['message'] = $this->session->set_flashdata('alert',success("Profile has been updated."));
            $data['view'] = 'admin_profile';
		}
		echo json_encode($data);
    }

    //Fungsi edit password
    public function editPass()
    {
        $user = $this->get_session();
        $username = $user['user_username'];
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
            foreach ($this->input->post() as $key => $value) { // Loop error
				$data['messages'][$key] = form_error($key); // Menampilkan error
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
                    $this->m_admin->editUser('users',$datauser,$username);
                    $data['message'] = $this->session->set_flashdata('alert',success("Password Changed!"));
                    $data['view'] = 'admin_profile';
                }
            }
        }
        echo json_encode($data);
    }
    //Profile

    private function send_email($record, $useremail, $motor_type)
    {
        if($record['status'] == Admin::statusP){
            $subject = 'Process Notification';
            $text = 'We are washing your motorbike';
            $content = 'notification';
          } else if($record['status'] == Admin::statusC){
            $subject = 'Complete Notification';
            $text = 'Wow! Your motorbike is shiny after washing';
            $content = 'invoice';
          }
          $email = $useremail['user_email'];
          $data = array(
            'name' => $record['nm_consumer'],
            'brand' => 'Red Wash',
            'total' => $record['tot_cost'],
            'code_booking' => $record['code_booking'],
            'motor_type' => $motor_type['motor_type'],
            'status' => $record['status'],
            'time' => $record['etime'],
            'cashier' => $record['cashier'],
            'action_url' => 'https://redwash.000webhostapp.com/user/queue',
            'text' => $text
          );
          $message = $this->load->view("email/{$content}", $data, true);
          $this->email->from($_ENV['AUTH_EMAIL'], 'Admin Red Wash');
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
    
          if ($this->email->send()) {
            return TRUE;
          } else {
            show_error($this->email->print_debugger());
          }
    }
}