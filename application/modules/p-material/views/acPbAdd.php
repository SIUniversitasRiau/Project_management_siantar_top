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
        <a href="#" class="bread-current">Tambah</a>
    </div>
    <div class="clearfix"></div>
</div>
<!-- Page heading ends -->

<div class="col-md-12">
    <div class="widget wgreen">
        <div class="widget-head">
            <div class="pull-left">Tambah PB Baru</div>
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
                    <form id="formPB" action="<?= base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/newPB' ?>" method="post" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">No LPB</label>
                            <div class="col-lg-5">
                                <input name="PENERIMAAN_BARANG_KODE" id="PENERIMAAN_BARANG_KODE" class="form-control" placeholder="Nomor LPB"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama LPB</label>
                            <div class="col-lg-5">
                                <input name="PENERIMAAN_BARANG_NAMA" id="PENERIMAAN_BARANG_NAMA" class="form-control" placeholder="Nama LPB"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Surat Jalan</label>
                            <div class="col-lg-5">
                                <input name="LPB_SURAT_JALAN" id="LPB_SURAT_JALAN" class="form-control" placeholder="Nomor Surat Jalan"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Kendaraan</label>
                            <div class="col-lg-5">
                                <input name="LPB_KENDARAAN" id="LPB_KENDARAAN" class="form-control" placeholder="Nomor Kendaraan"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Kode PO</label>
                            <div class="col-lg-5">
                                <select name="PURCHASE_ORDER_ID" id="PURCHASE_ORDER_ID" class="form-control" onchange="getListPO()">
                                    <?php for ($j = 0; $j < sizeof($listPo); $j++): ?>
                                        <option value="<?= $listPo[$j]['PURCHASE_ORDER_ID'] ?>"><?= $listPo[$j]['KODE_PO'] ?></option>
                                    <?php endfor; ?>    
                                </select>
                            </div>
                        </div>
                        <div class="detailPO alert alert-info">
                            
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
    $(".addBtn").hide();
    $(".saveForm").hide();
    getListPO();

    function getListPO() {
        var PURCHASE_ORDER_ID = $("#PURCHASE_ORDER_ID").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/getCurrentPO'; ?>",
            data: {PURCHASE_ORDER_ID: PURCHASE_ORDER_ID},
            success: function(data) {
//                alert(data);
                var val = JSON.parse(data);
                if (val.length > 0) {
                    $(".detailPO").html(
                            '<div class="form-group">'+
                                '<label class="col-lg-2 control-label">Kode PO</label>'+
                                '<div class="col-lg-5">'+
                                '<input type="text" value="'+val[0].KODE_PO +'" class="form-control" readonly="readonly" />'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label class="col-lg-2 control-label">Tanggal PO</label>'+
                                '<div class="col-lg-5">'+
                                '<input type="text" value="'+val[0].PURCHASE_ORDER_TANGGAL +'" class="form-control" readonly="readonly" />'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label class="col-lg-2 control-label">Nama Proyek</label>'+
                                '<div class="col-lg-5">'+
                                '<input type="text" value="'+val[0].PROJECT_NAMA +'" class="form-control" readonly="readonly" />'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label class="col-lg-2 control-label">Kode PP</label>'+
                                '<div class="col-lg-5">'+
                                '<input type="text" value="'+val[0].PERMINTAAN_PEMBELIAN_KODE +'" class="form-control" readonly="readonly" />'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label class="col-lg-2 control-label">Supplier</label>'+
                                '<div class="col-lg-5">'+
                                '<input type="text" value="'+val[0].SUPPLIER_NAMA +'" class="form-control" readonly="readonly" />'+
                                '<input type="hidden" value="'+val[0].SUPPLIER_ID +'" name="SUPPLIER_ID" readonly="readonly" />'+
                                '</div>'+
                            '</div>'
                    )
                }
                else {
                    alert("PO tidak ada data");
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
        $("#PENERIMAAN_BARANG_NAMA").attr("readonly", "true");
        $("#PENERIMAAN_BARANG_KODE").attr("readonly", "true");
        $("#PURCHASE_ORDER_ID").attr("readonly", "true");
        $("#LPB_SURAT_JALAN").attr("readonly", "true");
        $("#LPB_KENDARAAN").attr("readonly", "true");
        $(".TANGGAL_DATANG").attr("readonly", "true");
        $("select").attr("readonly", "true");
        $(".nextBtn").hide();
        var PURCHASE_ORDER_ID = $("#PURCHASE_ORDER_ID").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/getCurrentPO'; ?>",
            data: {PURCHASE_ORDER_ID: PURCHASE_ORDER_ID},
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
                                "<td>" + val[i].HARGA_MATERI_PO + "</td>" +
                                "<td><button class='btn btn-xs btn-success' onclick='addRap(\"" + val[i].BARANG_ID + "\",\"" + val[i].BARANG_KODE + "\",\"" + val[i].BARANG_NAMA + "\",\"" + val[i].HARGA_MATERI_PO + "\",\"" + val[i].SATUAN_NAMA + "\",\"" + val[i].VOLUME_PO + "\")'><i class='fa fa-plus fa-fw'></i> Pilih</button></td>" +
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

    function addRap(BARANG_ID, BARANG_KODE, BARANG_NAMA, BARANG_HARGA, SATUAN_NAMA, VOLUME_PO) {
        if (flag[BARANG_ID] == 0) {
            $(".barangBaru").append(
                    '<input type="hidden" id="' + BARANG_ID + '_inpBarang" name=BARANG_ID[] value="' + BARANG_ID + '" />' +
                    '<input type="hidden" id="' + BARANG_ID + '_inpVolume" name=VOLUME[] value="0" />'
                    );
            $("#" + BARANG_ID + "_inpVolume").val(Number(VOLUME_PO));
            $(".listBahan").append(
                    "<tr class='" + BARANG_ID + "'>" +
                    "<td>" + BARANG_KODE + "</td>" +
                    "<td>" + BARANG_NAMA + "</td>" +
                    "<td class='" + BARANG_ID + "_jml'>" + VOLUME_PO + "</td>" +
                    "<td>" + SATUAN_NAMA + "</td>" +
                    "<td>" + BARANG_HARGA + "</td>" +
                    "<td class='" + BARANG_ID + "_sub'>"+Number(VOLUME_PO)*Number(BARANG_HARGA)+"</td>" +
                    "<td>"+
                    "<button class='btn btn-xs btn-success' onclick='editBarang(\"" + BARANG_ID + "\",\"" + BARANG_NAMA + "\",\"" + SATUAN_NAMA + "\",\"" + BARANG_HARGA + "\",\""+VOLUME_PO+"\")'><i class='fa fa-plus fa-fw'></i> Edit</button>" +
                    "<button class='btn btn-xs btn-danger' onclick='dialogHapus(\"" + BARANG_ID + "\",\"" + BARANG_NAMA + "\",\"" + SATUAN_NAMA + "\")'><i class='fa fa-minus fa-fw'></i> Hapus</button>"+
                    "</td>"+
                    "</tr>"
                    );
            flag[BARANG_ID] = 1;
        }
    }

    function editBarang(BARANG_ID, BARANG_NAMA, SATUAN_NAMA, BARANG_HARGA, BARANG_VOLUME) {
        $('#VOLUME').attr('min', 0);
        $('#VOLUME').attr('max', BARANG_VOLUME);
        var VOLUME = $("." + BARANG_ID + "_jml").text();
        $('#BARANG_ID').val(BARANG_ID);
        $('#BARANG_NAMA').val(BARANG_NAMA);
        $('#VOLUME').val(Number(VOLUME));
        $('#SATUAN_NAMA').val(SATUAN_NAMA);
        $('#BARANG_HARGA').val(BARANG_HARGA);
        var SUBTOTAL = $("." + BARANG_ID + "_sub").text();
        $('#SUBTOTAL').val(SUBTOTAL);
        $('#modalEdit').modal('show');
    }

    function saveBarang(BARANG_ID, VOLUME, SUBTOTAL) {
        var vol= parseInt(VOLUME);
        var sub= parseInt(SUBTOTAL);
        $("." + BARANG_ID + "_jml").html(vol);
        $("." + BARANG_ID + "_sub").html(sub);
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

    function save(param) {
        $('#flag_save').val(param);
        $('#formPB').submit();
    }
    
    function dialogHapus(BARANG_ID, BARANG_NAMA, SATUAN_NAMA){
        $(".namaBarangHapus").text("Anda yakin untuk menghapus "+BARANG_NAMA+" "+SATUAN_NAMA+" ini?")
        $('#tobe_deleted_id').val(BARANG_ID);
        $("#deleteModal").modal();
    }
    
    function deleteBarang(BARANG_ID){
        $("#" + BARANG_ID + "_inpBarang").remove();
        $("#" + BARANG_ID + "_inpVolume").remove();
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