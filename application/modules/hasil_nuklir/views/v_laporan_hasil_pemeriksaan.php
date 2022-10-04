<?php
// Include the main TCPDF library (search for installation path).
// require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Instalasi SIRS');
$pdf->setTitle('Laporan Hasil Nuklir');
$pdf->setSubject('Instalasi Kedokteran Nuklir');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
// $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('times', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->setFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

$title = <<<EOD
<h1>HASIL PEMERIKSAAN</h1>
EOD;
$pdf->writeHTMLCell(0,0,'','',$title,0,1,0,true,'C',true);

$left_column = 
'
<p><br>
No Medrec   : '.$pasien->NO_MEDREC.'  <br>
Nama        : '.$pasien->NAMA.'<br>
Dr. Pengirim: '.$dokter_periksa.'<br>
Alamat      : '.$pasien->ALAMAT.'<br><br><br>
</p>
';

$right_column = 
'
<p style="text-align:right"><br>
Tgl Pemeriksaan : '.$tglKunjungan.'  <br>
Tgl Lahir       : '.$pasien->TGL_LAHIR.'<br>
Umur            : '.$pasien->UMUR.' Tahun<br>
</p>
';

// $y = $pdf->getY();

$pdf->writeHTMLCell(80,'','','',$left_column,0,0,0,true,'J',true);
$pdf->writeHTMLCell(80,'','','',$right_column,0,1,0,true,'J',true);

$html = '<br><hr>';
$pdf->writeHTML($html,true,false,true,false,'');

$dataHasil = '';
foreach ($hasil as $hsl) {
	// $dataHasil .= '<tr style="width: 0px;">';
	// $dataHasil .= '<td style="padding:0px;">'.$hsl->NM_HASIL.':</td>';
	// $dataHasil .= '<td style="padding:0px;">'.$hsl->NM_HASIL.'</td>';
	// $dataHasil .= '<td style="padding:0px;">'.$hsl->SATUAN.'</td>';
	// $dataHasil .= '<td> (N:'.$hsl->KADAR_NORMAL.' '. $hsl->SATUAN.')</td>';
	// $dataHasil .= '</tr>';

	$dataHasil .= ' '.$hsl->NM_HASIL.' : '.$hsl->NM_HASIL.' '.$hsl->SATUAN.' (N:'.$hsl->KADAR_NORMAL.' '. $hsl->SATUAN.') <br>';
}

$html =
'
<table>' . $dataHasil . '</table>
<br>
<span style="text-align:right;">
<b>Tanda Tangan Pemeriksa</b><br>
'.$ttd.'
</span>
';
$pdf->writeHTML($html,true,false,true,false,'');




// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_clean();
$pdf->Output('report_nuklir.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
