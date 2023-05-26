<?php

Class Reportes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model('reportemodel', 'modelo');

        $this->load->helper('date', 'url');
    }

    ///--- GENERAR UN REPORTE DE UNA ERA ,POR UN RANGO DE FECHA ESPECIFICO ---//

    public function generar() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
//        echo "<pre>";
//        var_dump($registros);
//        echo "</pre>";
//        exit();
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
        $html = '<h2>Reporte general</h2><h3>' . $era . '</h3>
            
           <table border="1" cellspacing="3" cellpadding="4">
        <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Usuarios registrados</th>
            </tr>
            <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han registrado ' . $datos['usuarios']->cantidad . ' usuarios </td>
            </tr>
            <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Avaluadores registrados</th>
            </tr>
            <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han registrado ' . $datos['avaluadores']->cantidad . ' Avaluadores </td>
            </tr>
            <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Comités registrados </th>
            </tr>
           <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han registrado  ' . $datos['comites']->cantidad . '  comites </td>
            </tr>
             <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Certificados </th>
            </tr>
           <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han generado  ' . $datos['certificados']->cantidad . '  certificados </td>
            </tr>
             <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Sanciones registradas  </th>
            </tr>
           <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han registrado  ' . $datos['sanciones']->cantidad . '  Sanciones </td>
            </tr>
             <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Traslados registradas  </th>
            </tr>
           <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han Trasladado ' . $datos['traslados']->cantidad . '  Avaluadores </td>
            </tr>
              </table>';




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
        $desde = $registros['fecha1'];
        $hasta = $registros['fecha2'];
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

                $html2 = '<h2>Reporte de Entidad </h2><h3>' . $row['razonsocial_era'] . '</h3>
           <table border="1" cellspacing="3" cellpadding="4">
        <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Usuarios registrados</th>
            </tr>
            <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han registrado ' . $datos['usuarios']->cantidad . ' usuarios </td>
            </tr>
            <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Avaluadores registrados</th>
            </tr>
            <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han registrado ' . $datos['avaluadores']->cantidad . ' Avaluadores </td>
            </tr>
            <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Comités registrados </th>
            </tr>
           <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han registrado  ' . $datos['comites']->cantidad . '  comites </td>
            </tr>
             <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Certificados </th>
            </tr>
           <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han generado  ' . $datos['certificados']->cantidad . '  certificados </td>
            </tr>
             <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Sanciones registradas  </th>
            </tr>
           <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han registrado  ' . $datos['sanciones']->cantidad . '  Sanciones </td>
            </tr>
             <tr>
                <th align="center">Fecha</th>
                <th colspan="2" align="center">Traslados registradas  </th>
            </tr>
           <tr>
                <td>' . $desde . ' - ' . $hasta . '</td>
                <td bgcolor="#cccccc" align="center" colspan="2">Se han Trasladado ' . $datos['traslados']->cantidad . '  Avaluadores </td>
            </tr>
              </table>';
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
