<script>
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
	 
	$(document).ready(function() {
		var res = JSON.parse('<?= $detail; ?>');
		var res_barang = res["detail_barang"];
		var res_upah = res["detail_upah"];
		var subcon = res["subcon"];
		var item = '';
		var jumlah = 0;
		if(res_barang.length>0){
			item += '<tr class="item_rap_detail"><td colspan="6"><b>BARANG / BAHAN</b></td></tr>';
			for(var i=0; i<res_barang.length; i++){
				item += '<tr class="item_rap_detail"><td>'+res_barang[i]["BARANG_NAMA"]+'</td><td>'+res_barang[i]["BARANG_KODE"]+'</td><td>'+res_barang[i]["SATUAN_NAMA"]+'</td><td align="right"><span class="currency">Rp</span><span class="number">'+(parseFloat(res_barang[i]["BARANG_HARGA"])).formatMoney(2)+'</span></td><td>'+res_barang[i]["BARANG_VOLUME"]+'</td><td align="right"><span class="currency">Rp</span><span class="number">'+(parseFloat(res_barang[i]["BARANG_HARGA"])*parseFloat(res_barang[i]["BARANG_VOLUME"])).formatMoney(2)+'</span></td></tr>';
				jumlah += (parseFloat(res_barang[i]["BARANG_HARGA"])*parseFloat(res_barang[i]["BARANG_VOLUME"]));
			}
		}
		if(res_upah.length>0){
			item += '<tr class="item_rap_detail"><td colspan="6"><b>UPAH</b></td></tr>';
			for(var i=0; i<res_upah.length; i++){
				item += '<tr class="item_rap_detail"><td>'+res_upah[i]["UPAH_NAMA"]+'</td><td>'+res_upah[i]["UPAH_KODE"]+'</td><td>'+res_upah[i]["SATUAN_UPAH_NAMA"]+'</td><td align="right"><span class="currency">Rp</span><span class="number">'+(parseFloat(res_upah[i]["UPAH_HARGA"])).formatMoney(2)+'</span></td><td>'+res_upah[i]["UPAH_VOLUME"]+'</td><td align="right"><span class="currency">Rp</span><span class="number">'+(parseFloat(res_upah[i]["UPAH_HARGA"])*parseFloat(res_upah[i]["UPAH_VOLUME"])).formatMoney(2)+'</span></td></tr>';
				jumlah += (parseFloat(res_upah[i]["UPAH_HARGA"])*parseFloat(res_upah[i]["UPAH_VOLUME"]));
			}
		}
		if(subcon.length>0){
			item += '<tr class="item_rap_detail"><td colspan="6"><b>SUBCON</b></td></tr>';
			for(var i=0; i<res_upah.length; i++){
				item += '<tr class="item_rap_detail"><td>'+res_upah[i]["SUBCON_NAMA"]+'</td><td>LS</td><td>'+res_upah[i]["SATUAN_NAMA"]+'</td><td align="right"><span class="currency">Rp</span><span class="number">'+(parseFloat(res_upah[i]["SUBCON_HARGA"])).formatMoney(2)+'</span></td><td>'+res_upah[i]["DETAIL_PEKERJAAN_VOLUME"]+'</td><td><td align="right"><span class="currency">Rp</span><span class="number">'+(parseFloat(res_upah[i]["SUBCON_HARGA"])*parseFloat(res_upah[i]["DETAIL_PEKERJAAN_VOLUME"])).formatMoney(2)+'</span></td></tr>';
				jumlah += (parseFloat(res_upah[i]["SUBCON_HARGA"])*parseFloat(res_upah[i]["DETAIL_PEKERJAAN_VOLUME"]));
			}
		}
		item += '<tr class="item_rap_detail"><td colspan="5">Jumlah</td><td align="right"><span class="currency">Rp</span><span class="number">'+(jumlah).formatMoney(2)+'</span></td></tr>';
		$("#form_rap #detail_rap").html(item);
	} );
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
<!-- Page heading -->
<div class="page-head">
    <h2 class="pull-left"><i class="fa fa-home"></i> RAP</h2>
    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
        <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider -->
        <span class="divider">/</span> 
        <a href="#" class="bread-current">RAP</a>
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
							Detail RAP
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
							<div id="form_rap" style="margin-top: 20px; margin-bottom: 20px">
								<table class="table table-striped table-bordered table-hover centerTable">
								  <thead>
									<tr class="label-info">
									  <th>Nama</th>
									  <th>Kode</th>
									  <th>Satuan</th>
									  <th>Harga</th>
									  <th>Volume</th>
									  <th>Total</th>
									</tr>
								  </thead>
								  <tbody id="detail_rap">
									
								  </tbody>
								</table>
								<div class="clearfix">
									<br />
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
