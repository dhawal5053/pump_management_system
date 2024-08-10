<?php
include 'config.php';  
session_start();
$id=$_SESSION['Admin-name'];
if(isset($_SESSION['Admin-login']) && $_SESSION['Admin-login']!=''){
   
}
else{
   header("location: login.php");
   die();
}
require('fpdf/fpdf.php');

class PDF extends FPDF {
    // Page header
    function Header() {
        // Logo and company address
        $this->Image('Image/10/vala-industries-logo-1.png',1,6,60);
        $this->SetTextColor(255,0,0);
        $this->SetFont('times','B',25);
        $this->Cell(110);
        $this->SetDrawColor(255,0,0);
        $this->Cell(83,11,'VALA INDUSTRIES',1,0);
        $this->SetDrawColor(0,0,0);
        $this->Ln(0);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',9);
        $this->Cell(-10);
        $this->Cell(0,36,'Address:- 24-Nageshwar Ind. Estate,Nr.Bhagirath Estate-3,Opp.Jawahar Nagar-1,Gulabnagar road,Amraiwadi,Ahmedabad-380026',0,0);
        $this->Ln(5);
        $this->SetFont('Arial','B',9);
        $this->Cell(-10);
        $this->Cell(0,36,'Contact No:- 9898265901,915793390   |   Email id:- info.valaindustries@gmail.com',0,0);
        $this->Ln(20);
        $this->Line(0, $this->GetY(), 210, $this->GetY());
        $this->Ln(1);
    }

    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','B',9);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
?>