<section id="main">
	<div class="row">
		<div class="col-md-12">
		<!-- panel -->
			<div class="panel panel-teal">
				<!-- header panel -->
				<div class="panel-heading">
					<h3 class="panel-title">Export Data Excel Siswa</h3>
					<div class="panel-toolbar text-right">
						<div class="btn-group">
							<a  class="btn btn-sm btn-default" href="<?=base_url()?>assets/excel/template/template_siswa_soc.xlsx" rel="nofollow">Template Excel Siswa</a>
						</div>
					</div>
				</div>
				<!-- /header panel -->
				<!-- panel body -->
				<div class="panel-body">
					<div class="row">
						<!-- div form input file excel -->
						<div class="col-md-12">
							<form class="form">
								<div class="form-group">
									<div class="col-sm-6 mt10" id="div_input">
										<label for="xlf" class="btn btn-sm btn-default">
											Upload File Excel
										</label>
										<input id="xlf" style="display:none;" type="file" name="dat_excel" onchange="Validate_xlsx(this);">
									</div>
									<div class="col-sm-6 mt10 hide" id="div_reset">
										<label class="btn btn-sm btn-danger " onclick="reset_file()" id="reset_file">Reset File Excel</label>
									</div>
								</div>
							</form>
						</div>
						<!-- info div  -->
							<div class="col-md-12 mt10" id="empty_tabel">
							<div class="panel panel-default" style="border: 1px dashed #82C8D4;">
								<div class="panel-body">
									<h3 class="text-center">Priview data excel</h3>
								</div>
							</div>
						</div>
						<!-- info div  -->
						<!-- div priview data exporter-->
						<div class="col-md-12" id="priview_tabel" hidden="true">
						<h3 class="" id="name_tb"></h3>
						<table class="table table-striped display responsive nowrap" style="font-size: 13px" width=100% id="record_priview">
							<thead>
								<tr>
									<th>No</th>
									<th>NISN </th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Tanggal Lahr</th>
									<th>No Kontak</th>
									<th>Nama Sekolah</th>
									<th>Alamat Sekolah</th>
									<th>No Kontak Sekolah</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
							<tfoot>
								<tr>
									<th>No</th>
									<th>NISN</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Tanggal Lahr</th>
									<th>No Kontak</th>
									<th>Nama Sekolah</th>
									<th>Alamat Sekolah</th>
									<th>No Kontak Sekolah</th>
								</tr>
							</tfoot>
						</table>
						</div>
						<!-- //div priview data exporter -->
					</div>
				</div>
				<!-- panel body -->
				<!-- panel footer -->
				<div class="panel-footer">
					<button class="btn btn-sm btn-primary" id="btn-import" disabled="true">Import Data</button>
				</div>
				<!-- panel footer -->
			</div>
			<!-- /panel -->
		</div>
	</div>
</section>
	<script type="text/javascript" src="<?=base_url()?>assets/library/jquery/js/xlsx.full.min.js"></script>
	<!-- Script ajax upload -->
 <script type="text/javascript" src="<?= base_url('assets/js/ajaxfileupload.js') ?>"></script>
<!-- /Script ajax upload -->
<script type="text/javascript">
	var datImport;
	var valid_post=false;
	var datExcel=' ';
$(document).ready(function(){
	$("#btn-import").click(function(){
			post_import_user();
	});
});




function upload_data_xlsx(){

	var url_upload=base_url+"import_user/upload_xlsx";
	var keterangan = "siswa";
	$.ajaxFileUpload({
		url : url_upload,
		type: "post",
		data: {keterangan:keterangan},
		fileElementId :"xlf",
		dataType: "text",
		success:function(Data){
			var ob_data=JSON.parse(Data);
			if (ob_data.status_upload===true) {
				datExcel=ob_data;
				read_data_xlsx(ob_data.url_file);
			 valid_post=true;
			} else {

			}
			
		},
		error:function(){
		
		}
	});
}

	// red data xlsx -> json
	function read_data_xlsx(xlsx) {
		/* set up XMLHttpRequest */
		var url_file =base_url+"assets/excel/"+xlsx;
		var oReq = new XMLHttpRequest();
		oReq.open("GET", url_file, true);
		oReq.responseType = "arraybuffer";
		oReq.onload = function(e) {
			var arraybuffer = oReq.response;
			/* convert data to binary string */
			var data = new Uint8Array(arraybuffer);
			var arr = new Array();
			for(var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
				var bstr = arr.join("");
			/* Call XLSX */
			var workbook = XLSX.read(bstr, {type:"binary"});

			/* DO SOMETHING WITH workbook HERE */
			var first_sheet_name = workbook.SheetNames[0];
			/* Get worksheet */
			var worksheet = workbook.Sheets[first_sheet_name];
			// data json hasil exp
			this.datArr=XLSX.utils.sheet_to_json(worksheet);
			preview_import(this.datArr);
		}
		oReq.send();	
	}


	function preview_import(datArr){
		datImport=datArr;
			var records_tb = [];
			var no=1;
			var i =0;
			if (datImport[0]["kode_verivikasi"]===undefined ) {
				swal("Opps","Harap menggunakan template excel yg sudah disediakan!","error");
			} else {
				show_tb_preview();
				 $.each(datImport, function (key, val) {
        records_tb [i] = [no,val.nisn,val.nama,val.alamat,val.tgl_lahir,val.noKontak,val.namaSekolah,val.alamatSekolah,val.noKontakSekolah];
        no++;
         i++;
    		});
				 $('#record_priview').DataTable( {
				 	data: records_tb,
				 	"processing": true,
				 	"bDestroy": true,
				 });
			}
	}

	function post_import_user(){
		var url=base_url+"import_user/set_siswa_batch";
		var uuid_excel=datExcel.uuid_excel;
		var parse_datPost=JSON.stringify(datImport);
		var datas={datImport:parse_datPost,uuid_excel:uuid_excel};
		$.ajax({
			url:url,
			data:datas,
			type:"post",
			dataType:"text",
			success:function(Data){
				var ob_data=JSON.parse(Data);
				reset_form_xlsx();
				swal("berhasil!",ob_data, "success");
			},
			error:function(){
					swal("error!","sss", "error");
			}
		});
	}
	// End function export excel

	// cek etc file
	function Validate_xlsx(oInput){
		var _validFileExtensions = [".xlsx"]; 
		if (oInput.type == "file") {
			var sFileName = oInput.value;
			if (sFileName.length > 0) {
				var blnValid = false;
				for (var j = 0; j < _validFileExtensions.length; j++) {
					var sCurExtension = _validFileExtensions[j];
					if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
						blnValid = true;
						break;
					}
				}
				if (!blnValid) {
        swal("Oops","Maaf file xtension harus .xlsx","error");
        // return false;
      }else{
				upload_data_xlsx();
				// return true;
      }
    }
  }
	}

	function show_tb_preview() {
		$("#priview_tabel").show(1000);
		$("#empty_tabel").hide(1000);
		$name_xlsx=$("#xlf")[0].files[0]['name'];
		$("#name_tb").html($name_xlsx);
		$("#btn-import").removeAttr("disabled");
		$("#div_input").addClass("hide");
		$("#div_reset").removeClass("hide");
	}
	function reset_form_xlsx() { 
		var datImport='';
		$("#name_tb").empty();
		$("#record_priview tbody tr").remove();
		$("#btn-import").attr("disabled", true);
		$("#priview_tabel").hide(1000);
		$("#empty_tabel").show(1000);
		$("#div_reset").addClass("hide");
		$("#div_input").removeClass("hide");
		$("input[name=dat_excel]").val(null);

	}

	function reset_file() {
		var url_file=datExcel.url_file;
		var url_unlink = base_url+"import_user/unlink_xlsx";
		$.ajax({
			url : url_unlink,
			type: "post",
			data: {url_file:url_file},
			dataType: "text",
			success:function(){
				reset_form_xlsx();
		},
		});
		


	}
</script>