<?php

class ReporteModel extends CI_Model {

    
   
//---------------------METODOS PARA  REPORTE DE ERAS-------------------------------------//


     //----------LISTA USUARIOS --------//
    public function c_usr($codera) {
        $sql = "SELECT 
	usuarios.nombreusuario, 
	perfiles.nombre as perfil, 
	usuarios.codusuario, 
	usuarios.nombres, 
	usuarios.correo,
        estado_usuarios.nombre as estado
FROM 
	usuarios 
	INNER JOIN perfiles on usuarios.codperfil = perfiles.codperfil 
        INNER JOIN estado_usuarios on usuarios.codestado=estado_usuarios.codestado_usuarios
WHERE 
	 usuarios.codera =".$codera;
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    
    
    
     //--------CONSULTAR AVALAUADORES ---------//
    public function c_avaluador($codera) {
        $sql = "SELECT 
	avaluadores.cedula, 
	avaluadores.codigoavaluador, 
	avaluadores.nombres, 
	avaluadores.apellidos, 
	avaluadores.fechavencimiento,
	estados.nombre as estado, 
	era.razonsocial_era as era, 
	avaluadores.codera 
FROM 
	avaluadores 
	INNER JOIN estados on estados.codestado = avaluadores.codestado 
	INNER JOIN era on era.codera = avaluadores.codera 
	INNER JOIN tipo_documento on tipo_documento.codtipo_documento = avaluadores.codtipo_documento 
WHERE 
	avaluadores.codera = " . $codera;
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    
    
    //---------LISTAR COMITES REALIZADOS--------//
    public function c_comite($codera) {
        $sql = "SELECT * FROM comite_aprobacion WHERE comite_aprobacion.codera=" . $codera;
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    
    
     //---------LISTAR CERTIFICADOS GENERADOS DE LA ERA QUE INICIO--------//
    public function c_certificado($codera) {
        $sql = "SELECT 
	certificados.codcertificado, 
	certificados.pin, 
	certificados.fechagenerado, 
	avaluadores.nombres, 
	avaluadores.apellidos, 
	avaluadores.cedula 
FROM 
	certificados 
	INNER JOIN avaluadores on certificados.numero_id = avaluadores.numero_id 
where 
	avaluadores.codera =".$codera;
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    
    
    
    //---------LISTAR TODAS LAS SANCIONES DE LA ERA QUE INICIO--------//
    public function c_sanciones($codera) {
        $sql = "SELECT 
	sanciones.descripcion, 
	sanciones.fecharegistro, 
	tipo_sancion.nombre as tipo, 
	avaluadores.nombres, 
	avaluadores.cedula, 
	avaluadores.apellidos 
FROM 
	sanciones 
	INNER JOIN avaluadores on sanciones.numero_id = avaluadores.numero_id 
	INNER JOIN tipo_sancion on tipo_sancion.codtipo_sancion = sanciones.codtipo_sancion 
WHERE 
	avaluadores.codera =".$codera;
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    
    
    //-----------------LISTAR LOS TRASLADOS REALZIADOS DE LA ERA QUE INICIA ------------//
    public function ver_traslados($codera) {
        $sql = "SELECT traslado.codtraslado,traslado.fecha,traslado.antes,traslado.despues,avaluadores.nombres from traslado INNER JOIN avaluadores on avaluadores.numero_id=traslado.numero_id INNER JOIN era on era.codera=avaluadores.codera where avaluadores.codera=" . $codera;
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    //----------------LISTAR TODOS LOS TRASLADOS REALIZADOS------------------------//
    public function c_traslados() {
        $sql = "SELECT 
	avaluadores.nombres, 
	avaluadores.apellidos, 
	avaluadores.cedula, 
	traslados.anterior, 
	traslados.nueva, 
	traslados.fecha 
from 
	traslados 
	INNER JOIN solicitud_traslado ON traslados.codsolicitud = solicitud_traslado.codsolicitud 
	INNER JOIN avaluadores on solicitud_traslado.numero_id = avaluadores.numero_id";
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    //-----------------CONTAR LOS USUARIOS DE LA ERA QUE INICIA-------------//
    public function contar_usuarios($codera,$desde,$hasta) {
        $sql = "SELECT 
	count(*) as cantidad 
FROM 
	usuarios 
where 
	codera = ".$codera." 
	AND fecharegistro BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }

    
     //-----------------CONTAR LOS AVALUADORES DE LA ERA QUE INICIA-------------//
    public function contar_avaluadores($codera,$desde,$hasta) {
        $sql = "SELECT 
	count(*) as cantidad 
FROM 
	avaluadores 
where 
	codera = ".$codera."
	AND avaluadores.fechainscripcion BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }
    
    
    public function contar_comite($codera,$desde,$hasta){
        $sql="SELECT 
	count(*) as cantidad 
FROM 
	comite_aprobacion 
where 
	codera = ".$codera."
	AND comite_aprobacion.fecha BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }
    public function contar_certificados($codera,$desde,$hasta){
        $sql=" SELECT 
	count(*) as cantidad 
FROM 
	certificados 
    INNER JOIN avaluadores on certificados.numero_id=avaluadores.numero_id
where 
	avaluadores.codera = ".$codera."
	AND certificados.fechagenerado BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }
    public function contar_sanciones($codera,$desde,$hasta){
        $sql=" SELECT 
	count(*) as cantidad 
FROM 
	sanciones 
    INNER JOIN avaluadores on sanciones.numero_id=avaluadores.numero_id
where 
avaluadores.codera = ".$codera."
	AND sanciones.fecharegistro BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }
    
    
    public function contar_traslados($desde,$hasta){
        $sql=" SELECT 
	count(*) as cantidad 
FROM 
	traslados 
   
where  traslados.fecha  BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }
    
    
    
    
    
    //-----------------CONTAR LOS USUARIOS DE LA ERA QUE INICIA-------------//
    public function contar_usuariosraa($desde,$hasta) {
        $sql = "SELECT 
	count(*) as cantidad 
FROM 
	usuarios 
where 
	 fecharegistro BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }

    
     //-----------------CONTAR LOS AVALUADORES DE LA ERA QUE INICIA-------------//
    public function contar_avaluadoresraa($desde,$hasta) {
        $sql = "SELECT 
	count(*) as cantidad 
FROM 
	avaluadores 
where 
	avaluadores.fechainscripcion BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }
    
    
    public function contar_comiteraa($desde,$hasta){
        $sql="SELECT 
	count(*) as cantidad 
FROM 
	comite_aprobacion 
where 
	comite_aprobacion.fecha BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }
    public function contar_certificadosraa($desde,$hasta){
        $sql=" SELECT 
	count(*) as cantidad 
FROM 
	certificados 
   
where 
	 certificados.fechagenerado BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }
    public function contar_sancionesraa($desde,$hasta){
        $sql=" SELECT 
	count(*) as cantidad 
FROM 
	sanciones 
   
where sanciones.fecharegistro BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }
    
    
    public function contar_trasladosraa($desde,$hasta){
        $sql=" SELECT 
	count(*) as cantidad 
FROM 
	traslados 
   
where  traslados.fecha  BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }
    public function contar_erasraa($desde,$hasta){
        $sql=" SELECT 
	count(*) as cantidad 
FROM 
	era 
   
where  era.fecha_registro_raa  BETWEEN  '".$desde."' 
	and '".$hasta."'";
        $array = $this->db->query($sql);
        return $array->row();
    }

    
     //-----------LISTA LAS ERAS ---------//
    public function eras() {
        $registros = $this->db->get('era');
        return $registros->result_array();
    }

//    //-----------------CONTAR LAS SOLICITUDES DE LA ERA QUE INICIA-------------//
//    public function contar_solicitudes($codera) {
//        $sql = "SELECT count(*)as cantidad FROM solicitudes INNER JOIN avaluadores ON solicitudes.numero_id=avaluadores.numero_id WHERE avaluadores.codera=" . $codera . " and solicitudes.codestado_solicitud=2";
//        $array = $this->db->query($sql, $codera);
//        return $array->row();
//    }

   
    
}
