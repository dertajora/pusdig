@layout('template.main')

@section('head')

   <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
      Google Visualization API Sample
    </title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
  

    <script type="text/javascript">
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Derta', 'Kuncung'],
          <?php echo "['Jan',";echo "500 ,";echo "200 ],";?>
          <?php echo "['Feb',";echo "300 ,";echo "500 ],";?>
          <?php echo "['Mar',";echo "100 ,";echo "400 ],";?>
          <?php echo "['Apr',";echo "500 ,";echo "50 ]";?>

        ]);

        var options = {
          title : 'Penampang Rincian Denda Bulanan',
          vAxis: {title: "Total Denda (Rp)"},
          hAxis: {title: "Bulan"},
          seriesType: "bars",
          series: {5: {type: "line"}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      google.setOnLoadCallback(drawVisualization);
    </script>
    
@endsection

@section('content')
 <?php echo "['Jan',";echo "100 ,";echo "500 ]";?>
    <table class="table table-bordered table-striped table-hover">

        <h3 align="center">Grafik Denda</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="/reports/denda" class="btn btn-warning">
              <i class="icon-pencil icon-white"></i>&nbsp&nbspRincian Denda</a> 
              
             

              
           </th>
          
           </tr> 
         
         </thead>
     </table>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  
@endsection 