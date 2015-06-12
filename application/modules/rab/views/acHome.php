<link rel="stylesheet" href="<?php echo site_url() ?>assets/default/css/nestable.css">
<style>
    .child-box{
        height: 50px;
        width: auto;
    }
</style>

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
                <!-- edit here -->
                <div class="widget">
                    <div class="widget-head">
                        <div class="pull-left">Detail RAB</div>
                        <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                        </div>  
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cf" style="padding: 10px;">
                                <div class="dd" id="nestable">
                                    <ol class="dd-list">
                                        <li class="dd-item dd3-item RAB1" data-id="1">
                                            <div class="dd-handle dd3-handle fa fa-arrows-v"></div>
                                            <div class="dd3-content">
                                                <div class="col-md-1 pull-right" style="padding: 5px 0">
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-xs btn-info add1 dropdown-toggle btn-xs" type="button">
                                                        <i class="fa fa-plus"></i> <span class="caret"></span></button>
                                                        <ul role="menu" class="dropdown-menu" style="margin-left: -125px">
                                                            <li><a onclick="add('1', 'kategori')">Kategori</a></li>
                                                            <li><a onclick="add('1', 'pekerjaan')">Pekerjaan</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    <!--flag-->
                    <input  type="hidden" name="flag_input" id="nestable-output" />
                    <br/>
                    <!--number<br/>-->
                    <input type="hidden" name="numberAnalisis" id="numberAnalisis"/>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><b>Daftar Master Analisa</b></h4>
            </div>
            <div class="modal-body">
                <div class="widget-content">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Kode</th>
                            <th>Satuan</th>
                            <th>Nama</th>
                            <th>Total</th>
                            <th>Detail</th>
                            <th>Pilih</th>
                          </tr>
                        </thead>
                        <tbody>
                    <?php if(isset($listAnalisa)): for($i=0; $i<sizeof($listAnalisa); $i++): $temp= $i+1;?>
                            <tr>
                              <td><?= $listAnalisa[$i]['ANALISA_KODE'] ?></td>
                              <td><?= $listAnalisa[$i]['SATUAN_NAMA'] ?></td>
                              <td><?= $listAnalisa[$i]['ANALISA_NAMA'] ?></td>
                              <td><?= $listAnalisa[$i]['ANALISA_TOTAL'] ?></td>
                              <td>
                                  <button class="btn btn-xs btn-warning" onclick=""><i class="fa fa-pencil"></i> </button>
                              </td>
                              <td>
                                  <button data-dismiss="modal" class="btn btn-xs btn-success" onclick="selectAnalisis('<?= $listAnalisa[$i]['ANALISA_ID'] ?>','<?= $listAnalisa[$i]['SATUAN_NAMA'] ?>','<?= $listAnalisa[$i]['ANALISA_NAMA'] ?>','<?= $listAnalisa[$i]['ANALISA_TOTAL'] ?>')"><i class="fa fa-check"></i> </button>
                              </td>
                            </tr>
                    <?php endfor; endif; ?>
                        </tbody>
                    </table>
                    <div class="widget-foot">
                        <ul class="pagination pagination-sm pull-right">
                          <li><a href="#">Prev</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">Next</a></li>
                        </ul>
                      <div class="clearfix"></div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>

<style>
    .btn { z-index: 100; }
    .dropdown-menu{
        z-index: 100;
    }
    .btn-group{
        float: right;
    }
</style>

<script>
    var jmlAnalisis = 1;
    var dataNumberAnalisis=[];
    
    
    function add(param, param2) {
//        updateOutput($('#nestable').data('output', $('#nestable-output')));
//        dynamicInput(param); //auto generate dynamic search input
        dataNumberAnalisis.push(param);
        $("#numberAnalisis").val(dataNumberAnalisis);
        if(param2=="pekerjaan"){
            $(".RAB" + param).html(
            '<div class="dd-handle dd3-handle fa fa-arrows-v"></div>' +
            '<div class="child-box"><div class="dd3-content" >' +
                '<input class="form-control idAnalisis' + jmlAnalisis + '" type="hidden" name="idAnalisis' + jmlAnalisis + '" />' +
                '<div class="col-md-2 " style="padding:0px 0px;">' +
                    '<select class="form-control numb' + jmlAnalisis + ' tipe' + jmlAnalisis + '" name="tipe' + jmlAnalisis + '" onchange="check(\'' + jmlAnalisis + '\')">' +
                        '<option value="ls">LS</option>' +
                        '<option value="analisa">Analisa</option>' +
                    '</select>' +
                '</div>' +
                '<div class="col-md-3" style="padding:0px 5px;">'+
                    '<input class="form-control numb' + jmlAnalisis + ' pekerjaan' + jmlAnalisis + '" type="text" name="pekerjaan' + jmlAnalisis + '" placeholder="Pekerjaan" /></div>' +
                '<div class="col-md-1" style="padding:0px 0px;">'+
                    '<input class="form-control numb' + jmlAnalisis + ' vol' + jmlAnalisis + '" type="text" name="volume' + jmlAnalisis + '" placeholder="vol" onkeyup="calculate(\''+ jmlAnalisis +'\')" /></div>' +
                '<div class="col-md-1" style="padding:0px 5px;">'+
                    '<input class="form-control numb' + jmlAnalisis + ' satuan' + jmlAnalisis + '" type="text" name="satuan' + jmlAnalisis + '" placeholder="sat" /></div>' +
                '<div class="col-md-2" style="padding:0px 0px;">'+
                    '<input class="form-control numb' + jmlAnalisis + ' harga' + jmlAnalisis + '" type="text" name="harga' + jmlAnalisis + '" placeholder="harga" onkeyup="calculate2(\''+ jmlAnalisis +'\')" /></div>' +
                '<div class="col-md-2" style="padding:0px 5px;">'+
                    '<input class="form-control numb' + jmlAnalisis + ' total' + jmlAnalisis + '" type="text" name="total' + jmlAnalisis + '" placeholder="total" /></div>' +
                '<div class="col-md-1 pull-right" style="padding: 5px 0">' +
                    '<button class="pull-right btn btn-xs btn-success save' + jmlAnalisis + '" style="" onclick="save(\'' + jmlAnalisis + '\', \'0\')"><i class="fa fa-check"></i></button>' +
                    '<button class="pull-right btn btn-xs btn-danger delete' + jmlAnalisis + '" style="display: none" onclick="del(\'' + jmlAnalisis + '\')"><i class="fa fa-times"></i></button>' +
                    '<button class="pull-right btn btn-xs btn-warning edit' + jmlAnalisis + '" style="display: none" onclick="edit(\'' + jmlAnalisis + '\')"><i class="fa fa-pencil"></i></button>' +
                '</div>' +
            '</div></div>'
            );
        }
        else {
            $(".RAB" + param).html(
                    '<div class="dd-handle dd3-handle fa fa-arrows-v" style="background:#4D92BD"></div>'+
                    '<div class="dd3-content">'+
                        '<div class="col-md-10 textKategori' + jmlAnalisis + '">'+
                            '<input class="form-control numb' + jmlAnalisis + ' kategori' + jmlAnalisis + '" type="text" name="kategori' + jmlAnalisis + '" placeholder="Kategori Pekerjaan" />'+
                        '</div>'+
                        '<div class="col-md-1 pull-right" style="padding: 5px 0">'+
                            '<button class="pull-right btn btn-xs btn-success save' + jmlAnalisis + '" style="display: block" onclick="save(\'' + jmlAnalisis + '\', \'0\')"><i class="fa fa-check"></i></button>'+
                            '<button class="pull-right btn btn-xs btn-danger delete' + jmlAnalisis + '" style="display: none" onclick="del(\'' + jmlAnalisis + '\')"><i class="fa fa-times"></i></button>'+
                            '<button class="pull-right btn btn-xs btn-warning edit' + jmlAnalisis + '" style="display: none" onclick="edit(\'' + jmlAnalisis + '\')"><i class="fa fa-pencil"></i></button>'+
                        '</div>'+
                    '</div>'
            );
        }
        $(".total" + param).attr("disabled", "true");
        jmlAnalisis = jmlAnalisis + 1;
    }
    
    function save(param, saveEdit) {
//        updateOutput($('#nestable').data('output', $('#nestable-output')));
        $(".save" + param).attr("style", "display: none");
        $(".edit" + param).attr("style", "display: block");
        $(".delete" + param).attr("style", "display: block");
        $(".numb" + param).attr("disabled", "true");
        var temp = dataNumberAnalisis.length;
        var index = dataNumberAnalisis.indexOf(param);
        for (var i = 0; i < dataNumberAnalisis.length; i++) {
            if (dataNumberAnalisis[i] != param) {
                $(".save" + dataNumberAnalisis[i]).attr("style", "display: none");
                $(".edit" + dataNumberAnalisis[i]).attr("style", "display: block");
                $(".delete" + dataNumberAnalisis[i]).attr("style", "display: block");
            }
        }
        
        /*for kategori*/
        $(".kategori" + param).attr("style",
            "background:#fff;" +
            "border: solid 1px #ffffff;" +
            "font-weight: bold;" +
            "font-size: 20px;" +
            "padding:0"
        );

        if (saveEdit == 0) {
            var temp= Number(param)+1;
            $(".RAB" + param).after(
                '<li class="dd-item dd3-item RAB' + temp + '" data-id="' + temp + '">'+
                    '<div class="dd-handle dd3-handle fa fa-arrows-v"></div>'+
                    '<div class="dd3-content">'+
                        '<div class="col-md-1 pull-right" style="padding: 5px 0">'+
                            '<div class="btn-group">'+
                                '<button data-toggle="dropdown" class="btn btn-xs btn-info add' + temp + ' dropdown-toggle btn-xs" type="button"><i class="fa fa-plus"></i> <span class="caret"></span></button>'+
                                '<ul role="menu" class="dropdown-menu" style="margin-left: -125px">'+
                                    '<li><a onclick="add(\'' + temp + '\', \'kategori\')">Kategori</a></li>'+
                                    '<li><a onclick="add(\'' + temp + '\', \'pekerjaan\')">Pekerjaan</a></li>'+
                                '</ul>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</li>'
            );
        }
        else if(saveEdit == 1){
//            alert("edited");
        }
    }

</script>
<script>
    
    function edit(param, tipe) {
        $(".numb" + param).removeAttr("disabled");
        $(".save" + param).attr("style", "display: block");
        $(".save" + param).attr("onclick", "save('" + param + "','1')")
        $(".edit" + param).attr("style", "display: none");
        $(".delete" + param).attr("style", "display: none");
        $(".add" + param).attr("style", "display: none");
        $(".total" + param).attr("disabled", "true");
        var index = dataNumberAnalisis.indexOf(param);
        for (var i = 0; i < dataNumberAnalisis.length; i++) {
            if (dataNumberAnalisis[i] != param) {
                $(".edit" + dataNumberAnalisis[i]).attr("style", "display: none");
                $(".delete" + dataNumberAnalisis[i]).attr("style", "display: none");
            }
        }
        /*for kategori*/
        $(".kategori" + param).attr("style", "");
        if(tipe==1){
            $('.pekerjaan'+idAnalisa).attr("disabled", "true");
            $('.satuan'+idAnalisa).attr("disabled", "true");
            $('.harga'+idAnalisa).attr("disabled", "true");
        }
    }

    function del(param) {
        var temp = dataNumberAnalisis.indexOf(param);
        dataNumberAnalisis.splice(temp, 1);
        for (var i = 0; i < dataNumberAnalisis.length; i++) {
            var temp = i + 1;
            $(".counter" + dataNumberAnalisis[i]).text(temp);
        }
        $(".RAB" + param).remove();
//        updateOutput($('#nestable').data('output', $('#nestable-output')));
    }
    
    var idAnalisa=0;
    function check(param){
        var value= $('.tipe'+param).val();
        if(value=='analisa'){
            idAnalisa= param;
//            alert(value);
            $("#myModal").modal("show");
        }
        else {
//            alert("ls");
        }
    }
    
    function selectAnalisis(analisis_id, analisis_satuan, analisis_nama, analisis_total){
        $(".edit" + idAnalisa).attr("onclick", "edit('" + idAnalisa + "','1')")
        $('.pekerjaan'+idAnalisa).val(analisis_nama);
        $('.satuan'+idAnalisa).val(analisis_satuan);
        $('.harga'+idAnalisa).val(analisis_total);
        $('.pekerjaan'+idAnalisa).attr("disabled", "true");
        $('.satuan'+idAnalisa).attr("disabled", "true");
        $('.harga'+idAnalisa).attr("disabled", "true");
        $('.idAnalisis'+idAnalisa).val(analisis_id);
        $('.vol'+idAnalisa).val('');
    }
    
    function calculate(param){
        var volume= $('.vol'+idAnalisa).val();
        var harga= $('.harga'+idAnalisa).val();
        var total= Number(harga)*Number(volume);
        $('.total'+param).val(total);
    }
    
    function calculate2(param){
        var volume= $('.vol'+param).val();
        var harga= $('.harga'+param).val();
        var total= Number(harga)*Number(volume);
        $('.total'+param).val(total);
    }
</script>
