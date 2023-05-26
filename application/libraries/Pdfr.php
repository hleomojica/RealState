<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   
    require_once APPPATH."/third_party/fpdf/fpdf.php";
   
   
    class Pdfr extends FPDF {
        
        public function __construct() {
            parent::__construct();
        }
       
        public function Header(){
            
//            $this->Image('herramientas/images/pdf.png',10,8,70,25);
            $this->SetFont('Arial','B',14);
            $this->Cell(30);
            $this->Cell(120,10,'Reporte Avaluadores',0,0,'C');
            $this->Ln('5');
            $this->SetFont('Arial','B',8);
            $this->Cell(30);
            $this->Cell(120,10,date('Y-m-d'),0,0,'C');
            $this->Ln(20);
       }
          public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }
    }
    
     
    
?>