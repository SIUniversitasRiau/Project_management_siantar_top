<script src="<?php echo  base_url(); ?>assets/default/handsontable/handsontable.full.min.js"></script>
<link rel="stylesheet" media="screen" href="<?php echo  base_url(); ?>assets/default/handsontable/handsontable.full.min.css">

<script>
	var tableAnalisa, prev;
	
	$(document).ready(function() {
		tableAnalisa = $('#tabelanalisa').dataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo base_url(); ?>rab/analisa/getViewAnalisaById?lokasi_id=1",
			"createdRow": function ( row, data, index ) {
				var id = data[5];
				$('td', row).eq(5).html('<button data-dismiss="modal" class="btn btn-xs takeButton" onclick="ambilPekerjaan('+id+','+index+',\'analisa\')"><i class="fa fa-check"></i> </button>');
				$(row).attr('id', 'item_'+id);
			},
			"fnDrawCallback": function(oSettings, json) {
			  $(".takeButton").hover( function () { 
					$(this).addClass("btn-success"); 
				}, function () { 
					$(this).removeClass("btn-success"); 
				});
			}
		} );	
		
		$("#rab_lokasi").on('focus', function () {
			prev = this.value;
		}).change(function() {
			var rab_empty = true;
			for(var i=0; i<rab.length; i++){
				for(var j=rab[i]["row_kategori"]+1; j<rab[i]["row_jumlah"]-1; j++){
					if(data1[j][0]!="LS") {
						rab_empty = false;
						break;
					}
				}
			}
			
			if(!rab_empty){
				$('#changeModal').modal('show');
				return;
			} else {
				getAnalisaBaru();
			}
			prev = this.value;
		});
	} );
	
	function batalGanti(){
		$('#rab_lokasi').val(prev);
		$('#changeModal').modal('hide');
	}
	
	function getAnalisaBaru(){
		var rab_empty = true;
		for(var i=0; i<rab.length; i++){
			for(var j=rab[i]["row_kategori"]+1; j<rab[i]["row_jumlah"]-1; j++){
				if(data1[j][0]!="LS") {
					rab_empty = false;
					break;
				}
			}
		}
		
		if(!rab_empty){
			var deleted = [];
			for(var i=0; i<rab.length; i++){
				for(var j=rab[i]["row_kategori"]+1; j<rab[i]["row_jumlah"]-1; j++){
					if(data1[j][0]!="LS") deleted.push(j);
				}
			}
			for(var i=0; i<deleted.length; i++){
				currentRow = deleted[i] - i;
				deleteRow();
			}
			$("#cellHelper").css('visibility','hidden');
		}
		var id = $('#rab_lokasi').val();
		tableAnalisa.fnDestroy();
		tableAnalisa = $('#tabelanalisa').dataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo base_url(); ?>rab/analisa/getViewAnalisaById?lokasi_id="+id,
			"createdRow": function ( row, data, index ) {
				var id = data[5];
				$('td', row).eq(5).html('<button data-dismiss="modal" class="btn btn-xs takeButton" onclick="ambilPekerjaan('+id+','+index+',\'analisa\')"><i class="fa fa-check"></i> </button>');
				$(row).attr('id', 'item_'+id);
			},
			"fnDrawCallback": function(oSettings, json) {
			  $(".takeButton").hover( function () { 
					$(this).addClass("btn-success"); 
				}, function () { 
					$(this).removeClass("btn-success"); 
				});
			}
		} );
		$('#changeModal').modal('hide');
	}
</script>

<div id="changeModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title">Konfirmasi mengubah lokasi upah</h4>
  </div>
  <div class="modal-body">
	<h3>Mengubah lokasi dengan rancangan RAB yang sudah terisi dapat menyebabkan terhapusnya data upah sekarang. Lanjutkan?</h3>
  </div>
  <div class="modal-footer">
	<button type="button" class="btn btn-primary" onclick="getAnalisaBaru();">Ya</button>
	<button type="button" class="btn btn-default" onclick="batalGanti();" aria-hidden="true">Tidak</button>
  </div>
</div>
</div>
</div>

<!-- Page heading -->
<div class="page-head">
    <h2 class="pull-left"><i class="fa fa-home"></i> Rencana Anggaran Biaya Bangunan (RAB)</h2>
    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
        <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider -->
        <span class="divider">/</span> 
        <a href="#" class="bread-current">RAB</a>
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
							Menambahkan Data Baru RAB
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
							<div class="col-lg-12 col-lg-offset-0">
								<div class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-lg-1 control-label">Kode</label>
										<div class="col-lg-5">
											<input type="text" class="form-control" id="rab_kode" name="rab_kode" placeholder="kode RAB">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-1 control-label">Nama</label>
										<div class="col-lg-5">
											<input type="text" class="form-control" id="rab_nama" name="rab_nama" placeholder="nama RAB">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-1 control-label">Lokasi</label>
										<div class="col-lg-5">
											<select class="form-control" id="rab_lokasi" name="rab_lokasi">
			<?php foreach ($lokasi as $i) {
			echo "<option value='" . $i['LOKASI_UPAH_ID'] . "'>" . $i['LOKASI_UPAH_NAMA'] . "</option>";
			} ?>
											</select>
										</div>
									</div>
								</div>
								<div id="cellHelper" style="visibility: hidden; display: inline-block">
									<button class="btn btn-xs btn-info" id="btn-up" onclick="move('up')"><i class="fa fa-arrow-up"></i></button> 
									<button class="btn btn-xs btn-info " id="btn-down" onclick="move('down')"><i class="fa fa-arrow-down"></i></button> 
									<button class="btn btn-xs btn-danger" id="btn-min" onclick="deleteRow()"><i class="fa fa-times"></i></button>
								</div>
								<div id="example1" style="width: 90%"></div>
							</div>
							<div class="clearfix">
								<br />
							</div>				
							<div style="width: 100%; margin-top: 20px" align="center" id="button_container"><button id="add" class="btn btn-primary btn-lg" onclick="simpanRAB(<?= $project_id; ?>)">Simpan</button></div>
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

<div id="modalPilihan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog page-tables" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><b>Daftar Master Barang</b></h4>
            </div>
            <div class="modal-body">
                <div class="widget-content">
					<ul id="myTab" class="nav nav-tabs">
                      <li class="active"><a href="#analisa" data-toggle="tab">Tambahkan Analisa</a></li>
                      <li><a href="#subcon" data-toggle="tab">Tambahkan Subcon</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                      <div class="tab-pane fade in active" id="analisa">
							<div class="clearfix">
								<br/>
							</div>
							<div class="table-responsive">
							<table id="tabelanalisa" class="display" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Kode</th>
										<th>Nama</th>
										<th>Satuan</th>
										<th>Lokasi</th>
										<th>Harga</th>
										<th>Pilih</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Kode</th>
										<th>Nama</th>
										<th>Satuan</th>
										<th>Lokasi</th>
										<th>Harga</th>
										<th>Pilih</th>
									</tr>
								</tfoot>
							</table>
							<div class="clearfix">
							</div>
						</div>
                      </div>
                      <div class="tab-pane fade" id="subcon">
							<div class="clearfix">
								<br/>
							</div>
						   <div class="form-horizontal" role="form">
								<div class="form-group">
									<label class="col-lg-4 control-label">Nama Paket Pekerjaan</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" id="subcon_nama" name="subcon_nama" placeholder="nama subcon">
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-4 control-label">Satuan</label>
									<div class="col-lg-5">
										<select class="form-control" id="subcon_satuan" name="subcon_satuan">
		<?php foreach ($satuan as $i) {
		echo "<option value='" . $i['SATUAN_NAMA'] . "'>" . $i['SATUAN_NAMA'] . "</option>";
		} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-4 control-label">Harga</label>
									<div class="col-lg-5">
										<input type="text" class="form-control" id="subcon_harga" name="subcon_harga" placeholder="harga subcon">
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-4 control-label"></label>
									<div class="col-lg-5" align="center">
										<button type="button" class="btn btn-info" onclick="ambilPekerjaan(0,'subcon')" aria-hidden="true">Tambahkan</button>
										<button type="button" class="btn btn-danger" onclick="resetSubcon()" aria-hidden="true">Reset</button>
									</div>
								</div>
							</div>	
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
	table.htCore th{
		background-color: #0993D3;
		color: #FFFFFF;
		height: 30px;
		font-size: 15px;
	}
</style>
<script>
	var currentRow = -1, currentCol = -1;
	var rab = [];
	var data1 = [
		["","","","","","","",""],
	],
	container1 = document.getElementById('example1'),
	settings1 = {
		data: data1,
		colHeaders: ["No", "Uraian Pekerjaan", "Kode Analisa", "Volume Satuan", "Satuan Pekerjaan","Harga Satuan","Jumlah Harga"],
		rowHeights: 35,
		colWidths: [10,105,30,35,39,33,37],
		enterMoves: {row: 0, col: 1},
		stretchH: 'all',
		className: 'htMiddle',
		multiSelect: false,
		allowInvalid: false,
		columns: [
			{data: 1, readOnly: true},
			{data: 2},
			{data: 3, readOnly: true},
			{data: 4},
			{data: 5, readOnly: true},
			{data: 6, type: 'numeric', format: '0,0.00', readOnly: true},
			{data: 7, type: 'numeric', format: '0,0.00', readOnly: true}
		],
	},
	hot1;

	hot1 = new Handsontable(container1, settings1);
	
	function addNewRow(row){
		hot1.alter('insert_row', row);
	}
	
	hot1.addHook('afterSelectionEnd', function(){
		var cel = hot1.getSelected();
		currentRow = cel[0];
		currentCol = cel[1];
		if(hot1.isEmptyRow(currentRow) && isLastRow(currentRow)){
			addKategori();
			return;
		}
		else if(!isKategoriRow() && !isJumlahRow() && currentCol == 1){
			$('#modalPilihan').modal('show');
		} else if(!isJumlahRow() && !isNewRow()){
			var y = $('.current').position().top;
			var x = $('.htCore').position().left;
			var width = $('.htCore').outerWidth();
			
			if(!canMoveUp()) {
				$("#btn-up").prop('disabled', true);
				$("#btn-up").removeClass('btn-info');
			}
			else {
				$("#btn-up").prop('disabled', false);
				$("#btn-up").addClass('btn-info');
			}
			
			if(!canMoveDown()) {
				$("#btn-down").prop('disabled', true);
				$("#btn-down").removeClass('btn-info');
			}
			else {
				$("#btn-down").prop('disabled', false);
				$("#btn-down").addClass('btn-info');
			}
			
			$("#cellHelper").css({
				position: "relative",
				top: ( y + 30) + "px",
				left: (x + width + 10) + "px",
				visibility: 'visible'
			});
		} else {
			$("#cellHelper").css({ visibility: 'hidden' });
		}
	});
	
	hot1.addHook('afterChange', function(){
		var cel = (typeof hot1.getSelected() == 'undefined') ? null : hot1.getSelected();
		if(cel==null) return;
		if(currentCol==3){
			updateTotal();
		}
	});
	
	hot1.addHook('afterOnCellMouseDown', function(){
		if(currentCol==3){
			updateTotal();
		}
	});
	
	function isLastRow(row){
		if(hot1.countRows()==1)
			return true;
		else if(row == hot1.countRows() - 1)
			return true;
		else return false;
	}
	
	function ambilPekerjaan(id,idx,type){
		if(currentRow!=-1 && currentCol!=-1){
			if(type=="analisa"){
				data = $('#tabelanalisa').dataTable().fnGetData()[idx];
				data1[currentRow][0] = data[5];
				data1[currentRow][2] = data[1];
				data1[currentRow][3] = data[0];
				data1[currentRow][4] = 0;
				data1[currentRow][5] = data[2];
				data1[currentRow][6] = data[4];
			} else {
				if (!isEmptySubcon()){
					data1[currentRow][0] = "LS";
					data1[currentRow][2] = $('#subcon_nama').val();
					data1[currentRow][3] = "LS";
					data1[currentRow][4] = 0;
					data1[currentRow][5] = $('#subcon_satuan').val();
					data1[currentRow][6] = $('#subcon_harga').val();
				} else {
					alert("Isi subcon dengan lengkap terlebih dahulu");
					return;
				}
				
			}
			var kategori = getKategori(currentRow);
			data1[currentRow][1] = parseFloat(kategori["count_sub"]) + 1;
			hot1.render();
			$('#modalPilihan').modal('hide');
			if(isNewRow()) hot1.alter('insert_row', currentRow+1);
			updateKategoriJumlahRow(kategori, 1);
			updateTotal();
		}	
	}
	
	function isEmptySubcon(){
		if(typeof $('#subcon_nama').val() == 'undefined')
			return true;
		else if($('#subcon_nama').val() == "" || $('#subcon_nama').val() == null)
			return true;
		else if(typeof $('#subcon_satuan').val() == 'undefined')
			return true;
		else if($('#subcon_satuan').val() == "" || $('#subcon_satuan').val() == null)
			return true;
		else if(typeof $('#subcon_harga').val() == 'undefined')
			return true;
		else if($('#subcon_harga').val() == "" || $('#subcon_harga').val() == null)
			return true;	
		else return false;
	}
	
	function resetSubcon(){
		$('#subcon_nama').val("");
		$('#subcon_satuan').val("");
		$('#subcon_harga').val("");
	}
	
	function updateTotal(){
		if(hot1.getDataAtCell(currentRow,5)==null) { return; }
		else if(hot1.getDataAtCell(currentRow,5).toString()=='') { return; }
		var val = parseFloat(hot1.getDataAtCell(currentRow,3)) * parseFloat(hot1.getDataAtCell(currentRow,5));
		data1[currentRow][7] = val;
		updateJumlahTotal();
	}
	
	function updateJumlahTotal(){
		var kategori = getKategori(currentRow);
		var sum = 0;
		for(var i=kategori["row_kategori"]+1; i<kategori["row_jumlah"]; i++){
			var val = hot1.getDataAtCell(i,6);
			if(!isNaN(val)){
				if(val!=null){
					if(val.toString()!=''){
						sum = sum + val;
					}
				}
			}
		}
		data1[kategori["row_jumlah"]][7] = sum;
		hot1.render();
		kategori["jumlah"] = sum;
	}
	
	function isNewRow(){
		var jumlahRow = getKategori(currentRow)["row_jumlah"];
		if(currentRow==jumlahRow-1){
			return true;
		}
		return false;
	}
	
	function addKategori(){
		var no = getMaxKategori() + 1;
		addNewRow(currentRow);
		var numbering = 'A';
		if(no!=1){
			numbering = nextChar(hot1.getDataAtCell(rab[getMaxKategori()-1]["row_kategori"],0));
		}
		data1[currentRow][1] = numbering;
		addNewRow(currentRow+1);
		addNewRow(currentRow+2);
		data1[currentRow+2][2] = "JUMLAH";
		hot1.render();
		rab.push({ id_kategori: no, row_kategori: currentRow, count_sub: 0, jumlah: 0, row_jumlah: currentRow+2 });
		$('#modalPilihan').modal('hide');
	}
	
	function getMaxKategori(){
		if(rab.length==0) return 0;
		else return rab.length;
	}
	
	function getKategori(row){
		if(rab.length==1){
			return rab[0];
		}
		for(var i=0; i<rab.length-1; i++){
			var a = rab[i]["row_kategori"];
			var b = rab[i+1]["row_kategori"];
			if(row>=a && row<b){
				return rab[i];
			} else if(row>=rab[rab.length-1]["row_kategori"]){
				return rab[rab.length-1];
			}
		}
	}
	
	function updateKategoriJumlahRow(kategori, param){
		var x = rab.indexOf(kategori);
		kategori["count_sub"] = kategori["count_sub"] + param;
		if(isNewRow() || param==-1) kategori["row_jumlah"] = kategori["row_jumlah"] + param;
		for(var i=0; i<rab.length; i++){
			if(i>x){
				rab[i]["row_jumlah"] = rab[i]["row_jumlah"] + param;
				rab[i]["row_kategori"] = rab[i]["row_kategori"] + param;
			}
		}
	}
	
	function isKategoriRow(){
		for(var i=0; i<rab.length; i++){
			var x = rab[i]["row_kategori"];
			if(currentRow==x){
				return true;
			}
		}
		return false;
	}
	
	function isJumlahRow(){
		for(var i=0; i<rab.length; i++){
			var x = rab[i]["row_jumlah"];
			if(currentRow==x){
				return true;
			}
		}
		return false;
	}
	
	function nextChar(c, d){
		if(d==null){
			d = 1;
		}
		return String.fromCharCode(c.charCodeAt(0) + d);
	}
	
	function previousChar(c, d){
		if(d==null){
			d = 1;
		}
		return String.fromCharCode(c.charCodeAt(0) - d);
	}
	
	$(document).ready(function() {
		$(".takeButton").hover( function () { 
			$(this).addClass("btn-success"); 
		}, function () { 
			$(this).removeClass("btn-success"); 
		});
    });
	
	function canMoveUp(){
		if(isKategoriRow() && currentRow==0){
			return false;
		} else if (currentRow==getKategori(currentRow)["row_kategori"]+1){
			return false;
		}
		return true;
	}
	
	function move(type){
		if(!isKategoriRow()){
			var dest;
			if(type=="up"){
				dest = currentRow - 1;
			} else {
				dest = currentRow + 1;
			}
			for(var i=2; i<8; i++){
				var temp = data1[currentRow][i];
				data1[currentRow][i] = data1[dest][i];
				data1[dest][i] = temp;
			}
			hot1.render();
			hot1.selectCell(dest, currentCol);
		} else {
			var dest;
			var src;
			var srcKategori = getKategori(currentRow); 
			var destKategori;
			var indexSrc = rab.indexOf(srcKategori);
			var indexDest;
			if(type=="up"){
				indexDest = rab.indexOf(srcKategori) - 1;
				destKategori = rab[indexDest];	
			} else {
				indexDest = rab.indexOf(srcKategori) + 1;
				destKategori = rab[indexDest];
			}
			src = data1.slice(srcKategori["row_kategori"],srcKategori["row_jumlah"]+1);
			dest = data1.slice(destKategori["row_kategori"],destKategori["row_jumlah"]+1);
			var d = destKategori["row_kategori"];
			var s = srcKategori["row_kategori"];
			var x = rab[indexDest]["id_kategori"];
			rab[indexDest]["id_kategori"] = rab[indexSrc]["id_kategori"];
			rab[indexSrc]["id_kategori"] = x;
			if(type=="up"){
				var c = d;
				for(var i=0; i<src.length; i++){
					data1[d] = src[i];
					if(i==0) rab[indexSrc]["row_kategori"] = c; 
					else if(i==src.length-1) rab[indexSrc]["row_jumlah"] = c;
					d++;
					c++;
				}
				for(var i=0; i<dest.length; i++){
					data1[c] = dest[i];
					if(i==0) rab[indexDest]["row_kategori"] = c;
					else if(i==dest.length-1) rab[indexDest]["row_jumlah"] = c;
					c++;
				}
			} else {
				var c = s;
				for(var i=0; i<dest.length; i++){
					data1[s] = dest[i];
					if(i==0) rab[indexDest]["row_kategori"] = c;
					else if(i==dest.length-1) rab[indexDest]["row_jumlah"] = c;
					s++;
					c++;
				}
				for(var i=0; i<src.length; i++){
					data1[c] = src[i];
					if(i==0) rab[indexSrc]["row_kategori"] = c;
					else if(i==src.length-1) rab[indexSrc]["row_jumlah"] = c;
					c++;
				}
			}
			var temp = rab[indexSrc];
			rab[indexSrc] = rab[indexDest];
			rab[indexDest] = temp;
			var c = data1[rab[indexSrc]["row_kategori"]][1];
			data1[rab[indexSrc]["row_kategori"]][1] = data1[rab[indexDest]["row_kategori"]][1];
			data1[rab[indexDest]["row_kategori"]][1] = c;
			hot1.render();
		}
    }
	
	function simpanRAB(project_id){
		var estimator_id = <?= $estimator_id; ?>;
		var rabfix = [];
		var kodeRAB = $('#rab_kode').val();
		var namaRAB = $('#rab_nama').val();
		var lokasiRAB = $('#rab_lokasi').val();
		var rab_total = 0;
		for(var i=0; i<rab.length; i++){
			var analisa = [];
			var c = 1;
			for(var j=rab[i]["row_kategori"]+1; j<rab[i]["row_jumlah"]-1; j++){
				analisa.push({ urutan: c, id: data1[j][0], nama: data1[j][2], kode: data1[j][3], volume: parseFloat(data1[j][4]), satuan: data1[j][5], harga: parseFloat(data1[j][6]), total: parseFloat(data1[j][7]) });
				c++;
			}
			rab_total = rab_total + parseFloat(data1[rab[i]["row_jumlah"]][7]);
			rabfix.push({ urutan: rab[i]["id_kategori"], nama_kategori: data1[rab[i]["row_kategori"]][2], items: analisa, total: parseFloat(data1[rab[i]["row_jumlah"]][7]) });
		}
		var rabstring = JSON.stringify(rabfix);
		var add_btn = $('#add').clone();
		$('#add').remove();
		$('#btn_container').html("<img id='bar_loader' src='<?= base_url().'assets/default/img/bar_loader.gif' ?>'>");
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>rab/rabs/simpanRAB",
			data: {kode: kodeRAB, nama: namaRAB, items: rabstring, projectID: project_id, estimatorID: estimator_id, total: rab_total, lokasi: lokasiRAB},
			cache: false,
			success: function(result){
				if(result=="success") {
					window.location="<?php echo base_url(); ?>projects/project/viewDetail/<?= $project_id; ?>#rab";
                }
				else {
					$('#bar_loader').remove();
					add_btn.appendTo("#btn_container");
				}
			}
		});
	}
	
	function deleteRow(){
		if(isKategoriRow()){
			var kategori = getKategori(currentRow);
			var temp = kategori["row_jumlah"] - kategori["row_kategori"] + 1;
			var c = kategori["row_kategori"];
			var x = rab.indexOf(kategori);
			for(var j=0; j<temp; j++){
				data1.splice(c, 1);
			}
			for(var i=0; i<rab.length; i++){
				if(i>x){
					rab[i]["id_kategori"] = rab[i]["id_kategori"] - 1;
					rab[i]["row_jumlah"] = rab[i]["row_jumlah"] - temp;
					rab[i]["row_kategori"] = rab[i]["row_kategori"] - temp;
					data1[rab[i]["row_kategori"]][1] = previousChar(data1[rab[i]["row_kategori"]][1]);
				}
			}
			rab.splice(x,1);
			updateTotal();
			$("#cellHelper").css({ visibility: 'hidden' });
			hot1.render();
		} else {
			if(!isNewRow()) { 
				var kategori = getKategori(currentRow);
				var x = rab.indexOf(kategori);
				for(var j=rab[x]["row_kategori"]+1; j<rab[x]["row_jumlah"]-1; j++){
					if(j>currentRow){
						data1[j][1] = data1[j][1] - 1;
					}
				}
				hot1.alter('remove_row', currentRow); 
				updateKategoriJumlahRow(kategori, -1);
				updateTotal();
				updateJumlahTotal();
				hot1.render();
			}
		}
		$("#cellHelper").css({ visibility: 'hidden' });
	}
	
	function canMoveDown(){
		if(isKategoriRow() && (getMaxKategori()==1 || getMaxKategori()==getKategori(currentRow)["id_kategori"])){
			return false;
		} else if (!isKategoriRow() && currentRow==getKategori(currentRow)["row_jumlah"]-2){
			return false;
		}
		return true;
	}
	
	/*========================== unused function =============================*/
	
	function addSubKategori(){
		var kategori = getKategori(currentRow);
		//console.log(kategori);
		var row_sub = -1;
		var subChar = 'a';
		row_sub = kategori["row_kategori"] + kategori["count_sub"] + 1;
		if(kategori["count_sub"]!=0) {
			var lastSub = hot1.getDataAtCell(row_sub-1, 0);
			subChar = nextChar(lastSub);
		}
		addNewRow(row_sub);
		updateDataKategori(kategori);
		hot1.setDataAtCell(row_sub, 0, subChar);
		$('#modalPilihan').modal('hide');
	}
	
	function addKategoriTemp(){
		var no = getMaxKategori() + 1;
		addNewRow(currentRow);
		hot1.setDataAtCell(currentRow, 0, no);
		rab.push({ id_kategori: no, row_kategori: currentRow, count_sub: 0, sub_kategori: null });
		$('#modalPilihan').modal('hide');
	}
	
	function updateDataKategori(kategori){
		var x = rab.indexOf(kategori);
		kategori["count_sub"] = kategori["count_sub"] + 1;
		for(var i=0; i<rab.length; i++){
			if(i>x){
				rab[i]["row_kategori"] = rab[i]["row_kategori"] + 1;
			}
		}
	}
</script>