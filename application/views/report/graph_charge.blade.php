@layout('template.report')
@section('head')
 
       
    <script type="text/javascript">
$(function () {
        $('#container1').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Jumlah Perolehan Denda Bulanan Perpustakaan Bina Tunas'
            },
            subtitle: {
                text: 'SMA Negeri 3 Pemalang'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Banyaknya Denda (Dalam Rupiah)'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +'buku';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Denda',
                data: [<?php echo $januari;?>,<?php echo $februari;?>, <?php echo $maret;?>,
                       <?php echo $april;?>, <?php echo $mei;?>, <?php echo $juni;?>,
                       <?php echo $juli;?>, <?php echo $agustus;?>,<?php echo $september;?>,
                        <?php echo $oktober;?>, <?php echo $november;?>, <?php echo $desember;?>]
            }]
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
     <a data-toggle="modal" href="/reports/denda" class="btn btn-success">
              <i class="icon-arrow-left icon-white"></i>&nbsp&nbspKembali</a> 
              
    <br>
    <br>
    <br>

  <table class="table-hover">
   
   <tr><td><b>Perolehan Denda Tahun </b></td><td><?php echo"<b>"; echo $tahun; echo"</b>";?></td></tr></b>
   <tr><td>Januari</td><td><?php echo $januari;?></td></tr>
   <tr><td>Februari</td><td><?php echo $februari;?></td></tr>
   <tr><td>Maret</td><td><?php echo $maret;?></td></tr>
   <tr><td>April</td><td><?php echo $april;?></td></tr>
   <tr><td>Mei</td><td><?php echo $mei;?></td></tr>
   <tr><td>Juni</td><td><?php echo $juni;?></td></tr>
   <tr><td>Juli</td><td><?php echo $juli;?></td></tr>
   <tr><td>Agustus</td><td><?php echo $agustus;?></td></tr>
   <tr><td>September</td><td><?php echo $september;?></td></tr>
   <tr><td>Oktober</td><td><?php echo $oktober;?></td></tr>
   <tr><td>November</td><td><?php echo $november;?></td></tr>
   <tr><td>Desember</td><td><?php echo $desember;?></td></tr>


   <tr></tr>
   <tr></tr>

   <tr><td><b>Total Denda Tahun Ini </b></td><td><?php echo"<b>"; echo $total; echo"</b>";?></td> </tr>
  </table>
</td>
<td>
<br>

</div>
<div id="container1" style="min-width: 400px; height: 500px; margin: 0 auto">

</div>
</td>
</tr>
</table>
@endsection


