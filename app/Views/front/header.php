<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title class="webTitle"><?php echo $title ?? 'DGT'; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta property="og:title" content="<?= $newsData[0]->title ?? "WEB DGT" ?>">
    <meta property="og:description" content="<?= $newsData[0]->description ?? "WEB Profile and Product Dianglobaltech" ?>">
    <meta property="og:image" content="<?php echo base_url('/assets/img/logo.png'); ?>">
    <meta property="og:url" content="<?php echo base_url('/assets/img/logo.png') ?>">
    <!-- Favicons -->
    <link href="<?php echo base_url('/assets/img/logo.png'); ?>" rel="icon">
    <link href="<?php echo base_url('/assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon" sizes="180x180">
    <link href="<?php echo base_url('/assets/img/favicon-32x32.png') ?>" rel="icon" type="image/png" sizes="32x32">
    <link href="<?php echo base_url('/assets/img/favicon-16x16.png') ?>" rel="icon" type="image/png" sizes="16x16">
    <meta name="baseUrl" content="<?= base_url() ?>">
    <meta name="apiPath" content="<?= API_PATH ?>">
    <meta name="slug" content="<?= $slug ?? "" ?>">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url('/assets/vendor/animate.css/animate.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/aos/aos.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/glightbox/css/glightbox.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/swiper/swiper-bundle.min.css'); ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/modules/floatingjs/css/socialfloating.css'); ?>">

    <!-- Vendor JS Files -->
    <?php include 'vendor.php'; ?>

    <!-- Template Main JS File -->
    <?php include 'script.php'; ?>

</head>