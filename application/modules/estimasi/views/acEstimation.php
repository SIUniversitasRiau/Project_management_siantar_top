<script type="text/javascript">

    function showModal(id)
    {
        //alert('Ok');
        $("#detailModal #kodeProject").text($("#kode_" + id).text());
        $("#formEstimasi #rabId").val(id);
        $("#formEstimasi #rabIdValidate").val(id);
        $("#formEstimasi #inputPekerja").val($("#jumlahPekerja_" + id).val());
        $("#formEstimasi #inputCuaca").val($("#cuaca_" + id).val());
        $("#formEstimasi #inputBangunan").val($("#umurBangunan_" + id).val());
        $("#formEstimasi #totalWaktu").val($("#totalwaktu_" + id).text());
        $("#formEstimasi #statusApproval").val($("#status_" + id).text());
        $("#detailModal").modal();
        
    }

</script>

<div class="col-md-12">
    <div class="widget wgreen">
        <div class="widget-head">
            <div class="pull-left">History Estimasi</div>
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
            <div id="detailModal" class="modal fade" tabindex="=-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Detail Data Estimasi Proyek <span id="kodeProject" /></h4>
                        </div>
                        <div class="modal-body">
                            <?= $acEstimationTab ?>
                        </div>
                        <div class="modal-footer">
            
                            
                        </div>
                    </div>
                </div>

            </div>
            <div class="page-tables">
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 50px; text-align: center">#</th>
                                <th>Kode RAB</th>
                                <th>Nama RAB</th>
                                <th>Project</th>
                                <th>Total Waktu Estimasi</th>
                                <th>Estimator</th>
                                <th>Validator</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            foreach ($estimations as $est) {
                                ?>
                                <tr>
                                    <td style="text-align: center"><?= $counter++; ?>
                                        <input type="hidden" value="<?= $est[mRabTransaction::WORKERS] ?>" id="jumlahPekerja_<?= $est[mRabTransaction::ID]?>" />
                                        <input type="hidden" value="<?= $est[mRabTransaction::WHEATER_FACTOR] ?>" id="cuaca_<?= $est[mRabTransaction::ID]?>" />
                                        <input type="hidden" value="<?= $est[mRabTransaction::BUILDING_LIFETIME] ?>" id="umurBangunan_<?= $est[mRabTransaction::ID]?>" />
                                    </td>
                                    <td id="kode_<?= $est[mRabTransaction::ID]?>"><?= $est[mRabTransaction::RAB_CODE] ?></td>
                                    <td id="nama_<?= $est[mRabTransaction::ID]?>"><?= $est[mRabTransaction::RAB_NAME] ?></td>
                                    <td id="project_<?= $est[mRabTransaction::ID]?>"><?= $est['PROJECT'] ?></td>
                                    <td id="totalwaktu_<?= $est[mRabTransaction::ID]?>"><?= $est['TOTAL_WAKTU'] ?></td>
                                    <td id="estimator_<?= $est[mRabTransaction::ID]?>"><?= $est['ESTIMATOR'] ?></td>
                                    <td id="validator_<?= $est[mRabTransaction::ID]?>"><?= $est['VALIDATOR'] ?></td>
                                    <td id="status_<?= $est[mRabTransaction::ID]?>"><?= $est['STATUS_APPROVAL'] ?></td>
                                    <td><button class="btn btn-sm btn-success" style="width: 100%"  onclick="showModal(<?= $est[mRabTransaction::ID] ?>)"><i class="fa fa-search"></i> Detail</button></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 50px; text-align: center">#</th>
                                <th>Kode RAB</th>
                                <th>Nama RAB</th>
                                <th>Project</th>
                                <th>Total Waktu Estimasi</th>
                                <th>Estimator</th>
                                <th>Validator</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
