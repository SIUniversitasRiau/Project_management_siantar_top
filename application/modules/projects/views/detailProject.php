<script>
    var tableRAB, tableRAP;
    var current_id_rab = -1;
    var current_id_rap = -1;
    Number.prototype.formatMoney = function(c, d, t) {
        var n = this,
                c = isNaN(c = Math.abs(c)) ? 2 : c,
                d = d == undefined ? "." : d,
                t = t == undefined ? "," : t,
                s = n < 0 ? "-" : "",
                i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };

    $(document).ready(function() {
        var url = document.location.toString();
        if (url.match('#')) {
            $('#myTab a[href=#' + url.split('#')[1] + ']').tab('show');
        }

        $('#myTab a').on('shown', function(e) {
            window.location.hash = e.target.hash;
        })
        tableRAB = $('#tabelRAB').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo base_url(); ?>rab/rabs/getViewRabById?project_id=<?= $detailProject[0]['PROJECT_ID'] ?>",
                        "createdRow": function(row, data, index) {
                            var id = data[5];
                            $('td', row).eq(5).html('<button class="btn btn-primary btn-xs" onclick="viewRAB(' + id + ')"><i class="fa fa-eye fa-fw"></i> Lihat</button><button class="btn btn-success btn-xs" style="margin-left: 10px" onclick="editRAB(' + id + ')"><i class="fa fa-pencil fa-fw"></i> Edit</button><button class="btn btn-info btn-xs" style="margin-left: 10px" onclick="lihatRAP(' + id + ')"><i class="fa fa-list fa-fw"></i> Lihat RAP</button>');
                            $(row).attr('id', 'item_rab_' + id);
                        }
                    });
                    tableRAP = $('#tabelRAP').dataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "<?php echo base_url(); ?>rab/rabs/getViewRabById?project_id=<?= $detailProject[0]['PROJECT_ID'] ?>",
                                    "createdRow": function(row, data, index) {
                                        var id = data[5];
                                        $('td', row).eq(5).html('<button class="btn btn-primary btn-xs" onclick="viewRAP(' + id + ')"><i class="fa fa-eye fa-fw"></i> Lihat</button>');
                                        $(row).attr('id', 'item_rap_' + id);
                                    }
                                });
                            });

                            function nextChar(c, d) {
                                if (d == null) {
                                    d = 1;
                                }
                                return String.fromCharCode(c.charCodeAt(0) + d);
                            }

                            function editRAB(id) {
                                $("#id_to_edit").val(id);
                                $("#form_edit").submit();
                            }

                            function lihatRAP(id) {
                                window.open('<?= base_url(); ?>rap/raps/viewDetail?id=' + id, '_blank');
                            }

                            function viewRAP(id) {
                                if (current_id_rap != id) {
                                    current_id_rap = id;
                                    $("#row_ubah_rap").remove();
                                    $("<tr id='row_ubah_rap'><td colspan='7'><div style='margin-top:10px; margin-bottom:10px' id='form_ubah_rap' align='center'><img id='bar_loader_rap' src='<?= base_url() . 'assets/default/img/bar_loader.gif' ?>'></div></td></tr>").insertAfter("#item_rap_" + current_id_rap);
                                    var x = $("#template_form_ubah_rap").clone();
                                    x.appendTo("#form_ubah_rap");
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url(); ?>rap/raps/detail",
                                        data: {id: id},
                                        cache: true,
                                        success: function(result) {
                                            var res = JSON.parse(result);
                                            console.log(res);
                                            var res_barang = res["detail_barang"];
                                            var res_upah = res["detail_upah"];
                                            var subcon = res["subcon"];
                                            var item = '';
                                            var jumlah = 0;
                                            $("#bar_loader_rap").remove();
                                            $(".item_rap_detail").remove();
                                            if (res_barang.length > 0) {
                                                item += '<tr class="item_rap_detail"><td colspan="6"><b>BARANG / BAHAN</b></td></tr>';
                                                for (var i = 0; i < res_barang.length; i++) {
                                                    item += '<tr class="item_rap_detail"><td>' + res_barang[i]["BARANG_NAMA"] + '</td><td>' + res_barang[i]["BARANG_KODE"] + '</td><td>' + res_barang[i]["SATUAN_NAMA"] + '</td><td align="right"><span class="currency">Rp</span><span class="number">' + (parseFloat(res_barang[i]["BARANG_HARGA"])).formatMoney(2) + '</span></td><td>' + res_barang[i]["BARANG_VOLUME"] + '</td><td align="right"><span class="currency">Rp</span><span class="number">' + (parseFloat(res_barang[i]["BARANG_HARGA"]) * parseFloat(res_barang[i]["BARANG_VOLUME"])).formatMoney(2) + '</span></td></tr>';
                                                    jumlah += (parseFloat(res_barang[i]["BARANG_HARGA"]) * parseFloat(res_barang[i]["BARANG_VOLUME"]));
                                                }
                                            }
                                            if (res_upah.length > 0) {
                                                item += '<tr class="item_rap_detail"><td colspan="6"><b>UPAH</b></td></tr>';
                                                for (var i = 0; i < res_upah.length; i++) {
                                                    item += '<tr class="item_rap_detail"><td>' + res_upah[i]["UPAH_NAMA"] + '</td><td>' + res_upah[i]["UPAH_KODE"] + '</td><td>' + res_upah[i]["SATUAN_UPAH_NAMA"] + '</td><td align="right"><span class="currency">Rp</span><span class="number">' + (parseFloat(res_upah[i]["UPAH_HARGA"])).formatMoney(2) + '</span></td><td>' + res_upah[i]["UPAH_VOLUME"] + '</td><td align="right"><span class="currency">Rp</span><span class="number">' + (parseFloat(res_upah[i]["UPAH_HARGA"]) * parseFloat(res_upah[i]["UPAH_VOLUME"])).formatMoney(2) + '</span></td></tr>';
                                                    jumlah += (parseFloat(res_upah[i]["UPAH_HARGA"]) * parseFloat(res_upah[i]["UPAH_VOLUME"]));
                                                }
                                            }
                                            if (subcon.length > 0) {
                                                item += '<tr class="item_rap_detail"><td colspan="6"><b>SUBCON</b></td></tr>';
                                                for (var i = 0; i < res_upah.length; i++) {
                                                    item += '<tr class="item_rap_detail"><td>' + res_upah[i]["SUBCON_NAMA"] + '</td><td>LS</td><td>' + res_upah[i]["SATUAN_NAMA"] + '</td><td align="right"><span class="currency">Rp</span><span class="number">' + (parseFloat(res_upah[i]["SUBCON_HARGA"])).formatMoney(2) + '</span></td><td>' + res_upah[i]["DETAIL_PEKERJAAN_VOLUME"] + '</td><td><td align="right"><span class="currency">Rp</span><span class="number">' + (parseFloat(res_upah[i]["SUBCON_HARGA"]) * parseFloat(res_upah[i]["DETAIL_PEKERJAAN_VOLUME"])).formatMoney(2) + '</span></td></tr>';
                                                    jumlah += (parseFloat(res_upah[i]["SUBCON_HARGA"]) * parseFloat(res_upah[i]["DETAIL_PEKERJAAN_VOLUME"]));
                                                }
                                            }
                                            item += '<tr class="item_rap_detail"><td colspan="5">Jumlah</td><td align="right"><span class="currency">Rp</span><span class="number">' + (jumlah).formatMoney(2) + '</span></td></tr>';
                                            $("#template_form_ubah_rap #detail_rap").html(item);
                                            x.slideDown();
                                        }
                                    });
                                } else {
                                    $('#form_ubah_rap').slideUp('normal', function() {
                                        $('#row_ubah_rap').remove();
                                    });
                                    current_id_rap = -1;
                                }
                            }

                            function viewRAB(id) {
                                if (current_id_rab != id) {
                                    current_id_rab = id;
                                    $("#row_ubah_rab").remove();
                                    $("<tr id='row_ubah_rab'><td colspan='7'><div style='margin-top:10px; margin-bottom:10px' id='form_ubah_rab' align='center'><img id='bar_loader_rab' src='<?= base_url() . 'assets/default/img/bar_loader.gif' ?>'></div></td></tr>").insertAfter("#item_rab_" + current_id_rab);
                                    var x = $("#template_form_ubah_rab").clone();
                                    x.appendTo("#form_ubah_rab");
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url(); ?>rab/rabs/detail",
                                        data: {id: id},
                                        cache: true,
                                        success: function(result) {
                                            var res = JSON.parse(result);
                                            console.log(res);
                                            var res_pekerjaan = res["detail_pekerjaan"];
                                            var pekerjaan = '';
                                            var jumlah_kategori = 0;
                                            var jumlah_total = 0;
                                            var header_kategori = '';
                                            $("#bar_loader_rab").remove();
                                            $(".item_rab_pekerjaan").remove();
                                            var cString = 'A';
                                            var c = 0;
                                            for (var i = 0; i < res_pekerjaan.length; i++) {
                                                if (header_kategori != res_pekerjaan[i]["KATEGORI_PEKERJAAN_ID"]) {
                                                    if (header_kategori != '') {
                                                        pekerjaan += '<tr class="item_rab_pekerjaan"><td colspan="6" align="right"><b>JUMLAH</b></td><td align="right"><span class="currency">Rp</span><span class="number">' + (jumlah_kategori).formatMoney(2) + '</span></td></tr>';
                                                        jumlah_total += jumlah_kategori;
                                                        jumlah_kategori = 0;
                                                    }
                                                    pekerjaan += '<tr class="item_rab_pekerjaan"><td><b>' + nextChar(cString, c) + '</b></td><td colspan="6"><b>' + res_pekerjaan[i]["KATEGORI_PEKERJAAN_NAMA"] + '</b></td></tr>';
                                                    c++;
                                                    header_kategori = res_pekerjaan[i]["KATEGORI_PEKERJAAN_ID"];
                                                }

                                                if (res_pekerjaan[i]["ANALISA_ID"] != null) {
                                                    pekerjaan += '<tr class="item_rab_pekerjaan"><td>' + res_pekerjaan[i]["DETAIL_PEKERJAAN_URUTAN"] + '</td><td>' + res_pekerjaan[i]["ANALISA_NAMA"] + '</td><td>' + res_pekerjaan[i]["ANALISA_KODE"] + '</td><td>' + res_pekerjaan[i]["DETAIL_PEKERJAAN_VOLUME"] + '</td><td>' + res_pekerjaan[i]["SATUAN_ANALISA_NAMA"] + '</td><td align="right"><span class="currency">Rp</span><span class="number">' + (parseFloat(res_pekerjaan[i]["ANALISA_TOTAL"])).formatMoney(2) + '</span></td><td align="right"><span class="currency">Rp</span><span class="number">' + (parseFloat(res_pekerjaan[i]["DETAIL_PEKERJAAN_TOTAL"])).formatMoney(2) + '</span></td></tr>';
                                                } else {
                                                    pekerjaan += '<tr class="item_rab_pekerjaan"><td>' + res_pekerjaan[i]["DETAIL_PEKERJAAN_URUTAN"] + '</td><td>' + res_pekerjaan[i]["SUBCON_NAMA"] + '</td><td>LS</td><td>' + res_pekerjaan[i]["DETAIL_PEKERJAAN_VOLUME"] + '</td><td>' + res_pekerjaan[i]["SATUAN_SUBCON_NAMA"] + '</td><td align="right"><span class="currency">Rp</span><span class="number">' + (parseFloat(res_pekerjaan[i]["SUBCON_HARGA"])).formatMoney(2) + '</span></td><td align="right"><span class="currency">Rp</span><span class="number">' + (parseFloat(res_pekerjaan[i]["DETAIL_PEKERJAAN_TOTAL"])).formatMoney(2) + '</span></td></tr>';
                                                }

                                                jumlah_kategori += parseFloat(res_pekerjaan[i]["DETAIL_PEKERJAAN_TOTAL"]);
                                            }
                                            pekerjaan += '<tr class="item_rab_pekerjaan"><td colspan="6" align="right"><b>JUMLAH</b></td><td align="right"><span class="currency">Rp</span><span class="number">' + (jumlah_kategori).formatMoney(2) + '</span></td></tr>';
                                            jumlah_total += jumlah_kategori;
                                            pekerjaan += '<tr class="item_rab_pekerjaan" style="background-color: #167CAC"><td colspan="6" ><b style="color: #FFF">JUMLAH TOTAL</b></td><td align="right" style="color: #FFF"><span class="currency">Rp</span><span class="number">' + (jumlah_total).formatMoney(2) + '</span></td></tr>';
                                            $("#template_form_ubah_rab #detail_pekerjaan").html(pekerjaan);

                                            x.slideDown();
                                        }
                                    });
                                } else {
                                    $('#form_ubah_rab').slideUp('normal', function() {
                                        $('#row_ubah_rab').remove();
                                    });
                                    current_id_rab = -1;
                                }
                            }

                            function addRab() {
                                $("#rab_add").submit();
                            }
</script>

<style>
    table{

    }
    .centerTable th{
        text-align: center;
        background-color: #0993D3;
        color: #FFFFFF;
        height: 30px;
        font-size: 15px;
    }
    .currency{
        margin-right: 10px;
        display: inline-block;
    }
    .number{
        display: inline-block;  
        text-align: right;
    }
    .header_info{

    }
</style>

<form style="display: none" id="form_edit" action="<?php echo base_url(); ?>rab/rabs/edit" method="POST">
    <input type="hidden" value="" id="id_to_edit" name="id_to_edit" />
</form>

<!-- Page heading -->
<div class="page-head">
    <h2 class="pull-left"><i class="fa fa-building-o"></i> Detail Project</h2>
    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
        <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider -->
        <span class="divider">/</span> 
        <a href="<?= base_url() . 'projects/project' ?>" class="bread-current">Project</a>
        <span class="divider">/</span> 
        <a href="#" class="bread-current">Detail</a>
    </div>
    <div class="clearfix"></div>
</div>
<!-- Page heading ends -->

<div id="template_form_ubah_rab" style="display:none; margin-top: 20px; margin-bottom: 20px">
    <table class="table table-striped table-bordered centerTable">
        <thead>
            <tr class="label-info">
                <th>No</th>
                <th>Uraian Pekerjaan</th>
                <th>Kode</th>
                <th>Volume</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
                <th>Jumlah Harga</th>
            </tr>
        </thead>
        <tbody id="detail_pekerjaan">

        </tbody>
    </table>
    <div class="clearfix">
        <br />
    </div>
</div>

<div id="template_form_ubah_rap" style="display:none; margin-top: 20px; margin-bottom: 20px">
    <table class="table table-striped table-bordered table-hover centerTable">
        <thead>
            <tr class="label-info">
                <th>Nama</th>
                <th>Kode</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Volume</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="detail_rap">

        </tbody>
    </table>
    <div class="clearfix">
        <br />
    </div>
</div>


<div class="matter">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <!-- edit here -->
                <div class="widget">
                    <div class="widget-head">
                        <div class="pull-left">Detail Project</div>
                        <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                        </div>  
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-content">
                        <div class="padd">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul id="myTab" class="nav nav-tabs">
                                        <li class="active"><a href="#dataProject" data-toggle="tab">Data Project</a></li>
                                        <li><a href="#rab" data-toggle="tab">RAB</a></li>
                                        <li><a href="#rap" data-toggle="tab">RAP</a></li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane fade in active" id="dataProject">
                                            <table class="table table-striped table-bordered table-hover centerTable">
                                                <tbody>
                                                    <tr>
                                                        <td width="200"><b>Kode Proyek</b></td>
                                                        <td><?= $detailProject[0]['PROJECT_KODE'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="200"><b>Nama Proyek</b></td>
                                                        <td><?= $detailProject[0]['PROJECT_NAMA'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Deskripsi</b></td>
                                                        <td><?= $detailProject[0]['PROJECT_DESCRIPTION'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Creator/PJ</b></td>
                                                        <td><?php
                                                            for ($x = 0; $x < sizeof($detailProject); $x++) {
                                                                if ($detailProject[$x]['PENUGASAN_ID'] == 1) {
                                                                    echo $detailProject[$x]['PENGGUNA_NAMA'] . '<br/>';
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #167CAC" colspan="2"><h5><b style="color: #FFF;">PERENCANAAN</b></h5></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Estimator</b></td>
                                                        <td><?php
                                                            for ($x = 0; $x < sizeof($detailProject); $x++) {
                                                                if ($detailProject[$x]['PENUGASAN_ID'] == 2) {
                                                                    echo $detailProject[$x]['PENGGUNA_NAMA'] . '<br/>';
                                                                    $estimator = $detailProject[$x]['PENGGUNA_ID'];
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>PM</b></td>
                                                        <td><?php
                                                            for ($x = 0; $x < sizeof($detailProject); $x++) {
                                                                if ($detailProject[$x]['PENUGASAN_ID'] == 3) {
                                                                    echo $detailProject[$x]['PENGGUNA_NAMA'] . '<br/>';
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #167CAC" colspan="2"><h5><b style="color: #FFF;">PELAKSANAAN</b></h5></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>PP</b></td>
                                                        <td><?php
                                                            for ($x = 0; $x < sizeof($detailProject); $x++) {
                                                                if ($detailProject[$x]['PENUGASAN_ID'] == 4) {
                                                                    echo $detailProject[$x]['PENGGUNA_NAMA'] . '<br/>';
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>PO</b></td>
                                                        <td><?php
                                                            for ($x = 0; $x < sizeof($detailProject); $x++) {
                                                                if ($detailProject[$x]['PENUGASAN_ID'] == 5) {
                                                                    echo $detailProject[$x]['PENGGUNA_NAMA'] . '<br/>';
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade" id="rab">
                                            <div class="padd">
                                                <button type="button" class="btn btn-sm btn-primary" onclick="addRab();"><i class="fa fa-plus fa-fw"></i> Tambahkan RAB</button>

                                                <form method="POST" action="<?php echo base_url(); ?>rab/rabs/add" id="rab_add">
                                                    <input type="hidden" value="<?= $detailProject[0]['PROJECT_ID'] ?>" name="project_id" id="project_id" />
                                                    <input type="hidden" value="<?= $estimator ?>" name="estimator_id" id="estimator_id" />
                                                </form>

                                                <div class="clearfix">
                                                    <br />
                                                </div>
                                                <div class="page-tables">
                                                    <!-- Table -->
                                                    <div class="table-responsive">
                                                        <table id="tabelRAB" class="display" cellspacing="0" width="100%" style="margin-bottom: 10px">
                                                            <thead>
                                                                <tr>
                                                                    <th>Kode</th>
                                                                    <th>Nama</th>
                                                                    <th>Harga</th>
                                                                    <th>Lokasi</th>
                                                                    <th>Status</th>
                                                                    <th width="300">Detail</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                        <div class="clearfix">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="rap">
                                            <div class="padd">
                                                <div class="page-tables">
                                                    <!-- Table -->
                                                    <div class="table-responsive">
                                                        <table id="tabelRAP" class="display" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>Kode</th>
                                                                    <th>Nama</th>
                                                                    <th>Harga</th>
                                                                    <th>Lokasi</th>
                                                                    <th>Status</th>
                                                                    <th>Detail RAP</th>
                                                                </tr>
                                                            </thead>

                                                            <tfoot>
                                                                <tr>
                                                                    <th>Kode</th>
                                                                    <th>Nama</th>
                                                                    <th>Harga</th>
                                                                    <th>Lokasi</th>
                                                                    <th>Status</th>
                                                                    <th>Detail RAP</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        <div class="clearfix">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/><br/>
            </div>
        </div>
    </div>
</div>
