<script type="text/javascript">
    function submitValidateForm()
    {
        $("#validateForm").submit();
    }
    
</script>
<div class="form-horizontal" id="formEstimasi">
    <form action="<?= base_url() ?>estimasi/estimasi/save" method="post" id="formActionEstimasi">
        <input type="hidden" value="" id="rabId" name="<?= mRabTransaction::ID ?>" />
        <div class="form-group">
            <label class="col-md-3 control-label">Jumlah Pekerja</label>
            <div class="col-md-4">
                <input type="text" name="<?= mRabTransaction::WORKERS ?>" value="<?= $rabTransaction[mRabTransaction::WORKERS] ?>" id="inputPekerja" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Estimasi Cuaca</label>
            <div class="col-md-4">
                <input type="text" name="<?= mRabTransaction::WHEATER_FACTOR ?>" value="<?= $rabTransaction[mRabTransaction::WHEATER_FACTOR] ?>" id="inputCuaca" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Estimasi Umur Bangunan</label>
            <div class="col-md-4">
                <input type="text" name="<?= mRabTransaction::BUILDING_LIFETIME ?>" value="<?= $rabTransaction[mRabTransaction::BUILDING_LIFETIME] ?>" id="inputBangunan" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Total Estimasi Waktu</label>
            <div class="col-md-4">
                <input type="text" name="<?= mRabTransaction::TOTAL_TIME ?>" value="<?= $rabTransaction[mRabTransaction::TOTAL_TIME] ?>" disabled="true" class="form-control" id="totalWaktu"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Status</label>
            <div class="col-md-4">
                <input type="text" name="<?= mRabTransaction::STATUS_APPROVAL ?>" value="<?= $rabTransaction[mRabTransaction::STATUS_APPROVAL] ?>" disabled="true" class="form-control" id="statusApproval"/>
            </div>
        </div>
        <div class="form-group" id="formAction">
            <div class="col-md-2 offset3">
                <button type="submit" class="btn btn-sm btn-info" onclick="submitSaveForm()"><i class="fa fa-save fa-fw"></i>Simpan</button>
            </div>
            <div class="col-md-2 offset4">
                <button type="button" class="btn btn-sm btn-success" onclick="submitValidateForm()"><i class="fa fa-check fa-fw"></i>Validasi</button>
            </div>
        </div>
    </form>
    <form action="<?= base_url() ?>estimasi/estimasi/validate" method="post" id="validateForm">
        <input type="hidden" value="" id="rabIdValidate" name="<?= mRabTransaction::ID ?>" />
    </form>
</div>

