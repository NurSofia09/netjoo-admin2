  <div class="col-md-12 kirim_token">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Daftar Laporan Pengerjaan</h3> 
        <div class="panel-toolbar text-right">
          <div class="col-md-12">
           <div class="col-sm-4">
             <select class="form-control" id="select_cabang">
              <option value="all">Semua Cabang</option>
              <?php foreach ($cabang as $item): ?>
                <option value="<?=$item->id ?>"><?=$item->namaCabang ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="col-sm-4">
           <select class="form-control" id="select_to">
            <option value="all">Semua Tryout</option>          
            <?php foreach ($to as $item): ?>
              <option value="<?=$item['id_tryout']?>"><?=$item['nm_tryout'] ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="col-sm-4">
         <select class="form-control col-sm-6" id="select_paket">
          <option value="all">Semua paket</option>
        </select>
        <!-- <button class="btn btn-sm btn-inverse " onclick="pdf()">PDF</button> -->
      </div>
    </div>
  </div>
</div>
<div class="panel-body">

  <form  class="panel panel-default form-horizontal form-bordered form-step"  method="post" >
     <div class="col-md-12" >
      <!-- recor per page tabel pengguna token -->
      <div class="col-md-2 mb2 mt10 pl0">
        <select  class="form-control" name="records_per_page" >
          <!-- <option value="10" selected="true">records per page</option> -->
          <option value="2" selected="true">2</option>
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50" >50</option>
          <option value="100">100</option>
          <option value="200">200</option>
        </select>
      </div>
      <!-- /recor per page tabel pengguna token -->
      <!-- div pencarian  -->
      <div class="col-md-10 mb10 mt10 pr0">
        <div class="input-group">
           <span class="input-group-addon btn" id="cariDat"><i class="ico-search"></i></span>
           <input class="form-control" type="text" name="cariDat" placeholder="Cari Data">
        </div>
      </div>
      <!-- div pencarian -->
      </div>
    <table class="daftarlog table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
      <thead>
        <tr>

          <th>No</th>
          <th>Nama Pengguna</th>
          <th>Nama Lengkap</th>
          <th>Waktu perngerjaan</th>

          <th>Nama Tryout</th>
          <th>Nama Paket</th>
          <th>Status Tryout</th>

        </tr>
      </thead>

      <tbody id="record_logtryout">

      </tbody>
    </table>


  </div>
  <div class="panel-footer">
      <!-- div pagination daftar token -->
    <div class="col-md-12">
      <ul class="pagination pagination-logtryout">

      </ul>
    </div>
    <!-- div pagination daftar token -->
  </div>
</div>
</div>
</div>

<script>
var meridian=4;
var prev=1;
var next=2;
var records_per_page=2;
var status="1";
var masaAktif="all";
var page;
var pageVal;
var pageSelek=0;
var keySearch='';
var url;
var datas;
var record_logtryout;
var cabang="all";
var tryout="all";
var paket="all";
var keySearch='';

  $(document).ready(function(){
    // url = base_url+"logtryout/ajax_status_to";
    // dataTablePaket = $('.daftarlog').DataTable({
    //   "ajax": {
    //     "url": url,
    //     "type": "POST"
    //   },
    //   "emptyTable": "Tidak Ada Data Pesan",
    //   "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    //   "bDestroy": true,
    // });
      // set tb siswa
  function set_tb_trout_log() {
    datas ={records_per_page:records_per_page,page:pageSelek,cabang:cabang,tryout:tryout,paket:paket,keySearch:keySearch};
    $('#record_logtryout').empty();
    url=base_url+"logtryout/ajax_status_to";
    $.ajax({
      url:url,
      data:datas,
      dataType:"text",
      type:"post",
      success:function(Data)
      {

        tb_record_logtryout = JSON.parse(Data);
        $('#record_logtryout').append(tb_record_logtryout);
      },
      error:function(e,jqXHR, textStatus, errorThrown)
      {
         sweetAlert("Oops...", e, "error");
      }
    });
  }
  set_tb_trout_log();

 function set_pagination_tb_logtryout() {
      url=base_url+"logtryout/pagination_tb_logtryout";
      datas={records_per_page:records_per_page,page:pageSelek,cabang:cabang,tryout:tryout,paket:paket,keySearch:keySearch};
      $.ajax({
        url:url,
        data:datas,
        dataType:"text",
        type:"post",
        success:function(Data)
        {
          
       $('.pagination-logtryout').empty();
          pagination_logtryout = JSON.parse(Data);
          $('.pagination-logtryout').append( pagination_logtryout);
        },
        error:function(){

        },
      });
    }
  set_pagination_tb_logtryout();
  // CABANG KETIKA DI CHANGE
    $('#select_cabang').change(function(){
      cabang = $('#select_cabang').val();
      tryout = $('#select_to').val();
      paket = $('#select_paket').val();

 selectPagelogtryout();
    set_pagination_tb_logtryout();

    });

    // TO KETIKA DI CHANGE
  $('#select_to').change(function(){
    cabang = $('#select_cabang').val();
    tryout = $('#select_to').val();
    paket = $('#select_paket').val();
     selectPagelogtryout();
    set_pagination_tb_logtryout();
    load_paket(tryout);
  });

  // TO KETIKA DI CHANGE
  $('#select_paket').change(function(){
    cabang = $('#select_cabang').val();
    tryout = $('#select_to').val();
    paket = $('#select_paket').val();
    selectPagelogtryout();
    set_pagination_tb_logtryout();
  });

    // even untuk jumlah record per halaman
    $("[name=records_per_page]").change(function(){
      records_per_page =$('[name=records_per_page]').val();
           selectPagelogtryout();
    set_pagination_tb_logtryout();
    });

      $('#cariDat').click(function(e){
      //get value dari input name cariDat
      keySearch=$('[name=cariDat]').val();

      selectPagelogtryout();
    set_pagination_tb_logtryout();
      //
    });

  });

  function selectPagelogtryout(pageVal='0') {
  page=pageVal;
  pageSelek=page*records_per_page;
  datas ={records_per_page:records_per_page,page:pageSelek,cabang:cabang,tryout:tryout,paket:paket,keySearch:keySearch};
    $('#record_logtryout').empty();
    url=base_url+"logtryout/ajax_status_to";
    $.ajax({
      url:url,
      data:datas,
      dataType:"text",
      type:"post",
      success:function(Data)
      {

        tb_record_logtryout = JSON.parse(Data);
        $('#record_logtryout').append(tb_record_logtryout);
      },
      error:function(e,jqXHR, textStatus, errorThrown)
      {
         sweetAlert("Oops...", e, "error");
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

// // TO KETIKA DI CHANGE
// $('#select_cabang').change(function(){
//   cabang = $('#select_cabang').val();
//   tryout = $('#select_to').val();
//   paket = $('#select_paket').val();

//   url = base_url+"logtryout/ajax_status_to/"+cabang+"/"+tryout+"/"+paket;
//   dataTablePaket = $('.daftarlog').DataTable({
//     "ajax": {
//       "url": url,
//       "type": "POST"
//     },
//     "emptyTable": "Tidak Ada Data Pesan",
//     "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
//     "bDestroy": true,
//   });
// });

//   // TO KETIKA DI CHANGE
//   $('#select_to').change(function(){
//     cabang = $('#select_cabang').val();
//     tryout = $('#select_to').val();
//     paket = $('#select_paket').val();

//     url = base_url+"logtryout/ajax_status_to/"+cabang+"/"+tryout+"/"+paket;
//     dataTablePaket = $('.daftarlog').DataTable({
//       "ajax": {
//         "url": url,
//         "type": "POST"
//       },
//       "emptyTable": "Tidak Ada Data Pesan",
//       "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
//       "bDestroy": true,
//     });

//     load_paket(tryout);
//   });
//ketika paket di change
function load_paket(id_to){
 $.ajax({
  type: "POST",
  url: "<?php echo base_url() ?>admincabang/get_paket/"+id_to,
  success: function(data){
   $('#select_paket').html('<option value="all">-- Pilih Paket  --</option>');
   $.each(data, function(i, data){
    $('#select_paket').append("<option value='"+data.id_paket+"'>"+data.nm_paket+"</option>");
  });
 }
});
}
// TO KETIKA DI CHANGE
// $('#select_paket').change(function(){
//   cabang = $('#select_cabang').val();
//   tryout = $('#select_to').val();
//   paket = $('#select_paket').val();

//   url = base_url+"admincabang/admincabang/laporanto/"+cabang+"/"+tryout+"/"+paket;
//   dataTablePaket = $('.daftarpaket').DataTable({
//     "ajax": {
//       "url": url,
//       "type": "POST"
//     },
//     "emptyTable": "Tidak Ada Data Pesan",
//     "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
//     "bDestroy": true,
//   });
// });

</script>