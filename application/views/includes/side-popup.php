<style>
    @import url(//fonts.googleapis.com/css?family=Raleway:300,700);

    .side-popup {
        background: #fff;
        border: 0;
        display: block;
        margin-left: 0;
        border-radius: 10px;
        bottom: 50px;
        left: 20px;
        top: auto !important;
        right: auto !important;
        padding: 0;
        position: fixed;
        text-align: left;
        width: auto;
        z-index: 999;
        font-family: "Open Sans";
        font-weight: 400;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
        background-color: #ffffff;
        border-style: solid;
        border-color: #b08b5b;
        border-width: 0 0 0 10px;
        padding-right: 25px;
    }

    .side-popup img {
        cursor: pointer;
        float: left;
        max-height: 85px;
        max-width: 120px;
        width: auto;
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    .side-popup p {
        color: #444;
        float: left;
        font-size: 13px;
        margin: 0 0 0 13px;
        width: auto;
        padding: 10px 10px 0 0;
        line-height: 20px;
    }

    .side-popup p a {
        color: #b08b5b;
        display: block;
        font-size: 15px;
        font-weight: 700;
        background-color: transparent;
    }

    .side-popup p small {
        display: block;
        font-size: 10px;
        margin-bottom: 8px;
    }

    #side-popup-close {
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 10px;
        opacity: 0.2;
        background: url(https://s3.amazonaws.com/fomo-static-assets/close.png);
        width: 16px;
        height: 16px;
        background-size: cover;
    }

    #side-popup-close:hover {
        opacity: 1;
    }

    .side-popup.fade-in {
        opacity: 0;
        animation-name: nFadeIn;
        animation-duration: 1s;
        animation-fill-mode: both;
    }

    .side-popup.fade-out {
        opacity: 0;
        animation-name: nFadeOut;
        animation-duration: 1s;
        animation-fill-mode: both;
    }

    @keyframes nFadeIn {
        from {
            opacity: 0;
            transform: translate3d(-100%, 0, 0);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    @keyframes nFadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
            transform: translate3d(-100%, 0, 0);
        }
    }

    @media screen and (max-width: 767px) {
        @keyframes nFadeIn {
            from {
                opacity: 0;
                transform: translate3d(0, 100%, 0);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .side-popup {
            bottom: 100px !important;
            left: 0 !important;
            width: 100%;
            max-width: none !important;
            margin-left: 0;
            height: auto;
            padding: 0;
            text-align: left;
            border-radius: 0;
        }

        .side-popup img {
            max-width: 20%;
            max-height: auto;
            margin: 0;
            border-radius: 0;
        }

        .side-popup p {
            font-size: 11px;
            width: 70%;
            margin: 0 0 0 13px;
            padding: 10px 10px 0 0;
        }

        .side-popup p a {
            font-size: 13px;
            margin: 0;
            padding: 0;
        }

        @keyframes nFadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                transform: translate3d(0, 100%, 0);
            }
        }
    }

    @keyframes flip {
        from {
            transform: perspective(400px) rotate3d(0, 1, 0, 0deg);
            animation-timing-function: ease-out;
        }

        50% {
            transform: perspective(400px) translate3d(0, 1, 0px) rotate3d(0, 1, 0, 180deg);
            animation-timing-function: ease-in;
        }

        to {
            transform: perspective(400px) rotate3d(0, 1, 0, 360deg);
            animation-timing-function: ease-in;
        }
    }
</style>

<?php
$allOrders = $this->CommonModel->getRowByIdInOrderWithLimit('book_product', "booking_status = '0' AND (payment_mode = '1' OR payment_mode = '2' AND transaction_status = '1')", 'create_date', 'DESC', 10);
?>

<!-- <?php
if ($allOrders) {
    foreach ($allOrders as $item) {
        $postOrder = getRowById('book_item', 'order_id', $item['order_id']);
        if ($postOrder) {
            foreach ($postOrder as $product) {
?>
                <div id="side-popup<?= $product['book_item_id'] ?>" class="fade-in side-popup">
                    <img src="<?= $product['product_img'] ?>">
                    <p>
                        Recently <?= $item['name'] ?> Buy
                        <a href="<?= base_url('product-details/' . encryptId($product['product_id']) . '/' . url_title($product['product_name'])) ?>"><?= $product['product_name'] ?></a>
                    </p>
                    <button type="button" class="side-popup-close"></button>
                </div>
<?php
            }
        }
    }
}
?> -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const popups = document.getElementsByClassName('side-popup');
        let currentIndex = 0;

        // Hide all popups except the first one on page load
        Array.from(popups).forEach((popup, index) => {
            popup.style.display = index === 0 ? 'block' : 'none';
        });

        function showPopup() {
            if (currentIndex < popups.length) {
                // Hide the current popup
                if (currentIndex > 0) {
                    popups[currentIndex - 1].style.display = 'none';
                }

                const popup = popups[currentIndex];
                popup.style.display = 'block';
                popup.classList.add('fade-in');

                setTimeout(function() {
                    popup.classList.remove('fade-in');
                    popup.style.display = 'none';

                    currentIndex++;
                    if (currentIndex >= popups.length) {
                        currentIndex = 0; // Reset to first popup when all have been shown
                    }

                    // Add a 3-second delay before showing the next popup
                    setTimeout(showPopup, 3000);

                }, 5000); // Display each popup for 5 seconds
            }
        }

        // Initial delay before starting the popup sequence
        setTimeout(showPopup, 5000);

        // Close button functionality
        document.querySelectorAll('.side-popup-close').forEach(button => {
            button.addEventListener('click', function() {
                const popup = this.closest('.side-popup');
                popup.style.display = 'none';
                console.log('Popup closed:', popup); // Check if close button is working
            });
        });


    });
</script>