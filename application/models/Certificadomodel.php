<?php

class CertificadoModel extends CI_Model {

    protected $tabla = 'certificados';
    protected $tabla_t = 'temporal_c';

    //---------AGREGA UN REGISTRO A LA TABLA TEMPORAL_C ---------//
    public function add_certificado($registros) {
        $this->db->insert('certificados', $registros);
        $time = time();
        $datestring = "%Y-%m-%d %h:%i:%s";
        $data['userafectado'] = "Certificado : " . $registros['pin'];
        $data['fecha'] = mdate($datestring, $time);
        $data['nombreusuario'] = $this->session->userdata("usuario");
        $data['codtipo_transaccion'] = 1;
        $this->db->insert('transacciones_raa', $data);
        
    }

//---------AGREGA UN REGISTRO A LA TABLA TEMPORAL_C ---------//
    public function add_temporal($registros) {
        $this->db->insert('temporal_c', $registros);
    }

    //-----------LISTA LOS REGISTROS DE LA TABLA TEMPORAL_C ---------//
    public function c_temporal($codera) {
        $sql = "SELECT 
	temporal_c.codtemporal_c, 
	temporal_c.numero_id, 
	avaluadores.nombres as nombres, 
	avaluadores.apellidos as apellidos, 
	avaluadores.codigoavaluador, 
	avaluadores.cedula 
FROM 
	temporal_c 
	INNER JOIN avaluadores on temporal_c.numero_id = avaluadores.numero_id 
WHERE 
	avaluadores.codera = ?";
        $array = $this->db->query($sql, $codera);
        return $array->result_array();
    }

    //-----------LISTA LOS REGISTROS DE LA TABLA TEMPORAL_C PARA YA GENERAR CERTIFICADO ---------//
    public function c_temporal_c($codera) {
        $sql = "SELECT 
	temporal_c.codtemporal_c, 
	temporal_c.numero_id, 
	avaluadores.nombres as nombres, 
	avaluadores.codigoavaluador, 
	avaluadores.foto, 
	avaluadores.cedula, 
	avaluadores.apellidos as apellidos, 
	avaluadores.codigoavaluador as codavaluador, 
	avaluadores.domicilio as domicilio, 
	avaluadores.correo as correo, 
	avaluadores.telefono, 
	avaluadores.celular, 
	avaluadores.fechainscripcion,
        avaluadores.fechavencimiento,
	era.razonsocial_era, 
	era.nit_era, 
	avaluadores.regindustria 
FROM 
	temporal_c 
	INNER JOIN avaluadores on temporal_c.numero_id = avaluadores.numero_id 
	INNER JOIN era ON era.codera = avaluadores.codera 
	
WHERE 
	avaluadores.codera = ?";
        $array = $this->db->query($sql, $codera);
        return $array->result_array();
    }

    //----------BUSCA UN REGISTRO DE TEMPORAL ---------//
    public function c_temporal_b($id) {
        $sql = "SELECT temporal_c.codtemporal_c,temporal_c.numero_id,avaluadores.nombres as nombres,avaluadores.apellidos as apellidos,avaluadores.codigoavaluador FROM temporal_c INNER JOIN avaluadores on temporal_c.numero_id=avaluadores.numero_id where temporal_c.numero_id=" . $id;
        $query = $this->db->query($sql);
        if ($query->num_rows() == 1) {

            $this->session->set_flashdata('incorrecto', 'Ya agrego el avaluador a la lista');
            return true;
        } else {
            return false;
        }
    }

    //-------- -----ELIMINAR TODOS LOS REGISTROS DE TEMPORAL---------------//
    public function truncate_t() {
        $sql = " TRUNCATE TABLE temporal_c";
        $this->db->query($sql);
    }

    //-------- -----ELIMINAR LOS REGISTROS DE LA ERA QUE INICIO EN TEMPORAL---------------//
    public function eliminar_t($codera) {
        $sql = "DELETE temporal_c 
FROM 
	temporal_c 
	INNER JOIN avaluadores on temporal_c.numero_id = avaluadores.numero_id 
WHERE 
	avaluadores.codera = ?";
        $this->db->query($sql, $codera);
//        redirect('adminera/nuevo_certificado_btn');
    }

    //-------- ------ELIMINAR REGITRO DE TEMPORAL----------------//
    public function delete_temporal($id) {
        $this->db->where('codtemporal_c', $id);
        return $this->db->delete('temporal_c');
    }

    //-------- -----PRUEBA EXCEL----------------//
    public function get() {
        $query = $this->db->query("select * from estados");
        return array("fields" => array('id', 'nombre'), "query" => $query);
    }

    //-----------LISTA AVALUADORES ACTIVOS DE LA ERA QUE INICIO PARA EXCEL ---------//
    public function c_avaluador_activo($codera) {
        $query = $this->db->query("SELECT 
	avaluadores.codigoavaluador, 
	avaluadores.cedula, 
	avaluadores.nombres, 
	avaluadores.apellidos,
    avaluadores.domicilio,
    avaluadores.fechainscripcion, 
	avaluadores.fechavencimiento,
    avaluadores.regindustria, 
    estados.nombre as estado
   
FROM 
	avaluadores 
	INNER JOIN estados on estados.codestado = avaluadores.codestado 
	
WHERE 
	avaluadores.codestado = 1 
	AND avaluadores.codera =" . $codera);
        return array("fields" => array('num', 'cedula', 'nombres', 'apellidos', 'direccion', 'fecha inscripcion', 'fecha vencimiento', 'industria', 'estado'), "query" => $query);
    }

    //--------------LISTA AVALUADORES VENCIDOS DE LA ERA QUE INICIO PARA EXCEL ---------//
    public function c_avaluador_inactivo($codera) {
        $query = $this->db->query("SELECT 
	avaluadores.codigoavaluador, 
	avaluadores.cedula, 
	avaluadores.nombres, 
	avaluadores.apellidos,
    avaluadores.domicilio,
    avaluadores.fechainscripcion, 
	avaluadores.fechavencimiento,
    avaluadores.regindustria, 
    estados.nombre as estado
   
FROM 
	avaluadores 
	INNER JOIN estados on estados.codestado = avaluadores.codestado 
	
WHERE 
	avaluadores.codestado = 2 
	AND avaluadores.codera =" . $codera);
        return array("fields" => array('num', 'cedula', 'nombres', 'apellidos', 'direccion', 'fecha inscripcion', 'fecha vencimiento', 'industria', 'estado'), "query" => $query);
    }

     //--------------LISTA TODOS LOS AVALUADORES DE LA ERA QUE INICIO PARA EXCEL ---------//
    public function c_avaluadores($codera) {
        $query = $this->db->query("SELECT 
	avaluadores.codigoavaluador, 
	avaluadores.cedula, 
	avaluadores.nombres, 
	avaluadores.apellidos,
    avaluadores.domicilio,
    avaluadores.fechainscripcion, 
	avaluadores.fechavencimiento,
    avaluadores.regindustria, 
    estados.nombre as estado
   
FROM 
	avaluadores 
	INNER JOIN estados on estados.codestado = avaluadores.codestado 
	
WHERE 
avaluadores.codera =" . $codera);
        return array("fields" => array('num', 'cedula', 'nombres', 'apellidos', 'direccion', 'fecha inscripcion', 'fecha vencimiento', 'industria', 'estado'), "query" => $query);
    }
    
      //-----------LISTAR LAS CATEGORIAS DE UN  AVALUADOR ESPECIFICO ---------//
    public function c_categorias($id) {
        $sql = "SELECT 
	categoria_avaluador.nombre 
FROM 
	avaluadores_categoria 
	INNER JOIN categoria_avaluador on avaluadores_categoria.codcategoria_avaluador = categoria_avaluador.codcategoria_avaluador 
WHERE 
NOT categoria_avaluador.codestado = 2
	AND numero_id = ?";
        $array = $this->db->query($sql, $id);
        return $array->result_array();
    }
    
}
