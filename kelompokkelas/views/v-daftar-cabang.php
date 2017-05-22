            <!-- MODAL TABEL STEP -->
            <div class="modal fade cabang-modal" tabindex="-1" role="dialog">

              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">




                  </div>
                  <div class="modal-body">
                   <input type="hidden" class="form-control" name="idCabang">
                   <table class="daftar_kelompok_kelas table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Kelompok Kelas</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>

                    <tbody>

                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <!-- MODAL TABEL STEP -->


          <div class="row">
            <div class="col-md-12 kirim_token">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Buat Cabang</h3> 
                </div>
                <div class="panel-body">
                  <form  class="panel panel-default form-horizontal form-bordered form-cabang"  method="post" >
                   <div  class="form-group">
                     <label class="col-sm-2 control-label">Nama Kota</label>
                     <div class="col-sm-3">
                       <!-- stkt = soal tingkat -->
                       <input type="text" class="form-control" name="kota">
                       <input type="hidden" class="form-control" name="id">

                     </div>
                     <label class="col-sm-2 control-label">Alamat</label>
                     <div class="col-sm-4">
                       <!-- stkt = soal tingkat -->
                       <textarea class="form-control" name="alamat"></textarea>
                     </div>

                     <label class="col-sm-2 control-label">Kode Cabang</label>
                     <div class="col-sm-2">
                       <!-- stkt = soal tingkat -->
                       <input type="text" class="form-control" name="kodecabang">
                     </div>

                   </div>

                   <div  class="form-group">
                     <label class="col-sm-1 control-label"></label>
                     <a class="btn btn-primary buat_cabang" onclick="add_cabang()">Simpan</a>
                   </div>



                 </form>
                 <div  class="form-group">
                  <table class="daftar_cabang table table-striped display responsive nowrap" style="font-size: 13px" width=100%>
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nama Kota</th>
                        <th>Alamat</th>
                        <th>Kode Cabang</th>
                        <th>Aksi</th>


                      </tr>
                    </thead>

                    <tbody>

                    </tbody>
                  </table>
                  <hr>

                </div>

              </div>
            </div>
          </div>
          <script type="text/javascript">
          var dataTableCabang; 
          var 

          dataTableKelompokKelas
          $(document).ready(function(){

  // TABLE TOKEN
  dataTableCabang = $('.daftar_cabang').DataTable({
    "ajax": {
      "url": base_url+"cabang/ajax_data",
      "type": "POST"
    },
    "emptyTable": "Tidak Ada Data Pesan",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
    "bDestroy": true,
  });
});

          function add_cabang () {
            metod = $('.buat_cabang').html();
            datas = $('.form-cabang').serialize();

            if (metod=='Simpan') {
              url = base_url+"cabang/insert_cabang_ajax";
            }else{
              url = base_url+"cabang/update_cabang_ajax";
            };

            $.ajax({
              url:url,
              data:datas,
              type:"POST",
              dataType:"TEXT",
              success:function(data){
                console.log(data);
                swal('Cabang Berhasil Di '+metod+'');
                dataTableCabang.ajax.reload(null,false);
                $('.buat_cabang').html('Simpan');
                $('.form-cabang')[0].reset();
              },error:function(){
                swal('Gagal '+metod+' Cabang');
              }
            });
            console.log(datas);
          }

          function drop_cabang(data){
            url = base_url+"cabang/drop_cabang";
            swal({
              title: "Yakin akan hapus Cabang?",
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
                  swal("Terhapus!", "Cabang berhasil dihapus.", "success");
                  dataTableCabang.ajax.reload(null,false)
                },
                error:function(){
                  sweetAlert("Oops...", "Data gagal terhapus!", "error");
                }

              });
            });
          }

          function add_kelas(data){
            var kelas ='.detail-'+data;
            var meta = $(kelas).data('id');

            $('.cabang-modal').modal('show');
            judul = " <h4 class='modal-title' style='display: inline'>Daftar Step : "+
            "<span class='text-info'>"+meta.namaCabang+"</h4>";

            $('.cabang-modal .modal-header').html(judul);
            $('input[name=idCabang]').val(meta.id);
            dataTableKelompokKelas = $('.daftar_kelompok_kelas').DataTable({
              "ajax": {
                // "url": base_url+"cabang/ajax_data",
                "type": "POST"
              },
              "emptyTable": "Tidak Ada Data Pesan",
              "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
              "bDestroy": true,
            });

          }
          function edit_cabang(data){
            var kelas ='.detail-'+data;
            var datas = $(kelas).data('id');
            $('input[name=kota]').val(datas.namaCabang);
            $('input[name=kodecabang]').val(datas.kodeCabang);
            $('textarea[name=alamat]').val(datas.alamat);
            $('input[name=id]').val(datas.id);

            $('.buat_cabang').html('Perbaharui');
          }

          </script>