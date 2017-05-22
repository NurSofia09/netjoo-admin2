 <!-- START ROW -->

 <div class="row">



  <div class="col-md-12">

   <!--START Panel  -->

   <div class="panel panel-inverse">

    <div class="panel-heading">

     <h3 class="panel-title"><?=$panelheading ?></h3>

   </div>

   <!-- Start Panel Body -->

   <div class="panel-body">

     <div class="row">

      <!--Start Container  -->

      <div class="container">

       <!-- Strat -->

       <div class="col-sm-11">

        <!-- start -->

        <div class="panel panel-teal">

         <div class="panel-heading">

           <h3 class="panel-title">Daftar Soal</h3>

           <input type="text" name="id" id="id_paket" value="<?=$id_paket;?>" hidden="true">

         </div>

         <!-- Start -->

         <div class="panel-body">

          <form action="#" id="formsoal">

           <div class="form-group">

            <div class="col-sm-12">

             <div class="col-sm-2">

              Filter:

            </div>

            <div class="row">

              <div class="row-col-sm-12">

               <div class="col-sm-4">

                <select name="" id="tingkatID" class="form-control">

                 <option value="">Tingkat</option>

               </select>

             </div>

             <div class="col-sm-4">

              <select name="" id="pelajaranID" class="form-control">

               <option value="">Pelajaran</option>

             </select>

             <br>

           </div>

         </div>

         <div class="col-sm-12">

           <div class="col-sm-2">



           </div>



           <div class="row">

            <div class="row-col-sm-12">

             <div class="col-sm-4">

              <select name="" id="babID" class="form-control">

               <option value="">Bab</option>

             </select>

           </div>



           <div class="col-sm-4">

            <select name="" id="subBabId" class="form-control">

             <option value="">Sub Bab</option>

           </select>

         </div>

       </div>

     </div>



   </div>

 </div>

</div>

<div class="col-sm-12">

 <br><br><br>

</div>

<div class="col-sm-12">

 <div class="col-sm-12">Soal:</div>

 <div class="col-md-12">



 </div>

 <div class="col-sm-12">

  <form >

   <table class="table table-striped" id="oplistsoal"  style="font-size: 13px">

    <thead>

     <tr>

      <th>/</th>

      <th>Judul Soal</th>

      <th>Sumber</th>

      <th>SOAL</th>

      <th>Level</th>

    </tr>

  </thead>



  <tbody class="soal">



  </tbody>

</table>

</form>

<!-- START PESAN ERROR EMPTY INPUT -->

<div class="swal swal-dismissable swal-danger" id="emptyinput_op" hidden="true">

  <button type="button" class="close" onclick="hide_msg_empty()" >×</button>

  <strong>O.M.G.!</strong> Silahkan pilih soal yang akan ditambahkan ke paket.

</div>

<!-- END PESAN ERROR EMPTY INPUT -->

<!--START PESAN BERHASIL PAKET DI ADD KE TO -->

<div class="swal swal-dismissable swal-success" id="msg_s_soal" hidden="true" >

  <button type="button" class="close" onclick="hide_msg_s_soal()" >×</button>

  <strong>Well done!</strong> Soal telah di tambahkan ke Paket.

</div>

<!--END PESAN BERHASIL PAKET DI ADD KE TO  -->

</div>

<div class="col-sm-12 btn">

  <div class="col-sm-2">

   <br>

   <input class="btn btn-primary tambahsoal" type="button" value="tambahkan soal"/>

 </div>

</div>



</div>

</div>

</form>



</div>



<!-- END -->



</div>



<!-- END -->

</div>

<!-- ENd -->



<!-- Strat -->

<div class="col-sm-11">

  <div class="panel panel-teal">

   <div class="panel-heading">

    <h3 class="panel-title">Daftar Soal yang Telah di Tambahkan</h3>

  </div>

  <div class="panel-body soaltambah">

    <form action="" id="">

     <table class="table table-striped" id="tblist" style="font-size: 13px">

      <thead>

       <tr>

        <th>IDs</th>

        <th>Judul Soal</th>

        <th>Sumber</th>

        <th>SOAL</th>

        <th>Level</th>

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

<!-- END -->



</div>

<!-- END container -->

</div>

</div>

<!-- END Panel Body -->

</div>    

<!--END Panel  -->

</div>



</div>

<!-- END ROW --> 





<script>

  //declare global variable
  console.log(base_url+"index.php/paketsoal/get_validasi/"+<?=$this->uri->segment(3) ?>);
  var tblist_soal;

  var list_soal;

  var paket = $('#id_paket').val();

  //##



  $(document).ready(function() {

   var id_paket =$('#id_paket').val();

     //# ketika tingkat di change

     $('#TingkatID').change(function() {

       var form_data = {

        name: $('#TingkatID').val()

      };



      $.ajax({

        url: "<?php echo site_url('videoback/getPelajaran'); ?>",

        type: 'POST',
        dataType: "json",

        data: form_data,

        dataType:'text',

        success: function(msg) {

         var sc='';

         $.each(msg, function(key, val) {

          sc+='<option value="'+val.id+'">'+val.keterangan+'</option>';

        });

         $("#pelajaranID option").remove();

         $("#pelajaranID").append(sc);

       }

     });

    });



        // get list soal by id paket

        tblist_soal = $('#tblist').DataTable({ 

         "processing": true,

         "ajax": {

          "url": base_url+"index.php/paketsoal/ajax_listsoal/"+id_paket,

          "type": "POST"

        },



      });



      });



//# buat load tingkat

function loadTingkat(){

 jQuery(document).ready(function(){

  var tingkat_id = {"tingkat_id" : $('#tingkatID').val()};

  var idTingkat;

  $.ajax({

   type: "POST",
   dataType: "json",

   data: tingkat_id,

   url: "<?= base_url() ?>index.php/videoback/getTingkat",



   success: function(data){

    $('#tingkatID').html('<option value="">Tingkat</option>');

    $.each(data, function(i, data){

     $('#tingkatID').append("<option value='"+data.id+"'>"+data.aliasTingkat+"</option>");

     return idTingkat=data.id;

   });

  }

});

//##



// # ketika option di ganti

$('#tingkatID').change(function(){

 tingkat_id={"tingkat_id" : $('#tingkat').val()};

 load_pelajaran($('#tingkatID').val());

 $('.soal').empty();

 $('pelajaranID').empty();

});



$('#pelajaranID').change(function(){

 pelajaran_id = {"pelajaran_id":$('#pelajaranID').val()};

 loadbab($('#pelajaranID').val());

 $('.soal').empty();

});



$('#babID').change(function(){

 bab_id = {"bab_id":$('#babID').val()};

 loadsubbab($('#babID').val());

 $('.soal').empty();



});



$('#subBabId').change(function(){

 $('.soal').empty();



 var idSubBab = $('#subBabId').val();

 if (idSubBab=="") {

  swal('Pilih Bab Matapelajaran');

}else{

  addsoal(idSubBab);

};

});

// ######



//# Ketika tombol soal di klik

$('.tambahsoal').click(function(){

 tambahkansoal();

});

})};

//##



 //# buat load pelajaran

 function load_pelajaran(tingkatID){

   $.ajax({

    type: "POST",
    dataType: "json",

    data: tingkatID.tingkat_id,



    url: "<?php echo base_url() ?>index.php/videoback/getPelajaran/"+tingkatID,

    success: function(data){

     $('#pelajaranID').html('<option value="">Mata Pelajaran</option>');

     $.each(data, function(i, data){

      $('#pelajaranID').append("<option value='"+data.id+"'>"+data.keterangan+"</option>");

    });

   }

 });

 }

//##



//#buat load bab

function loadbab(mapelID){
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "<?php echo base_url() ?>index.php/videoback/getBab/"+mapelID,
    success: function(data){
      $('#babID').html('<option value="">Bab Pelajaran</option>');
      $.each(data, function(i, data){
        $('#babID').append("<option value='"+data.id+"'>"+data.judulBab+"</option>");
      });
    } 
  });
}

//##



// # load sub bab

function loadsubbab(babID) {
 $.ajax({
  type: "POST",
  dataType: "json",
  data: babID.bab_id,
  url: "<?php echo base_url() ?>index.php/videoback/getSubbab/" + babID,
  success: function (data) {


   $('#subBabId').html('<option value="">-- Pilih Sub Bab Pelajaran  --</option>');
   $.each(data, function (i, data) {
    $('#subBabId').append("<option value='" + data.id + "'>" + data.judulSubBab + "</option>");
  });
 }
});
}

// ##





//# Load soal ke tabel yang belum ada

function addsoal(subBabId){
  var url = base_url+"index.php/paketsoal/ajax_unregistered_soal/"+paket+"/"+subBabId;
  console.log(url);
  list_soal = $('#oplistsoal').DataTable({ 
   "ajax": {
    "url": url,
    "type": "POST"
  },
  destroy: true,
  searching: false
});
}
// ##



//#menambahkan soal ke paket tertentu.

function tambahkansoal(){
  var idsoal = [];
  var idSubBab = $('#subBabId').val();
  var id_paket =$('#id_paket').val();

  $(':checkbox:checked').each(function(i){
   idsoal[i] = $(this).val();
 }); 
  if (idsoal.length > 0) {
    var url = base_url+"index.php/paketsoal/addsoaltopaket";
    $.ajax({
     url : url,
     type: "POST",
     dataType:'text',
     data: {data:idsoal,
      idSubBab:idSubBab,
      id_paket:id_paket},
      success: function(data,respone)
      {   
        reload_tblist();
        $(':checkbox').attr('checked',false);
        $("#emptyinput_op").hide();
        $("#msg_s_soal").show();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
       swal('Error adding / update data');
     }
   });
  } else {
    $("#msg_s_soal").hide();
    $("#emptyinput_op").show();
  }
}

//###



//#fungsi hide message empty
function hide_msg_empty(){
 $("#emptyinput_op").hide();
}
// ##



//# fungsi hide msg soal
function hide_msg_s_soal() {
  $("#msg_s_soal").hide();
}
// ##



//#fungsi reload
function reload_tblist(){
  tblist_soal.ajax.reload();
        list_soal.ajax.reload(); //reload datatable ajax 
      }

//##



//# Drop soal from paket.

function drop_soal(id){
  console.log(base_url+"index.php/paketsoal/dropsoalpaket/"+id);
  if(confirm('Are you sure delete this data?')){
    $.ajax({
     url : base_url+"index.php/paketsoal/dropsoalpaket/"+id,
     type: "POST",
     dataType: "TEXt",
     success: function(data)
     {
      reload_tblist();
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      swal('Error deleting data');
    }
  });
  }
}


function cek_soal(){
  $.ajax({
   url : base_url+"index.php/paketsoal/get_validasi/"+<?=$this->uri->segment(3) ?>,
   type: "POST",
   success: function(data){
      console.log(data);
  } ,
  error: function (jqXHR, textStatus, errorThrown)
  {
    swal('Error data');
  }
});
}
//##

loadTingkat();
// console.log(cek_soal());
cek_soal();
</script>