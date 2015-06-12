<script>
    var current_id = -1;

    function fillUpdate(id,idx) {
        if (current_id != id) {
            current_id = id;
			var data = $('#example').dataTable().fnGetData()[idx];
            $("#row_ubah").remove();
            $("<tr id='row_ubah'><td colspan='7'><div style='margin-top:10px' id='form_ubah'></div></td></tr>").insertAfter("#item_" + current_id);
            var x = $("#template_form_ubah").clone();
            x.appendTo("#form_ubah");
            $("#form_ubah #bar_id").val(data[0]);
            $("#form_ubah #bar_nama").val(data[1]);
			$("#form_ubah #sat_nama").val(data[3]);
            $("#form_ubah #bar_kode").val(data[4]);
            $("#form_ubah #bar_harga").val(data[5]);
            $("#form_ubah #bar_ket").text(data[6]);
			$("#form_ubah #kat_bar_id").val(data[7]);
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
	
	$(document).ready(function() {
		var table = $('#example').dataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo base_url(); ?>master/barang/getViewBarang",
			"createdRow": function ( row, data, index ) {
				var id = data[0];
				$('td', row).eq(0).html('<div class="btn-group"><button class="btn btn-default btn-xs dropdown-toggle btn-info" data-toggle="dropdown">Aksi <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="javascript:fillUpdate('+id+','+index+')"><i class="fa fa-refresh fa-fw"></i> Ubah</a></li><li><a href="javascript:confirmDelete('+id+')"><i class="fa fa-trash-o fa-fw"></i> Hapus</a></li></ul></div>');
				$(row).attr('id', 'item_'+id);
			},
			"columnDefs": [
				{
					"targets": [ 6 , 7 ],
					"visible": false
				}
			]
		} );
		
		$('#showHideKeterangan').on( 'click', function (e) {
			e.preventDefault();
			var column = table.api().column(6);
			if(column.visible()){
				column.visible(false);
				$("#showHideKeterangan").html('<i class="fa fa-eye fa-fw"></i> Tampilkan keterangan');
				
			} else {
				column.visible(true);
				$("#showHideKeterangan").html('<i class="fa fa-eye-slash fa-fw"></i> Sembunyikan keterangan');
			}
		} );
	} );
</script>
<style>
    .columnKeterangan {
        display: none;
    }
</style>
<!-- Page heading -->
<div class="page-head">
    <h2 class="pull-left"><i class="fa fa-home"></i> Pengelolaan Barang</h2>
    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
        <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider -->
        <span class="divider">/</span> 
        <a href="#" class="bread-current">Barang</a>
    </div>
    <div class="clearfix"></div>
</div>
<!-- Page heading ends -->

<div class="matter">
    <div class="container">
        <div class="row">
			<div class="col-md-12">
				<div class="widget wgreen">
					<div class="widget-head">
						<div class="pull-left">
							Data Master Barang
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
										<h4 class="modal-title">Konfirmasi penghapusan item barang</h4>
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

						<form method="POST" action="<?php echo base_url(); ?>master/barang/delete" id="form_delete">
							<input type="hidden" value="" name="tobe_deleted_id" id="tobe_deleted_id" />
						</form>

						<div id="template_form_ubah" style="display:none; padding-top: 20px" class="alert-info">
							<form method="POST" action="<?php echo base_url(); ?>master/barang/update">
								<input type="hidden" class="form-control" id="bar_id" name="bar_id">
								<div class="col-lg-4 col-lg-offset-0">
									<div class="form-horizontal" role="form">
										<div class="form-group">
											<label class="col-lg-2 control-label">Kode</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" id="bar_kode" name="bar_kode" placeholder="kode barang">
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2 control-label">Nama</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" id="bar_nama" name="bar_nama" placeholder="nama barang">
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2 control-label">Harga</label>
											<div class="col-lg-9">
												<input type="text" class="form-control" id="bar_harga" name="bar_harga" placeholder="harga">
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2 control-label">Kategori</label>
											<div class="col-lg-9">
												<select class="form-control" id="kat_bar_id" name="kat_bar_id">
													<?php foreach ($kategori as $i) {
														echo "<option value='" . $i['KATEGORI_BARANG_ID'] . "'>" . $i['KATEGORI_BARANG_NAMA'] . "</option>";
													} ?>
												</select>
											</div>
										</div>
									</div>			
								</div>
								<div class="col-lg-5 col-lg-offset-0">
									<div class="form-horizontal" role="form">
										<div class="form-group">
											<label class="col-lg-4 control-label">Satuan barang</label>
											<div class="col-lg-7">
												<select class="form-control" id="sat_nama" name="sat_nama">
			<?php foreach ($satuan as $i) {
				echo "<option value='" . $i['SATUAN_NAMA'] . "'>" . $i['SATUAN_NAMA'] . "</option>";
			} ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-4 control-label">Keterangan</label>
											<div class="col-lg-7">
												<textarea class="form-control" rows="6" placeholder="Textarea" id="bar_ket" name="bar_ket"></textarea>
											</div>
										</div>    
									</div>
								</div>
								<div>
									<div class="form-horizontal" role="form">
										<div class="form-group" align="center">
											<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save fa-fw"></i> Simpan</button>
											<button type="button" class="btn btn-sm btn-danger" onclick="$('#form_ubah').slideUp('normal', function() {
														$('#row_ubah').remove();
													});
													current_id = -1;"><i class="fa fa-ban fa-fw"></i> Batal</button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="padd">
							<div style="width: 100%">
							<div style="width: 49%; display: inline-block;" align="left"><button type="button" class="btn btn-sm btn-primary" onclick="$('#form_tambah').slideToggle();"><i class="fa fa-plus fa-fw"></i> Tambahkan barang</button></div>
							<div style="width: 49%; display: inline-block;" align="right"><button class="btn btn-primary" id="showHideKeterangan" onclick=""><i class="fa fa-eye fa-fw"></i> Tampilkan keterangan</button></div>
							</div>
							<div class="clearfix">
								<br />
							</div>
							<form method="POST" action="<?php echo base_url(); ?>master/barang/insert">
								<div id="form_tambah" style="display:none">
									<div class="form-horizontal" role="form">
										<div class="form-group">
											<label class="col-lg-2 control-label">Kode barang</label>
											<div class="col-lg-5">
												<input type="text" class="form-control" id="bar_kode" name="bar_kode" placeholder="kode barang">
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2 control-label">Nama barang</label>
											<div class="col-lg-5">
												<input type="text" class="form-control" id="bar_nama" name="bar_nama" placeholder="nama barang">
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2 control-label">Harga</label>
											<div class="col-lg-5">
												<input type="text" class="form-control" id="bar_harga" name="bar_harga" placeholder="harga">
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2 control-label">Satuan barang</label>
											<div class="col-lg-5">
												<select class="form-control" id="sat_nama" name="sat_nama">
													<?php foreach ($satuan as $i) {
														echo "<option>" . $i['SATUAN_NAMA'] . "</option>";
													} ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2 control-label">Kategori</label>
											<div class="col-lg-5">
												<select class="form-control" id="kat_bar_id" name="kat_bar_id">
			<?php foreach ($kategori as $i) {
				echo "<option value='" . $i['KATEGORI_BARANG_ID'] . "'>" . $i['KATEGORI_BARANG_NAMA'] . "</option>";
			} ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-lg-2 control-label">Keterangan</label>
											<div class="col-lg-5">
												<textarea class="form-control" rows="5" placeholder="keterangan barang" id="bar_ket" name="bar_ket"></textarea>
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
							<div class="page-tables" style="overflow-y: auto">
								<!-- Table -->
								<div class="table-responsive" align="right">
									<table id="example" class="display" cellspacing="0" width="100%"  style="margin-bottom: 10px">
										<thead>
											<tr>
												<th>Aksi</th>
												<th>Nama Barang</th>
												<th>Kategori</th>
												<th>Satuan</th>
												<th>Kode</th>
												<th>Harga</th>
												<th>Keterangan</th>
											</tr>
										</thead>
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
		</div>
    </div>
</div>