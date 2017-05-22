<section id="main" role="main">
	<div class="row">
		<div class="col-sm-4">
			<!-- START Statistic Widget -->
			<div class="table-layout animation delay animating fadeInDown">
				<div class="col-xs-4 panel bgcolor-info">
					<div class="ico-users3 fsize24 text-center"></div>
				</div>
				<div class="col-xs-8 panel">
					<div class="panel-body text-center ">
						<h4 class="semibold nm jumlah-siswa"><?=$jumlah_siswa?></h4>
						<p class="semibold text-muted mb0 mt5">REGISTERED SISWA</p>
					</div>
				</div>
			</div>
			<!--/ END Statistic Widget -->
		</div>
		<div class="col-sm-4">
			<!-- START Statistic Widget -->
			<div class="table-layout animation delay animating fadeInUp">
				<div class="col-xs-4 panel bgcolor-teal">
					<div class="ico-crown fsize24 text-center"></div>
				</div>
				<div class="col-xs-8 panel">
					<div class="panel-body text-center">
						<h4 class="semibold nm">187</h4>
						<p class="semibold text-muted mb0 mt5">PENDING ACTION</p>
					</div>
				</div>
			</div>
			<!--/ END Statistic Widget -->
		</div>
		<div class="col-sm-4">
			<!-- START Statistic Widget -->
			<div class="table-layout animation delay animating fadeInDown">
				<div class="col-xs-4 panel bgcolor-primary">
					<div class="ico-box-add fsize24 text-center"></div>
				</div>
				<div class="col-xs-8 panel">
					<div class="panel-body text-center">
						<h4 class="semibold nm">10</h4>
						<p class="semibold text-muted mb0 mt5">UPDATE AVAILABLE</p>
					</div>
				</div>
			</div>
			<!--/ END Statistic Widget -->
		</div>
		<div class="col-md-12">
		<!--  -->

			<!-- panel -->
			<div class="panel panel-primary">
				<!-- panel heading/header -->
				<div class="panel-heading">
					<h3 class="panel-title">List Siswa</h3>
				</div>
				<!--/ panel heading/header -->
				<!-- panel body -->
				<div class="panel-body">
					<!-- setting tb siswa -->
					<div class="col-md-12 pl0 pr0" >
						<!-- recor per page tabel pengguna token -->
						<div class="col-md-2 mb2 mt10 pl0">
							<select  class="form-control" name="records_per_page_siswa" >
								<option value="10" selected="true">records per page</option>
								<option value="1" >1</option>
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
								<option value="200">200</option>
							</select>
						</div>
						<!-- /recor per page tabel pengguna token -->
						<!-- div pencarian  -->
						<div class="col-md-10 mb10 mt10 pr0">
							<div class="input-group">
								<span class="input-group-addon btn" id="cariDatSiswa"><i class="ico-search"></i></span>
								<input class="form-control" type="text" name="cariDatSiswa" placeholder="Cari Data">
							</div>
						</div>
						<!-- div pencarian -->
					</div>
					<!--/ setting tb siswa   -->
					<!-- tb_siswa -->
					<table class="table table-bordered col-md-12 tb_siswa">
						<thead>
							<tr>
								<th><span class="checkbox custom-checkbox check-all-siswa">
									<input type="checkbox" name="checkall-siswa" id="check-all-siswa">
									<label for="check-all-siswa">&nbsp;&nbsp;</label></span> </th>
									<th>No</th>
									<th>Nama Pengguna</th>
									<th>Nama</th>
									<th>Cabang</th>
									<th>Mentor</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody id="record-siswa">
							
							</tbody>	
					 
					</table>
					<!-- /tb_siswa -->
												<ul class="pagination" id="pagination-siswa">
								
							</ul>
				</div>
				<!-- /panel body -->
						<div class="panel-footer">
				<a class="btn btn-danger remove-siswa">Remove</a>
			</div>
			<!--/ panel footer -->

			</div>
			<!-- panel -->
		</div>
	</div>
</section>
<script type="text/javascript">
		// property Siswa
	var urlSiswa;
	var datasSiswa;
	var meridianSiswa;
	var prevSiswa=1;
	var nextSiswa=2;
	var cabang='all';
	var pageSiswa;
	var pageValSiswa=0;
	var pageSelekSiswa=0;
	var keySearchSiswa='';
	var tb_siswa;
	var status_mentor_siswa="0";
	var records_per_page_siswa=10;
	var paginationSiswa;
	var id_guru=<?=$id_guru?>;

	$(document).ready(function(){
		function set_tb_siswa() {
			datasSiswa={
									records_per_page_siswa:records_per_page_siswa,
									page:pageSelekSiswa,
									cabang:cabang,
									status_mentor_siswa:status_mentor_siswa,
									keySearchSiswa:keySearchSiswa,
									id_guru:id_guru
			};
			
			urlSiswa=base_url+"mentorback/ajax_list_siswa";
			
			$.ajax({
				url:urlSiswa,
				data:datasSiswa,
				dataType:"text",
				type:"post",
				success:function(data)
				{
					$('#record-siswa').empty();
					tb_siswa= JSON.parse(data);
					$('#record-siswa').append(tb_siswa);
				},
				error:function(e){
					// sweetAlert("Opsss",e,"error");
				}
			});
			
		}
		set_tb_siswa();

		function set_pagination_tb_siswa(){
			var url = base_url+"mentorback/pagination_siswa";
			datasSiswa={
				records_per_page_siswa:records_per_page_siswa,
				page:pageSelekSiswa,
				cabang:cabang,
				status_mentor_siswa:status_mentor_siswa,
				keySearchSiswa:keySearchSiswa,
				id_guru:id_guru
			};

			$.ajax({
				url:url,
				data:datasSiswa,
				type:"POST",
				dataType:"TEXT",
				success:function(Data){
					$("#pagination-siswa").empty();
					paginationSiswa=JSON.parse(Data);
					$("#pagination-siswa").append(paginationSiswa);
				},
				error:function() {
					sweetAlert("OOoops","ada kesalahan pada pagination","error");
				}
			});

		}
		set_pagination_tb_siswa()


		$('[name="checkall-siswa"]:checkbox').click(function () {
			if($(this).attr("checked")){
				$('table.tb_siswa tbody input:checkbox').prop( "checked", true );
			} else{ 
				$('table.tb_siswa tbody input:checkbox').prop( "checked", false );
			}
		});

		$('[name="checkall-mentor"]:checkbox').click(function () {
			if($(this).attr("checked")){
				$('table.tb_mentor tbody input:checkbox').prop( "checked", true );
			} else{ 
				$('table.tb_mentor tbody input:checkbox').prop( "checked", false );
			}
		});

		// even untuk jumlah record per halaman siswa
    $("[name=records_per_page_siswa]").change(function(){
    				pageSelekSiswa=0;
			pageValSiswa=0;
      records_per_page_siswa =$('[name=records_per_page_siswa]').val();
        set_tb_siswa();
       set_pagination_tb_siswa();
    });

		// even untuk filtering tb siswa
		$('[name=cabang]').change(function(){
			pageSelekSiswa=0;
			pageValSiswa=0;
			cabang = $('[name=cabang]').val();
			set_tb_siswa();
			set_pagination_tb_siswa();
		});

				// even untuk filtering tb siswa
		$('[name=status_mentor]').change(function(){
			pageSelekSiswa=0;
			pageValSiswa=0;
			status_mentor_siswa = $('[name=status_mentor]').val();
			set_tb_siswa();
			set_pagination_tb_siswa();
		});

		    $("#cariDatSiswa").click(function(){
    	keySearchSiswa=$("[name=cariDatSiswa]").val();
    			set_tb_siswa();
			set_pagination_tb_siswa();
    });

		$('.remove-siswa').click(function(){

			var id_siswa = [];
			var url=base_url+"mentorback/remove_batch_siswa";
			var datas;
			$('.tb_siswa tbody td :checkbox:checked').each(function(i){
			id_siswa[i] = $(this).val();
			}); 
			// 

			//konfirmasi sweat 
		swal({
			title:"Yakin akan menghapus siswa dari data mentoring ?",
			text: "Anda tidak dapat membatalkan ini.",
			type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Ya,Tetap hapus!",
	    closeOnConfirm: false
		},
		function(){
			//ajax
			if (typeof id_siswa !== 'undefined' && id_siswa.length > 0	) {
				datas={id_guru:id_guru,id_siswa:id_siswa};
				$.ajax({
					url:url,
					data:datas,
					type:"POST",
					dataType:"TEXT",
					success:function(Data){
						obData=JSON.parse(Data);
						set_tb_siswa();
						set_pagination_tb_siswa();
						sweetAlert("Data siswa berhasil di hapus dari mentoring","","success");

						$('.jumlah-siswa').text(obData);

					},
					error:function(){
							// sweetAlert("Noooooooooooooooo","ini gemes","error");
							// console.log(id_siswa);
						}
					});
			}else{
				sweetAlert("Opsss","Silahkan pilih siswa yang akan di hapus","error");
			}

			// ajax
		}
		);

			
			
		});


	});

// remove mentor siswa x
	function removeMentor(id_siswa,namaPengguna){
		var url= base_url+"mentorback/del_mentor_siswa";
		var datas = {id_siswa:id_siswa};
		swal({
			title:"Yakin akan mereset mentor siswa "+namaPengguna+"?",
			text: "Anda tidak dapat membatalkan ini.",
			type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Ya,Tetap hapus!",
	    closeOnConfirm: false
		},
		function(){
			$.ajax({
				url:url,
				data:datas,
				type:"POST",
				dataType:"TEXT",
				success:function(){
					sweetAlert("Yes","INI GEMES","success");
					selectPageSiswa(pageValSiswa);
					selectPageMentor(pageValMentor);
				},
				error:function(){
					sweetAlert("OOoops","ada kesalahan","error");
				}
			});
		}
		);
	}


	function selectPageSiswa(pageValSiswa=0){
		pageSiswa=pageValSiswa;
		pageSelekSiswa=pageSiswa*records_per_page_siswa;
		datasSiswa={
									records_per_page_siswa:records_per_page_siswa,
									page:pageSelekSiswa,
									cabang:cabang,
									status_mentor_siswa:status_mentor_siswa,
									keySearchSiswa:keySearchSiswa,
									id_guru:id_guru
			};
			urlSiswa=base_url+"mentorback/ajax_list_siswa";
			$.ajax({
				url:urlSiswa,
				data:datasSiswa,
				dataType:"text",
				type:"post",
				success:function(data)
				{
					$('#record-siswa').empty();
					tb_siswa= JSON.parse(data);
					$('#record-siswa').append(tb_siswa);
				},
				error:function(e){
					// sweetAlert("Opsss",e,"error");
				}
			});

			//meridian adalah nilai tengah padination
 $('#pageSiswa-'+meridianSiswa).removeClass('active');
  var newMeridian=pageSiswa+1;
  var loop;
  var hidePage;
  var showPage;
  if (newMeridian<=4) {
        $("#page-prevSiswa").addClass('hide');
    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridianSiswa-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =1;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =9;
    prevSiswa=1;
    nextSiswa=7;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#pageSiswa-'+idPaginationhide;
      showPagination='#pageSiswa-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
      idPaginationshow++;
      idPaginationhide--;
    }
  }else if( newMeridian>meridianSiswa){
    $("#page-prevSiswa").removeClass('hide');
        //banyak pagination yg akan di tampilkan dan sisembunyikan
        loop=newMeridian-meridianSiswa;
        // start id pagination yg akan ditampilkan
        var idPaginationshow =newMeridian+3;
        // start id pagination yg akan sembunyikan
        var idPaginationhide =meridianSiswa-3;
        //lakukan pengulangan sebanyak loop
        for (var i = 0; i < loop; i++) {
          hidePagination='#pageSiswa-'+idPaginationhide;
          showPagination='#pageSiswa-'+idPaginationshow;
          //pagination yg di hide
          $(showPagination).removeClass('hide');
          //pagination baru yg ditampilkan
          $(hidePagination).addClass('hide');
                idPaginationshow--;
          idPaginationhide++;
        }
  }else{

    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridianSiswa-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =newMeridian-3;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =meridianSiswa+3;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#pageSiswa-'+idPaginationhide;
      showPagination='#pageSiswa-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
            idPaginationshow++;
      idPaginationhide--;
    }
  } 
   prevSiswa=newMeridian-2;
   nextSiswa=newMeridian;
   meridianSiswa=newMeridian;
   $('#pageSiswa-'+meridianSiswa).addClass('active');
	}
	  // next pageSiswa
function nextPageSiswa() {
  selectPageSiswa(nextSiswa);
}
// prev page
function prevPageSiswa() {
  selectPageSiswa(prevSiswa);
}
</script>