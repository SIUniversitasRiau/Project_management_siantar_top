<div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

    <!--- Sidebar navigation -->
    <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
    <ul id="nav">
        <!-- Main menu with font awesome icon -->
        <li class="open">
            <a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboards</a>
        </li>
        <li class="has_sub">
            <a href="#"><i class="fa fa fa-tasks"></i> Perencanaan <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
              <li><a href="#">Melihat Detail Perencanaan</a></li>
            </ul>
        </li>
        <li class="has_sub">
            <a href="#"><i class="fa fa fa-tasks"></i> Pelaksanaan <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
              <li><a href="#">Melihat Detail Pelaksanaan</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-bar-chart-o"></i> Melihat Progres Fisik</a>
        </li>
        <li>
            <a href="#"><i class="fa fa fa-tasks"></i> Kinerja Pegawai</a>
        </li>
    </ul>
</div>
