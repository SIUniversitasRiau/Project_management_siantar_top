<script type="text/javascript">
    function fillFormPosition(id) {
        var name = document.getElementById('pos_name_' + id).innerHTML;
        document.getElementById('pos_name').value = name;
        document.getElementById('pos_id').value = id;
    }

    function showDeletePositionModal(id) {
        var name = document.getElementById('pos_name_' + id).innerHTML;
        document.getElementById('delete_pos_form_id').value = id;
        $("#delete_pos_form_name").text(name);
        $("#deletePosModal").modal();
    }

    function confirmDeletePosition() {
        $("#deletePosModal").modal("hide");
        $("#delete_pos_form").submit();
    }

</script>

<div class="col-md-12">
    <div class="widget wgreen">
        <div class="widget-head">
            <div class="pull-left">Master Posisi</div>
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
            <div class="clearfix"></div>
        </div>
        <div class="widget-content" style="padding: 10px">
            <div id="deletePosModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Konfirmasi penghapusan posisi</h4>
                        </div>
                        <div class="modal-body">
                            <h3>Anda yakin untuk menghapus departemen <span id="delete_dept_form_name"></span>?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="confirmDeleteDepartment();">Ya</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <form class="form-horizontal" role="form" action="<?= base_url() ?>user-management/departemen/save" method="post">
                    <div class="form-group">
                        <input type="hidden" id="dept_id" name="<?= mDepartemen::ID ?>" value="0" />
                        <label class="col-lg-2 control-label">Departemen</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="dept_name" name="<?= mDepartemen::NAME ?>" placeholder="Nama Departemen" />
                        </div>
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save fa-fw"></i>Simpan</button>
                    </div>
                </form> 
            </div>
            <form action="<?= base_url() ?>user-management/departemen/delete" method="post" id="delete_dept_form">
                <input type="hidden" id="delete_dept_form_id" name="<?= mDepartemen::ID ?>" value="0" />
            </form>
            <div class="page-tables">
                <div class="table-responsive">
                    <table cellpadd ing="0" cellspacing="0" border="0" id="data-table" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 150px; text-align: center">&nbsp;</th>
                                <th style="width: 50px; text-align: center">#</th>
                                <th>Nama Departemen</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            //print_r($departemenList);
                            foreach ($departemenList as $item) {
                                ?>
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-default dropdown-toggle btn-info" data-toggle="dropdown">Pilihan<span class="caret"></span></button>   
                                            <ul class="dropdown-menu">
                                                <li><button class="btn btn-sm btn-info" style="width: 100%" onclick="fillFormDepartment(<?= $item[mDepartemen::ID] ?>)"><i class="fa fa-refresh fa-fw"></i>Ubah</button></li>
                                                <li><button class="btn btn-sm btn-danger" style="width: 100%" onclick="showDeleteDepartmentModal(<?= $item[mDepartemen::ID] ?>)"><i class="fa fa-trash-o fa-fw"></i>Hapus</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td style="text-align: center" id="dept_id_<?= $item[mDepartemen::ID] ?>"><?= $item[mDepartemen::ID] ?></td>
                                    <td id="dept_name_<?= $item[mDepartemen::ID] ?>"><?= $item[mDepartemen::NAME] ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>#</th>
                                <th>Departemen</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div style="width: 100%; height: 25px">&nbsp;</div>
    </div>
    <h1>Tes</h1>
</div>



