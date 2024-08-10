<?php
include 'report_header_footer.php';
include 'config.php';
if (isset($_POST['submit'])) {
    if (isset($_POST['month']) && $_POST['month'] !== '' && isset($_POST['year']) && $_POST['year'] !== '') {
        $month = $_POST['month'];
        $year = $_POST['year'];
        $sql = "SELECT pd.*,p.*,s.*,r.*,DATE_FORMAT(p.purchase_date, '%d-%m-%Y') AS pdate ,DATE_FORMAT(p.payment_date, '%d-%m-%Y') AS padate FROM purchase_details pd,purchase p,supplier s,rawmaterial r WHERE pd.purchase_purchase_id=p.purchase_id AND pd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND p.supplier_id=s.supplier_id AND MONTH(p.purchase_date) = $month AND YEAR(p.purchase_date) = $year";    
    } elseif (isset($_POST['start_date']) && $_POST['start_date'] !== '' && isset($_POST['end_date']) && $_POST['end_date'] !== '') {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $sql = "SELECT pd.*,p.*,s.*,r.*,DATE_FORMAT(p.purchase_date, '%d-%m-%Y') AS pdate ,DATE_FORMAT(p.payment_date, '%d-%m-%Y') AS padate FROM purchase_details pd,purchase p,supplier s,rawmaterial r WHERE pd.purchase_purchase_id=p.purchase_id AND pd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND p.supplier_id=s.supplier_id AND p.purchase_date BETWEEN '$start_date' AND '$end_date'";
    }elseif (isset($_POST['month']) && $_POST['month'] !== '') {
        $month = $_POST['month'];
        $sql = "SELECT pd.*,p.*,s.*,r.*,DATE_FORMAT(p.purchase_date, '%d-%m-%Y') AS pdate ,DATE_FORMAT(p.payment_date, '%d-%m-%Y') AS padate  FROM purchase_details pd,purchase p,supplier s,rawmaterial r WHERE pd.purchase_purchase_id=p.purchase_id AND pd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND p.supplier_id=s.supplier_id AND MONTH(p.purchase_date) = $month";    
    } elseif (isset($_POST['year']) && $_POST['year'] !== '') {
        $year = $_POST['year'];
        $sql = "SELECT pd.*,p.*,s.*,r.*,DATE_FORMAT(p.purchase_date, '%d-%m-%Y') AS pdate ,DATE_FORMAT(p.payment_date, '%d-%m-%Y') AS padate  FROM purchase_details pd,purchase p,supplier s,rawmaterial r WHERE pd.purchase_purchase_id=p.purchase_id AND pd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND p.supplier_id=s.supplier_id AND YEAR(p.purchase_date) = $year";    
    } else {
        $sql = "SELECT pd.*,p.*,s.*,r.*,DATE_FORMAT(p.purchase_date, '%d-%m-%Y') AS pdate ,DATE_FORMAT(p.payment_date, '%d-%m-%Y') AS padate  FROM purchase_details pd,purchase p,supplier s,rawmaterial r WHERE pd.purchase_purchase_id=p.purchase_id AND pd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND p.supplier_id=s.supplier_id ORDER BY purchase_id";    
    }  
}

$result = $conn->query($sql);

class PurchaseReport extends PDF{
    function PurchaseData($data) {
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,'Purchase Report',0,0,'C');
    $this->Ln(15);
    $this->SetFont('Arial','B',10);
    $this->SetFillColor(200,200,200);
    $this->SetXY(1,50);
    $text= 'PURCHASE ID';
    $width1 = $this->GetStringWidth($text) -2 ;    
    $this->MultiCell($width1, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $this->SetXY(1,50);
    $x2 = $this->GetX() + $width1;
    $this->SetX($x2);
    $text = 'PURCHASE DATE';
    $width2 = $this->GetStringWidth($text) +0.5 ;  
    $this->MultiCell($width2, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x3 = $x2 + $width2;
    $this->SetX($x3);
    $text = 'TOTAL AMOUNT';
    $width3 = $this->GetStringWidth($text) -8 ;
    $this->MultiCell($width3, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x4 = $x3 + $width3;
    $this->SetX($x4);
    $text = 'PAYMENT DATE';
    $width4 = $this->GetStringWidth($text)+0.5;
    $this->MultiCell($width4, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x6 = $x4 + $width4;
    $this->SetX($x6);
    $text = 'PAYMENT TYPE';
    $width5 = $this->GetStringWidth($text) -3 ;
    $this->MultiCell($width5, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x9 = $x6 + $width5;
    $this->SetX($x9);
    $text = 'SUPPLIER NAME';
    $width6 = $this->GetStringWidth($text) -1 ;
    $this->MultiCell($width6, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x10 = $x9 + $width6;
    $this->SetX($x10);
    $text = 'RAWMATERIAL NAME';
    $width7 = $this->GetStringWidth($text) -6 ; 
    $this->MultiCell($width7, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x11 = $x10 + $width7;
    $this->SetX($x11);
    $text = 'QUANTITY'."\n".'[QTY]';
    $width8 = $this->GetStringWidth($text) -8 ; 
    $this->MultiCell($width8, 6, $text, 1, 'C', true);
    $this->Ln();
    $this->SetFont('Arial','',13.2);
    $this->SetXY(1,62);
    foreach($data as $row) {
        $this->SetX(1);
        $this->Cell($width1,12,$row['purchase_id'],1,0,'C');
        $this->Cell($width2,12,$row['pdate'],1,0,'C');
        $this->Cell($width3,12,$row['total_amt'],1,0,'C');
        $this->Cell($width4,12,$row['padate'],1,0,'C');
        $this->Cell($width5,12,$row['payment_type'],1,0,'C');
        $this->Cell($width6,12,$row['supplier_name'],1,0,'C');
        $this->Cell($width7,12,$row['rawmaterial_name'],1,0,'C');
        $this->Cell($width8,12,$row['QTY'],1,1,'C');
    }
}
}


// Display purchase data
$pdf = new PurchaseReport();
$pdf->AliasNbPages();
$pdf->AddPage();
if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $pdf->PurchaseData($data);
} else {
    $pdf->Cell(0,10,'No purchase data available.',0,1,'C');
}
$pdf->Output();

?>