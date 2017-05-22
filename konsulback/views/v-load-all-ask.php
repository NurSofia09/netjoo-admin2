   <input type="text" id="cekload-all2" value="<?=$cekloadAll2;?>" hidden="true">
   <?php
// include "dbConfig.php";

// if(isSet($_POST['getLastContentId']))
// {
// $getLastContentId=$_POST['getLastContentId'];
// $result=mysql_query("select id, isiPertanyaan from tb_k_pertanyaan where id <".$getLastContentId." order by id desc limit 1");
// $count=mysql_num_rows($result);
// if($count>0){

   foreach ($moreask as $row):
     
     $id=$row['pertanyaanID'];

   $message=$row['isiPertanyaan'];
   ?>
   <div class="media-list">
     <a href="<?=base_url('konsulback/konsultasi/') ?><?=$row['pertanyaanID'] ?>" class="media border-dotted">
      <span class="pull-left">
        <img src="<?=base_url("assets/image/photo/siswa/".$row['photo'])?>" class="img-circle" width="65px" height="65px" alt="">
      </span>
      <span class="media-body">
        <span class="media-heading"><?=$row['namaDepan']." ".$row['namaBelakang'] ?></span>
        <span class="media-text ellipsis nm"><?=$row['isiPertanyaan'] ?></span>
        <!-- meta icon -->
        <span class="label label-primary"><i class=" ico-book3"></i><?=$row['judulSubBab'] ?></span>
        <span class="label label-success"><i class="ico-bubble2"></i><?=$row['jumlah'] ?></span>
        <span></span>
        <!--/ meta icon -->
      </span>
      <span class="pull-right">(<?=$row['date_created'] ?>)</span>
    </a>
  </div>
<?php endforeach ?>

<a href="#"><div id="load_more_<?php echo $id; ?>" class="more_tab">
  <div id="<?php echo $id; ?>" class="more_button more-all">Load More</div></a>
</div>

<?php
// } else{
// echo "<div class='all_loaded'>No More Content to Load</div>";
// }
// }
?>

<script type="text/javascript">
  $(document).ready(function(){     
    var cekloadAll2 = $('#cekload-all2').val();
    if (cekloadAll2 == 'false') {
      $('.more-all').hide();
      console.log(cekloadAll2);
    } else {
      console.log(cekloadAll2);
    }

  });
</script>
