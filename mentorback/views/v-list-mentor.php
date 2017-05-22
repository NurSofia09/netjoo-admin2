<section id="main" role="main">
<div class="row">
	<div class="col-md-12">

<!-- Start Panel tab -->
	<div class="panel panel-primary">
		<!-- panel heading/header -->
		<div class="panel-heading">
			<h3 class="panel-title">Set Mentor Siswa</h3>
			<!-- panel toolbar -->
			<div class="panel-toolbar text-right">
				<!-- option -->
				<div class="option">
					<!-- <button class="btn demo" data-toggle="panelrefresh"><i class="reload"></i></button> -->
<!-- 					<button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
					<button class="btn" data-toggle="panelremove" data-parent=".col-md-4"><i class="remove"></i></button> -->
				</div>
				<!--/ option -->
			</div>
			<!--/ panel toolbar -->
		</div>
		<!--/ panel heading/header -->
		<!-- panel body with collapse capable -->
		<div class="panel-collapse pull out">
			<!-- panel toolbar -->
			<div class="panel-toolbar-wrapper">
				<div class="panel-toolbar">
					<ul class="nav nav-tabs nav-justified">
						<li class="active"><a href="#tb_siswa" data-toggle="tab">Tabel Siswa</a></li>
						<li class=""><a href="#tb_mentor" data-toggle="tab">Tabel Mentor</a></li>
					</ul>
				</div>
			</div>
			<!--/ panel toolbar -->
			<!-- panel body -->
			<div class="panel-body">
			<!-- DIV tab content -->
				<div class="tab-content">
					
					<!-- div tabel siswa -->
					<div class="tab-pane col-md-12 active" id="tb_siswa">
						<!-- setting tb siswa -->
						<div class="col-md-12 pl0 pr0" >
							<!-- recor per page tabel pengguna token -->
							<div class="col-md-2 mb2 mt10 pl0">
								<select  class="form-control" name="records_per_page_siswa" >
									<option value="10" selected="true">records per page</option>
									<option value="10">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
									<option value="200">200</option>
								</select>
							</div>
							<!-- /recor per page tabel pengguna token -->
							<!-- seting cabang -->
							<div class="col-md-2 mb2 mt10 pl0">
								<select  class="form-control" name="cabang" >
									<option value="all">Semua Cabang</option>
									<?php foreach ($cabang as $item): ?>
										<option value="<?=$item->id ?>"><?=$item->namaCabang ?></option>
									<?php endforeach ?>
									<!-- <option value="25">Dummy cabang</option> -->
								</select>
							</div>
							<!-- /seting cabang -->
							<!-- seting cabang -->
							<div class="col-md-2 mb2 mt10 pl0">
								<select  class="form-control" name="status_mentor" >
									<!-- <option value="10" selected="true">records per page</option> -->
									<option value="0">Semua Siswa</option>
									<option value="1">Memiliki mentor</option>
									<option value="2">Belum ada mentor</option>
								</select>
							</div>
							<!-- /seting cabang -->
							<!-- div pencarian  -->
							<div class="col-md-6 mb10 mt10 pr0">
								<div class="input-group">
									<span class="input-group-addon btn" id="cariDatSiswa"><i class="ico-search"></i></span>
									<input class="form-control" type="text" name="cariDatSiswa" placeholder="Cari Data">
								</div>
							</div>
							<!-- div pencarian -->
						</div>
						<!--/ setting tb siswa   -->
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
							<ul class="pagination" id="pagination-siswa">
								
							</ul>
						</div>
						<!-- /div tabel siswa -->
						<!-- DIV tabel mentor -->
						<div class="tab-pane col-md-12" id="tb_mentor">
							<!-- setting tb guru -->
							<div class="col-md-12 pl0 pr0" >
								<!-- recor per page tabel pengguna token -->
								<div class="col-md-2 mb2 mt10 pl0">
									<select  class="form-control" name="records_per_page_mentor" >
										<option value="10" selected="true">records per page</option>
										<option value="1">1</option>
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
										<option value="200">200</option>
									</select>
								</div>
								<!-- /recor per page tabel pengguna token -->
								<!-- seting cabang -->
								<div class="col-md-2 mb2 mt10 pl0">
									<select  class="form-control" name="status_mentor_guru" >
										<option value="0">Semua Guru</option>
										<option value="1">Memiliki siswa</option>
										<option value="2">Belum ada siswa</option>
									</select>
								</div>
								<!-- /seting cabang -->

								<!-- seting mapel -->
								<div class="col-md-2 mb2 mt10 pl0">
									<select  class="form-control" name="mapel" >
										<option value="all">Semua mapel</option>
												<?=$mapel?>
									</select>
								</div>
								<!-- /seting mapel -->
								<!-- div pencarian  -->
								<div class="col-md-6 mb10 mt10 pr0">
									<div class="input-group">
										<span class="input-group-addon btn" id="cariDatGuru"><i class="ico-search"></i></span>
										<input class="form-control" type="text" name="cariDatGuru" placeholder="Cari Data">
									</div>
								</div>
								<!-- div pencarian -->
							</div>
							<!--/ setting tb guru   -->
							<table class="table table-bordered tb_mentor">
								<thead>
									<tr>
										<th><span class="checkbox custom-checkbox check-all-mentor">
											<input type="checkbox" name="checkall-mentor" id="check-all-mentor">
											<label for="check-all-mentor">&nbsp;&nbsp;</label></span> </th>
											<th>No</th>
											<th>Nama Pengguna</th>
											<th>Nama</th>
											<th>Pelajaran</th>
											<th>Status mentor</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody id="record-mentor">

									</tbody>

								</table>	
								<ul class="pagination" id="pagination-mentor">
								
							</ul>
							</div>
							<!-- DIV tabel mentor -->
					</div>
					<!-- /DIV tab content	 -->
			</div>
			<!--/ panel body -->
			<!-- panel footer -->
			<div class="panel-footer">
				<a class="btn btn-primary set-mentor">Set Mentor</a>
			</div>
			<!--/ panel footer -->
		</div>
		<!--/ panel body with collapse capabale -->
		<!-- Loading indicator -->
		<div class="indicator"><span class="spinner"></span></div>
		<!--/ Loading indicator -->
</div>
<!-- END Panel tab -->

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
	var id_guru="all";
	// property Mentor
	var urlMentor;
	var datasMentor;
	var meridianMentor;
	var prevMentor=1;
	var nextMentor=2;
	var pageMentor;
	var pageValMentor=0;
	var pageSelekMentor=0;
	var keySearchMentor='';
	var records_per_page_mentor=10;
	var tb_Mentor;
	var status_mentor_guru="0";
	var mapel = "all";

	////

	
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
				keySearchSiswa:keySearchSiswa
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

		function set_tb_mentor() {
			urlMentor=base_url+"mentorback/ajax_list_mentor";
			datasMentor={
					records_per_page_mentor:records_per_page_mentor,
					page:pageSelekMentor,
				mapel:mapel,
				status_mentor_guru:status_mentor_guru,
				keySearchMentor:keySearchMentor
			};
			$.ajax({
				url:urlMentor,
				data:datasMentor,
				dataType:"text",  
				type:"post",
				success:function(data)
				{
					$('#record-mentor').empty();
					tb_Mentor=JSON.parse(data);
					$('#record-mentor').append(tb_Mentor);
				},
				error:function(e){
					// sweetAlert("Opsss",e,"error");
				}
			});
			
		}
		set_tb_mentor();

		function set_pagination_tb_mentor(){
			var url = base_url+"mentorback/pagination_mentor";
			datasMentor={
					records_per_page_mentor:records_per_page_mentor,
					page:pageSelekMentor,
				mapel:mapel,
				status_mentor_guru:status_mentor_guru,
				keySearchMentor:keySearchMentor
			};

			$.ajax({
				url:url,
				data:datasMentor,
				type:"POST",
				dataType:"TEXT",
				success:function(Data){
					$("#pagination-mentor").empty();
					paginationMentor=JSON.parse(Data);
					$("#pagination-mentor").append(paginationMentor);
				},
				error:function() {
					sweetAlert("OOoops","ada kesalahan pada pagination","error");
				}

			});

		}
		set_pagination_tb_mentor();
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

		$(".set-mentor").click(function(){
			set_mentor();
		});

		function set_mentor(){
			var id_siswa = [];
			var id_guru= [];
			$('.tb_siswa tbody td :checkbox:checked').each(function(i){
				id_siswa[i] = $(this).val();
			}); 
			$('.tb_mentor tbody td :checkbox:checked').each(function(i){
				id_guru[i] = $(this).val();
			});


			var datas={	id_siswa:id_siswa,
									id_guru:id_guru
								};
			var url = base_url+"mentorback/set_mentor";
			$.ajax({
				url:url,
				data:datas,
				type:"POST",
				dataType:"TEXT",
				success:function(){
					sweetAlert("Mentoring","Berhasil ditambahkan","success");
					set_tb_siswa();
					set_tb_mentor();
					set_pagination_tb_mentor();
				
				},
				error:function(){
					sweetAlert("OOoops...","error");
				}
			});

		}

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

		$("[name=records_per_page_mentor]").change(function(){
      records_per_page_mentor =$('[name=records_per_page_mentor]').val();
      	console.log(records_per_page_mentor);
        set_tb_mentor();
        set_pagination_tb_mentor();
    });

		// even status mentor guru
    $("[name=status_mentor_guru]").change(function(){
      status_mentor_guru =$('[name=status_mentor_guru]').val();
        set_tb_mentor();
        set_pagination_tb_mentor();
    });

    // event filter mapael guru
    $("[name=mapel]").change(function(){
      mapel =$('[name=mapel]').val();
      console.log(mapel);
        set_tb_mentor();
        set_pagination_tb_mentor();
    });

    //even onclik cari siswa 

    $("#cariDatSiswa").click(function(){
    	keySearchSiswa=$("[name=cariDatSiswa]").val();
    			set_tb_siswa();
			set_pagination_tb_siswa();
    });

     $("#cariDatGuru").click(function(){
    	keySearchMentor=$("[name=cariDatGuru]").val();
    		  set_tb_mentor();
        set_pagination_tb_mentor();
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

		// remove  siswa dari mentor x
	function removeSiswaMentoring(id_guru,namaPengguna){
		var url= base_url+"mentorback/del_siswa_mentor";
		var datas = {id_guru:id_guru};
		swal({
			title:"Yakin akan mereset siswa pada guru "+namaPengguna+"?",
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

					sweetAlert("Yes","INI GEMES guru","success");
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




function selectPageMentor(pageValMentor=0){
    pageMentor=pageValMentor;
    pageSelekMentor=pageMentor*records_per_page_mentor;
			datasMentor={
					records_per_page_mentor:records_per_page_mentor,
					page:pageSelekMentor,
				mapel:mapel,
				status_mentor_guru:status_mentor_guru,
				keySearchMentor:keySearchMentor
			};
      urlMentor=base_url+"mentorback/ajax_list_mentor";

      $.ajax({
        url:urlMentor,
        data:datasMentor,
        dataType:"text",
        type:"post",
        success:function(data)
        {
          $('#record-mentor').empty();
          tb_Mentor= JSON.parse(data);
          $('#record-mentor').append(tb_Mentor);
        },
        error:function(e){
          // sweetAlert("Opsss",e,"error");
        }
      });

      //meridian adalah nilai tengah padination
 $('#pageMentor-'+meridianMentor).removeClass('active');
  var newMeridian=pageMentor+1;
  var loop;
  var hidePage;
  var showPage;
  if (newMeridian<=4) {
        $("#page-prevMentor").addClass('hide');
    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridianMentor-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =1;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =9;
    prevMentor=1;
    nextMentor=7;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#pageMentor-'+idPaginationhide;
      showPagination='#pageMentor-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
      idPaginationshow++;
      idPaginationhide--;
    }
  }else if( newMeridian>meridianMentor){
    $("#page-prevMentor").removeClass('hide');
        //banyak pagination yg akan di tampilkan dan sisembunyikan
        loop=newMeridian-meridianMentor;
        // start id pagination yg akan ditampilkan
        var idPaginationshow =newMeridian+3;
        // start id pagination yg akan sembunyikan
        var idPaginationhide =meridianMentor-3;
        //lakukan pengulangan sebanyak loop
        for (var i = 0; i < loop; i++) {
          hidePagination='#pageMentor-'+idPaginationhide;
          showPagination='#pageMentor-'+idPaginationshow;
          //pagination yg di hide
          $(showPagination).removeClass('hide');
          //pagination baru yg ditampilkan
          $(hidePagination).addClass('hide');
                idPaginationshow--;
          idPaginationhide++;
        }
  }else{

    //banyak pagination yg akan di tampilkan dan sisembunyikan
    loop=meridianMentor-newMeridian;
    // start id pagination yg akan ditampilkan
    var idPaginationshow =newMeridian-3;
    // start id pagination yg akan sembunyikan
    var idPaginationhide =meridianMentor+3;
    //lakukan pengulangan sebanyak loop
    for (var i = 0; i < loop; i++) {
      hidePagination='#pageMentor-'+idPaginationhide;
      showPagination='#pageMentor-'+idPaginationshow;
      //pagination yg di hide
      $(showPagination).removeClass('hide');
      //pagination baru yg ditampilkan
      $(hidePagination).addClass('hide');
        idPaginationshow++;
      	idPaginationhide--;
    }
  } 
   prevMentor=newMeridian-2;
   nextMentor=newMeridian;
   meridianMentor=newMeridian;
   $('#pageMentor-'+meridianMentor).addClass('active');
  }
    // next pageMentor
function nextPageMentor() {
  selectPageMentor(nextMentor);
}
// prev page
function prevPageMentor() {
  selectPageMentor(prevMentor);
}




</script>