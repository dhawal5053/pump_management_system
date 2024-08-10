<?php
include 'report_header_footer.php';
include 'config.php';
if (isset($_POST['submit'])) {
    if (isset($_POST['supplier_id']) && $_POST['supplier_id'] !== '') {
        $supplier_id = $_POST['supplier_id'];
        $sql = "SELECT rd.*,r.*,s.supplier_name AS sname FROM rawmaterial_details rd,rawmaterial r,supplier s WHERE rd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND rd.supplier_supplier_id=s.supplier_id AND s.supplier_id = $supplier_id";    
    }else {
        $sql = "SELECT rd.*,r.*,s.supplier_name AS sname FROM rawmaterial_details rd,rawmaterial r,supplier s WHERE rd.rawmaterial_rawmaterial_id=r.rawmaterial_id AND rd.supplier_supplier_id=s.supplier_id";    
    }  
}

$result = $conn->query($sql);

class RawmaterialReport extends PDF{
    function RawmaterialData($data) {
        $this->SetFont('Arial','B',15);
    $this->Cell(80);
    $this->Cell(30,10,'Rawmaterial Report',0,0,'C');
    $this->Ln(15);
    $this->SetFont('Arial','B',12);
    $pageWidth = $this->GetPageWidth();
    $tableWidth = 50 * 3 + 2 * 1; 
    $centerX = ($pageWidth - $tableWidth) / 2;
    $this->SetXY($centerX, $this->GetY());
    $this->SetFillColor(200,200,200);
        $this->Rect($this->GetX(), $this->GetY(), 50, 10, 'DF');
        $this->Cell(50,10,'RAWMATERIAL NAME',1,0,'C');
        $this->Rect($this->GetX(), $this->GetY(), 50, 10, 'DF');
        $this->Cell(50,10,'SUPPLIER NAME',1,0,'C');
        $this->Rect($this->GetX(), $this->GetY(), 50, 10, 'DF');
        $this->Cell(50,10,'QUANTITY',1,1,'C');
    $this->SetFont('Arial','',12);
    foreach($data as $row) {
        $pageWidth = $this->GetPageWidth();
        $tableWidth = 50 * 3 + 2 * 1;
        $centerX = ($pageWidth - $tableWidth) / 2;
        $this->SetXY($centerX, $this->GetY());
        $this->Cell(50,10,$row['rawmaterial_name'],1,0,'C');
        $this->Cell(50,10,$row['sname'],1,0,'C');
        $this->Cell(50,10,$row['QTY'],1,1,'C');
    }
}
}
// Display rawmaterial data
$pdf = new RawmaterialReport();
$pdf->AliasNbPages();
$pdf->AddPage();
if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $pdf->RawmaterialData($data);
} else {
    $pdf->Cell(0,10,'No rawmaterial data available.',0,1,'C');
}
$pdf->Output();

?>