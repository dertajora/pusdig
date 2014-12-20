<?php $nilai = 3 ;
$cek = '';?>
@if ( $nilai == 1 )
     <?php $cek='disabled' ;?>
@elseif ( $nilai == 2 )
    An error occurred.
    <?php $cek='halo bos ini opsi kedua' ;?>
@else
    Did it work?
    <?php $cek='halo mas ganteng ini opsi ketiga' ?>
@endif

untuk menampilkan disabled nya <?php echo $cek;?>

<!--

           @foreach($borrows->results as $borrow)

                  <tr>
                  <td></td>
                  <td> {{$borrow->id}} </td>
                  <td> {{$borrow->borrow_id}} </td>
                  <td> {{$borrow->book_id}} </td>
                  <td> {{$borrow->status}} </td>
                  <td> {{$borrow->denda}} </td>
                  <td>  <a class="btn btn-info btn-small" href=""><i class="icon-edit icon-white"></i></a>
                  <a class="btn btn-danger btn-small" onclick="return confirm('Apakah anda yakin akan menghapus data anggota dengan nama  ?')" href=""><i class="icon-remove icon-white"></i></a></td>
           @endforeach
           </tr>
         -->

         /* $id = Input::get('id');
        $member = Member::find($id);
        //$borrows =  Transaction::where_id(1)->order_by('book_id','asc');
        
        if(is_null($member)) {

            return Redirect::to('transaction.pinjam');
        }
        return View::make('transaction.cek_peminjaman')
        //->with('borrows',$borrows)
        ->with('member',$member);*/
        
        

 //       return View::make('transaction.cek_peminjaman');