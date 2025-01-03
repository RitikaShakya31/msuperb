<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'UserHome';
$route['404_override'] = 'UserHome/pagenotfound';
$route['translate_uri_dashes'] = FALSE;


/////////////////////     Admin     /////////////////
$route['login_check'] = 'UserHome/login_check';
$route['admin'] = 'admin/AdminAuth/admin';
$route['adminLogout'] = 'admin/AdminAuth/adminLogout';

$route['dashboard'] = 'admin/AdminHome/dashboard';
$route['prescription'] = 'admin/AdminHome/prescription';
$route['totalVisiters'] = 'admin/AdminHome/totalVisiters';
$route['banner'] = 'admin/AdminHome/banner';
$route['promoCode'] = 'admin/AdminHome/promoCode';
$route['blog'] = 'admin/AdminHome/blog';
$route['category-featured/(:any)/(:any)'] = 'admin/AdminHome/categoryFeatured/$1/$2';
$route['setDeliveryCharges'] = 'admin/AdminHome/setDeliveryCharges';
$route['contactdetails'] = 'admin/AdminHome/contactdetails';
$route['policy'] = 'admin/AdminHome/policy';
$route['policyedit/(:any)'] = 'admin/AdminHome/policyedit/$1';
$route['registerAll'] = 'admin/AdminHome/registerAll';
$route['registerView'] = 'admin/AdminHome/registerView';
$route['registerAdd'] = 'admin/AdminHome/registerAdd';
$route['testAll'] = 'admin/AdminHome/all_test';
$route['brandAll'] = 'admin/AdminHome/all_brand';
$route['testAdd'] = 'admin/AdminHome/test_add';
$route['userAll'] = 'admin/AdminHome/user_all';
$route['appointments'] = 'admin/AdminHome/appointments';
$route['payment-history'] = 'admin/AdminHome/payment_history';
$route['paymentStatus/(:any)'] = 'admin/AdminHome/paymentStatus/$1';

//Lab routes
$route['lab-login'] = 'lab/LabHome/user_login';
$route['lab-dashboard'] = 'lab/LabHome/user_dashboard';
$route['supportFormData'] = 'lab/LabHome/supportFormData';
$route['visitStatus/(:any)'] = 'lab/LabHome/visitStatus/$1';
$route['appointment-list'] = 'lab/LabHome/appointment_list';
$route['services-list'] = 'lab/LabHome/services_list';
$route['payment-list'] = 'lab/LabHome/payment_list';
$route['lab-profile'] = 'lab/LabHome/lab_profile';
$route['userLogout'] = 'lab/LabHome/userLogout';






//  =>  User

$route['activeUser'] = 'admin/AdminHome/activeUser';
$route['inactiveUser'] = 'admin/AdminHome/inactiveUser';
$route['userStatus/(:any)/(:any)'] = 'admin/AdminHome/userStatus/$1/$2';
$route['userDetails/(:any)'] = 'admin/AdminHome/userDetails/$1';
$route['productReview'] = 'admin/AdminHome/productReview';
$route['reviewStatus/(:any)/(:any)'] = 'admin/AdminHome/reviewStatus/$1/$2';

// => Orders

$route['onprocessOrders'] = 'admin/AdminHome/onprocessOrders';
$route['recentOrders'] = 'admin/AdminHome/recentOrders';
$route['acceptOrder'] = 'admin/AdminHome/acceptOrder';
$route['cancelOrder'] = 'admin/AdminHome/cancelOrder';
$route['acceptedOrders'] = 'admin/AdminHome/acceptedOrders';
$route['dispatchOrder/(:any)/(:any)'] = 'admin/AdminHome/dispatchOrder/$1/$2';
$route['dispatchOrders'] = 'admin/AdminHome/dispatchOrders';
$route['completedOrders'] = 'admin/AdminHome/completedOrders';
$route['cancelOrders'] = 'admin/AdminHome/cancelOrders';
$route['allOrders'] = 'admin/AdminHome/allOrders';
$route['sendnotification'] = 'admin/AdminHome/sendnotification';
$route['statusrefunded/(:any)/(:any)'] = 'admin/AdminHome/statusrefunded/$1/$2';
$route['statusUpdate/(:any)/(:any)'] = 'admin/AdminHome/statusUpdate/$1/$2';
$route['changePassword'] = 'admin/AdminHome/changePassword';
$route['addFaqs'] = 'admin/AdminHome/addFaqs';
$route['updateBookProduct'] = 'admin/AdminHome/updateBookProduct';


// => shiprocket

$route['shiprocket/(:any)'] = 'admin/AdminHome/shiprocket/$1';

// => Product

$route['categoryAll'] = 'admin/AdminProduct/categoryAll';
$route['categoryAdd'] = 'admin/AdminProduct/categoryAdd';
$route['subCategoryAll'] = 'admin/AdminProduct/subCategoryAll';
$route['subCategoryAdd'] = 'admin/AdminProduct/subCategoryAdd';

$route['getSubCategory'] = 'admin/AdminProduct/getSubCategory';
$route['productAll'] = 'admin/AdminProduct/productAll';
$route['productDetails'] = 'admin/AdminProduct/productDetails';
$route['productAdd'] = 'admin/AdminProduct/productAdd';
$route['productView'] = 'admin/AdminProduct/productView';
$route['getProductSubCategory'] = 'admin/AdminProduct/getProductSubCategory';
$route['productImageD/(:any)/(:any)'] = 'admin/AdminProduct/productImageD/$1/$2';
$route['setting'] = 'admin/AdminHome/setting';

///////////////////// website   ///////////////////////
$route['contact'] = 'UserHome/contact';
$route['login'] = 'UserHome/login';
$route['check_verification'] = 'UserHome/check_verification';
$route['nearest-lab'] = 'UserHome/nearest_lab';
$route['compare/(:any)'] = 'UserHome/compare/$1';

$route['register'] = 'UserHome/register';
$route['checkout'] = 'UserHome/checkout';
$route['order-history'] = 'UserHome/order_history';
$route['profile'] = 'UserHome/profile';
$route['product'] = 'UserHome/product';
$route['product-details/(:any)/(:any)'] = 'UserHome/product_details/$1/$2';
$route['lab-details/(:any)/(:any)'] = 'UserHome/lab_details/$1/$2';
$route['test-details/(:any)/(:any)'] = 'UserHome/test_details/$1/$2';
$route['orderInvoice/(:any)'] = 'UserHome/orderInvoice/$1';
$route['orderDetails/(:any)'] = 'UserHome/orderDetails/$1';
$route['forgot-password'] = 'UserHome/forgot_password';
$route['search'] = 'UserHome/search';
$route['orders'] = 'UserHome/orders';
$route['shipping-policy'] = 'UserHome/shipping_policy';
$route['contact'] = 'UserHome/contact';
$route['about'] = 'UserHome/about';
$route['term-condition'] = 'UserHome/term_condition';
$route['privacy-policy'] = 'UserHome/privacy_policy';
$route['shipping-policy'] = 'UserHome/shipping_policy';
$route['verify-registration'] = 'UserHome/verify_registration';
$route['logout'] = 'UserHome/logout';
$route['booking-status'] = 'UserHome/booking_status';
$route['payment_msg'] = 'UserHome/payment_msg';
$route['save_review'] = 'UserHome/save_review';
$route['blogs'] = 'UserHome/blogs';
$route['blog_details/(:any)'] = 'UserHome/blog_details/$1';
$route['reorder/(:any)'] = 'UserHome/reorder/$1';
$route['nearest-lab-location/(:any)'] = 'UserHome/lab_location/$1';


/////////////////////  User API    ///////////////////////

$route['stateApi'] = 'UserApi/stateApi';
$route['cityApi/(:any)'] = 'UserApi/cityApi/$1';

$route['userSendOTP'] = 'UserApi/userSendOTP';
$route['userLogin'] = 'UserApi/userLogin';
$route['userProfileUpdate'] = 'UserApi/userProfileUpdate';
$route['userViewProfile'] = 'UserApi/userViewProfile';

$route['dashboardApi'] = 'UserApi/dashboardApi';
$route['getProduct'] = 'UserApi/getProduct';
$route['searchProduct'] = 'UserApi/searchProduct';


$route['getDeliveryCharge'] = 'UserApi/getDeliveryCharge';
$route['getPromoCode'] = 'UserApi/getPromoCode';
$route['createOrder'] = 'UserApi/createOrder';
$route['orderTransactionStatus'] = 'UserApi/orderTransactionStatus';
$route['orderHistory'] = 'UserApi/orderHistory';
