<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Alumni Bridges | Bowie State University</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?=base_url();?>_/styles/937641c6.main.css">
        <script src="<?=base_url();?>_/scripts/vendor/cf69c6f2.modernizr.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic' rel='stylesheet' type='text/css'>
    </head>
    <body class="app-shell admin dashboard">
        <header role="banner">
            <div class="container">
                <hgroup class="branding">
                    <a href="<?=base_url()?>index.php/alumni/directory">
                    Alumni Bridges : <strong>Bowie State University</strong>
                    </a>
                </hgroup>

                <nav class="main-nav">
                    <ul>
                        <?php if (isset($_SESSION['id'])): ?>
                        <li><a href="<?=base_url()?>index.php/admin/logout">Logout | </a></li>
                        <li><a href="<?=base_url()?>index.php/admin/admin_profile/<?php echo $_SESSION['id']; ?>">My Account</a></li>
                        <?php endif ?>
                    </ul> 
                </nav>
            </div>
        </header>
        <div class="app-full-container">