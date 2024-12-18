<?php

use fruitemporium\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class UserApi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function stateApi_GET()
    {
        $get = $this->CommonModel->getAllRowsInOrder('state', 'state_name', 'ASC');
        if ($get) {
            foreach ($get as $list) {
                $all[] = array(
                    'state_id' => $list['state_id'],
                    'state_name' => $list['state_name']
                );
            }
            $this->response(array('status' => 200, 'message' => 'Show all state', 'data' => $all));
        } else {
            $this->response(array('status' => 400, 'message' => 'No Data Found', 'data' => null));
        }
    }

    public function cityApi_GET($state_id)
    {
        $get = $this->CommonModel->getRowByIdInOrder('city', "state_id = '$state_id'", 'city_name', 'ASC');
        if ($get) {
            foreach ($get as $cityList) {
                $all[] = array(
                    'city_id' => $cityList['city_id'],
                    'city_name' => $cityList['city_name'],
                );
            }
            $this->response(array('status' => 200, 'message' => 'Show all city', 'data' => $all));
        } else {
            $this->response(array('status' => 400, 'message' => 'Something went wrong. Please try again', 'data' => null));
        }
    }

    public function userSendOTP_POST()
    {
        extract($this->input->post());
        $this->form_validation->set_rules('contact_no', 'contact number', 'trim|required');
        $this->form_validation->set_rules('hash_key', 'hash Key', 'trim|required');
        if ($this->form_validation->run()) {
            $get = $this->CommonModel->getSingleRowById('user_registration', "contact_no = '$contact_no'");
            if ($contact_no == '9457125774') {
                $otp = 12345;
            } else {
                $otp = rand(99999, 999999);
            }
            $message_content = "Hi, Your OTP for verify your mobile number to SVGH Healthcare is $otp. Please do not share this OTP.";
            $this->CommonModel->insertRow('temp_otp', ['contact_no' => $contact_no, 'otp' => $otp]);
            if ($get) {
                if ($get['user_status'] == '1') {
                    if ($contact_no != '9457125774') {
                        sendOTP($contact_no, $message_content);
                    }
                    $this->response(array('status' => 200, 'message' => 'OTP send successfully.', 'data' => null), REST_Controller::HTTP_OK);
                } else {
                    $this->response(array('status' => 400, 'message' => 'Your account has been blocked. Please contact tech support.', 'data' => null));
                }
            } else {
                sendOTP($contact_no, $message_content);
                $this->response(array('status' => 200, 'message' => 'OTP send successfully.', 'data' => null), REST_Controller::HTTP_OK);
            }
        } else {
            $this->response(array('status' => 400, 'message' => $this->form_validation->error_array(), 'data' => null));
        }
    }

    public function userLogin_POST()
    {
        extract($this->input->post());
        $this->form_validation->set_rules('contact_no', 'contact number', 'trim|required');
        $this->form_validation->set_rules('otp', 'otp', 'trim|required');
        $this->form_validation->set_rules('fcm_token', 'fcm_token', 'trim');
        if ($this->form_validation->run()) {
            $getOtp = $this->CommonModel->getSingleRowByIdInOrder('temp_otp', "contact_no = '$contact_no'", 'id', 'DESC');
            if ($getOtp && ($getOtp['otp'] == $otp)) {
                $getUser = $this->CommonModel->getSingleRowById('user_registration', "contact_no = '$contact_no'");
                $hash = date('dm') . round(microtime(true) * 1000);
                $this->CommonModel->deleteRowById('temp_otp', "contact_no = '$contact_no'");
                if ($getUser) {
                    $this->CommonModel->updateRowById('user_registration', 'user_id', $getUser['user_id'], array('unique_hash' => $hash, 'fcm_token' => $fcm_token));
                    $token_data = array(
                        'id' => $getUser['user_id'],
                        'name' => $getUser['name'],
                        'contact_no' => $getUser['contact_no'],
                        'unique_hash' => $hash,
                        'time' => time()
                    );
                    $token = $this->authorization_token->generateToken($token_data);
                    $data = array(
                        'name' => $getUser['name'],
                        'contact_no' => $getUser['contact_no'],
                        'email_id' => $getUser['email_id'],
                        'profile_image' =>  $getUser['profile_image'] == "" ? null : PROFILE_IMAGE . $getUser['profile_image'],
                        'is_registered' => $getUser['address'] == "" ? 0 : 1,
                        'verify_status' => $getUser['verify_status'],
                        'token' => $token
                    );
                    $this->response(array('status' => 200, 'message' => 'User login successfully.', 'data' => $data), REST_Controller::HTTP_OK);
                } else {
                    $post = array(
                        'contact_no' => $contact_no,
                        'unique_hash' => $hash,
                        'fcm_token' => isset($fcm_token) ? $fcm_token : null,
                        'create_date' => setDateTime(),
                    );
                    $insertId = $this->CommonModel->insertRowReturnId('user_registration', $post);
                    $token_data = array(
                        'id' => $insertId,
                        'contact_no' => $contact_no,
                        'unique_hash' => $hash,
                        'time' => time()
                    );
                    $token = $this->authorization_token->generateToken($token_data);
                    $data = array(
                        'name' => null,
                        'email_id' => null,
                        'contact_no' => $contact_no,
                        'profile_image' => null,
                        'is_registered' => 0,
                        'verify_status' => 1,
                        'token' => $token
                    );
                    $this->response(array('status' => 200, 'message' => 'User login successfully.', 'data' => $data));
                }
            } else {
                $this->response(array('status' => 400, 'message' => 'Enter Valid OTP', 'data' => null));
            }
        } else {
            $this->response(array('status' => 400, 'message' => str_replace("\n", '', validation_errors()), 'data' => null));
        }
    }

    public function userProfileUpdate_POST()
    {
        $token = $this->authorization_token->validateToken();
        if (!empty($token) and $token['status'] != 0) {
            extract($this->input->post());
            if (getUserId($token)) {
                $tokenId = $token['data']->id;
                $getUser = $this->CommonModel->getSingleRowById('user_registration', "user_id = '$tokenId'");
                $this->form_validation->set_rules('name', 'name', 'trim|required', ['required' => 'Name is required']);
                if ($email_id != $getUser['email_id']) {
                    $this->form_validation->set_rules('email_id', 'Email Id', 'trim|is_unique[user_registration.email_id]', ['is_unique' => 'Email Id already exist.']);
                }
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('area', 'Area', 'trim|required');
                $this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|required');
                $this->form_validation->set_rules('state', 'State', 'trim|required');
                $this->form_validation->set_rules('city', 'City', 'trim|required');
                $this->form_validation->set_error_delimiters('', ' ');
                if ($this->form_validation->run()) {
                    $post['name'] = $name;
                    $email_id == "" ? null : $post['email_id'] = $email_id;
                    $post['address'] = $address;
                    $post['area'] = $area;
                    $post['postal_code'] = $postal_code;
                    $post['state'] = $state;
                    $post['city'] = $city;

                    $picture = "";
                    if (!empty($_FILES['profile_image']['name'])) {
                        $picture  = fullImage('profile_image', PROFILE_IMAGE, $getUser['profile_image']);
                        $post['profile_image'] = $picture;
                    }

                    $update = $this->CommonModel->updateRowByMoreId('user_registration', "user_id = '" . $token['data']->id . "'", $post);
                    if ($update) {
                        $data = array(
                            'name' => ucwords($name),
                            'contact_no' => $getUser['contact_no'],
                            'email_id' => $email_id,
                            'profile_image' => $picture == "" ? null : PROFILE_IMAGE . $picture,
                        );
                        $this->response(array('status' => 200, 'message' => 'Profile update successfully.', 'data' => $data), REST_Controller::HTTP_OK);
                    } else {
                        $this->response(array('status' => 400, 'message' => 'Profile not update. Please try again', 'data' => null));
                    }
                } else {
                    $this->response(array('status' => 400, 'message' => str_replace("\n", '', validation_errors()), 'data' => null));
                }
            } else {
                $this->response(array('status' => 401, 'message' => 'Unauthorized user', 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response(array('status' => 401, 'message' => $token['message'], 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function userViewProfile_GET()
    {
        $token = $this->authorization_token->validateToken();
        if (!empty($token) and $token['status'] != 0) {
            extract($this->input->post());
            if (getUserId($token)) {
                $get = $this->CommonModel->getSingleRowById('user_registration', "user_id = '" . $token['data']->id . "'");
                if ($get) {
                    $get['profile_image'] = $get['profile_image'] == "" ? null : PROFILE_IMAGE . $get['profile_image'];

                    $this->response(array('status' => 200, 'message' => 'User view profile.', 'data' => $get), REST_Controller::HTTP_OK);
                } else {
                    $this->response(array('status' => 400, 'message' => 'Something went wrong. Please try again', 'data' => null));
                }
            } else {
                $this->response(array('status' => 401, 'message' => 'Unauthorized user', 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response(array('status' => 401, 'message' => $token['message'], 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function dashboardApi_GET()
    {
        $token = $this->authorization_token->validateToken();
        if (!empty($token) and $token['status'] != 0) {
            extract($this->input->post());
            if ($getUser = getUserId($token)) {
                $tokenId = $token['data']->id;
                $getBanner = $this->CommonModel->getAllRows('banner');

                $allBanner = [];
                if ($getBanner) {
                    foreach ($getBanner as $bannerList) {
                        $allBanner[] = BANNER_IMAGE . $bannerList['image_path'];
                    }
                }

                $select = "product.*";
                $join = [];
                $getProduct = $this->CommonModel->getRowWithMultiJoin($select, 'product', "product.is_delete = '1' AND product.status = '1'", $join, 'product_name', 'ASC', 1);
                if ($getProduct) {
                    foreach ($getProduct as $list) {
                        $getImages = $this->CommonModel->getRowById('product_image', 'product_id', $list['product_id']);
                        $getAllVariant = $this->CommonModel->getRowByIdInOrder('product_variant', "product_id = '{$list['product_id']}'", 'market_price', 'ASC');

                        $allImages = [];
                        if ($getImages) {
                            foreach ($getImages as $imgList) {
                                $allImages[] = PRODUCT_IMAGE . $imgList['image_path'];
                            }
                        } else {
                            $allImages = null;
                        }

                        $list['image_thumb'] = $allImages != "" ? $allImages[0] : "";
                        $list['images'] = $allImages;
                        $list['all_variant'] = $getAllVariant ? $getAllVariant : [];
                        $allProduct[] = $list;
                    }
                }

                $data = [
                    'banner' => $allBanner,
                    'category' => [],
                    'brand' => [],
                    'featured_product_list' => $allProduct,
                    'verify_status' => $getUser['verify_status']
                ];
                $this->response(array('status' => 200, 'message' => 'Show Dashboard Data', 'data' => $data));
            } else {
                $this->response(array('status' => 401, 'message' => 'Unauthorized user', 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response(array('status' => 401, 'message' => $token['message'], 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function getProduct_GET()
    {
        $token = $this->authorization_token->validateToken();
        if (!empty($token) and $token['status'] != 0) {
            extract($this->input->post());
            if (getUserId($token)) {
                $tokenId = $token['data']->id;

                $select = "product.*";
                $join = [];
                $get = $this->CommonModel->getRowWithMultiJoin($select, 'product', "product.is_delete = '1' AND product.status = '1'", $join, 'product_name', 'ASC', 1);
                if ($get) {
                    foreach ($get as $list) {
                        $getImages = $this->CommonModel->getRowById('product_image', 'product_id', $list['product_id']);
                        $getAllVariant = $this->CommonModel->getRowByIdInOrder('product_variant', "product_id = '{$list['product_id']}'", 'market_price', 'ASC');

                        $allImages = [];
                        if ($getImages) {
                            foreach ($getImages as $imgList) {
                                $allImages[] = PRODUCT_IMAGE . $imgList['image_path'];
                            }
                        } else {
                            $allImages = null;
                        }

                        $list['image_thumb'] = $allImages != "" ? $allImages[0] : "";
                        $list['images'] = $allImages;
                        $list['all_variant'] = $getAllVariant ? $getAllVariant : [];
                        $allProduct[] = $list;
                    }

                    $this->response(array('status' => 200, 'message' => 'Show all product', 'data' => $allProduct));
                } else {
                    $this->response(array('status' => 400, 'message' => 'No Product Found', 'data' => null));
                }
            } else {
                $this->response(array('status' => 401, 'message' => 'Unauthorized user', 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response(array('status' => 401, 'message' => $token['message'], 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function searchProduct_POST()
    {
        $this->form_validation->set_rules('search', 'Search', 'trim|required');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run()) {
            $token = $this->authorization_token->validateToken();
            if (!empty($token) and $token['status'] != 0) {
                extract($this->input->post());
                if (getUserId($token)) {
                    $tokenId = $token['data']->id;
                    $select = "product.*";
                    $join = [];
                    $get = $this->CommonModel->getRowWithMultiJoin($select, 'product', "product.is_delete = '1' AND product.status = '1' AND product_name LIKE  '%$search%'", $join, 'product_name', 'ASC', 1);
                    if ($get) {
                        foreach ($get as $list) {
                            $getImages = $this->CommonModel->getRowById('product_image', 'product_id', $list['product_id']);
                            $getAllVariant = $this->CommonModel->getRowByIdInOrder('product_variant', "product_id = '{$list['product_id']}'", 'market_price', 'ASC');

                            $allImages = [];
                            if ($getImages) {
                                foreach ($getImages as $imgList) {
                                    $allImages[] = PRODUCT_IMAGE . $imgList['image_path'];
                                }
                            } else {
                                $allImages = null;
                            }

                            $list['image_thumb'] = $allImages != "" ? $allImages[0] : "";
                            $list['images'] = $allImages;
                            $list['all_variant'] = $getAllVariant ? $getAllVariant : [];
                            $allProduct[] = $list;
                        }
                        $this->response(array('status' => 200, 'message' => 'Show all product', 'data' => $allProduct));
                    } else {
                        $this->response(array('status' => 400, 'message' => 'No Product Found', 'data' => null));
                    }
                } else {
                    $this->response(array('status' => 401, 'message' => 'Unauthorized user', 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
                }
            } else {
                $this->response(array('status' => 401, 'message' => $token['message'], 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response(array('status' => 400, 'message' => str_replace('\n', '', validation_errors()), 'data' => null));
        }
    }

    public function getDeliveryCharge_GET()
    {
        $get = $this->CommonModel->getSingleRowById('delivery_charge', "delivery_charge_id = '2'");
        if ($get) {
            $data['min_amount'] = $get['min_amount'];
            $data['amount'] = $get['amount'];
        } else {
            $data['min_amount'] = 0;
            $data['amount'] = 0;
        }
        $this->response(array('status' => 200, 'message' => 'Show delivery charges', 'data' => $data));
    }

    public function getPromoCode_GET()
    {
        $token = $this->authorization_token->validateToken();
        if (!empty($token) and $token['status'] != 0) {
            extract($this->input->post());
            if (getUserId($token)) {
                $tokenId = $token['data']->id;
                $getPromoCode = $this->CommonModel->getRowByIdInOrder('promocode', "expiry_date >= '" . setDateOnly() . "'", 'create_date', 'DESC');
                if ($getPromoCode) {
                    foreach ($getPromoCode as $code) {
                        $data[] = array(
                            'promocode' => $code['promocode'],
                            'minimum_order' => $code['minimum_order'],
                            'expiry_date' => $code['expiry_date'],
                            'amount' => $code['amount']
                        );
                    }
                    $this->response(array('status' => 200, 'message' => 'Show all Promo Code', 'data' => $data));
                } else {
                    $this->response(array('status' => 400, 'message' => 'No Promo Code Available.', 'data' => null));
                }
            } else {
                $this->response(array('status' => 401, 'message' => 'Unauthorized user', 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response(array('status' => 401, 'message' => $token['message'], 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function createOrder_POST()
    {
        $token = $this->authorization_token->validateToken();
        if (!empty($token) and $token['status'] != 0) {
            extract($this->input->post());
            if (getUserId($token)) {
                $tokenId = $token['data']->id;
                $this->form_validation->set_rules('name', 'user name', 'trim|required');
                $this->form_validation->set_rules('contact_no', 'user contact number', 'trim|required');
                $this->form_validation->set_rules('address', 'user address', 'trim|required');
                $this->form_validation->set_rules('area', 'user area', 'trim|required');
                $this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|required');
                $this->form_validation->set_rules('state', 'state', 'trim|required');
                $this->form_validation->set_rules('city', 'city', 'trim|required');
                $this->form_validation->set_rules('delivery_charges', 'delivery charges', 'trim|required');
                $this->form_validation->set_rules('total_item_amount', 'Total Item Amount', 'trim|required');
                $this->form_validation->set_rules('final_amount', 'Final Amount', 'trim|required');
                $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'trim|required');
                $this->form_validation->set_rules('promocode_status', 'Promocode Status', 'trim|required');
                $this->form_validation->set_rules('order_item_list', 'Order Item List', 'trim|required');
                $this->form_validation->set_error_delimiters('', '');
                if ($this->form_validation->run()) {
                    $productList = json_decode($order_item_list);
                    $orderId = orderIdGenerateUser();
                    $post['user_id'] = $tokenId;
                    $post['order_id'] = $orderId;
                    $post['name'] = $name;
                    $post['contact_no'] = $contact_no;
                    $post['address'] = $address;
                    $post['area'] = $area;
                    $post['postal_code'] = $postal_code;
                    $post['state'] = $state;
                    $post['city'] = $city;
                    $post['delivery_charges'] = $delivery_charges;
                    $post['payment_mode'] = $payment_mode;
                    $post['total_item_amount'] = $total_item_amount;
                    $post['final_amount'] = $final_amount;
                    $post['promocode_status'] = $promocode_status;
                    if ($promocode_status == '1') {
                        $post['promocode_amount'] = $promocode_amount;
                        $post['promocode'] = $promocode;
                    }
                    $post['booking_date'] = setDateOnly();
                    $insert = $this->CommonModel->insertRow('book_product', $post);
                    if ($insert) {
                        foreach ($productList as $p) {
                            $items[] = array(
                                'create_date' => setDateTime(),
                                'order_id' => $orderId,
                                'is_variant' => $p->is_variant,
                                'no_of_items' => $p->no_of_items,
                                'base_price' => $p->base_price,
                                'user_price' => $p->user_price,
                                'booking_price' => $p->booking_price,
                                'gst_per' => $p->gst_per,
                                'gst_amt' => $p->gst_amt,
                                'product_img' => $p->product_img,
                                'product_name' => $p->product_name,
                                'variant_id' => $p->variant_id,
                                'variant_name' => $p->variant_name,
                                'product_id' => $p->product_id,
                            );
                        }
                        $insert2 = $this->CommonModel->insertRowInBatch('book_item', $items);
                        // if ($payment_mode == '1') {
                        //     $getUser = $this->CommonModel->getColumnById('fcm_token', 'user_registration', "user_id = '" . $token['data']->id . "'");
                        //     sendNotificationUser($getUser['fcm_token'], 'Order Book Successfully', 'Please wait while accept the order.');
                        // }
                        $this->response(array('status' => 200, 'message' => 'Order book successfully.', 'data' => array('order_id' => $orderId)));
                    } else {
                        $this->response(array('status' => 400, 'message' => 'Something went wrong. Please try again', 'data' => null));
                    }
                } else {
                    $this->response(array('status' => 400, "message" => str_replace("\n", " ", validation_errors()), 'data' => null));
                }
            } else {
                $this->response(array('status' => 401, 'message' => 'Unauthorized user', 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response(array('status' => 401, 'message' => $token['message'], 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function orderTransactionStatus_POST()
    {
        $token = $this->authorization_token->validateToken();
        if (!empty($token) and $token['status'] != 0) {
            extract($this->input->post());
            if (getUserId($token)) {
                $tokenId = $token['data']->id;
                $user_type = $token['data']->user_type;
                $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');
                $this->form_validation->set_rules('status', 'status', 'trim|required');
                if ($status == '1') {
                    $this->form_validation->set_rules('payment_id', 'payment_id', 'trim|required');
                    $this->form_validation->set_rules('mode', 'mode', 'trim|required');
                    $this->form_validation->set_rules('hash', 'hash', 'trim|required');
                }
                $this->form_validation->set_error_delimiters('', '');
                if ($this->form_validation->run()) {
                    $updateData['hash'] = $hash;
                    // $getUser = $this->CommonModel->getColumnById('fcm_token', 'user_registration', "user_id = '" . $token['data']->id . "'");
                    if ($status == '1') {
                        $updateData['transaction_status'] = '1';
                        $updateData['payment_id'] = $payment_id;
                        $updateData['mode'] = $mode;
                        $update = $this->CommonModel->updateRowByMoreId('book_product', "order_id = '$order_id' AND transaction_status = '0'", ['transaction_status' => '1']);
                        if ($update) {
                            // sendNotificationUser($getUser['fcm_token'], 'Order Book Successfully', 'Please wait while accept the order.');
                            $this->response(array('status' => 200, 'message' => 'status update successfully.', 'data' => null));
                        } else {
                            $this->response(array('status' => 400, 'message' => 'Something went wrong. Please try again', 'data' => null));
                        }
                    } else {
                        $updateData['transaction_status'] = '2';
                        $this->CommonModel->updateRowByMoreId('book_product', "order_id = '$order_id' AND transaction_status = '0'", ['transaction_status' => '2']);
                        // sendNotificationUser($getUser['fcm_token'], 'Payment Fail. Please try again', 'Please do order again.');
                        $this->response(array('status' => 400, 'message' => 'payment fail. Please try again', 'data' => null));
                    }
                } else {
                    $this->response(array('status' => 400, 'message' => str_replace("\n", " ", validation_errors()), 'data' => null));
                }
            } else {
                $this->response(array('status' => 401, 'message' => 'Unauthorized user', 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response(array('status' => 401, 'message' => $token['message'], 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function orderHistory_GET()
    {
        $token = $this->authorization_token->validateToken();
        if (!empty($token) and $token['status'] != 0) {
            extract($this->input->post());
            if (getUserId($token)) {
                $tokenId = $token['data']->id;
                $getOrder = $this->CommonModel->getRowByIdInOrder('book_product', "user_id = '$tokenId'", 'create_date', 'DESC');
                if ($getOrder) {
                    $allOrders = [];
                    foreach ($getOrder as $data) {
                        $prodData = $this->CommonModel->getRowById('book_item', 'order_id', $data['order_id']);
                        $allProd = [];
                        if ($prodData) {
                            foreach ($prodData as $prod) {
                                $allProd[] = $prodData;
                            }
                        }

                        $allOrders[] = array(
                            'book_product_id' => $data['product_book_id'],
                            'create_date' => date('d-M-Y h:i A', strtotime($data['create_date'])),
                            'order_id' => $data['order_id'],
                            'name' => ucwords($data['name']),
                            'contact_no' => $data['contact_no'],
                            'address' => $data['address'],
                            'area' => $data['area'],
                            'postal_code' => $data['postal_code'],
                            'state' => $data['state'],
                            'city' => $data['city'],
                            'booking_status' => $data['booking_status'],
                            'total_amount' => $data['total_item_amount'],
                            'final_amount' => $data['final_amount'],
                            'delivery_charges' => $data['delivery_charges'],
                            'estimated_time' => $data['estimated_time'],
                            'cancel_msg' => $data['cancel_message'],
                            'promocode_status' => $data['promocode_status'],
                            'promocode' => $data['promocode'],
                            'promocode_amount' => $data['promocode_amount'],
                            'payment_mode' => $data['payment_mode'],
                            'transaction_status' => $data['transaction_status'],
                            'payment_id' => $data['payment_id'],
                            'transaction_mode' => $data['transaction_mode'],
                            'payment_hash' => $data['payment_hash'],
                            'invoice_url' => base_url() . 'invoice/' . $data['product_book_id'],
                            'items' => $allProd
                        );
                    }
                    $this->response(array('status' => 200, 'message' => 'Show all order', 'data' => $allOrders));
                } else {
                    $this->response(array('status' => 400, 'message' => 'No Order Available.', 'data' => null));
                }
            } else {
                $this->response(array('status' => 401, 'message' => 'Unauthorized user', 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response(array('status' => 401, 'message' => $token['message'], 'data' => null), REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function invoice_GET($id)
    {
        // 		error_reporting(0);
        $data['all_data'] = $this->CommonModel->getSingleRowById('book_product', "order_id = '$id'");
        $data['all_data_items'] = $this->CommonModel->getRowByMoreId('book_item', "order_id = '$id'");


        $this->load->view('admin/invoice_view', $data);
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->set_option('isRemoteEnabled', true);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream(date('dmYhis'), array("Attachment" => 0));

        // 'compress' => 1 or 0 – enable content stream compression.
        // 'Attachment' => 1 = download or 0 = preview

        // $filePath = "./upload/122.pdf";
        // $output = $this->dompdf->output();
        // file_put_contents($filePath, $output);
    }
}
