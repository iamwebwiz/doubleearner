<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta charset="utf-8">
	<meta name="application-name" content="DoubleEarner">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.css"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/font-awesome/css/font-awesome.css') ?>">
	<script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
</head>
<body>
	<div class="navbar navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="<?php echo site_url() ?>"><?php echo $this->config->item('app_name') ?></a>
			</div>
			<div class="navbar-collapse collapse">
				
				<?php if (!isLoggedIn()): ?>
					<ul class="nav navbar-nav pull-right">
						<li><a href="<?php echo site_url('login') ?>"><span class="fa fa-sign-in"></span> Login</a></li>
						<li><a href="<?php echo site_url('register') ?>"><span class="fa fa-user"></span> Register</a></li>
						<li><a href="<?php echo site_url('support') ?>"><span class="fa fa-envelope-open"></span> Contact us</a></li>
				</ul>	
				<?php else: ?>
					<?php $user = getUserById($this->session->user_id) ?>
					<ul class="nav navbar-top-links navbar-right">
					    <li class="dropdown">
					        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
					            <i class="fa fa-user fa-fw"></i> <?php echo $user->username ?> <i class="fa fa-caret-down"></i>
					        </a>
					        <ul class="dropdown-menu dropdown-user">
					            <li><a href="<?php echo site_url('user') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
					            <li>
					                <a href="<?php echo site_url('support') ?>"><i class="fa fa-envelope-o"></i> Contact Support</a>
					            </li>
					            <li class="divider"></li>
					            <li>
					                <a href="<?php echo site_url('logout') ?>"><i class="fa fa-power-off"></i> Logout</a>
					            </li>
					        </ul>
					        <!-- /.dropdown-user -->
					    </li>
					    <!-- /.dropdown -->
					</ul>
				<?php endif; ?>
					
			</div>
		</div>
	</div>
	<div class="container">
	<?php if (!isLoggedIn()): ?>
	
		<!-- Row -->
		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs">
					<li id="home"><a href="<?php echo site_url() ?>"><span class="fa fa-home"></span> Home</a></li>
					<li id="login"><a href="<?php echo site_url('login') ?>"><span class="fa fa-sign-in"></span> Login</a></li>
					<li id="register"><a href="<?php echo site_url('register') ?>"><span class="fa fa-user"></span> Register</a></li>
					<li id="faq"><a href="<?php echo site_url('faq') ?>"><span class="fa fa-question"></span> FAQs</a></li>
					<li id="support"><a href="<?php echo site_url('support') ?>"><span class="fa fa-envelope-open"></span> Contact us</a></li>
				</ul>
			</div>
		</div>
	<?php endif; ?>
		<br>