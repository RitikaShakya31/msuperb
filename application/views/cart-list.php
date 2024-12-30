<ul class="cart-list">
	<?php foreach ($this->cart->contents() as $items):
		//  $productName = $this->CommonModel->getSingleRowById('product', ['product_name' => $items['product_name']]);
		$productName = $this->CommonModel->getSingleRowById('all_service', ['service_id' => $items['name']]);
		?>
		<li class="cart-item">
			<div>
				<div class="cart-media">
					<!-- <a
						href="<?= base_url('product-details/' . encryptId($items['id']) . '/' . url_title($items['name'])) ?>">
						<img src="<?= setImage($items['image'], 'upload/product/') ?>" alt="<?php echo $items['name']; ?>">
					</a> -->
					<!-- 
					<button class="cart-delete removeCarthm remove" data-id="<?= $items['rowid'] ?>"><i
							class="far fa-trash-alt"></i>
					</button> -->

				</div>
				<div class="cart-action-group mt-2">
					<!-- <div class="product-action"><button class="action-minus qty-minus" data-rowid="<?= $items['id']; ?>" title="Quantity Minus"><i class="icofont-minus"></i></button>
						<input class="action-input" title="Quantity Number" type="text" id="qtysidecart<?= $items['id'] ?>" name="quantity" value="1">
						<button class="action-plus qty-plus" data-rowid="<?= $items['id']; ?>" title="Quantity Plus"><i class="icofont-plus"></i></button>
					</div> -->
					<div class="product-action othr-action">
						<button class="action-minus qty" title="Quantity Minus" data-rowid="<?= $items['rowid'] ?>"
							data-type="minus">
							<i class="icofont-minus">
							</i>
						</button>
						<input class="action-input" title="Quantity Number" id="qtysidecart<?= $items['rowid'] ?>"
							type="number" name="quantity" value="<?= $items['qty'] ?>">
						<button class="action-plus qty" title="Quantity Plus" data-rowid="<?= $items['rowid'] ?>"
							data-type="sidecart">
							<i class="icofont-plus">
							</i>
						</button>
					</div>
				</div>
			</div>

			<div class="cart-info-group">
				<div class="cart-info">
					<a class="cart-checkout-btn-2" href="<?= base_url('compare/') . encryptId($items['id']) ?>">
						<span class="compare-label">Compare with other</span>
					</a>
					<h6>
						<a
							href="<?= base_url('product-details/' . encryptId($items['id']) . '/' . url_title($items['name'])) ?>"><?php echo $productName['service_name']; ?>
							<!-- - <?php echo $items['variant_name']; ?></a> &nbsp; -->
							<button class="cart-delete removeCarthm remove" data-id="<?= $items['rowid'] ?>"><i
									class="far fa-trash-alt"></i></button>
					</h6>
					<p>Quantity - <?php echo $items['qty']; ?> X
						<?php echo $this->cart->format_number($items['price']); ?>/-
					</p>
					<h6>₹<?php echo $items['price'] * $items['qty']; ?></h6>
				</div>

			</div>
		</li>

	<?php endforeach; ?>
</ul>
<div class="cart-footer">
	<!-- <button class="coupon-btn">Do you have a coupon code?</button>
	<form class="coupon-form"><input type="text" placeholder="Enter your coupon code"><button type="submit"><span>apply</span></button></form> -->
	<!--<a class="cart-checkout-btn-1" href="<?= base_url('checkout') ?>">-->
	<!--	<span class="checkout-label">Proceed to Checkout</span>-->
	<!--	<span class="checkout-price">₹-->
	<!--		<?php echo $this->cart->format_number($this->cart->total()); ?></span></a>-->
	<?php
	if ($this->session->has_userdata('login_user_id')):
		?>
		<a class="cart-checkout-btn-1 mt-2" href="<?= base_url('checkout') ?>">
			<span class="checkout-label">Proceed to Checkout</span>
			<span class="checkout-price">₹
				<?php echo $this->cart->format_number($this->cart->total()); ?></span></a>
		<?php
	else:
		?>
		<a class="cart-checkout-btn-1" href="javascript:void(0);" id="proccesscheckoutButton">
			<span class="checkout-label">Proceed to Checkout</span>
			<span class="checkout-price">₹
				<?php echo $this->cart->format_number($this->cart->total()); ?></span></a>

	<?php endif; ?>
</div>

<?php
if (count($this->cart->contents()) > 0) { ?>
	<div class="cartbar">
		<button class="cart-btn" title="Cartlist"><i class="fas fa-shopping-basket"></i><span>cartlist</span><sup
				class="totalitem"><?= $this->cart->total_items(); ?>+</sup></button>
	</div>
<?php } ?>

<script>
	$(".cart-btn").on("click", function () {
		$("body").css("overflow", "hidden");
		$(".cart-sidebar").addClass("active");
	});
	$(".cart-close").on("click", (function () {
		$("body").css("overflow", "inherit"), $(".cart-sidebar").removeClass("active"), $(".backdrop").fadeOut()
	}));
	$(document).ready(function () {
		$('#proccesscheckoutButton').click(function () {
			$('#exampleModal').modal('show'); // Open modal
		});
	});
</script>