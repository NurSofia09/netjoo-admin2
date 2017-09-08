<section class="main">
	<div class="row">
		<div class="col-md-9">
			<!-- assets/pdf/user_guide/Tutorial-I-Latihan-Siswa.pdf -->
			<embed src="" width="100%" height="670" type='application/pdf' id='embed_pdf'>
			</div>
			<div class="col-md-3" id="list_ug">
				
				
			</div>
		</div>
	</section>
	<script type="text/javascript">
	var url_pdf="<?=base_url()?>assets/pdf/user_guide/Tutorial-II-Tryout-Siswa.pdf";
		$(document).ready(function(){
			get_list_user_guide();
			set_pdf();
		});
		function set_pdf(){
			$("#embed_pdf").attr('src',url_pdf);
		}
		function get_list_user_guide(){
			var url=base_url+"help/get_list_user_guide";
			$.ajax({
				url:url,
				type:"post",
				dataType:"text",
				success:function(Data){
					var ob_data= JSON.parse(Data);
					$("#list_ug").append(ob_data);
				},
				error:function(){
					console.log("ada kesalahan");
				}
			});
		}
		function get_pdf_ug(id=''){
			var url=base_url+"help/get_pdf_user_guide";
			$.ajax({
				url:url,
				data:{id:id},
				type:"post",
				dataType:"text",
				success:function(Data){
					var ob_data= JSON.parse(Data);
				 	url_pdf="<?=base_url()?>assets/pdf/user_guide/"+ob_data+".pdf";
				 set_pdf();
					// $("#list_ug").append(ob_data);

				},
				error:function(){
					console.log("ada kesalahan");
				}
			});
		}
	</script>