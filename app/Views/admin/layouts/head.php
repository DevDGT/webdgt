<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta property="og:title" content="WEB DGT">
	<meta property="og:description" content="Administrator Page WEB DGT">
	<meta property="og:image" content="<?= base_url('assets/img/logo.png') ?>">
	<meta property="og:url" content="<?= BASE_URL ?><?= ADMIN_PATH ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="baseUrl" content="<?= base_url() ?>">
	<meta name="adminPath" content="<?= ADMIN_PATH ?>">
	<meta name="apiPath" content="<?= API_PATH ?>">
	<meta name="username" content="<?= session('username') ?>">
	<meta name="userId" content="<?= session('userIdHash') ?>">
	<meta name="_token" content="<?= session('token') ?>">
	<meta name="admin" content="<?= session('isAdmin') ?>">
	<title class="webTitle">DGT | <?= $title ?? 'Administrator' ?></title>
	<link rel="shortcut icon" type="image/jpg" href="<?= base_url('assets/img/logo.png') ?>" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/admin') ?>/assets/css/adminlte.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/modules/iziToast.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
	<?= $this->renderSection("head"); ?>
</head>