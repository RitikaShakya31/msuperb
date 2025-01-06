<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AdminProduct extends CI_Controller
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
	//   category
	public function categoryAll()
	{
		$get['category_all'] = $this->CommonModel->getRowByIdInOrder('category', "is_delete = '1'", 'category_name', 'ASC');
		$get['title'] = 'All Brands';
		$get['setting'] = $this->setting;
		$this->load->view('admin/product/category_all', $get);
	}
	public function categoryAdd()
	{
		extract($this->input->post());
		$id = $this->input->get('id');
		$dID = $this->input->get('dID');
		$decrypt_id = decryptId($this->input->get('id'));
		$get = $this->CommonModel->getSingleRowById('category', "category_id = '$decrypt_id'");
		$data['category_name'] = set_value('category_name') == false ? @$get['category_name'] : set_value('category_name');
		$data['category_description'] = set_value('category_description') == false ? @$get['category_description'] : set_value('category_description');
		$data['banner'] = set_value('banner') == false ? @$get['banner'] : set_value('banner');
		$data['image'] = set_value('image') == false ? @$get['image'] : set_value('image');
		if (isset($id)) {
			$data['title'] = 'Edit Category';
		} else {
			$data['title'] = 'Add Category';
		}
		if (isset($dID)) {
			$update = $this->CommonModel->updateRowById('category', 'category_id', decryptId($dID), array('is_delete' => '0'));
			redirect('categoryAll');
			exit;
		}
		if (count($_POST) > 0) {
			$this->form_validation->set_rules('category_name', 'category name', 'required');
			$this->form_validation->set_rules('category_description', 'category_description', 'required');
			if ($this->form_validation->run()) {
				$post['category_name'] = trim($category_name);
				$post['category_description'] = trim($category_description);
				if (!empty($_FILES['image']['name'])) {
					$picture = imageUploadWithRatio('image', CATEGORY_IMAGE, 600, 400, $data['image']);
					$post['image'] = $picture;
				}
				if (!empty($_FILES['banner']['name'])) {
					$banner = imageUploadWithRatio('banner', CATEGORY_BANNER, 600, 400, $data['banner']);
					$post['banner'] = $banner;
				}
				if (!empty($_FILES['offer']['name'])) {
					$offer = imageUploadWithRatio('offer', CATEGORY_BANNER, 600, 400, $data['offer']);
					$post['offer'] = $offer;
				}
				if (isset($id)) {
					$update = $this->CommonModel->updateRowById('category', 'category_id', $decrypt_id, $post);
					flashData('errors', 'Category Update Successfully');
				} else {
					$insert = $this->CommonModel->insertRow('category', $post);
					flashData('errors', 'Category Add Successfully');
				}
				redirect('categoryAll');
			}
		}
		$data['setting'] = $this->setting;
		$this->load->view('admin/product/category_add', $data);
	}
	//   sub category
	public function subCategoryAll()
	{
		$data['sub_category'] = $this->CommonModel->getRowByIdInOrder('sub_category', "is_delete = '1'", 'sub_category_name', 'ASC');
		$data['title'] = "All Laboratory";
		$data['setting'] = $this->setting;
		$this->load->view('admin/product/sub_category_all', $data);
	}
	public function subCategoryAdd()
	{
		$dID = $this->input->get('dID');
		$id = $this->input->get('id');
		$data['services'] = $this->CommonModel->getAllRows('all_service');
		$data['brand'] = $this->CommonModel->getAllRows('all_brand');
		extract($this->input->post());
		$decrypt_id = decryptId($this->input->get('id'));
		$get = $this->CommonModel->getSingleRowById('sub_category', "sub_category_id = '$decrypt_id'");
		$data['lab_location'] = set_value('lab_location') == false ? @$get['lab_location'] : set_value('lab_location');
		$data['lab_email'] = set_value('lab_email') == false ? @$get['lab_email'] : set_value('lab_email');
		$data['lab_contact'] = set_value('lab_contact') == false ? @$get['lab_contact'] : set_value('lab_contact');
		$data['lab_name'] = set_value('lab_name') == false ? @$get['lab_name'] : set_value('lab_name');
		$data['bank_name'] = set_value('bank_name') == false ? @$get['bank_name'] : set_value('bank_name');
		$data['ifsc_code'] = set_value('ifsc_code') == false ? @$get['ifsc_code'] : set_value('ifsc_code');
		$data['upi_id'] = set_value('upi_id') == false ? @$get['upi_id'] : set_value('upi_id');
		$data['sub_category_name'] = set_value('sub_category_name') == false ? @$get['sub_category_name'] : set_value('sub_category_name');
		$data['category_id'] = set_value('category_id') == false ? @$get['category_id'] : set_value('category_id');
		$data['sub_category_image'] = set_value('category_image2') == false ? @$get['sub_category_image'] : set_value('category_image2');
		if (isset($id)) {
			$data['title'] = 'Edit Laboratory';
			$getReg = $this->CommonModel->getSingleRowById('register', "register_id = '$decrypt_id'");
			$data['variant'] = $this->CommonModel->getRowByMoreId('service_list', "register_id = '$decrypt_id'");
		} else {
			$data['title'] = 'Add Laboratory';
		}
		if (isset($dID)) {
			$update = $this->CommonModel->updateRowById('sub_category', 'sub_category_id', decryptId($dID), array('is_delete' => '0'));
			redirect('subCategoryAll');
			exit;
		}
		if (count($_POST) > 0) {
			$this->form_validation->set_rules('sub_category_name', 'sub category name', 'trim|required');
			$this->form_validation->set_rules('category_id', 'category', 'required');
			if ($this->form_validation->run()) {
				$post['sub_category_name'] = $sub_category_name;
				$post['lab_location'] = $lab_location;
				$post['lab_email'] = $lab_email;
				$post['lab_contact'] = $lab_contact;
				$post['bank_name'] = $bank_name;
				$post['ifsc_code'] = $ifsc_code;
				$post['upi_id'] = $upi_id;
				$post['category_id'] = $category_id;
				$post['slug_title'] = url_title($sub_category_name, '-', true);
				$post['password'] = $post['slug_title'] . rand(1000, 9999);
				if (!empty($_FILES['sub_category_image']['name'])) {
					$picture = imageUploadWithRatio('sub_category_image', CATEGORY_IMAGE, 600, 400, $data['sub_category_image']);
					$post['sub_category_image'] = $picture;
				}
				if (isset($id)) {
					$update = $this->CommonModel->updateRowById('sub_category', 'sub_category_id', $decrypt_id, $post);
					flashData('errors', 'Sub Category Update Successfully');
				} else {
					$insert = $this->CommonModel->insertRow('sub_category', $post);
					flashData('errors', 'Sub Category Add Successfully');
				}
				redirect('subCategoryAll');
			}
		}
		$data['setting'] = $this->setting;
		$this->load->view('admin/product/sub_category_add', $data);
	}
	//  Product
	public function productAll()
	{
		$subCategoryId = $this->input->get('sCateId');
		$dID = $this->input->get('dID');
		if (isset($dID)) {
			$update = $this->CommonModel->updateRowById('product', 'product_id', decryptId($dID), array('is_delete' => '0'));
			redirect('productAll');
			exit;
		}
		$select = "product.*, category.category_name, sub_category.sub_category_name";
		$join = [
			['category', 'category.category_id = product.category_id', 'LEFT'],
			['sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'LEFT'],
		];
		if (isset($subCategoryId)) {
			$get['all_product'] = $this->CommonModel->getRowWithMultiJoin($select, 'product', "product.is_delete = '1' AND product.sub_category_id = '" . decryptId($subCategoryId) . "'", $join, 'product_name', 'ASC', 1);
		} else {
			$get['all_product'] = $this->CommonModel->getRowWithMultiJoin($select, 'product', "product.is_delete = '1'", $join, 'product_name', 'ASC', 1);
		}
		$get['title'] = 'All Test';
		$get['setting'] = $this->setting;
		$this->load->view('admin/product/product_all', $get);
	}
	function getSubCategory()
	{
		$category_id = $this->input->post('category_id');
		$data['type'] = 1;
		$data['setting'] = $this->setting;
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('sub_category', "category_id = '$category_id' AND is_delete = '1'", 'sub_category_name', 'ASC');
		$this->load->view('admin/product/sub_category_list', $data);
	}
	function getProductSubCategory()
	{
		$category_id = $this->input->post('category_id');
		$data['all_data'] = $this->CommonModel->getRowByIdInOrder('sub_category', "category_id = '$category_id' AND is_delete = '1'", 'sub_category_name', 'ASC');
		$data['type'] = 2;
		$data['setting'] = $this->setting;
		$this->load->view('admin/product/sub_category_list', $data);
	}
	public function productAdd()
	{
		$id = $this->input->get('id');
		$data['services'] = $this->CommonModel->getAllRows('all_service');
		if (isset($id)) {
			$id = $this->input->get('id');
			$decrypt_id = decryptId($id);
			$data['title'] = 'Edit Product';
			$getProduct = $this->CommonModel->getSingleRowById('product', "product_id = '$decrypt_id'");
			// $data['image_all'] = $this->CommonModel->getRowById('product_image', "product_id", $decrypt_id);
			$data['variant'] = $this->CommonModel->getRowById('product_variant', "product_id", $decrypt_id);
		} else {
			$data['title'] = 'Add Test';
			$getProduct = false;
		}
		$data['product_name'] = set_value('product_name') == false ? @$getProduct['product_name'] : set_value('product_name');
		// $data['product_type'] = set_value('product_type') == false ? @$getProduct['product_type'] : set_value('product_type');
		$data['description'] = set_value('description') == false ? @$getProduct['description'] : set_value('description');
		$data['market_price'] = set_value('market_price') == false ? @$getProduct['market_price'] : set_value('market_price');
		$data['sale_price'] = set_value('sale_price') == false ? @$getProduct['sale_price'] : set_value('sale_price');
		$data['seo_title'] = set_value('seo_title') == false ? @$getProduct['seo_title'] : set_value('seo_title');
		$data['seo_description'] = set_value('seo_description') == false ? @$getProduct['seo_description'] : set_value('seo_description');
		$data['seo_keyword'] = set_value('seo_keyword') == false ? @$getProduct['seo_keyword'] : set_value('seo_keyword');
		$data['product_status'] = set_value('product_status') == false ? @$getProduct['product_status'] : set_value('product_status');
		$data['is_bestselling'] = set_value('is_bestselling') == false ? @$getProduct['is_bestselling'] : set_value('is_bestselling');
		$data['category_id'] = set_value('category_id') == false ? @$getProduct['category_id'] : set_value('category_id');
		$data['sub_category_id'] = set_value('sub_category_id') == false ? @$getProduct['sub_category_id'] : set_value('sub_category_id');

		if (count($_POST) > 0) {
			extract($this->input->post());
			$post['product_name'] = $product_name;
			$post['description'] = $description;
			$post['product_type'] = $product_type;
			$post['market_price'] = $market_price;
			$post['sale_price'] = $sale_price;
			$post['seo_title'] = $seo_title;
			$post['seo_description'] = $seo_description;
			$post['seo_keyword'] = $seo_keyword;
			// $post['product_status'] = $product_status;
			$post['sub_category_id'] = $sub_category_id;
			$post['category_id'] = $category_id;
			$post['is_bestselling'] = ((isset($is_bestselling)) ? 1 : 0);

			// $variant = ['variant_product_id' => $_POST['variant_product_id'], 'product_title' => $_POST['variant_product_title'], 'market_price' => $_POST['variant_market_price'], 'sale_price' => $_POST['variant_sale_price'], 'product_description' => $_POST['variant_product_description'], 'tag' => $_POST['variant_tag']];
			// unset(
			// 	$_POST['product_title'],
			// 	$_POST['market_price'],
			// 	$_POST['sale_price'],
			// 	$_POST['product_description'],
			// 	$_POST['tag'],
			// 	$_POST['variant_product_id']
			// );
			// $dataCount = count($variant['product_title']);
			if (isset($id)) {
				$update = $this->CommonModel->updateRowById('product', 'product_id', $decrypt_id, $post);
				// if ($dataCount > 0) {
				// 	for ($i = 0; $i < $dataCount; $i++) {
				// 		if ($variant['product_title'][$i] != '') {
				// 			$post2 = array('product_id' => $decrypt_id, 'product_title' => $variant['product_title'][$i], 'market_price' => $variant['market_price'][$i], 'sale_price' => $variant['sale_price'][$i], 'product_description' => $variant['product_description'][$i], 'tag' => $variant['tag'][$i]);

				// 			if ($variant['variant_product_id'][$i] != '') {
				// 				$updates = $this->CommonModel->updateRowById('product_variant', 'id', $variant['variant_product_id'][$i], $post2);
				// 			} else {
				// 				$inserts = $this->CommonModel->insertRow('product_variant', $post2);
				// 			}
				// 		}
				// 	}
				// }

				// $filesCount = count($_FILES['image']['name']);

				// if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'][0])) {
				// 	$filesCount = count($_FILES['image']['name']);
				// 	for ($i = 0; $i < $filesCount; $i++) {
				// 		if (!empty($_FILES['image']['name'][$i])) { // चेक करें कि फाइल खाली नहीं है
				// 			$extension = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
				// 			$newFilename = round(microtime(true) * 1000) . '.' . $extension;
				// 			$_FILES['files']['name'] = $newFilename;
				// 			$_FILES['files']['type'] = $_FILES['image']['type'][$i];
				// 			$_FILES['files']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
				// 			$_FILES['files']['error'] = $_FILES['image']['error'][$i];
				// 			$_FILES['files']['size'] = $_FILES['image']['size'][$i];
				// 			$picture = fullImage('files', PRODUCT_IMAGE);
				// 			if ($picture) {
				// 				$post3['image_path'] = $picture;
				// 				$post3['product_id'] = isset($decrypt_id) ? $decrypt_id : $p_id;
				// 				$this->CommonModel->insertRow('product_image', $post3);
				// 			}
				// 		}
				// 	}
				// } else {
				// 	$file_error = "Please select at least one file to upload.";
				// }
				flashData('errors', 'Produce update successfully');
			} else {
				$p_id = $this->CommonModel->insertRowReturnIdWithClean('product', $post);
				// if ($p_id > 0) {
				// 	$filesCount = count($_FILES['image']['name']);
				// 	if ($filesCount > 0) {
				// 		for ($i = 0; $i < $filesCount; $i++) {
				// 			if ($_FILES['image']['name'] != '') {
				// 				$extension = pathinfo($_FILES["image"]["name"][$i], PATHINFO_EXTENSION);
				// 				$newFilename = round(microtime(true) * 1000);
				// 				$_FILES['files']['name'] = $newFilename . '.' . $extension;
				// 				$_FILES['files']['type'] = $_FILES['image']['type'][$i];
				// 				$_FILES['files']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
				// 				$_FILES['files']['error'] = $_FILES['image']['error'][$i];
				// 				$_FILES['files']['size'] = $_FILES['image']['size'][$i];
				// 				$picture = fullImage('files', PRODUCT_IMAGE);
				// 				// $picture = imageUploadWithRatio('files', PRODUCT_IMAGE, 600, 400, "");
				// 				if ($picture) {
				// 					$post2['image_path'] = $picture;
				// 					$post2['product_id'] = $p_id;
				// 					$insert = $this->CommonModel->insertRow('product_image', $post2);
				// 				}
				// 			}
				// 		}
				// 	}
				// 	flashData('errors', 'Produce add successfully');
				// } else {
				// 	flashData('errors', 'Product not add');
				// }
			}
			redirect('productAll');
		}
		$data['setting'] = $this->setting;
		$this->load->view('admin/product/product_add', $data);
	}

	public function productExcelUpload()
	{
		$data['title'] = 'Upload Test\'s Excel';
		$data['setting'] = $this->setting;
		$this->load->view('admin/product/product_excel_upload', $data);
	}
	public function update_bulk_product()
	{
		$file = $_FILES['product_sheet']['tmp_name'];
		$handle = fopen($file, "r");
		$c = 0;
		$existsCandidate = [
			'exists' => [],
			'inserted' => []
		];
		$msg = [];
		fgetcsv($handle);
		while (($filesop = fgetcsv($handle, 1000, ',')) !== false) {
			if (array_filter($filesop)) {
				$post = [];
				$brand_name = $filesop[1]; // Fetch product name
				if (!empty($brand_name)) {
					//brand name
					$category_id = $this->CommonModel->getSingleRowById('tbl_category', ['category_name' => $brand_name, 'is_delete' => '1']);
					$post['category_id'] = $category_id ? $category_id['category_id'] : '';
					//laboratory name
					$laboratory_name = $filesop[2];
					$sub_category_id = $this->CommonModel->getSingleRowById('tbl_sub_category', ['sub_category_name' => $laboratory_name, 'is_delete' => '1']);
					$post['sub_category_id'] = $sub_category_id ? $sub_category_id['sub_category_id'] : '';
					// test name
					$test_name = $filesop[3];
					$test_id = $this->CommonModel->getSingleRowById('tbl_all_service', ['service_name' => $test_name]);
					$post['product_name'] = $test_id ? $test_id['service_id'] : '';
					//test type
					switch ($filesop[4]) {
						case 'Normal':
							$post['product_type'] = '1';
							break;
						case 'Offer':
							$post['product_type'] = '2';
							break;
						case 'Package':
							$post['product_type'] = '3';
							break;
						case 'Radiology':
							$post['product_type'] = '4';
							break;
						default:
							$post['product_type'] = '0'; // Default or unknown type
							break;
					}
					$post['market_price'] = $filesop[5];
					$post['sale_price'] = $filesop[6];
					$post['description'] = $filesop[7];
					$post['seo_title'] = $filesop[8];
					$post['seo_description'] = $filesop[9];
					$post['seo_keyword'] = $filesop[10];
					$insertID = $this->CommonModel->insertRowReturnId('tbl_product', $post);
				}
			} else {
				// Skip empty row
				continue;
			}
		}
		// $this->session->set_userdata('msg', "Sheet Uploaded");
		fclose($handle); // Close the file handle
		if (isset($insertID) && $insertID) {
			echo "success";
		} else {
			echo "fail";
		}
	}


	public function productImageD($id, $img)
	{
		$delete = $this->CommonModel->deleteRowById('product_image', "product_image_id = '" . decryptId($id) . "'");
		unlink(PRODUCT_IMAGE . $img);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function productDetails()
	{
		$id = $this->input->get('id');
		$decrypt_id = decryptId($id);
		$getProduct = $this->CommonModel->getSingleRowById('product', "product_id = '$decrypt_id'");
		$data['product_name'] = set_value('product_name') == false ? @$getProduct['product_name'] : set_value('product_name');
		$data['company_id'] = set_value('company_id') == false ? @$getProduct['company_id'] : set_value('company_id');
		$data['category_id'] = set_value('category_id') == false ? @$getProduct['category_id'] : set_value('category_id');
		$data['sub_category_id'] = set_value('sub_category_id') == false ? @$getProduct['sub_category_id'] : set_value('sub_category_id');
		// $data['product_type'] = set_value('product_type') == false ? @$getProduct['product_type'] : set_value('product_type');
		$data['description'] = set_value('description') == false ? @$getProduct['description'] : set_value('description');
		$data['product_type'] = set_value('product_type') == false ? @$getProduct['product_type'] : set_value('product_type');
		$data['market_price'] = set_value('market_price') == false ? @$getProduct['market_price'] : set_value('market_price');
		$data['sale_price'] = set_value('sale_price') == false ? @$getProduct['sale_price'] : set_value('sale_price');
		$data['quantity'] = set_value('quantity') == false ? @$getProduct['quantity'] : set_value('quantity');
		$data['quantity_type'] = set_value('quantity_type') == false ? @$getProduct['quantity_type'] : set_value('quantity_type');
		$data['seo_title'] = set_value('seo_title') == false ? @$getProduct['seo_title'] : set_value('seo_title');
		$data['seo_description'] = set_value('seo_description') == false ? @$getProduct['seo_description'] : set_value('seo_description');
		$data['seo_keyword'] = set_value('seo_keyword') == false ? @$getProduct['seo_keyword'] : set_value('seo_keyword');
		$data['image_all'] = $this->CommonModel->getRowById('product_image', "product_id", $decrypt_id);
		$data['title'] = 'Test Details';
		$data['setting'] = $this->setting;
		$this->load->view('admin/product/view_product_details', $data);
	}
}
