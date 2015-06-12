<script>
    var current_id = -1;
    var showHideKet = 0;

    function fillUpdate(id) {
        if (current_id != id) {
            current_id = id;
            $("#row_ubah").remove();
            $("<tr id='row_ubah'><td colspan='7'><div style='margin-top:10px' id='form_ubah'></div></td></tr>").insertAfter("#item_" + current_id);
            var x = $("#template_form_ubah").clone();
            x.appendTo("#form_ubah");
            $("#form_ubah #GUDANG_ID").val(id);
            $("#form_ubah #GUDANG_KODE").val($("#GUDANG_KODE_" + id).text());
            $("#form_ubah #GUDANG_NAMA").val($("#GUDANG_NAMA_" + id).text());
            $("#form_ubah #GUDANG_LOKASI").val($("#GUDANG_LOKASI_" + id).text());
            $("#form_ubah #GUDANG_ACTIVE").val($("#GUDANG_ACTIVE_" + id).val());
//            $('#form_ubah #GUDANG_ACTIVE option[value="1"]').attr("selected",true);
            x.slideDown();
        }
    }

    function confirmDelete(id) {
        $("#tobe_deleted_id").val(id);
        $("#deleteModal").modal();
    }

    function deleteBarang() {
        $("#deleteModal").modal("hide");
        $("#form_delete").submit();
    }
</script>

<div class="col-md-12">
    <div class="widget wgreen">
        <div class="widget-head">
            <div class="pull-left">
                Master Gudang
            </div>
            <div class="widget-icons pull-right">
                <a href="#" class="wminimize">
                    <i class="fa fa-chevron-up">
                    </i>
                </a>
                <a href="#" class="wclose">
                    <i class="fa fa-times">
                    </i>
                </a>
            </div>
            <div class="clearfix">
            </div>
        </div>
        <div class="widget-content">
            <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Konfirmasi penghapusan item gudang</h4>
                        </div>
                        <div class="modal-body">
                            <h3>Anda yakin untuk menghapus item ini?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="deleteBarang();">Ya</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="<?php echo base_url(); ?>master/gudang/delete" id="form_delete">
                <input type="hidden" value="" name="tobe_deleted_id" id="tobe_deleted_id" />
            </form>

            <div id="template_form_ubah" style="display:none;padding-top: 20px" class="alert-info col-lg-12">
                <form method="POST" action="<?php echo base_url(); ?>master/gudang/update">
                    <input type="hidden" class="form-control" id="GUDANG_ID" name="GUDANG_ID" />
                    <div class="col-lg-4">
                        <div class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Kode</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="GUDANG_KODE" name="GUDANG_KODE" placeholder="kode gudang">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nama</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="GUDANG_NAMA" name="GUDANG_NAMA" placeholder="nama gudang">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Lokasi</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" id="GUDANG_LOKASI" name="GUDANG_LOKASI" placeholder="Lokasi"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label"></label>
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save fa-fw"></i> Simpan</button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="$('#form_ubah').slideUp('normal', function() {
                                            $('#row_ubah').remove();
                                        });
                                        current_id = -1;"><i class="fa fa-ban fa-fw"></i> Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="padd">
                <button type="button" class="btn btn-sm btn-primary" onclick="$('#form_tambah').slideToggle();"><i class="fa fa-plus fa-fw"></i> Tambahkan gudang</button>
                <div class="clearfix">
                </div>
                <form method="POST" action="<?php echo base_url(); ?>master/gudang/insert">
                    <div id="form_tambah" style="display:none">
                        <div class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Kode gudang</label>
                                <div class="col-lg-5">
                                    <input type="text" class="form-control" id="GUDANG_KODE" name="GUDANG_KODE" placeholder="kode gudang">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nama gudang</label>
                                <div class="col-lg-5">
                                    <input type="text" class="form-control" id="GUDANG_NAMA" name="GUDANG_NAMA" placeholder="nama gudang">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Lokasi</label>
                                <div class="col-lg-5">
                                    <textarea class="form-control" id="GUDANG_LOKASI" name="GUDANG_LOKASI" placeholder="Lokasi"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-6">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save fa-fw"></i> Simpan</button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="$('#form_tambah').slideToggle();"><i class="fa fa-ban fa-fw"></i> Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="page-tables">
                    <!-- Table -->
                    <div class="table-responsive" align="right">
                        <div class="clearfix">
                            <br />
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    foreach ($listGudang as $item) {
                                        $id_bar = $item['GUDANG_ID'];
                                        ?>
                                    <tr id="item_<?php echo $id_bar; ?>">
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-xs dropdown-toggle btn-info" data-toggle="dropdown">Aksi <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:fillUpdate(<?php echo $id_bar; ?>)"><i class="fa fa-refresh fa-fw"></i> Ubah</a></li>
                                                    <li><a href="javascript:confirmDelete(<?php echo $id_bar; ?>)"><i class="fa fa-trash-o fa-fw"></i> Hapus</a></li>
                                                </ul>
                                            </div></td>
                                        <td id="GUDANG_KODE_<?php echo $id_bar; ?>"><?php echo $item['GUDANG_KODE']; ?></td>
                                        <td id="GUDANG_NAMA_<?php echo $id_bar; ?>"><?php echo $item['GUDANG_NAMA']; ?></td>
                                        <td id="GUDANG_LOKASI_<?php echo $id_bar; ?>"><?php echo $item['GUDANG_LOKASI']; ?></td>
                                        <td>
                                            <input type="hidden" id="GUDANG_ACTIVE_<?php echo $id_bar; ?>" value="<?= $item['GUDANG_ACTIVE'] ?>"/>
                                            <?php 
                                            if($item['GUDANG_ACTIVE']==1) 
                                                echo '<a class="success"><span class="fa fa-check"></span> Aktif</a>'; 
                                            else echo '<a class="danger"><span class="fa fa-times"></span> Tidak Aktif</a>'; ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-foot">
            <!-- Footer goes here -->
        </div>
    </div>
</div>