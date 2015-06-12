<div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

    <!--- Sidebar navigation -->
    <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
    <ul id="nav">
        <!-- Main menu with font awesome icon -->
        <li class="<?php if ($this->uri->segment(1) == "dashboard") echo "open" ?>">
            <a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboards</a>
        </li>
        <li class="has_sub <?php if ($this->uri->segment(2) == "gudang" || $this->uri->segment(2) == "lpb" || $this->uri->segment(2) == "bpm") echo "open" ?>">
            <a><i class="fa fa-table"></i>Gudang <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
                <li><a href="<?= site_url() ?>master/gudang">Master Gudang</a></li>
            </ul>
            <ul>
                <li><a href="<?= site_url() ?>p-material/lpb">LPB</a></li>
            </ul>
            <ul>
                <li><a href="<?= site_url() ?>p-material/bpm">BPM</a></li>
            </ul>
        </li>
        <li class="has_sub <?php if ($this->uri->segment(2) == "supplier" || $this->uri->segment(2) == "kategorisupplier" || $this->uri->segment(2) == "pajaksupplier") echo "open" ?>">
            <a><i class="fa fa-table"></i>Supplier <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
                <li><a href="<?= site_url() ?>master/supplier">Master Supplier</a></li>
            </ul>
            <ul>
                <li><a href="<?= site_url() ?>master/kategorisupplier">Kategori Supplier</a></li>
            </ul>
            <ul>
                <li><a href="<?= site_url() ?>master/pajaksupplier">Pajak Supplier</a></li>
            </ul>
        </li>
        <li class="has_sub <?php if ($this->uri->segment(2) == "pp" || $this->uri->segment(2) == "po" || $this->uri->segment(2) == "overhead") echo "open" ?>">
            <a><i class="fa fa-table"></i>Material <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
        <ul>
        <li><a href="<?= site_url() ?>master/overhead"><i class="fa fa-table"></i> Overhead Management</a></li>
        </ul>
        <ul>
            <li><a href="<?= site_url() ?>p-material/pp"><i class="fa fa-table"></i> PP</a></li>
        </ul>
        <ul>
            <li><a href="<?= site_url() ?>p-material/po"><i class="fa fa-table"></i> PO</a></li>
        </ul>
        <ul>
            <li><a href="<?= site_url() ?>p-material/pb"><i class="fa fa-envelope"></i> Pembayaran Bahan</a></li>
        </ul>
        </li>
        <li class="has_sub">
            <a><i class="fa fa-table"></i>Tenaga Kerja <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
            <ul>
                <li><a href="#"><i class="fa fa-table"></i> Permintaan Pekerjaan</a></li>
            </ul>
            <ul>
                <li><a href="#"><i class="fa fa-table"></i> Opname</a></li>
            </ul>
            <ul>
                <li><a href="#"><i class="fa fa-table"></i> Pembayaran Upah</a></li>
            </ul>
            <ul>
                <li><a href="#"><i class="fa fa-table"></i> LPU</a></li>
            </ul>
        </li>
    </ul>
</div>
