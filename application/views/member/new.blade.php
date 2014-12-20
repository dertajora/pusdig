@layout('template.member')
@section('content')

<h3 align="center">Halaman Tambah Anggota</h3> 

<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
              <a data-toggle="modal" href="/members" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Anggota</a>  
              
           </th>
          
          
            </tr>
         </thead>
</table>

<!--<?php 
//$i=0;
##ini untuk mendisable form
//if ($i!=0){
//$cek ='disabled';
//} else {
//$cek = '';
//} ;


?>-->


{{Form::open('members/create','POST',array('data-validate' => 'parsley'))}}

              <center>
              <table>

              <tr>  
              <td>  
              NIS *
              </td>
              <td>  
              : 
              </td>
              <td><input id="searchtiga" type="text" name="nis" data-required="true" data-maxlength="4" data-minlength="4" data-type="digits" autofocus/><br /></td>

              <td><ul id="resultstiga"></ul></td>
              </tr>
               
              <tr>  
              <td>  
              Nama *
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="nama" data-required="true"/><br /></td>

              
              </tr>
              <tr>  
              <td>  
              Kelas *
              </td>
              <td>  
              : 
              </td>
              <td>
              <?php

              mysql_connect('localhost', 'root', '');
              mysql_select_db('pusdig');

              $sql = "SELECT id,nama FROM class";
              $result = mysql_query($sql);

              echo "<select name='kelas' data-required='true'>";
              echo "<option></option>";
              while ($row = mysql_fetch_array($result)) {
                  echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
              }
              echo "</select>";

              ?>
               </td></tr>
              <tr>  
              <td>  
              Tahun Masuk *
              </td>
              <td>  
              : 
              </td>
              <td>
              <select name="angkatan" data-required="true">
                <option></option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
           
           
               </select></td></tr>

              <tr>
              <td>
              Kelamin * </td>
              <td>  
              : 
              </td>
              <td>
                <label class="radio">
                <input type="radio" name="kelamin" id="optionsRadios1" value="L" checked>Laki-laki
              </label>
                <label class="radio">
                <input type="radio" name="kelamin" id="optionsRadios1" value="P">Perempuan
                </label>
                
              </td>
              <td></td>
               </tr>
              
              <tr>  
              <td>  
              Tempat Lahir *
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="tempat_lahir" data-required="true"  /></td>

               
             
              <tr>  

              <td>   
              Tanggal Lahir *&nbsp&nbsp&nbsp
              </td>
              <td>  
              : &nbsp&nbsp
              </td>
              <td><input type="date" name="tgl_lahir" data-required="true" /><br /></td>
  
              </tr> 
              <tr>  
              <td>  
              Alamat
              </td>
              <td>  
              : 
              </td>
              <td><textarea name="alamat"></textarea><br /></td>
              <td>
             
              </tr>
              <tr>  
             
              <td><input type="hidden" value="aktif" name="status"/></td></tr>
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