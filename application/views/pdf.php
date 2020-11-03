<?php
	
	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetTitle('My Title');
	$pdf->SetHeaderMargin(30);
	$pdf->SetTopMargin(20);
	$pdf->setFooterMargin(20);
	$pdf->SetAutoPageBreak(true);
	$pdf->SetAuthor('Author');
	$pdf->SetDisplayMode('real', 'default');
	$pdf->Ln(10);
	$pdf->AddPage();


	$pdf->Cell(48,8,'No.',1,0);
	$pdf->Cell(48,8,'No.',1,0);
	$pdf->Cell(48,8,'First Name',1,0);
	$pdf->Cell(48,8,'gfhfgh',1,0);
	
	$pdf->Output('My-File-Name.pdf', 'I');
