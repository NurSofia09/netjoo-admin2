 <input type="text" id="cekload-mapel2" value="<?=$cekloadMapel2;?>" hidden="true">
 <?php
// include "dbConfig.php";

// if(isSet($_POST['getLastContentId']))
// {
// $getLastContentId=$_POST['getLastContentId'];
// $result=mysql_query("select id, isiPertanyaan from tb_k_pertanyaan where id <".$getLastContentId." order by id desc limit 1");
// $count=mysql_num_rows($result);
// if($count>0){
 foreach ($moreask1 as $value):
   
   $id=$value['pertanyaanID'];

 $message1=$value['isiPertanyaan'];
 ?>
 <div class="media-list">
   <a href="<?=base_url('konsulback/konsultasi/') ?><?=$value['pertanyaanID'] ?>" class="media border-dotted">
    <span class="pull-left">
      <img src="<?=base_url("assets/image/photo/siswa/".$value['photo'])?>" class="img-circle" width="65px" height="65px" alt="">
    </span>
    <span class="media-body">
      <span class="media-heading"><?=$value['namaDepan']." ".$value['namaBelakang'] ?></span>
      <span class="media-text ellipsis nm"><?=$value['isiPertanyaan'] ?></span>
      <!-- meta icon -->
      <span class="label label-primary"><i class=" ico-book3"></i><?=$value['judulSubBab'] ?></span>
      <span class="label label-success"><i class="ico-bubble2"></i><?=$value['jumlah'] ?></span>
      <span></span>
      <!--/ meta icon -->
    </span>
    <span class="pull-right">(<?=$value['date_created'] ?>)</span>
  </a>
</div>
<?php endforeach ?>

<a href="#"><div id="load_more1_<?php echo $id; ?>" class="more_tab">
  <div id="<?php echo $id; ?>" class="more_button1 more-mapel">Load More Pertanyaan saya</div></a>
</div>

<script type="text/javascript">
  $(document).ready(function(){     
    var cekloadMaple2 = $('#cekload-mapel2').val();
    if (cekloadMaple2 == 'false') {
      $('.more-mapel').hide();
      console.log(cekloadMaple2);
    } else {
      console.log(cekloadMaple2);
    }

  });
</script>
