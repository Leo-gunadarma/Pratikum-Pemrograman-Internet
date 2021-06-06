@extends('template.admin-layout')
@section('css')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('courier-active')
active
@endsection
<?php
$data = array();
$data1 = array();
$pendapatan_bulanan = 0;
$pendapatan_tahunan = 0;
foreach ($report_graphic as $report) {
    if(date('Y',strtotime($report->tanggal)) == date('Y',strtotime(now())))
    {
        if(date('m',strtotime($report->tanggal)) == date('m',strtotime(now())))
        {
            $pendapatan_bulanan = $pendapatan_bulanan + $report->totally;
        }
        $pendapatan_tahunan = $pendapatan_tahunan + $report->totally;
        array_push($data, array("label"=> date("F Y", strtotime($report->tanggal)), "y"=> $report->totally));
    }
}
foreach($report_graphic1 as $report1){
    array_push($data1, array("label"=> date("Y", strtotime($report1->tanggal)), "y"=> $report1->totally));
}

?>
@section('content')
<h1 class="h3 text-dark">Report</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="font-weight-bold text-primary">Report Bulanan</h6>
    </div>
    <div class="card-body">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>

</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="font-weight-bold text-primary">Report Tahunan</h6>
    </div>
    <div class="card-body">
        <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
    </div>

</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="font-weight-bold text-primary">Summary</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless">
                <tr>
                    <td>Pendapatan bulan <?php echo date("F Y", strtotime(now())); ?></td>
                    <td>Rp.{{number_format($pendapatan_bulanan,2,',','.')}}</td>
                </tr>
                <tr>
                    <td>Pendapatan tahun <?php echo date("Y", strtotime(now())); ?></td>
                    <td>Rp.{{number_format($pendapatan_tahunan,2,',','.')}}</td>
                </tr>
            </table>
        </div>
    </div>

</div>


@endsection
@section('javascript')
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        title:{
            text: "Laporan Penjualan Bulanan"
        },
        axisY:{
            includeZero: true
        },
        data: [{
            type: "line", //change type to bar, line, area, pie, etc
            indexLabel: "{y}", //Shows y value on all Data Points
            indexLabelFontColor: "#5A5757",
            indexLabelPlacement: "inside",   
            dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
        }]
    });
        var chart1 = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        title:{
            text: "Laporan Penjualan Tahunan"
        },
        axisY:{
            includeZero: true
        },
        data: [{
            type: "line", //change type to bar, line, area, pie, etc
            indexLabel: "{y}", //Shows y value on all Data Points
            indexLabelFontColor: "#5A5757",
            indexLabelPlacement: "inside",   
            dataPoints: <?php echo json_encode($data1, JSON_NUMERIC_CHECK); ?>
        }]
    });
chart.render();
chart1.render();
 
}
    </script>
@endsection
