<?php
//============================================================+
// File name   : v-list-siswa.php
// Begin       : 2017-03-08
// Last Update : -
//
// Description : List pagination siswa
//               Untuk menggantikan v-daftar-siswa yg berupa datatable
//
// Author: MrBebek
//
// (c) Copyright:
//               MrBebek
//               neonjogja.com

//============================================================+

/**
 * @author MrBebek
 * @since  2017-03-08
 */

?>


<!-- <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>"> -->
<section id="main" role="main">
 <div class="col-md-12">
  <div class="row">
   <div class="panel panel-default">
    <div class="panel-heading">
     <h4 class="panel-title">Daftar Siswa</h4>
     <!--    Trigger the modal with a button -->

     <a href="<?= base_url('index.php/siswa/daftarsiswa') ?>" title="Tambah Data" type="button" class="btn btn-default pull-right " style="margin-top:-30px;" ><i class="ico-plus"></i></a>

     <!--  <a data-toggle="modal" class="btn btn-default pull-right"  "  data-target="#myModal">Tambah</a> -->
    </div>
    <!-- Funsi cari  -->
    <div class=" pull-right">
     <input id="carisoal" type="text" name="keyword" class="form-control" placeholder="Search...">
    </div>

    <!-- Funsi cari -->
    <input type="text" name="page" value="<?=$this->uri->segment('3')?>" hidden="true">
    <table class="daftarsiswa table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
     <thead>
      <tr>
       <th>no</th>
       <th>Nama Lengkap</th>
       <th>Nama Pengguna</th>
       <th>Sekolah</th>
       <th>Email</th>
       <th>Cabang Neutron</th>
       <th>Mentor</th>
       <th>Aksi</th>
      </tr>
     </thead>

     <tbody>
      <?php 
      $no = $this->uri->segment('3') + 1;
      foreach ($siswa as $key): ?>
      <tr>
       <td><?=$no;?></td>
       <td><?=$key["nama"];?></td>
       <td><?=$key["namaPengguna"];?></td>
       <td><?=$key["namaSekolah"];?></td>
       <td><?=$key["eMail"];?></td>
       <td><?=$key["cabang"];?></td>
       <td><?=$key["idsiswa"];?></td>
       <td><?=$key["aksi"];?></td>
      </tr>
      <?php 
      $no++;
      endforeach ?>

     </tbody>
    </table>
    <nav aria-label="Page navigation mt10 pt10"><center>
     <ul class="pagination ">
      <?php 

      echo $this->pagination->create_links();

      ?>
     </ul>
    </center>
   </nav>
  </div>
 </div>
</div>
</section>
<!-- on keypres cari soal -->


<script type="text/javascript">

 $(document).ready(function() { 
  var site = "<?php echo site_url();?>";
  $( "#carisoal" ).autocomplete({
   source:  site+"/siswa/autocompleteSiswa",
   select: function (event, ui) {
    source:  site+"/siswa/autocompleteSiswa",
    window.location = ui.item.url;
   }
  });

 });
</script>
<script type="text/javascript">
 var page=base_url+"siswa/listSiswa/"+$("input[name=page]").val();

 function dropSiswa(idsiswa, idpengguna) {
  if (confirm('Apakah Anda yakin akan menghapus data ini? ')) {
            // ajax delete data to database
            $.ajax({
             url: base_url + "index.php/siswa/deleteSiswa/" + idsiswa + "/" + idpengguna,
             data: "idsiswa=" + idsiswa + "&idpengguna=" + idpengguna,
             type: "POST",
             dataType: "TEXT",
             success: function (data, respone)
             {
              window.location.href =page;
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
              alert('Error deleting data');
                    // console.log(jqXHR);
                    // console.log(textStatus);
                    console.log(errorThrown);
                   }
                  });
           }
          }

          function reload_tblist() {
           tb_siswa.ajax.reload(null, false);
          }

    // function resetPassword11(idsiswa, idpengguna) {
    //     if (confirm('Apakah Anda yakin akan me-reset katasandi ini? ')) {
    //         // ajax delete data to database
    //         $.ajax({
    //             url: base_url + "index.php/siswa/resetPassword/",
    //             data: "idsiswa=" + idsiswa + "&idpengguna=" + idpengguna,
    //             type: "POST",
    //             dataType: "TEXT",
    //             success: function (data, respone)
    //             {
    //                  window.location.href =page;
    //             },
    //             error: function (jqXHR, textStatus, errorThrown)
    //             {
    //                 alert('Error deleting data');
    //                 console.log(errorThrown);
    //             }
    //         });
    //     }
    // }

    function resetPassword(idpengguna){
     url = base_url + "index.php/siswa/resetPassword/";
     swal({
      title: "Yakin akan me-reset katasandi ini?",
      text: "Anda tidak dapat membatalkan ini.",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya,Tetap me-reset katasandi!",
      closeOnConfirm: false
     },
     function(){
      var datas = {idpengguna:idpengguna};
      $.ajax({
       dataType:"text",
       data:datas,
       type:"POST",
       url:url,
       success:function(){
        swal("kata sandi baru : [namaPengguna]+[tgl sekarang] !", "katasandi lama: aa , tgl: 29 => katasandi: aa29 ", "success");
       // window.location.href =base_url+"videoback/daftarvideo";
      },
      error:function(){
       sweetAlert("Oops...", "Ktasandi gagal di reset!", "error");
      }

     });
     });
    }

   </script>
