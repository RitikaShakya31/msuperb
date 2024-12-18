<?php

class AdminAuth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
	}

	public function admin()
	{
		if (sessionId('admin_id') != '') {
			redirect('dashboard');
		} else {
			if (count($_POST) > 0) {
				$this->form_validation->set_rules('contact_no', 'contact number', 'required');
				$this->form_validation->set_rules('password', 'password', 'required');
				$this->form_validation->set_error_delimiters('<div style="color: red;">', '</div>');
				if ($this->form_validation->run()) {
					$phone = $this->input->post('contact_no');
					$password = $this->input->post('password');
					$get = $this->CommonModel->getRowById('admin_login', 'contact_no', $phone);
					if ($get) {
						$id = $get[0]['admin_id'];
						$name = $get[0]['name'];
						$f_password = $get[0]['password'];
				// 		echo encryptId($password);exit;
						$status = $get[0]['status'];
						if ($password != decryptId($f_password)) {
							flashData('login_error', 'Enter a valid Password.');
						} else if ($status == '0') {
							flashData('login_error', 'You are blocked.');
						} else if ($password == decryptId($f_password)) {
							$this->session->set_userdata(array('admin_id' => $id, 'admin_name' => $name));
							redirect('dashboard');
						} else {
							flashData('login_error', 'something went wrong');
						}
					} else {
						flashData('login_error', 'Enter a valid Contact Number');
					}
				}
			}
			$this->load->view('admin/login');
		}
	}

	public function adminLogout()
	{
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_name');
		redirect('admin');
	}
}
