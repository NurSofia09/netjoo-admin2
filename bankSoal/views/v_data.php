
<div class="row">
	<div class="col-sm-12">
		<!--Pengulangan list soal  -->
		<?php 
		$no = $this->uri->segment('3') + 1;
		foreach ($datSoal as $key): ?>
		<!-- START panel -->
		<div class="panel panel-teal mt10">
			<!-- panel-toolbar -->
			<div class="panel-heading ">
				<div class="panel-toolbar">
					<h5 class="semibold nm ellipsis">Sumber Soal : <?=$key['sumber'];?></h5>
				</div>
				<div class="panel-toolbar text-right">
					<div class="btn-group">
						<button type="button" class="btn btn-sm btn-inverse btn-outline"><b style="color:white;">Aksi</b></button>
						<button type="button" class="btn btn-sm btn-inverse btn-outline" data-toggle="dropdown"><span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right">
							<li class="dropdown-header">Pilih Aksi :</li>
							<li ><a href="javascript:void(0)" data-toggle="panelcollapse">Pembahasan (hide/unhide)</a></li>
							<li><a href="<?=base_url()?>banksoal/formUpdate?UUID=<?=$key['UUID']?>&subBab=<?=$key['id_subbab']?>">Edit</a></li>
							<li><a href="#">Hapus</a></li>

						</ul>
					</div>
				</div>
			</div>
			<!--/ panel-toolbar -->
			<!-- panel-body -->
			<div class="panel-body ">
				<h6>Soal: <?=$key['judulSoal']?></h6>
				<!-- Start Gambar soal -->
				<?php $imgSoal = $key['imgSoal'] ?>
				<?php if ($imgSoal != '' && $imgSoal != ' '): ?>
					<div class="overlay text-center">
						<img class="unveiled" src="<?=$imgSoal ;?>" alt="imgSoal" style="max-width:400px;">
					</div>
				<?php endif ?>

				<!-- END Gambar soal -->
				<!-- Start content soal -->
				<p class="text-justify ">
					<?=$key['soal']; ?>
				</p>
				<!-- END start Content -->
			</div>
			<!--/ panel-body -->
			<div class="panel-body pt10 table-responsive panel-collapse pull in ">
				<h6>Pembahasan : </h6>
				<!-- Start img pembahasan -->
				<?php $imgBahas = $key['imgBahas'] ?>
				<?php if ($imgBahas != '' && $imgBahas != ' '): ?>
					<div class="overlay text-center">
						<img class="unveiled" src="<?=$imgBahas ;?>" alt="imgSoal" style="max-width:400px;">
					</div>
				<?php endif ?>
				<!-- END img Pembahsan -->
				<!-- Start Video Pembahasan -->
				<?php $video = $key['videoBahas']; ?>
				<?php if ($video != '' && $video != ' '): ?>
					<video class=" modal-body img-tumbnail image" src="<?=$video;?>" width="100%" height="50%" controls="" id="video-ply" style="background:grey;">
					</video>
				<?php endif ?>
				<!-- END Video Pembahasan -->
				<p><?=$key['pembahasan'];?></p>
				<h6 class="col-sm-6 pl0">Jawaban : <?=$key['jawaban'];?>. <?=$key['isiJawaban'];?></h6>
				<div class="text-right col-sm-6">
					<button type="button" class="btn btn-sm btn-inverse mb5" data-toggle="panelcollapse" title="Sembunyikan"><i class="ico-arrow-up12"></i> </button></div>

				</div>

				<!--  -->
				<!-- panel-footer -->
				<div class="panel-footer hidden-xs">
					<ul class="nav nav-section nav-justified">
						<li>
							<div class="section">
								<i class="ico-file"></i>
								Kesulitan : <?=$key['kesulitan']; ?> 
							</div>
						</li>
						<li>
							<div class="section">
								<i class="ico-file"></i>
								Tingkat : <?=$key['tingkat']?>
							</div>
						</li>
						<li>
							<div class="section">
								<i class="ico-file"></i>
								mapel : <?=$key['mapel'];?>
							</div>
						</li>
						<li>
							<div class="section">
								<i class="ico-file"></i>
								Bab : <?=$key['bab'];?> 
							</div>
						</li>
						<li>
							<div class="section">
								<i class="ico-file"></i>
								Subab:  <?=$key['subBab'];?> 
							</div>
						</li>
					</ul>
				</div>
				<!--/ panel-footer -->
			</div>
			<!--/ END panel -->
		<?php endforeach ?>
		<!-- end Pengulangan list soal -->
	<nav aria-label="Page navigation "><center>
  		<ul class="pagination ">
		<?php 
		echo $this->pagination->create_links();
		?>
		</ul>
		</center>
	</nav>

	</div>

</div>
                        <!--/ Website States
                        <!-- Start javascript -->
                        <!-- Start Math jax --> 
                        <script type="text/x-mathjax-config"> 
                        	MathJax.Hub.Config({ 
                        	tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]} 
                        }); 
                    </script> 
                    <script type="text/javascript" async 
                    src="<?= base_url('assets/plugins/MathJax-master/MathJax.js?config=TeX-MML-AM_HTMLorMML') ?>">
                </script> 
                <!-- end Math jax -->
<!-- End javascript
                       
