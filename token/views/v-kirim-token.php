
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
      <!-- div seting record dan pencarian   -->
      <div class="col-md-12" >
          <!-- div setting record -->
          <div class="col-md-2 mb2 mt10 pl0">
            <div  class="form-group">
              <select  class="form-control" name="records_per_page_siswa">
                <!-- <option value="10" selected="true">records per page</option> -->
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
               <span class="input-group-addon btn" id="cariSiswa"><i class="ico-search"></i></span>
               <input class="form-control" type="text" name="cariSiswa" placeholder="Cari Data Siswa">
            </div>
          </div>
          <!-- div pencarian -->
      </div>
      <!-- div seting record dan pencarian -->
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
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="record_siswa">

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
     
      <div class="col-md-12" >
      <!-- recor per page tabel pengguna token -->
      <div class="col-md-2 mb2 mt10 pl0">
        <select  class="form-control" name="records_per_page" >
          <!-- <option value="10" selected="true">records per page</option> -->
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </div>
      <!-- /recor per page tabel pengguna token -->
      <!-- div pencarian  -->
      <div class="col-md-10 mb10 mt10 pr0">
        <div class="input-group">
           <span class="input-group-addon btn" id="cariToken"><i class="ico-search"></i></span>
           <input class="form-control" type="text" name="cariToken" placeholder="Cari Data">
        </div>
      </div>
      <!-- div pencarian -->
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

        <tbody id="record_token">

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
// data siswa
var meridianSiswa=4;
var prevSiswa=1;
var nextSiswa=2;
var records_per_page_siswa=10;
var statusSiswa="null";
var pageSiswa;
var pageValSiswa;
var tb_siswa;
var datasSiswa;
var keySearchSiswa='';
//data token
var meridian=4;
var prev=1;
var next=2;
var records_per_page=10;
var status="1";
var masaAktif="all";
var page;
var pageVal;
var pageSelek=0;
var keySearch='';
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
    paginationSiswa(records_per_page_siswa);
  });


  // set tb rekap_token
  function set_tb_rekap_token() {
    datas ={masaAktif:masaAktif,status:status,records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
    $('#record_token').empty();
    url=base_url+"token/ajax_rekap_penggunaan_token";
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
set_tb_rekap_token();

    // set tb siswa
  function set_tb_siswa() {
    datasSiswa ={records_per_page_siswa:records_per_page_siswa,pageValSiswa:pageValSiswa,keySearchSiswa:keySearchSiswa};
    $('#record_siswa').empty();
    url=base_url+"token/ajax_data_siswa";
    $.ajax({
      url:url,
      data:datasSiswa,
      dataType:"text",
      type:"post",
      success:function(Data)
      {
        tb_siswa = JSON.parse(Data);
        $('#record_siswa').append(tb_siswa);
      },
      error:function(e,jqXHR, textStatus, errorThrown)
      {
         sweetAlert("Oops...", e, "error");
      }
    });
  }
set_tb_siswa();
    //set pagination
  function paginationSiswa(records_per_page_siswa) {

     datasSiswa ={records_per_page_siswa:records_per_page_siswa,keySearchSiswa:keySearchSiswa};
      $.ajax({
      url:base_url+"token/paginationSiswa/",
      data:datasSiswa,
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

  paginationToken(masaAktif,status,records_per_page);

  //event cari siswa
  $('#cariSiswa').click(function(e){
      //get value dari input name cariToken
      keySearchSiswa=$('[name=cariSiswa]').val();
      selectPageSiswa(pageValSiswa='0');
      paginationSiswa(records_per_page_siswa);
      //
    });

    $('#cariToken').click(function(e){
      //get value dari input name cariToken
      keySearch=$('[name=cariToken]').val();
      selectPage(pageVal='0');
      paginationToken(masaAktif,status,records_per_page);
      //
    });

  });
// untuk tabel siswa
function selectPageSiswa(pageValSiswa='0') {
      pageSiswa=pageValSiswa;
  pageSelekSiswa=pageSiswa*records_per_page_siswa;
  datasSiswa ={records_per_page_siswa:records_per_page_siswa,pageSelekSiswa:pageSelekSiswa,keySearchSiswa:keySearchSiswa};
    $('#record_siswa').empty();
    url=base_url+"token/ajax_data_siswa";
    $.ajax({
      url:url,
      data:datasSiswa,
      dataType:"text",
      type:"post",
      success:function(Data)
      {
        tb_siswa = JSON.parse(Data);
        $('#record_siswa').append(tb_siswa);
      },
      error:function(e,jqXHR, textStatus, errorThrown)
      {
         sweetAlert("Oops...", e, "error");
      }
    });
     //meridian adalah nilai tengah padination
 $('#pageSiswa-'+meridianSiswa).removeClass('active');
  var newMeridian=pageSiswa+1;
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
    prevSiswa=1;
    nextSiswa=7;
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
  pageSelek=page*records_per_page;
  $('#record_token').empty();
  datas ={masaAktif:masaAktif,status:status,records_per_page:records_per_page,pageSelek:pageSelek,keySearch:keySearch};
    url=base_url+"token/ajax_rekap_penggunaan_token";
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
          selectPageSiswa(pageSiswa='0');
          // paginationSiswa(records_per_page_siswa);
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
         selectPage(pageVal='0');
      paginationToken(masaAktif,status,records_per_page);
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
                selectPage(pageVal='0');
      paginationToken(masaAktif,status,records_per_page);
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