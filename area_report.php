<?php
include 'report_header_footer.php';
include 'config.php';

$sql = "SELECT a.*,c.* FROM area a,city c";
$result = $conn->query($sql);

class AreaReport extends PDF{
function AreaData($data) {
    $this->SetFont('Arial','B',15);
    $this->Cell(80);
    $this->Cell(30,10,'Area Report',0,0,'C');
    $this->Ln(15);
    $this->SetFont('Arial','B',12);
    $pageWidth = $this->GetPageWidth();
    $tableWidth = 40 * 3 + 2 * 1; 
    $centerX = ($pageWidth - $tableWidth) / 2;
    $this->SetXY($centerX, $this->GetY());
    $this->SetFillColor(200,200,200);
        $this->Rect($this->GetX(), $this->GetY(), 40, 10, 'DF');
        $this->Cell(40,10,'PINCODE',1,0,'C');
        $this->Rect($this->GetX(), $this->GetY(), 40, 10, 'DF');
        $this->Cell(40,10,'AREA NAME',1,0,'C');
        $this->Rect($this->GetX(), $this->GetY(), 40, 10, 'DF');
        $this->Cell(40,10,'CITY NAME',1,1,'C');
    $this->SetFont('Arial','',12);
    foreach($data as $row) {
        $pageWidth = $this->GetPageWidth();
        $tableWidth = 40 * 3 + 2 * 1;
        $centerX = ($pageWidth - $tableWidth) / 2;
        $this->SetXY($centerX, $this->GetY());
        $this->Cell(40,10,$row['pincode'],1,0,'C');
        $this->Cell(40,10,$row['area_name'],1,0,'C');
        $this->Cell(40,10,$row['city_name'],1,1,'C');
    }
}
}

// $pdf = new PDF();
$pdf = new AreaReport();
$pdf->AliasNbPages();
$pdf->AddPage();
// Display area data
if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $pdf->AreaData($data);
} else {
    $pdf->Cell(0,10,'No area data available.',0,1,'C');
}
$pdf->Output();

?>