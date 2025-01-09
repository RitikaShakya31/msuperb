<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php $this->load->view('includes/header-link'); ?>

<body>
	<div class="backdrop"></div>
	<a class="backtop fas fa-arrow-up" href="#"></a>
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-6">
					<div class="header-top-welcome">
						<!-- <p> CARE1 | Your One Care Medical </p> -->
						<ul class="d-flex">

							<li class="mr-3">
								<p><small>Mail Us : </small><span><a href="mailto:<?= $contact['email_f'] ?>"
											style="color:#fff"><?= $contact['email_f'] ?> </a></span></p>
							</li>
						</ul>

					</div>
				</div>
				<div class="col-md-7 col-lg-6">
					<ul class="header-top-list">
						<!-- <li>
							<a href="https://api.whatsapp.com/send?phone=918359000204&text=Hello I have a Query."
								target="_blank" class="consultButtonHeader ">
								<i class="fas fa-headphones"></i>&nbsp;<span class="blink-soft">Consult Now</span>
							</a>
						</li> -->
						<li><a href="tel:<?= $contact['contact_f'] ?>">need help</a></li>
						<li><a href="<?= base_url('contact') ?>">contact us</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<header class="header-part">
		<div class="container">
			<div class="header-content">
				<div class="header-media-group"><button class="header-user">
						<i class="fas fa-bars"></i></button>
					<a href="<?= base_url() ?>">
						<img src="<?= base_url($setting[1]['particular_value']) ?>" alt="Msuperb">
					</a><button class="header-src"><i class="fas fa-search"></i></button>
				</div>
				<a href="<?= base_url() ?>" class="header-logo">
					<img src="<?= base_url($setting[1]['particular_value']) ?>" alt="Msuperb">

				</a>
				<?php
				if ($this->session->has_userdata('login_user_id')):
					?>
					<a href="<?= base_url('orders') ?>" class="header-widget" title="My Account">
						<img src="<?= base_url() ?>assets/images/user.png" alt="user"><span>
							<?= $this->profile[0]['name'] ?>
						</span>
					</a>
					<?php
				else:
					?>
					<a href="javascript:;" class="header-widget cart-checkout-btn" title="My Account">
						<img src="<?= base_url() ?>assets/images/user.png" alt="user">
						<span>Login</span>
					</a>
					<?php
				endif;
				?>
				<form action="<?= base_url('product') ?>" action="" class="header-form">
					<input placeholder="Search Here..." type="text" name="searchbox" list="browsers" id="browser"
						value="<?= isset($search) ? $search : '' ?>" required>
					<datalist id="browsers">
						<?php
						$search = getRowByMoreId('product', array('status' => '1', 'is_delete' => '1'));

						// print_r($search );
						
						if (!empty($search)) {
							foreach ($search as $search_row) {
								?>
								<!--<option value="<?= strtoupper($search_row['product_name']); ?>">-->
								<!--	<?= strtoupper($search_row['product_name']); ?>-->
								<!--</option>-->
								<?php
							}
						}
						?>
					</datalist><button type="submit"><i class="fas fa-search"></i></button>
				</form>
				<div class="header-widget-group">
					<button class="header-widget header-cart" title="Cartlist"><i
							class="fas fa-shopping-basket"></i><sup>
							<p class="totalitem">
								<?= $this->cart->total_items(); ?>
							</p>
						</sup><span>total price<small class="totalamount">₹
								<?php echo $this->cart->format_number($this->cart->total()); ?>
							</small></span></button>
				</div>
			</div>
		</div>
	</header>
	<nav class="navbar-part">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="navbar-content">
						<ul class="navbar-list">
							<li class="navbar-item dropdown"><a class="navbar-link" href="<?= base_url() ?>">
									Home
								</a>
							</li>
							<li class="navbar-item dropdown"><a class="navbar-link" href="<?= base_url('about') ?>">
									About Us
								</a>
							</li>
							<li class="navbar-item dropdown"><a class="navbar-link "
									href="<?= base_url('product') ?>">Explore All Test</a>
							</li>
							<li class="navbar-item dropdown"><a class="navbar-link"
									href="<?= base_url('nearest-lab') ?>">Nearest lab</a>
							</li>
						</ul>
						<div class="navbar-info-group">
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<aside class="cart-sidebar">
		<div class="cart-header">
			<div class="cart-total"><i class="fas fa-shopping-basket"></i> total item &nbsp;
				<span class="totalitem"> (
					<?= $this->cart->total_items(); ?>)</span>
			</div>
			<button class="cart-close"><i class="icofont-close"></i></button>
		</div>
		<div id="cart"></div>
	</aside>
	<aside class="nav-sidebar">
		<div class="nav-header"><a href="#">
				<img src="<?= base_url() ?>assets/images/logo.png" alt="Msuperb"></a><button class="nav-close"><i
					class="icofont-close"></i></button>
		</div>
		<div class="nav-content">
			<ul class="nav-list">
				<li class="navbar-item dropdown"><a class="navbar-link" href="<?= base_url() ?>">
						Home
					</a>
				</li>
				<li class="navbar-item dropdown"><a class="navbar-link" href="<?= base_url('about') ?>">
						About Us
					</a>
				</li>
				<li class="navbar-item dropdown"><a class="navbar-link" href="<?= base_url('product') ?>">
						Explore All Test
					</a>
				</li>
				<li class="navbar-item dropdown"><a class="navbar-link " href="<?= base_url('nearest-lab') ?>">Nearest
						lab</a>

				</li>
				<?php
				if ($this->session->has_userdata('login_user_id')):
					?>
					<!-- <li class="navbar-item dropdown"><a class="navbar-link" href="<?= base_url('orders') ?>">
							<?= $this->profile[0]['name'] ?> Orders
						</a>
					</li> -->
					<?php
				else:
					?>

					<!-- <li class="navbar-item dropdown"><a class="navbar-link" href="<?= base_url('login') ?>">
							Login Here
						</a>
					</li> -->
					<?php
				endif;
				?>
			</ul>
			<div class="nav-info-group">
				<div class="nav-info"><i class="icofont-ui-touch-phone"></i>
					<p><small>call us</small><span><a href="tel:<?= $contact['contact_f'] ?>"
								style="color:#555555"><?= $contact['contact_f'] ?></a></span></p>
				</div>
				<div class="nav-info"><i class="icofont-ui-email"></i>
					<p><small>email us</small><span><a href="mailto:<?= $contact['email_f'] ?>"
								style="color:#555555"><?= $contact['email_f'] ?></a></span></p>
				</div>
			</div>
			<div class="nav-footer">
				<p>All Rights Reserved by <a href="<?= base_url() ?>">Care1 | Your One Care Medical</a></p>
			</div>
		</div>
	</aside>
	<div class="mobile-menu">
		<a href="<?= base_url() ?>" title="Home Page"><i class="fas fa-home"></i><span>Home</span></a>
		<a href="<?= base_url('product') ?>" class="cate-btn" title="Category List"><i class="fas fa-list"></i><span>All
				Products</span></a>
		<button class="cart-btn" title="Cartlist"><i class="fas fa-shopping-basket"></i><span>cartlist</span><sup
				class="totalitem">
				<?= $this->cart->total_items(); ?>+
			</sup></button>
		<?php
		if ($this->session->has_userdata('login_user_id')) {
			?>
			<a href="<?= base_url('orders'); ?>"><i class="fas fa-shopping-bag"></i><span>Orders</span></a>
			<a href="<?= base_url('profile') ?>"><i class="fas fa-user"></i><span>My Account</span></a>
			<?php
		} else {
			?>
			<a href="javascript:;" class="header-widget cart-checkout-btn"><i class="fas fa-sign-out-alt"></i><span>Sign
					In</span></a>
			<!-- <a href="<?= base_url('register') ?>"> <i class="fas fa-user"></i><span>Register </span></a> -->
			<?php
		}
		?>
	</div>