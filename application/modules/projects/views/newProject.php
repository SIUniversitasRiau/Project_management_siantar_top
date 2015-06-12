<!-- Page heading -->
<div class="page-head">
    <h2 class="pull-left"><i class="fa fa-building-o"></i> Project</h2>
    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
        <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider -->
        <span class="divider">/</span> 
        <a href="<?= base_url().'projects/project' ?>" class="bread-current">Project</a>
        <span class="divider">/</span> 
        <a href="#" class="bread-current">Tambah</a>
    </div>
    <div class="clearfix"></div>
</div>
<!-- Page heading ends -->

<div class="matter">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <!-- edit here -->
                <div class="widget">
                    <div class="widget-head">
                        <div class="pull-left">Data Project</div>
                        <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                        </div>  
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget-content">
                        <div class="padd">
                            <form action="<?= base_url().'projects/project/addNew' ?>" method="post" class="form-horizontal" role="form">
								<div class="form-group">
                                    <label class="col-lg-2 control-label">Kode</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="PROJECT_KODE" placeholder="Kode Proyek">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Nama Proyek</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" name="PROJECT_NAME" placeholder="Nama Proyek">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Deskripsi</label>
                                    <div class="col-lg-5">
                                        <textarea class="form-control" rows="5" name="PROJECT_DESCRIPTION" placeholder="Deskripsi"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Creator/PJ</label>
                                    <div class="col-lg-5">
                                        <select multiple name="CREATOR[]" id="selectDynamic1" style="width:100%" class="populate">
                                            <?php 
                                            for($i=0; $i<sizeof($listDepartement); $i++): 
                                            ?>
                                            <optgroup label="<?= $listDepartement[$i]['DEPARTEMEN_NAMA'] ?>">
                                            <?php
                                                for($j=0; $j<sizeof($listPengguna); $j++):
                                                    if($listPengguna[$j]['DEPARTEMEN_ID']==$listDepartement[$i]['DEPARTEMEN_ID']){
                                            ?>
                                                <option value="<?= $listPengguna[$j]['PENGGUNA_ID'] ?>"><?= $listPengguna[$j]['PENGGUNA_NAMA'] ?></option>
                                            <?php 
                                                    }
                                                endfor;
                                            ?>
                                            </optgroup>
                                            <?php
                                            endfor;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-6">
                                        <div class="alert alert-info "><b>Perencanaan</b></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Estimator</label>
                                    <div class="col-lg-5">
                                        <select multiple name="ESTIMATOR[]" id="selectDynamic2" style="width:100%" class="populate">
                                            <?php 
                                            for($i=0; $i<sizeof($listDepartement); $i++): 
                                            ?>
                                            <optgroup label="<?= $listDepartement[$i]['DEPARTEMEN_NAMA'] ?>">
                                            <?php
                                                for($j=0; $j<sizeof($listPengguna); $j++):
                                                    if($listPengguna[$j]['DEPARTEMEN_ID']==$listDepartement[$i]['DEPARTEMEN_ID']){
                                            ?>
                                                <option value="<?= $listPengguna[$j]['PENGGUNA_ID'] ?>"><?= $listPengguna[$j]['PENGGUNA_NAMA'] ?></option>
                                            <?php 
                                                    }
                                                endfor;
                                            ?>
                                            </optgroup>
                                            <?php
                                            endfor;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">PM</label>
                                    <div class="col-lg-5">
                                        <select multiple name="PM[]" id="selectDynamic3" style="width:100%" class="populate">
                                            <?php 
                                            for($i=0; $i<sizeof($listDepartement); $i++): 
                                            ?>
                                            <optgroup label="<?= $listDepartement[$i]['DEPARTEMEN_NAMA'] ?>">
                                            <?php
                                                for($j=0; $j<sizeof($listPengguna); $j++):
                                                    if($listPengguna[$j]['DEPARTEMEN_ID']==$listDepartement[$i]['DEPARTEMEN_ID']){
                                            ?>
                                                <option value="<?= $listPengguna[$j]['PENGGUNA_ID'] ?>"><?= $listPengguna[$j]['PENGGUNA_NAMA'] ?></option>
                                            <?php 
                                                    }
                                                endfor;
                                            ?>
                                            </optgroup>
                                            <?php
                                            endfor;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-6">
                                        <div class="alert alert-info "><b>Pelaksanaan</b></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">PP</label>
                                    <div class="col-lg-5">
                                        <select multiple name="PP[]" id="selectDynamic4" style="width:100%" class="populate">
                                            <?php 
                                            for($i=0; $i<sizeof($listDepartement); $i++): 
                                            ?>
                                            <optgroup label="<?= $listDepartement[$i]['DEPARTEMEN_NAMA'] ?>">
                                            <?php
                                                for($j=0; $j<sizeof($listPengguna); $j++):
                                                    if($listPengguna[$j]['DEPARTEMEN_ID']==$listDepartement[$i]['DEPARTEMEN_ID']){
                                            ?>
                                                <option value="<?= $listPengguna[$j]['PENGGUNA_ID'] ?>"><?= $listPengguna[$j]['PENGGUNA_NAMA'] ?></option>
                                            <?php 
                                                    }
                                                endfor;
                                            ?>
                                            </optgroup>
                                            <?php
                                            endfor;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">PO</label>
                                    <div class="col-lg-5">
                                        <select multiple name="PO[]" id="selectDynamic5" style="width:100%" class="populate">
                                            <?php 
                                            for($i=0; $i<sizeof($listDepartement); $i++): 
                                            ?>
                                            <optgroup label="<?= $listDepartement[$i]['DEPARTEMEN_NAMA'] ?>">
                                            <?php
                                                for($j=0; $j<sizeof($listPengguna); $j++):
                                                    if($listPengguna[$j]['DEPARTEMEN_ID']==$listDepartement[$i]['DEPARTEMEN_ID']){
                                            ?>
                                                <option value="<?= $listPengguna[$j]['PENGGUNA_ID'] ?>"><?= $listPengguna[$j]['PENGGUNA_NAMA'] ?></option>
                                            <?php 
                                                    }
                                                endfor;
                                            ?>
                                            </optgroup>
                                            <?php
                                            endfor;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-5">
                                    <input type="submit" class="pull-right btn btn-sm btn-primary" value="Simpan" name="submit" />
                                  </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <br/><br/>
            </div>
        </div>
    </div>
</div>

