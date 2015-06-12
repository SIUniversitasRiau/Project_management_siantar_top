<script>
	var current_id = -1;
	Number.prototype.formatMoney = function(c, d, t){
	var n = this, 
		c = isNaN(c = Math.abs(c)) ? 2 : c, 
		d = d == undefined ? "." : d, 
		t = t == undefined ? "," : t, 
		s = n < 0 ? "-" : "", 
		i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
		j = (j = i.length) > 3 ? j % 3 : 0;
	   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	 };
	 
	function editAnalisa(){
		$("#id_to_edit").val(current_id);
		$("#form_edit").submit();
	}
	
	function confirmDelete(){
		$("#tobe_deleted_id").val(current_id);
		$("#deleteModal").modal();
	}
	
	function deleteAnalisa(){
		$("#deleteModal").modal("hide");
		$("#form_delete").submit();
	}
	
	$(document).ready(function() {
		var table = $('#example').dataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo base_url(); ?>rab/analisa/getViewAnalisa",
			"createdRow": function ( row, data, index ) {
				var id = data[4];
				$('td', row).eq(4).html('<button class="btn btn-primary btn-xs" onclick="viewAnalisa('+id+')"><i class="fa fa-eye fa-fw"></i> Lihat</button>');
				$(row).attr('id', 'item_'+id);
			}
		} );
	} );
	 
	function viewAnalisa(id){
		if (current_id != id) {
            current_id = id;
            $("#row_ubah").remove();
            $("<tr id='row_ubah'><td colspan='7'><div style='margin-top:10px; margin-bottom:10px' id='form_ubah' align='center'><img id='bar_loader' src='<?= base_url().'assets/default/img/bar_loader.gif' ?>'></div></td></tr>").insertAfter("#item_" + current_id);
            var x = $("#template_form_ubah").clone();
            x.appendTo("#form_ubah");
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>rab/analisa/detail",
				data: {id: id}, 
				cache: true,
				success: function(result){
					var res = JSON.parse(result);
					var res_barang = res["detail_barang"];
					var barang = '';
					var jumlah_barang = 0;
					$(".item_bahan").remove();
					$("#bar_loader").remove();
					for(var i=0; i<res_barang.length; i++){
						barang += '<tr class="item_bahan"><td>'+res_barang[i]["BARANG_NAMA"]+'</td><td>'+res_barang[i]["DETAIL_ANALISA_KOEFISIEN"]+'</td><td>'+res_barang[i]["SATUAN_NAMA"]+'</td><td align="right"><span class="currency">Rp</span><span class="number">'+(parseFloat(res_barang[i]["DETAIL_ANALISA_HARGA"])).formatMoney(2)+'</span></td><td align="right"><span class="currency">Rp</span><span class="number">'+(parseFloat(res_barang[i]["DETAIL_ANALISA_TOTAL"])).formatMoney(2)+'</span></td></tr>';
						jumlah_barang += parseFloat(res_barang[i]["DETAIL_ANALISA_TOTAL"]);
					}
					barang += '<tr class="item_bahan"><td colspan="4"><b>JUMLAH BAHAN</b></td><td align="right"><span class="currency">Rp</span><span class="number">'+(jumlah_barang).formatMoney(2)+'</span></td></tr>';
					$(barang).insertAfter("#template_form_ubah #header_bahan");
					
					var res_upah = res["detail_upah"];
					var upah = '';
					var jumlah_upah = 0;
					$(".item_upah").remove();
					for(var i=0; i<res_upah.length; i++){
						upah += '<tr class="item_upah"><td>'+res_upah[i]["UPAH_NAMA"]+'</td><td>'+res_upah[i]["DETAIL_ANALISA_KOEFISIEN"]+'</td><td>'+res_upah[i]["SATUAN_UPAH_NAMA"]+'</td><td align="right"><span class="currency">Rp</span><span class="number">'+(parseFloat(res_upah[i]["DETAIL_ANALISA_HARGA"])).formatMoney(2)+'</span></td><td align="right"><span class="currency">Rp</span><span class="number">'+(parseFloat(res_upah[i]["DETAIL_ANALISA_TOTAL"])).formatMoney(2)+'</span></td></tr>';
						jumlah_upah += parseFloat(res_upah[i]["DETAIL_ANALISA_TOTAL"]);
					}
					upah += '<tr class="item_upah"><td colspan="4"><b>JUMLAH PEKERJA</b></td><td align="right"><span class="currency">Rp</span><span class="number">'+(jumlah_upah).formatMoney(2)+'</span></td></tr>';
					$(upah).insertAfter("#template_form_ubah #header_upah");
					
					$("#form_ubah #jumlah_bahan_pekerja").html('<span class="currency">Rp</span><span class="number">' + ((jumlah_barang+jumlah_upah)).formatMoney(2) + '</span>');
					$("#form_ubah #jumlah_total").html('<span class="currency">Rp</span><span class="number">' + ((jumlah_barang+jumlah_upah)).formatMoney(2) + '</span>');
					$("#form_ubah #dibulatkan").html('<span class="currency">Rp</span><span class="number">' + (Math.floor((jumlah_barang+jumlah_upah)*100)/100).formatMoney(2) + '</span>');
					
					x.slideDown();
				}
			});
        } else {
			$('#form_ubah').slideUp('normal', function() {
				$('#row_ubah').remove();
            });
            current_id = -1;
		}
	}
</script>
<style>
	table{
	
	}
	.centerTable th{
		text-align: center;
		background-color: #0993D3;
		color: #FFFFFF;
		height: 30px;
		font-size: 15px;
	}
	.currency{
		margin-right: 10px;
		display: inline-block;
	}
	.number{
		display: inline-block;  
		text-align: right;
	}
</style>
<form style="display: none" id="form_edit" action="<?php echo base_url(); ?>rab/analisa/edit" method="POST">
	<input type="hidden" value="" id="id_to_edit" name="id_to_edit" />
</form>

<form method="POST" action="<?php echo base_url(); ?>rab/analisa/delete" id="form_delete">
	<input type="hidden" value="" name="tobe_deleted_id" id="tobe_deleted_id" />
</form>

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title">Konfirmasi penghapusan item upah</h4>
  </div>
  <div class="modal-body">
	<h3>Anda yakin untuk menghapus item ini?</h3>
  </div>
  <div class="modal-footer">
	<button type="button" class="btn btn-primary" onclick="deleteAnalisa();">Ya</button>
	<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Tidak</button>
  </div>
</div>
</div>
</div>
						
<div id="template_form_ubah" style="display:none; margin-top: 20px; margin-bottom: 20px">
	<table class="table table-striped table-bordered table-hover centerTable">
	  <thead>
		<tr class="label-info">
		  <th>Uraian</th>
		  <th>Koefisien</th>
		  <th>Satuan</th>
		  <th>Harga Satuan</th>
		  <th>Jumlah</th>
		</tr>
	  </thead>
	  <tbody>
		<tr id="header_bahan">
		  <td colspan="5"><b>BAHAN</b></td>
		</tr>
		<tr id="header_upah">
		  <td colspan="5"><b>UPAH</b></td>
		</tr>
		<tr>
		  <td colspan="4"><b>JUMLAH BAHAN + PEKERJA</b></td>
		  <td align="right" id="jumlah_bahan_pekerja"></td>
		</tr>
		<tr>
		  <td colspan="4"><b>JUMLAH TOTAL</b></td>
		  <td align="right" id="jumlah_total"></td>
		</tr>
		<tr>
		  <td colspan="4"><b>DIBULATKAN</b></td>
		  <td align="right" id="dibulatkan"></td>
		</tr>
	  </tbody>
	</table>
	<div class="clearfix">
		<br />
	</div>
	<div style="width: 100%" align="center"><button id="edit" class="btn btn-primary btn-lg" onclick="editAnalisa()">Edit</button><button id="delete" class="btn btn-danger btn-lg" style="margin-left: 10px" onclick="confirmDelete()">Hapus</button></div>
</div>

<!-- Page heading -->
<div class="page-head">
    <h2 class="pull-left"><i class="fa fa-home"></i> Analisa</h2>
    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
        <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider -->
        <span class="divider">/</span> 
        <a href="#" class="bread-current">Analisa</a>
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
							Data Analisa
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
						<div class="padd">
							<button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location='<?php echo base_url(); ?>rab/analisa/add'"><i class="fa fa-plus fa-fw"></i> Tambahkan analisa</button>
							<div class="clearfix">
								<br />
							</div>
							<div class="page-tables">
								<!-- Table -->
								<div class="table-responsive">
									<table id="example" class="display" cellspacing="0" width="100%" style="margin-bottom: 10px">
										<thead>
											<tr>
												<th>Kode</th>
												<th>Nama</th>
												<th>Harga</th>
												<th>Lokasi</th>
												<th>Detail</th>
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
