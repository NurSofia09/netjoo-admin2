<style type="">
	li:before{
		opacity: 0;
	}
	.timeline {
		list-style: none;
	}
	.timeline > li {
		margin-bottom: 60px;
	}

	/* for Desktop */
	@media ( min-width : 640px ){
		.timeline > li {
			overflow: hidden;
			margin: 0;
			position: relative;
		}
		.timeline-date {
			width: auto;
			float: left;
			margin-right: 10px;
		}
		.timeline-content {
			margin-top:-6px;
			float: left;
			border-left: 3px #e5e5d1 solid;
			padding-left: 30px;
			top: 0;
		}
		.timeline-content:before {
			content: '';
			width: 12px;
			height: 12px;
			background: #e5e5d1;
			position: absolute;
			left: 72px;
			top: 5px;
			border-radius: 100%;
		}
	}
</style>
<main>	
		<ul class="timeline">
			<?php foreach ($semuavideo as $video): ?>

				<li>
					<p class="timeline-date"><?=date('d-M',strtotime( $video->date_created))." "?></p>
					<div class="timeline-content">
					<a href=""><?=$video->judulVideo ?></a>
					</div>
				</li>
			<?php endforeach ?>

		</ul>


	</div>
	<br>
</main>
