<div class="modal fade " tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document" style="background: white">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>

      <div class="modal-body">
        <table class="table table-bordered listsoal" style="font-size: 13px">
         <thead>
          <tr>
           <th >ID Soal</th>
           <th >Nama Soal</th>
           <th>Isi Soal</th>
         </tr>
       </thead>
       <form>
        <tbody id="tbpaket">

        </tbody>                                   
      </form>
    </table>
  </div>

  <div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn btn-primary">Close</a>
  </div>

</div>
</div><!-- /.modal-content -->
</div>

<div>
 <!-- Strt ROW -->
 <div class="row">
  <div class="container">
   <!--START LIST PAKET dan SISWA -->
   <div class="panel panel-inverse">
    <div class="panel-heading">
     <h3 class="panel-title text-center">Nama Tryout : <?=$nm_to ?></h3>
   </div>
   <!-- Start Panel Body ALL -->
   <div class="panel-body">
     <!-- END LIST paket n siswa yang sudah dia ADD -->
     <div class="col-md-6">
      <div class="panel panel-teal">
       <div class="panel-heading">
        <h3 class="panel-title">Daftar Yang Akan DI Tambahkan Ke Try</h3>
        <input type="text" name="id" id="id_to" value="<?=$id_to;?>" hidden='true' >
      </div>
      <!-- Start Panel Body -->
      <div class="panel-body">
        <div>
         <ul class="nav nav-tabs">
          <li class="active"><a href="#paket" data-toggle="tab">Paket</a></li>
          <li><a href="#siswa" data-toggle="tab">Siswa</a></li>
        </ul>
      </div>
      <!-- Star Tab Content -->
      <div class="tab-content">
       <!-- Start Tab pane Paket -->

       <div class="tab-pane active"  id="paket">

        <table class="table table-bordered" style="font-size: 13px">
         <thead>
          <tr>
           <th> <input type="checkbox" name="checkall"></th>
           <th >ID</th>
           <th>Nama paket</th>
           <th>Deskripsi</th>
           <th>Lihat</th>
         </tr>
       </thead>
       <form>
        <tbody id="tbpaket">

        </tbody>                                   
      </form>
    </table>
    <!-- end -->
    <!-- START PESAN ERROR EMPTY INPUT -->
    <div class="alert alert-dismissable alert-danger" id="msg_e_paket" hidden="true">
     <button type="button" class="close" onclick="hide_msg_e_paket()" >×</button>
     <strong>O.M.G.!</strong> Silahkan pilih Paket yang akan di UJIANKAN.
   </div>
   <!-- END PESAN ERROR EMPTY INPUT -->
   <!--START PESAN BERHASIL PAKET DI ADD KE TO -->
   <div class="alert alert-dismissable alert-success" id="msg_s_paket" hidden="true" >
     <button type="button" class="close" onclick="hide_msg_s_paket()" >×</button>
     <strong>Well done!</strong> Paket telah di tambahkan ke Try Out.
   </div>
   <!--END PESAN BERHASIL PAKET DI ADD KE TO  -->
 </div>
 <!-- End Tab pane Paket -->
 <!-- Start Tab pane Siswa -->
 <div class="tab-pane" id="siswa">
  <!-- START TABEL SISWA --><br>
  <br>
  <table class="table table-bordered" style="font-size: 13px" id="siswaBlmTo" width="100%">
   <thead>
    <tr>
     <th width="10%"><input type="checkbox" name="checkall_siswa"></th>
     <th>ID</th>
     <th>Nama Lengkap</th>
     <th>Cabang</th>
   </tr>
 </thead>
 <tbody id="tbsiswa">

 </tbody>
 <tfoot>
   <th><i class="ico-search2 text-center"></i></th>
   <th><input class="form-control" type="text" placeholder="ID" /></th>
   <th><input class="form-control" type="text" placeholder="Nama Lengkap Siswa" /></th>
   <th><input class="form-control" type="text" placeholder="Cabang" /></th>
 </tfoot>
</table>
<!-- END TABEL SISWA -->
<!-- START PESAN ERROR EMPTY INPUT -->
<div class="alert alert-dismissable alert-danger" id="msg_e_siswa" hidden="true">
 <button type="button" class="close" onclick="hide_msg_e_siswa()" >×</button>
 <strong>O.M.G.!</strong> Silahkan pilih siswa yang akan mengikuti UJIAN.
</div>
<!-- END PESAN ERROR EMPTY INPUT -->
<!--START PESAN BERHASIL SISWA DI ADD KE TO -->
<div class="alert alert-dismissable alert-success" id="msg_s_siswa" hidden="true" >
 <button type="button" class="close" onclick="hide_msg_s_siswa()" >×</button>
 <strong>Well done!</strong> SISWA telah di tambahkan ke Try Out.
</div>
<!--END PESAN BERHASIL SISWA DI ADD KE TO  -->

</div>
<!-- Start Tab pane Paket -->
</div>
<!-- END Tab Content -->
<!-- Start Footer -->
<div class="panel-footer">
 <button class="btn btn-primary add">ADD</button>
</div>
<!-- END FOOTER -->
</div>
<!-- END Panel Body -->


</div>
</div>
<!--END LIST PAKET dan SISWA -->
<!-- ########################################### -->
<!-- START LIST paket n siswa yang sudah dia ADD -->
<div class="col-md-6">
  <div class="panel panel-teal">
   <div class="panel-heading">
    <h3 class="panel-title">Daftar Soal</h3>
  </div>
  <!-- Start Panel Body -->
  <div class="panel-body">
    <div>
     <ul class="nav nav-tabs">
      <li class="active"><a href="#paketadd" data-toggle="tab">Paket</a></li>
      <li><a href="#siswaadd" data-toggle="tab">Siswa</a></li>
    </ul>
  </div>

  <div class="tab-content">
   <!-- START LIST Paket yang sudah di ADD -->
   <div class="tab-pane active" id="paketadd">
    <div class="panel panel-default">
     <div class="panel-heading">
      <h3 class="panel-title">Soal Yang Ditambahkan</h3>
    </div>
    <div class="panel-body soaltambah">
      <form action="" id="">
       <table class="table table-striped" id="listaddpaket" style="font-size: 13px" width="100%">
        <thead>
         <tr>
          <th>ID</th>
          <th>Nama Paket</th>
          <th>Deskripsi</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>

      </tbody>
    </table>

  </form>
</div>
</div>
</div>
<!-- END LIST Paket yang sudah di ADD  -->

<!-- START LIST SISWA yang sudah di ADD -->
<div class="tab-pane" id="siswaadd">
  <!-- Start tabel siswa add to -->
  <div class="panel panel-default">
   <div class="panel-heading">
    <h3 class="panel-title">Siswa yang akan mengikuti TO</h3>
  </div>
  <div class="panel-body soaltambah">
    <!-- START TABEL SISWA YG SUDAH DI ADD -->
    <form action="" id="">
     <table class="table table-striped" id="tblist_siswa" style="font-size: 13px" width="100%">
      <thead>
       <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Tingkat</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>

    </tbody>

  </table>

</form>
<!-- END TABEL SISWA YG SUDAH DI ADD  -->

</div>
</div>
<!-- END tabel siswa add to -->
</div>
<!-- LIST Siswa yang sudah di ADD -->
</div>

</div>
<!-- END Panel Body -->
</div>         
</div>
<!-- END LIST paket n siswa yang sudah dia ADD -->       
</div>
<!-- END PANEL Body ALL -->
</div>     
</div>
<!-- END CONTAINER -->
</div>
<!-- END ROW -->
</div>


<script type="text/javascript">
 var tblist_paket;
 var tblist_siswa;
 var tblist_paketAdd;
 var tblist_siswaAdd;
 var idTo =$('#id_to').val();
 var listsoal;

    // Script for getting the dynamic values from database using jQuery and AJAX


    $(document).ready(function() {
      //check all paket
      $('input[name=checkall]').click(function(){
        if(this.checked) {
          $('#tbpaket td input[type=checkbox]').prop('checked', true);
        }else{
          $('#tbpaket td input[type=checkbox]').prop('checked', false);
        }
      });
      //####---

      // Check all siswa
      $('input[name=checkall_siswa]').click(function(){
        if(this.checked) {
          $('#siswaBlmTo td input[type=checkbox]').prop('checked', true);
        }else{
          $('#siswaBlmTo td input[type=checkbox]').prop('checked', false);
        }
      });
      //####---



      $('#siswaBlmTo tfoot th').first().append("");

      tblist_siswa = $('#siswaBlmTo').DataTable({ 
       "ajax": {
        "url": base_url+"index.php/toback/ajax_list_siswa_belum_to/"+idTo,
        "type": "POST"
      },
      "processing": true,
      "bDestroy": true,
    });

      tblist_paket = $('#paket table').DataTable({ 
       "ajax": {
        "url": base_url+"index.php/toback/ajax_list_all_paket/"+idTo,
        "type": "POST"
      },
      "processing": true,
      "bDestroy": true,
    });

        // tabel paket yang sudah di add ke to
        tblist_paketAdd = $('#listaddpaket').DataTable({ 
         "ajax": {
          "url": base_url+"index.php/toback/ajax_listpaket_by_To/"+idTo,
          "type": "POST"
        },
        "processing": true,
        "bDestroy": true,
      });


        // tabel siswa yang akan mengokuti ujian
        tblist_siswaAdd = $('#tblist_siswa').DataTable({ 
         "ajax": {
          "url": base_url+"index.php/toback/ajax_listsiswa_by_To/"+idTo,
          "type": "POST"
        },
        "processing": true,
        "bDestroy": true,
      });

    // Setup - add a text input to each footer cell
    // $('#siswaBlmTo tfoot th').each( function () {
    //     var title = $(this).text();
    //     $(this).html( '<input class="form-control" type="text" placeholder="Search '+title+'" />' );
    // } );

tblist_siswa.columns().every( function () {
  var that = this;
  $( 'input', this.footer() ).on( 'keyup change', function () {
    if ( that.search() !== this.value ) {
      that
      .search( this.value )
      .draw();
    }
  } );
} );




});

function reload_tblist(){
 tblist_siswaAdd.ajax.reload(null,false);
 tblist_paketAdd.ajax.reload(null,false); 
 tblist_paket.ajax.reload();
 tblist_siswa.ajax.reload();

        //reload datatable ajax 
       // 
     }

    // function reload_listsiswa(){
    //     tblist_siswa.reload(null,false);
    // }
    function adda() {

     $('.add').click(function(){ 
      addPaket();
      addSiswa();
    });

   }
   function hide_msg_e_siswa() 
   {
     $("#msg_e_siswa").hide();
   }
   function hide_msg_e_paket() 
   {
     $("#msg_e_paket").hide();
   }
   function hide_msg_s_paket()
   {
     $("#msg_s_paket").hide();
   }
   function hide_msg_s_siswa()
   {
     $("#msg_s_siswa").hide();
   }
   function addPaket(){
     var idpaket = [];
     var id_to =$('#id_to').val();
     var test ='test';
     $('#tbpaket input:checked').each(function(i){
      idpaket[i] = $(this).val();
    });
     $('#tbpaket input').attr('checked',false);

     if (idpaket.length > 0) {
      var url = base_url+"index.php/toback/addPaketToTO";

      $.ajax({
       url : url,
       type: "POST",
       data: {idpaket:idpaket,
        id_to:id_to 
      },
                // cache: false,
              // dataType: "JSON",
              success: function(data,respone)
              {   

               reload_tblist();
               $("#msg_e_paket").hide();
               $("#msg_s_paket").show();
               $(':checkbox').attr('checked',false);

             },
             error: function (jqXHR, textStatus, errorThrown)
             {


               alert('Error adding / update data');
             }
           });
    }else{
      $("#msg_s_paket").hide();
      $("#msg_e_paket").show();
    }




        // console.log(idpaket);
        id_paket=null;
      }
      function addSiswa(){
        var idsiswa = [];
        var id_to =$('#id_to').val();
        $('#tbsiswa input:checked').each(function(i){
         idsiswa[i] = $(this).val();
       });
        $('#tbsiswa input').attr('checked',false);

        if (idsiswa.length > 0) {
         var url = base_url+"index.php/toback/addsiswaToTO";

         $.ajax({
          url : url,
          type: "POST",
          data: {idsiswa : idsiswa,
           id_to:id_to 
         },
                // cache: false,
              // dataType: "JSON",
              success: function(data,respone)
              {   
               reload_tblist();
               $(':checkbox').attr('checked',false);
               $("#msg_s_siswa").show();
               $("#msg_e_siswa").hide();

             },
             error: function (jqXHR, textStatus, errorThrown)
             {


               swal('Error adding / update data');
             }
           });
       } else {
         $("#msg_s_siswa").hide();
         $("#msg_e_siswa").show();
       }




       idsiswa=null;

     }
     function get_data_json(data){
      // tableku = $('.modal-body table').dataTable();
      $('#myModal').modal('show');  

      
      listsoal = $('.listsoal').dataTable({
        data:data.data,
        "language": {
          "emptyTable": "Tidak Ada Soal",
          
        },
        "bDestroy": true,
      });
    }
    function lihatsoal(id){
      // var hasil_ajax = new Object();
      $.ajax({
        url : base_url+"index.php/paketsoal/get_soal_byid_paket/"+id,
        type: "POST",
        dataType:"JSON",
        success: function(data,respone)
        {  
          // alert(data);
          get_data_json(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          swal('Error Retrieve');
        }});
    }
    // function delete paket to to
    function dropPaket(idKey) {
     var id_to =$('#id_to').val();
     if (confirm('Apakah Anda yakin akan menghapus data paket? ')) {
               // ajax delete data to database
               $.ajax({
                url : base_url+"index.php/toback/dropPaketTo/"+idKey,
                type: "POST",
                dataType: "TEXT",
                success: function(data,respone)
                {  
                        //if success reload ajax table
                        // $('#modal_form').modal('hide');
                        reload_tblist();
                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                        swal('Error deleting data');
                        // console.log(jqXHR);
                        // console.log(textStatus);
                        console.log(errorThrown);
                      }
                    });
             }
           }


           function dropSiswa(idKey) {
            var id_to =$('#id_to').val();
            if (confirm('Apakah Anda yakin akan menghapus data siswa? ')) {
               // ajax delete data to database
               $.ajax({
                url : base_url+"index.php/toback/dropSiswaTo/"+idKey,
                type: "POST",
                dataType: "TEXT",
                success: function(data,respone)
                {  
                  reload_tblist();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                  swal('Error deleting data');
                        // console.log(jqXHR);
                        // console.log(textStatus);
                        console.log(errorThrown);
                      }
                    });
             }
           }


           adda();


         </script>