<div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

    <!--- Sidebar navigation -->
    <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
    <ul id="nav">
        <!-- Main menu with font awesome icon -->
        <li <?php if($active_menu=="dashboard") echo 'class="open"'; ?> >
            <a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboards</a>
        </li>
        <li <?php if($active_menu=="barang") echo 'class="open"'; ?> >
            <a href="<?php echo base_url(); ?>master/barang"><i class="fa fa-list-alt"></i> Barang</a>
        </li>
        <li <?php if($active_menu=="upah") echo 'class="open"'; ?> >
            <a href="<?php echo base_url(); ?>master/upah"><i class="fa fa-user"></i> Upah</a>
        </li>
    </ul>
</div>
