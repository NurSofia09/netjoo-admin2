  <div class="row">
<!-- LAPORAN SEMUA PAKET TRYOUT -->
  <div class="col-md-12">
                <div class="panel panel-teal">
                    <!--Start untuk menampilkan nama tabel -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar Nilai Tryout</h3>
                       <div class="panel-toolbar text-right">
                            
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped rpaket"  style="font-size: 13px" width="100%">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>Nama Siswa</th>
                                    <th>Nama Paket</th>
                                    <th>Jenis</th>
                                    <th>Nama Tryout</th>
                                    <th>Jumlah Soal</th>
                                    <th>Benar</th>
                                    <th>Salah</th>
                                    <th>Kosong</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>


            </div>
<!-- LAPORAN SEMUA PAKET TRYOUT -->


<!--datatable-->
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/tabletools.min.js') ?>"></script>
<!--<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/tabletools/js/zeroclipboard.js') ?>"></script>-->
<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables-custom.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/javascript/tables/datatable.js') ?>"></script>
<script type="text/javascript">
    
    // ## datatable report tryout
url = base_url+"admin/ajax_report_tryout";

dataTableReportPaket = $('.rpaket').DataTable({
  "ajax": {
    "url": url,
    "type": "POST",
  },
  "emptyTable": "Tidak Ada Data Pesan",
  "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
  "bDestroy": true,
});
// ## datatable report tryout

function reload_table(){
    table.ajax.reload(null,false); //reload datatable ajax 
}
function delete_report(id)
{

// =============
url = base_url+"index.php/admin/dropreporttry/"+id;
    console.log(id);
  swal({
    title: "Yakin akan menghapus Paket ini?",
    text: "Anda tidak dapat membatalkan ini.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya,Tetap hapus!",
    closeOnConfirm: false
  },

  function(){
    var datas = {id:id};
    $.ajax({
      dataType:"text",
      data:datas,
      type:"POST",
      url:url,
      success:function(){
        swal("Terhapus!", "Paket berhasil dihapus.", "success");
        reload_table();
      },
      error:function(){
        sweetAlert("Oops...", "Data gagal terhapus!", "error");
      }
    });
  });

// ======================

}


</script>