<style>
    .v-separator
    {
        content: "";
        display: inline-block;
        height: 55px;
        border-right: 1px solid #fafafa;
        border-left: 1px solid #b4b4b4;
        padding: 0;
    }
</style>
<div class="navbar navbar-fixed-top bs-docs-nav pull-left" role="banner">

    <div class="container">
        <!-- Menu button for smallar screens -->
        <div class="navbar-header">
            <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span>Menu</span>
            </button>
            <!-- Site name for smallar screens -->
            <a href="<?php echo base_url() ?>" class="navbar-brand hidden-lg">SIProject</a>
        </div>



        <!-- Navigation starts -->
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">         

            <ul class="nav navbar-nav">  
                <li class="dropdown dropdown-big">
                    <a href="<?php echo site_url(); ?>user-management/pengguna" class="dropdown-toggle"><span class="label label-success"><i class="fa fa-users"></i></span> Manajemen Pengguna</a>
                    <!-- Dropdown -->
                </li>

                <li class="dropdown dropdown-big">
                    <a href="<?php echo site_url(); ?>rab/rabs/add" class="dropdown-toggle" ><span class="label label-danger"><i class="fa fa-check-circle-o"></i></span> T. Perencanaan</a>
                    <!-- Dropdown -->
                </li>

                <li class="dropdown dropdown-big">
                    <a href="<?php echo site_url(); ?>p-material/pp" class="dropdown-toggle" ><span class="label label-danger"><i class="fa fa-building-o"></i></span> T. Pelaksanaan</a>
                    <!-- Dropdown -->
                </li>
                <!-- Upload to server link. Class "dropdown-big" creates big dropdown -->

                <!-- Sync to server link -->
                <li class="dropdown dropdown-big">
                    <a href="<?php echo site_url(); ?>dashboard/Monitoring" class="dropdown-toggle" ><span class="label label-info"><i class="fa fa-laptop"></i></span> Monitoring</a>
                    <!-- Dropdown -->
                </li>

                <li class="dropdown dropdown-big">
                    <a href="<?php echo site_url(); ?>report" class="dropdown-toggle" ><span class="label label-info"><i class="fa fa-files-o"></i></span> Laporan</a>
                    <!-- Dropdown -->
                </li>




            </ul>


            <!-- Links -->
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown pull-right">            
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-user"></i> <?php echo $username ?> <b class="caret"></b>              
                    </a>

                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="#"><i class="fa fa-cogs"></i> Settings</a></li>
                        <li><a href="<?php echo base_url() ?>auth/Logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>

            </ul>
        </nav>

    </div>
</div>
<div class="clearfix"></div>


<!-- Header starts -->
<header>
    <div class="container">
        <div class="row">

            <!-- Logo section -->
            <div class="col-md-4">
                <!-- Logo. -->
                <div class="logo">
                  <!--<h1><a href="#">SI<span class="bold">Project</span></a></h1>
                  <p class="meta">Sistem Manajemen dan Monitoring Proyek</p> -->
                    <img src="<?= site_url() ?>/assets/default/addprologo.png" height="70px" alt="Logo" title="AddPRO" class="pull-left"/>
                </div>
                <!-- Logo ends -->
            </div>

            <!-- Button section -->
            <div class="col-md-6">

                <!-- Buttons -->

            </div>

            <!-- Data section -->

            <div class="col-md-2">
                <ul class="nav nav-pills">

                    <li class="dropdown dropdown-big" style="float: right">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="fa fa-bullhorn"></i> Notifikasi <span class="label label-primary">3</span> 
                        </a>

                        <ul class="dropdown-menu" style="margin-left:-100px">

                            <li>
                                <!-- List item heading h6 -->
                                <h6><a href="#">Perubahan Harga master</a></h6>
                                <!-- List item para -->
                                <p>Permintaan validasi pada peruba...</p>
                                <hr />
                            </li>
                            <li>
                                <h6><a href="#">RAB yang harus dibuat</a></h6>
                                <p>Terdapat 3 data RAB yang harus.....</p>
                                <hr />
                            </li>
                            <li>
                                <div class="drop-foot">
                                    <a href="#">View All</a>
                                </div>
                            </li>                                    
                        </ul>
                    </li>

                </ul>

            </div>

        </div>
    </div>
</header>
