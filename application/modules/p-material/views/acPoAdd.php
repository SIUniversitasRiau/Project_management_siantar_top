<!-- Page heading -->
<div class="page-head">
    <h2 class="pull-left"><i class="fa fa-building-o"></i> Purchase Order</h2>
    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
        <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider -->
        <span class="divider">/</span> 
        <a href="<?= base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/index' ?>" class="bread-current">PO</a>
        <span class="divider">/</span> 
        <a href="#" class="bread-current">Tambah</a>
    </div>
    <div class="clearfix"></div>
</div>
<!-- Page heading ends -->

<div class="col-md-12">
    <div class="widget wgreen">
        <div class="widget-head">
            <div class="pull-left">Tambah PO Baru</div>
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
                    <form id="formPO" action="<?= base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/newPO' ?>" method="post" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama PO</label>
                            <div class="col-lg-5">
                                <input name="PURCHASE_ORDER_NAMA" id="PURCHASE_ORDER_NAMA" class="form-control" placeholder="Purchase Order Nama"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Kode PO</label>
                            <div class="col-lg-5">
                                <input name="PURCHASE_ORDER_KODE" id="PURCHASE_ORDER_KODE" class="form-control" placeholder="Purchase Order Kode"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Proyek</label>
                            <div class="col-lg-5">
                                <select name="PROJECT_ID" id="selectDynamic1" class="form-control" onchange="getListPP()">
                                    <?php for ($j = 0; $j < sizeof($listProject); $j++): ?>
                                        <option value="<?= $listProject[$j]['PROJECT_ID'] ?>"><?= $listProject[$j]['PROJECT_NAMA'] ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div id="PERMINTAAN_PEMBELIAN_ID_" class="form-group">
                            <label class="col-lg-2 control-label">Kode PP</label>
                            <div class="col-lg-5">
                                <select name="PERMINTAAN_PEMBELIAN_ID" id="PERMINTAAN_PEMBELIAN_ID" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Supplier</label>
                            <div class="col-lg-5">
                                <select name="SUPPLIER_ID" id="SUPPLIER_ID" class="form-control">
                                    <?php for ($j = 0; $j < sizeof($listPengguna); $j++): ?>
                                        <option value="<?= $listPengguna[$j]['SUPPLIER_ID'] ?>"><?= $listPengguna[$j]['SUPPLIER_NAMA'] ?></option>
                                    <?php endfor; ?>    
                                </select>
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal Datang</label>
                            <div class="col-lg-5">
                                <div id="datetimepicker1" class="input-append input-group dtpicker">
                                    <input data-format="dd-MM-yyyy" type="text" class="form-control TANGGAL_DATANG" name="TANGGAL_DATANG">
                                    <span class="input-group-addon add-on">
                                        <i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>-->
                        <div class="barangBaru"></div>
                        <div class="form-group next">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-10">
                                <input id="flag_save" type="hidden" name="flag" value="0" />
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="listBahan">
                        </tbody>
                    </table>
                    <div class="clearfix">
                    </div>
                </div>
                <br/>
                <div class="row">
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
    $(".saveForm").hide();
    getListPP();

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
        $("#PURCHASE_ORDER_KODE").attr("readonly", "true");
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
                    '<input type="hidden" id="' + BARANG_ID + '_inpVolume" name=VOLUME[] value="0" />' +
                    '<input type="hidden" id="' + BARANG_ID + '_inpHarga" name=HARGA_MATERI_PO[] value="' + BARANG_HARGA + '" />'
                    );
            $("#" + BARANG_ID + "_inpVolume").val(Number(VOLUME_PP));
            $(".listBahan").append(
                    "<tr class='" + BARANG_ID + "'>" +
                    "<td>" + BARANG_KODE + "</td>" +
                    "<td>" + BARANG_NAMA + "</td>" +
                    "<td class='" + BARANG_ID + "_jml'>" + VOLUME_PP + "</td>" +
                    "<td>" + SATUAN_NAMA + "</td>" +
                    "<td class='" + BARANG_ID + "_price'>" + BARANG_HARGA + "</td>" +
                    "<td class='" + BARANG_ID + "_sub'>"+Number(VOLUME_PP)*Number(BARANG_HARGA)+"</td>" +
                    "<td>"+
                    "<button class='btn btn-xs btn-success' onclick='editBarang(\"" + BARANG_ID + "\",\"" + BARANG_NAMA + "\",\"" + SATUAN_NAMA + "\",\"" + BARANG_HARGA + "\",\""+VOLUME_PP+"\")'><i class='fa fa-plus fa-fw'></i> Edit</button>" +
                    "<button class='btn btn-xs btn-danger' onclick='dialogHapus(\"" + BARANG_ID + "\",\"" + BARANG_NAMA + "\",\"" + SATUAN_NAMA + "\")'><i class='fa fa-minus fa-fw'></i> Hapus</button>"+
                    "</td>"+
                    "</tr>"
                    );
            flag[BARANG_ID] = 1;
        }
    }

    function editBarang(BARANG_ID, BARANG_NAMA, SATUAN_NAMA, BARANG_HARGA, BARANG_VOLUME) {
        var VOLUME = $("." + BARANG_ID + "_jml").text();
        var HARGA = $("." + BARANG_ID + "_price").text();
        $('#VOLUME').attr('min', 0);
        $('#VOLUME').attr('max', BARANG_VOLUME);
        $('#BARANG_ID').val(BARANG_ID);
        $('#BARANG_NAMA').val(BARANG_NAMA);
        $('#VOLUME').val(Number(VOLUME));
        $('#SATUAN_NAMA').val(SATUAN_NAMA);
        $('#BARANG_HARGA').val(HARGA);
        var SUBTOTAL = $("." + BARANG_ID + "_sub").text();
        $('#SUBTOTAL').val(SUBTOTAL);
        $('#modalEdit').modal('show');
    }

    function saveBarang(BARANG_ID, BARANG_HARGA, VOLUME, SUBTOTAL) {
        var vol= parseInt(VOLUME);
        var harga= parseInt(BARANG_HARGA);
        var sub= parseInt(SUBTOTAL);
        $("." + BARANG_ID + "_price").html(harga);
        $("." + BARANG_ID + "_jml").html(vol);
        $("." + BARANG_ID + "_sub").html(sub);
        $("#" + BARANG_ID + "_inpHarga").val(harga);
        $("#" + BARANG_ID + "_inpVolume").val(vol);
    }

    function calculate(BARANG_HARGA, VOLUME) {
        var max= $('#VOLUME').attr('max');
        var vol= parseInt(VOLUME);
        var harga= parseInt(BARANG_HARGA);
        if(max<vol){
            $('#VOLUME').val(0);
            $('#SUBTOTAL').val(0);
        }
        else if(max>=VOLUME) {
            $('#SUBTOTAL').val(harga * vol);
        }
    }
    
    function changePrice(BARANG_ID, BARANG_HARGA, VOLUME){
        var vol= parseInt(VOLUME);
        var harga= parseInt(BARANG_HARGA);
        $('#SUBTOTAL').val(harga * vol);
    }

    function save(param) {
        $('#flag_save').val(param);
        $('#formPO').submit();
    }
    
    function dialogHapus(BARANG_ID, BARANG_NAMA, SATUAN_NAMA){
        $(".namaBarangHapus").text("Anda yakin untuk menghapus "+BARANG_NAMA+" "+SATUAN_NAMA+" ini?")
        $('#tobe_deleted_id').val(BARANG_ID);
        $("#deleteModal").modal();
    }
    
    function deleteBarang(BARANG_ID){
        $("#" + BARANG_ID + "_inpBarang").remove();
        $("#" + BARANG_ID + "_inpVolume").remove();
        $("#" + BARANG_ID + "_inpHarga").remove();
        $(".listBahan ." + BARANG_ID).remove();
        flag[BARANG_ID] = 0;
        $("#deleteModal").modal("hide");
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
                            <input type="text" id="BARANG_HARGA" class="form-control" name="BARANG_HARGA" onkeyup="changePrice($('#BARANG_ID').val(), $('#BARANG_HARGA').val(), $('#VOLUME').val())">
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
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveBarang($('#BARANG_ID').val(), $('#BARANG_HARGA').val(), $('#VOLUME').val(), $('#SUBTOTAL').val())">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Konfirmasi penghapusan barang</h4>
            </div>
            <div class="modal-body">
                <h3 class="namaBarangHapus">Anda yakin untuk menghapus item ini?</h3>
                <input type="hidden" value="" name="tobe_deleted_id" id="tobe_deleted_id" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="deleteBarang($('#tobe_deleted_id').val());">Ya</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Tidak</button>
            </div>
        </div>
    </div>
</div>