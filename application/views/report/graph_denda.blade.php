<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <?php $i=30;$y=40;$c=30;$d=12?>
        <script type="text/javascript">
$(function () {
    var chart;
    
    $(document).ready(function () {
        
        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Browser market shares at a specific website, 2010'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Jumlah Buku',
                data: [
                    ['Fiksi',  30 ],
                    ['Nonfiksi',      45],
                    {
                        name: 'Referensi',
                        y: 33,
                        sliced: true,
                        selected: true
                    },
                   
                    ['Pegangan Guru',    22],
                    ['Pelajaran',   15]
                ]
            }]
        });
    });
    
});
        </script>
    </head>
    <body>
<script src="../../js/highcharts.js"></script>
<script src="../../js/modules/exporting.js"></script>

<br>
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto">

</div>
    
    </body>
</html>
