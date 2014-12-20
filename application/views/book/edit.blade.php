@layout('template.book')
@section('head')

<script>
        $(document).ready(function (){
            $("#penerbit").change(function() {
                // foo is the id of the other select box 
                if ($(this).val() == "baru") {
                    $("#penerbitbaru").show();
                }else{
                    $("#penerbitbaru").hide();
                } 
            });
        });
</script>

<script type="text/javascript">
function findselected() {
    var type = document.getElementById('type_id');
    var kelas = document.getElementById('kelas');
    var ddc = document.getElementById('ddc');
    if(type.value == '1') 
        kelas.disabled = true,
        ddc.disabled = true 
    else
        kelas.disabled = false,
        ddc.disabled = false  
}

</script>
@endsection

@section('content')
<center>
	<h3>Halaman Ubah Data Buku</h3>

<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
              <a data-toggle="modal" href="/books" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspKoleksi Buku</a>  
              
           </th>
          <center>

          </center>
          
            </tr>
         </thead>
</table>
<h5 color="yellow" align="right"><i>Ubah Data Buku dengan NIB {{ $book->id}} </i></h5>




{{Form::open('books/update/'.$book->id,'POST' ,array('data-validate' => 'parsley'))}}

              <center>
              <table>
              

              <tr>  
              <td>  
              Judul *
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="judul" value="{{ $book->judul; }}" data-required="true"/><br /></td>

             
              </tr>


              <tr>
              <td>
              Tanggal terima *</td>
              <td>  
              : 
              </td>
              <td>
                <input type="date" name="tgl_terima" value="{{ $book->tgl_terima; }}"  data-required="true"/>
                </td>
               
              </tr>
              <tr>  
              <td>  
              Pengarang *
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="pengarang" data-required="true" value="{{ $book->pengarang; }}"/></td>
               
              </tr>
              <tr>  
              <td>  
              Penerbit *
              </td>
              <td>  
              : 
              </td>
              <td>
              <?php

              mysql_connect('localhost', 'root', '');
              mysql_select_db('pusdig');

              $sql = "SELECT id,nama FROM publishers order by nama";
              $result = mysql_query($sql); 
              echo "<select id='penerbit' name='penerbit' data-required='true'>";
              echo "<option></option>";
              echo "<option value='baru'>Lainnya</option>";
              
              $cek_penerbit=$book->publisher_id;
              while ($row = mysql_fetch_array($result)) {
                  $cek = $row['id'];
                  if ($cek == $cek_penerbit){
                     $opsi = 'selected';
                     echo "<option value='". $cek."'selected >" . $row['nama'] . "</option>";
                  } else {
                  echo "<option value='" . $cek. "' >" . $row['nama'] . "</option>";}
              }
              echo "</select>";

              ?>

               </td>
              
              </tr>
              <tr>
              <td></td><td></td>
              <td><input type="text" style="display:none" id='penerbitbaru' placeholder="Penerbit baru . . ." name="penerbitbaru"/></td>  
              </tr>
             
              <tr>  
              <td>  
              Kategori *
              </td>
              <td>  
              : 
              </td>
              <td>
              <?php $cek2= $book->type_id;
              $opsi1 =null;
              $opsi2 =null;              
              $opsi3 =null;
              $opsi4 =null;
              $opsi5 =null;

             
              if ($cek2=='1'){
                $opsi1 = 'selected';}
              elseif ($cek2 == '2') {
                $opsi2 = 'selected';
              }  
              elseif ($cek2 == '3') {
                $opsi3 = 'selected';
              }  
              elseif ($cek2 == '4') {
                $opsi4 = 'selected';
              }  
               elseif ($cek2 == '5') {
                $opsi5 = 'selected';
              }  
              ?>
              <select id="type_id" name="type_id" data-required="true" onChange="findselected()">
                <option></option>
                <option value="1" <?php echo $opsi1;?>>Fiksi</option>
                <option value="2" <?php echo $opsi2;?>>Non Fiksi</option>
                <option value="3" <?php echo $opsi3;?>>Referensi</option>
                <option value="4" <?php echo $opsi4;?>>Pegangan Guru</option>
                <option value="5" <?php echo $opsi5;?>>Buku Pelajaran</option>
           
               </select></td> 
             

              </tr>
              <tr>  
              <td>  
              Kelas
              </td>
              <td>  
              : 
              </td>
              <td>
              <?php
              $disable_kelas =''; 
              $cek_kategori= $book->type_id; //untuk mengetahui kategori buku
              if ($cek_kategori == 1){
                $disable_kelas = 'disabled'; //untuk mendisable ketika kategori fiksi
              }

              $sql = "SELECT id,kelas FROM classifications";
              $result = mysql_query($sql); 
              echo "<select id='kelas' name='kelas'".$disable_kelas.">";
              echo "<option></option>";
              $cek_kelas=$book->kelas;
              while ($row = mysql_fetch_array($result)) {
                  $cek = $row['kelas'];
                  if ($cek == $cek_kelas){
                     $opsi = 'selected';
                     echo "<option value='". $cek."'selected >" . $row['kelas'] . "</option>";
                  } else {
                  echo "<option value='" . $cek. "' >" . $row['kelas'] . "</option>";}
              }
              echo "</select>";

              ?>

               </td></tr>
              
              <tr>  
              <td>  
              DDC
              </td>
              <td>  
              : 
              </td>
              <?php $ddc=$book->ddc;
              if ($ddc==null){
                  $ddc='';
              }?>
              <td><input type="text" id="ddc" name="ddc" <?php echo $disable_kelas;?>  value="<?php echo $ddc;?>"><br /></td>
            
              </tr> 
              <tr>  
              <td>  
              Sumber
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="sumber" value="{{ $book->sumber; }}"><br /></td>
             
              </tr>
              <tr>  
              <td>  
              Jumlah Halaman *&nbsp&nbsp
              </td>
              <td>  
              : &nbsp&nbsp
              </td>
              <td><input type="text" name="halaman" value="{{ $book->jml_halaman; }}" data-required="true" data-type="digits"><br /></td>
              
             
              </tr> 
              
              <tr>  
              <td>  
              Ukuran
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="ukuran" value="{{ $book->ukuran; }}"><br /></td>
             
              </tr>
              
           
              
              
              <tr><td></td><td></td><td>* Wajib diisi</td></tr>
              </table>
              </center>
              <table class="table table-bordered table-striped table-hover">

     
              <thead>
              <tr>
              <th align="center" class="btn-info" colspan="10">
              <center>
              {{ Form::submit('&nbsp; &nbsp; Update &nbsp; &nbsp;', array('class' => 'btn btn-primary')) }}
              </center>
              </th>
          
          
              </tr>
              </thead>
              </table>

             <!-- <input type="submit" name="add_author" value="Create"/> -->

              
             {{Form::close()}}
@endsection