<div class="col-md-12">
    <div class="widget wgreen">
        <div class="widget-head">
            <div class="pull-left">Detail Pengguna</div>
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
            <div class="col-md-3">
                <h4>Nama Pengguna</h4>
            </div>
            <div class="col-md-3">
                <h4><?= $userDetail[mUser::NAME] ?></h4>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
                <h4>Username</h4>
            </div>
            <div class="col-md-3">
                <h4><?= $userDetail[mUser::USERNAME] ?></h4>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
                <h4>Email Pengguna</h4>
            </div>
            <div class="col-md-3">
                <h4><?= $userDetail[mUser::EMAIL] ?></h4>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
                <h4>Hak Akses</h4>
            </div>
            <div class="col-md-6">
                <?php
                foreach ($mappedRoles as $mr) {
                    ?>
                    <div>
                        <div class="col-md-5">
                            <?= $rolesDictionary[$mr[mUserRole::ROLE]] ?>
                        </div>
                        <div class="col-md-2">
                            <form action="<?= base_url() ?>user-management/role/deleteRole" method="post">
                                <input name="<?= mUserRole::USER ?>" value="<?= $userDetail[mUser::ID] ?>" type="hidden" />
                                <input name="<?= mUserRole::ROLE ?>" value="<?= $mr[mUserRole::ROLE] ?>" type="hidden" />
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Hapus</button>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                        <div style="width: 100%; height: 10px"></div>
                    </div>
                    <div class="clearfix"></div>
                <?php } ?>
                <div class="clearfix"></div>
                <div class="form-horizontal">

                    <form action="<?= base_url() ?>user-management/role/addRole" method="post">
                        <div class="col-md-3">
                            <input name="<?= mUserRole::USER ?>" value="<?= $userDetail[mUser::ID] ?>" type="hidden" />
                            <select name="<?= mUserRole::ROLE ?>" class="form-control">
                                <?php foreach ($unmappedRoles as $r) { ?>
                                    <option value="<?= $r[mRole::ID] ?>"><?= $r[mRole::NAME] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                    </form>


                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</div>