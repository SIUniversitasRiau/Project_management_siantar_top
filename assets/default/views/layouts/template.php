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


  <?php echo $template['partials']['script-header']; ?>
  <!-- Favicon -->
  <link rel="shortcut icon" href="img/favicon/favicon.png">
</head>

<body>

<!-- Header starts -->
<?php echo $template['partials']['header']; ?>
<!-- Header ends -->

<!-- Main content starts -->

<div class="content">

    <!-- Sidebar -->
    <?php echo $template['partials']['left-sidebar']; ?>
    <!-- Sidebar ends -->

    <!-- Main bar -->
  <div class="mainbar">
      
	 <?php  echo $template['body']; ?>

    </div>

   <!-- Mainbar ends -->
   <div class="clearfix"></div>

</div>
<!-- Content ends -->


<!-- Footer starts -->
<?php echo $template['partials']['footer']; ?>

<!-- Footer ends -->
<?php echo $template['partials']['script-footer']; ?>
<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 


</body>
</html>