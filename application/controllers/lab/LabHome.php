<?php
class LabHome extends CI_Controller
{
    public function user_login()
    {
        if (count($_POST) > 0) {
            $email = $this->input->post('lab_email');
            $password = $this->input->post('password');
            $user = $this->CommonModel->getSingleRowById('sub_category', "lab_email = '$email'");
            if ($user) {
                if ($user['password'] == $password) {
                    if ($user['status'] == 'accepted') {
                        $this->session->set_userdata('isUserLogin', $user['sub_category_id']);
                        $this->session->set_userdata('isUserLabname', $user['lab_name']);
                        redirect(base_url('lab-dashboard'));
                    } else {
                        $this->session->set_userdata('msg', '<div class="alert alert-danger">Invalid Login: Your account is Rejected.</div>');
                    }
                } else {
                    $this->session->set_userdata('msg', '<div class="alert alert-danger">Invalid Password</div>');
                }
            } else {
                $this->session->set_userdata('msg', '<div class="alert alert-danger">Invalid Email</div>');
            }
        }
        $data['title'] = 'User Login ';
        $this->load->view('lab/user_login', $data);
    }

    public function user_dashboard()
    {
        if (sessionId('isUserLogin') == "") {
            redirect("lab-login");
        }
        $user_id = $this->session->userdata('isUserLogin');
        $data['lab_name'] = $this->session->userdata('isUserLabname');
        $current_date = date('d-m-y');
        $data['today_appointment'] = $this->CommonModel->getRowByIdInOrder(
            'appointment',
            ['appointment_date' => $current_date], // Filter by today's date
            'id',
            'DESC'
        );
        $data['number'] = $this->CommonModel->getNumRows('appointment', ['appointment_date' => $current_date]);
        $this->load->view('lab/user_dashboard', $data);
    } 
    public function supportFormData()
    {
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $insert = $this->CommonModel->insertRow('support_query', $post);
            if ($insert) {
                flashMultiData(['success_status' => "success", 'msg' => "Thank You ! Your Query is successfully submitted. We will reach you as soon as possible"]);
            } else {
                flashMultiData(['success_status' => "success", 'msg' => "We are facing technical error ,please try again later."]);
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function appointment_list()
    {
        // $get['query'] = $this->CommonModel->getAllRowsInOrder('appointment_list', 'id', 'DESC');
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
        $get['all_appointments'] = $this->CommonModel->getRowByIdInOrder('appointment', [], 'id', 'DESC');
        $get['title'] = 'AHCS | All Appointment List';
        $this->load->view('user/appointment_list', $get);
    }
    public function lab_profile()
    {
        $user_id = $this->session->userdata('isUserLogin');
        if (count($_POST) > 0) {
            $post = $this->input->post();
            $update = $this->CommonModel->updateRowById('register', 'register_id', $user_id, $post);
            if ($update) {
                flashMultiData(['success_status' => "success", 'msg' => "Profile Data Updated"]);
            } else {
                flashMultiData(['success_status' => "error", 'msg' => "Something Went Wrong."]);
            }
            redirect($_SERVER['HTTP_REFERER']);
        }

        $get['profileData'] = $this->CommonModel->getSingleRowById('register', "register_id = '$user_id'");
        $get['title'] = 'AHCS | Profile';
        $this->load->view('user/lab_profile', $get);
    }
    public function payment_list()
    {
        // $get['query'] = $this->CommonModel->getAllRowsInOrder('appointment_list', 'id', 'DESC');
        // $BdID = $this->input->get('dID');
        // if (decryptId($BdID) != '') {
        //     $delete = $this->CommonModel->deleteRowById('appointment_list', array('id' => decryptId($BdID)));
        //     if ($delete) {
        //         flashMultiData(['success_status' => "success", 'msg' => "Appointment Query Deleted"]);
        //     } else {
        //         flashMultiData(['success_status' => "error", 'msg' => "Something Went Wrong."]);
        //     }
        //     redirect('appointment-list');
        //     exit;
        // }
        $get['paymentData'] = $this->CommonModel->getRowByIdInOrder(
            'appointment',
            ['lab_payment_status' => '1'], // Filter by today's date
            'id',
            'DESC'
        );
        $get['title'] = 'AHCS | All Payment History';
        $this->load->view('user/payment_list', $get);
    }
    public function services_list()
    {
        $id = $this->input->get('sid');
        if (isset($id)) {
            // $decrypt_id = decryptId($id);
            $get['getservice'] = $this->CommonModel->getSingleRowById('service_list', "id = '$id'");
            // $service = $get['getservice']['service'];
            $get['data'] = $this->CommonModel->getSingleRowById('all_service', "service_id =" . $get['getservice']['service']);
        }
        $user_id = $this->session->userdata('isUserLogin');
        $get['service'] = $this->CommonModel->getRowByMoreId('service_list', "register_id = '$user_id'");
        $BdID = $this->input->get('dID');

        if (count($_POST) > 0) {
            $post = $this->input->post();
            $post['register_id'] = sessionId('isUserLogin');
            $insert = $this->CommonModel->insertRow('service_list', $post);
            redirect(base_url('services-list'));
        }
        if (decryptId($BdID) != '') {
            $delete = $this->CommonModel->deleteRowById('service_list', array('register_id' => decryptId($BdID)));
            if ($delete) {
                flashMultiData(['success_status' => "success", 'msg' => "Appointment Query Deleted"]);
            } else {
                flashMultiData(['success_status' => "error", 'msg' => "Something Went Wrong."]);
            }
            redirect('appointment-list');
            exit;
        }
        $get['title'] = 'AHCS | All Service List';
        $this->load->view('user/services_list', $get);
    }
    public function visitStatus($user_id)
    {
        $visit_status = $this->input->post('visit_status'); // Fetch the posted status
        $post = array('visit_status' => $visit_status);
        $update = $this->CommonModel->updateRowById('appointment', 'id', decryptId($user_id), $post);
        if ($update) {
            flashMultiData(['success_status' => "success", 'msg' => "Status Updated"]);
        } else {
            flashMultiData(['success_status' => "error", 'msg' => "Something Went Wrong."]);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function userLogout()
    {
        $this->session->unset_userdata('isUserLogin');
        redirect('user-login');
    }


}
?>