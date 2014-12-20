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
<h3 align="center">Halaman Tambah Buku</h3> 
<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
              <a data-toggle="modal" href="/books" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspKoleksi Buku</a>  
              
           </th>
          
          
            </tr>
         </thead>
</table>


{{Form::open('books/create','POST' ,array('data-validate' => 'parsley'))}}

              <center>
              <table>
              <tr>  
              <td>  
              Jumlah *
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" id="jumlah" name="jumlah" data-required="true" data-type="digits" autofocus/><br /></td>

              
              </tr>  

              <tr>  
              <td>  
              Judul *
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="judul" data-required="true"/><br /></td>

              
              </tr>

              <tr>  
              <td>  
              NIB Awal *
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" id="searchem" name="id" data-required="true" data-type="digits"/><br /></td>
              
          
              </tr>
              <tr><td></td><td></td><td><ul id="resulsempat"></ul></td></tr>
              <tr>
              <td>
              Tanggal Terima * </td>
              <td>  
              : 
              </td>
              <td>
                <input type="date" name="tgl_terima"  data-required="true" />
                </td>
                 
              
              </tr>
              <tr>  
              <td>  
              Pengarang *
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="pengarang" data-required="true"/></td>
               
              </tr>
              
              <tr>
              <td>Penerbit *</td>  
              <td>  
              : 
              </td>
              <td>
              <?php

              mysql_connect('localhost', 'root', '');
              mysql_select_db('pusdig');

              $sql = "SELECT id,nama FROM publishers order by nama";
              $result = mysql_query($sql);

              echo "<select id ='penerbit' name='penerbit' data-required='true'>";
              echo "<option></option>";
              echo "<option value='baru'>Lainnya</option>";
              while ($row = mysql_fetch_array($result)) {
                  echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
              }
              echo "</select>";

              ?>
              </td>

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
              <select id="type_id" name="type_id" data-required="true" onChange="findselected()">
                <option></option>
                <option value="1">Fiksi</option>
                <option value="2">Non Fiksi</option>
                <option value="3">Referensi</option>
                <option value="4">Pegangan Guru</option>
                <option value="5">Buku Pelajaran</option>
           
               </select></td> 
             

               </tr>
              <tr>
              <td>Kelas </td>  
              <td>  
              : 
              </td>
              <td>
              <select id="kelas" name="kelas" >
                <option></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
           
               </select>
              </td>
              </tr>

              
              <tr>  
              <td>  
              DDC
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" id="ddc" name="ddc"><br /></td>
            
              </tr> 
              <tr>  
              <td>  
              Sumber
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="sumber"><br /></td>
             
              </tr>
              <tr>  
              <td>  
              Jumlah Halaman *&nbsp&nbsp
              </td>
              <td>  
              : &nbsp&nbsp
              </td>
              <td><input type="text" name="halaman" data-type="digits"><br /></td>
              
              </tr> 
              
              <tr>  
              <td>  
              Ukuran
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="ukuran"><br /></td>
             
              </tr>
              
              <tr><td></td><td></td><td>* Wajib diisi</td></tr>
              </table>
              </center>
              <table class="table table-bordered table-striped table-hover">

     
              <thead>
              <tr>
              <th align="center" class="btn-info" colspan="10">
              <center>
              {{ Form::submit('&nbsp; &nbsp; Create &nbsp; &nbsp;', array('class' => 'btn btn-primary')) }}
              </center>
              </th>
          
          
              </tr>
              </thead>
              </table>

             <!-- <input type="submit" name="add_author" value="Create"/> -->

              
             {{Form::close()}}

@endsection