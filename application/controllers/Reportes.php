<?php

Class Reportes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model('reportemodel', 'modelo');

        $this->load->helper('date', 'url');
    }
    

    //============== GENERAR UN REPORTE DE UNA ERA ,POR UN RANGO DE FECHA ESPECIFICO ================//
      public function generar() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
        $filtros = $this->input->post('filtro');
        if ($filtros == null) {
            $this->session->set_flashdata('incorrecto', 'Seleccione algun item para generar un reporte');
            redirect('adminera/nuevo_reporte');
        }

        $codera = $this->session->userdata('era');
        $era = $this->session->userdata('razon_era');
        $desde = $registros['fecha1'];
        $hasta = $registros['fecha2'];
        if ($desde > $hasta) {
            $this->session->set_flashdata('incorrecto', 'La fecha inicial no puede ser menor');
            redirect('adminera/nuevo_reporte');
        }

        $datos['usuarios'] = $this->modelo->contar_usuarios($codera, $desde, $hasta);
        $datos['avaluadores'] = $this->modelo->contar_avaluadores($codera, $desde, $hasta);
        $datos['comites'] = $this->modelo->contar_comite($codera, $desde, $hasta);
        $datos['certificados'] = $this->modelo->contar_certificados($codera, $desde, $hasta);
        $datos['sanciones'] = $this->modelo->contar_sanciones($codera, $desde, $hasta);
        $datos['traslados'] = $this->modelo->contar_traslados($desde, $hasta);



        $this->load->library('Tpdf');
        $pdf = new Tpdf('p', 'mm', 'A4', true, 'UTF-8', false);
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
        $pdf->AddPage('L', 'A4');

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        //preparamos y maquetamos el contenido a crear

        $html = '<h2>Reporte general</h2><h3>' . $era . '</h3>
           <HR width=50% align="left" color="black">
           <br>';


        foreach ($filtros as $row) {

            switch ($row) {
                case 1:
                    $data['usuarios'] = $this->modelo->c_usr($codera);
                    $html .= '<h4>Usuarios registrados  ' . $desde . ' - ' . $hasta . ' :' . count($data['usuarios']) . ' </h4>
           <table border="1" cellspacing="0" cellpadding="0">
        <tr>
                <th align="center">Nombre Usuario</th>
                <th align="center">Perfil</th>
                <th align="center">Nombres</th>
                <th align="center">Correo</th>
                <th align="center">Estado</th>
            </tr>';

                    foreach ($data['usuarios'] as $fila) {
                        $html .= "<tr>
                <td>" . $fila['nombreusuario'] . "</td>
                <td>" . $fila['perfil'] . "</td>
                <td>" . $fila['nombres'] . "</td>
                <td>" . $fila['correo'] . "</td>
                <td>" . $fila['estado'] . "</td>
              </tr>";
                    }
                    $html .= "</table>";

                    break;
                case 2:
                    $data['avaluadores'] = $this->modelo->c_avaluador($codera);
                    $html .= '<HR width=50% align="left" color="black"> <h4>Avaluadores registrados  ' . $desde . ' - ' . $hasta . ' :' . count($data['avaluadores']) . ' </h4>
           
<table border="1" cellspacing="0" cellpadding="0">
        <tr>
                <th align="center">Nombres</th>
                <th align="center">Apellidos</th>
                <th align="center">Cedula</th>
                <th align="center">Estado</th>
                <th align="center">Fecha Vencimiento</th>
            </tr>';

                    foreach ($data['avaluadores'] as $fila) {
                        $html .= "<tr>
                <td>" . $fila['nombres'] . "</td>
                <td>" . $fila['apellidos'] . "</td>
                <td>" . $fila['cedula'] . "</td>
                <td>" . $fila['estado'] . "</td>
                <td>" . $fila['fechavencimiento'] . "</td>
              </tr>";
                    }
                    $html .= "</table>";
                    break;
                case 3:
                    $data['comites'] = $this->modelo->c_comite($codera);
                    $html .= '<HR width=50% align="left" color="black"> <h4>Comites registrados  ' . $desde . ' - ' . $hasta . ' :' . count($data['comites']) . ' </h4>
                <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                <th align="center">Codigo</th>
                <th align="center">Fecha</th>
                <th align="center">Funcionarios</th>
                
            </tr>';

                    foreach ($data['comites'] as $fila) {
                        $html .= "<tr>
                <td>" . $fila['codcomite'] . "</td>
                <td>" . $fila['fecha'] . "</td>
                <td>" . $fila['funcionarios'] . "</td>
              
              </tr>";
                    }
                    $html .= "</table>";
                    break;
                case 4:
                    $data['certificados'] = $this->modelo->c_certificado($codera);
                    $html .= '<HR width=50% align="left" color="black"> <h4>Certificados generados  ' . $desde . ' - ' . $hasta . ' :' . count($data['certificados']) . ' </h4>
                <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                <th align="center">Pin</th>
                <th align="center">Fecha Generado</th>
                <th align="center">Nombres</th>
                <th align="center">Apellidos</th>
                <th align="center">Cedula</th>
            </tr>';

                    foreach ($data['certificados'] as $fila) {
                        $html .= "<tr>
                <td>" . $fila['pin'] . "</td>
                <td>" . $fila['fechagenerado'] . "</td>
                <td>" . $fila['nombres'] . "</td>
                <td>" . $fila['apellidos'] . "</td>
                <td>" . $fila['cedula'] . "</td>
              </tr>";
                    }
                    $html .= "</table>";
                    break;
                case 5:
                    $data['sanciones'] = $this->modelo->c_sanciones($codera);
                    $html .= '<HR width=50% align="left" color="black"> <h4>Sanciones registradas  ' . $desde . ' - ' . $hasta . ' :' . count($data['sanciones']) . ' </h4>
                <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                <th align="center">Fecha Registro</th>
                <th align="center">Tipo</th>
                <th align="center">Descripcion</th>
                <th align="center">Nombres</th>
                <th align="center">Apellidos</th>
                <th align="center">Cedula</th>
            </tr>';

                    foreach ($data['sanciones'] as $fila) {
                        $html .= "<tr>
                <td>" . $fila['fecharegistro'] . "</td>
                <td>" . $fila['tipo'] . "</td>
                <td>" . $fila['descripcion'] . "</td>
                <td>" . $fila['nombres'] . "</td>
                <td>" . $fila['apellidos'] . "</td>
                <td>" . $fila['cedula'] . "</td>
              </tr>";
                    }
                    $html .= "</table>";
                    break;
                case 6:
                    $data['traslados'] = $this->modelo->c_traslados($codera);
                    $html .= '<HR width=50% align="left" color="black"> <h4>Traslados generados  ' . $desde . ' - ' . $hasta . ' :' . count($data['traslados']) . ' </h4>
                <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                <th align="center">Nombres</th>
                <th align="center">Apellidos </th>
                <th align="center">Cedula</th>
                <th align="center">Anterior</th>
                <th align="center">Nueva</th>
                <th align="center">Fecha</th>
            </tr>';

                    foreach ($data['traslados'] as $fila) {
                        $html .= "<tr>
                    <td>" . $fila['nombres'] . "</td>
                    <td>" . $fila['apellidos'] . "</td>
                    <td>" . $fila['cedula'] . "</td>
                    <td>" . $fila['anterior'] . "</td>
                    <td>" . $fila['nueva'] . "</td>
                    <td>" . $fila['fecha'] . "</td>
                
                
              </tr>";
                    }
                    $html .= "</table>";
                    break;
            }
//           
        }



// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Localidades de .pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

    public function raagenerar() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa' && $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
        $filtros = $this->input->post('filtro');
        if ($filtros == null) {
            $this->session->set_flashdata('incorrecto', 'Seleccione algun item para generar un reporte');
            redirect('adminraa/nuevo_reporte');
        }
        $desde = $registros['fecha1'];
        $hasta = $registros['fecha2'];
        if ($desde > $hasta) {
            $this->session->set_flashdata('incorrecto', 'La fecha inicial no puede ser menor');
            redirect('adminraa/nuevo_reporte');
        }
        $datos['usuarios'] = $this->modelo->contar_usuariosraa($desde, $hasta);
        $datos['avaluadores'] = $this->modelo->contar_avaluadoresraa($desde, $hasta);
        $datos['comites'] = $this->modelo->contar_comiteraa($desde, $hasta);
        $datos['certificados'] = $this->modelo->contar_certificadosraa($desde, $hasta);
        $datos['sanciones'] = $this->modelo->contar_sancionesraa($desde, $hasta);
        $datos['traslados'] = $this->modelo->contar_trasladosraa($desde, $hasta);
        $datos['eras'] = $this->modelo->contar_erasraa($desde, $hasta);

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
        $html = '<h2>Reporte general</h2><h3>Sistema</h3>
            
<table border="1" cellspacing="3" cellpadding="4">
            <tr>
                <th align="center">Informacion</th>
                <th colspan="2" align="center">Registros</th>
            </tr>
            <tr>
                <td>Entidades ERA</td>
                <td bgcolor="#cccccc" align="center" colspan="2">' . $datos['eras']->cantidad . '</td>
            </tr>
            <tr>
                <td>Usuarios</td>
                <td bgcolor="#cccccc" align="center" colspan="2">' . $datos['usuarios']->cantidad . '</td>
            </tr>
            
            <tr>
                <td>Avaluadores</td>
                <td bgcolor="#cccccc" align="center" colspan="2">' . $datos['avaluadores']->cantidad . '</td>
            </tr>
            <tr>
                <td>Certificados</td>
                <td bgcolor="#cccccc" align="center" colspan="2">' . $datos['certificados']->cantidad . '</td>
            </tr>
            <tr>
                <td>Sanciones</td>
                <td bgcolor="#cccccc" align="center" colspan="2">' . $datos['sanciones']->cantidad . '</td>
            </tr>
            <tr>
                <td>Traslados</td>
                <td bgcolor="#cccccc" align="center" colspan="2">' . $datos['traslados']->cantidad . '</td>
            </tr>
            <tr>
                <td>Comites</td>
                <td bgcolor="#cccccc" align="center" colspan="2">' . $datos['comites']->cantidad . '</td>
            </tr>
              </table>';
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        $eras = $this->modelo->eras();
        if ($eras) {
            foreach ($eras as $row) {
                $codera = $row['codera'];
                $datos['usuarios'] = $this->modelo->contar_usuarios($codera, $desde, $hasta);
                $datos['avaluadores'] = $this->modelo->contar_avaluadores($codera, $desde, $hasta);
                $datos['comites'] = $this->modelo->contar_comite($codera, $desde, $hasta);
                $datos['certificados'] = $this->modelo->contar_certificados($codera, $desde, $hasta);
                $datos['sanciones'] = $this->modelo->contar_sanciones($codera, $desde, $hasta);
                $datos['traslados'] = $this->modelo->contar_traslados($desde, $hasta);
        $html2 = '<h2>Reporte por Entidad</h2><h3>' . $row['razonsocial_era'] . '</h3>
           <HR width=50% align="left" color="black">
           <br>';
                foreach ($filtros as $row) {

                    switch ($row) {
                        case 1:
                            $data['usuarios'] = $this->modelo->c_usr($codera);
                            $html2 .= '<h4>Usuarios registrados  ' . $desde . ' - ' . $hasta . ' :' . count($data['usuarios']) . ' </h4>
           <table border="1" cellspacing="3" cellpadding="4">
        <tr>
                <th align="center">Nombre Usuario</th>
                <th align="center">Perfil</th>
                <th align="center">Nombres</th>
                <th align="center">Correo</th>
                <th align="center">Estado</th>
            </tr>';

                            foreach ($data['usuarios'] as $fila) {
                                $html2 .= "<tr>
                <td>" . $fila['nombreusuario'] . "</td>
                <td>" . $fila['perfil'] . "</td>
                <td>" . $fila['nombres'] . "</td>
                <td>" . $fila['correo'] . "</td>
                <td>" . $fila['estado'] . "</td>
              </tr>";
                            }
                            $html2 .= "</table>";

                            break;
                        case 2:
                            $data['avaluadores'] = $this->modelo->c_avaluador($codera);
                            $html2 .= '<HR width=50% align="left" color="black"> <h4>Avaluadores registrados  ' . $desde . ' - ' . $hasta . ' :' . count($data['avaluadores']) . ' </h4>
           
<table border="1" cellspacing="3" cellpadding="4">
        <tr>
                <th align="center">Nombres</th>
                <th align="center">Apellidos</th>
                <th align="center">Cedula</th>
                <th align="center">Estado</th>
                <th align="center">Fecha Vencimiento</th>
            </tr>';

                            foreach ($data['avaluadores'] as $fila) {
                                $html2 .= "<tr>
                <td>" . $fila['nombres'] . "</td>
                <td>" . $fila['apellidos'] . "</td>
                <td>" . $fila['cedula'] . "</td>
                <td>" . $fila['estado'] . "</td>
                <td>" . $fila['fechavencimiento'] . "</td>
              </tr>";
                            }
                            $html2 .= "</table>";
                            break;
                        case 3:
                            $data['comites'] = $this->modelo->c_comite($codera);
                            $html2 .= '<HR width=50% align="left" color="black"> <h4>Comites registrados  ' . $desde . ' - ' . $hasta . ' :' . count($data['comites']) . ' </h4>
                <table border="1" cellspacing="3" cellpadding="4">
                <tr>
                <th align="center">Codigo</th>
                <th align="center">Fecha</th>
                <th align="center">Funcionarios</th>
                
            </tr>';

                            foreach ($data['comites'] as $fila) {
                                $html2 .= "<tr>
                <td>" . $fila['codcomite'] . "</td>
                <td>" . $fila['fecha'] . "</td>
                <td>" . $fila['funcionarios'] . "</td>
              
              </tr>";
                            }
                            $html2 .= "</table>";
                            break;
                        case 4:
                            $data['certificados'] = $this->modelo->c_certificado($codera);
                            $html2 .= '<HR width=50% align="left" color="black"> <h4>Certificados generados  ' . $desde . ' - ' . $hasta . ' :' . count($data['certificados']) . ' </h4>
                <table border="1" cellspacing="3" cellpadding="4">
                <tr>
                <th align="center">Pin</th>
                <th align="center">Fecha Generado</th>
                <th align="center">Nombres</th>
                <th align="center">Apellidos</th>
                <th align="center">Cedula</th>
            </tr>';

                            foreach ($data['certificados'] as $fila) {
                                $html2 .= "<tr>
                <td>" . $fila['pin'] . "</td>
                <td>" . $fila['fechagenerado'] . "</td>
                <td>" . $fila['nombres'] . "</td>
                <td>" . $fila['apellidos'] . "</td>
                <td>" . $fila['cedula'] . "</td>
              </tr>";
                            }
                            $html2 .= "</table>";
                            break;
                        case 5:
                            $data['sanciones'] = $this->modelo->c_sanciones($codera);
                            $html2 .= '<HR width=50% align="left" color="black"> <h4>Sanciones registradas  ' . $desde . ' - ' . $hasta . ' :' . count($data['sanciones']) . ' </h4>
                <table border="1" cellspacing="3" cellpadding="4">
                <tr>
                <th align="center">Fecha Registro</th>
                <th align="center">Tipo</th>
                <th align="center">Descripcion</th>
                <th align="center">Nombres</th>
                <th align="center">Apellidos</th>
                <th align="center">Cedula</th>
            </tr>';

                            foreach ($data['sanciones'] as $fila) {
                                $html2 .= "<tr>
                <td>" . $fila['fecharegistro'] . "</td>
                <td>" . $fila['tipo'] . "</td>
                <td>" . $fila['descripcion'] . "</td>
                <td>" . $fila['nombres'] . "</td>
                <td>" . $fila['apellidos'] . "</td>
                <td>" . $fila['cedula'] . "</td>
              </tr>";
                            }
                            $html2 .= "</table>";
                            break;
                        case 6:
                            $data['traslados'] = $this->modelo->c_traslados($codera);
                            $html2 .= '<HR width=50% align="left" color="black"> <h4>Traslados generados  ' . $desde . ' - ' . $hasta . ' :' . count($data['traslados']) . ' </h4>
                <table border="1" cellspacing="3" cellpadding="4">
                <tr>
                <th align="center">Nombres</th>
                <th align="center">Apellidos </th>
                <th align="center">Cedula</th>
                <th align="center">Anterior</th>
                <th align="center">Nueva</th>
                <th align="center">Fecha</th>
            </tr>';

                            foreach ($data['traslados'] as $fila) {
                                $html2 .= "<tr>
                    <td>" . $fila['nombres'] . "</td>
                    <td>" . $fila['apellidos'] . "</td>
                    <td>" . $fila['cedula'] . "</td>
                    <td>" . $fila['anterior'] . "</td>
                    <td>" . $fila['nueva'] . "</td>
                    <td>" . $fila['fecha'] . "</td>
                
                
              </tr>";
                            }
                            $html2 .= "</table>";
                            break;
                    }
//           
                }
                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html2, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
            }
        }


// Imprimimos el texto con writeHTMLCell()
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Localidades de .pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

}
