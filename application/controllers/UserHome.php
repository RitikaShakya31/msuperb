<?php
class UserHome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->profile = $this->CommonModel->getRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'));
        $this->contact = $this->CommonModel->getSingleRowById('contactdetails', ['id' => '1']);
        $this->setting = $this->CommonModel->getAllRows('setting');
    }
    public function index()
    {
        $data['banner'] = $this->CommonModel->getAllRowsInOrder('banner', 'banner_id', 'desc');
        $data['getFaqs'] = $this->CommonModel->getAllRowsInOrder('faqs', 'fid', 'desc');
        // $data['product'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1', 'is_delete' => '1'), 'product_id', 'DESC', '10');
        // $data['productdesc'] = $this->CommonModel->getRowByOrderWithLimit('product', array('status' => '1', 'is_delete' => '1'), 'product_id', 'DESC', '20');
        // $data['normalpro'] = $this->CommonModel->getRowByOrderWithLimit('product', array('product_type' => '2', 'status' => '1', 'is_delete' => '1'), 'product_id', 'DESC', '20');
        // $data['featurepro'] = $this->CommonModel->getRowByOrderWithLimit('product', array('product_type' => '2', 'status' => '1', 'is_delete' => '1'), 'product_id', 'DESC', '20');
        // $data['combopro'] = $this->CommonModel->getRowByOrderWithLimit('product', array('product_type' => '3', 'status' => '1', 'is_delete' => '1'), 'product_id', 'DESC', '20');
        $data['cate'] = $this->CommonModel->getAllRowsInOrderWithLimit('category', '25', 'category_id', 'ASC');
        $data['brand'] = $this->CommonModel->getAllRowsInOrderWithLimit('all_brand', '25', 'brand_id', 'DESC');
        $data['title'] = ' Home ';
        $data['contact'] = $this->contact;
        $data['setting'] = $this->setting;
        $this->load->view('home', $data);
    }
    public function product()
    {
        $cateid = $this->input->get('category');
        if ($cateid) {
            $data['cateid'] = decryptId($cateid);
        }
        $data['search'] = $this->input->get('searchbox');
        $subcate = $this->input->get('subcate');
        if ($subcate) {
            $data['subcateid'] = decryptId($subcate);
        }
        $data['sidecategory'] = $this->CommonModel->getAllRowsInOrder('category', 'category_id', 'ASC');
        $data['subcategory'] = $this->CommonModel->getAllRowsInOrder('sub_category', 'category_id', 'desc');
        $data['title'] = ' Our product';
        $data['contact'] = $this->contact;
        $data['setting'] = $this->setting;
        $this->load->view('product', $data);
    }
    public function nearest_lab()
    {
        $data['labsData'] = $this->CommonModel->getAllRowsInOrder('tbl_category', 'category_id', 'DESC', array('is_delete' => '1'));
        $data['title'] = 'Our Labs';
        $data['contact'] = $this->contact;
        $data['setting'] = $this->setting;
        $this->load->view('nearest_lab', $data);
    }
    public function lab_location($id)
    {
        $id = decryptId($id);
        $data['lab'] = $this->CommonModel->getRowByIdInOrder(
            'tbl_sub_category',
            " is_delete = '1' AND category_id = $id",
            'sub_category_id',
            'DESC'
        );
        $data['title'] = 'Nearest Labs';
        $data['contact'] = $this->contact;
        $data['setting'] = $this->setting;
        $this->load->view('lab_location', $data);
    }
    public function compare($id)
    {
        $data['product'] = $this->CommonModel->getSingleRowById('product', ['product_id' => decryptId($id)]);
        $proName = $data['product']['product_name'];
        $data['title'] = 'Compare Labs';
        $data['contact'] = $this->contact;
        $this->load->view('compare', $data);
    }
    public function prescriptionData()
    {
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $post['create_date'] = date('Y-m-d');
            if ($_FILES['prescription_image']['name'] != '') {
                $post['prescription_image'] = imageUpload('prescription_image', 'upload/prescription/', '');
            }
            $insert = $this->CommonModel->insertRowReturnId('prescription_data', $post);
            if ($insert) {
                $this->session->set_userdata('msg', '<div class="alert alert-success">Your query is successfully submit. We will contact you as soon as possible.</div>');
            } else {
                $this->session->set_userdata('msg', '<div class="alert alert-danger">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.</div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function delete_variant()
    {
        $id = $_POST['id'];
        $delete = $this->CommonModel->deleteRowById('product_variant', "id = '" . ($id) . "'");
        if ($delete) {
            echo 0;
        } else {
            echo 1;
        }
    }
    public function filterData()
    {
        $price = ((isset($_POST['price'])) ? $_POST['price'] : '');
        $search = ((isset($_POST['search'])) ? $_POST['search'] : '');
        $category = ((isset($_POST['category'])) ? $_POST['category'] : '');
        $subcategory = ((isset($_POST['subcategory'])) ? $_POST['subcategory'] : '');
        $query = "SELECT * FROM `tbl_product` WHERE `status` = '1' AND `is_delete` = '1'";
        if (($search != '') || ($category != '') || ($subcategory != '') || ($price != '')) {
            if ($search != '') {
                $query .= " AND ( `product_name` LIKE '%" . trim($search) . "%'  OR `sale_price` LIKE '%" . trim($search) . "%' OR `description` LIKE '%" . trim($search) . "%'  )";
            }
            if ($category != '') {
                $cate = implode("','", $category);
                $query .= " AND category_id IN('" . $cate . "')";
            }
            if ($subcategory != '') {
                $subcate = implode("','", $subcategory);
                $query .= " AND sub_category_id IN('" . $subcate . "')";
            }
            if ($price != '') {
                if ($price == 0) {
                    $query .= " ORDER BY `sale_price` ASC";
                } else {
                    $query .= " ORDER BY `sale_price` DESC";
                }
            }
        }
        $data['all_data'] = $this->CommonModel->runQuery($query);
        $data['contact'] = $this->contact;
        $this->load->view('get_product', $data);
    }
    public function lab_details($id, $title)
    {
        $data['packagepro'] = $this->CommonModel->getRowByOrderWithLimit('register', array('brand_name' => decryptId($id)), 'register_id', 'DESC', '20');
        $data['routinepro'] = $this->CommonModel->getRowByOrderWithLimit(
            'product',
            [
                'status' => '1',
                'is_delete' => '1',
                'category_id' => decryptId($id)
            ],
            'product_id',
            'DESC',
            '20',
            "(product_type = '1' OR product_type = '2')"
        );
        $data['category'] = $this->CommonModel->getSingleRowById('all_brand', array('brand_id' => decryptId($id)));
        $data['products_variant'] = $this->CommonModel->getRowById('product_variant', 'product_id', decryptId($id));
        $data['details'] = $this->CommonModel->getRowById("product", 'product_id', decryptId($id))[0];
        $data['reviews'] = $this->CommonModel->getRowByOrderWithLimit('product_review', array('product_id' => decryptId($id), 'status' => 'accepted'), 'rid', 'DESC', '100');
        $data['title'] = ($data['details']['seo_title'] == '') ? $data['details']['product_name'] . '|  | Your One Care Medical' : $data['details']['seo_title'];
        $data['desc'] = ($data['details']['seo_description'] == '') ? SEODESCRIPTION : $data['details']['seo_description'];
        $data['keyword'] = ($data['details']['seo_keyword'] == '') ? $data['details']['seo_keyword'] . '|  | Your One Care Medical' : $data['details']['seo_keyword'];
        $data['contact'] = $this->contact;
        $this->load->view('lab_details', $data);
    }
    public function product_details($id, $title)
    {
        $data['packagepro'] = $this->CommonModel->getRowByOrderWithLimit('product', array('product_type' => '3', 'status' => '1', 'is_delete' => '1', 'category_id' => decryptId($id)), 'product_id', 'DESC', '20');
        $data['routinepro'] = $this->CommonModel->getRowByOrderWithLimit(
            'product',
            [
                'status' => '1',
                'is_delete' => '1',
                'category_id' => decryptId($id)
            ],
            'product_id',
            'DESC',
            '20',
            "(product_type = '1' OR product_type = '2')"
        );
        $data['category'] = $this->CommonModel->getSingleRowById('category', array('category_id' => decryptId($id)));
        $data['products_variant'] = $this->CommonModel->getRowById('product_variant', 'product_id', decryptId($id));
        $data['details'] = $this->CommonModel->getRowById("product", 'product_id', decryptId($id))[0];
        $data['reviews'] = $this->CommonModel->getRowByOrderWithLimit('product_review', array('product_id' => decryptId($id), 'status' => 'accepted'), 'rid', 'DESC', '100');
        $data['title'] = ($data['details']['seo_title'] == '') ? $data['details']['product_name'] . '|  | Your One Care Medical' : $data['details']['seo_title'];
        $data['desc'] = ($data['details']['seo_description'] == '') ? SEODESCRIPTION : $data['details']['seo_description'];
        $data['keyword'] = ($data['details']['seo_keyword'] == '') ? $data['details']['seo_keyword'] . '|  | Your One Care Medical' : $data['details']['seo_keyword'];
        $data['contact'] = $this->contact;
        $data['setting'] = $this->setting;
        $this->load->view('product-details', $data);
    }
    public function test_details($id, $title)
    {
        $data['product'] = $this->CommonModel->getSingleRowById('product', array('product_id' => decryptId($id)));
        $category_id = $data['product']['category_id'];
        $data['category'] = $this->CommonModel->getSingleRowById('category', array('category_id' => $category_id));

        $data['dailypro'] = $this->CommonModel->getRowByOrderWithLimit('product', array('product_type' => '1', 'status' => '1', 'is_delete' => '1', 'category_id' => $category_id), 'product_id', 'DESC', '20');

        $data['title'] = ($data['details']['seo_title'] == '') ? $data['details']['product_name'] . '|  | Your One Care Medical' : $data['details']['seo_title'];
        $data['desc'] = ($data['details']['seo_description'] == '') ? SEODESCRIPTION : $data['details']['seo_description'];
        $data['keyword'] = ($data['details']['seo_keyword'] == '') ? $data['details']['seo_keyword'] . '|  | Your One Care Medical' : $data['details']['seo_keyword'];
        $data['contact'] = $this->contact;
        $data['setting'] = $this->setting;
        $this->load->view('test_details', $data);
    }
    public function contact()
    {
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $insert = $this->CommonModel->insertRowReturnId('contact_query', $post);
            if ($insert) {
                $this->session->set_userdata('msg', '<div class="alert alert-success">Your query is successfully submit. We will contact you as soon as possible.</div>');
            } else {
                $this->session->set_userdata('msg', '<div class="alert alert-danger">We are facing technical error ,please try again later or get in touch with Email ID provided in contact section.</div>');
            }
        } else {
        }
        $data['title'] = 'Contact Us';
        $data['contact'] = $this->contact;
        $this->load->view('contact', $data);
    }
    public function register()
    {
        if ($this->session->has_userdata('login_user_id')) {
            redirect(base_url('profile'));
        }
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Register -  | Your One Care Medical';
        $data['state_list'] = $this->CommonModel->getAllRows('state');
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $count = $this->CommonModel->getNumRows('user_registration', array('email_id' => $this->input->post('email_id'), 'contact_no' => $this->input->post('contact_no')));
            if ($count > 0) {
                $this->session->set_userdata('msg', '<h6 class="alert alert-warning">You have already registered with this email id or contact no.</h6>');
            } else {
                $otp = rand(1000, 10000);
                $msg = "" . $otp . " is the verification code to log in to your  account.";
                // mailmsg( $post['email_id'], 'Verify Account!', $msg);
                sendOTP($post['contact_no'], $msg);
                $this->session->set_userdata(array('user_name' => $post['name'], 'user_emailid' => $post['email_id'], 'user_contact' => $post['contact_no'], 'user_address' => $post['address'], 'user_area' => $post['area'], 'user_postal_code' => $post['postal_code'], 'user_state' => $post['state'], 'user_city' => $post['city'], 'user_otp' => $otp));

                redirect('verify-registration');
                exit();
            }
        } else {
        }
        $data['contact'] = $this->contact;
        $this->load->view('register', $data);
    }
    public function verify_registration()
    {
        if ($this->session->has_userdata('login_user_id')) {
            redirect(base_url('profile'));
        }
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Register -  | Your One Care Medical';

        $data['contact'] = $this->contact;
        $this->load->view('check-otp', $data);
    }
    public function check_verification()
    {
        $responce = [];
        $otp = $this->input->post('otp');

        if ($this->session->userdata('user_otp') == $otp) {

            $ins = $this->CommonModel->insertRow('user_registration', array('name' => sessionId('user_name'), 'email_id' => sessionId('user_emailid'), 'contact_no' => sessionId('user_contact'), 'address' => sessionId('user_address'), 'area' => sessionId('user_area'), 'postal_code' => sessionId('user_postal_code'), 'state' => sessionId('user_state'), 'city' => sessionId('user_city')));

            $login_data = $this->CommonModel->getSingleRowById('user_registration', array('contact_no' => sessionId('user_contact')));
            $session = $this->session->set_userdata(array('login_user_id' => $login_data['user_id'], 'login_user_name' => $login_data['name'], 'login_user_emailid' => $login_data['email_id'], 'login_user_contact' => $login_data['contact_no']));
            $responce['reg_msg'] = 'OTP verified';
            if (count($this->cart->contents()) > 0) {
                $responce['status'] = '3';
            } else {
                $responce['status'] = '1';
            }
        } else {
            // $responce['reg_msg'] = 'Wrong OTP';
            $responce['reg_msg'] = 'Wrong OTP' . $otp;
            $responce['status'] = '2';
        }

        echo json_encode($responce);
    }
    public function registerFirebaseOtpVerify()
    {
        $responce = [];
        $post = $this->input->post();
        unset($post['g-recaptcha-response'], $post['otp']);
        $ins = $this->CommonModel->insertRow('user_registration', $post);
        $login_data = $this->CommonModel->getSingleRowById('user_registration', array('contact_no' => $post['contact_no']));
        $session = $this->session->set_userdata(array('login_user_id' => $login_data['user_id'], 'login_user_name' => $login_data['name'], 'login_user_emailid' => $login_data['email_id'], 'login_user_contact' => $login_data['contact_no']));
        if (count($this->cart->contents()) > 0) {
            $responce['status'] = '3';
        } else {
            $responce['status'] = '1';
        }
        echo json_encode($responce);
    }
    public function login()
    {
        // $login_data = $this->CommonModel->getRowByOr('user_registration', array('email_id' => 'harshamaravi@gmail.com'), array('contact_no' => '7983298464'));
        // $this->session->set_userdata(
        //     array(
        //         'login_user_id' => $login_data[0]['user_id'],
        //         'login_user_name' => $login_data[0]['name'],
        //         'login_user_emailid' => $login_data[0]['email_id'],
        //         'login_user_contact' => $login_data[0]['contact_no']
        //     )
        // );
        if ($this->session->has_userdata('login_user_id')) {
            redirect(base_url('profile'));
        }
        $data['category'] = $this->CommonModel->getAllRowsInOrder('category', 'category_id', 'desc');
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Login -  | Your One Care Medical';
        if (count($_POST) > 0) {
            extract($this->input->post());
            $table = "user_registration";
            $login_data = $this->CommonModel->getRowByOr($table, array('email_id' => $uname), array('contact_no' => $uname));

            if (!empty($login_data)) {
                if ($login_data[0]['password'] == $password) {
                    $session = $this->session->set_userdata(array('login_user_id' => $login_data[0]['user_id'], 'login_user_name' => $login_data[0]['name'], 'login_user_emailid' => $login_data[0]['email_id'], 'login_user_contact' => $login_data[0]['contact_no']));
                    if (count($this->cart->contents()) > 0) {
                        redirect(base_url('checkout'));
                    } else {
                        redirect(base_url('profile'));
                    }
                } else {
                    $this->session->set_userdata('loginError', '<h6 class="alert alert-warning">Wrong Password.</h6>');
                    redirect(base_url('login'));
                }
            } else {
                $this->session->set_flashdata('loginError', '<h6 class="alert alert-warning">Username or Password not match.</h6>');
                redirect(base_url('login'));
            }
        } else {
            if ($this->session->has_userdata('login_user_id')) {
                redirect(base_url('Web/profile'));
            }
        }
        $data['contact'] = $this->contact;
        // $this->load->view('login_wp', $data);
        $this->load->view('login', $data);
    }
    public function forgot_password()
    {
        $data['title'] = 'Forgot Password -  | Your One Care Medical';
        if (count($_POST) > 0) {
            extract($this->input->post());
            $email = $this->input->post('email');
            $table = "user_registration";
            $login_data = $this->CommonModel->getSingleRowById($table, array('email_id' => $email));
            if (!empty($login_data)) {
                $message = '<h6 style="margin: 0;
                font-size: 1.3em;
                color: rgb(80, 79, 79);
                font-family: Source Sans Pro;
                letter-spacing: 1px;">Hey there! </h6><br>
                <p style="margin: 0;
                font-size: 1.3em;
                color: rgb(80, 79, 79);
                font-family: Source Sans Pro;
                letter-spacing: 1px;">You Have Been Reset Your Password Sucessfully <br>
                 Your new Password is  - <span style=" color: #ffa800;
                  font-weight: 700;">' . $login_data['password'] . '</span> <br>
                  <p style="margin: 0;
                  padding: 4px;
                  color: #5892FF;
                  font-family: Source Sans Pro;
                  letter-spacing: 1px;">Click To login <a href="' . base_url() . 'login" style="text-decoration: none;
                color: #006573;
                font-weight: 600;">  Healthcare</a>
                  </p>
        ';
                mailmsg($email, 'Forgot Password  | From   Healthcare', $message);
                $this->session->set_userdata('forget', '<span class="alert alert-success py-2 mt-2">Check your mail ID for Password</span>');
                redirect(base_url('login'));
            } else {
                $this->session->set_userdata('forget', '<span class="alert alert-danger py-2 mt-2">No username found</span>');
                redirect(base_url('forgot-password'));
            }
        } else {
            $data['contact'] = $this->contact;
            $this->load->view('forgot-password', $data);
        }
    }
    public function orders()
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect();
        }

        $data['login_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModel->getRowByIdInOrder('book_product', array('user_id' => $this->session->userdata('login_user_id')), 'product_book_id', 'DESC');
        //  echo '<pre>';
        // print_r($data['orderDetails']);
        // exit();
        $data['cancelOrderDetails'] = $this->CommonModel->getRowByIdInOrder('book_product', 'user_id = ' . $this->session->userdata('login_user_id') . ' AND booking_status = "2" ', 'product_book_id', 'DESC');
        //  echo '<pre>';
        // print_r($data['cancelOrderDetails']);
        // exit();
        $data['checkoutnum'] = $this->CommonModel->getNumRows('book_product', array('user_id' => $this->session->userdata('login_user_id')));
        $data['title'] = ' Profile -  | Your One Care Medical';
        $data['logo'] = 'assets/logo.png';
        $data['contact'] = $this->contact;
        $data['setting'] = $this->setting;
        $this->load->view('order-history', $data);
    }
    public function requestOtp()
    {
        if ($this->input->post()) {  // Check if POST data is received
            $post = $this->input->post();

            // Check if email_id exists in the POST data
            if (!empty($post['contact_no'])) {
                $this->session->set_userdata('login_user_contact', $post['contact_no']);
                $post['otp'] = rand(10000, 99999);
                $this->session->set_userdata('otp', $post['otp']);

                // Check if the email already exists
                $contExists = $this->CommonModel->checkContactExists($post['contact_no']);

                if ($contExists) {
                    // If the email exists, update the OTP
                    $this->CommonModel->updateOtp($post['contact_no'], $post['otp']);

                } else {
                    // If the email does not exist, insert a new user record
                    $insert = $this->CommonModel->insertRow('tbl_user_registration', $post);

                }
                $responce = sendTextMessage($post['contact_no'], $post['otp']);
                // print_r($responce);
                // Output a plain success message to be used in AJAX
                echo "success";
            } else {
                echo "Phone Number is required."; // Prompt for missing 
            }
        } else {
            echo "No data submitted."; // If no POST data, alert user
        }
    }
    public function verifyOtp()
    {
        $enteredOtp = $this->input->post('otp');
        $sessionOtp = $this->session->userdata('otp');
        $contact = $this->session->userdata('login_user_contact');

        // Use the model function to get user by email
        $user = $this->CommonModel->getUserByContact($contact);

        if ($user) {
            // Email exists; now check the OTP
            if ($enteredOtp == $sessionOtp) {
                // OTP matched, proceed with login or registration
                $this->session->set_userdata('login_user_id', $user->user_id); // Store user ID in session
                $response = ['success' => true];
            } else {
                // OTP mismatch
                $response = ['success' => false];
            }
        } else {
            // Handle case where email doesn't exist
            $response = ['success' => false, 'message' => 'Contact does not exist.'];
        }

        echo json_encode($response);
    }
    public function profile()
    {
        // echo '<pre>';
        // print_r($this->profile);
        if (!$this->session->has_userdata('login_user_id')) {
            redirect(base_url());
        }
        $data['login_user'] = $this->session->userdata();
        $data['profiledata'] = $this->CommonModel->getRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'))[0];
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $savedata = $this->CommonModel->updateRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'), $post);
            if ($savedata) {
                $this->session->set_flashdata('msg', 'Profile Updated Sucessfully');
                $this->session->set_flashdata('msg_class', 'alert-success');
            } else {
                $this->session->set_userdata('msg', 'Profile Updated Sucessfully ');
                $this->session->set_flashdata('msg_class', 'alert-danger');
            }
            redirect(base_url('profile'));
        } else {
            $data['title'] = 'Profile -  | Your One Care Medical';
            $data['logo'] = 'assets/logo.png';
            $data['contact'] = $this->contact;
            $data['setting'] = $this->setting;
            $this->load->view('profile', $data);
        }
    }
    public function cancelorder()
    {
        $id = $this->input->post('id');
        $upd = $this->CommonModel->updateRowById('checkout', 'id', $id, array('status' => '2', 'cancel_by' => 'Customer'));
        if ($upd) {
            echo '0';
        } else {
            echo '1';
        }
    }
    public function ordercancelcutomer($orderId)
    {
        if (count($_POST) > 0) {
            $upd = $this->CommonModel->updateRowById('book_product', 'order_id', $orderId, array('booking_status' => '2', 'cancel_date' => setDateOnly(), 'cancel_by' => 'Customer', 'additionalComments' => $_POST['additionalComments'], 'cancelReason' => $_POST['cancelReason']));
            if ($upd) {
                $this->session->set_userdata('cancel', '<div class="alert alert-success py-2 mt-2">Your order ' . $orderId . ' has been cancelled</div>');
            } else {
                $this->session->set_userdata('cancel', '<div class="alert alert-danger py-2 mt-2">please try again</div>');
            }
            redirect(base_url('orders'));
        }

        $data['title'] = 'Profile -  | Your One Care Medical';
        $data['logo'] = 'assets/logo.png';
        $data['contact'] = $this->contact;
        $data['orderId'] = $orderId;
        $this->load->view('cancelorder', $data);
    }
    public function returnorder()
    {
        $id = $this->input->post('id');
        $upd = $this->CommonModel->updateRowById('checkout', 'id', $id, array('status' => '5'));
        if ($upd) {
            return '0';
        } else {
            return '1';
        }
    }
    public function orderDetails($checkoutID = true)
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect(base_url());
        }
        $data['login_user'] = $this->session->userdata();
        $data['orderDetails'] = $this->CommonModel->getRowByIdInOrder('checkout', array('user_id' => $this->session->userdata('login_user_id')), 'id', 'DESC');
        $data['orderProductDetails'] = $this->CommonModel->getRowById('checkout_product', 'product_book_id', $checkoutID);
        $data['title'] = 'Orde Details -  | Your One Care Medical';
        $data['logo'] = 'assets/logo.png';
        $data['contact'] = $this->contact;
        $this->load->view('orderDetails', $data);
    }
    public function checkPromo()
    {
        $promocode = $this->input->post('promocode');
        echo json_encode($this->CommonModel->getRowById('promocode', 'promocode', $promocode));
    }
    public function orderInvoice($checkoutID = true)
    {
        if (!$this->session->has_userdata('login_user_id')) {
            redirect(base_url());
        }
        $data['orderDetails'] = $this->CommonModel->getRowById('checkout', 'id', $checkoutID);
        $data['orderProductDetails'] = $this->CommonModel->getRowById('checkout_product', 'product_book_id', $checkoutID);
        $data['title'] = ' Your Order Invoice -  | Your One Care Medical';
        $data['logo'] = 'assets/logo.png';
        $data['contact'] = $this->contact;
        $this->load->view('orderInvoice', $data);
    }
    public function logout()
    {
        $this->session->unset_userdata('login_user_id');
        $this->session->unset_userdata('login_user_name');
        $this->session->unset_userdata('login_user_emailid');
        $this->session->unset_userdata('login_user_contact');
        $this->session->unset_userdata('login_user_type');
        redirect(base_url());
    }
    public function pgtest()
    {
        $post['name'] = 'Sagar';
        $post['email_id'] = 'email@email.com';
        $post['contact_no'] = '9999999999';
        $post['payment_title'] = 'Payment';
        $post['payment_description'] = 'Package Desc';
        $post['payment_amount'] = 1000;
        $post['order_id'] = 'ORD1112233';
        $post['redirect_url'] = 'http://xyz.com/return';

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

        $check_resp = json_decode($response, true);

        print_r($response);
    }
    public function checkout()
    {
        // if (!$this->session->has_userdata('login_user_id')) {
        //     $this->session->set_userdata('msg', '<h6 class="alert alert-danger">Please login to Continue.</h6>');
        //     redirect(base_url());
        // }



        if (count($this->cart->contents()) <= 0) {
            redirect('/product');
        }
        $data['login'] = $this->CommonModel->getRowById('user_registration', 'user_id', $this->session->userdata('login_user_id'));
        $data['state_list'] = $this->CommonModel->getAllRows('state');
        $data['promocode'] = $this->CommonModel->getAllRows('promocode');
        $data['gst'] = $this->CommonModel->getSingleRowById('setting', ['id' => 1]);
        $data['delivery'] = $this->CommonModel->getAllRows('delivery_charge')[0];
        $data['title'] = 'Checkout';
        $grand_total = 0;
        $ga = 0;
        if (count($_POST) > 0) {
            $this->load->library('form_validation');

            // Set validation rules
            $this->form_validation->set_rules('contact_no', 'Contact Number', 'required|numeric|min_length[10]|max_length[10]');
            // $this->form_validation->set_rules('name', 'Name', 'required|alpha');
            $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z ]+$/]');

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            // Check if validation passes
            if ($this->form_validation->run() == FALSE) {
                // Validation failed; load the view with errors
                $data['errors'] = validation_errors();
                // redirect($_SERVER['HTTP_REFERER']);
                $this->load->view('checkout', $data);
            } else {
                // Proceed if validation passes
                if ($_FILES['prescription_image']['name'] != '') {
                    $file_extension = pathinfo($_FILES['prescription_image']['name'], PATHINFO_EXTENSION);
                    $allowed_extensions = ['png', 'jpg', 'jpeg', 'webp', 'pdf'];

                    if (in_array(strtolower($file_extension), $allowed_extensions)) {
                        // Valid extension, proceed with upload
                        $postdata['prescription_image'] = imageWithpdfUpload('prescription_image', 'upload/prescription/', '');
                    } else {
                        $data['file_error'] = 'Only .png, .jpg, .jpeg, .webp, and .pdf files are allowed.';
                        $this->load->view('checkout', $data); // Reload view with file error
                        return; // Stop further execution
                    }
                } else {
                    // If no file is uploaded and it is required, set an error message
                    $data['file_error'] = 'Please upload a valid file.';
                }
                //  if ($_FILES['prescription_image']['name'] != '') {
                //     $postdata['prescription_image'] = imageUpload('prescription_image', 'upload/prescription/', '');
                // }
                if ($this->input->post('final_amount') > 0) {
                    // echo '<pre>';
                    $postdata = $this->input->post();
                    $postdata['same_as_billing'] = (($this->input->post('same_as_billing') !== null) ? '1' : '0');
                    $postdata['order_id'] = (sessionId('order_id')) ? sessionId('order_id') : orderIdGenerateUser();
                    $postdata['booking_date'] = setDateOnly();
                    $postdata['create_date'] = setDateTime();
                    $postdata['status'] = 0;

                    $datas = $this->CommonModel->getRowByMoreId('user_registration', array('contact_no' => $postdata['contact_no']));

                    if (count($datas) > 0) {

                        $postdata['user_id'] = $datas[0]['user_id'];
                    } else if (empty($datas)) {
                        $insertData = array(
                            'contact_no' => $postdata['contact_no'],
                            'name' => $postdata['name'],
                            'email_id' => $postdata['email'],
                        );

                        $insertStatus = $this->CommonModel->insertRowReturnId('user_registration', $insertData);
                        $postdata['user_id'] = $insertStatus;
                    } else {

                        $postdata['user_id'] = 0;
                    }
                    if (sessionId('order_id')) {
                        $post_checkout_data = $this->CommonModel->getSingleRowById('book_product', ['order_id' => sessionId('order_id')]);
                    } else {
                        $post_checkout_data = false;
                    }
                    $total_item_amount = 0;
                    $total_item_amount_mp = 0;
                    foreach ($this->cart->contents() as $items):
                        $gst_amt = ($items['price'] * ((int) $data['gst']['particular_value'] / 100));
                        $price = $items['price'] - $gst_amt;
                        $ga += $items['price'] * $items['qty'];
                        $total_item_amount += $items['price'];
                        $total_item_amount_mp = $items['market_price'];
                        $mydata[] = array(
                            'create_date' => setDateTime(),
                            'order_id' => $postdata['order_id'],
                            'no_of_items' => $items['qty'],
                            'base_price' => $items['market_price'],
                            'user_price' => (int) $price,
                            'booking_price' => ($price * $items['qty']),
                            'gst_amt' => (int) ($gst_amt * $items['qty']),
                            'gst_per' => $data['gst']['particular_value'],
                            'product_id' => explode('-', $items['id'])[0],
                            'product_img' => $items['image'],
                            'product_name' => clean($items['name']),
                            'variant_id' => $items['variant'],
                            'variant_name' => clean($items['variant_name']),
                            'is_variant' => (($items['variant'] != 0) ? 1 : 0),
                        );
                    endforeach;
                    $grand_total = ($ga - $postdata['promocode_amount']) + $postdata['shipping_charges'];
                    // Apply 5% discount on online payment
                    $discount_amount = $grand_total * 0.05;
                    $grand_total -= $discount_amount;

                    $postdata['promocode_status'] = ($postdata['promocode_amount'] > 0) ? 1 : 0;
                    $postdata['online_payment_discount'] = (($postdata['payment_mode'] == '2') ? $discount_amount : 0);
                    $postdata['total_item_amount'] = $total_item_amount;
                    $postdata['total_item_amount_mp'] = $total_item_amount_mp;
                    $postdata['final_amount'] = $total_item_amount + $postdata['shipping_charges'] - $postdata['promocode_amount'] - (($postdata['payment_mode'] == '2') ? $discount_amount : 0);
                    $postdata['booking_status'] = '2';
                    if ($post_checkout_data) {
                        $post = $this->CommonModel->updateRowById('book_product', 'order_id', sessionId('order_id'), $postdata);
                    } else {

                        $post = $this->CommonModel->insertRowReturnId('book_product', $postdata);
                        $insert2 = $this->CommonModel->insertRowInBatch('book_item', $mydata);
                    }

                    if ($post != '') {
                        if ($this->input->post('payment_mode') == '1') {
                            $invoice = ['orderlist' => ['orderDate' => date('d-m-y'), 'order_id' => $postdata['order_id'], 'name' => $postdata['name'], 'number' => $postdata['contact_no'], 'email' => $postdata['email'], 'grand_total' => $ga], 'order' => $postdata, 'products' => $mydata, 'contact' => $this->contact];
                            mailmsg($postdata['email'], 'Order Confirm -  Healthcare pvt ltd', $this->load->view('invoice-mail', $invoice, true));
                            redirect(base_url('booking-status?order=' . $postdata['order_id']));
                            exit();
                        } else {
                            $checkout_id = $this->session->userdata('login_user_id');
                            $curl = curl_init();
                            $data = base64_encode(json_encode([
                                "merchantId" => "M22VH7P8FJBXB",
                                "merchantTransactionId" => $postdata['order_id'],
                                "merchantUserId" => "MUID12633",
                                "amount" => $postdata['final_amount'] * 100,
                                "redirectUrl" => base_url() . "UserHome/redirect",
                                "redirectMode" => "POST",
                                "callbackUrl" => base_url() . "UserHome/callback",
                                "mobileNumber" => "9999999999",
                                "paymentInstrument" => [
                                    "type" => "PAY_PAGE"
                                ],
                                "param1" => $checkout_id
                            ]));

                            $request = hash('sha256', $data . '/pg/v1/pay' . '5705f67c-e481-434f-a9c3-f60934123ba0') . '###1';
                            curl_setopt_array($curl, [
                                CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 30,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "POST",
                                CURLOPT_POSTFIELDS => json_encode([
                                    'request' => $data
                                ]),
                                CURLOPT_HTTPHEADER => [
                                    "Content-Type: application/json",
                                    "X-VERIFY: {$request}",
                                    "accept: application/json"
                                ],
                            ]);

                            $response = curl_exec($curl);
                            $err = curl_error($curl);

                            curl_close($curl);

                            if ($err) {
                                echo "cURL Error #:" . $err;
                            } else {
                                $responces = json_decode($response, true);
                                redirect($responces['data']['instrumentResponse']['redirectInfo']['url']);
                            }
                        }
                    } else {
                        echo 'Check Form Data';
                    }
                }
            }

        } else {
            $data['contact'] = $this->contact;
            $data['setting'] = $this->setting;
            $this->load->view('checkout', $data);
        }
    }
    public function redirect()
    {

        if (count($_POST) > 0) {

            $this->CommonModel->updateRowById('book_product', 'order_id', $_POST['transactionId'], array('payment_status' => $_POST['code'], 'receipt_status' => '1', 'transaction_status' => $_POST['code'] == 'PAYMENT_SUCCESS' ? '1' : '2', 'booking_status' => $_POST['code'] == 'PAYMENT_SUCCESS' ? '0' : '2'));
            $checkout = $this->CommonModel->getSingleRowById('book_product', array('order_id' => $_POST['transactionId']));
            $login_data = $this->CommonModel->getSingleRowById('user_registration', array('user_id' => $checkout['user_id']));

            // Set session data
            $this->session->set_userdata([
                'login_user_id' => $login_data['user_id'],
                'login_user_name' => $login_data['name'],
                'login_user_emailid' => $login_data['email_id'],
                'login_user_contact' => $login_data['contact_no']
            ]);
            $data['logo'] = 'assets/logo.png';
            $data['company'] = " Care 1";
            $data['title'] = 'Payment Successfull';
            $msg = ' <h2><i class="fa fa-check-circle-o true-icon" aria-hidden="true"></i> ' . (($_POST['code'] == 'PAYMENT_SUCCESS') ? 'Thank You' : 'Oops') . ' !</h2>
                                <div class="checkbox-form">
                                    <div class="row">
                                        <div class="col-md-12 thankyou-boxes">
                                            <h3>Your order is ' . (($_POST['code'] == 'PAYMENT_SUCCESS') ? 'Confirmed' : 'Failed') . '</h3>
                                            <p>' . (($_POST['code'] == 'PAYMENT_SUCCESS') ? 'You will receive an email when your order is ready.' : '') . '</p>
                                        </div>
                                       ';
            $msg .= '<div class="col-md-12 thankyou-boxes">Transaction ID: ' . $_POST['transactionId'] . '</div>';
            $msg .= '  <div class="col-md-12 thankyou-boxes"> Order ID: ' . $_POST['merchantOrderId'] . '</div>';
            $msg .= ' <div class="col-md-12 thankyou-boxes ' . ($_POST['code'] == 'PAYMENT_SUCCESS') ? '' : 'd-none' . '">
                                            <h3>Order updates</h3>
                                            <p>You will get shipping and delivery updates by email.</p>
                                        </div>
                                        
                             </div>';
            $data['message'] = $msg;
            $data['setting'] = $this->setting;
            $this->cart->destroy();
            $this->load->view('payment_msg', $data);
        } else {
            redirect(base_url());
        }
    }
    public function callback()
    {
        $data['logo'] = 'assets/logo.png';
        $data['company'] = " care 1";
        $data['title'] = 'Payment Failed';
        $msg = '';
        $msg .= ' <h2><i class="fa fa-check-circle-o true-icon" aria-hidden="true"></i> Payemnt failed !</h2>
                                <div class="checkbox-form">
                                    <div class="row">
                                        <div class="col-md-12 thankyou-boxes">
                                            <h3>Your order is ' . (($_POST['code'] == 'PAYMENT_SUCCESS') ? 'Confirmed' : 'Failed') . '</h3>
                                            <p>' . (($_POST['code'] == 'PAYMENT_SUCCESS') ? 'You will receive an email when your order is ready.' : '') . '</p>
                                        </div>
                                       ';
        $msg .= '<div class="col-md-12 thankyou-boxes">Transaction ID: ' . $_POST['transactionId'] . '</div>';
        $msg .= '  <div class="col-md-12 thankyou-boxes"> Order ID: ' . $_POST['merchantOrderId'] . '</div>';
        $msg .= ' <div class="col-md-12 thankyou-boxes ' . ($_POST['code'] == 'PAYMENT_SUCCESS') ? '' : 'd-none' . '">
                                            
                                        </div>
                                        
                             </div>';
        $data['message'] = $msg;
        $this->load->view('payment_msg', $data);
    }
    public function checkout_save()
    {
        $ga = 0;
        // $data['gst'] = $this->CommonModel->getSingleRowById('setting', ['id' => 1]);
        if (count($_POST) > 0) {
            $postdata = $this->input->post();
            $postdata['same_as_billing'] = (($this->input->post('same_as_billing') !== null) ? '1' : '0');
            $orderId = orderIdGenerateUser();
            $postdata['order_id'] = $orderId;
            $postdata['booking_date'] = setDateOnly();
            $postdata['create_date'] = setDateTime();
            $postdata['status'] = 10;
            if (sessionId('order_id')) {
                $post_checkout_data = $this->CommonModel->getSingleRowById('book_product', ['order_id' => sessionId('order_id')]);
            } else {
                $post_checkout_data = false;
            }

            if ($post_checkout_data) {
                $post = $this->CommonModel->updateRowById('book_product', 'order_id', sessionId('order_id'), $postdata);
                $post_delete = $this->CommonModel->deleteRowById('book_item', ['order_id' => sessionId('order_id')]);
            } else {
                $post = $this->CommonModel->insertRowReturnId('book_product', $postdata);
            }
            // $gst_at = 0;
            if (count($this->cart->contents()) > 0) {
                foreach ($this->cart->contents() as $items):
                    // $gst_amt = ($items['price'] * ((int) $data['gst']['particular_value'] / 100));
                    $price = $items['price'];
                    $mydata[] = array(
                        'create_date' => setDateTime(),
                        'order_id' => $orderId,
                        'no_of_items' => $items['qty'],
                        'base_price' => $items['market_price'],
                        'user_price' => (int) $price,
                        'booking_price' => ($price * $items['qty']),
                        // 'gst_amt' => (int) ($gst_amt * $items['qty']),
                        // 'gst_per' => $data['gst']['particular_value'],
                        'product_id' => explode('-', $items['id'])[0],
                        'product_img' => $items['image'],
                        'product_name' => clean($items['name']),
                        'variant_id' => $items['variant'],
                        // 'variant_name' => clean($items['variant_name']),
                        // 'is_variant' => (($items['variant'] != 0) ? 1 : 0),

                    );
                    $ga += $items['price'] * $items['qty'];
                endforeach;
                $insert2 = $this->CommonModel->insertRowInBatch('book_item', $mydata);
            }

            if ($post != '') {
                setSession(['order_id' => $orderId]);
                echo json_encode(['status' => 200, 'message' => 'checkout saved']);
            } else {
                echo json_encode(['status' => 202, 'message' => 'checkout not saved']);
            }
        }
    }
    public function payment_msg()
    {
        // print_R($_POST);
        if ($_POST) {
            $insert2 = $this->CommonModel->updateRowById('book_product', 'order_id', $_POST['order_id'], ['transaction_status' => ($_POST['transaction_status'] == 'Success') ? '1' : '2', 'payment_id' => $_POST['order_id']]);
            $checkoutdata = $this->CommonModel->getSingleRowById('book_product', ['order_id' => $_POST['order_id']]);
            // print_r($_POST);exit;
            $data['order_id'] = $_POST['order_id'];
            $data['transaction_status'] = $_POST['transaction_status'];
            $data['payment_amount'] = $_POST['payment_amount'];
            $msg = '';
            $msg .= '<img src="assets/img/order.png" alt="Booking" style="max-width: 250px;"/>';
            $msg .= "<h1>Order Placed</h1>";
            $msg .= "<h3 class=" . (($_POST['transaction_status'] == 'Success') ? 'text-success' : 'text-danger') . ">Payment status is " . $_POST['transaction_status'] . "</h3>";
            $msg .= "<p>We're prepping your order.You will be notified regarding the order shipment shortly .<br/>
                Till then happy shopping<br>
                <b>Order ID</b> : " . $_POST['order_id'] . "<br>
                
                <b>Payment Amount</b> : Rs. " . $_POST['payment_amount'] . "</p>";
            $msg .= "<br/>";
            if ($_POST['transaction_status'] == 'Success') {

                $post = $this->CommonModel->getRowById('book_item', 'order_id', $_POST['order_id']);


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
                mailmsg($checkoutdata['email'], 'Order Confirm -  Healthcare pvt ltd', $this->load->view('invoice-mail', $invoice, true));
            }
            $data['message'] = $msg;
            // <b>Transaction Status</b> : ".$_POST['transaction_status']."<br>
            $this->cart->destroy();
            $data['contact'] = $this->contact;
            $data['orders'] = $this->CommonModel->getSingleRowById('book_product', ["order_id" => $_GET['order']]);
            $data['itemDetails'] = getRowById('book_item', 'order_id', $_GET['order']);
            $this->load->view('payment_msg', $data);
        } else {
            echo 'Invalid responce';
        }
    }
    public function booking_status()
    {
        if (count($this->cart->contents()) > 0) {
            $this->cart->destroy();
        } else {
        }
        $data['logo'] = 'assets/logo.png';
        $data['title'] = 'Payment Status -  | Your One Care Medical';
        $msg = '';
        $msg .= '<img src="assets/img/order.png" alt="Booking" style="max-width: 100px;"/>';
        $msg .= "<h1>Order Placed</h1>";
        $msg .= "<p>We're prepping your order. You will be notified regarding the order shipment shortly .<br/>
        Till then happy shopping</p>";
        $msg .= "<br/>";
        $data['message'] = $msg;
        $data['contact'] = $this->contact;
        if (isset($_GET['order'])) {
            $data['orders'] = $this->CommonModel->getSingleRowById('book_product', ["order_id" => $_GET['order']]);
            $data['itemDetails'] = getRowById('book_item', 'order_id', $_GET['order']);
            $this->load->view('payment_msg', $data);
        } else {
            // $this->load->view('payment_msg', $data);
        }
    }
    public function getcity()
    {
        $state = $this->input->post('state');
        $stateid = $this->CommonModel->getRowByMoreId('state', ['state_name' => $state])[0];
        $data['city'] = $this->CommonModel->getRowByIdInOrder('city', array('state_id' => $stateid['state_id']), 'city_name', 'asc');
        $data['contact'] = $this->contact;
        $this->load->view('dropdown', $data);
    }
    public function privacy_policy()
    {
        $data['pp'] = $this->CommonModel->getRowById('policy', 'ppid', '1');
        $data['title'] = 'Privacy Policy';
        $data['contact'] = $this->contact;
        $this->load->view('privacy-policy', $data);
    }
    public function shipping_policy()
    {
        $data['pp'] = $this->CommonModel->getRowById('policy', 'ppid', '3');
        $data['title'] = 'Shipping Policy';
        $data['contact'] = $this->contact;
        $this->load->view('shipping-policy', $data);
    }
    public function term_condition()
    {
        $data['pp'] = $this->CommonModel->getRowById('policy', 'ppid', '5');
        $data['title'] = 'Terms & Condition ';
        $data['contact'] = $this->contact;
        $this->load->view('term-condition', $data);
    }
    public function about()
    {
        $data['title'] = 'About Us';
        // $data['testimonial'] = $this->CommonModel->getAllRowsInOrder('testimonial', 'id', 'desc');
        $data['contact'] = $this->contact;
        $data['setting'] = $this->setting;
        $this->load->view('about', $data);
    }
    public function login_check()
    {
        if (count($_POST) > 0) {
            extract($this->input->post());
            $table = "user_registration";
            $login_data = $this->CommonModel->getSingleRowById($table, ['email_id' => $email]);
            if (!empty($login_data)) {
                if ($type == 'get_otp') {
                    $otp = rand(1000, 9999);
                    $login_data_updated = $this->CommonModel->updateRowById($table, 'email_id', $email, ['otp' => $otp]);
                    mailmsg($email, 'OTP from ', $otp . ' is the OTP');
                    print_r(json_encode([
                        'status' => 200,
                        'message' => 'OTP Sent',
                        'otp' => $otp,
                    ]));
                } elseif ($type == 'resend_otp') {
                    $otp = rand(1000, 9999);
                    $login_data_updated = $this->CommonModel->updateRowById($table, 'email_id', $email, ['otp' => $otp]);
                    mailmsg($email, 'OTP from ', $otp . ' is the OTP');
                    print_r(json_encode([
                        'status' => 200,
                        'message' => 'OTP Resent',
                        'otp' => $otp,
                    ]));
                } elseif ($type == 'check_otp') {
                    if ($login_data['otp'] == $otp) {
                        setsessionData('login_user_id', $login_data['user_id']);
                        print_r(json_encode([
                            'status' => 200,
                            'message' => 'OTP matched',
                        ]));
                    } else {
                        print_r(json_encode([
                            'status' => 400,
                            'message' => 'OTP doesn\'t match'
                        ]));
                    }
                }
            } else {
                $otp = rand(1000, 9999);
                $login_data_inserted = $this->CommonModel->insertRowReturnId($table, ['email_id' => $email]);
                $this->CommonModel->updateRowById($table, 'email_id', $email, ['otp' => $otp]);
                mailmsg($email, 'OTP from ', $otp . ' is the OTP');
                print_r(json_encode([
                    'status' => 200,
                    'message' => 'User registered successfully and OTP sent',
                    'otp' => $otp,
                ]));
            }
        }
    }
    public function get_otp()
    {
        $responce = [];
        $contactno = $this->input->post('contactno');
        $otp = rand(1000, 10000);
        $data = $this->CommonModel->getNumRows('user_registration', array('contact_no' => $contactno));
        if ($data == 1) {
            $this->session->set_userdata('otp', $otp);
            $responce['login_msg'] = 'Enter OTP sent to your given Whatsapp number to login to your account';
            $msg = $otp . " is the verification code to log in to your  Healthcare account.";
            $responce['wp_resp'] = sendOTP($contactno, $msg);
            if ($responce['wp_resp']['status'] == false) {
                $message_content = "Hi, Your OTP for verify your mobile number is $otp. Valid for 30 minutes. Please do not share this OTP.
                    Regards,
                    GNOSISACCRUE Team
                    ";
                $responce['mess'] = $message_content;
                $responce['sms_resp'] = sendTextMessage($contactno, $message_content);
            }
            $responce['status'] = '1';
            // $responce['otp'] = $otp;
        } else {

            $insertData = array(
                'contact_no' => $contactno,

            );

            $insertStatus = $this->CommonModel->insertRow('user_registration', $insertData);
            if ($insertStatus) {
                $this->session->set_userdata('otp', $otp);
                $responce['login_msg'] = 'Account created. Enter OTP sent to your given Whatsapp number to login to your account';
                $msg = $otp . " is the verification code to log in to your  Healthcare account.";

                sendOTP($contactno, $msg);
                $responce['status'] = '1';
                // $responce['otp'] = $otp;
            } else {
                $responce['login_msg'] = 'Unable to create account. Please try again later.';
                $responce['status'] = '0';
            }
        }

        echo json_encode($responce);
    }
    public function check_login_status()
    {
        $response = [];

        if ($this->session->userdata('logged_in')) {
            $response['logged_in'] = true;
        } else {
            $response['logged_in'] = false;
        }

        echo json_encode($response);
    }
    public function verify_otp()
    {
        $responce = [];
        $contactno = $this->input->post('contactno');
        $otp = $this->input->post('otp');
        $data = $this->CommonModel->getNumRows('user_registration', array('contact_no' => $contactno));
        // print_r($data); exit;
        if ($data == 0) {
            $responce['status'] = 'Breach identified';
        } elseif ($data == 1) {
            if ($this->session->userdata('otp') == $otp) {
                $login_data = $this->CommonModel->getSingleRowById('user_registration', array('contact_no' => $contactno));
                $session = $this->session->set_userdata(array('login_user_id' => $login_data['user_id'], 'login_user_name' => $login_data['name'], 'login_user_emailid' => $login_data['email_id'], 'login_user_contact' => $login_data['contact_no']));
                $this->session->unset_userdata('otp');
                $responce['login_msg'] = 'OTP verified';
                if (count($this->cart->contents()) > 0) {
                    $responce['status'] = '3';
                } else {
                    $responce['status'] = '1';
                }
            } else {
                // $responce['login_msg'] = 'Wrong OTP';
                $responce['login_msg'] = 'Wrong OTP';
                $responce['status'] = '2';
            }
        } else {
            $responce['login_msg'] = 'Account Not found with this Number.';
            $responce['status'] = '0';
        }
        $responce['otp'] = $this->session->userdata('otp');
        echo json_encode($responce);
    }
    public function check_login()
    {
        $responce = [];
        $contactno = $this->input->post('contact');
        $otp = rand(1000, 10000);
        $data = $this->CommonModel->getNumRows('user_registration', array('contact_no' => $contactno));
        if ($data == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function check_otp()
    {
        $responce = [];
        $contactno = $this->input->post('uname');
        $otp = $this->input->post('otp');

        $login_data = $this->CommonModel->getSingleRowById('user_registration', array('contact_no' => $contactno));
        $session = $this->session->set_userdata(array('login_user_id' => $login_data['user_id'], 'login_user_name' => $login_data['name'], 'login_user_emailid' => $login_data['email_id'], 'login_user_contact' => $login_data['contact_no']));

        if (count($this->cart->contents()) > 0) {
            echo '3';
        } else {
            echo '1';
        }
    }
    public function deleteUser()
    {
        echo json_encode(['status' => false, 'message' => 'Enter valid user id']);
    }
    public function testMail()
    {
        $checkoutdata = $this->CommonModel->getSingleRowById('book_product', ['order_id' => 'TXN241803034933']);
        $post = $this->CommonModel->getRowById('book_item', 'order_id', 'TXN241803034933');
        $productInfo = [];
        // this
        $ga = 0;
        $gst_at = 0;
        $gst = $this->CommonModel->getSingleRowById('setting', ['id' => 1]);

        foreach ($post as $items):
            $product = $this->CommonModel->getRowByIdfield('product', 'product_id', $items['product_id'], array('product_id', 'sale_price', 'product_name', 'quantity_type'));
            $imgdata = getSingleRowById('product_image', array('product_id' => $items['product_id']));
            // this
            $gst_amt = ($product[0]['sale_price'] * ((int) $gst['particular_value'] / 100));
            $price = $product[0]['sale_price'] - $gst_amt;
            $ga += ($price * $items['qty']);
            $gst_at += $gst_amt;
            $inv_product = array(
                'create_date' => setDateTime(),
                'order_id' => $checkoutdata['order_id'],
                'product_img' => $imgdata['image_path'],
                'no_of_items' => $items['no_of_items'],
                'product_name' => clean($product[0]['product_name']),
                'product_price' => $price,
            );
            array_push($productInfo, $inv_product);
        endforeach;
        $invoice['gst'] = $gst_at;
        $invoice['order'] = $checkoutdata;
        $invoice['products'] = $productInfo;
        $invoice['contact'] = $this->contact;
        $this->load->view('invoice-mail', $invoice);
    }
    public function save_review()
    {
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $post['video_review'] = upload_video('video_review', 'upload/video_review/');
            $post['user_id'] = sessionId('login_user_id');
            $insert = $this->CommonModel->insertRowReturnId('product_review', $post);
            if ($insert) {
                echo '1';
            } else {
                echo '2';
            }
        } else {
            echo '3';
        }
    }
    public function pagenotfound()
    {
        // $data['pp'] = $this->CommonModel->getRowById('policy', 'ppid', '5');
        $data['title'] = 'Terms & Condition -  | Your One Care Medical';
        $this->load->view('pagenotfound', $data);
    }
    public function reorder($order_id)
    {
        // $data['allOrders'] = $this->CommonModel->getSingleRowById('book_product', ['order_id' => $order_id]);
        $itemDetails = getRowById('book_item', 'order_id', $order_id);
        if ($itemDetails) {
            $j = 0;
            foreach ($itemDetails as $item) {
                $product_variant = $this->CommonModel->getSingleRowById('product_variant', ['id' => $item['variant_id']]);
                $imgdata = getSingleRowById('product_image', array('product_id' => $item['product_id']));
                $product = getSingleRowById('product', "product_id = '{$item['product_id']}'");
                $data = array(
                    'id' => $item['product_id'] . '-' . $item['variant_id'],
                    'variant' => $item['variant_id'],
                    'qty' => $item['no_of_items'],
                    'quantity_type' => $product['quantity_type'],
                    'price' => $product_variant['sale_price'],
                    'market_price' => $product_variant['market_price'],
                    'name' => clean($product['product_name']),
                    'variant_name' => clean($product_variant['product_title']),
                    'image' => $imgdata['image_path']
                );
                $this->cart->insert($data);
            }
        }
        redirect(base_url('checkout'));
    }
}
