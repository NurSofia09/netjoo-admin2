
<div class="row">
  <div class="col-md-12 kirim_token"  style="display: none">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Kirim Token</h3> 
      </div>
      <div class="panel-body">
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
          <hr>
          <a class="btn btn-primary set_token">Kirim Token</a>

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
      <a class="btn btn-inverse btn-outline send-token" title="Kirim Token" ><i class="ico-user-plus2"></i></a>
      <a class="btn btn-inverse btn-outline send-token" title="Rekap Token" ><i class="ico-notebook"></i></a>
    </div>
  </div>
  <div class="panel-body">
    <table class="daftartoken table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
      <thead>
        <tr>
          <th>id</th>
          <th>Nomor Token</th>
          <th>Masa Aktif</th>
          <th>Digunakan Oleh</th>
          <th width="15%">Aksi</th>
        </tr>
      </thead>

      <tbody>

      </tbody>
    </table>
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
  </div>
</div>




</div>
<!-- TABEL TOKEN -->
<script type="text/javascript">
var dataTableToken;
var dataTableSiswa;
var dataRekapToken


$(document).ready(function(){
  // TABLE TOKEN
  dataTableToken = $('.daftartoken').DataTable({
    "ajax": {
      "url": base_url+"token/ajax_data_token",
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });

  // TABLE SISWA
  dataTableSiswa = $('.daftarsiswa').DataTable({
    "ajax": {
      "url": base_url+"token/ajax_data_siswa2",
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
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
    });



  });
// onclick action
$('.add-token').click(function(){
  $('.form-token').toggle('show');
});

$('.simpan_token').click(function(){
  addtoken();
  dataTableToken.ajax.reload(null,false); 
});

$('.send-token').click(function(){
  $('.kirim_token').toggle('show');
  dataTableToken.ajax.reload(null,false); 
  dataTableSiswa.ajax.reload(null,false); 
  dataRekapToken.ajax.reload(null,false); 

});

$('.set_token').click(function(){
  set_token_to_mahasiswa();
});

$('input[name=status_token]').click(function(){
  status_token = this.value;
  data = $('#masa_aktif_select').val();
  url = base_url+"token/ajax_data_token/"+data+"/"+status_token;

  dataTableToken = $('.daftartoken').DataTable({
    "ajax": {
      "url": url,
      "type": "POST",
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });

  console.log(url);
});


// ketika masa aktif radio button di klik
$('#masa_aktif_select').on('change', function() {
  masa_aktif = this.value ;
  get_filtered_token(masa_aktif);
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
  console.log(id_siswa);
   
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


//fungsi untuk filter token
function get_filtered_token(data){
  status_token = $('input[name=status_token]:checked').val();
  console.log(status_token);
  if (status_token) {
  //kalo tidak undfined
  url = base_url+"token/ajax_data_token/"+data+"/"+status_token;
}else{
    //kalo undefined
    url = base_url+"token/ajax_data_token/"+data;
  }

  console.log(url);

  dataTableToken = $('.daftartoken').DataTable({
    "ajax": {
      "url": url,
      "type": "POST",
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });
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
  dataTableToken.ajax.reload(null,false); 
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