<?php

class UsuarioeraModel extends CI_Model {

    protected $tabla = 'era';

//-----------SOLICITUDES DE UN AVALUADOR  ---------//
    public function solicitudes($id) {
        $sql = "SELECT 
	solicitudes.codsolicitud, 
	solicitudes.detalle, 
	solicitudes.observacion, 
	solicitudes.fecha, 
	estado_solicitud.nombre as estado 
FROM 
	solicitudes 
	INNER JOIN avaluadores on solicitudes.numero_id = avaluadores.numero_id 
	INNER JOIN estado_solicitud on estado_solicitud.codestado_solicitud = solicitudes.codestado_solicitud 
WHERE 
	avaluadores.numero_id=?";
        $array = $this->db->query($sql, $id);
        return $array->result_array();
    }

    //-----------INSERTAR UNA NUEVA SOLICITUD  ---------//
    public function insertar_solicitud($datos) {
        if ($this->db->insert('solicitudes', $datos)) {
            $time = time();
            $datestring = "%Y-%m-%d %h:%i:%s";
            $data['userafectado'] = "Solicitud de: " . $this->session->userdata("nombres");
            $data['fecha'] = mdate($datestring, $time);
            $data['nombreusuario'] = $this->session->userdata("usuario");
            $data['codtipo_transaccion'] = 1;
            $this->db->insert('transacciones_raa', $data);
            return true;
        }
    }

    //-----------LISTAR SANCIONES DE UN AVALUADOR---------//
    public function listar_sanciones($id) {
        $sql = "SELECT 
	sanciones.codsancion, 
	sanciones.descripcion, 
	sanciones.fecharegistro, 
	sanciones.soporte, 
	tipo_sancion.nombre as tipo, 
	comite_aprobacion.fecha as comite, 
	sanciones.fechafin 
FROM 
	`sanciones` 
	INNER JOIN comite_aprobacion on comite_aprobacion.codcomite = sanciones.codcomite 
	INNER JOIN tipo_sancion on tipo_sancion.codtipo_sancion = sanciones.codtipo_sancion 
WHERE 
	sanciones.numero_id = ?";
        $array = $this->db->query($sql, $id);
        return $array->result_array();
    }

    public function listar_era() {
        $registros = $this->db->get($this->tabla);
        return $registros->result_array();
    }

    //-----------LISTAR DETALLE DE LA SOLICITUD---------//
    public function ver_detallesol($id) {
        $sql = "SELECT 
	solicitudes_comite.respuesta, 
	solicitudes_comite.Observaciones, 
	avaluadores.nombres, 
        solicitudes.detalle as solicitud,
	solicitudes_comite.codsolicitud, 
	estado_solicitud.nombre, 
	comite_aprobacion.fecha as fecrespuesta 
FROM 
	solicitudes_comite 
	INNER JOIN solicitudes on solicitudes.codsolicitud = solicitudes_comite.codsolicitud 
	INNER JOIN avaluadores on avaluadores.numero_id = solicitudes.numero_id 
	INNER JOIN comite_aprobacion on comite_aprobacion.codcomite = solicitudes_comite.codcomite 
	INNER JOIN estado_solicitud on estado_solicitud.codestado_solicitud = solicitudes.codestado_solicitud 
WHERE 
	solicitudes_comite.codsolicitud = ?";
        $array = $this->db->query($sql, $id);
        return $array->result_array();
    }

    //---------- BUSCAA INFORMACION DE UN USUARIO PARA EDITAR---------//
    public function consulta_usuario($codusuario) {
        $sql = "SELECT usuarios.nombreusuario,usuarios.clave,perfiles.nombre as perfil,usuarios.codusuario,usuarios.nombres,usuarios.correo FROM usuarios INNER JOIN perfiles on usuarios.codperfil=perfiles.codperfil WHERE usuarios.codusuario=?";
        $array = $this->db->query($sql, $codusuario);
        return $array->row();
    }

    //---------ACTUALIZAR UN USUARIO  ------------/ 
    public function upd_usr($cod, $registros) {
        $this->db->where('codusuario', $cod);
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        if ($this->db->update('usuarios', $registros)) {
            $data['userafectado'] = $registros['nombres'];
            $data['fecha'] = mdate($datestring, $time);
            $data['nombreusuario'] = $this->session->userdata("nombres");
            $data['codtipo_transaccion'] = 2;
            $this->db->insert('transacciones_raa', $data);
        }
    }

    //-----------------VERIFICAR QUE SE NO SE REPITAN LOS NOMBRE DE USUARIO-----------//
    public function verificar_usuarios_nom($nombreusuario) {

        $sql = "SELECT * from usuarios where usuarios.nombreusuario='" . $nombreusuario . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 1) {
            $this->session->set_flashdata('incorrecto', 'Nombre de Usuario ya existe');
            return true;
        } else {
            return FALSE;
        }
    }

    //----------VERIFICAR QUE LA CONTRASEÑA SEA CORRECTA---------//
    public function verificar_pass($codusr, $pass) {
        $this->db->where('codusuario', $codusr);
        $this->db->where('clave', $pass);
        $query = $this->db->get('usuarios');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            $this->session->set_flashdata('incorrecto', 'Escribio mal la contraseña');
            return false;
        }
    }

    //-----------ACTUALIZAR CONTRASEÑA DE USR   ---------//
    public function actualizar_pass($cod, $registros) {
        $this->db->where('codusuario', $cod);
        if ($this->db->update('usuarios', array('clave' => md5($registros['clavenueva'])))) {
            $this->session->set_flashdata('correcto', 'Cambio de clave correcto');
            $time = time();
            $datestring = "%Y-%m-%d %h:%i:%s";
            $data['userafectado'] = "Actualizo Contraseña: " . $this->session->userdata("nombres");
            $data['fecha'] = mdate($datestring, $time);
            $data['nombreusuario'] = $this->session->userdata("usuario");
            $data['codtipo_transaccion'] = 2;
            $this->db->insert('transacciones_raa', $data);
            return true;
        }
    }

    public function consulta_era($id) {
        $this->db->where('codera', $id);
        return $this->db->get($this->tabla)->row();
    }

    //----------TRAE EL CORREO Y NOMBRE DE USUARIO ADMIN DE LA ERA ---------//
    public function list_correoadm($numeroid) {
        $sql = "SELECT 
	usuarios.correo, 
	usuarios.nombres 
FROM 
	usuarios 
WHERE 
	usuarios.codera =(
		SELECT 
			codera 
		FROM 
			`avaluadores` 
		WHERE 
			numero_id = " . $numeroid . "
	) 
	AND codperfil = 2";
        $array = $this->db->query($sql);
        return $array->row();
    }

}
