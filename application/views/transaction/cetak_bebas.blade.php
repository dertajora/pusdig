@layout('template.transaction')
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
@endsection

@section('content')
<center>
  <h4>Halaman Konfirmasi Cetak Kartu Bebas Pustaka</h4>
</center>
<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
              <a data-toggle="modal" href="/transactions/bebas_pustaka" class="btn btn-warning">
              <i class="icon-arrow-left icon-white"></i>&nbsp&nbspKembali</a>  
              
           </th>
          
          
            </tr>
         </thead>
</table>


<a data-toggle="modal" href="javascript:printDiv('print-area-1');" class="pull-right btn btn-success">
<i class="icon-print icon-white"></i>&nbsp&nbspCetak Kartu Bebas</a>


<div id="print-area-1" width="30px" class="print-area">
<hr>
<table><font face='Trebuchet MS' size='2'><tr>
  <td style="width: 50px;">
  </td>
  <td style="width: 50px;">
  <center><img  src="{{ URL::to_asset('tutwuri.jpg') }}" alt=""></img></center> 
  </td>
  <td style="width: 250px;">
  <center><b><font face='Trebuchet MS' size="3px">Kartu Bebas Pustaka</font></b><br>
  <font face='Trebuchet MS' >Perpustakaan Bina Tunas<br>
  <font face='Trebuchet MS'><b>SMA Negeri 3 Pemalang</b>
  </td>
  <td style="width: 50px;">
  <img  src="{{ URL::to_asset('smanty.jpg') }}" alt=""></img>
  </font></td>
  </tr>
  </table>
  <br>
  

  <table width="75%"><font face='Trebuchet MS'>
  <tr>
  <td style="width: 38% ">
  NIS Anggota
  </td>
  <td style="width: 2% ">:</td>
  <td style="width: 40 %">{{ $member->id}}</td>
  </tr>
  <tr><td>
  Nama
  </td>
  <td>:</td>
  <td>{{ $member->nama}}</td>
  </tr>
   <tr><td>
  Kelas / Angkatan
  </td>
  <td>:</td>
  <?php $class=$member->class_id;
  $kelas = DB::table('class')->where('id','=',$class)->only('nama');
  ?>
  <td>{{ $kelas}} / {{ $member->angkatan}} </td>
  </tr>
  
  </table>
  <Br>
  
<p align="justify" width="100px">&nbsp&nbsp&nbsp&nbspDengan kartu ini, anggota dinyatakan tidak memiliki tanggungan pinjaman di<br>  Perpustakaan &nbsp&nbsp Bina &nbspTunas SMA N 3 Pemalang dan telah memenuhi persyaratan <br>bebas pustaka.</p>
 
 <table><font face='Trebuchet MS' size='2'><tr>
  <td style="width: 50px;">
  </td>
  <td style="width: 50px;">
  </td>
  <td style="width: 50px;">
  </td>
  <td style="width: 50px;">
  </td>
  <td style="width: 50px;">
  </td>
  <td style="width: 50px;">
  </td>
   <td style="width: 20px;">
  </td>
  
  
  
  <td style="width: 200px;">
  Disahkan  <?php echo $tgl_baru?></td></tr>
  <tr>
  <td style="width: 50px;">
  <br><br><br><br><br></td>
  <td style="width: 50px;">
  </td>
  <td style="width: 50px;">
  </td>
  <td style="width: 50px;">
  </td>
  <td style="width: 50px;">
  </td>
  <td style="width: 50px;">
  </td>
   <td style="width: 20px;">
  </td>
  
  
  
  <td style="width: 200px;">
 Petugas</td></tr>
</table>
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