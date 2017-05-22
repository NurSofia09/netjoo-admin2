	<div class="page-title" style="background:#2b3036">

    <div class="grid-row">

        <h1>{judul_header2}</h1>

    </div>

</div>
	<div class="page-content">
		<div class="container">
			<main>
				
				<div class="grid-col-row clear-fix" >

					<?php  
 								$n=0;
 								$oldMpalel='';
 					?>
 					<?php foreach ($datMapel as $key): ?>
 						<?php $mapel=$key['mapel'] ?>
 						<?php if ($n==0): ?>
 							<?php $n=1; ?>
 							<!-- Start header info -->
 					<div class="grid-col col-md-2">
						<div class="hover-effect">
							
						</div>
						<h5><strong><?=$mapel?><hr></strong></h5>
						<!-- <ol> -->
 							<!--  -->
 						<?php elseif($oldMpalel != $mapel) : ?>
 							<!-- footer -->
 					<!-- 	</ol> -->
					</div>
 							<!--  -->
 							<!-- Start header info -->
 					<div class="grid-col col-md-2">
						<div class="hover-effect">
							
						</div>
						<h5><strong><?=$mapel?><hr></strong></h5>
						<!-- <ol> -->
 							<!--  -->

 						<?php endif ?>
								<!-- <li> -->
								<a href="<?=base_url('index.php')?>/linetopik/learningline/<?=$key['babID']?>" class="text-info"><?=$key['judulBab']?></a><br>
								<!-- </li> -->
							<?php $oldMpalel=$mapel; ?>
							<?php endforeach ?>

							<?php if ($datMapel==array()): ?>
								<h4 class="text-center" style="color:#f27c66;">Maaf,Pada Tingkat ini belum tersedia learning line!</h4>
							<?php endif ?>
						

				</div>

			</main>
		</div>
	</div>