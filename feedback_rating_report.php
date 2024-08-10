<?php
include 'report_header_footer.php';
include 'config.php';
$sql= "SELECT f.*,u.*,p.* FROM feedback_rating f,user u,product p WHERE f.user_id=u.user_id AND f.product_id=p.product_id ";
$result = $conn->query($sql);

class FeedbackReport extends PDF{
function FeedbackData($data) {
    $this->SetFont('Arial','B',15);
    $this->Cell(80);
    $this->Cell(30,10,'Feedback & rating Report',0,0,'C');
    $this->Ln(15);
    $this->SetFont('Arial','B',12);
    $this->SetFillColor(200,200,200);
    $this->Cell(30,10,'USER NAME',1,0,'C','DF');
    $this->Cell(60,10,'PRODUCT NAME',1,0,'C','DF');      
    $this->Cell(20,10,'RATING',1,0,'C','DF');
    $this->Cell(30,10,'FEEDBACK TITLE',1,0,'C','DF');
    $this->Cell(70,10,'FEEDBACK',1,1,'C','DF');
    $this->SetFont('Arial','',12);
    foreach($data as $row) {
        $this->Cell(30,10,$row['fname'],1,0,'C');
        $this->Cell(60,10,$row['product_name'],1,0,'C');
        $this->Cell(20,10,$row['star'],1,0,'C');
        $this->Cell(30,10,$row['feedback_titles'],1,0,'C');
        $this->Cell(70,10,$row['f_comments'],1,1,'C');
    }
}
}

// $pdf = new PDF();
$pdf = new FeedbackReport();
$pdf->AliasNbPages();
$pdf->AddPage();
// Display feedback data
if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $pdf->FeedbackData($data);
} else {
    $pdf->Cell(0,10,'No feedback & rating data available.',0,1,'C');
}
$pdf->Output();

?>