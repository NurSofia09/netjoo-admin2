<?php



// extend TCPF with custom functions
class MYPDF extends TCPDF {

	// Load table data from file
	public function LoadData($file) {
		// Read file lines
		$lines = file($file);
		$data = array();
		foreach($lines as $line) {
			$data[] = explode(';', chop($line));
		}
		return $data;
	}

	public function DrawHeader($header, $w) {
        // Colors, line width and bold font
        // Header
		$this->SetFillColor(255, 0, 0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128, 0, 0);
		$this->SetLineWidth(0.3);
		$this->SetFont('', 'B');        
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
        // Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
    }

	// Colored table
	public function ColoredTable($header,$data) {
		$w = array(10, 50, 25, 25, 25, 25,25);
		   $this->DrawHeader($header, $w);
		$fill = 0;
		foreach($data as $row) {
			//Get current number of pages.
			$num_pages = $this->getNumPages();
      $this->startTransaction();
			$this->Cell($w[0], 6, $row['no'], 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, ($row['nama']), 'LR', 0, 'LR', $fill);
			$this->Cell($w[2], 6, ($row['jumlah_soal']), 'LR', 0, 'C', $fill);
			$this->Cell($w[3], 6, ($row['jmlh_benar']), 'LR', 0, 'C', $fill);
			$this->Cell($w[4], 6, ($row['jmlh_salah']), 'LR', 0, 'C', $fill);
			$this->Cell($w[5], 6, ($row['jmlh_kosong']), 'LR', 0, 'C', $fill);
			$this->Cell($w[6], 6, ($row['nilai']), 'LR', 0, 'C', $fill);
			$this->Ln();
			 //If old number of pages is less than the new number of pages,
            //we hit an automatic page break, and need to rollback.
			//repeat header
			if($num_pages < $this->getNumPages())
			{
        //Undo adding the row.
				$this->rollbackTransaction(true);
      	//Adds a bottom line onto the current page. 
      	//Note: May cause page break itself.
				// $this->Cell(array_sum($w), 0, '', 'T');
      	//Add a new page.
				$this->AddPage();
      	//Draw the header.
				$this->DrawHeader($header, $w);
      	//Re-do the row.
				$this->Cell($w[0], 6, $row['no'], 'LR', 0, 'L', $fill);
				$this->Cell($w[1], 6, ($row['nama']), 'LR', 0, 'LR', $fill);
				$this->Cell($w[2], 6, ($row['jumlah_soal']), 'LR', 0, 'C', $fill);
				$this->Cell($w[3], 6, ($row['jmlh_benar']), 'LR', 0, 'C', $fill);
				$this->Cell($w[4], 6, ($row['jmlh_salah']), 'LR', 0, 'C', $fill);
				$this->Cell($w[5], 6, ($row['jmlh_kosong']), 'LR', 0, 'C', $fill);
				$this->Cell($w[6], 6, ($row['nilai']), 'LR', 0, 'C', $fill);
				$this->Ln();
			}
			else
			{
                //Otherwise we are fine with this row, discard undo history.
				$this->commitTransaction();
			}
			//
			$fill=!$fill;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Laporan_TO');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, a, test, guide');

// set default header data
$img=base_url().'/assets/back/img/logo.png';
$pdf->SetHeaderData('logo.png', '10%', PDF_HEADER_TITLE." Cabang ".$cabang,PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 9);

// add a page
$pdf->AddPage();

// column titles
$header = array('No','Nama Siswa','Jumlah Soal',' 
	Jumlah Benar',' Jumlah Salah',' Jumlah Kosong','Total nilai');

//vardump
// var_dump($all_report);

// data loading
//judul tabel
$nameTbl='<h1>Hasil TryOUT Paket '.$paket.'</h1>';
$pdf->writeHTML($nameTbl,false, false, false, false, '');
// print colored table
$pdf->ColoredTable($header, $all_report);
// ---------------------------------------------------------
$kesimpulan='<br><h1>Kesimpulan</h1>
';
$pdf->writeHTML($kesimpulan,false, false, false, false, '');
$tbl = '
<table border="1" >
 <thead>

	 <tr style="background-color:#FF0000;color:white;">
	    <th align="center"><b>Jumlah Siswa</b></th>
	    <th align="center"><b>Rata</b></th>
	    <th align="center"><b>Nilai Tertinggi</b></th>
	    <th align="center"><b>Nilai Terendah</b></th>
	 </tr>
	</thead>
	  <tbody>
		 <tr>
	    <th align="center">'.$jumlahSiswa.'</th>
	     <th align="center">'.$avg.'</th>
	     <th align="center">'.$maxNilai.'</th>
	   	<th align="center">'.$minNilai.'</th>
	 </tr>
	  </tbody>
 </table> '
 ;
$pdf->writeHTML($tbl,  true, false, true, false, '');
// close and output PDF document
$pdf->Output('Laporan_TO.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
