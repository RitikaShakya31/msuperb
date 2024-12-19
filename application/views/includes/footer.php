<footer class="footer-part">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-xl-3">
				<div class="footer-widget">
					<a class="footer-logo" href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/images/logo.png"
							alt="CARE1 | Your One Care Medical"></a>
					<p class="footer-desc">At Msuperb, we are dedicated to simplifying healthcare for you. Our mission
						is to provide easy access to quality healthcare products and services, all in one place
						<br>
						<br>
						<?php
						$insertbroserdata = insertRow('post_pageviews_month', array('post_user_id' => ((sessionId('login_user_id') != '') ? sessionId('login_user_id') : '0'), 'ip_address' => $_SERVER['HTTP_HOST'], 'user_agent' => $_SERVER['HTTP_USER_AGENT'], 'page' => base_url() . $_SERVER['REQUEST_URI']));
						$totalVisitors = getNumRows('tbl_post_pageviews_month', []);
						?>

						<!-- <span class="visit-counts">Total Visits : <?= $totalVisitors; ?></span> -->
					</p>
					<ul class="footer-social">
						<li><a class="icofont-facebook" href="https://www.facebook.com/" target="_blank"></a></li>

						<li><a class="icofont-instagram" href="https://www.instagram.com/" target="_blank"></a></li>
						<li><a class="icofont-twitter" href="https://twitter.com/" target="_blank"></a>
						</li>
						<li><a class="icofont-linkedin" href="https://www.linkedin.com/" target="_blank"></a></li>

					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="footer-widget contact">
					<h3 class="footer-title">contact us</h3>
					<ul class="footer-contact">
						<li>
							<i class="icofont-ui-email"></i>
							<p><span><a href="mailto:<?= $contact['email_f'] ?>"
										style="color:#555555"><?= $contact['email_f'] ?></a></span></p>
						</li>
						<li>
							<i class="icofont-ui-touch-phone"></i>
							<p><span><a href="tel:<?= $contact['contact_f'] ?>"
										style="color:#555555"><?= $contact['contact_f'] ?></a></span> </p>
						</li>
						<li>
							<i class="icofont-location-pin"></i>
							<p><?= $contact['location'] ?>
							</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="footer-widget">
					<h3 class="footer-title">quick Links</h3>
					<div class="footer-links">
						<ul>
							<li><a href="<?= base_url('about') ?>">About Company</a></li>
							<?php
							if ($this->session->has_userdata('login_user_id')) {
								?>
								<li> <a href="<?= base_url('orders') ?>"><i class="w-icon-account"></i>Appoinments</a></li>
								<li> <a href="<?= base_url('logout'); ?>"><i class="w-icon-lock"></i>Logout</a></li>
								<?php
							} else {
								?>
								<!-- <li> <a href="<?= base_url('login') ?>"><i class="w-icon-account"></i>Sign In</a> </li> -->
								<!-- <li> <a href="<?= base_url('register') ?>"> Register</a></li> -->
								<?php
							}
							?>
							<li><a href="<?= base_url('contact') ?>">contact us</a></li>
						</ul>
						<!-- <ul>
							<li><a href="<?= base_url('shipping-policy'); ?>">Return / Refund / Cancellation Policy</a>
							</li>
							<li><a href="<?= base_url('term-condition'); ?>">Terms & Conditions</a></li>
							<li><a href="<?= base_url('privacy-policy'); ?>">Privacy Policy</a></li>
						</ul> -->
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="footer-widget">
					<h3 class="footer-title">Our Policies</h3>
					<div class="footer-links">
						<ul>
							<li><a href="<?= base_url('shipping-policy'); ?>">Return/Refund/Cancellation Policy</a>
							</li>
							<li><a href="<?= base_url('term-condition'); ?>">Terms & Conditions</a></li>
							<li><a href="<?= base_url('privacy-policy'); ?>">Privacy Policy</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="footer-bottom">
					<p class="footer-copytext">&copy; All Copyrights Reserved by <a href="<?= base_url() ?>">Msuperb</a>
					</p>
					<div class="footer-card"><a href="<?= base_url() ?>"><img
								src="<?= base_url() ?>assets/images/payment/jpg/01.jpg" alt="payment"></a><a
							href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/images/payment/jpg/02.jpg"
								alt="payment"></a><a href="<?= base_url() ?>"><img
								src="<?= base_url() ?>assets/images/payment/jpg/03.jpg" alt="payment"></a><a
							href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/images/payment/jpg/04.jpg"
								alt="payment"></a></div>
				</div>
			</div>
		</div>
	</div>
</footer>
<input type="hidden" value="<?= base_url() ?>" id="base">


<a href="tel:<?= $contact['contact_f'] ?>" class="floating_consult consultButtonHeader " rel="noopener noreferrer"><i
		class="fas fa-headphones"></i> Consult Now</a>


<!-- whatsapp -->
<div>
	<a href="https://wa.me/<?= $contact['contact_f'] ?>" class="float-1 whatsappIcon">
		<!-- <i class="fa fa-whatsapp my-float"></i> -->
		<i class="fab fa-whatsapp my-float"></i>
	</a>
</div>

<?php $this->load->view('includes/user-login'); ?>
<?php $this->load->view('includes/side-popup'); ?>
<?php $this->load->view('includes/otp-popup'); ?>