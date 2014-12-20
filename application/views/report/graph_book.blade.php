@layout('template.report')
@section('head')
 
       
       
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
                text: 'Presentase Jumlah Koleksi Buku Perpustakaan Bina Tunas'
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
                    ['Fiksi', <?php echo $fiksi?> ],
                    ['Nonfiksi',    <?php echo $nonfiksi?>],
                    {
                        name: 'Referensi',
                        y: <?php echo $referensi?>,
                        sliced: true,
                        selected: true
                    },
                   
                    ['Pegangan Guru',    <?php echo $guru?>],
                    ['Pelajaran',   <?php echo $pelajaran?>]
                ]
            }]
        });
    });
    
});
        </script>

<script src="../../js/highcharts.js"></script>
<script src="../../js/modules/exporting.js"></script>
@endsection
@section('content')
<Br>
<table class="table "><tr>
  <td>
     <a value="Derta" data-toggle="modal" href="/reports/new_entry" class="btn btn-success"></a>
              <i class="icon-arrow-left icon-white"></i>&nbsp&nbspKembali</a> 
              
    <br>
    <br>
    <br>

  <table class="table-striped table-hover">
   <tr><td><b>Rincian Koleksi Buku</b></td><td></td></tr>
   <tr><td>Jumlah Buku Fiksi</td><td><?php echo $fiksi;?></td></tr>
   <tr><td>Jumlah Buku Nonfiksi</td><td><?php echo $nonfiksi;?></td></tr>
   <tr><td>Jumlah Buku Referensi</td><td><?php echo $referensi;?></td></tr>
   <tr><td>Jumlah Buku Pegangan guru</td><td><?php echo $guru;?></td></tr>
   <tr><td>Jumlah Buku Pelajaran</td><td><?php echo $pelajaran;?></td></tr>
   
   <tr></tr>
   <tr></tr>

   <tr><td><b>Total Koleksi Buku</b></td><td><?php echo"<b>"; echo $total; echo"</b>";?></td> </tr>
  </table>
</td>
<td>
<br>
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto">

</div>
</td>
</tr>
</table>
@endsection


