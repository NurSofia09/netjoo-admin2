<style>
  .canvasjs-chart-credit {
   display: none;
 }
 .table th:hover{
  cursor: hand;
}

.pagination li:before{
  color:white;
}
</style>
<!-- MODAL LATIHAN PERSENTASE-->

<div class="modal fade " tabindex="-1" role="dialog" id="myModal">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
  </div>
  <div class="modal-body">
    <div id="chartContainer" style="height: 400px; width: 100%;">
    </div>
  </form>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

<div class="page-title" style="background:#2b3036">
  <div class="grid-row">
    <?php if ($this->session->userdata('HAKAKSES')=='ortu'): ?>
    <h1>Halo <?=$this->session->userdata['USERNAME']?> , orang tua dari <?=$siswa?>  </h1>
    <?php else: ?>
      <h1>Halo, <?=$this->session->userdata['USERNAME']?> !  </h1>
  <?php endif ?>


  </div>
</div>





<!-- video random -->
<section class="section bgcolor-white"> 
  <div class="container">
<!-- video random -->

<div class="col-md-12">

      <!-- gallery navigation -->
      <h4>Paket Soal yang Sudah Dikerjakan</h4>
      <!-- gallery container -->

      <embed src="" width="100%" height="670" type='application/pdf' id='embed_pdf'>
      </div>
      <div class="col-md-3" id="list_ug">
      

    </div>

  </div>

  <!-- / gallery container -->
</section>

<script type="text/javascript">
  var url_pdf="<?=base_url()?>assets/pdf/user_guide/Tutorial-Siswa.pdf";
    $(document).ready(function(){
      set_pdf();
    });
    function set_pdf(){
      $("#embed_pdf").attr('src',url_pdf);
    }

  </script>




