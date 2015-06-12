<script type="text/javascript">
    function fillEditForm(id) {
        var name = document.getElementById('role_name_' + id).innerHTML;
        document.getElementById('role_name').value = name;
        document.getElementById('role_id').value = id;
    }

    function showDeleteModal(id) {
        var name = document.getElementById('role_name_' + id).innerHTML;
        document.getElementById('delete_form_id').value = id;
        $("#delete_form_name").text(name);
        $("#deleteModal").modal();
    }

    function confirmDelete() {
        $("#deleteModal").modal("hide");
        $("#delete_form").submit();
    }

</script>

<div class="col-md-12">
    <div class="widget wgreen">
        <div class="widget-head">
            <div class="pull-left">Role Management</div>
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
            <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Konfirmasi penghapusan hak akses</h4>
                        </div>
                        <div class="modal-body">
                            <h3>Anda yakin untuk menghapus hak akses <span id="delete_form_name"></span>?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="confirmDelete();">Ya</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <form class="form-horizontal" role="form" action="<?= base_url() ?>user-management/role/save" method="post">
                    <div class="form-group">
                        <input type="hidden" id="role_id" name="<?= mRole::ID ?>" value="0" />
                        <label class="col-lg-2 control-label">Hak Akses</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="role_name" name="<?= mRole::NAME ?>" placeholder="Hak Akses" />
                        </div>
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save fa-fw"></i>Simpan</button>
                    </div>
                </form> 
            </div>
            <form action="<?= base_url() ?>user-management/role/delete" method="post" id="delete_form">
                <input type="hidden" id="delete_form_id" name="<?= mRole::ID ?>" value="0" />
            </form>

            <div class="page-tables">
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 150px; text-align: center">&nbsp;</th>
                                <th style="width: 50px; text-align: center">#</th>
                                <th>Hak Akses</th>
                                <th>Detail</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            //print_r($departemenList);
                            foreach ($roleList as $role) {
                                ?>
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-default dropdown-toggle btn-info" data-toggle="dropdown">Pilihan<span class="caret"></span></button>   
                                            <ul class="dropdown-menu">
                                                <li><button class="btn btn-sm btn-info" style="width: 100%" onclick="fillEditForm(<?= $role[mRole::ID] ?>)"><i class="fa fa-refresh fa-fw"></i>Ubah</button></li>
                                                <li><button class="btn btn-sm btn-danger" style="width: 100%" onclick="showDeleteModal(<?= $role[mRole::ID] ?>)"><i class="fa fa-trash-o fa-fw"></i>Hapus</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td style="text-align: center" id="role_id_<?= $role[mRole::ID] ?>"><?= $role[mRole::ID] ?></td>
                                    <td id="role_name_<?= $role[mRole::ID] ?>"><?= $role[mRole::NAME] ?></td>
                                    <td>
                                        <div>
                                            <form action="<?= base_url() ?>user-management/role/manage" method="post">
                                                <input type="hidden" name="<?= mRole::ID?>" value="<?= $role[mRole::ID]?>" />
                                                <button class="btn btn-success" type="submit"><i class="fa fa-search"></i> Detail</button>
                                            </form>
                                        </div>
                                    </td>
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
                                <th>Hak Akses</th>
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
</div>



