<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = @$components[2];

$page_id = $this->input->get('page_id');


?>
<div class="vertical-menu">
	<div data-simplebar class="h-100">
		<div id="sidebar-menu">
			<ul class="metismenu list-unstyled" id="side-menu">
				<li class="menu-title" key="t-menu">Menu</li>

				<li>
					<a href="<?= base_url('dashboard') ?>" class="waves-effect">
						<i class="bx bx-home-circle"></i>
						<span key="t-dashboards">Dashboards</span>
					</a>
				</li>
				<li class="menu-title" key="t-apps">Apps</li>
				<li><a href="<?= base_url('registerAll') ?>" key="t-blog">
						<i class="bx bx-file"></i>
						<span key="t-dashboards">Lab Registrations</span>
					</a>
				</li>
				<li class="<?php if ($page == "company" || $page == "categoryAll" || $page == 'categoryAdd' || $page == 'subCategoryAdd' || $page == 'subCategoryAll' || $page == 'productAll' || $page == 'productAdd' || $page == 'productDetails') {
					echo "mm-active";
				} ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect">
						<i class="fab fa-product-hunt"></i>
						<span key="t-ecommerce">Product</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="<?= base_url('categoryAll') ?>" class="<?php if ($page == "categoryAll" || $page == 'categoryAdd') {
							  echo 'active';
						  } ?>" key="t-category">Brand</a></li>
						<li><a href="<?= base_url('subCategoryAll') ?>" class="<?php if ($page == "subCategoryAll" || $page == 'subCategoryAdd') {
							  echo 'active';
						  } ?>" key="t-sub-category">Laboratory</a></li>
						<li><a href="<?= base_url('productAll') ?>" class="<?php if ($page == "productAll" || $page == 'productAdd' || $page == 'productDetails') {
							  echo 'active';
						  } ?>" key="t-product">Test</a></li>
					</ul>
				</li>
				<li><a href="<?= base_url('userAll') ?>" key="t-blog">
						<i class='bx bxs-user'></i>
						<span key="t-dashboards">Patient Details </span>
					</a>
				</li>
				<li><a href="<?= base_url('prescription') ?>" key="t-blog">
						<i class='bx bxs-wallet'></i>
						<span key="t-dashboards">Prescription</span></a>
				</li>
				<li><a href="<?= base_url('payment-history') ?>" key="t-blog">
						<i class='bx bxs-wallet'></i>
						<span key="t-dashboards">Payment</span></a>
				</li>
				<!-- <li><a href="<?= base_url('support-query') ?>" key="t-blog">
						<i class='bx bx-support'></i>
						<span key="t-dashboards">Lab Support Query</span></a>
				</li> -->
				<li><a href="<?= base_url('testAll') ?>" key="t-blog">
						<i class="bx bx-file"></i>
						<span key="t-dashboards">All Test</span>
					</a>
				</li>
				<li><a href="<?= base_url('brandAll') ?>" key="t-blog">
						<i class="bx bx-file"></i>
						<span key="t-dashboards">Brand List</span>
					</a>
				</li>

				<li>
					<a href="<?= base_url('banner') ?>" class="waves-effect">
						<i class="bx bx-file"></i>
						<span key="t-file-manager">Banner</span>
					</a>
				</li>

				<li>
					<a href="<?= base_url('promoCode') ?>" class="waves-effect">
						<i class="bx bx-file"></i>
						<span key="t-file-manager">Promo Code</span>
					</a>
				</li>
				<!-- <li>
					<a href="<?= base_url('blog') ?>" class="waves-effect">
						<i class="bx bx-file"></i>
						<span key="t-file-manager">Blog</span>
					</a>
				</li> -->
				<!--<li>-->
				<!--	<a href="<?= base_url('productReview') ?>" class="waves-effect">-->
				<!--		<i class="bx bx-file"></i>-->
				<!--		<span key="t-file-manager">Product Review</span>-->
				<!--	</a>-->
				<!--</li>-->
				<li>
					<a href="<?= base_url('setDeliveryCharges') ?>" class="waves-effect">
						<i class="bx bx-file"></i>
						<span key="t-file-manager">Delivery Charges</span>
					</a>
				</li>
				<li>
					<a href="<?= base_url('contactdetails') ?>" class="waves-effect">
						<i class="bx bx-file"></i>
						<span key="t-file-manager">Contact Details</span>
					</a>
				</li>
				<li>
					<a href="<?= base_url('policy') ?>" class="waves-effect">
						<i class="bx bx-file"></i>
						<span key="t-file-manager">Policy</span>
					</a>
				</li>
				<!-- <li class="<?php if ($page == "activeUser" || $page == 'inactiveUser' || $page == "newUser" || $page == 'verifyCancelUser' || $page_id == '1') {
					echo "mm-active";
				} ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect">
						<i class="fab fa-product-hunt"></i>
						<span key="t-ecommerce">Users</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li>
							<a href="<?= base_url('activeUser') ?>" class="<?php if ($page == "activeUser") {
								  echo 'active';
							  } ?>" key="t-category">Active Users
							</a>
						</li>
						<li>
							<a href="<?= base_url('inactiveUser') ?>" class="<?php if ($page == "inactiveUser") {
								  echo 'active';
							  } ?>" key="t-category">Inactive Users
							</a>
						</li>
					</ul>
				</li> -->

				<!-- <li class="<?php if ($page == "recentOrders" || $page == 'acceptedOrders' || $page == 'dispatchOrders' || $page == 'completedOrders' || $page == 'allOrders') {
					echo "mm-active";
				} ?>">
					<a href="javascript: void(0);" class="has-arrow waves-effect">
						<i class="fab fa-product-hunt"></i>
						<span key="t-ecommerce">Orders</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li>
							<a href="<?= base_url('recentOrders') ?>" class="<?php if ($page == "recentOrders") {
								  echo 'active';
							  } ?>" key="t-category">Recent Orders
							</a>
						</li>
						<li>
							<a href="<?= base_url('acceptedOrders') ?>" class="<?php if ($page == "acceptedOrders") {
								  echo 'active';
							  } ?>" key="t-category">Accepted Orders
							</a>
						</li>
						<li>
							<a href="<?= base_url('dispatchOrders') ?>" class="<?php if ($page == "dispatchOrders") {
								  echo 'active';
							  } ?>" key="t-category">Dispatch Orders
							</a>
						</li>
						<li>
							<a href="<?= base_url('completedOrders') ?>" class="<?php if ($page == "completedOrders") {
								  echo 'active';
							  } ?>" key="t-category">Completed Orders
							</a>
						</li>
						<li>
							<a href="<?= base_url('cancelOrders') ?>" class="<?php if ($page == "cancelOrders") {
								  echo 'active';
							  } ?>" key="t-category">Cancel Orders
							</a>
						</li>
						<li>
							<a href="<?= base_url('allOrders') ?>" class="<?php if ($page == "allOrders") {
								  echo 'active';
							  } ?>" key="t-category">All Orders
							</a>
						</li>


					</ul>
				</li> -->
				<!-- <li>
					<a href="<?= base_url('totalVisiters') ?>" class="waves-effect">
						<i class="bx bx-file"></i>
						<span key="t-file-manager">Total Visiters</span>
					</a>
				</li> -->
				<!-- <li>
					<a href="<?= base_url('setting') ?>" class="waves-effect">
						<i class="bx bx-file"></i>
						<span key="t-file-manager">Setting</span>
					</a>
				</li> -->
			</ul>
		</div>
	</div>
</div>