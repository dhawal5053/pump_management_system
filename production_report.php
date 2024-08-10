<?php
include 'report_header_footer.php';
include 'config.php';

if (isset($_POST['submit'])) {
    if (isset($_POST['month']) && $_POST['month'] !== '' && isset($_POST['year']) && $_POST['year'] !== '') {
        $month = $_POST['month'];
        $year = $_POST['year'];
        $sql = "SELECT DISTINCT prd.QTY,prd.production_production_id,pr.*,p.*,DATE_FORMAT(pr.start_date, '%d-%m-%Y') AS stdate ,DATE_FORMAT(pr.end_date, '%d-%m-%Y') AS edate FROM production pr,production_details prd,product p WHERE prd.production_production_id=pr.production_id AND pr.product_id=p.product_id AND MONTH(pr.start_date) = $month AND YEAR(pr.start_date) = $year";    
    } elseif (isset($_POST['start_date']) && $_POST['start_date'] !== '' && isset($_POST['end_date']) && $_POST['end_date'] !== '') {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $sql = "SELECT DISTINCT prd.QTY,prd.production_production_id,pr.*,p.*,DATE_FORMAT(pr.start_date, '%d-%m-%Y') AS stdate ,DATE_FORMAT(pr.end_date, '%d-%m-%Y') AS edate  FROM production pr,production_details prd,product p WHERE prd.production_production_id=pr.production_id AND pr.product_id=p.product_id AND pr.start_date BETWEEN '$start_date' AND '$end_date'";
    }elseif (isset($_POST['month']) && $_POST['month'] !== '') {
        $month = $_POST['month'];
        $sql = "SELECT DISTINCT prd.QTY,prd.production_production_id,pr.*,p.*,DATE_FORMAT(pr.start_date, '%d-%m-%Y') AS stdate ,DATE_FORMAT(pr.end_date, '%d-%m-%Y') AS edate  FROM production pr,production_details prd,product p WHERE prd.production_production_id=pr.production_id AND pr.product_id=p.product_id AND MONTH(pr.start_date) = $month";    
    } elseif (isset($_POST['year']) && $_POST['year'] !== '') {
        $year = $_POST['year'];
        $sql = "SELECT DISTINCT prd.QTY,prd.production_production_id,pr.*,p.*,DATE_FORMAT(pr.start_date, '%d-%m-%Y') AS stdate ,DATE_FORMAT(pr.end_date, '%d-%m-%Y') AS edate  FROM production pr,production_details prd,product p WHERE prd.production_production_id=pr.production_id AND pr.product_id=p.product_id AND YEAR(pr.start_date) = $year";    
    } else {
        $sql = "SELECT DISTINCT prd.QTY,prd.production_production_id,pr.*,p.*,DATE_FORMAT(pr.start_date, '%d-%m-%Y') AS stdate ,DATE_FORMAT(pr.end_date, '%d-%m-%Y') AS edate  FROM production pr,production_details prd,product p WHERE prd.production_production_id=pr.production_id AND pr.product_id=p.product_id ORDER BY production_id";    
    }  
}
$result = $conn->query($sql);

class ProductionReport extends PDF{
function ProductionData($data) {
    $this->SetFont('Arial','B',15);
    $this->Cell(80);
    $this->Cell(30,10,'Production Report',0,0,'C');
    $this->Ln(15);
    $this->SetFont('Arial','B',12);
    $this->SetFillColor(200,200,200);
    $this->SetX(30);
    $this->Cell(30,10,'START DATE',1,0,'C','DF');
    $this->Cell(30,10,'END DATE',1,0,'C','DF');      
    $this->Cell(70,10,'PRODUCT NAME',1,0,'C','DF');
    $this->Cell(20,10,'QTY',1,1,'C','DF');
    $this->SetFont('Arial','',12);
    foreach($data as $row) {
        $this->SetX(30);
        $this->Cell(30,10,$row['stdate'],1,0,'C');
        $this->Cell(30,10,$row['edate'],1,0,'C');
        $this->Cell(70,10,$row['product_name'],1,0,'C');
        $this->Cell(20,10,$row['QTY'],1,1,'C');
    }
}
}

// $pdf = new PDF();
$pdf = new ProductionReport();
$pdf->AliasNbPages();
$pdf->AddPage();
// Display production data
if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $pdf->ProductionData($data);
} else {
    $pdf->Cell(0,10,'No production data available.',0,1,'C');
}
$pdf->Output();

?>