<?php
include 'report_header_footer.php';
include 'config.php';

if (isset($_POST['submit'])) {
    if (isset($_POST['cate_id']) && $_POST['cate_id'] !== '') {
        $cate_id = $_POST['cate_id'];  
        $sql = "SELECT p.*,pc.* FROM product p,product_category pc WHERE pc.product_cate_id=p.product_cate_id AND pc.product_cate_id = $cate_id";
    }else {
        $sql = "SELECT p.*,pc.* FROM product p,product_category pc WHERE pc.product_cate_id=p.product_cate_id";
    }  
}
$result = $conn->query($sql);

class ProductReport extends PDF{
function ProductData($data) {
    $this->SetFont('Arial','B',15);
    $this->Cell(80);
    $this->Cell(30,10,'Product Report',0,0,'C');
    $this->Ln(15);
    $this->SetFont('Arial','B',12);
    $this->SetFillColor(200,200,200);
    $this->Cell(60,10,'PRODUCT NAME',1,0,'C','DF');
    $this->Cell(30,10,'QOH',1,0,'C','DF');      
    $this->Cell(30,10,'PRICE',1,0,'C','DF');
    $this->Cell(70,10,'PRODUCT CATEGORY',1,1,'C','DF');
    $this->SetFont('Arial','',12);
    foreach($data as $row) {
        $this->Cell(60,10,$row['product_name'],1,0,'C');
        $this->Cell(30,10,$row['QOH'],1,0,'C');
        $this->Cell(30,10,$row['price'],1,0,'C');
        $this->Cell(70,10,$row['cate_name'],1,1,'C');
    }
}
}

// $pdf = new PDF();
$pdf = new ProductReport();
$pdf->AliasNbPages();
$pdf->AddPage();
// Display product data
if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $pdf->ProductData($data);
} else {
    $pdf->Cell(0,10,'No product data available.',0,1,'C');
}
$pdf->Output();

?>