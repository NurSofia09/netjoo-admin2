		<!-- section -->
		<section class="padding-section">
			<div class="grid-row clear-fix">
				<h2 class="center-text">Tingkat</h2>
				<div class="grid-col-row">
				<?php $tingkat = array(
					"sd"=>'Sekolah Dasar',
					"smp"=>'Sekolah Menengah Pertama',
					"sma"=>'Sekolah Menengah Atas',

				) ?>
				<?php foreach ($tingkat as $key=>$value): ?>
					
					<div class="grid-col grid-col-4">
						<!-- course item -->
						<div class="course-item">
							<div class="course-hover">
								<img src="<?=base_url('assets/back/img/illustrasi') ?>/<?="ico-".$key ?>.png" data-at2x="<?=base_url('assets/back/img/illustrasi') ?>/<?="ico-".$key ?>.png" alt="">
								<div class="hover-bg bg-color-1"></div>
								<!-- <a href="">Learn More</a> -->
							</div>
							<div class="course-name clear-fix">
								<h3><a href="#"><?=$value ?></a></h3>
							</div>
						</div>
						<!-- / course item -->
					</div>
				<?php endforeach ?>


				</div>
			</div>
		</section>
		<!-- / section -->