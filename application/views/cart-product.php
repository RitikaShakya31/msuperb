<ul class="cart-list">
	<?php foreach ($this->cart->contents() as $items):
		$productName = $this->CommonModel->getSingleRowById('all_service', ['service_id' => $items['name']]);
		?>
		<li class="cart-item">
			<!-- <div class="cart-media">
				<a
					href="<?= base_url('product-details/' . encryptId($items['id']) . '/' . url_title($items['name'])) ?>">
					<img src="<?= setImage($items['image'], 'upload/product/') ?>" alt="<?php echo $items['name']; ?>">
				</a><button type="button" class="cart-delete removeCarthm remove" data-id="<?= $items['rowid'] ?>"><i
						class="far fa-trash-alt"></i></button></div> -->
			<div class="cart-info-group">
				<div class="cart-info">
					<h6><a
							href="<?= base_url('product-details/' . encryptId($items['id']) . '/' . url_title($items['name'])) ?>"><?php echo $productName['service_name']; ?>
							&nbsp;
							<!-- - <?php echo $items['variant_name']; ?></a> &nbsp; -->
							<a href="javascript:void(0)" class="cart-delete removeCarthm remove"
								data-id="<?= $items['rowid'] ?>"><i class="far fa-trash-alt"></i></a></h6>
					<p>Quantity - <?php echo $items['qty']; ?> X
						<b><?php echo $this->cart->format_number($items['price']); ?> </b> <span class="text-reset"><strike>
								<?php echo $this->cart->format_number($items['market_price']); ?> </strike></span></-< /p>
				</div>
				<div class="cart-action-group">
					<!-- <h6> ₹ <?php echo $items['price'] * $items['qty']; ?></h6> -->
				</div>
			</div>
		</li>
	<?php endforeach; ?>
</ul>