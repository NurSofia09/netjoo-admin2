<ul class="products">
<?php if(!empty($posts)): foreach($posts as $post): ?>
	<li class="product">
	<div class="list-item">
                                    <div class="center">
                                         <i class="fa fa-file-pdf-o fa-5x"></i>
                                    </div>
                                     <div class="product-name">
                                        <a href="#"><?= $post['judul']?></a>
                                    </div>
                                    <div class="product-description">
                                        <div class="short-description">
                                            <p><?= $post['deskripsi']?></p>
                                        </div>
                                    </div>
                                   <a href="<?= base_url("assets/modul/".$post['url_file'])?>" class="cws-button icon-left alt" target="_blank" style="padding:8"> <i class="fa fa-download"></i>Download</a>
                                 </div>
                            </li>
<?php endforeach; else: ?>
<p>Post(s) not available.</p>
<?php endif; ?>
</ul> 
<div class="clear"></div>
<?php echo $this->ajax_pagination->create_links(); ?>
