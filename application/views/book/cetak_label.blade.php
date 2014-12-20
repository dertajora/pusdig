@layout('template.member')
@section('head')
<script>
    
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
</script>

<style type="text/css">
body {padding:30px}
.print-area {padding:1em;margin:0 0 1em}
</style>

 <style type="text/css">  
      td.thickBorder{ border: solid #000 1px;}  
    </style>
@endsection

@section('content')
<center>
  <h4>Halaman Konfirmasi Cetak Label Buku</h4>
</center>
<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
              <a data-toggle="modal" href="/books" class="btn btn-warning">
              <i class="icon-arrow-left icon-white"></i>&nbsp&nbspKembali</a>  
              
           </th>
          
          
            </tr>
         </thead>
       </font>
</table>


<a data-toggle="modal" href="javascript:printDiv('print-area-1');" class="pull-right btn btn-success">
<i class="icon-print icon-white"></i>&nbsp&nbspCetak Label Buku</a>


<div id="print-area-1" width="30px" class="print-area">

  
<table>
    <small>
    <tr><td border="1" style="width: 250px; BORDER-RIGHT: black solid; BORDER-TOP: black solid; BORDER-LEFT: black solid; BORDER-BOTTOM: black solid"><font face='Trebuchet MS' size='2'>&nbsp<h4 align="right"><?php echo $nib ;?></h4>
      <p align="right"><?php echo $akronim;?></p>
      <b><center>Perpustakaan Bina Tunas
      <br>
      SMA N 3 Pemalang</center></b></font> 
  </td>
  </small>
</tr>
</table>
 <br> 
<hr>
</div>


<textarea id="printing-css" style="display:none;"></textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<table class="table table-bordered table-striped table-hover">

     
              <thead>
              <tr>
              <th align="center" class="btn-info" colspan="10">
              <center>
             &nbsp
              </center>
              </th>
          
          
              </tr>
              </thead>
              </table>

@endsection