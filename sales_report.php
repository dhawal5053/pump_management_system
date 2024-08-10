<?php
include 'report_header_footer.php';
include 'config.php';
if (isset($_POST['submit'])) {
    if (isset($_POST['month']) && $_POST['month'] !== '' && isset($_POST['year']) && $_POST['year'] !== '') {
        $month = $_POST['month'];
        $year = $_POST['year'];
        $sql = "SELECT sd.*,s.*,u.*,p.*,DATE_FORMAT(s.sale_date, '%d-%m-%Y') AS sdate ,DATE_FORMAT(s.payment_date, '%d-%m-%Y') AS padate FROM sales_details sd,sales s,user u,product p WHERE sd.sales_sales_id=s.sales_id AND sd.product_product_id=p.product_id AND s.user_id=u.user_id AND MONTH(s.sale_date) = $month AND YEAR(s.sale_date) = $year";    
    } elseif (isset($_POST['start_date']) && $_POST['start_date'] !== '' && isset($_POST['end_date']) && $_POST['end_date'] !== '') {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $sql = "SELECT sd.*,s.*,u.*,p.*,DATE_FORMAT(s.sale_date, '%d-%m-%Y') AS sdate ,DATE_FORMAT(s.payment_date, '%d-%m-%Y') AS padate FROM sales_details sd,sales s,user u,product p WHERE sd.sales_sales_id=s.sales_id AND sd.product_product_id=p.product_id AND s.user_id=u.user_id AND s.sale_date BETWEEN '$start_date' AND '$end_date'";
    }elseif (isset($_POST['month']) && $_POST['month'] !== '') {
        $month = $_POST['month'];
        $sql = "SELECT sd.*,s.*,u.*,p.*,DATE_FORMAT(s.sale_date, '%d-%m-%Y') AS sdate ,DATE_FORMAT(s.payment_date, '%d-%m-%Y') AS padate FROM sales_details sd,sales s,user u,product p WHERE sd.sales_sales_id=s.sales_id AND sd.product_product_id=p.product_id AND s.user_id=u.user_id AND MONTH(s.sale_date) = $month";    
    } elseif (isset($_POST['year']) && $_POST['year'] !== '') {
        $year = $_POST['year'];
        $sql = "SELECT sd.*,s.*,u.*,p.*,DATE_FORMAT(s.sale_date, '%d-%m-%Y') AS sdate ,DATE_FORMAT(s.payment_date, '%d-%m-%Y') AS padate FROM sales_details sd,sales s,user u,product p WHERE sd.sales_sales_id=s.sales_id AND sd.product_product_id=p.product_id AND s.user_id=u.user_id AND YEAR(s.sale_date) = $year";    
    } else {
        $sql = "SELECT sd.*,s.*,u.*,p.*,DATE_FORMAT(s.sale_date, '%d-%m-%Y') AS sdate ,DATE_FORMAT(s.payment_date, '%d-%m-%Y') AS padate FROM sales_details sd,sales s,user u,product p WHERE sd.sales_sales_id=s.sales_id AND sd.product_product_id=p.product_id AND s.user_id=u.user_id ORDER BY sales_id";    
    }  
}

$result = $conn->query($sql);

class SalesReport extends PDF{
    function SalesData($data) {
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,'Sales Report',0,0,'C');
    $this->Ln(15);
    $this->SetFont('Arial','B',10);
    $this->SetFillColor(200,200,200);
    $this->SetXY(1,50);
    $text= 'SALES ID';
    $width1 = $this->GetStringWidth($text) -2 ;    
    $this->MultiCell($width1, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $this->SetXY(1,50);
    $x2 = $this->GetX() + $width1;
    $this->SetX($x2);
    $text = 'SALE'."\n".'DATE';
    $width2 = $this->GetStringWidth($text) +5 ;  
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
    $width4 = $this->GetStringWidth($text)-3;
    $this->MultiCell($width4, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x6 = $x4 + $width4;
    $this->SetX($x6);
    $text = 'PAYMENT TYPE';
    $width5 = $this->GetStringWidth($text) -5 ;
    $this->MultiCell($width5, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x9 = $x6 + $width5;
    $this->SetX($x9);
    $text = 'CUSTOMER NAME';
    $width6 = $this->GetStringWidth($text) -5 ;
    $this->MultiCell($width6, 6, $text, 1, 'C', true);
    $this->Ln(-12);
    $x10 = $x9 + $width6;
    $this->SetX($x10);
    $text = 'PRODUCT'."\n".'NAME';
    $width7 = $this->GetStringWidth($text) +25 ; 
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
        $this->Cell($width1,12,$row['sales_id'],1,0,'C');
        $this->Cell($width2,12,$row['sdate'],1,0,'C');
        $this->Cell($width3,12,$row['total_amt'],1,0,'C');
        $this->Cell($width4,12,$row['padate'],1,0,'C');
        $this->Cell($width5,12,$row['payment_type'],1,0,'C');
        $this->Cell($width6,12,$row['fname'],1,0,'C');
        $this->Cell($width7,12,$row['product_name'],1,0,'C');
        $this->Cell($width8,12,$row['QTY'],1,1,'C');
    }
}
}


// Display sales data
$pdf = new SalesReport();
$pdf->AliasNbPages();
$pdf->AddPage();
if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $pdf->SalesData($data);
} else {
    $pdf->Cell(0,10,'No sales data available.',0,1,'C');
}
$pdf->Output();

?>