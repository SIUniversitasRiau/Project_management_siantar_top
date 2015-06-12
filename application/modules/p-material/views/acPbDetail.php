<!-- Page heading -->
<div class="page-head">
    <h2 class="pull-left"><i class="fa fa-building-o"></i> Penerimaan Barang</h2>
    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
        <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider -->
        <span class="divider">/</span> 
        <a href="<?= base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/index' ?>" class="bread-current">PB</a>
        <span class="divider">/</span> 
        <a href="#" class="bread-current">Detail</a>
    </div>
    <div class="clearfix"></div>
</div>
<!-- Page heading ends -->

<div class="col-md-12">
    <div class="widget wgreen">
        <div class="widget-head">
            <div class="pull-left">Detail PO</div>
            <div class="widget-icons pull-right">
                <a href="#" class="wminimize">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a href="#" class="wclose">
                    <i class="fa fa-times"></i>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="widget-content" style="padding: 10px">
            <div class="page-tables">
                <div class="table-responsive">
                    <form id="formPB" action="<?= base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/newPO' ?>" method="post" class="form-horizontal" role="form">
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">No LPB</label>
                            <div class="col-lg-5">
                                <input name="PENERIMAAN_BARANG_KODE" id="PENERIMAAN_BARANG_KODE" class="form-control" value="<?= $listPb[0]['PENERIMAAN_BARANG_KODE'] ?>" placeholder="Nomor LPB" readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama LPB</label>
                            <div class="col-lg-5">
                                <input name="PENERIMAAN_BARANG_NAMA" id="PENERIMAAN_BARANG_NAMA" class="form-control" value="<?= $listPb[0]['PENERIMAAN_BARANG_NAMA'] ?>" placeholder="Nama LPB" readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Surat Jalan</label>
                            <div class="col-lg-5">
                                <input name="LPB_SURAT_JALAN" id="LPB_SURAT_JALAN" class="form-control" value="<?= $listPb[0]['LPB_SURAT_JALAN'] ?>" placeholder="Nomor Surat Jalan" readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Kendaraan</label>
                            <div class="col-lg-5">
                                <input name="LPB_KENDARAAN" id="LPB_KENDARAAN" class="form-control" value="<?= $listPb[0]['LPB_KENDARAAN'] ?>" placeholder="Nomor Kendaraan" readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Kode PO</label>
                            <div class="col-lg-5">
                                <input name="PURCHASE_ORDER_ID" id="PURCHASE_ORDER_ID" class="form-control" value="<?= $listPb[0]['KODE_PO'] ?>" placeholder="Nomor PO" readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal PO</label>
                            <div class="col-lg-5">
                                <input name="PURCHASE_ORDER_TANGGAL" id="PURCHASE_ORDER_TANGGAL" class="form-control" value="<?= $listPb[0]['PURCHASE_ORDER_TANGGAL'] ?>" placeholder="Tanggal PO" readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Proyek</label>
                            <div class="col-lg-5">
                                <input name="PROJECT_NAMA" id="PROJECT_NAMA" class="form-control" value="<?= $listPb[0]['PROJECT_NAMA'] ?>" placeholder="Nama Proyek" readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Kode PP</label>
                            <div class="col-lg-5">
                                <input name="PERMINTAAN_PEMBELIAN_KODE" id="PERMINTAAN_PEMBELIAN_KODE" class="form-control" value="<?= $listPb[0]['PERMINTAAN_PEMBELIAN_KODE'] ?>" placeholder="Nomor PP" readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Supplier</label>
                            <div class="col-lg-5">
                                <input name="SUPPLIER_NAMA" id="SUPPLIER_NAMA" class="form-control" value="<?= $listPb[0]['SUPPLIER_NAMA'] ?>" placeholder="Supplier" readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group next">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-10">
                                <button type="button" class="btn btn-sm btn-primary nextBtn" onclick="next()"><i class="fa fa-plus fa-fw"></i> Next</button>
                                <button type="button" class="pull-right btn btn-sm btn-primary addBtn" onclick="modalAddRap()"><i class="fa fa-plus fa-fw"></i> Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-tables">
                <div class="table-responsive">
                    <div class="clearfix">
                        <br />
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="listBahan">
                            <?php for ($i = 0; $i < sizeof($listPb); $i++): ?>
                                <tr>
                                    <td><?php echo $listPb[$i]['BARANG_KODE'] ?></td>
                                    <td><?php echo $listPb[$i]['BARANG_NAMA'] ?></td>
                                    <td><?php echo $listPb[$i]['VOLUME_PO'] ?></td>
                                    <td><?php echo $listPb[$i]['SATUAN_NAMA'] ?></td>
                                    <td><?php echo $listPb[$i]['HARGA_MATERI_PO'] ?></td>
                                    <td><?php echo $listPb[$i]['HARGA_MATERI_PO'] * $listPb[$i]['VOLUME_PO'] ?></td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <div class="clearfix">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <input id="flag_save" type="hidden" name="flag" value="0" />
                    <div class="col-lg-6"> 
                        <button type="button" class="pull-right btn btn-sm btn-primary saveForm" onclick="save('0')"> Simpan Sebagai Draft</button>
                    </div>
                    <div class="col-lg-6">
                        <button type="button" class="pull-left btn btn-sm btn-primary saveForm" onclick="save('1')"> Setujui</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $("#PERMINTAAN_PEMBELIAN_ID_").hide();
    $(".addBtn").hide();
    $(".nextBtn").hide();
    $(".saveForm").hide();
//    getListPP();

    function getListPP() {
        var PROJECT_ID = $("#selectDynamic1").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/getPpbyProject'; ?>",
            data: {PROJECT_ID: PROJECT_ID},
            success: function(data) {
//                alert(data);
                var val = JSON.parse(data);
                if (val.length > 0) {
                    $("#PERMINTAAN_PEMBELIAN_ID_").show();
                    $('#PERMINTAAN_PEMBELIAN_ID').html(
                            '<option value="' + val[0].PERMINTAAN_PEMBELIAN_ID + '" selected>' + val[0].PERMINTAAN_PEMBELIAN_KODE + '</option>'
                            );
                    for (var i = 1; i < val.length; i++) {
                        $('#PERMINTAAN_PEMBELIAN_ID').append(
                                '<option value="' + val[i].PERMINTAAN_PEMBELIAN_ID + '" >' + val[i].PERMINTAAN_PEMBELIAN_KODE + '</option>'
                                );
                    }
                }
                else {
                    alert("PP tidak ada");
                }
            }
//            ,error: function (xhr, ajaxOptions, thrownError) {
//              alert(xhr.status);
//              alert(thrownError);
//              alert(xhr.responseText);
//            }
        });
    }

    var flag = [];
    function next() {
        $("#PERMINTAAN_PEMBELIAN_ID").attr("readonly", "true");
        $("select").attr("readonly", "true");
        $("#PURCHASE_ORDER_NAMA").attr("readonly", "true");
        $(".TANGGAL_DATANG").attr("readonly", "true");
        $(".nextBtn").hide();
        var PROJECT_ID = $("#selectDynamic1").val();
        var PERMINTAAN_PEMBELIAN_ID = $("#PERMINTAAN_PEMBELIAN_ID").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/getCurrentPP'; ?>",
            data: {PROJECT_ID: PROJECT_ID, PERMINTAAN_PEMBELIAN_ID: PERMINTAAN_PEMBELIAN_ID},
            success: function(data) {
//                alert(data);
                $(".addBtn").show();
                $(".saveForm").show();
                var val = JSON.parse(data);
                if (val.length > 0) {
                    $(".bodyBahan").html("");
                    for (var i = 0; i < val.length; i++) {
                        flag[val[i].BARANG_ID] = 0;
                        $(".bodyBahan").append(
                                "<tr>" +
                                "<td>" + val[i].BARANG_NAMA + "</td>" +
                                "<td>" + val[i].KATEGORI_BARANG_NAMA + "</td>" +
                                "<td>" + val[i].BARANG_KODE + "</td>" +
                                "<td>" + val[i].SATUAN_NAMA + "</td>" +
                                "<td>" + val[i].BARANG_HARGA + "</td>" +
                                "<td><button class='btn btn-xs btn-success' onclick='addRap(\"" + val[i].BARANG_ID + "\",\"" + val[i].BARANG_KODE + "\",\"" + val[i].BARANG_NAMA + "\",\"" + val[i].BARANG_HARGA + "\",\"" + val[i].SATUAN_NAMA + "\",\"" + val[i].VOLUME_PP + "\")'><i class='fa fa-plus fa-fw'></i> Pilih</button></td>" +
                                "</tr>"
                                );
                    }
                }
            }
//            , error: function(xhr, ajaxOptions, thrownError) {
//                alert(xhr.status);
//                alert(thrownError);
//                alert(xhr.responseText);
//            }
        });
    }

    function modalAddRap() {
        $('#modalPilihan').modal('show');
    }

    function addRap(BARANG_ID, BARANG_KODE, BARANG_NAMA, BARANG_HARGA, SATUAN_NAMA, VOLUME_PP) {
        if (flag[BARANG_ID] == 0) {
            $(".barangBaru").append(
                    '<input type="hidden" id="' + BARANG_ID + '_inpBarang" name=BARANG_ID[] value="' + BARANG_ID + '" />' +
                    '<input type="hidden" id="' + BARANG_ID + '_inpVolume" name=VOLUME[] value="0" />'
                    );
            $("#" + BARANG_ID + "_inpVolume").val(Number(VOLUME_PP));
            $(".listBahan").append(
                    "<tr class='" + BARANG_ID + "'>" +
                    "<td>" + BARANG_KODE + "</td>" +
                    "<td>" + BARANG_NAMA + "</td>" +
                    "<td class='" + BARANG_ID + "_jml'>" + VOLUME_PP + "</td>" +
                    "<td>" + SATUAN_NAMA + "</td>" +
                    "<td>" + BARANG_HARGA + "</td>" +
                    "<td class='" + BARANG_ID + "_sub'>" + Number(VOLUME_PP) * Number(BARANG_HARGA) + "</td>" +
                    "<td><button class='btn btn-xs btn-success' onclick='editBarang(\"" + BARANG_ID + "\",\"" + BARANG_NAMA + "\",\"" + SATUAN_NAMA + "\",\"" + BARANG_HARGA + "\")'><i class='fa fa-plus fa-fw'></i> Edit</button></td>" +
                    "</tr>"
                    );
            flag[BARANG_ID] = 1;
        }
    }

    function editBarang(BARANG_ID, BARANG_NAMA, SATUAN_NAMA, BARANG_HARGA) {
        var VOLUME = $("." + BARANG_ID + "_jml").text();
        $('#BARANG_ID').val(BARANG_ID);
        $('#BARANG_NAMA').val(BARANG_NAMA);
        $('#VOLUME').val(Number(VOLUME));
        $('#SATUAN_NAMA').val(SATUAN_NAMA);
        $('#BARANG_HARGA').val(BARANG_HARGA);
        var SUBTOTAL = $("." + BARANG_ID + "_sub").text();
        $('#SUBTOTAL').val(SUBTOTAL);
        $('#modalEdit').modal('show');
//        alert(BARANG_ID + " " + BARANG_NAMA+" "+VOLUME);
    }

    function saveBarang(BARANG_ID, VOLUME, SUBTOTAL) {
        $("." + BARANG_ID + "_jml").html(VOLUME);
        $("." + BARANG_ID + "_sub").html(SUBTOTAL);
        $("#" + BARANG_ID + "_inpVolume").val(Number(VOLUME));
    }

    function calculate(BARANG_HARGA, VOLUME) {
        $('#SUBTOTAL').val(BARANG_HARGA * VOLUME);
    }

    function save(param) {
        $('#flag_save').val(param);
        $('#formPB').submit();
    }
</script>

<div id="modalPilihan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog page-tables" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><b>Daftar Bahan</b></h4>
            </div>
            <div class="modal-body">
                <div class="widget-content">
                    <div class="table-responsive">
                        <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Kode</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Pilih</th>
                                </tr>
                            </thead>
                            <tbody class="bodyBahan">
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>

<div id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog page-tables">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><b>Detail Barang</b></h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Nama Barang</label>
                        <div class="col-lg-5">
                            <input type="hidden" id="BARANG_ID" class="form-control" name="BARANG_ID">
                            <input type="text" id="BARANG_NAMA" class="form-control" name="BARANG_NAMA" readonly="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Satuan</label>
                        <div class="col-lg-5">
                            <input type="text" id="SATUAN_NAMA" class="form-control" name="SATUAN_NAMA" readonly="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Harga</label>
                        <div class="col-lg-5">
                            <input type="text" id="BARANG_HARGA" class="form-control" name="BARANG_HARGA" readonly="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Volume</label>
                        <div class="col-lg-5">
                            <input type="text" id="VOLUME" class="form-control" name="VOLUME" placeholder="Volume" onkeyup="calculate($('#BARANG_HARGA').val(), $('#VOLUME').val())">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Sub Total</label>
                        <div class="col-lg-5">
                            <input type="text" id="SUBTOTAL" class="form-control" name="SUBTOTAL" placeholder="Sub Total" readonly="true">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveBarang($('#BARANG_ID').val(), $('#VOLUME').val(), $('#SUBTOTAL').val())">Save changes</button>
            </div>
        </div>
    </div>
</div>