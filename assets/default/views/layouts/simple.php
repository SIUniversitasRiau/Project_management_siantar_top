<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title><?php echo $template['title'];?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Stylesheets -->
  <link href="<?php echo site_url()?>assets/default/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo site_url()?>assets/default/css/font-awesome.min.css">
  <link href="<?php echo site_url()?>assets/default/css/style.css" rel="stylesheet">
  
  <script src="<?php echo site_url()?>assets/default/js/respond.min.js"></script>
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo site_url()?>assets/default/img/favicon/favicon.png">
</head>

<body>

<!-- Form area -->
<div class="admin-form">
  <div class="container">
       <?php  echo $template['body']; ?>
</div> 
</div>
	
		

<!-- JS -->
<script src="<?php echo site_url()?>assets/default/js/jquery.js"></script>
<script src="<?php echo site_url()?>assets/default/js/bootstrap.min.js"></script>
</body>
</html>