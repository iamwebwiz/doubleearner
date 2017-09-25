<!DOCTYPE html>
<html lang="en">
<?php $user = getUserById($this->session->user_id) ?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap Styles-->
    <link href="<?php echo base_url('assets/user/css/bootstrap.css') ?>" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo base_url('assets/user/css/font-awesome.css') ?>" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="<?php echo base_url('assets/user/js/morris/morris-0.4.3.min.css') ?>" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="<?php echo base_url('assets/user/css/custom-styles.css') ?>" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- jQuery Js -->
    <script src="<?php echo base_url('assets/user/js/jquery-1.10.2.js') ?>"></script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url() ?>"><?php echo $this->config->item('app_name') ?></a>
            </div>

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
        </nav>
        <!--/. NAV TOP  -->

        