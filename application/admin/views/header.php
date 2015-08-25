<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-script-type" content="text/javascript" />
		<meta http-equiv="content-style-type" content="text/css" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Cache-Control" content="no-cache" /> 
		<link rel="stylesheet" href="/assets/admin/css/global.css" type="text/css" />
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript" src="/assets/admin/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<title><?php echo ENV_LABEL.' ';?>Admin Panel</title>
	</head>
	<body>
		<h1><?php echo ENV_LABEL;?></h1>
		<?php if (logged_in()):?>

		<!--header area-->
		<div id="header">
			<div id="logo">Hi, <?php echo username(); ?>.</div>
		</div>

		<!--navigation area-->
		<div id="nav_bg">
		<?php $this->load->view($this->config->item('auth_views_root') . 'nav'); ?>
		</div>

		<?php endif;?>
		
		<div id="container">
