
<div class="row">
  <div class="col-md-12 " >
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Kirim Token</h3> 
      </div>
      <div class="panel-body">
      <!-- div masa aktif -->
      <div class="col-md-12 ">
        <form  class="panel panel-default form-horizontal form-bordered form-step"  method="post" >
         <div  class="form-group">
           <label class="col-sm-2 control-label">Masa aktif</label>
           <div class="col-sm-9">
             <!-- stkt = soal tingkat -->
             <select class="form-control" name="masa_aktif_set">
              <option value="0">-- Pilih Masa Aktif --</option>
              <option value="30">30 Hari</option>
              <option value="100">100 Hari</option>
              <option value="365">365 Hari</option>
            </select>
          </div>
        </div>
      </form>
      </div>
      <!-- div masa aktif -->
      <!-- div setting record per page -->
      <div class="col-md-12 ">
         <div class="col-md-2 mb10">
          <select  class="form-control" name="records_per_page_siswa">
            <!-- <option value="10" selected="true">records per page</option> -->
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
         </div>
      </div>
      <!-- /div setting record per page -->
      <div class="col-md-12">
        <div  class="form-group">
          <table class="daftarsiswa table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
            <thead>
              <tr>
                <th>
                  <span class="checkbox custom-checkbox check-all">
                    <input type="checkbox" name="checkall" id="check-all">
                    <label for="check-all">&nbsp;&nbsp;</label></span> 
                  </th>
                  <th>No</th>
                  <th>Nama Mahasiswa</th>
                  <th>Nama Pengguna</th>
                  <th>Cabang</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
                 <ul class="pagination pagination-siswa">

                </ul>
            <hr>
            <a class="btn btn-primary set_token">Kirim Token</a>

          </div>
        </div>
        <div class="panel-footer">
          <ul class="nav nav-section nav-justified">
            <li>
              <div class="section">
                <input type="hidden" name="jumlah_semua_stok">
                <input type="hidden" name="jumlah_30_stok">
                <input type="hidden" name="jumlah_100_stok">
                <input type="hidden" name="jumlah_365_stok">  
                <h5 class="nm jumlah_semua_stok"></h5>
                <span>Semua</span>
              </div>
            </li>

            <li>
              <div class="section">
                <h5 class="nm jumlah_30_stok"></h5>
                <span>30 Hari</span>
              </div>
            </li>

            <li>
              <div class="section">
                <h5 class="nm jumlah_100_stok"></h5>
                <span>100 Hari</span>
              </div>
            </li>

            <li>
              <div class="section">
                <h5 class="nm jumlah_365_stok"></h5>
                <span>365 Hari</span>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Penggunaan Token</h3>
      <!-- panel toolbar -->
      <div class="panel-toolbar text-right">
        <!-- option -->
        <div class="option">
          <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
          <button class="btn" data-toggle="panelremove"><i class="remove"></i></button>
        </div>
        <!--/ option -->
      </div>
      <!--/ panel toolbar -->
    </div>

    <div class="panel-body">
      <!-- recor per page tabel pengguna token -->
    
      <div class="col-md-2 mb10">
        <select  class="form-control" name="records_per_page" >
          <!-- <option value="10" selected="true">records per page</option> -->
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </div>
      <!-- div tabel -->
      <div class="col-md-12 mb10">
      <table class="rekap_token table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Nama Pengguna</th>

            <th>Nomor Token</th>
            <th>Masa Aktif</th>
            <th>Mulai</th>
            <th>Finish</th>
            <th>Sisa Aktif</th>
            <th>Status</th>
            <th width="15%">Aksi</th>
          </tr>
        </thead>

        <tbody>

        </tbody>
      </table>
      </div>
      <!-- /div tabel -->
      <!-- div pagination-->
      <div class="col-md-12 mb10">
        <ul class="pagination pagination-token">

        </ul>
      </div>
      <!-- /div pagination-->
    </div>
  </div>
</div>




</div>
<!-- TABEL TOKEN -->
<script type="text/javascript">
var dataTableSiswa;
var dataRekapToken
var meridianSiswa=4;
var prevSiswa=1;
var nextSiswa=2;
var records_per_page_siswa=10;
var statusSiswa="null";
var pageSiswa;
var pageValSiswa;
//token
var meridian=4;
var prev=1;
var next=2;
var records_per_page=10;
var status="1";
var masaAktif="all";
var page;
var pageVal;
// 

// next page
function nextPageSiswa() {
  selectPageSiswa(nextSiswa);
}
// prev page
function prevPageSiswa() {
  selectPageSiswa(prevSiswa);
}

// next page
function nextPage() {
  selectPage(next);
}
// prev page
function prevPage() {
  selectPage(prev);
}

$(document).ready(function(){
  // even untuk jumlah record per halaman
  $("[name=records_per_page]").change(function(){
    records_per_page =$('[name=records_per_page]').val();
    selectPage(page);
    paginationToken(masaAktif,status,records_per_page);
  });
    $("[name=records_per_page_siswa]").change(function(){
    records_per_page_siswa =$('[name=records_per_page_siswa]').val();
    selectPageSiswa(page);
    paginationSiswa(masaAktif,status,records_per_page_siswa);
  });
  // TABLE SISWA
  dataTableSiswa = $('.daftarsiswa').DataTable({
    "ajax": {
      "url": base_url+"token/ajax_data_siswa",
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
    "bPaginate": false, 
    "bInfo" : false,
    "bFilter": false,
  });

    // TABLE REKAP
    dataRekapToken = $('.rekap_token').DataTable({
      "ajax": {
        "url": base_url+"token/ajax_rekap_penggunaan_token",
        "type": "POST"
      },
      "emptyTable": "Tidak Ada Data Pesan",
      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
      "bDestroy": true,
      "bPaginate": false, 
      "bInfo" : false,
      "bFilter": false,
    });

    //set pagination
  function paginationSiswa(records_per_page_siswa) {
      $.ajax({
      url:base_url+"token/paginationSiswa/"+records_per_page_siswa,
   
      type:"POST",
      dataType:"TEXT",
      success:function(data){
        $('.pagination-siswa').empty();
        $('.pagination-siswa').append(JSON.parse(data));
      },error:function(){

      }
    });
  }

  paginationSiswa(records_per_page_siswa);
    //set pagination
  function paginationToken(masaAktif,status,records_per_page) {
      $.ajax({
      url:base_url+"token/paginationToken/"+masaAktif+"/"+status+"/"+records_per_page,
   
      type:"POST",
      dataType:"TEXT",
      success:function(data){
        $('.pagination-token').empty();
        $('.pagination-token').append(JSON.parse(data));
      },error:function(){
        swal('Gagal membuat Token');
      }
    });
  }

  paginationToken(masaAktif,status,records_per_page);


  });
// untuk tabel siswa
function selectPageSiswa(pageVal='0') {
  page=pageVal;
  var pageSelek=page*records_per_page_siswa;
    dataTableSiswa = $('.daftarsiswa').DataTable({
      "ajax": {
      "url": base_url+"token/ajax_data_siswa/"+records_per_page_siswa+"/"+pageSelek,
      "type": "POST"
    },
      "emptyTable": "Tidak Ada Data Pesan",
      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
      "bDestroy": true,
      "bPaginate": false,
      "bInfo" : false,
      "bFilter": false,
  });
     //meridian adalah nilai tengah padination
 $('#pageSiswa-'+meridianSiswa).removeClass('active');
  var newMeridian=page+1;
  var loop;
  var hidePage;
  var showPage;
  if (newMeridian<=4) {
        $("#page-prev-siswa").addClass('hide');
    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridianSiswa-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =1;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =9;
    prev=1;
    next=7;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#pageSiswa-'+idPaginationhide;
      showPagination='#pageSiswa-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
      idPaginationshow++;
      idPaginationhide--;
    }
  }else if( newMeridian>meridianSiswa){
    $("#page-prev-siswa").removeClass('hide');
        //banyak pagination yg akan di tampilkan dan sisembunyikan
        loop=newMeridian-meridianSiswa;
        // start id pagination yg akan ditampilkan
        var idPaginationshow =newMeridian+3;
        // start id pagination yg akan sembunyikan
        var idPaginationhide =meridianSiswa-3;
        //lakukan pengulangan sebanyak loop
        for (var i = 0; i < loop; i++) {
          hidePagination='#pageSiswa-'+idPaginationhide;
          showPagination='#pageSiswa-'+idPaginationshow;
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
      hidePagination='#pageSiswa-'+idPaginationhide;
      showPagination='#pageSiswa-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
            idPaginationshow++;
      idPaginationhide--;
    }
  } 
   prevSiswa=newMeridian-2;
   nextSiswa=newMeridian;
   meridianSiswa=newMeridian;
   $('#pageSiswa-'+meridianSiswa).addClass('active');
}

// untuk tabel token
function selectPage(pageVal='0') {
  page=pageVal;
  var pageSelek=page*records_per_page;
    dataRekapToken = $('.rekap_token').DataTable({
      "ajax": {
      "url": base_url+"token/ajax_rekap_penggunaan_token/"+masaAktif+"/"+status+"/"+records_per_page+"/"+pageSelek,
      "type": "POST"
    },
      "emptyTable": "Tidak Ada Data Pesan",
      "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
      "bDestroy": true,
      "bPaginate": false,
      "bInfo" : false,
      "bFilter": false,
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

// untul tabel


// onclick action
$('.add-token').click(function(){
  $('.form-token').toggle('show');
});

$('.simpan_token').click(function(){
  addtoken();
  dataTableToken.ajax.reload(null,false); 
});

$('.send-token').click(function(){
  dataTableSiswa.ajax.reload(null,false); 
  dataRekapToken.ajax.reload(null,false); 

});

$('.set_token').click(function(){
  set_token_to_mahasiswa();
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
      reload();
    },error:function(){
      swal('Gagal membuat Token');
    }
  })
}


//fungsi set token ke mahasiswa
function set_token_to_mahasiswa(){
  //tampung id mahasiswa
  id_siswa = [];
  //tampung masa aktif
  masa_aktif = $('select[name=masa_aktif_set]').val();
  //cek kalo belum set masa aktif
  if (masa_aktif==0) {
    swal('silahkan tentukan masa aktif terlebih dahulu');
    $('select[name=masa_aktif_set]').focus();
  }else{
   $('.daftarsiswa tbody td :checkbox:checked').each(function(i){
     id_siswa[i] = $(this).val();
   }); 
   
   jumlah_mahasiswa = id_siswa.length;
   jumlah_stok = $('input[name=jumlah_'+masa_aktif+'_stok]').val();

   // cek jumlah mahasiswa yang dipilih
   if (jumlah_mahasiswa==0) {
    swal('Silahkan tentukan mahasiswa terlebih dahulu');
  }else{
    if (jumlah_mahasiswa>jumlah_stok) {
      swal('Jumlah stok kurang');
    }else{
      data = {
        id:id_siswa,
        jumlah_mahasiswa:jumlah_mahasiswa,
        masa_aktif:masa_aktif
      };
      $.ajax({
        url:base_url+"token/set_token_to_mahasiswa",
        data:data,
        type:"POST",
        dataType:"TEXT",
        success:function(){
          swal('Token Berhasil Di Kirim');
          reload();
        },error:function(){
          swal('Gagal mengirim Token');
        }
      });
    }
  }
}

}




function get_stok(){
  $.ajax({
    url:base_url+"token/ajax_get_stock",
    type:"POST",
    dataType:"json",
    success:function(data, key){
      $.each(data, function(key, value){
        $("."+key).html("Stok : "+value);
        $('input[name='+key+']').val(value);
      });
    },error:function(){
      swal('Gagal mengirim Token');
    }
  });
}


function reload(){
  get_stok(); 
  dataTableSiswa.ajax.reload(null,false); 
  dataRekapToken.ajax.reload(null,false); 
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
        swal("Terhapus!", "Token berhasil dihapus.", "success");
        dataRekapToken.ajax.reload(null,false)
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
        dataRekapToken.ajax.reload(null,false)
      },
      error:function(){
        sweetAlert("Oops...", "Token gagal diaktikan!", "error");
      }

    });
  });
}



$('[name="checkall"]:checkbox').click(function () {
 if($(this).attr("checked")){
  $('table.daftarsiswa tbody input:checkbox').prop( "checked", true );
} else{ 
  $('table.daftarsiswa tbody input:checkbox').prop( "checked", false );
}
});

get_stok();
</script>