<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Red Wash</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/template_landy/')?>vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/template_landy/')?>vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/template_landy/')?>css/landy-iconfont.css">
    <!-- Google fonts - Open Sans-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800">
    <!-- owl carousel-->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/template_landy/')?>vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/template_landy/')?>vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/template_landy/')?>css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/template_landy/')?>css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg fixed-top"><a href="<?= base_url('home');?>" class="navbar-brand">Red Wash</a>
        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><span></span><span></span><span></span></button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto align-items-start align-items-lg-center">
            <li class="nav-item"><a href="#about-us" class="nav-link link-scroll">About Us</a></li>
            <li class="nav-item"><a href="#features" class="nav-link link-scroll">Features</a></li>
            <li class="nav-item"><a href="#testimonials" class="nav-link link-scroll">Testimonials</a></li>
        <?php if($this->session->userdata('status') == 'user'):?>
            <li class="nav-item"><a href="<?= base_url('user/userBooking');?>" class="nav-link">Booking</a></li>
          </ul>
        <?php else:?>
          <div class="navbar-text">   
            <!-- Button trigger modal--><a href="<?= base_url('registration');?>" class="btn btn-primary navbar-btn btn-shadow btn-gradient">Sign Up</a>
            <!-- Button trigger modal--><!--<a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary navbar-btn btn-shadow btn-gradient">Sign Up</a>-->
          </div>
        <?php endif;?>
        </div>
      </nav>
    </header>

    <!-- Login -->
    <div id="loginModal" tabindex="-1" role="dialog" aria-labelledby="logineModalLabel" aria-hidden="true" class="modal fade">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="loginModalLabel" class="modal-title">Login</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form id="signupform" class="login_form" action="<?= base_url('auth/do_login');?>" method="POST">
              <div class="alert alert-danger d-none" id="msg_div">
                <span id="res_message"></span>
              </div>
              <div class="form-group">
                <label for="fullname">Username</label>
                <input type="text" name="username" placeholder="Username" id="username">
              </div>
              <div class="form-group">
                <label for="username">Password</label>
                <input type="password" name="password" placeholder="Password" id="password">
              </div>
              <div class="form-group">
                <button type="submit" id="send_form" class="submit btn btn-primary btn-shadow btn-gradient">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <!--<div id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Sign Up Modal</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form id="signupform" action="#">
              <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" name="fullname" placeholder="Full Name" id="fullname">
              </div>
              <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" name="username" placeholder="User Name" id="username">
              </div>
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" name="email" placeholder="Email Address" id="email">
              </div>
              <div class="form-group">
                <button type="submit" class="submit btn btn-primary btn-shadow btn-gradient">Signup</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>-->