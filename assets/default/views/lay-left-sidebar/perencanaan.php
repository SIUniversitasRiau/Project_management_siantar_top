<div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

    <!--- Sidebar navigation -->
    <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
    <ul id="nav">
        <!-- Main menu with font awesome icon -->
        <li class="<?php if($this->uri->segment(1) == "dashboard") echo "open" ?>">
            <a href="<?php echo base_url(); ?>dashboard/Perencanaan"><i class="fa fa-home"></i> Dashboards</a>
        </li>
        <li class="<?php if($this->uri->segment(2) == "barang") echo "open" ?>">
            <a href="<?php echo base_url().'master/barang'; ?>"><i class="fa fa-list-alt"></i> Barang</a>
        </li>
        <li class="<?php if($this->uri->segment(2) == "upah") echo "open" ?>">
            <a href="<?php echo base_url().'master/upah'; ?>"><i class="fa fa-money"></i> Upah</a>
        </li>
        <li class="<?php if($this->uri->segment(2) == "analisa") echo "open" ?>">
            <a href="<?php echo base_url().'rab/analisa'; ?>"><i class="fa fa-money"></i> Analisa</a>
        </li>
        <li class="<?php if($this->uri->segment(2) == "project") echo "open" ?>">
            <a href="<?php echo base_url().'projects/project'; ?>"><i class="fa fa-building-o"></i> Project</a>
        </li>		  
        <li class="<?php if($this->uri->segment(2) == "Estimasi") echo "open" ?>">
            <a href="<?php echo base_url().'estimasi/Estimasi'; ?>"><i class="fa fa-table"></i> Estimasi</a>
        </li>
    </ul>
</div>
