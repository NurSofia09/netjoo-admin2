<?php
class Logtryout extends MX_Controller {


	function __construct(){
		$this->load->library('parser');
		$this->load->model('logtryout_model');
        date_default_timezone_set('Asia/Jakarta');

	}

	function ajax_status_to($cabang="all",$tryout="all",$paket="all",$records_per_page=10,$page=0,$keySearch=''){

				//data post
		$records_per_page=$this->input->post('records_per_page');
		$page=$this->input->post('page');
		//data post
		# get cabang
		$cabang=$this->input->post('cabang');
		$tryout=$this->input->post('tryout');
		$paket=$this->input->post('paket');
		$keySearch=$this->input->post('keySearch');
		
		$data['param'] = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
$list = $this->logtryout_model->get_log_tryout($data['param'],$records_per_page,$page,$keySearch);
		// if ($keySearch != '' && $keySearch !=' ' ) {
		// 	$list='';
		// }
			
		// } else {
		// 	$list = $this->logtryout_model->get_log_tryout($data['param'],$records_per_page,$page);
		// }

		$no=$page+1;
		$tb_paket=null;
		$no=$page+1;
		foreach ( $list as $list_item ) {

			$waktu_mulai = date('Y-m-d H:i:s',strtotime($list_item['waktu_mulai']));
			$date_mulai =  new DateTime($waktu_mulai);
			$waktu_minggat = $date_mulai->modify('+'.$list_item['durasi'].' minutes');
			$sekarang = new DateTime('now');


			if ($list_item['status_pengerjaan']=="") {
				if ($sekarang>=$waktu_minggat) {
					$status="<i class='ico-paper-plane text-danger' title='meninggalkan'></i>";
				}else{
					$status="<i class='ico-pencil3 text-primary' title='sedang mengerjakan'></i>";
				}
			} else {
				// jika waktu mulai + durasinya >= sekarang
				// artikan dia sebagai minggat
				$status="<i class='ico-checkmark3 text-success' title='selesai mengerjakan'></i>";
				
			}

			$tb_paket.=	'<tr>
			<td>'.$no.'</td>	
			<td>'.$list_item ['namaPengguna'].'</td>
			<td>'.$list_item['namaDepan'].' '.$list_item['namaBelakang'].'</td>
			<td>'.$list_item['waktu_mulai'].'</td>
			<td>'.$list_item['nm_tryout'].'</td>
			<td>'.$list_item['nm_paket'].'</td>
			<td>'.$status.'</td>
			</tr>';

		$no++;
		}
		echo json_encode( $tb_paket );
	}

public function pagination_tb_logtryout($cabang="all",$tryout="all",$paket="all",$records_per_page=2,$page=0,$keySearch='')
	{
		//data post
		$records_per_page=$this->input->post('records_per_page');
		// $page=$this->input->post('page');
		//data post
		# get cabang
		$cabang=$this->input->post('cabang');
		$tryout=$this->input->post('tryout');
		$paket=$this->input->post('paket');
		$keySearch=$this->input->post('keySearch');
		$datas = ['cabang'=>$cabang,'tryout'=>$tryout,'paket'=>$paket];
		$jumlah_data = $this->logtryout_model->jumlah_log_tryout($datas);

		$pagination='<li class="hide" id="page-prev"><a href="javascript:void(0)" onclick="prevPage()" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a></li>';

    	 $pagePagination=1;

    	 $sumPagination=($jumlah_data/$records_per_page);

    	 for ($i=0; $i < $sumPagination; $i++) { 
    	 	if ($pagePagination<=7) {
    	 		    	 	$pagination.='<li ><a href="javascript:void(0)" onclick="selectPagelogtryout('.$i.')" id="page-'.$pagePagination.'">'.$pagePagination.'</a></li>';
    	 	}else{
    	 		    	 	$pagination.='<li class="hide" id="page-'.$pagePagination.'"><a href="javascript:void(0)" onclick="selectPagelogtryout('.$i.')" >'.$pagePagination.'</a></li>';
    	 	}

    	 	$pagePagination++;
    	 }

    	if ($pagePagination>7) {
    	 	  $pagination.='<li class="" id="page-next">
		      								<a href="javascript:void(0)" onclick="nextPage()" aria-label="Next">
		        								<span aria-hidden="true">&raquo;</span>
		      								</a>
		    								</li>';
    	 }

    	 if ($pagePagination<3) {
    	 		$pagination='';
    	 }
    	 

		echo json_encode($pagination);
	}
}
?>