<section class="main">
	<div class="row">
		<div class="col-md-12">
			<!-- assets/pdf/user_guide/Tutorial-I-Latihan-Siswa.pdf -->
			<embed src="" width="100%" height="670" type='application/pdf' id='embed_pdf'>
			</div>
			<div class="col-md-3" id="list_ug_admin">
				
				
			</div>
		</div>
	</section>
	<script type="text/javascript">
	var url_pdf="<?=base_url()?>assets/pdf/user_guide/Tutorial-Admin.pdf";
		$(document).ready(function(){
			set_pdf();
		});
		function set_pdf(){
			$("#embed_pdf").attr('src',url_pdf);
		}

	</script>