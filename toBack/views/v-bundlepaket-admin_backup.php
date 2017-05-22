  <!-- NEATED BY OPIK SUTISNA PUTRA -->
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
             <th >NO Soal</th>
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


<!-- Strt ROW -->
<div class="row">
  <div class="container">
   <!--START LIST PAKET dan SISWA -->
   <div class="panel panel-inverse mr10 ml10 ">
    <div class="panel-heading">
     <h3 class="panel-title text-center">Nama Tryout : <?=$nm_to ?></h3>
   </div>
   <!-- Start Panel Body ALL -->
   <div class="panel-body">
     <!-- END LIST paket n siswa yang sudah dia ADD -->
     <div class="col-md-12">
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
          <li><a href="#pengawas" data-toggle="tab">Pengawas</a></li>
        </ul>
      </div>
      <!-- Star Tab Content -->
      <div class="tab-content">
       <!-- Start Tab pane Paket -->
       <div class="tab-pane active"  id="paket">

        <table class="table table-bordered" style="font-size: 13px">
         <thead>
          <tr>
           <th width="12px"> <input type="checkbox" name="checkall"></th>
           <th >No</th>
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

   <div class="col-md-12" >
    <!-- div setting record -->
    <div class="col-md-2 mb2 mt10 pl0">
      <div  class="form-group">
        <select  class="form-control" name="records_per_page">
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </div>
    </div>
    <!-- /div setting record -->
    <!-- div pencarian  -->
    <div class="col-md-10 mb10 mt10 pr0">
      <div class="input-group">
       <span class="input-group-addon btn" id="cari_siswa"><i class="ico-search"></i></span>
       <input class="form-control" type="text" name="cari_siswa" placeholder="Cari Data">
     </div>
   </div>
   <!-- div pencarian -->
 </div>

 <!-- START TABEL SISWA --><br>
 <br>
 <table class="table table-bordered" style="font-size: 13px" id="siswaBlmTo" width="100%">
   <thead>
    <tr>
     <th  width="12px"><input type="checkbox" name="checkall_siswa"></th>
     <th>No</th>
     <th>Nama Pengguna</th>
     <th>Nama Siswa</th>
     <th>Cabang</th>
     <th>Tingkat</th>
   </tr>
 </thead>
 <tbody id="tbsiswa">

 </tbody>
 <tfoot>
   <th colspan="2"><i class="ico-search2 text-center"></i></th>
   <!-- <th><input class="form-control" type="text" placeholder="No" /></th> -->
   <th><input class="form-control" name="nama_pengguna_search"type="text" placeholder="Nama Pengguna" /></th>
   <th><input class="form-control" name="nama_siswa_search"type="text" placeholder="Nama Siswa" /></th>
   <th><input class="form-control" name="cabang_search"type="text" placeholder="Cabang" /></th>
   <th><input class="form-control" name="tingkat_search"type="text" placeholder="Tingkat" /></th>
 </tfoot>
</table>
<div class="col-md-12">
  <ul class="pagination pagination-siswa">

  </ul>
</div>
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
<!-- Start Tab pane Siswa -->
<!-- Start Tab pane Pengawas -->
<div class="tab-pane "  id="pengawas">

  <table class="table table-bordered" style="font-size: 13px">
   <thead>
    <tr>
     <th> <input type="checkbox" name="checkall"></th>
     <th >No</th>
     <th>Nama Pengwas</th>
     <th>Alamat</th>
   </tr>
 </thead>
 <form>
  <tbody id="tbpengawas">

  </tbody>                                   
</form>
</table>
<!-- end -->
<!-- START PESAN ERROR EMPTY INPUT -->
<div class="alert alert-dismissable alert-danger" id="msg_e_pengawas" hidden="true">
 <button type="button" class="close" onclick="hide_msg_e_pengawas()" >×</button>
 <strong>O.M.G.!</strong> Silahkan pilih pengawas.
</div>
<!-- END PESAN ERROR EMPTY INPUT -->
<!--START PESAN BERHASIL PAKET DI ADD KE TO -->
<div class="alert alert-dismissable alert-success" id="msg_s_pengawas" hidden="true" >
 <button type="button" class="close" onclick="hide_msg_s_pengawas()" >×</button>
 <strong>Well done!</strong> Pengawas telah di tambahkan ke Try Out.
</div>
<!--END PESAN BERHASIL PAKET DI ADD KE TO  -->
</div>
<!-- End Tab pane pengawas -->
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
<div class="col-md-12">
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
      <li><a href="#pengawasadd" data-toggle="tab">pengawas</a></li>
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
          <th>No</th>
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
        <th>No</th>
        <th>Nama Pengguna</th>
        <th>Nama Siswa</th>
        <th>Cabang</th>
        <th>Tingkat</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>

    </tbody>
    <tfoot>
     <th><input class="form-control" type="text" placeholder="No" /></th>
     <th><input class="form-control" type="text" placeholder="Nama Pengguna" /></th>
     <th><input class="form-control" type="text" placeholder="Nama Siswa" /></th>
     <th><input class="form-control" type="text" placeholder="Cabang" /></th>
     <th><input class="form-control" type="text" placeholder="Tingkat" /></th>
     <th>Aksi</th>
   </tfoot>
 </table>

</form>
<!-- END TABEL SISWA YG SUDAH DI ADD  -->

</div>
</div>
<!-- END tabel siswa add to -->
</div>
<!-- LIST Siswa yang sudah di ADD -->
<!-- List pengawas yg di beri akses -->
<div class="tab-pane" id="pengawasadd">
  <!-- Start tabel siswa add to -->
  <div class="panel panel-default">
   <div class="panel-heading">
    <h3 class="panel-title">Siswa yang akan mengikuti TO</h3>
  </div>
  <div class="panel-body soaltambah">
    <!-- START TABEL SISWA YG SUDAH DI ADD -->
    <form action="" id="">
     <table class="table table-striped" id="tblist_pengawas" style="font-size: 13px" width="100%">
      <thead>
       <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>

    </tbody>

  </table>

</form>
<!-- END TABEL Pengawas YG SUDAH DI ADD  -->

</div>
</div>
<!-- END tabel Pengawas add to -->
</div>

<!-- End List pengawas yg di beri akses -->
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



<script type="text/javascript">
 var tblist_paket;
 var tblist_siswa;
 var tblist_pengawas;
 var tblist_paketAdd;
 var tblist_siswaAdd;
 var tblist_pengawasAdd;
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

$('#siswaBlmTo tfoot th').first().append("");

// tblist_siswa = $('#siswaBlmTo').DataTable({ 
//  "ajax": {
//   "url": base_url+"index.php/toback/ajax_list_siswa_belum_to/"+idTo,
//   "type": "POST"
// },
// "processing": true,
// "bDestroy": true,
// });

tblist_paket = $('#paket table').DataTable({ 
 "ajax": {
  "url": base_url+"index.php/toback/ajax_list_all_paket/"+idTo,
  "type": "POST"
},
"processing": true,
"bDestroy": true,
});

tblist_paket = $('#pengawas table').DataTable({ 
 "ajax": {
  "url": base_url+"index.php/toback/ajax_list_all_pengawas/"+idTo,
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

// tabel pengawas yang diberi akses TO
tblist_pengawasAdd = $('#tblist_pengawas').DataTable({ 
 "ajax": {
  "url": base_url+"index.php/toback/ajax_listpengawas_by_To/"+idTo,
  "type": "POST"
},
"processing": true,
"bDestroy": true,
});

});

function reload_tblist(){
 tblist_siswaAdd.ajax.reload(null,false);
 tblist_paketAdd.ajax.reload(null,false); 
 tblist_pengawasAdd.ajax.reload(null,false); 
 tblist_paket.ajax.reload();
 tblist_pengawas.ajax.reload();
}

function adda() {
 $('.add').click(function(){ 
  addPaket();
  addSiswa();
  addPengawas();
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
function hide_msg_e_pengawas() 
{
 $("#msg_e_pengawas").hide();
}
function hide_msg_s_paket()
{
 $("#msg_s_paket").hide();
}
function hide_msg_s_siswa()
{
 $("#msg_s_siswa").hide();
}
function hide_msg_s_pengawas()
{
 $("#msg_s_pengawas").hide();
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
  success: function(data,respone)
  {   
   tblist_siswaAdd.ajax.reload(null,false);
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
   success: function(data,respone)
   {   
     set_tb_siswa();
     tblist_siswaAdd.ajax.reload(null,false);
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

// add pengawas
function addPengawas(){
  var idpengawas = [];
  var id_to =$('#id_to').val();
  $('#tbpengawas input:checked').each(function(i){
   idpengawas[i] = $(this).val();
 });
  $('#tbpengaws input').attr('checked',false);

  if (idpengawas.length > 0) {
   var url = base_url+"index.php/toback/addpengawasToTO";

   $.ajax({
    url : url,
    type: "POST",
    data: {idpengawas : idpengawas,
     id_to:id_to 
   },
   success: function(data,respone){   
     reload_tblist();
     $(':checkbox').attr('checked',false);
     $("#msg_s_pengawas").show();
     $("#msg_e_pengawas").hide();

   },
   error: function (jqXHR, textStatus, errorThrown){
     swal('Error adding / update data');
   }
 });
 } else {
   $("#msg_s_pengawas").hide();
   $("#msg_e_pengawas").show();
 }
 idpengawas=null;
}

function get_data_json(data){
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
  $.ajax({
    url : base_url+"index.php/paketsoal/get_soal_byid_paket/"+id,
    type: "POST",
    dataType:"JSON",
    success: function(data,respone){  
      get_data_json(data);
    },
    error: function (jqXHR, textStatus, errorThrown){
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
  success: function(data,respone){  
    reload_tblist();
  },
  error: function (jqXHR, textStatus, errorThrown){
    swal('Error deleting data');
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
    success: function(data,respone){  
      reload_tblist();
    },
    error: function (jqXHR, textStatus, errorThrown){
      swal('Error deleting data');
      console.log(errorThrown);
    }
  });
}
}

function dropPengawas(idKey) {
  var id_to =$('#id_to').val();
  if (confirm('Apakah Anda yakin akan menghapus data siswa? ')) {
    // ajax delete data to database
    $.ajax({
      url : base_url+"index.php/toback/dropPengawasTo/"+idKey,
      type: "POST",
      dataType: "TEXT",
      success: function(data,respone)
      {  
        reload_tblist();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        swal('Error deleting data');
        console.log(errorThrown);
      }
    });
  }
}


adda();
</script>

<script>
// pagination untuk siswa
var properties = {
  'dataTable':null,
  'meridian':4,
  'prev':1,
  'next':2,
  'records_per_page':10,
  'status':"null",
  'masa_aktif':"all",
  'page':0,
  'page_val':"",
  'key_search':"",
  'url':null,
  'tb_siswa':null,
  'page_select':0,
  'datas':null,
  'search_single':false,
  'key_single':"",
  'key_word':"",
};
// pagination untuk siswa

// fungsi set ke table
function set_tb_siswa(){
  $('#tbsiswa').append('<div class="indicator show"><span class="spinner"></span></div>');
  param = {
   masa_aktif:properties.masa_aktif,
   status:properties.status,
   records_per_page:properties.records_per_page,
   page_select:properties.page_select,
   key_search:properties.key_search,
   search_single:properties.search_single,
   key_single:properties.key_single,
   key_word:properties.key_word
 };

 url=base_url+"toback/ajax_pagination_siswa_nonto/"+idTo;

 $.ajax({
  url:url,
  data:param,
  dataType:"text",
  type:"post",
  success:function(Data)
  {
    tb_siswa = JSON.parse(Data);
    $('#tbsiswa').empty();
    $('#tbsiswa').append(tb_siswa);
  },
  error:function(e,jqXHR, textStatus, errorThrown)
  {
   sweetAlert("Oops...", e, "error");
 }
});
}
// end set ke table

// Pagination
function pagination_siswa() {
  param = {
   masa_aktif:properties.masa_aktif,
   status:properties.status,
   records_per_page:properties.records_per_page,
   page_select:properties.page_select,
   key_search:properties.key_search,
   search_single:properties.search_single,
   key_single:properties.key_single,
   key_word:properties.key_word
 };
 $.ajax({
  url:base_url+"toback/pagination_siswa/"+idTo,
  data:param,
  type:"POST",
  dataType:"TEXT",
  success:function(data){
    $('.pagination-siswa').empty();
    $('.pagination-siswa').append(JSON.parse(data));
  },error:function(){
    swal('Gagal pagination');
  }
});
}
  // Pagination

// next page
function nextPage() {
  selectPage(next);
}

// prev page
function prevPage() {
  selectPage(prev);
}

function selectPage(pageVal='0') {
  $('#tbsiswa').append('<div class="indicator show"><span class="spinner"></span></div>');
  page=pageVal;
  pageSelek=page*properties.records_per_page;
  // 
  $('#record_token').empty();
  param = {
   masa_aktif:properties.masa_aktif,
   status:properties.status,
   records_per_page:properties.records_per_page,
   page_select:pageSelek,
   search_single:properties.search_single,
   key_single:properties.key_single,
   key_word:properties.key_word,
   key_search:properties.key_search
 };
 $('#tbsiswa').empty();

 url=base_url+"toback/ajax_pagination_siswa_nonto/"+idTo;
 $.ajax({
  url:url,
  data:param,
  dataType:"text",
  type:"post",
  success:function(Data)
  {
    tb_siswa = JSON.parse(Data);
    $('#tbsiswa').empty();
    $('#tbsiswa').append(tb_siswa);
  },
  error:function(e,jqXHR, textStatus, errorThrown)
  {
   sweetAlert("Oops...", e, "error");
 }
});

//meridian adalah nilai tengah padination
$('#page-'+properties.meridian).removeClass('active');
var newMeridian=page+1;
var loop;
var hidePage;
var showPage;
if (newMeridian<=4) {
  $("#page-prev").addClass('hide');
  //banyak pagination yg akan di tampilkan dan sisembunyikan
  loop=properties.meridian-newMeridian;
  // start id pagination yg akan ditampilkan
  var idPaginationshow =1;
  // start id pagination yg akan sembunyikan
  var idPaginationhide =9;
  prev=1;
  next=7;
  //lakukan pengulangan sebanyak loop
  for (var i = 0; i < loop; i++) {
    hidePagination='#page-'+idPaginationhide;
    showPagination='#page-'+idPaginationshow;
    //pagination yg di hide
    $(showPagination).removeClass('hide');
    //pagination baru yg ditampilkan
    $(hidePagination).addClass('hide');
    idPaginationshow++;
    idPaginationhide--;
  }
}else if( newMeridian>properties.meridian){
  $("#page-prev").removeClass('hide');
    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=newMeridian-properties.meridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =newMeridian+3;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =properties.meridian-3;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#page-'+idPaginationhide;
      showPagination='#page-'+idPaginationshow;
    //pagination yg di hide
    $(showPagination).removeClass('hide');
    //pagination baru yg ditampilkan
    $(hidePagination).addClass('hide');
    idPaginationshow--;
    idPaginationhide++;
  }
}else{
  //banyak pagination yg akan di tampilkan dan sisembunyikan
  loop=properties.meridian-newMeridian;
  // start id pagination yg akan ditampilkan
  var idPaginationshow =newMeridian-3;
  // start id pagination yg akan sembunyikan
  var idPaginationhide =properties.meridian+3;
  //lakukan pengulangan sebanyak loop
  for (var i = 0; i < loop; i++) {
    hidePagination='#page-'+idPaginationhide;
    showPagination='#page-'+idPaginationshow;
    //pagination yg di hide
    $(showPagination).removeClass('hide');
    //pagination baru yg ditampilkan
    $(hidePagination).addClass('hide');
    idPaginationshow++;
    idPaginationhide--;
  }
} 
properties.prev=newMeridian-2;
properties.next=newMeridian;
properties.meridian=newMeridian;
$('#page-'+properties.meridian).addClass('active');
}

// next page
function nextPage() {
  selectPage(properties.next);
}
// prev page
function prevPage() {
  selectPage(properties.prev);
}



//## CARI ALL ATRIBUT
  // cari yang di klik
  $('#cari_siswa').click(function(e){
      //get value dari input name cari_siswa
      properties.key_search=$('[name=cari_siswa]').val();
      properties.search_single = false;
      selectPage(pageVal='0');
      pagination_siswa();
    });

  // cari yang di enter
  $("[name=cari_siswa]").on('keyup', function (e) {
    if (e.keyCode == 13) {
      //get value dari input name cari_siswa
      properties.key_search=$('[name=cari_siswa]').val();
      properties.search_single = false;
      selectPage(pageVal='0');
      pagination_siswa();
    }
  });

// CARI ALL ATRIBUT


// FILTER UNTUK JUMLAH YANG DITAMPILKAN
$("[name=records_per_page]").change(function(){
  properties.records_per_page =$('[name=records_per_page]').val();
  selectPage(0);
  paginationToken();
});
// FILTER UNTUK JUMLAH YANG DITAMPILKAN


// PENCARIAN SINGLE
//#. Pencarian untuk nama siswa
$('[name=nama_siswa_search]').on('keyup', function (e) {
  if (e.keyCode == 13) {
    properties.key_word = $('[name=nama_siswa_search]').val();
    properties.key_single =  $('[name=nama_siswa_search]').attr('name');
    properties.search_single =  true;
    selectPage(0);
    pagination_siswa();
  }
});
//#. Pencarian untuk nama pengguna
$('[name=nama_pengguna_search]').on('keyup', function (e) {
  if (e.keyCode == 13) {
    properties.key_word = $('[name=nama_pengguna_search]').val();
    properties.key_single =  $('[name=nama_pengguna_search]').attr('name');
    properties.search_single =  true;
     properties.key_search = '';
    selectPage(0);
    pagination_siswa();
  }
});

//#. Pencarian untuk nama cabang
$('[name=cabang_search]').on('keyup', function (e) {
  if (e.keyCode == 13) {
    properties.key_word = $('[name=cabang_search]').val();
    properties.key_single =  $('[name=cabang_search]').attr('name');
    properties.search_single =  true;
     properties.key_search = '';
    selectPage(0);
    pagination_siswa();
  }
});

//#. Pencarian untuk tingkat
$('[name=tingkat_search]').on('keyup', function (e) {
  if (e.keyCode == 13) {
    properties.key_word = $('[name=tingkat_search]').val();
    properties.key_single =  $('[name=tingkat_search]').attr('name');
    properties.search_single =  true;
     properties.key_search = '';
    selectPage(0);
    pagination_siswa();
  }
});
// PENCARIAN SINGLE

pagination_siswa();
set_tb_siswa();
</script>
<!-- “OF COURSE BAD CODE CAN BE CLEANED UP. BUT IT’S VERY EXPENSIVE.”  -->