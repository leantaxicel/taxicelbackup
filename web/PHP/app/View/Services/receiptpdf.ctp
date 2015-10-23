<?php
	$config = Configure::read("TaxiCel"); // loading config
    $fpdf->SetAutoPageBreak(true, 0);
	$fpdf->AliasNbPages();
	$fpdf->AddPage();
    //======== Top Square ===========
	$fpdf->SetFont('Arial','B',12);
	//$fpdf->SetFillColor(238,238,238); // gray
	$fpdf->SetFillColor(255,204,42); // gray
	$fpdf->Rect(0,0,210,15,"F");
    //$fpdf->Cell(200,10,"MKH Reports",0,1,'C',true);
	$fpdf->Image($config['BaseUrl'].'img/logo_pdf.png',10,2,0,0);
	//----------------------------------------------
	/*
	$fpdf->SetMargins(10,10,10);
	$fpdf->Text(20,20,"This is for test");
	$fpdf->SetFont('Arial','',9);
	*/
	
	//Blank cell() to set the strating position of first Write()
	$fpdf->Cell(200,8,"",0,1,'',false);
	$fpdf->ln();
	
	$lnWidth = 5;
	
	//First Write
	$fpdf->SetFont('Arial','B',9);
	$fpdf->Write($lnWidth,"Customer Name             : ");
	$fpdf->SetFont('Arial','',9);
	$fpdf->Write($lnWidth,$values['customername']);
	$fpdf->ln();
	
	
	$fpdf->SetFont('Arial','B',9);
	$fpdf->Write($lnWidth,"Pickup Address             : ");
	$fpdf->SetFont('Arial','',9);
	$fpdf->Write($lnWidth,$values['pickupaddress']);
	$fpdf->ln();
	
	$fpdf->SetFont('Arial','B',9);
	$fpdf->Write($lnWidth,"Dropoff Address            : ");
	$fpdf->SetFont('Arial','',9);
	$fpdf->Write($lnWidth,$values['dropoffaddress']);
	$fpdf->ln();
	
	$fpdf->SetFont('Arial','B',9);
	$fpdf->Write($lnWidth,"Date                                 : ");
	$fpdf->SetFont('Arial','',9);
	$fpdf->Write($lnWidth,$values['pickupdatetime']);
	$fpdf->ln();
	
	$fpdf->SetFont('Arial','B',9);
	$fpdf->Write($lnWidth,"Driver Name                   : ");
	$fpdf->SetFont('Arial','',9);
	$fpdf->Write($lnWidth,$values['drivername']);
	$fpdf->ln();
	
	$fpdf->SetFont('Arial','B',9);
	$fpdf->Write($lnWidth,"Driver Contact                : ");
	$fpdf->SetFont('Arial','',9);
	$fpdf->Write($lnWidth,$values['driverphonno']);
	$fpdf->ln();
	
	$fpdf->SetFont('Arial','B',9);
	$fpdf->Write($lnWidth,"Vehicle                            : ");
	$fpdf->SetFont('Arial','',9);
	$fpdf->Write($lnWidth,$values['vehicledetails']);
	$fpdf->ln();
	$fpdf->ln();
	$fpdf->ln();
	
	$fpdf->SetFont('Arial','B',12);
	$fpdf->Write($lnWidth,"Total Ride Cost     : ");
	$fpdf->SetFont('Arial','',9);
	$fpdf->Write($lnWidth,'$ '.$values['ridecost']);
	$fpdf->ln();
	$fpdf->ln();
	$fpdf->ln();
	
	
	
	//========== Bottom Square ===========
	/* $fpdf->SetFont('Arial','',10);
	$fpdf->SetFillColor(33,33,33); // gray
	$fpdf->SetTextColor(255,255,255,255);
	//$fpdf->Rect(10,10,50,50,"DF"); 
	$fpdf->Cell(200,10,"Copyright @Taxicel.com.ar Receipt. All Rights Reserved",10,1,'C',true); */
	
	$fpdf->Line(10,87,100,87);
	
	$fpdf->SetFont('Arial','B',6);
	$fpdf->Write($lnWidth,"Copyright @taxicel.com.ar Receipt. All Rights Reserved");
	//--------------------------------------
    //$fpdf->Output('Report.pdf','D');
    $fpdf->Output(WWW_ROOT.'receipt/'.$file_name,'F');
?>