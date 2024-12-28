<head>
  <meta charset="UTF-8">
  <meta name="google-site-verification" content="uWi_cEkPlaWYyOChX06Bfy9H9hYTYTNZHntYItpaVw8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="template" content="CARE1">
  <meta name="title" content="<?php echo isset($title) && $title != '' ? $title : $title . 'Msuperb '; ?>">
 <meta name="description" content="<?php echo isset($desc) ? ($desc != '' ? $desc : 'Msuperb') : 'Msuperb'; ?>">
  <meta name="keywords" content="<?php echo isset($keyword) ? ($keyword != '' ? $keyword : 'Msuperb') : 'Msuperb'; ?>">


  <!---------------------------------------------------Twitter Meta Property Started------------------------------------------------->

  <meta property="twitter:card" content="summary" />
  <meta name="twitter:title" content="Msuperb" />
  <meta name="twitter:description" content="Msuperb" />
  <meta name="twitter:url" content="https://www.care1.com" />
  <meta property="twitter:site" content="https://www.care1.com" />
  <meta property="twitter:image" content="https://www.care1.com/assets/images/favicon.png" />
  <meta property="twitter:image:width" content="349" />
  <meta property="twitter:image:height" content="307" />
  <meta name="twitter:domain" content="Msuperb " />

  <!---------------------------------------------------Twitter Meta Property End------------------------------------------------->

  <!---------------------------------------------------OG Meta Property Started------------------------------------------------------>
  <meta property="og:title" content="Msuperb " />
  <meta property="og:description" content="Msuperb" />
  <meta property=og:image content="https://www.care1.com/assets/images/favicon.png" />
  <meta property="og:url" content="https://www.care1.com" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="article" />
  <meta property="og:sitename" content="Msuperb " />
  <meta property="article:publisher" content="Msuperb " />
  <meta name="distribution" content="global" />
  <meta property="article:tag" content="" />
  <meta property="article:tag" content="" />
  <meta property="article:tag" content="" />
  <meta property="article:tag" content="" />
  <meta property="og:image:width" content="349" />
  <meta property="og:image:height" content="307" />

  <!---------------------------------------------------OG Meta Property Ended------------------------------------------------------>


  <title>Msuperb | <?= $title ?></title>
  <link rel="icon" href="<?= base_url($setting[3]['particular_value']) ?>">
  <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/flaticon/flaticon.css">

  <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/icofont/icofont.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/fonts/fontawesome/fontawesome.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/venobox/venobox.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/slickslider/slick.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/niceselect/nice-select.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/user-auth.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/product-details.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/profile.css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/checkout.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/invoice.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/faq.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/index.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/orderlist.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/contact.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <style>
    .rating {
      unicode-bidi: bidi-override;
      direction: rtl;
      text-align: center;
    }

    .rating>span {
      display: inline-block;
      position: relative;
      width: 1.1em;
    }

    .rating>span:hover:before,
    .rating>span:hover~span:before {
      content: "\2605";
      position: absolute;
    }

    .rating>span:hover:before {
      color: gold;
    }

    .rating>input {
      display: none;
    }

    .rating>input:checked~span:before {
      content: "\2605";
      position: absolute;
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
      content: "\2605";
      position: absolute;
    }

    .is-invalid {
      border: 1px solid red;
    }
  </style>


</head>