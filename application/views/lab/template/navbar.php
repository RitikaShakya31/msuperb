<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[1];
$page_id = $this->input->get('page_id');
$user_id = $this->session->userdata('isUserLogin');
$reg = $this->CommonModel->getSingleRowById('register', "register_id = '$user_id'");
?>
<div class="vertical-menu">
	<div data-simplebar class="h-100">
		<div id="sidebar-menu">
			<ul class="metismenu list-unstyled" id="side-menu">
				<li class="menu-title" key="t-menu">Menu</li>
				<li>
					<a href="<?= base_url('lab-dashboard') ?>" class="waves-effect">
						<i class="bx bx-home-circle"></i>
						<span key="t-dashboards">Dashboards</span>
					</a>
				</li>
				<li class="menu-title" key="t-apps">Management</li>
				<li><a href="<?= base_url('appointment-list') ?>" key="t-blog">
						<i class="bx bx-file"></i>
						<span key="t-dashboards">Total Appointment</span>
					</a>
				</li>
				<!-- <li><a href="<?= base_url('services-list') ?>" key="t-blog">
						<i class="bx bx-file"></i>
						<span key="t-dashboards">Total Test</span>
					</a>
				</li> -->
				<li><a href="<?= base_url('payment-list') ?>" key="t-blog">
						<i class="bx bx-file"></i>
						<span key="t-dashboards">Payment History</span></a>
				</li>
				<li><a href="<?= base_url('lab-profile') ?>" key="t-blog">
						<i class="bx bx-file"></i>
						<span key="t-dashboards">Your Profile</span></a>
				</li>
				<!-- Support Form Button -->
				<!-- <button class="btn btn-primary" style="margin-left:24px;" id="supportBtn">Support Form</button> -->
			</ul>
		</div>
	</div>
</div>

<script>
	document.getElementById('supportBtn').onclick = function () {
		var supportModal = new bootstrap.Modal(document.getElementById('supportModal'));
		supportModal.show();
	};
</script>