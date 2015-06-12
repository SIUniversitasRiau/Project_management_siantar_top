<!-- JS -->
<script src="<?php echo site_url()?>assets/default/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="<?php echo site_url()?>assets/default/js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="<?php echo site_url()?>assets/default/js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->
<script src="<?php echo site_url()?>assets/default/js/jquery.slimscroll.min.js"></script> <!-- jQuery Slim Scroll -->
<script src="<?php echo site_url()?>assets/default/js/jquery.dataTables.min.js"></script> <!-- Data tables -->
<script src="<?php echo site_url()?>assets/default/md5/md5.min.js"></script> <!-- Javascript md5 -->
<!-- jQuery Flot -->
<script src="<?php echo site_url()?>assets/default/js/excanvas.min.js"></script>
<script src="<?php echo site_url()?>assets/default/js/jquery.flot.js"></script>
<script src="<?php echo site_url()?>assets/default/js/jquery.flot.resize.js"></script>
<script src="<?php echo site_url()?>assets/default/js/jquery.flot.pie.js"></script>
<script src="<?php echo site_url()?>assets/default/js/jquery.flot.stack.js"></script>

<!-- jQuery Notification - Noty -->
<script src="<?php echo site_url()?>assets/default/js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="<?php echo site_url()?>assets/default/js/themes/default.js"></script> <!-- jQuery Notify -->
<script src="<?php echo site_url()?>assets/default/js/layouts/bottom.js"></script> <!-- jQuery Notify -->
<script src="<?php echo site_url()?>assets/default/js/layouts/topRight.js"></script> <!-- jQuery Notify -->
<script src="<?php echo site_url()?>assets/default/js/layouts/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<script src="<?php echo site_url()?>assets/default/js/sparklines.js"></script> <!-- Sparklines -->
<script src="<?php echo site_url()?>assets/default/js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="<?php echo site_url()?>assets/default/js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="<?php echo site_url()?>assets/default/js/jquery.onoff.min.js"></script> <!-- Bootstrap Toggle -->
<script src="<?php echo site_url()?>assets/default/js/filter.js"></script> <!-- Filter for support page -->
<script src="<?php echo site_url()?>assets/default/js/custom.js"></script> <!-- Custom codes -->
<!--<script src="<?php echo site_url()?>assets/default/js/custom_detailProject.js"></script>  Custom codes -->
<script src="<?php echo site_url()?>assets/default/js/charts.js"></script> <!-- Charts & Graphs -->

<!-- Script for this page -->
<script type="text/javascript">
//$(function () {
//
//    /* Bar Chart starts */
//
//    var d1 = [];
//    for (var i = 0; i <= 20; i += 1)
//        d1.push([i, parseInt(Math.random() * 30)]);
//
//    var d2 = [];
//    for (var i = 0; i <= 20; i += 1)
//        d2.push([i, parseInt(Math.random() * 30)]);
//
//
//    var stack = 0, bars = true, lines = false, steps = false;
//    
//    function plotWithOptions() {
//        $.plot($("#bar-chart"), [ d1, d2 ], {
//            series: {
//                stack: stack,
//                lines: { show: lines, fill: true, steps: steps },
//                bars: { show: bars, barWidth: 0.8 }
//            },
//            grid: {
//                borderWidth: 0, hoverable: true, color: "#777"
//            },
//            colors: ["#ff6c24", "#ff2424"],
//            bars: {
//                  show: true,
//                  lineWidth: 0,
//                  fill: true,
//                  fillColor: { colors: [ { opacity: 0.9 }, { opacity: 0.8 } ] }
//            }
//        });
//    }
//
//    plotWithOptions();
//    
//    $(".stackControls input").click(function (e) {
//        e.preventDefault();
//        stack = $(this).val() == "With stacking" ? true : null;
//        plotWithOptions();
//    });
//    $(".graphControls input").click(function (e) {
//        e.preventDefault();
//        bars = $(this).val().indexOf("Bars") != -1;
//        lines = $(this).val().indexOf("Lines") != -1;
//        steps = $(this).val().indexOf("steps") != -1;
//        plotWithOptions();
//    });
//
//    /* Bar chart ends */
//});
//
//
///* Curve chart starts */
//
//$(function () {
//    var sin = [], cos = [];
//    for (var i = 0; i < 14; i += 0.5) {
//        sin.push([i, Math.sin(i)]);
//        cos.push([i, Math.cos(i)]);
//    }
//
//    var plot = $.plot($("#curve-chart"),
//           [ { data: sin, label: "sin(x)"}, { data: cos, label: "cos(x)" } ], {
//               series: {
//                   lines: { show: true, fill: true},
//                   points: { show: true }
//               },
//               grid: { hoverable: true, clickable: true, borderWidth:0 },
//               yaxis: { min: -1.2, max: 1.2 },
//               colors: ["#1eafed", "#1eafed"]
//             });
//
//    function showTooltip(x, y, contents) {
//        $('<div id="tooltip">' + contents + '</div>').css( {
//            position: 'absolute',
//            display: 'none',
//            top: y + 5,
//            left: x + 5,
//            border: '1px solid #000',
//            padding: '2px 8px',
//            color: '#ccc',
//            'background-color': '#000',
//            opacity: 0.9
//        }).appendTo("body").fadeIn(200);
//    }
//
//    var previousPoint = null;
//    $("#curve-chart").bind("plothover", function (event, pos, item) {
//        $("#x").text(pos.x.toFixed(2));
//        $("#y").text(pos.y.toFixed(2));
//
//        if ($("#enableTooltip:checked").length > 0) {
//            if (item) {
//                if (previousPoint != item.dataIndex) {
//                    previousPoint = item.dataIndex;
//                    
//                    $("#tooltip").remove();
//                    var x = item.datapoint[0].toFixed(2),
//                        y = item.datapoint[1].toFixed(2);
//                    
//                    showTooltip(item.pageX, item.pageY, 
//                                item.series.label + " of " + x + " = " + y);
//                }
//            }
//            else {
//                $("#tooltip").remove();
//                previousPoint = null;            
//            }
//        }
//    }); 
//
//    $("#curve-chart").bind("plotclick", function (event, pos, item) {
//        if (item) {
//            $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
//            plot.highlight(item.series, item.datapoint);
//        }
//    });
//
//});

/* Curve chart ends */

</script>

<!-- nestable starts -->
<script src="<?= site_url().'assets/default/js/' ?>jquery.nestable.js"></script>
<script>
//    var valueChange= $('#nestable-output').val();
//    /*nestable starts*/
//    var updateOutput = function(e)
//    {
//        var list = e.length ? e : $(e.target),
//                output = list.data('output');
//        if (window.JSON) {
//            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
//        } else {
//            output.val('JSON browser support required for this demo.');
//        }
//    };
//    
//    $('#nestable').nestable({
//        group: 2,
//        maxDepth: 2
//    }).on('change', updateOutput);
//    
//    // output initial serialised data
//    updateOutput($('#nestable').data('output', $('#nestable-output')));
//    
//    
//    $('#nestable-menu').on('click', function(e)
//    {
//        var target = $(e.target),
//                action = target.data('action');
//        if (action === 'expand-all') {
//            $('.dd').nestable('expandAll');
//        }
//        if (action === 'collapse-all') {
//            $('.dd').nestable('collapseAll');
//        }
//    });
//
//    $('#nestable').nestable();
    /*nestable ends*/
</script>
<!-- nestable ends -->