<?php

Class Certificados extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model('admineramodel', 'modeloera');
        $this->load->model('avaluadormodel', 'modeloavaluador');
        $this->load->model('certificadomodel', 'modelocertificado');
        $this->load->model('adminraamodel', 'modeloraa');
        $this->load->helper('date', 'url');
        $this->load->library('cifrar');
        $this->load->helper('mysql_to_excel_helper');
    }

    //-------------------AGREGAR A LA LISTA DE CERTIFICADOS TEMPORAL-------------------------------// 
    public function agregar_certificado() {
        $registros['numero_id'] = $this->uri->segment(3);
        $verificar = $this->modelocertificado->c_temporal_b($registros['numero_id']);
        if ($verificar == true) {
            redirect('adminera/nuevo_certificado');
        }
        $this->modelocertificado->add_temporal($registros);
        redirect('adminera/nuevo_certificado');
    }

    //------------------ELIMINAR LA LISTA DE CERTIFICADOS TEMPORAL-------------------------------// 
    public function eliminar_temporal() {
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->modelocertificado->delete_temporal($id);
        redirect('adminera/nuevo_certificado');
    }

    //------------------GENERAR CERTIFICADOS GENERALES DE AVALUADORES-------------------------------// 

    public function generar_certificado() {
        ob_start();
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codera = $this->session->userdata('era');
        $data['temporal'] = $this->modelocertificado->c_temporal_c($codera);
        $data['serie'] = rand(60, 900);

        if ($data['temporal'] == null) {
            redirect('adminera/nuevo_certificado');
        }
        $this->load->library('pdf');
        $this->pdf = new Pdf();
        //FECHAS PARA MANEJAR SEMESTRES  //
        $mesactual = date('m');
        $anoatual = date('Y');
        $messemestre1 = '6';
        $messemestre2 = '12';
        $diasemestre1 = '30';
        $diasemestre2 = '31';
        $fechacompletasem1 = $anoatual . "-" . $messemestre1 . "-" . $diasemestre1;
        $fechacompletasem2 = $anoatual . "-" . $messemestre2 . "-" . $diasemestre2;
        $fsem1 = '30 DE JUNIO DEL ' . $anoatual;
        $fsem2 = '31 DE DICIEMBRE DEL ' . $anoatual;

// //FECHAS PARA MANEJAR SEMESTRES  //
//        FOR EACH PARA RECORRER LOS AVALUADORES
        foreach ($data['temporal'] as $i => $row) {
//                    echo '<pre>';
//        echo var_dump($row);
//        echo '</pre>';
//        exit();
            $pin = $row['numero_id'] . '-' . $data['serie'] . '-' . $row['codigoavaluador'];
            $fecha = date('Y-m-d');
            $cert['pin'] = $pin;
            $cert['fechagenerado'] = $fecha;
            if ($mesactual > $messemestre1) {
                $fechaven = $fechacompletasem2;
                $mfechaveb = $fsem2;
            } else {
                $fechaven = $fechacompletasem1;
                $mfechaveb = $fsem1;
            }
            $cert['fechavencimiento'] = $fechaven;
            $cert['numero_id'] = $row['numero_id'];
            $this->modelocertificado->add_certificado($cert);
            $fechavenava = $row['fechavencimiento'];
            $fechainsc = $row['fechainscripcion'];
            $regind = $row['regindustria'];
            //--------------------GENERAR CODIGO QR ----------------//

            $this->load->library('ciqrcode');
            //hacemos configuraciones
            $params['data'] = base_url() . "consulta-certificados/" . $pin;
            $params['level'] = 'H';
            $params['size'] = 7;
            //decimos el directorio a guardar el codigo qr, en este 
            //caso una carpeta en la raíz llamada qr_code
            $params['savename'] = FCPATH . 'uploads/codigosqr/' . $pin . '.png';
            //generamos el código qr
            $this->ciqrcode->generate($params);


            //------------------GENERAR CODIGO QR ------------------//


            $this->pdf->AddPage();
//            $this->pdf->AliasNbPages();
            //   CONTENIDO DEL PDF
            $this->pdf->SetFont('Arial', 'B', 16);
            $numat = $row['numero_id'];
            if ($numat < 100) {
                $numat = '00' . $numat;
            } else {
                $numat = '0' . $numat;
            }

            $this->pdf->Cell(180, 45, 'CERTIFICADO DE MATRICULA No.' . $numat, 0, 0, 'C');

//            $this->pdf->Cell(200, 45, 'CERTIFICADO DE MATRICULA No. 00' . $row['numero_id'], 0, 0, 'C');
            $this->pdf->SetFontSize(14);
            $this->pdf->SetXY(20, 20);
            $this->pdf->Cell(170, 90, 'EL SECRETARIO GENERAL DEL CONSEJO DEL REGISTRO NACIONAL DE', 0, 0, 'C');

            $this->pdf->SetXY(20, 20);
            $this->pdf->Cell(180, 100, 'AVALUADORES PROFESIONALES DE COLOMBIA', 0, 0, 'C');
            $this->pdf->SetXY(22, 20);
            if (!$row['foto'] == NULL) {
                $this->pdf->Image('uploads/imagenes/' . $row['foto'], 32, 80, 25, 30);
            }
            $this->pdf->Cell(200, 120, 'CERTIFICA QUE:', 0, 0, 'C');
//            $this->pdf->Ln(60);
//            $this->pdf->SetFontSize(12);
//            $this->pdf->Cell(220, 28, 'Que:', 0, 0, 'C');
//            $this->pdf->SetFontSize(12);
            $this->pdf->Ln(60);
            $this->pdf->Cell(220, 20, $row['nombres'] . ' ' . $row['apellidos'], 0, 0, 'C');


//            $this->pdf->Cell(220,15,'Hola sass',0,0,'C');
//                $this->pdf->Ln(20);
            $this->pdf->SetFontSize(12);
            $this->pdf->Ln(16);
            $this->pdf->Cell(220, 10, ' C.C. No ' . $row['cedula'], 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(220, 0, ' Direccion: ' . $row['domicilio'], 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(220, 10, '  Correo: ' . $row['correo'], 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(220, 0, ' Celular: ' . $row['celular'] . '  Fijo: ' . $row['telefono'], 0, 0, 'C');
        
//            $this->pdf->Cell(220,20,'Direccion',0,0,'C');

            $this->pdf->SetFont('Arial', '', 12);
//$this->SetFontSize(12);
            $this->pdf->Ln();
            $this->pdf->Cell(185, 16, utf8_decode('Aprobó y cumplió con la totalidad del ciclo académico, su correspondiente evaluación presentando '), 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(185, -6, utf8_decode('los requisitos de conformidad a los estatutos, acuerdos resoluciones, código de etica'), 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(185, 14, utf8_decode(' y el ordenamiento legal, según resolución numero, '.$numat.' de fecha '.$fechainsc.',  comprobándose '), 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(185, -6,  utf8_decode(' su idoneidad para ejercer como avaluador profesional en las siguientes especialidades:'), 0, 0, 'C');
            
            $this->pdf->Ln(3);
            $categorias = $this->modelocertificado->c_categorias($row['numero_id']);
            $txt = "";
            foreach ($categorias as $row) {
                $txt.=$row['nombre'] . " ";
            }
            $this->pdf->MultiCell(180, 4,utf8_decode( $txt), 0, 'C');

            $this->pdf->Ln(-35);
            $this->pdf->Cell(180, 80,utf8_decode( 'Corporaciones legalmente constituidas de acuerdo a lo establecido por los Decretos 2150  '), 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(180, -70, 'de 199995-1420 de 1998 y ley 388 de 1997 y debidamente inscritas y registradas en la', 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(180, 80, utf8_decode('  Camara de Comercio de Bogotá y en el Ministerio de Desarrollo Económico, Resolución: 032133 '), 0, 0, 'C');
            
            $this->pdf->Ln(5);
            
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Cell(180, 90, utf8_decode('NORMAS INTERNACIONALES DE INFORMACIÓN FINANCIERA NIFF EMITIDAS POR IASB INTERNATIONAL  '), 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(180, -80, utf8_decode('ACCOUTING ESTÁNDAR BOARD, EN CONCORDANCIA CON LAS IVS NORMAS INTERNACIONALES.'), 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(180, 90, utf8_decode('DE VALUACIÓN EMITIDAS POR INTERNACIONAL VALUATION STANDARDS COMMITTE'), 0, 0, 'C');
          
           $this->pdf->Ln(5);
            
             $this->pdf->SetFont('Arial', '', 12);
//            $this->pdf->Ln(-35);
            $this->pdf->Cell(180, 95, utf8_decode('Se le asignó la matricula R.N.A P-C. No.' . $numat . ' con una vigencia  hasta ' . $fechavenava.' y  con el registro'), 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(180, -85,utf8_decode( ' de superintendencia de industria y comercio No.'.$regind.'. el oficio estará sujeto al cumplimiento de los estatutos'), 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(180, 95, utf8_decode(' reglamentaciones Actualizaciones permanentes y demás requisitos exigidos por el consejo y por la ley'), 0, 0, 'C');
            $this->pdf->Ln(10);

            $this->pdf->Cell(180, 90, 'Certificamos que a la fecha, no tiene antecedentes disciplinarios, inhabilidades', 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(180, -80, 'e incompatibilidades de ley para el ejercicio profesional.', 0, 0, 'C');
            $this->pdf->Ln();
//            $this->pdf->Ln(-35);

            $this->pdf->SetXY(50, 241);
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->SetFillColor(200, 210, 210);
            $this->pdf->Cell(0, 6, 'SE EXPIDE EL PRESENTE CERTIFICADO EN BOGOTA D.C EL: ' . $fecha, 0, 1, 'C', 1);
            $this->pdf->SetXY(50, 235);
            $this->pdf->Cell(0, 6, 'CON UNA VALIDEZ HASTA EL:  ' . $mfechaveb, 0, 1, 'C', 1);
            $this->pdf->SetXY(20, 228);

//            $this->Image('imgpdf/asopeq.jpg',170,255,23,17);
            $this->pdf->Cell(24, 48, 'PIN:' . $pin, 0, 1, 'C', 0);

            $this->pdf->Image('uploads/codigosqr/' . $pin . '.png', 20, 230, 23, 20);
            //$this->Cell(180,90,'SE EXPIDE EL PRESENTE CERTIFICADO EN SANTA FE DE BOGOTA D.C EL '.$fec_imp.' ,',0,1,'C',1);
            $this->pdf->Ln(4);
        }
        ob_clean();
        $this->modelocertificado->eliminar_t($codera);
        $this->pdf->Output("Certificado.pdf", 'I');
//        redirect('adminera/nuevo_certificado','refresh');
    }

    //--------------------------------GENERAR CERTIFICADOS GENERALES DE AVALUADORES------------------------------------------// 

    public function reportes() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $reporte = $this->cifrar->dec($this->uri->segment(3));
        if ($reporte == 'vigentes') {//IMPRIMIR REPORTE DE AVALUADORES VIGENTES
            $codera = $this->session->userdata('era');
            to_excel($this->modelocertificado->c_avaluador_activo($codera), "AvaluadoresActivos");
        } else if ($reporte == 'vencidos') {//IMPRIMIR REPORTE DE AVALUADORES VENCIDOS
            $codera = $this->session->userdata('era');
            to_excel($this->modelocertificado->c_avaluador_inactivo($codera), "AvaluadoresVencidos");
        } else {
            $codera = $this->session->userdata('era'); //IMPRIMIR REPORTE DE TODOS LOS AVALUADORES
            to_excel($this->modelocertificado->c_avaluadores($codera), "TodosAvaluadores");
        }
    }

    //--------------------------------GENERAR REPORTES DEL RAA------------------------------------------// 

    public function reportesraa() {

        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $reporte = $this->cifrar->dec($this->uri->segment(3));
        if ($reporte == 'general') {//IMPRIMIR REPORTE DE AVALUADORES VIGENTES
            $data['eras'] = $this->modeloraa->listar_era();
            $data['canteras'] = $this->modeloraa->contar_era();
            $data['cantavaluadores'] = $this->modeloraa->contar_avaluadores();
            $data['cantusuarios'] = $this->modeloraa->contar_usuarios();
            $this->general($data);
        } else if ($reporte == 'transacciones') {
            $registros['transacciones'] = $this->modeloraa->listar_transacciones();
            $this->transacciones($registros);
        } else {
            $codera = $this->session->userdata('era'); //IMPRIMIR REPORTE DE TODOS LOS AVALUADORES
            $registros['avaluadores'] = $this->modeloraa->listar_tavaluadores();
            
            $this->todosavaluadores($registros);
        }
    }

    public function general($datos) {
        ob_start();
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }

        $this->load->library('pdfra');
        $this->pdfra = new Pdfra('L', 'mm', 'A4');
        $this->pdfra->AddPage();
        $this->pdfra->AliasNbPages();
        $this->pdfra->SetTitle("Lista de Avaluadores");
        $this->pdfra->SetLeftMargin(15);
        $this->pdfra->SetRightMargin(15);
        $this->pdfra->SetFillColor(200, 200, 200);

        // Se define el formato de fuente: Arial, negritas, tamaño 9
        $this->pdfra->SetFont('Arial', 'B', 8);

        $this->pdfra->Cell(50, 10, utf8_decode('ENTIDADES REGISTRADAS:  ' . $datos['canteras']->cantidad), 0, 0, 'C');
        $this->pdfra->Ln();
        $this->pdfra->Cell(50, -4, utf8_decode('AVALUADORES REGISTRADOS:  ' . $datos['cantavaluadores']->cantidad), 0, 0, 'C');
        $this->pdfra->Ln();
        $this->pdfra->Cell(50, -9, utf8_decode('USUARIOS REGISTRADOS:  ' . $datos['cantusuarios']->cantidad), 0, 0, 'C');
        $this->pdfra->Ln();
        ob_clean();
        $this->pdfra->Output("Reporte general.pdf", 'I');
    }

    public function transacciones($data) {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }

        $this->load->library('Tpdf');
        $pdf = new Tpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('RAA');
        $pdf->SetTitle('Reporte general');


// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

// Establecer el tipo de letra
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 10, '', true);

// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


        //preparamos y maquetamos el contenido a crear
      

        $html2 = '<h2>Reporte de Transacciones</h2>
           <table border="1" cellspacing="0" cellpadding="4">
        <tr>
                <th align="center">Num</th>
                <th align="center">Afectado</th>
                <th align="center">Fecha</th>
                <th align="center">Usuario</th>
                <th align="center">Transaccion</th>
            </tr>';

        foreach ($data['transacciones'] as $fila) {
//            echo "<pre>";
//            var_dump($fila);
//            echo "</pre>";
//            exit();
            $html2 .= "<tr>
                <td>" . $fila['codtransaccion'] . "</td>
                <td>" . $fila['afectado'] . "</td>
                <td>" . $fila['fecha'] . "</td>
                <td>" . $fila['nombreusuario'] . "</td>
                <td>" . $fila['tipo'] . "</td>
              </tr>";
        }
        $html2 .= "</table>";



        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html2, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


// Imprimimos el texto con writeHTMLCell()
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Auditoria .pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
    public function todosavaluadores($data) {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
//                    echo "<pre>";
//            var_dump($data);
//            echo "</pre>";
//            exit();
        $this->load->library('Tpdf');
        $pdf = new Tpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('RAA');
        $pdf->SetTitle('Reporte general');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('freemono', '', 10, '', true);
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
        $html2 = '<h2>Reporte de Aavaluadores</h2>
           <table border="1" cellspacing="0" cellpadding="4">
        <tr>
                <th align="center">Num</th>
                <th align="center">Nombres</th>
                <th align="center">Cedula</th>
                <th align="center">Correo</th>
                <th align="center">Telefono</th>
            </tr>';

        foreach ($data['avaluadores'] as $fila) {
            $html2 .= "<tr>
                <td>" . $fila['numero_id'] . "</td>
                <td>" . $fila['nombres'] . " " . $fila['apellidos'] . "</td>
                <td>" . $fila['cedula'] . "</td>
                <td>" . $fila['correo'] . "</td>
                <td>" . $fila['telefono'] . "</td>
                
              </tr>";
        }
        $html2 .= "</table>";
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html2, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $nombre_archivo = utf8_decode("Auditoria .pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

    //-------GENERAR PAZ Y SALVO PARA TRASLADO ------//
    public function pazysalvo() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }

        ob_start();
        $id_ava = $this->cifrar->dec($this->uri->segment(3));
        $registros = $this->modeloera->c_avaluador($id_ava);

//            echo "<pre>";
//            var_dump($registros->nombres);
//            echo "</pre>";
//            exit();

        $this->load->library('pdfrap');
        $this->pdfrap = new Pdfrap('L', 'mm', 'A4');
        $this->pdfrap->AddPage();
        $this->pdfrap->AliasNbPages();
        $this->pdfrap->SetTitle("Lista de Avaluadores");
        $this->pdfrap->SetLeftMargin(15);
        $this->pdfrap->SetRightMargin(15);
        $this->pdfrap->SetFillColor(200, 200, 200);


        $this->pdfrap->SetFont('Arial', '', 11);
        $this->pdfrap->Ln(40);
//
//        $this->pdfrap->Cell(170, -20, utf8_decode('CERTIFICAMOS QUE A LA FECHA, '.$registros->nombres.' '.$registros->apellidos), 0, 0, 'C');
//        $this->pdfrap->Ln();
//        $this->pdfrap->Cell(170, 30, utf8_decode(' NO TIENE ANTECEDENTES DISCIPLINARIOS,  Identificado con la cedula de ciudadania :  afiliado a la entidad: ERA DE LA FILA  no reporta ninguna deuda de ningun tipo y por ende se le expide el siguiente  '), 0, 0, 'C');
//        $this->pdfrap->Ln();
//        $this->pdfrap->Cell(170, -20, utf8_decode('Paz y salvo con fecha de hoy   '), 0, 0, 'C');
//        $this->pdfrap->Ln();
//        $this->pdfrap->Cell(170, 30, utf8_decode('y no reporta ninguna deuda de ningun tipo '), 0, 0, 'C');
//        $this->pdfrap->Ln();
//        $this->pdfrap->Cell(170, -20, utf8_decode('y no reporta ninguna deuda de ningun tipo '), 0, 0, 'C');
//        $this->pdfrap->Ln();
////////////////////////////
//$this->Cell(180,-15,$espec_aval,0,0,'C');
//        $this->pdff->MultiCell(180, 5, $txt, 0, 'C');


        $this->pdfrap->Cell(180, 95, 'CERTIFICAMOS QUE A LA FECHA, ' . $registros->nombres . ' ' . $registros->apellidos . ' SE ENCUENTRA A PAZ Y SALVO, ', 0, 0, 'C');
        $this->pdfrap->Ln();
        $this->pdfrap->Cell(180, -85, ' INHABILIDADES E INCOMPATIBILIDADES DE LEY PARA EL EJERCICIO PROFESIONAL.', 0, 0, 'C');
        $this->pdfrap->Ln();
        $this->pdfrap->Cell(180, 95, ' Y PUEDE EJERCER.', 0, 0, 'C');
        $this->pdfrap->SetXY(20, 230);
        $this->pdfrap->SetFont('Arial', '', 10);
        $this->pdfrap->SetFillColor(200, 210, 210);
        $this->pdfrap->Cell(0, 6, 'SE EXPIDE EL PRESENTE CERTIFICADO EN BOGOTA D.C EL  ,' . $fecha, 0, 1, 'C', 1);
        $this->pdfrap->SetXY(20, 234);
        $this->pdfrap->Cell(0, 6, 'CON UNA VALIDEZ DE SEIS(6) MESES  VENCIENDO EL ' . $fechaven, 0, 1, 'C', 1);
        $this->pdfrap->SetXY(20, 239);
        $this->pdfrap->Cell(0, 6, 'PIN:' . $pin, 0, 1, 'C', 1);
        //$this->Cell(180,90,'SE EXPIDE EL PRESENTE CERTIFICADO EN SANTA FE DE BOGOTA D.C EL '.$fec_imp.' ,',0,1,'C',1);
        $this->pdfrap->Ln(4);


        $this->pdfrap->Ln(7);
        $x = 1;
        ob_clean();
        $this->pdfrap->Output("Paz.pdf", 'D');
//        redirect('adminera/ver_traslados');
    }

}
