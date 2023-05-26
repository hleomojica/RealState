<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   
    require_once APPPATH."/third_party/fpdf/fpdf.php";
   
   
    class Pdfrs extends FPDF {
        
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
    
    
    public function cabeceraHorizontal($cabecera) {
            $this->SetXY(10, 70);
            $this->SetFont('Arial', 'B', 10);
            foreach ($cabecera as $fila) {
                //Atención!! el parámetro valor 0, hace que sea horizontal
                $this->Cell(24, 7, utf8_decode($fila), 1, 0, 'L');
            }
        }

       public function datosHorizontal($datos) {
            $this->SetXY(10, 77); // 77 = 70 posiciónY_anterior + 7 altura de las de cabecera
            $this->SetFont('Arial', '', 10); //Fuente, normal, tamaño
            foreach ($datos as $fila) {
                //Atención!! el parámetro valor 0, hace que sea horizontal
                $this->Cell(24, 7, utf8_decode($fila), 1, 0, 'L');
            }
        }
    }
?>