<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function setDateTime()
{
	return date('Y-m-d H:i:s');
}

function setDateOnly()
{
	return date('Y-m-d');
}

function clean($string)
{
	return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);
}

function dateConvertToView($date, $type = 2)
{
	if ($type == 1) {
		return date('d-M-Y', strtotime($date));
	} else {
		return date('d-M-Y h:i A', strtotime($date));
	}
}

function dateConvertToDb($date)
{
	return date('Y-m-d', strtotime($date));
}

function sessionId($id)
{
	$ci = &get_instance();
	return $ci->session->userdata($id);
}

function setSession($data)
{
	$ci = &get_instance();
	return $ci->session->set_userdata($data);
}

function setAlert($title, $alert_type, $message)
{
	$ci = &get_instance();
	return $ci->session->set_flashdata('alert_errors', ['title' => $title, 'color' => $alert_type, 'message' => $message]);
}

function insertRow($table, $data)
{
	$ci = &get_instance();
	$clean = $ci->security->xss_clean($data);
	return $ci->db->insert($table, $clean);
}

function returnId($table, $data)
{
	$ci = &get_instance();
	$ci->db->insert($table, $data);
	return $ci->db->insert_id();
}

function randomCode($length_of_string)
{
	$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr(str_shuffle($str_result), 0, $length_of_string);
}

function getRowById($table, $column, $id)
{
	$ci = &get_instance();
	$get = $ci->db->get_where($table, array($column => $id));
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function getSingleRowById($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		return $get->row_array();
	} else {
		return false;
	}
}

function getAllRow($table)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function updateRowById($table, $column, $id, $data)
{
	$ci = &get_instance();
	$clean = $ci->security->xss_clean($data);
	$query = $ci->db->where($column, $id)
		->update($table, $clean);
	return $ci->db->affected_rows();
}

function deleteRowById($table, $column, $id)
{
	$ci = &get_instance();
	$ci->db->where($column, $id);
	$ci->db->delete($table);
	if ($ci->db->affected_rows() > 0) {
		return true;
	} else {
		return $ci->db->error();
	}
}

function deleteRowMoreId($table, $where)
{
	$ci = &get_instance();
	$ci->db->where($where);
	$ci->db->delete($table);
	if ($ci->db->affected_rows() > 0) {
		return true;
	} else {
		return $ci->db->error();
	}
}

function getAllRowInOrder($table, $column, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($column, $type)->get($table);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}

function getRowsByMoreIdWithOrder($table, $where, $column, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($column, $type)->get_where($table, $where);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}
function getRowsByMoreIdWithOrderlimit($table, $where, $column, $type, $limit)
{
	$ci = &get_instance();
	$select = $ci->db->limit($limit)->order_by($column, $type)->get_where($table, $where);
	if ($select->num_rows() > 0) {
		return $select->result_array();
	} else {
		return false;
	}
}

function getDataByIdInOrder($table, $column, $id, $orderColumn, $type)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->get_where($table, array($column => $id));
	return $select->result_array();
}

function getAllDataWithLimitInOrder($table, $orderColumn, $type, $start, $end)
{
	$ci = &get_instance();
	$select = $ci->db->order_by($orderColumn, $type)->limit($start, $end)->get($table);
	return $select->result_array();
}

function getRowByMoreId($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function getNumRows($table, $where)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->get();
	return $get->num_rows();
}

function getRowByLikeInOrder($table, $where, $like, $name, $orderBy, $orderType)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from($table)
		->where($where)
		->like($like, $name, 'both')
		->order_by($orderBy, $orderType)
		->get();
	if ($get->num_rows() > 0) {
		return $get->result_array();
	} else {
		return false;
	}
}

function encryptId($id)
{
	$ci = &get_instance();
	$key = base64_encode($id);
	return $key;
}

function decryptId($key)
{
	$ci = &get_instance();
	$id = base64_decode($key);
	return $id;
}

function lastReplace($search, $replace, $subject)
{
	$pos = strrpos($subject, $search);
	if ($pos !== false) {
		$subject = substr_replace($subject, $replace, $pos, strlen($search));
	}
	return $subject;
}

function getSumInRow($table, $where, $sumColumn)
{
	$ci = &get_instance();
	$get = $ci->db->select_sum($sumColumn)
		->from($table)
		->where($where)
		->get();
	if ($get->num_rows() > 0) {
		$total = $get->row_array();
		return $total[$sumColumn];
	} else {
		return false;
	}
}

function dateDiffInDays($date1, $date2)
{
	$diff = strtotime($date2) - strtotime($date1);
	return abs(round($diff / 86400));
}

function flashData($var, $message)
{
	$ci = &get_instance();
	return $ci->session->set_flashdata($var, $message);
}



function getUserId($token)
{
	$ci = &get_instance();
	$ip = $ci->input->ip_address();
	$get = $ci->db->select()
		->from('user_registration')
		->where("user_registration.user_id = '" . $token['data']->id . "' AND user_status = '1' AND unique_hash = '" . $token['data']->unique_hash . "'")
		->get();
	if ($get->num_rows() > 0) {
		return $get->row_array();
	} else {
		return false;
	}
}

function orderIdGenerateUser()
{
	$number = "TXN" . date('ydmhis');
	if (checkOrderIdExistUser($number)) {
		return orderIdGenerateUser();
	} else {
		return $number;
	}
}

function checkOrderIdExistUser($number)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from('book_product')
		->where("order_id = '$number'")
		->get();
	if ($get->num_rows() > 0) {
		return true;
	} else {
		return false;
	}
}

function isStatusActive($status)
{
	global $bookingStatus;
	return in_array($bookingStatus, $status);
}

function referralCode()
{
	$number = 'SM-' . rand(9999, 99999);
	if (checkReferralCodeExist($number)) {
		return referralCode();
	} else {
		return $number;
	}
}

function checkReferralCodeExist($number)
{
	$ci = &get_instance();
	$get = $ci->db->select()
		->from('students')
		->where("student_id = '$number'")
		->get();
	if ($get->num_rows() > 0) {
		return true;
	} else {
		return false;
	}
}

function multi_array_search($search_for, $search_in)
{
	foreach ($search_in as $element) {
		if (($element === $search_for) || (is_array($element) && multi_array_search($search_for, $element))) {
			return $element;
		}
	}
	return false;
}

function searchForId($column, $id, $array)
{
	if (!empty($array)) {
		foreach ($array as $key => $val) {
			if ($val[$column] === $id) {
				return $array[$key];
			}
		}
	}
	return false;
}

function imageUpload($imageName, $path, $temp_image)
{
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	$ci = &get_instance();
	$config['file_name'] = uniqid();
	$config['allowed_types'] = 'jpg|png|jpeg|webp';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		// $configi['width'] = 380;
		// $configi['height'] = 260;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
// 		$ci->image_lib->resize();
		if ($temp_image != "") {
			unlink($target_path . '/' . $temp_image);
		}
		return $picture;
	} else {
		return false;
		// return $ci->upload->display_errors();
	}
}
function imageWithpdfUpload($imageName, $path, $temp_image)
{
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	$ci = &get_instance();
	$config['file_name'] = uniqid();
	$config['allowed_types'] = 'jpg|png|jpeg|webp|pdf';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		// $configi['width'] = 380;
		// $configi['height'] = 260;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
// 		$ci->image_lib->resize();
		if ($temp_image != "") {
			unlink($target_path . '/' . $temp_image);
		}
		return $picture;
	} else {
		return false;
		// return $ci->upload->display_errors();
	}
}


function upload_video($input_name, $upload_path)
{
	$CI = &get_instance();

	// Set up upload configuration
	$config['upload_path']      = $upload_path;
	$config['allowed_types']    = 'mp4|mov|avi|wmv'; // Add more video formats if necessary
	$config['max_size']         = 20480; // Max size in kilobytes (20MB)
	$config['file_ext_tolower'] = TRUE;
	$CI->load->library('upload', $config);

	if (!$CI->upload->do_upload($input_name)) {
		// If upload fails, return error message
		return 'error';
		// return $CI->upload->display_errors();
	} else {
		// If upload is successful, return file data
		return $CI->upload->data();
	}
}


function imageUploadWithRatio($imageName, $path, $width, $height, $temp_image)
{
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	$ci = &get_instance();
	$config['file_name'] = uniqid();
	$config['allowed_types'] = 'jpg|png|jpeg|webp';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		$configi['image_library'] = 'gd2';
		$config['quality'] = '100%';
		$config['create_thumb'] = FALSE;
		$configi['source_image'] = $path;
		$configi['new_image'] = $target_path;
		$configi['maintain_ratio'] = TRUE;
		$configi['width'] = $width;
		$configi['height'] = $height;
		$ci->load->library('image_lib');
		$ci->image_lib->initialize($configi);
		$ci->image_lib->resize();
		if ($temp_image != "") {
			unlink($target_path . '/' . $temp_image);
		}
		return $picture;
	} else {
		return false;
	}
}

function fullImage($imageName, $path, $temp_image = '')
{
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	$ci = &get_instance();
	$config['file_name'] = uniqid();
	$config['allowed_types'] = '*';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		if ($temp_image != "") {
			unlink($target_path . '/' . $temp_image);
		}
		return $picture;
	} else {
		// return false;
		return $ci->upload->display_errors();
	}
}

function documentUpload($imageName, $path, $temp_image)
{
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	$ci = &get_instance();
	$config['file_name'] = uniqid();
	$config['allowed_types'] = '*';
	$config['upload_path'] = $path;
	$target_path = $path;
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);
	if ($ci->upload->do_upload($imageName)) {
		$data = array('upload_data' => $ci->upload->data());
		$path = $data['upload_data']['full_path'];
		$picture = $data['upload_data']['file_name'];
		if ($temp_image != "") {
			unlink($target_path . '/' . $temp_image);
		}
		return $picture;
	} else {
		// return false;
		return $ci->upload->display_errors();
	}
}

function compressImage($file, $path, $temp_file_name)
{
	$image_parts = explode(";base64,", $file);
	$image_base64 = base64_decode($image_parts[1]);
	$file_name = uniqid() . '.png';
	$aadhaarB =  $path . $file_name;
	file_put_contents($aadhaarB, $image_base64);
	if ($temp_file_name != "") {
		unlink($path . $temp_file_name);
	}
	return $file_name;
}

function curlResponse($url, $dataArray)
{
	$ch = curl_init();
	$url =  $url;
	$data = http_build_query($dataArray);
	$getUrl = $url . "?" . $data;
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_URL, $getUrl);
	curl_setopt($ch, CURLOPT_TIMEOUT, 80);
	$response = curl_exec($ch);
	return json_decode($response, true);
}

function multi_array_in_search($column, $id, $array)
{
	if (!empty($array)) {
		$i = 0;
		foreach ($array as $key => $val) {
			$val['total_user'] =  ++$i;
			if ($val[$column] === $id) {
				return $val;
			}
		}
	}
	return false;
}

function setImage($image_nm, $location)
{
	if ($image_nm != '') {
		if (file_exists(FCPATH . $location . $image_nm)) {
			return base_url() . $location . $image_nm;
		} else {
			return base_url() . 'assets/images/NO-IMAGE.png';
		}
	} else {
		return base_url() . 'assets/images/NO-IMAGE.png';
	}
}


function mailmsg($to, $subject, $message)
{
	$config['protocol']    = 'smtp';
	// $config['smtp_crypto'] = 'ssl';
	$config['smtp_host']    = 'mail.webangeltech.com';
	$config['smtp_port']    = '465';
	$config['smtp_timeout'] = '8';
	$config['smtp_user']    = 'svgh@webangeltech.com';
	$config['smtp_pass']    = 'svgh@2023';	
	$config['charset']    = 'utf-8';
	$config['newline']    = "\n";
	$config['mailtype'] = 'html';
	$config['validation'] = TRUE;

	$ci = &get_instance();
	$ci->email->initialize($config);
	$ci->email->from('svgh@webangeltech.com', 'Care 1');
	$ci->email->to($to);
	$ci->email->cc($to);
	$ci->email->bcc($to);
	$ci->email->subject($subject);
	$ci->email->message($message);
	$ci->email->send();
}

function send_email($to, $subject, $message)
{
	// Load email library
	$CI = &get_instance();
	$CI->load->library('email');

	// Set email config
	$config['protocol'] = 'smtp'; // You can also use 'mail', 'sendmail', or 'smtp'
	$config['smtp_host'] = 'smtp.hostinger.com'; // Your SMTP server address
	$config['smtp_user'] = 'info@care1.in'; // Your SMTP username
	$config['smtp_pass'] = 'Careinfo@mail#2024'; // Your SMTP password
	$config['smtp_port'] = 587; // Your SMTP port, typically 587 or 25
	$config['charset'] = 'utf-8';
	$config['mailtype'] = 'html'; // Set email format to HTML
	$config['newline'] = "\r\n";

	$CI->email->initialize($config);

	// Set email parameters
	$CI->email->from('info@care1.in', 'Care 1');
	$CI->email->to($to);
	$CI->email->subject($subject);
	$CI->email->message($message);

	// Send email
	if ($CI->email->send()) {
		return true; // Email sent successfully
	} else {
		return false; // Email sending failed
	}
}



function payangel($post)
{
	// $post['name'] = 'name';
	// $post['email_id'] = 'harshamarvi@gmail.com';
	// $post['contact_no'] = '9516354018';
	// $post['payment_title'] = 'Payment';
	// $post['payment_description'] = 'Package Desc';
	// $post['payment_amount'] = 1000;
	// $post['order_id'] = 'ORD1112233';
	// $post['redirect_url'] = base_url().'payment_msg';

	$post_json = json_encode($post);
	$encrypt_payload = base64_encode($post_json);

	$hash = hash('sha256', $encrypt_payload . "/pay" . 'EDG8RC745BXMOW1') . '###';

	$headers = array(
		"X-VERIFY: $hash"
	);

	$post['api_key'] = 'SQYANWBUE13GMRFZPOCHVX4D7';

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, 'https://payment.webangeltech.com/paymentInitiate');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

	$response = curl_exec($curl);
	curl_close($curl);

	// return $response;
	$check_resp = json_decode($response, true);
	redirect($check_resp['data']['redirect_url']);
}
// shiprocket apis


function generateToken()
{
	$data = getSingleRowById('shiprocket_token', "`datestamp` > now() - interval 48 hour");
	if (!empty($data)) {

		return $data['token'];
	} else {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode(array('email' => 'hkhatod68@gmail.com', 'password' => 'Ruchirk143@')),
			// CURLOPT_POSTFIELDS => json_encode(array('email' => 'developerhm@outlook.com', 'password' => 'Owner@123#')),
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json"
			),
		));

		$result1 = curl_exec($curl);
		curl_close($curl);
		$result1_out = json_decode($result1);
		$data = insertRow('shiprocket_token', array('token' => $result1_out->{'token'}));
		return $result1_out->{'token'};
	}
}

function createOrder($order_id, $order_date, $billing_customer_name, $billing_address, $billing_city, $billing_pincode, $billing_state, $billing_country, $billing_email, $billing_phone, $payment_method, $sub_total, $length, $breadth, $height, $weight, $product, $token)
{
	$pickup_location = "svgh health care pvt ltd";

	$data = array(
		"order_id" => $order_id,
		"order_date" => $order_date,
		"pickup_location" => $pickup_location,
		"channel_id" => "",
		"comment" => "",
		"reseller_name" => "",
		"company_name" => "",
		"billing_customer_name" => $billing_customer_name,
		"billing_last_name" => "",
		"billing_address" => $billing_address,
		"billing_address_2" => "",
		"billing_isd_code" => "",
		"billing_city" => $billing_city,
		"billing_pincode" => $billing_pincode,
		"billing_state" => $billing_state,
		"billing_country" => $billing_country,
		"billing_email" => $billing_email,
		"billing_phone" => $billing_phone,
		"billing_alternate_phone" => "",
		"shipping_is_billing" => true,
		"shipping_customer_name" => $billing_customer_name,
		"shipping_last_name" => "",
		"shipping_address" => $billing_address,
		"shipping_address_2" => "",
		"shipping_city" => "",
		"shipping_pincode" => "",
		"shipping_country" => "",
		"shipping_state" => "",
		"shipping_email" => "",
		"shipping_phone" => "",
		"order_items" => $product,
		"payment_method" => "Prepaid",
		"shipping_charges" => "",
		"giftwrap_charges" => "",
		"transaction_charges" => "",
		"total_discount" => "",
		"sub_total" => $sub_total,
		"length" => $length,
		"breadth" => $breadth,
		"height" => $height,
		"weight" => $weight,
		"ewaybill_no" => "",
		"customer_gstin" => "29ABCDE1234F2Z5",
		"invoice_number" => "",
		"order_type" => "",
	);
	// print_r( json_encode($data));
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer " . $token
		),
	));

	$result1 = curl_exec($curl);
	curl_close($curl);

	return $result1;
}
function generateAwb_ship($shipment_id, $courier_id, $token)
{
	$data = array(
		"shipment_id" => $shipment_id,
		"courier_id" => $courier_id
	);
	print_R($data);
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/assign/awb",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer " . $token
		),
	));
	$result1 = curl_exec($curl);
	curl_close($curl);
	return $result1;
}

function generateAwb($shipment_id, $courier_id, $token, $is_return = 0)
{
	$data = array(
		"shipment_id" => $shipment_id,
		"courier_id" => $courier_id,
		"is_return" => $is_return
	);
	print_R($data);
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/assign/awb",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer " . $token
		),
	));
	$result1 = curl_exec($curl);
	curl_close($curl);
	return $result1;
}

function shipping_charges($pickup_postcode, $delivery_postcode, $weight, $cod, $token, $is_return = 0)
{
	$data = array(
		"pickup_postcode" => $pickup_postcode,
		"delivery_postcode" => $delivery_postcode,
		"weight" => $weight,
		"cod" => $cod,
		"is_return" => $is_return
	);
	$curl = curl_init();
	$query = http_build_query($data);
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/serviceability?$query",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer " . $token
		),
	));
	$result1 = curl_exec($curl);
	curl_close($curl);
	return $result1;
}

function shipping_charges_checkout($pickup_postcode, $delivery_postcode, $weight, $cod, $token)
{
	$data = array(
		"pickup_postcode" => $pickup_postcode,
		"delivery_postcode" => $delivery_postcode,
		"weight" => $weight,
		"cod" => $cod
	);
	$curl = curl_init();
	$query = http_build_query($data);
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/serviceability?$query",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer " . $token
		),
	));
	$result1 = curl_exec($curl);
	curl_close($curl);
	return $result1;
}

function cancelorder($order_id, $token)
{

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/cancel",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode(array("ids" => array($order_id))),
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer " . $token
		),
	));
	$result1 = curl_exec($curl);
	curl_close($curl);
	return $result1;
}

function cancelshipment($awbs, $token)
{

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/cancel/shipment/awbs",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode(array("awbs" => array($awbs))),
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer " . $token
		),
	));
	$result1 = curl_exec($curl);
	curl_close($curl);
	return $result1;
}

function returnOrder($order_id, $order_date, $channel_id, $pickup_customer_name, $pickup_address, $pickup_city, $pickup_state, $pickup_pincode, $pickup_email, $pickup_phone, $sub_total, $length, $breadth, $height, $weight, $product, $token)
{
	$pickup_location = "House No -748-p, sector 18, Distt-Rewari, Haryana";
	$data = array(
		"order_id" => $order_id,
		"order_date" => $order_date,
		"channel_id" => $channel_id,
		"pickup_customer_name" => $pickup_customer_name,
		"pickup_last_name" => "",
		"company_name" => "Vedicos",
		"pickup_address" => $pickup_address,
		"pickup_address_2" => "",
		"pickup_city" => $pickup_city,
		"pickup_state" => $pickup_state,
		"pickup_country" => "India",
		"pickup_pincode" => $pickup_pincode,
		"pickup_email" => $pickup_email,
		"pickup_phone" => $pickup_phone,
		"pickup_isd_code" => "91",
		"shipping_customer_name" => "Vedicos",
		"shipping_last_name" => "",
		"shipping_address" => $pickup_location,
		"shipping_address_2" => "",
		"shipping_city" => "Rewari",
		"shipping_country" => "India",
		"shipping_pincode" => 123401,
		"shipping_state" => "Haryana",
		"shipping_email" => "vedicos.in@gmail.com",
		"shipping_isd_code" => "91",
		"shipping_phone" => 9812347716,
		"order_items" => $product,
		"payment_method" => "PREPAID",
		"total_discount" => "0",
		"sub_total" => $sub_total,
		"length" => $length,
		"breadth" => $breadth,
		"height" => $height,
		"weight" => $weight
	);
	print_r(json_encode($data));
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/return",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer " . $token
		),
	));

	$result1 = curl_exec($curl);
	curl_close($curl);
	return $result1;
}

function pickup_schedule($shipment_id, $pickup_date, $token)
{
	$data = array(
		"shipment_id" => $shipment_id,
		"pickup_date" => $pickup_date
	);
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/generate/pickup",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer " . $token
		),
	));
	$result1 = curl_exec($curl);
	curl_close($curl);
	return $result1;
}
// File to store the hit count


// Function to increase hit count
function increase_hit_count()
{
	// Open the file for reading and writing
	$file = "hitcount.txt";
	$handle = fopen($file, 'r+');

	// Lock the file for exclusive writing
	if (flock($handle, LOCK_EX)) {
		// Read the current hit count
		$count = intval(fread($handle, filesize($file)));

		// Increase the hit count
		$count++;

		// Rewind the file pointer to the beginning
		rewind($handle);

		// Write the new hit count to the file
		fwrite($handle, $count);

		// Release the lock
		flock($handle, LOCK_UN);
	}

	// Close the file
	fclose($handle);

	// Return the updated hit count
	return $count;
}

function setsessionData($var, $message)
{
	$ci = &get_instance();
	return $ci->session->set_userdata($var, $message);
}

function character($string)
{
	$str = substr($string, '0', '80');
	$substring = substr($string, 80);
	$character_count = strlen($substring);
	$str .= ($character_count >= 80) ? '...' : '';
	return $str;
}
function calculatePercentageDiscount($marketPrice, $salePrice)
{
	// Check if market price is greater than zero to avoid division by zero error
	if ($marketPrice > 0) {
		// Calculate the percentage discount
		$percentageDiscount = (($marketPrice - $salePrice) / $marketPrice) * 100;
		return (int)$percentageDiscount;
	} else {
		// Return an error message if market price is not valid
		return "Error: Market price should be greater than zero.";
	}
}


function sendOTP($contact_no, $otp, $route = 1)
{
	$ch = curl_init();
	 
	$message_content = "Hi, Your OTP for verify your mobile number is {$otp} From Care1. Valid for 30 minutes. Please do not share this OTP.\nRegards,\n\nGNOSISACCRUE Team";
    $url = "http://sms.mysmsshop.in/V2/http-api.php?apikey=YyOzQ9c7pLO6zlIN&senderid=GNSPVT&number=$contact_no&message=" . urlencode($message_content) ."&format=json";
	$getUrl = $url;
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST, 10);
	curl_setopt($ch, CURLOPT_URL, $getUrl);
	curl_setopt($ch, CURLOPT_TIMEOUT, 80);
	$response = curl_exec($ch);
	return json_decode($response,true);
}
function sendTextMessage($contact_no, $otp)
{
    $message_content = "Hi, Your OTP for verify your mobile number is $otp. Valid for 30 minutes. Please do not share this OTP.

Regards,
GNOSISACCRUE Team
";
	$url = "http://mysmsshop.in/V2/http-api.php?apikey=P8biaCPcx9w62LwJ&senderid=GNSPVT&number=$contact_no&message=" . urlencode($message_content) . "&format=json";
	$res = curl_init();
	curl_setopt($res, CURLOPT_URL, $url);
	curl_setopt($res, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($res);
	return json_decode($result, true);
}


