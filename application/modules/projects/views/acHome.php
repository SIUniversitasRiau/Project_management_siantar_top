<script>
	$(document).ready(function() {
		var table = $('#example').dataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo base_url(); ?>projects/project/getViewProject",
			"createdRow": function ( row, data, index ) {
				var id = data[0];
				$('td', row).eq(0).html(index+1);
				var base_url = '<?= base_url(); ?>';
				$('td', row).eq(5).html('<button class="btn btn-primary btn-xs" onclick="window.location.href=\''+base_url+'projects/project/viewDetail/'+id+'\'"><i class="fa fa-eye fa-fw"></i> Lihat</button><button class="btn btn-success btn-xs" style="margin-left: 10px" onclick="window.location.href=\''+base_url+'projects/project/viewEdit/'+id+'\'"><i class="fa fa-pencil fa-fw"></i> Edit</button>');
				if(data[4]==1) {
					$('td', row).eq(4).html('<a class="success"><span class="fa fa-check"></span> Aktif</a>');
				} else {
					$('td', row).eq(4).html('<a class="danger"><span class="fa-times"></span> Tidak Aktif</a>');
				}
				$(row).attr('id', 'item_'+id);
			}
		} );
	} );
</script>
<!-- Page heading -->
<div class="page-head">
    <h2 class="pull-left"><i class="fa fa-building-o"></i> Project</h2>
    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
        <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider -->
        <span class="divider">/</span> 
        <a href="#" class="bread-current">Project</a>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="page-tables">
                                        <!-- Table -->
                                        <div class="table-responsive">
                                            <button type="button" class="btn btn-sm btn-primary" onclick="window.location.href= '<?= base_url().'projects/project/viewAddNew' ?>'"><i class="fa fa-plus fa-fw"></i> Tambah project</button><br/><br/>	
											<table id="example" class="display" cellspacing="0" width="100%"  style="margin-bottom: 10px">
												<thead>
													<tr>
														<th>No</th>
                                                        <th>Kode Project</th>
                                                        <th>Nama</th>
                                                        <th>Waktu <small>(yyyy-mm-dd hh-mm-ss)</small></th>
                                                        <th>Status</th>
                                                        <th>Detail</th>
													</tr>
												</thead>
											</table>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/><br/>
            </div>
        </div>
    </div>
</div>
</div>
