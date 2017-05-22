<div class="modal fade " tabindex="-1" role="dialog" id="modalTo">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
    <h2 class="text-center"></h2>
  </div>
  <div class="modal-body">
    <p>  </p> 
  </div>
  <div class="modal-footer">
    <span></span>
  </div>
</form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

<style type="text/css">
.dataTables_filter input{
  display: inline-block;
  background-color: #ffffff;
  line-height: 40px;
  height: 40px;
  padding: 0 18px;
  border: #f27c66 2px solid;
}

.dataTables_length select{
  display: inline-block;
  background-color: #ffffff;
  line-height: 40px;
  height: 40px;
  padding: 0 18px;
  border: #f27c66 2px solid;
}
</style>

<!-- START Blog Content -->
<section class="section bgcolor-white"> 
  <div class="container">
   <!-- START Row -->
   <div class="row">
    <h3>Daftar Tryout</h3>
    <form action="" id="">
      <div class="row">
        <table class="table" style="font-size: 13px">
          <thead>
           <tr>
            <th>ID Tryout</th>
            <th width="10%">Aksi</th>

            <th>Nama Tryout</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Berakhir</th>

            <th>Masa berlaku TO</th>
            <th>Keaktivan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tryout as $tryout_item): ?>
          <tr>
           <?php 
            $date1 = new DateTime($tryout_item['tgl_mulai']);
            $date2 = new DateTime($tryout_item['tgl_berhenti']);
            $date3 = $date2->diff($date1);
            $hariini = new DateTime(date("Y-m-d"));
            $sisa = new stdClass();
            if ($hariini>$date2) {
              $sisa->days = 0;
            } else {
              $sisa = $date2->diff($hariini);
            }
            ?>

            <td><?=$tryout_item['id_tryout'] ?></td>
            <td>
              <?php if ($sisa->days == 0): ?>
              <a class="btn btn-primary detail-<?=$tryout_item['id_tryout']?>" 
                title="Lihat Paket Soal" 
                data-todo='<?=json_encode($tryout_item) ?>'
                onclick="lihat_detail(<?=$tryout_item['id_tryout'] ?>)"
                ><i class="glyphicon glyphicon-list-alt"></i></a>


              <?php else: ?>
              <a class="btn btn-primary detail-<?=$tryout_item['id_tryout']?>" 
                title="Lihat Paket Soal" 
                data-todo='<?=json_encode($tryout_item) ?>'
                onclick="lihat_detail(<?=$tryout_item['id_tryout'] ?>)"
                ><i class="glyphicon glyphicon-list-alt"></i></a>
              <?php endif ?>
            </td>
            <td><?=$tryout_item['nm_tryout'] ?></td>
            <td><?=$tryout_item['tgl_mulai']." ".$tryout_item['wkt_mulai'] ?></td>
            <td><?=$tryout_item['tgl_berhenti']." ".$tryout_item['wkt_berakhir']?></td>

           

            <td><?=$date3->d." Hari" ?></td>
            <td><?=$sisa->days ?> Hari</td>
            
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</section>
</section>

<!--/ END Template Main -->

<script type="text/javascript" src="<?= base_url('assets/plugins/datatables/js/jquery.datatables.min.js') ?>"></script>
<script type="text/javascript">
function lihat_detail(id_to){
  window.location.href = base_url + "index.php/tryout/create_seassoin_idto/"+id_to;
  var kelas = ".detail-"+id_to;
  var data_to = $(kelas).data('todo');
}

$(document).ready(function() {
  $('.table').dataTable( {
    "bFilter": false,
    "bPaginate":false,
    "bInfo":false
  });
});
</script>

