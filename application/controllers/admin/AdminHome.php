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
		$this->load->view('admin/index', $getRows);
	}

	public function banner()
	{
		extract($this->input->get());
		$id = $this->input->get('bID');
		$BdID = $this->input->get('BdID');
		if ($id) {
			$sId = decryptId($id);
	     	$get = $this->CommonModel->getSingleRowById('banner', "banner_id = '$sId'");
		}
		$data['image_path'] = set_value('image_path') == false ? @$get['image_path'] : set_value('image_path');
		$data['all_banner'] = $this->CommonModel->getAllRowsInOrder('banner', 'create_date', 'DESC');

		if ($BdID != '') {
			$delete = $this->CommonModel->deleteRowById('banner', array('banner_id' => decryptId($BdID)));
			unlink('upload/banner/' . $img);
			redirect('banner');
			exit;
		}

		if (isset($id)) {
			$data['title'] = 'Banner Edit';
		} else {
			$data['title'] = 'Banner add';
		}
		if (count($_POST) > 0) {

			if (!empty($_FILES['image_path']['name'])) {
				$p = fullImage('image_path', BANNER_IMAGE, $data['image_path']);
				$post['image_path'] = $p;
			}

			if (isset($id)) {
				$post['update_date'] = setDateTime();
				$update = $this->CommonModel->updateRowById('banner', 'banner_id', $sId, $post);
				flashData('errors', 'Banner Update Successfully');
			} else {
				$post['create_date'] = setDateTime();
				$insert = $this->CommonModel->insertRow('banner', $post);
				flashData('errors', 'Banner Add successfully.');
			}
			redirect('banner');
		}
		$this->load->view('admin/banner', $data);
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
			$this->load->view('admin/user_promo_code', $data);
		}
	}
	public function blog()
	{
		$id = $this->input->get('blog_pin');
		$dID = $this->input->get('dID');
		if (isset($id)) {
			$sId = decryptId($id);
			$getPlans = getRowById('blog', 'id', $sId);
		} else {
			$sId = '';
		}


		$data['blogtitle'] = set_value('title') == false ? @$getPlans[0]['title'] : set_value('title');
		$data['cover'] = set_value('cover_image') == false ? @$getPlans[0]['cover_image'] : set_value('cover_image');
		$data['description'] = set_value('description') == false ? @$getPlans[0]['description'] : set_value('description');


		if (isset($dID)) {
			$delete = $this->CommonModel->deleteRowById('blog', array('id' => decryptId($dID)));
		}

		if (isset($id)) {
			$data['title'] = 'Blog Edit';
		} else {
			$data['title'] = 'Blog add';
		}
		if (count($_POST) > 0) {
			extract($this->input->post());
			$post['title'] = strtoupper($title);

			$post['description'] = $description;

			if (isset($id)) {
				$post['update_date'] = setDateTime();
				if ($_FILES['cover_image']['name'] != '') {
					$post['cover_image'] = imageUpload('cover_image', 'upload/blog/', $data['cover']);
				}

				$update = updateRowById('blog', 'id', $sId, $post);
				if ($update) {
					flashData('errors', 'Blog Update Successfully');
				} else {
					flashData('errors', 'Blog Not Update. please try again');
				}
			} else {
				$post['create_date'] = setDateTime();
				if ($_FILES['cover_image']['name'] != '') {
					$post['cover_image'] = imageUpload('cover_image', 'upload/blog/', "");
				}
				$insert = insertRow('blog', $post);
				if ($insert) {
					flashData('errors', 'Blog Add Successfully');
				} else {
					flashData('errors', 'Blog Not Add');
				}
			}
			redirect('blog');
		} else {
			$data['title'] = 'Blog';
			$this->load->view('admin/blog', $data);
		}
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
		$this->load->view('admin/contactdetails', $data);
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

	// Order 


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

		foreach ($post as $items) :
			$product = $this->CommonModel->getRowByIdfield('product', 'product_id', $items['product_id'], array('product_id', 'sale_price', 'product_name', 'quantity_type'));
			$imgdata = getSingleRowById('product_image', array('product_id' => $items['product_id']));
			$mydata[]  = array(
				'create_date' => setDateTime(),
				'order_id' => $checkoutdata['order_id'],
				'no_of_items' => $items['qty'],
				'base_price' => $items['base_price'],
				'user_price' => $items['user_price'],
				'booking_price' => ($items['booking_price'] * $items['no_of_items']),
				'product_id' => $items['product_id'],
				'product_img' => $imgdata['image_path'],
				'gst_amt' => $items['gst_amt'],
				'product_name' =>  clean($product[0]['product_name']),
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
						"units" => (int)$row['no_of_items'],
						"selling_price" => (int)$row['booking_price'],
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
		$this->load->view('admin/settings', $data);
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
