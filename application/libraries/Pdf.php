<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
   
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){
            $this->Image('imgpdf/fondo.jpg',10,20,190,200);
            $this->Image('imgpdf/codigo.png',170,5,23,14);
	$this->SetFont('Arial','B',14);
	//Move to the right
	$this->Cell(80);
	$this->Cell(20,8,'REPUBLICA DE COLOMBIA',0,0,'C');
	//subtitulo
	$this->SetFont('Times','I',11);
//	$this->Cell(20,30,'CONSEJO DEL REGISTRO NACIONAL DE AVALUADORES PROFESIONALES DE COLOMBIA RNA PC',0,0,'C');
	$this->SetFontSize(9);
	$this->Ln(20);
       }
       

       
       // El pie del pdf
//       public function Footer(){
//           $this->SetY(-15);
//           $this->SetFont('Arial','I',8);
//           $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
//      }
      
      function Footer()
{

	$this->SetFont('Arial','B',10);
	//Page number
	$this->Image('imgpdf/corlpeq.jpg',15,255,22,18);
	$this->Image('imgpdf/firmarna.jpg',80,252,45,21);
 	$this->Image('imgpdf/asopeq.jpg',170,255,23,17);
	$this->SetY(-28);
	
	$this->Cell(0,10,'Consejo ERA(Entidades Reconocidas de Autoregulacion)',0,0,'C');
	$this->SetY(-25);
	$this->Cell(0,10,'De Colombia.',0,0,'C');
	$this->SetY(-22);
	
	$this->SetFont('Arial','B',8);
	$this->Cell(0,10,'SECRETARIA GENERAL.',0,0,'C');

}

function Note(){
        $this->SetXY(20,230);
	$this->SetFont('Arial','',10);
	$this->SetFillColor(200,210,210);
	$this->Cell(0,6,'SE EXPIDE EL PRESENTE CERTIFICADO EN BOGOTA D.C EL  ,',0,1,'C',1);
	$this->SetXY(20,234);
	$this->Cell(0,6,'CON UNA VALIDEZ DE  VENCIENDO EL ',0,1,'C',1);
	//$this->Cell(180,90,'SE EXPIDE EL PRESENTE CERTIFICADO EN SANTA FE DE BOGOTA D.C EL '.$fec_imp.' ,',0,1,'C',1);
	$this->Ln(4);
	//Save ordinate
	//$this->y0=$this->GetY();
}
    }
?>;