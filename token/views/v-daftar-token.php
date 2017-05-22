
<div class="row">
  <div class="col-md-12 form-token" style="display: none">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Tambah Token</h3> 
      </div>
      <div class="panel-body">
        <form  class="panel panel-default form-horizontal form-bordered form-step"  method="post" >
         <div  class="form-group">
           <label class="col-sm-2 control-label">Jumlah Token</label>
           <div class="col-sm-3">
             <!-- stkt = soal tingkat -->
             <input type="text" class="form-control" name="jumlah_token">
           </div>

           <label class="col-sm-2 control-label">Masa aktif</label>
           <div class="col-sm-3">
             <!-- stkt = soal tingkat -->
             <select class="form-control" name="masa_aktif">
              <option value="0">-- Pilih Masa Aktif --</option>
              <option value="30">30 Hari</option>
              <option value="100">100 Hari</option>
              <option value="365">365 Hari</option>
            </select>
          </div>
        </div>

        <div class="form-group no-border">
          <div class="col-sm-6 ml10">
           <a class="btn btn-primary simpan_token">Generate Token</a>
         </div>
       </div>

     </form>
   </div>
 </div>
</div>
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Daftar Token 

     </h3>


     <div class="panel-toolbar text-right">
       <div class="col-sm-4">
         <span><b>Filter: </b></span>
         <input name="status_token" value="1" type="radio" class="mt10" title="Aktif"> 
         <i class="ico-file-check mr10"></i>  
         <input name="status_token" value="0" type="radio" title="Tidak Aktif"> <i class="ico-file-remove "></i>
       </div>
       <div class="col-sm-4">

         <!-- stkt = soal tingkat -->
         <select class="form-control" name="masa_aktif" id="masa_aktif_select">
          <option value="all">Semua</option>
          <option value="30">30 Hari</option>
          <option value="100">100 Hari</option>
          <option value="365">365 Hari</option>
        </select>


      </div>
      <a class="btn btn-inverse btn-outline add-token" title="Tambah Token" ><i class="ico-plus"></i></a>
    </div>
  </div>
  <div class="panel-body">
    <!-- div seting record dan pencarian   -->
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
         <span class="input-group-addon btn" id="cariToken"><i class="ico-search"></i></span>
         <input class="form-control" type="text" name="cariToken" placeholder="Cari Data">
       </div>
     </div>
     <!-- div pencarian -->
   </div>
   <!-- div seting record dan pencarian -->
   <!-- div tabel daftar token -->
   <div class="col-md-12">
    <table class="table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
      <thead>
        <tr>
          <th>id</th>
          <th>Nomor Token</th>
          <th>Masa Aktif</th>
          <th>Digunakan Oleh</th>
          <th>Nama Pengguna</th>
          <th width="15%">Aksi</th>
        </tr>
        <tbody id="record_token">

        </tbody>
      </table>
    </div>
    <!-- /div tabel daftar token -->
    <!-- div pagination daftar token -->
    <div class="col-md-12">
      <ul class="pagination pagination-token">

      </ul>
    </div>
    <!-- div pagination daftar token -->
  </div>
</div>
</div>

</div>
<!-- TABEL TOKEN -->
<script type="text/javascript">
  var dataTableToken;
  var meridian=4;
  var prev=1;
  var next=2;
  var records_per_page=10;
  var status="null";
  var masaAktif="all";
  var page=0;
  var pageVal;
  var keySearch='';
  var url;
  var tb_token;
  var pageSelek=0;
  var datas ;
  $(document).ready(function(){
  //set tb_token
  function set_tb_token() {
    datas ={masaAktif:masaAktif,status:status,records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
    $('#record_token').empty();
    
    url=base_url+"token/ajaxLisToken";
    $.ajax({
      url:url,
      data:datas,
      dataType:"text",
      type:"post",
      success:function(Data)
      {
        tb_token = JSON.parse(Data);
        $('#record_token').append(tb_token);
      },
      error:function(e,jqXHR, textStatus, errorThrown)
      {
       sweetAlert("Oops...", e, "error");
     }
   });

  }
  set_tb_token();
  // even untuk jumlah record per halaman
  $("[name=records_per_page]").change(function(){
    records_per_page =$('[name=records_per_page]').val();
    selectPage(0);
    paginationToken();
  });
  // even untuk menampilkan jenis token yg sudah digunakan atau belum digunakan 
  $('input[name=status_token]').click(function(){
    status = this.value;
    console.log(page+"ini");
    selectPage(page);
    paginationToken();
  });

  // ketika masa aktif radio button di klik
  $('#masa_aktif_select').on('change', function() {
    masaAktif = this.value ;
    selectPage(page);
    paginationToken();
  });

  paginationToken();
  // di konen dulu karena koneksi tidak mendukung Lol
  // // event pencarian ketika tekan enter
  // $('[name=cariToken]').on('keydown',function(e){
  //   //get value dari input name cariToken
  //   keySearch=$('[name=cariToken]').val();
  //   selectPage(pageVal='0',keySearch);
  //   paginationToken();
  //   //
  // });

  $('#cariToken').click(function(e){
      //get value dari input name cariToken
      keySearch=$('[name=cariToken]').val();
      selectPage(pageVal='0');
      paginationToken();
      //
    });

});
    //set pagination
    function paginationToken() {
      $.ajax({
        url:base_url+"token/paginationToken/",
        data:{masaAktif:masaAktif,status:status,records_per_page:records_per_page,keySearch:keySearch},
        type:"POST",
        dataType:"TEXT",
        success:function(data){
          $('.pagination-token').empty();
          $('.pagination-token').append(JSON.parse(data));
        },error:function(){
        // swal('Gagal pagination');
      }
    });
    }
// next page
function nextPage() {
  selectPage(next);
}
// prev page
function prevPage() {
  selectPage(prev);
}
function selectPage(pageVal='0') {
  page=pageVal;
  pageSelek=page*records_per_page;
  // 
  $('#record_token').empty();
  datas ={masaAktif:masaAktif,status:status,records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
  url=base_url+"token/ajaxLisToken";
  $.ajax({
    url:url,
    data:datas,
    dataType:"text",
    type:"post",
    success:function(Data)
    {
      tb_token = JSON.parse(Data);
      $('#record_token').append(tb_token);
    },
    error:function(e,jqXHR, textStatus, errorThrown)
    {
         // sweetAlert("Oops...", e, "error");
       }
     });
  //meridian adalah nilai tengah padination
  $('#page-'+meridian).removeClass('active');
  var newMeridian=page+1;
  var loop;
  var hidePage;
  var showPage;
  if (newMeridian<=4) {
    $("#page-prev").addClass('hide');
    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridian-newMeridian;
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
  }else if( newMeridian>meridian){
    $("#page-prev").removeClass('hide');
        //banyak pagination yg akan di tampilkan dan sisembunyikan
        loop=newMeridian-meridian;
        // start id pagination yg akan ditampilkan
        var idPaginationshow =newMeridian+3;
        // start id pagination yg akan sembunyikan
        var idPaginationhide =meridian-3;
        console.log("ini"+next);
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
    loop=meridian-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =newMeridian-3;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =meridian+3;
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
  prev=newMeridian-2;
  next=newMeridian;
  meridian=newMeridian;
  $('#page-'+meridian).addClass('active');
}

// onclick action
$('.add-token').click(function(){
  $('.form-token').toggle('show');
});

$('.simpan_token').click(function(){
  addtoken();
  selectPage();
  paginationToken();
});

// UDF //
function addtoken(){
  var data = $('.form-step').serialize();
  $.ajax({
    url:base_url+"token/add_token",
    data:data,
    type:"POST",
    dataType:"TEXT",
    success:function(){
      swal('Token Berhasil Di Tambahkan');
      selectPage();
      paginationToken();
    },error:function(){
      swal('Gagal membuat Token');
    }
  });
}


function drop_token(data){
  url = base_url+"token/drop_token";
  swal({
    title: "Yakin akan hapus Token?",
    text: "Anda tidak dapat membatalkan ini.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya,Tetap hapus!",
    closeOnConfirm: false
  },
  function(){
    var datas = {id:data};
    $.ajax({
      dataType:"text",
      data:datas,
      type:"POST",
      url:url,
      success:function(){
        swal("Terhapus!", "Token berhasil dihapusss.", "success");
        selectPage(page);
        paginationToken();
      },
      error:function(){
        sweetAlert("Oops...", "Data gagal terhapus!", "error");
      }

    });
  });
}


function update_token(data){
  url = base_url+"token/aktifkan_token";
  swal({
    title: "Yakin akan aktifkan Token?",
    text: "Anda tidak dapat membatalkan ini.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya,Aktifkan token",
    closeOnConfirm: false
  },
  function(){
    var datas = {id:data};
    $.ajax({
      dataType:"text",
      data:datas,
      type:"POST",
      url:url,
      success:function(){
        swal("Diaktifkan!", "Token berhasil diaktikan.", "success");
        selectPage();
        paginationToken();
      },
      error:function(){
        sweetAlert("Oops...", "Token gagal diaktikan!", "error");
      }

    });
  });
}

</script>