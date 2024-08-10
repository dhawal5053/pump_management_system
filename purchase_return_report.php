<?php
include 'report_header_footer.php';
include 'config.php';
if (isset($_POST['submit'])) {
    if (isset($_POST['month']) && $_POST['month'] !== '' && isset($_POST['year']) && $_POST['year'] !== '') {
        $month = $_POST['month'];
        $year = $_POST['year'];
        $sql = "SELECT pr.*,prd.*,p.*,r.*,DATE_FORMAT(pr.return_date, '%d-%m-%Y') AS prdate ,DATE_FORMAT(p.purchase_date, '%d-%m-%Y') AS pdate  FROM purchase_return pr,purchase_return_details prd,purchase p,rawmaterial r WHERE prd.purchase_return_purchase_return_id=pr.purchase_return_id AND prd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND pr.purchase_id=p.purchase_id AND MONTH(pr.return_date) = $month AND YEAR(pr.return_date) = $year";    
    } elseif (isset($_POST['start_date']) && $_POST['start_date'] !== '' && isset($_POST['end_date']) && $_POST['end_date'] !== '') {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $sql = "SELECT pr.*,prd.*,p.*,r.*,DATE_FORMAT(pr.return_date, '%d-%m-%Y') AS prdate ,DATE_FORMAT(p.purchase_date, '%d-%m-%Y') AS pdate  FROM purchase_return pr,purchase_return_details prd,purchase p,rawmaterial r WHERE prd.purchase_return_purchase_return_id=pr.purchase_return_id AND prd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND pr.purchase_id=p.purchase_id AND pr.return_date BETWEEN '$start_date' AND '$end_date'";
    }elseif (isset($_POST['month']) && $_POST['month'] !== '') {
        $month = $_POST['month'];
        $sql = "SELECT pr.*,prd.*,p.*,r.*,DATE_FORMAT(pr.return_date, '%d-%m-%Y') AS prdate ,DATE_FORMAT(p.purchase_date, '%d-%m-%Y') AS pdate  FROM purchase_return pr,purchase_return_details prd,purchase p,rawmaterial r WHERE prd.purchase_return_purchase_return_id=pr.purchase_return_id AND prd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND pr.purchase_id=p.purchase_id AND MONTH(pr.return_date) = $month";    
    } elseif (isset($_POST['year']) && $_POST['year'] !== '') {
        $year = $_POST['year'];
        $sql = "SELECT pr.*,prd.*,p.*,r.*,DATE_FORMAT(pr.return_date, '%d-%m-%Y') AS prdate ,DATE_FORMAT(p.purchase_date, '%d-%m-%Y') AS pdate  FROM purchase_return pr,purchase_return_details prd,purchase p,rawmaterial r WHERE prd.purchase_return_purchase_return_id=pr.purchase_return_id AND prd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND pr.purchase_id=p.purchase_id AND YEAR(pr.return_date) = $year";    
    } else {
        $sql = "SELECT pr.*,prd.*,p.*,r.*,DATE_FORMAT(pr.return_date, '%d-%m-%Y') AS prdate ,DATE_FORMAT(p.purchase_date, '%d-%m-%Y') AS pdate  FROM purchase_return pr,purchase_return_details prd,purchase p,rawmaterial r WHERE prd.purchase_return_purchase_return_id=pr.purchase_return_id AND prd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND pr.purchase_id=p.purchase_id ORDER BY purchase_return_id";    
    }  
}

$result = $conn->query($sql);

class PurchaseReturnReport extends PDF{
    function PurchaseReturnData($data) {
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,'Purchase Return Report',0,0,'C');
    $this->Ln(15);
    $this->SetFont('Arial','B',10);
    $this->SetFillColor(200,200,200);
    $this->SetXY(1,50);
    $text= 'PURCHASE RETURN ID';
    $width1 = $this->GetStringWidth($text) -2 ;    
    $this->MultiCell($width1, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $this->SetXY(1,50);
    $x2 = $this->GetX() + $width1;
    $this->SetX($x2);
    $text = 'RETURN DATE';
    $width2 = $this->GetStringWidth($text) +0.5 ;  
    $this->MultiCell($width2, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x3 = $x2 + $width2;
    $this->SetX($x3);
    $text = 'RETURN AMOUNT';
    $width3 = $this->GetStringWidth($text) -8 ;
    $this->MultiCell($width3, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x4 = $x3 + $width3;
    $this->SetX($x4);
    $text = 'PURCHASE DATE';
    $width4 = $this->GetStringWidth($text)+0.5;
    $this->MultiCell($width4, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x6 = $x4 + $width4;
    $this->SetX($x6);
    $text = 'RAWMATERIAL NAME';
    $width5 = $this->GetStringWidth($text) -3 ;
    $this->MultiCell($width5, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x9 = $x6 + $width5;
    $this->SetX($x9);
    $text = 'QUANTITY'."\n".'[QTY]';
    $width6 = $this->GetStringWidth($text) -1 ;
    $this->MultiCell($width6, 6, $text, 1, 'C', true);
    $this->Ln();
    $this->SetFont('Arial','',13.2);
    $this->SetXY(1,62);
    foreach($data as $row) {
        $this->SetX(1);
        $this->Cell($width1,12,$row['purchase_return_id'],1,0,'C');
        $this->Cell($width2,12,$row['prdate'],1,0,'C');
        $this->Cell($width3,12,$row['return_amt'],1,0,'C');
        $this->Cell($width4,12,$row['pdate'],1,0,'C');
        $this->Cell($width5,12,$row['rawmaterial_name'],1,0,'C');
        $this->Cell($width6,12,$row['QTY'],1,1,'C');
    }
}
}


// Display purchase return data
$pdf = new PurchaseReturnReport();
$pdf->AliasNbPages();
$pdf->AddPage();
if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $pdf->PurchaseReturnData($data);
} else {
    $pdf->Cell(0,10,'No purchase return data available.',0,1,'C');
}
$pdf->Output();

?>