<?php
include 'report_header_footer.php';
include 'config.php';

$sql = "SELECT * from user WHERE IS_Admin=0";
$result = $conn->query($sql);

class CustomerReport extends PDF{
    function CustomerData($data) {
        $this->SetFont('Arial','B',15);
    $this->Cell(80);
    $this->Cell(30,10,'Customer Report',0,0,'C');
    $this->Ln(15);
    $this->SetFont('Arial','B',12);
    $this->SetFillColor(200,200,200);
    $this->SetX(13);
    $this->Cell(25,10,'USER ID',1,0,'C','DF');
    $this->Cell(30,10,'FIRST NAME',1,0,'C','DF');
    $this->Cell(30,10,'LAST NAME',1,0,'C','DF');     
    $this->Cell(70,10,'EMAIL',1,0,'C','DF');
    $this->Cell(30,10,'MOBILE NO',1,1,'C','DF');
    $this->SetFont('Arial','',12);
    foreach($data as $row) {
        $this->SetX(13);
        $this->Cell(25,10,$row['user_id'],1,0,'C');
        $this->Cell(30,10,$row['fname'],1,0,'C');
        $this->Cell(30,10,$row['lname'],1,0,'C');
        $this->Cell(70,10,$row['email'],1,0,'C');
        $this->Cell(30,10,$row['mob_no'],1,1,'C');
    }
}
}


// Display customer data
$pdf = new CustomerReport();
$pdf->AliasNbPages();
$pdf->AddPage();
if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $pdf->CustomerData($data);
} else {
    $pdf->Cell(0,10,'No customer data available.',0,1,'C');
}
$pdf->Output();

?>