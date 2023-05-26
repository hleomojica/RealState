<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-01-25 07:38:09 --> 404 Page Not Found: Uploads/imagenes
ERROR - 2016-01-25 07:38:56 --> 404 Page Not Found: Uploads/imagenes
ERROR - 2016-01-25 07:38:56 --> 404 Page Not Found: Uploads/imagenes
ERROR - 2016-01-25 08:12:07 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '>pdf->Ln(20); 
	and avaluadores.codera = 1' at line 30 - Invalid query: SELECT 
	avaluadores.numero_id, 
	avaluadores.cedula, 
	avaluadores.codigoavaluador, 
	avaluadores.codtipo_documento, 
	avaluadores.codestado, 
	avaluadores.foto, 
	avaluadores.nombres, 
	avaluadores.apellidos, 
	avaluadores.lugar_nac, 
	tipo_documento.nombre as tipodocumento, 
	avaluadores.numero_id, 
	avaluadores.fechaex_id, 
	avaluadores.domicilio, 
	avaluadores.telefono, 
	avaluadores.celular, 
	avaluadores.correo, 
	avaluadores.regimen_inscripcion, 
	avaluadores.soporte, 
	avaluadores.fechainscripcion, 
	estados.nombre as estado, 
	era.razonsocial_era as era, 
	avaluadores.codera 
FROM 
	avaluadores 
	INNER JOIN estados on estados.codestado = avaluadores.codestado 
	INNER JOIN era on era.codera = avaluadores.codera 
	INNER JOIN tipo_documento on tipo_documento.codtipo_documento = avaluadores.codtipo_documento 
WHERE 
	avaluadores.cedula = $this->pdf->Ln(20); 
	and avaluadores.codera = 1
ERROR - 2016-01-25 09:39:28 --> 404 Page Not Found: Uploads/imagenes
ERROR - 2016-01-25 09:39:29 --> 404 Page Not Found: Uploads/imagenes
ERROR - 2016-01-25 09:39:34 --> 404 Page Not Found: Uploads/imagenes
ERROR - 2016-01-25 09:39:34 --> 404 Page Not Found: Uploads/imagenes
