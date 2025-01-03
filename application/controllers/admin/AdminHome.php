<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AdminHome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (sessionId('admin_id') == "") {
			redirect("admin");
		}
		date_default_timezone_set("Asia/Kolkata");
		$this->setting = $this->CommonModel->getAllRows('setting');
	}
	public function dashboard()
	{

		$getRows['active_user'] = $this->CommonModel->getNumRows("user_registration", "user_status = '1'");
		$getRows['inactive_user'] = $this->CommonModel->getNumRows("user_registration", "user_status = '0'");
		$getRows['product_category'] = $this->CommonModel->getNumRows("category", "is_delete = '1'");
		$getRows['product_sub_category'] = $this->CommonModel->getNumRows("sub_category", "is_delete = '1'");
		$getRows['total_product'] = $this->CommonModel->getNumRows("product", "is_delete = '1'");
		$getRows['recent_orders'] = $this->CommonModel->getNumRows("book_product", "booking_status = '0' AND status != '10' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')");
		$getRows['accepted_orders'] = $this->CommonModel->getNumRows("book_product", "booking_status = '1' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')");
		$getRows['dispatch_orders'] = $this->CommonModel->getNumRows("book_product", "booking_status = '3' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')");
		$getRows['completed_orders'] = $this->CommonModel->getNumRows("book_product", "booking_status = '4' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')");
		$getRows['canceled_orders'] = $this->CommonModel->getNumRows("book_product", "booking_status = '2' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')");
		$getRows['title'] = "Home";
		$getRows['recentOrderList'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_status = '0' AND status != '10' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')", 'create_date', 'DESC');
		$getRows['setting'] = $this->setting;
		$this->load->view('admin/index', $getRows);
	}
	public function promoCode()
	{
		$id = $this->input->get('promo');
		$dID = $this->input->get('dID');
		if (isset($id)) {
			$sId = decryptId($id);
			$getPlans = getRowById('promocode', 'promocode_id', $sId);
		} else {
			$sId = '';
		}


		$data['promocode'] = set_value('promocode') == false ? @$getPlans[0]['promocode'] : set_value('promocode');
		$data['expiry_date'] = set_value('expiry_date') == false ? @$getPlans[0]['expiry_date'] : set_value('expiry_date');
		$data['minimum_order'] = set_value('minimum_order') == false ? @$getPlans[0]['minimum_order'] : set_value('minimum_order');
		$data['amount'] = set_value('amount') == false ? @$getPlans[0]['amount'] : set_value('amount');
		$data['payment_method'] = set_value('payment_method') == false ? @$getPlans[0]['payment_method'] : set_value('payment_method');
		$data['festive'] = set_value('festive') == false ? @$getPlans[0]['festive'] : set_value('festive');

		if (isset($dID)) {
			$delete = $this->CommonModel->deleteRowById('promocode', array('promocode_id' => decryptId($dID)));
		}

		if (isset($id)) {
			$data['title'] = 'Promo code Edit';
		} else {
			$data['title'] = 'Promo code add';
		}
		if (count($_POST) > 0) {
			extract($this->input->post());
			$post['promocode'] = strtoupper($promocode);
			$post['amount'] = $amount;
			$post['minimum_order'] = $minimum_order;
			$post['expiry_date'] = date('Y-m-d', strtotime($expiry_date));
			$post['payment_method'] = $payment_method;
			$post['festive'] = $festive;
			if (isset($id)) {
				$post['update_date'] = setDateTime();
				$update = updateRowById('promocode', 'promocode_id', $sId, $post);
				if ($update) {
					flashData('errors', 'Promo code Update Successfully');
				} else {
					flashData('errors', 'Promo code Not Update. please try again');
				}
			} else {
				$post['create_date'] = setDateTime();
				$insert = insertRow('promocode', $post);
				if ($insert) {
					flashData('errors', 'Promo code Add Successfully');
				} else {
					flashData('errors', 'Promo code Not Add');
				}
			}
			redirect('promoCode');
		} else {
			$data['title'] = 'Promo Code';
			$data['setting'] = $this->setting;
			$this->load->view('admin/user_promo_code', $data);
		}
	}
	public function registerAll()
	{
		$dID = $this->input->get('dID');
		if (isset($dID)) {
			$update = $this->CommonModel->deleteRowById('register', ['register_id' => decryptId($dID)]);
			redirect('registerAll');
			exit;
		}
		$get['all_register'] = $this->CommonModel->getRowByIdInOrder('register', [], 'register_id', 'DESC');
		$get['title'] = 'All Lab Registrations';
		$get['setting'] = $this->setting;
		$this->load->view('admin/register_all', $get);
	}
	public function registerView()
	{
		$id = $this->input->get('id');
		$get['data'] = $this->CommonModel->getSingleRowById('register', "register_id = '$id'");
		$get['variant'] = $this->CommonModel->getRowByMoreId('service_list', "register_id = '$id'");
		$get['services'] = $this->CommonModel->getAllRows('all_service');
		$get['title'] = 'View Lab Details';
		$get['setting'] = $this->setting;
		$this->load->view('admin/register_view', $get);
	}
	public function registerAdd()
	{
		$id = $this->input->get('id');
		$data['services'] = $this->CommonModel->getAllRows('all_service');
		$data['brand'] = $this->CommonModel->getAllRows('all_brand');
		if (isset($id)) {
			$data['title'] = 'Edit Register';
			$decrypt_id = decryptId($id);
			$getReg = $this->CommonModel->getSingleRowById('register', "register_id = '$decrypt_id'");
			$data['variant'] = $this->CommonModel->getRowByMoreId('service_list', "register_id = '$decrypt_id'");
		} else {

			$data['title'] = 'Add Register';
			$getReg = false;
		}
		$data['lab_location'] = set_value('lab_location') == false ? @$getReg['lab_location'] : set_value('lab_location');
		$data['lab_email'] = set_value('lab_email') == false ? @$getReg['lab_email'] : set_value('lab_email');
		$data['lab_contact'] = set_value('lab_contact') == false ? @$getReg['lab_contact'] : set_value('lab_contact');
		$data['lab_name'] = set_value('lab_name') == false ? @$getReg['lab_name'] : set_value('lab_name');
		$data['bank_name'] = set_value('bank_name') == false ? @$getReg['bank_name'] : set_value('bank_name');
		$data['brand_name'] = set_value('brand_name') == false ? @$getReg['brand_name'] : set_value('brand_name');
		$data['ifsc_code'] = set_value('ifsc_code') == false ? @$getReg['ifsc_code'] : set_value('ifsc_code');
		$data['upi_id'] = set_value('upi_id') == false ? @$getReg['upi_id'] : set_value('upi_id');
		if (count($_POST) > 0) {
			// echo '<pre>';
			// print_r($_POST);
			// exit();
			extract($this->input->post());
			$post['lab_location'] = $lab_location;
			$post['lab_email'] = $lab_email;
			$post['lab_contact'] = $lab_contact;
			$post['lab_name'] = $lab_name;
			$post['upi_id'] = $upi_id;
			$post['ifsc_code'] = $ifsc_code;
			$post['bank_name'] = $bank_name;
			$post['brand_name'] = $brand_name;
			$post['slug_title'] = url_title($lab_name, '-', true);
			$post['password'] = $post['slug_title'] . rand(1000, 9999);
			if (isset($id)) {
				$update = $this->CommonModel->updateRowById('register', 'register_id', $decrypt_id, $post);
				$service = $this->input->post('service');
				$charge = $this->input->post('charge');
				$varid = $this->input->post('varid');
				$service_type = $this->input->post('service_type');
				$sizecount = count($service);
				if ($sizecount > 0) {
					for ($i = 0; $i < $sizecount; $i++) {
						$variantdata = [
							'register_id' => (int) decryptId($id),
							'service_type' => $service_type[$i],
							'service' => $service[$i],
							'charge' => (int) $charge[$i],
						];
						if ($service[$i] != '') {
							if ($varid[$i] != '') {
								$this->CommonModel->updateRowByMoreId('service_list', "id = '{$varid[$i]}'", $variantdata);
							} else {
								$this->CommonModel->insertRowReturnId('service_list', $variantdata);
							}
						}
					}
				}
				flashData('errors', 'Produce updated successfully');
			} else {
				$p_id = $this->CommonModel->insertRowReturnIdWithClean('register', $post);
				$service = $this->input->post('service');
				$charge = $this->input->post('charge');
				$service_type = $this->input->post('service_type');

				$sizecount = count($service);
				if ($sizecount > 0) {
					for ($i = 0; $i < $sizecount; $i++) {
						$variantdata = [
							'register_id' => $p_id,
							'service_type' => $service_type[$i],
							'service' => $service[$i],
							'charge' => (int) $charge[$i],
						];
						$this->CommonModel->insertRow('service_list', $variantdata);
					}
				}
				flashData('errors', 'Registration added successfully');
			}

			redirect('registerAll');
		}
		$data['setting'] = $this->setting;
		$this->load->view('admin/register_add', $data);
	}
	public function all_test()
	{
		$id = $this->input->get('id');
		if (isset($id)) {
			$get['title'] = 'Edit Test';
			$decrypt_id = decryptId($id);
			$getReg = $this->CommonModel->getSingleRowById('all_service', "service_id = '$decrypt_id'");
		} else {
			$get['title'] = 'Add Test';
			$getReg = false;
		}
		$get['service_name'] = set_value('service_name') == false ? @$getReg['service_name'] : set_value('service_name');
		// $get['service_type'] = set_value('service_type') == false ? @$getReg['service_type'] : set_value('service_type');
		// $get['service_charge'] = set_value('service_charge') == false ? @$getReg['service_charge'] : set_value('service_charge');
		if (count($_POST) > 0) {
			extract($this->input->post());
			// $post['service_type'] = $service_type;
			$post['service_name'] = $service_name;

			if (isset($id) && !empty($id)) {
				// Ensure proper handling for update
				$this->CommonModel->updateRowById('all_service', 'service_id', $decrypt_id, $post);
				flashData('errors', 'Test updated successfully');
			} else {
				// Insert a new record for Add Test
				$this->CommonModel->insertRowReturnIdWithClean('all_service', $post);
				flashData('errors', 'Test added successfully');
			}
			redirect('testAll');
		}

		$dID = $this->input->get('dID');
		if (isset($dID)) {
			$update = $this->CommonModel->deleteRowById('all_service', ['service_id' => decryptId($dID)]);
			redirect('testAll');
			exit;
		}
		$get['all_service'] = $this->CommonModel->getRowByIdInOrder('all_service', [], 'service_id', 'DESC');
		$get['title'] = 'All Tests';
		$get['setting'] = $this->setting;
		$this->load->view('admin/all_test', $get);
	}
	public function all_brand()
	{
		$id = $this->input->get('id');
		if (isset($id)) {
			$get['title'] = 'Edit Brand';
			$decrypt_id = decryptId($id);
			$getReg = $this->CommonModel->getSingleRowById('all_brand', "brand_id = '$decrypt_id'");
		} else {
			$get['title'] = 'Add Brand';
			$getReg = false;
		}
		$get['brand_name'] = set_value('brand_name') == false ? @$getReg['brand_name'] : set_value('brand_name');
		$get['brand_description'] = set_value('brand_description') == false ? @$getReg['brand_description'] : set_value('brand_description');
		$get['brand_logo'] = set_value('brand_logo') == false ? @$getReg['brand_logo'] : set_value('brand_logo');
		$get['brand_banner'] = set_value('brand_banner') == false ? @$getReg['brand_banner'] : set_value('brand_banner');
		if (count($_POST) > 0) {
			extract($this->input->post());
			$post['brand_name'] = $brand_name;
			$post['brand_description'] = $brand_description;
			$post['create_date'] = date('Y-m-d');
			if (!empty($_FILES['brand_logo']['name'])) {
				$picture = imageUploadWithRatio('brand_logo', CATEGORY_IMAGE, 600, 400, $data['brand_logo']);
				$post['brand_logo'] = $picture;
			}
			if (!empty($_FILES['brand_banner']['name'])) {
				$banner = imageUploadWithRatio('brand_banner', CATEGORY_BANNER, 600, 400, $data['brand_banner']);
				$post['brand_banner'] = $banner;
			}

			if (isset($id) && !empty($id)) {
				$this->CommonModel->updateRowById('all_brand', 'brand_id', $decrypt_id, $post);
				flashData('errors', 'Brand updated successfully');
			} else {
				$this->CommonModel->insertRowReturnIdWithClean('all_brand', $post);
				flashData('errors', 'Brand added successfully');
			}
			redirect('brandAll');
		}
		$dID = $this->input->get('dID');
		if (isset($dID)) {
			$update = $this->CommonModel->deleteRowById('all_brand', ['brand_id' => decryptId($dID)]);
			redirect('brandAll');
			exit;
		}
		$get['all_brand'] = $this->CommonModel->getRowByIdInOrder('all_brand', [], 'brand_id', 'DESC');
		$get['title'] = 'All Brands';
		$get['setting'] = $this->setting;
		$this->load->view('admin/all_brand', $get);
	}
	public function user_all()
	{
		$dID = $this->input->get('dID');
		if (isset($dID)) {
			$delete = $this->CommonModel->deleteRowById('appointment', ['id' => decryptId($dID)]);
			if ($delete) {
				flashMultiData(['success_status' => "success", 'msg' => "Patient Data Deleted"]);
			} else {
				flashMultiData(['success_status' => "error", 'msg' => "Something Went Wrong."]);
			}
			redirect('userAll');
			exit;
		}
		$get['all_service'] = $this->CommonModel->getRowByIdInOrder('all_service', [], 'service_id', 'DESC');
		$get['all_appointments'] = $this->CommonModel->getRowByIdInOrder('appointment', [], 'id', 'DESC');
		$get['title'] = 'Patient Details';
		$get['setting'] = $this->setting;
		$this->load->view('admin/user_all', $get);
	}
	public function prescription()
	{
		$get['prescription_data'] = $this->CommonModel->getRowByIdInOrder('prescription_data', [], 'id', 'DESC');
		$get['title'] = 'Prescription Details';
		$get['setting'] = $this->setting;
		$this->load->view('admin/prescription', $get);
	}
	public function payment_history()
	{
		$get['setting_data'] = $this->CommonModel->getAllRows('settings');
		$get['commission'] = $get['setting_data'][40]['content_value'];
		$get['payment_details'] = $this->CommonModel->getRowByIdInOrder('appointment', "visit_status = '1'", 'id', 'DESC');
		$get['all_service'] = $this->CommonModel->getRowByIdInOrder('all_service', [], 'service_id', 'DESC');
		$get['title'] = 'Payment History';
		$get['setting'] = $this->setting;
		$this->load->view('admin/payment_history', $get);
	}
	public function changePassword()
	{
		$admin_id = $this->session->userdata('admin_id');
		$data['admin'] = $this->CommonModel->getSingleRowById('admin_login', "admin_id = '$admin_id'");
		$stored_password = $data['admin']['password']; // Plain text password

		if ($this->input->post()) {
			$post = $this->input->post();

			// Retrieve form inputs
			$old_password = $post['password'];
			$new_password = $post['new_password'];
			$confirm_password = $post['confirm_password'];

			// Validate old password
			if ($old_password !== $stored_password) {
				flashMultiData(['success_status' => "error", 'msg' => "Old password is incorrect."]);
				redirect($_SERVER['HTTP_REFERER']);
			}

			// Check if new password matches confirm password
			if ($new_password !== $confirm_password) {
				flashMultiData(['success_status' => "error", 'msg' => "New password and confirm password do not match."]);
				redirect($_SERVER['HTTP_REFERER']);
			}
			// Store the new password directly
			$update_data = ['password' => $new_password];

			$update = $this->CommonModel->updateRowById('admin_login', 'admin_id', $admin_id, $update_data);

			if ($update) {
				flashMultiData(['success_status' => "success", 'msg' => "Password Updated Successfully"]);
			} else {
				flashMultiData(['success_status' => "error", 'msg' => "Something went wrong."]);
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
		$data['setting'] = $this->setting;
		$this->load->view('admin/change_password', $data);
	}
	public function setDeliveryCharges()
	{
		extract($this->input->post());
		$get = $this->CommonModel->getSingleRowById('delivery_charge', "delivery_charge_id = '2'");
		$data['min_amount'] = set_value('min_amount') == false ? @$get['min_amount'] : set_value('min_amount');
		$data['amount'] = set_value('amount') == false ? @$get['amount'] : set_value('amount');

		$data['title'] = 'Delivery Charge';
		if (count($_POST) > 0) {
			$this->form_validation->set_rules('min_amount', 'minimum amount', 'trim|required');
			$this->form_validation->set_rules('amount', 'amount', 'trim|required');
			if ($this->form_validation->run()) {
				$getC = $this->CommonModel->getAllRows('delivery_charge');
				$post['min_amount'] = $min_amount;
				$post['amount'] = $amount;
				if ($getC > 0) {
					$updateRow = updateRowById('delivery_charge', 'delivery_charge_id', '2', $post);
					if ($updateRow) {
						flashData('errors', 'Delivery Charges Update Successfully');
					} else {
						flashData('errors', 'Delivery Charges Not Add.');
					}
				} else {
					$insert = $this->CommonModel->insertRow('delivery_charge', $post);
					if ($insert) {
						flashData('errors', 'Delivery Charges Add Successfully');
					} else {
						flashData('errors', 'Delivery Charges Not Add.');
					}
				}
				redirect('setDeliveryCharges');
			}
		}
		$data['setting'] = $this->setting;
		$this->load->view('admin/delivery_charges', $data);
	}
	public function contactdetails()
	{
		extract($this->input->post());
		$get = $this->CommonModel->getSingleRowById('contactdetails', "id = '1'");
		$data['contact_f'] = set_value('contact_f') == false ? @$get['contact_f'] : set_value('contact_f');
		$data['email_f'] = set_value('email_f') == false ? @$get['email_f'] : set_value('email_f');
		$data['location'] = set_value('location') == false ? @$get['location'] : set_value('location');

		$data['title'] = 'Contact Details';
		if (count($_POST) > 0) {
			$this->form_validation->set_rules('contact_f', 'Contact', 'trim|required');
			$this->form_validation->set_rules('email_f', 'Email', 'trim|required');
			$this->form_validation->set_rules('location', 'Address', 'trim|required');
			if ($this->form_validation->run()) {
				$getC = $this->CommonModel->getAllRows('contactdetails');
				$post['contact_f'] = $contact_f;
				$post['email_f'] = $email_f;
				$post['location'] = $location;

				$updateRow = updateRowById('contactdetails', 'id', '1', $post);
				if ($updateRow) {
					flashData('errors', 'Contact Details Update Successfully');
				} else {
					flashData('errors', 'Contact Details  Not update.');
				}

				redirect('contactdetails');
			}
		}
		$data['setting'] = $this->setting;
		$this->load->view('admin/contactdetails', $data);
	}
	public function statusUpdate($user_id, $status)
	{
		if ($status == 1) {
			$post = array('status' => 'accepted');
			$successMessage = 'User Inactive Successfully';
			$getData = $this->CommonModel->getSingleRowById('sub_category', ["sub_category_id" => decryptId($user_id)]);

			// Prepare and send the email only if accepted
			$curdate = date('d-m-Y');

			$data['curdate'] = $curdate;
			$data['lab_name'] = trim($getData['sub_category']);
			$data['lab_email'] = trim($getData['lab_email']);
			$data['password'] = trim($getData['password']);
			$data['login_link'] = base_url('lab-login/');

			$emailContent = $this->load->view('email/status_update', $data, true);
			$sendMail = send_email($getData['lab_email'], 'Registration Verified', $emailContent);

		} else {
			$post = array('status' => 'rejected');
			$successMessage = 'User Active Successfully';
		}

		// Update status in the database
		$update = $this->CommonModel->updateRowById('sub_category', 'sub_category_id', decryptId($user_id), $post);

		// Handle flash messages and redirect
		if ($update) {
			flashData('errors', $successMessage);
		} else {
			flashData('errors', 'Something went wrong. Please try again');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function addFaqs()
	{
		if (isset($_GET['faq'])) {
			$id = $this->input->get('faq');
		} else {
			$id = 0;
		}
		if (isset($_GET['dID'])) {
			$dID = $this->input->get('dID');
		} else {
			$dID = '';
		}

		$sId = decryptId($id);
		$getPlans = getRowById('faqs', 'fid', $sId);
		$data['question'] = set_value('question') == false ? @$getPlans[0]['question'] : set_value('question');
		$data['answer'] = set_value('answer') == false ? @$getPlans[0]['answer'] : set_value('answer');
		if (decryptId($dID) != '') {
			$delete = $this->CommonModel->deleteRowById('faqs', array('fid' => decryptId($dID)));
			redirect(base_url('addFaqs'));
		}

		if (isset($id)) {
			$data['title'] = 'FAQ Edit';
		} else {
			$data['title'] = 'FAQ\'s';
		}
		if (count($_POST) > 0) {
			extract($this->input->post());
			$post['question'] = $question;
			$post['answer'] = $answer;
			if ($id != 0) {

				$post['update_date'] = setDateTime();
				$update = updateRowById('faqs', 'fid', $sId, $post);

				if ($update) {
					flashData('errors', 'FAQ Update Successfully');
				} else {
					flashData('errors', 'Promo code Not Update. please try again');
				}
			} else {

				$post['create_date'] = setDateTime();
				$insert = $this->CommonModel->insertRowReturnId('faqs', $post);

				if ($insert) {
					flashData('errors', 'FAQ Add Successfully');
				} else {
					flashData('errors', 'FAQ Not Add');
				}
			}

			redirect('addFaqs');
		} else {
			$data['setting'] = $this->setting;
			$data['title'] = 'FAQ\'s';
			$this->load->view('admin/faqs', $data);
		}
	}
	public function updateBookProduct()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$order_id = $this->input->post('order_id');
			$sub_category_id = $this->input->post('sub_category_id');
			// Validate input
			if (!$order_id || !$sub_category_id) {
				echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
				return;
			}
			// Prepare data to update
			$updateData = [
				'sub_category_id' => $sub_category_id,
				'update_date' => date('Y-m-d H:i:s') // Add update_date field
			];

			// Update the table
			$update = $this->CommonModel->updateSingleRowById('tbl_book_product', 'order_id', $order_id, $updateData);
			if ($update) {
				echo json_encode(['success' => true, 'message' => 'Lab selected successfully!']);
			} else {
				echo json_encode(['success' => false, 'message' => 'Failed to update. Please try again.']);
			}
		} else {
			echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
		}
	}






	//  ALL REMAINING FUNCTIONS



	public function banner()
	{
		$data['banner'] = $this->CommonModel->getSingleRowById('banner', "banner_id = '1'");
		if (count($_FILES) > 0) {
			$postdata['image_path'] = fullImage('image_path', BANNER_IMAGE, $data['image_path']);
			$update = $this->CommonModel->updateRowById('banner', ['banner_id' => 1], 'catalog_id', $postdata);
			if ($update) {
				flashMultiData(['success_status' => "success", 'msg' => " Banner Update successfully"]);
				redirect('banner');
			} else {
				flashMultiData(['success_status' => "error", 'msg' => "Something went wrong."]);
				redirect('banner');
			}
		}
		$this->load->view('admin/banner', $data);
	}

	public function activeUser()
	{
		$data['title'] = "All Active Users";
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('user_registration', "verify_status = '1' AND user_status = '1'", 'create_date', 'desc');
		$data['is_register'] = 0;
		$this->load->view('admin/users/user_all', $data);
	}
	public function inactiveUser()
	{
		$data['title'] = "All Inactive Users";
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('user_registration', "verify_status = '1' AND user_status = '0'", 'create_date', 'desc');
		$data['is_register'] = 0;
		$this->load->view('admin/users/user_all', $data);
	}
	public function userStatus($user_id, $status)
	{
		if ($status == 1) {
			$post = array('user_status' => '0');
			$msg = 'User inactive successfully';
		} else {
			$post = array('user_status' => '1');
			$msg = 'User active successfully';
		}
		$update = $this->CommonModel->updateRowById('user_registration', 'user_id', decryptId($user_id), $post);
		if ($update) {
			flashData('errors', $msg);
		} else {
			flashData('errors', 'Something went wrong. Please try again');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function productReview()
	{
		$data['title'] = "Product Reviews";
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('product_review', [], 'create_date', 'desc');
		$data['is_register'] = 0;
		$this->load->view('admin/review', $data);
	}
	public function reviewStatus($user_id, $status)
	{
		if ($status == 1) {
			$post = array('status' => 'accepted');
			$msg = 'User inactive successfully';
		} else {
			$post = array('status' => 'rejected');
			$msg = 'User active successfully';
		}
		$update = $this->CommonModel->updateRowById('product_review', 'rid', decryptId($user_id), $post);
		if ($update) {
			flashData('errors', $msg);
		} else {
			flashData('errors', 'Something went wrong. Please try again');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function userDetails($id)
	{
		$data['title'] = "User Details";
		$data['all_data'] = $this->CommonModel->getSingleRowById('user_registration', "user_id = '" . decryptId($id) . "'");
		$this->load->view('admin/users/user_details', $data);
	}
	public function onprocessOrders()
	{
		$data['title'] = ' Orders Onprocess';
		$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "status = '10'", 'create_date', 'DESC');
		$this->load->view('admin/orders', $data);
	}
	public function recentOrders()
	{
		$data['title'] = 'Recent Orders';
		$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_status = '0' AND status != '10'", 'create_date', 'DESC');
		$this->load->view('admin/orders', $data);
	}
	public function acceptOrder()
	{
		$estimated_time = $this->input->post('estimated_time');
		$estimated_date = $this->input->post('estimated_date');
		$id = $this->input->post('id');
		if ($estimated_time != '' and $id != '') {
			$update = $this->CommonModel->updateRowById('book_product', 'product_book_id', decryptId($id), array('booking_status' => '1', 'estimated_time' => $estimated_date . ' ' . date('h:i A', strtotime($estimated_time))));
			flashData('errors', 'Order accept successfully');
		} else {
			flashData('errors', 'Something went wrong.');
		}
		redirect('recentOrders');
	}
	public function cancelOrder()
	{
		$cancel_msg = $this->input->post('cancel_msg');
		$id = $this->input->post('id');
		if ($cancel_msg != '' and $id != '') {
			$update = $this->CommonModel->updateRowById('book_product', 'product_book_id', decryptId($id), array('booking_status' => '2', 'cancel_message' => $cancel_msg, 'cancel_by' => 'Admin', 'cancel_date' => date('d.m.Y')));
			flashData('errors', 'Order Cancel successfully');
		} else {
			flashData('errors', 'Something went wrong.');
		}
		redirect('recentOrders');
	}
	public function acceptedOrders()
	{
		$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_status = '1' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')", 'create_date', 'DESC');
		$data['title'] = 'All Accepted Orders';
		$this->load->view('admin/orders', $data);
	}
	public function dispatchOrder($id, $type)
	{
		if ($type == '3') {
			$post['booking_status'] = '3';
			$message = "Order Dispatch successfully";
		} else {
			$post['booking_status'] = '4';
			$post['order_complete_date'] = setDateTime();
			$message = "Order Complete successfully";
		}

		$update = $this->CommonModel->updateRowById('book_product', 'product_book_id', decryptId($id), $post);

		$checkoutdata = $this->CommonModel->getSingleRowById('book_product', ['product_book_id' => decryptId($id)]);
		$post = $this->CommonModel->getRowById('book_item', 'order_id', $checkoutdata['order_id']);

		foreach ($post as $items):
			$product = $this->CommonModel->getRowByIdfield('product', 'product_id', $items['product_id'], array('product_id', 'sale_price', 'product_name', 'quantity_type'));
			$imgdata = getSingleRowById('product_image', array('product_id' => $items['product_id']));
			$mydata[] = array(
				'create_date' => setDateTime(),
				'order_id' => $checkoutdata['order_id'],
				'no_of_items' => $items['qty'],
				'base_price' => $items['base_price'],
				'user_price' => $items['user_price'],
				'booking_price' => ($items['booking_price'] * $items['no_of_items']),
				'product_id' => $items['product_id'],
				'product_img' => $imgdata['image_path'],
				'gst_amt' => $items['gst_amt'],
				'product_name' => clean($product[0]['product_name']),
			);


		endforeach;



		$invoice = ['orderlist' => ['orderDate' => $checkoutdata['create_date'], 'order_id' => $checkoutdata['order_id'], 'name' => $checkoutdata['name'], 'number' => $checkoutdata['contact_no'], 'email' => $checkoutdata['email'], 'grand_total' => $checkoutdata['final_amount']], 'order' => $checkoutdata, 'products' => $mydata, 'contact' => $this->contact];
		mailmsg($checkoutdata['email'], 'Order Dispatched - SVGH Healthcare pvt ltd', $this->load->view('invoice-mail', $invoice, true));

		flashData('errors', $message);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function dispatchOrders()
	{
		$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_status = '3' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')", 'create_date', 'DESC');
		$data['title'] = 'All Dispatch Orders';
		$this->load->view('admin/orders', $data);
	}
	public function completedOrders()
	{
		$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_status = '4' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')", 'create_date', 'DESC');
		$data['title'] = 'All Completed Orders';
		$this->load->view('admin/orders', $data);
	}
	public function cancelOrders()
	{
		$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_status = '2' AND (payment_mode = '1' OR payment_mode = '2')", 'create_date', 'DESC');
		$data['title'] = 'All Cancel Orders';
		$this->load->view('admin/orders', $data);
	}
	public function allOrders()
	{
		$date = $this->input->get('date');
		if ($date != "") {
			$data['allOrders'] = $this->CommonModel->getRowByIdInOrder('book_product', "booking_date = '" . date('Y-m-d', strtotime($date)) . "'", 'create_date', 'DESC');
		} else {
			$data['allOrders'] = $this->CommonModel->getAllRowsInOrder('book_product', 'product_book_id', 'DESC');
		}
		$data['title'] = 'All Orders';
		$this->load->view('admin/all_orders', $data);
	}
	public function shiprocket($id)
	{
		$data['favicon'] = base_url() . 'assets/images/favicon.png';
		$data['title'] = "Shiprocket Status";
		$data['checkout'] = $this->CommonModel->getSingleRowById('book_product', ['product_book_id' => $id]);
		$data['checkoutProduct'] = $this->CommonModel->getRowById('book_item', 'order_id', $data['checkout']['order_id']);
		if (count($_POST) > 0) {
			// echo '<pre>';
			// step 1 - generate token
			$post = $this->input->post();
			$token = generateToken();
			$ship_product = array();
			if (!empty($data['checkoutProduct'])) {
				foreach ($data['checkoutProduct'] as $row) {
					$product = $this->CommonModel->getSingleRowById('product', ['product_id' => $row['product_id']]);
					$prod = array(
						"name" => $product['product_name'],
						"sku" => $product['product_id'],
						"units" => (int) $row['no_of_items'],
						"selling_price" => (int) $row['booking_price'],
						"discount" => "",
						"tax" => "",
						"hsn" => $product['hsncode'],
						"cgst" => 123,
						"sgst" => 123
					);
					array_push($ship_product, $prod);
				}
			}
			// step 2 - create order
			$shiprocket = createOrder($id, setDateOnly(), $data['checkout']['name'], $data['checkout']['address'], $data['checkout']['city'], $data['checkout']['postal_code'], $data['checkout']['state'], 'India', $data['checkout']['email'], $data['checkout']['contact_no'], (($data['checkout']['payment_mode'] == '0') ? 'COD' : 'Prepaid'), $data['checkout']['final_amount'], $post['length'], $post['breadth'], $post['height'], $post['weight'], ($ship_product), $token);
			$sh = json_decode($shiprocket);
			if ($sh->shipment_id != '') {
				$this->CommonModel->updateRowById('book_product', 'product_book_id', $id, array('status' => '1', 'shipment_id' => $sh->shipment_id));
				$this->session->set_userdata('msg', '<div class="alert alert-danger">Shipment ID is generated and is been saved in shiprocket with id no. ' . $sh->shipment_id . '</div>');
			} else {
				$this->session->set_userdata('msg', '<div class="alert alert-danger">Shipment Id is not created , kindly refer SHiprocket panel for this query.</div>');
			}
			// => step 3 - get recommended courier company
			// $shipping = shipping_charges('123401', $data['checkout']['pincode'], $data['checkout']['weight'], '0', $token, '0');
			// $arr = json_decode($shipping);

			// print_r($arr);
			// if ($arr->status_code != '') {
			//     $arrs = [];
			// } else {
			//     foreach ($arr->data->available_courier_companies as $company) {
			//         if ($company->courier_company_id == $arr->data->recommended_courier_company_id) {
			//             $arrs = array('rate' => $company->rate, 'courier_id' => $company->courier_company_id);
			//         }
			//     }
			// }

			// => assign awb(air way bill)
			// $awb = generateAwb_ship($sh->shipment_id, (($arrs['courier_id'] != '') ? $arrs['courier_id'] : $data['checkout']['courier_id']), $token);
			// $awb_data = json_decode($awb);

			// $post['shiprocket_order_id'] = $sh->order_id;
			// $post['shipment_id'] = $sh->shipment_id;

			// if ($awb_data->awb_assign_status == 1) {
			//     $post['awb_code'] = $awb_data->response->data->awb_code;
			//     $post['awb_assign_status'] = $awb_data->awb_assign_status;
			//     $post['awb_pickup'] = $awb_data->response->data->pickup_scheduled_date;
			//     $post['awb_response'] = $awb;
			//     $post['order_response'] = $shiprocket;
			//     $post['status'] = '5';
			// 	echo 'aws';
			// 	print_r($post);
			//     $insert = $this->CommonModel->updateRowById('book_product', 'product_book_id', $id, $post);
			//     if ($insert) {
			//         $this->session->set_userdata('msg', '<div class="alert alert-success">Order is ready  for shipment.Pickup is scheduled on ' . $awb_data->response->data->pickup_scheduled_date . ' by ' . $awb_data->response->data->courier_name . '</div>');
			//         // redirect(base_url('shiprocket_track/' . $id));
			//     } else {
			//         $this->session->set_userdata('msg', '<div class="alert alert-danger">Order is now Initiated via shiprocket. Contact Shiprocket for any assistance. </div>');
			//         // redirect(base_url('shiprocket/' . $id));
			//     }
			// } else {
			// 	echo 'non aws';
			// 	print_r($post);
			//     $insert = $this->CommonModel->updateRowById('book_product', 'product_book_id', $id, $post);
			//     if ($awb_data->message != '') {
			//         $this->session->set_userdata('msg', '<div class="alert alert-danger">' . $awb_data->message . '</div>');
			//     } else {

			//         if ($awb_data->response->data->awb_assign_error != '') {
			//             // echo $awb_data->response->data->awb_assign_error;
			//             $this->session->set_userdata('msg', '<div class="alert alert-danger">' . $awb_data->response->data->awb_assign_error . '</div>');
			//         } else {
			//             $this->session->set_userdata('msg', '<div class="alert alert-danger">AWB Not generated , kindly refer SHiprocket panel for this query.</div>');
			//         }
			//     }
			//     // exit();
			//     // redirect(base_url('shiprocket/' . $id));
			// }
			// print_r($_SESSION);
			// exit;
		} else {
		}
		$this->load->view('admin/shiprocket_order', $data);
	}
	public function categoryFeatured($id, $featured)
	{

		$categoryData = ['featured' => $featured];
		$update = $this->CommonModel->updateRowById('category', 'category_id', decryptId($id), $categoryData);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function policy()
	{
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('policy', [], 'create_date', 'DESC');
		$data['title'] = 'All Policy';
		$data['setting'] = $this->setting;
		$this->load->view('admin/policy', $data);
	}
	public function policyedit($id)
	{
		// 		$id = $this->input->get('id');
		$decrypt_id = decryptId($id);

		if (isset($id)) {
			$data['title'] = 'Edit Policy';
			$getProduct = $this->CommonModel->getSingleRowById('policy', "ppid = '$decrypt_id'");
		} else {
			$data['title'] = 'Add Policy';
			$getProduct = false;
		}

		$data['particulars'] = set_value('particulars') == false ? @$getProduct['particulars'] : set_value('particulars');
		$data['title_policy'] = set_value('title_policy') == false ? @$getProduct['title_policy'] : set_value('title_policy');

		if (count($_POST) > 0) {
			$post = ($this->input->post());
			if (isset($id)) {
				$update = $this->CommonModel->updateRowById('policy', 'ppid', $decrypt_id, $post);
				flashData('errors', 'Policy update successfully');
			}
			// 			else {
			// 				$p_id = $this->CommonModel->insertRowReturnIdWithClean('policy', $post);
			// 			}
			redirect('policy');
		}
		$this->load->view('admin/policyedit', $data);
	}
	public function totalVisiters()
	{
		$data['title'] = "Total Visiters";
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('post_pageviews_month', [], 'created_at', 'desc');
		$this->load->view('admin/totalVisiters', $data);
	}
	public function setting()
	{
		$data['setting_data'] = $this->CommonModel->getAllRowsInOrder('setting', 'id', 'DESC');
		$data['title'] = 'Setting info';
		// 		$data['setting'] = $this->setting;
		if (count($_POST) > 0) {
			$post = $this->input->post();

			if ($post['value_type'] == 'file') {
				$post['particular_value'] = imageUpload('record_value', 'upload/setting', '');
				$post['particular_value'] = 'upload/setting/' . $post['particular_value'];
			} else {
				$post['particular_value'] = $post['record_value'];
			}
			$id = $post['record'];
			unset($post['record']);
			unset($post['record_value']);
			$update = $this->CommonModel->updateRowById('setting', 'id', $id, $post);
			flashData('errors', ' Update Successfully');
			redirect('setting');
		}
		$data['setting'] = $this->setting;
		$this->load->view('admin/settings', $data);
	}
	public function appointments()
	{
		$BdID = $this->input->get('dID');
		if (decryptId($BdID) != '') {
			$delete = $this->CommonModel->deleteRowById('appointment_list', array('id' => decryptId($BdID)));
			if ($delete) {
				flashMultiData(['success_status' => "success", 'msg' => "Appointment Query Deleted"]);
			} else {
				flashMultiData(['success_status' => "error", 'msg' => "Something Went Wrong."]);
			}
			redirect('appointment-list');
			exit;
		}
		$get['all_appointments'] = $this->CommonModel->getRowByIdInOrder('tbl_book_product', [], 'product_book_id', 'DESC');
		$get['all_labs'] = $this->CommonModel->getRowByIdInOrder('sub_category', [], 'sub_category_id', 'DESC');
		// Check if there is any data in the zeroth index
		if (!empty($get['all_appointments'])) {
			foreach ($get['all_appointments'] as $appointment) { 
				$orderId = $appointment['order_id']; 

				$getPro = $this->CommonModel->getSingleRowById('book_item', ['order_id' => $orderId]);
				if (!empty($getPro)) {
					$proId = $getPro['product_name']; 

					$get['productName'][] = $this->CommonModel->getSingleRowById('all_service', ['service_id' => $proId]);
				} else {
					$get['productName'][] = "No product found for order ID: $orderId";
				}
			}
		} else {
			echo "No appointments found.";
		}

		$get['title'] = 'AHCS | All Appointment List';
		$get['setting'] = $this->setting;
		$this->load->view('admin/appointments', $get);
	}

	public function sendnotification()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$contactno = $_POST['contactno'];
			$message = $_POST['message'];
			$respo = sendOTP($contactno, $message);
			if ($respo) {
				echo json_encode(['status' => 'success']);
			} else {
				echo json_encode(['status' => 'failed']);
			}
		}
	}
	public function statusrefunded($id, $status)
	{
		$update = $this->CommonModel->updateRowById('book_product', 'product_book_id', decryptId($id), array('is_refunded' => $status));
		flashData('errors', ' Update Successfully');
		redirect('cancelOrders');
	}
}
