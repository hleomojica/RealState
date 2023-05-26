<?php

class AdmineraModel extends CI_Model {

    protected $tabla = 'era';
     public function __construct() {
        parent::__construct();
        $this->load->library('cifrar');
    }

//--------FUNCION QUE LISTA TODAS LAS ENTIDADES DEL SISTEMA--------//
    public function listar_era() {
        $registros = $this->db->get($this->tabla);
        return $registros->result_array();
    }

    //-----------LISTA TODOS LOS AVALUADORES DE LA ERA QUE INICIO ---------//
    public function ver_avaluadores($id) {
        $sql = "SELECT 
	avaluadores.numero_id, 
	avaluadores.cedula, 
	avaluadores.codigoavaluador, 
	avaluadores.regindustria, 
	avaluadores.fechavencimiento, 
	avaluadores.foto, 
	avaluadores.nombres, 
	avaluadores.apellidos, 
	avaluadores.lugar_nac, 
	tipo_documento.nombre, 
	avaluadores.numero_id, 
	avaluadores.fechaex_id, 
	avaluadores.domicilio, 
	avaluadores.telefono, 
	avaluadores.celular, 
	avaluadores.correo, 
	avaluadores.regimen_inscripcion, 
	avaluadores.soporte,
        avaluadores.formato_solicitud, 
	avaluadores.fechainscripcion, 
	estados.nombre as estado, 
	 
	era.razonsocial_era as era, 
	avaluadores.codera 
FROM 
	avaluadores 
	INNER JOIN estados on estados.codestado = avaluadores.codestado 

	INNER JOIN era on era.codera = avaluadores.codera 
	INNER JOIN tipo_documento on tipo_documento.codtipo_documento = avaluadores.codtipo_documento 
where 
	avaluadores.codera =?";
        $array = $this->db->query($sql, $id);
        return $array->result_array();
    }

    //-----------LISTA UN AVALUADOR ESPECIFICO ---------//
    public function c_avaluador($id) {
        $sql = "SELECT 
	avaluadores.numero_id, 
	avaluadores.cedula, 
	avaluadores.regindustria, 
	avaluadores.codigoavaluador, 
	avaluadores.regindustria, 
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
        avaluadores.tarjetaprofesional,
        avaluadores.formato_solicitud,
	avaluadores.regimen_inscripcion, 
	avaluadores.soporte, 
	avaluadores.fechainscripcion,
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
	avaluadores.numero_id =?";
        $array = $this->db->query($sql, $id);
        return $array->row();
    }

    //-----------LISTAR LAS CATEGORIAS DE UN  AVALUADOR ESPECIFICO ---------//
    public function c_cat_ava($id) {
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

    //---------UPDATE CATEGORIAS DE UN AVALUADOR  ------------/ 
    public function act_cat_ava($registros, $numero_id) {
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        $sql = "DELETE FROM avaluadores_categoria  WHERE avaluadores_categoria.numero_id =" . $numero_id;
        if ($this->db->query($sql)) {
            foreach ($registros as $row) {
                $this->db->insert('avaluadores_categoria', array('numero_id' => $numero_id, 'codcategoria_avaluador' => $row));
            }
        }
        $data['userafectado'] = "Avaluador codigo : " . $numero_id;
        $data['fecha'] = mdate($datestring, $time);
        $data['nombreusuario'] = $this->session->userdata("usuario");
        $data['codtipo_transaccion'] = 2;
        $this->db->insert('transacciones_raa', $data);
    }

    //-----------LISTA AVALUADORES ACTIVOS DE LA ERA QUE INICIO ---------//
    public function c_avaluador_activo($codera) {
        $sql = "SELECT avaluadores.numero_id,avaluadores.cedula,avaluadores.codigoavaluador,avaluadores.fechainscripcion,avaluadores.fechavencimiento,avaluadores.regindustria,avaluadores.codtipo_documento,avaluadores.codestado,avaluadores.codcategoria_avaluador,avaluadores.foto,avaluadores.nombres,avaluadores.apellidos,avaluadores.lugar_nac,tipo_documento.nombre as tipodocumento,avaluadores.numero_id,avaluadores.fechaex_id,avaluadores.domicilio,avaluadores.telefono,avaluadores.celular,avaluadores.correo,avaluadores.regimen_inscripcion,avaluadores.soporte,avaluadores.fechainscripcion,estados.nombre as estado, categoria_avaluador.nombre as categoria,era.razonsocial_era as era,avaluadores.codera FROM avaluadores INNER JOIN estados on estados.codestado=avaluadores.codestado INNER JOIN categoria_avaluador on categoria_avaluador.codcategoria_avaluador=avaluadores.codcategoria_avaluador INNER JOIN era on era.codera=avaluadores.codera INNER JOIN tipo_documento on tipo_documento.codtipo_documento=avaluadores.codtipo_documento WHERE avaluadores.codestado=1 AND avaluadores.codera=?";
        $array = $this->db->query($sql, $codera);
        return $array->result_array();
    }

    //--------------LISTA AVALUADORES VENCIDOS DE LA ERA QUE INICIO ---------//
    public function c_avaluador_inactivo($codera) {
        $sql = "SELECT avaluadores.numero_id,avaluadores.cedula,avaluadores.codigoavaluador,avaluadores.fechainscripcion,avaluadores.fechavencimiento,avaluadores.regindustria,avaluadores.codtipo_documento,avaluadores.codestado,avaluadores.codcategoria_avaluador,avaluadores.foto,avaluadores.nombres,avaluadores.apellidos,avaluadores.lugar_nac,tipo_documento.nombre as tipodocumento,avaluadores.numero_id,avaluadores.fechaex_id,avaluadores.domicilio,avaluadores.telefono,avaluadores.celular,avaluadores.correo,avaluadores.regimen_inscripcion,avaluadores.soporte,avaluadores.fechainscripcion,estados.nombre as estado, categoria_avaluador.nombre as categoria,era.razonsocial_era as era,avaluadores.codera FROM avaluadores INNER JOIN estados on estados.codestado=avaluadores.codestado INNER JOIN categoria_avaluador on categoria_avaluador.codcategoria_avaluador=avaluadores.codcategoria_avaluador INNER JOIN era on era.codera=avaluadores.codera INNER JOIN tipo_documento on tipo_documento.codtipo_documento=avaluadores.codtipo_documento WHERE avaluadores.codestado=2 AND avaluadores.codera=?";
        $array = $this->db->query($sql, $codera);
        return $array->result_array();
    }

    //--------BUSCA UN AVALUADOR DE LA ERA QUE INICIO PARA AGREGAR A TEMPORAL ---------//
    public function c_avaluador_e($id, $codera) {
        $sql = "SELECT 
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
	avaluadores.cedula = " . $id . " 
	and avaluadores.codera = " . $codera;
        $array = $this->db->query($sql, $id);
        return $array->row();
    }

    //-----------LISTA LOS ESTADOS ---------//
    public function listar_estados() {
        $registros = $this->db->get('estados');
        return $registros->result_array();
    }
    //-----------LISTA LOS ESTADOS ---------//
    public function listar_estados_usr() {
        $registros = $this->db->get('estado_usuarios');
        return $registros->result_array();
    }

//-----------LISTA TIPOS DE DOCUMENTO ---------//
    public function listar_tipodocumento() {
        $registros = $this->db->get('tipo_documento');
        return $registros->result_array();
    }

    //-----------------VERIFICAR QUE SE NO SE REPITAN LAS CEDULAS-----------//
    public function verificar_usuarios_cc($cedula) {
        $sql = "SELECT * from avaluadores where avaluadores.cedula=" . $cedula;
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            $this->session->set_flashdata('incorrecto', 'Ya hay un avaluador registrado con esa Cedula');
            return true;
            
        } else {
            echo '<div style="display:none">1</div>';
            return FALSE;
        }
    }

    //----------AGREGAR NUEVO AVALUADOR Y ASIGNA UN USUARIO ---------//
    public function add_avaluador($registros, $codera, $categorias) {
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        $maxid = 0;
        $row = $this->db->query('SELECT MAX(codigoavaluador) AS `maxid` FROM `avaluadores` where codera=' . $codera)->row();
        if ($row) {
            $maxid = $row->maxid;
        }
        $registros['codigoavaluador'] = $maxid + 1;
        if ($this->db->insert('avaluadores', $registros)) {
            $num_id = $this->db->insert_id();
            $datas['userafectado'] = "Avaluador: " . $registros['nombres'];
            $datas['fecha'] = mdate($datestring, $time);
            $datas['nombreusuario'] = $this->session->userdata("usuario");
            $datas['codtipo_transaccion'] = 1;
            $this->db->insert('transacciones_raa', $datas);
            $data['nombreusuario'] = $registros['cedula'];
            $data['clave'] = md5($registros['cedula']);
            $data['codera'] = $registros['codera'];
            $data['codperfil'] = 3;
            $data['nombres'] = $registros['nombres'];
            $data['correo'] = $registros['correo'];
            $data['numero_id'] = $num_id;
            $data['codestado'] = 1;
            $this->db->insert('usuarios', $data);
            foreach ($categorias as $row) {
                $this->db->insert('avaluadores_categoria', array('numero_id' => $num_id, 'codcategoria_avaluador' => $row));
            }

            $this->session->set_flashdata('correcto', 'Avaluador y usuarios Creados');
        } else {
            $this->session->set_flashdata('incorrecto', 'Error de Base de Datos');
            return false;
        }
    }


    //---------- BUSCAA LOS USUARIOS DE UNA ERA---------//
    public function consulta_usuarios($id) {
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
	usuarios.codperfil = 3 
	AND usuarios.codera = ?";
        $array = $this->db->query($sql, $id);
        return $array->result_array();
    }

    //---------- BUSCAA EL USUARIO DE LA ERA QUE INICIO---------//
    public function consulta_usuario_era($nombreusuario) {
        $sql = "SELECT usuarios.nombreusuario,usuarios.clave,perfiles.nombre as perfil,usuarios.codusuario,usuarios.nombres,usuarios.correo FROM usuarios INNER JOIN perfiles on usuarios.codperfil=perfiles.codperfil WHERE usuarios.codusuario=?";
        $array = $this->db->query($sql, $nombreusuario);
        return $array->row();
    }
    
    
     //----------LISTA USUARIOS POR NOBRE--------//
    public function c_usr_nombre($nombre, $codera) {
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
	usuarios.codperfil = 3 
	AND usuarios.codera =  " . $codera . "
    AND usuarios.nombres like '%" . $nombre . "%'";
        $array = $this->db->query($sql);
        return $array->result_array();
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

    //-----------ACTUALIZAR CONTRASEÑA DE USR ERA  ---------//
    public function actualizar_pass($cod, $registros) {
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        $this->db->where('codusuario', $cod);


        if ($this->db->update('usuarios', array('clave' => md5($registros['clavenueva'])))) {

            $datas['userafectado'] = "Usuario: " . $registros['nombreusuario'];
            $datas['fecha'] = mdate($datestring, $time);
            $datas['nombreusuario'] = $this->session->userdata("usuario");
            $datas['codtipo_transaccion'] = 2;
            $this->db->insert('transacciones_raa', $datas);
            $this->session->set_flashdata('correcto', 'Actualizado Correctamente');
            return true;
        }
    }

    //-----------LISTA UN AVALUADOR DE UNA ERA SEGUN EL ESTADO ---------//
    public function c_avaluador_estado($codestado, $codera) {
        $sql = "SELECT 
	avaluadores.numero_id, 
	avaluadores.cedula, 
	avaluadores.foto, 
	avaluadores.codigoavaluador, 
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
	avaluadores.codestado = " . $codestado . " 
	AND avaluadores.codera = " . $codera . "";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //-----------LISTA UN AVALUADOR DE UNA ERA POR NOMBRE---------//
    public function c_avaluador_nombre($nombre, $codera) {
        $sql = "SELECT 
	avaluadores.numero_id, 
	avaluadores.cedula, 
	avaluadores.codigoavaluador, 
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
	avaluadores.nombres like '%" . $nombre . "%' 
	AND avaluadores.codera = " . $codera . "";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //-----------LISTA UN AVALUADOR DE UNA ERA POR CEDULA---------//
    public function c_avaluador_cedula($cc, $codera) {
        $sql = "SELECT 
	avaluadores.numero_id, 
	avaluadores.cedula, 
	avaluadores.codigoavaluador, 
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
	avaluadores.cedula like '%" . $cc . "%' 
	AND avaluadores.codera = " . $codera . "";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    
    
    //-----------ACTUALIZAR UN AVALUADOR ---------//
    public function upd_avaluador($cod, $registros) {
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        $this->db->where('numero_id', $cod);
        if ($this->db->update('avaluadores', $registros)) {
            $datas['userafectado'] = "Avaluador: " . $registros['nombres'];
            $datas['fecha'] = mdate($datestring, $time);
            $datas['nombreusuario'] = $this->session->userdata("usuario");
            $datas['codtipo_transaccion'] = 2;
            $this->db->insert('transacciones_raa', $datas);
            $this->session->set_flashdata('correcto', 'Actualizado Correctamente');
            return true;
        }
    }

    //-----------------CONTAR LOS AVALUADORES DE LA ERA QUE INICIA-------------//
    public function contar_avaluadores($codera) {
        $sql = "SELECT count(*)as cantidad FROM avaluadores where codera=?";
        $array = $this->db->query($sql, $codera);
        return $array->row();
    }

    //-----------------CONTAR LOS USUARIOS DE LA ERA QUE INICIA-------------//
    public function contar_usuarios($codera) {
        $sql = "SELECT count(*)as cantidad FROM usuarios where codera=?";
        $array = $this->db->query($sql, $codera);
        return $array->row();
    }

    //-----------------CONTAR LAS SOLICITUDES DE LA ERA QUE INICIA-------------//
    public function contar_solicitudes($codera) {
        $sql = "SELECT count(*)as cantidad FROM solicitudes INNER JOIN avaluadores ON solicitudes.numero_id=avaluadores.numero_id WHERE avaluadores.codera=" . $codera . " and solicitudes.codestado_solicitud=2";
        $array = $this->db->query($sql, $codera);
        return $array->row();
    }

    //---------LISTAR CERTIFICADOS GENERADOS DE LA ERA QUE INICIO--------//
    public function listar_certificado($codera) {
        $sql = "SELECT certificados.codcertificado,certificados.pin,certificados.fechagenerado,certificados.fechavencimiento,avaluadores.nombres,avaluadores.apellidos,avaluadores.cedula FROM certificados INNER JOIN avaluadores on certificados.numero_id=avaluadores.numero_id where avaluadores.codera=? order by certificados.fechagenerado DESC ";
        $array = $this->db->query($sql, $codera);
        return $array->result_array();
    }

    //---------LISTAR CERTIFICADOS DE TODAS LAS ERAS--------//
    public function listar_todos_certificado() {
        $sql = "SELECT certificados.codcertificado,certificados.pin,certificados.fechagenerado,certificados.fechavencimiento,avaluadores.nombres,avaluadores.apellidos,avaluadores.cedula FROM certificados INNER JOIN avaluadores on certificados.numero_id=avaluadores.numero_id";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

//   BORRAR METODO  //---------INSERTAR CERTIFICADO---------//
//    public function insertar_certificado($registros) {
//        $datestring = "%Y-%m-%d %h:%i:%s";
//        $time = time();
//        if ($this->db->insert('certificados',$registros)){
//            $datas['userafectado'] = "Certificado:".$registros['pin'];
//            $datas['fecha'] = mdate($datestring, $time);
//            $datas['nombreusuario'] = $this->session->userdata("usuario");
//            $datas['codtipo_transaccion'] = 1;
//            $this->db->insert('transacciones_raa', $datas);
//        }
//    }
    //---------LISTAR COMITES REALIZADOS--------//
    public function listar_comite($codera) {
        $sql = "SELECT * FROM comite_aprobacion WHERE comite_aprobacion.codera=" . $codera;
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    
    //---------DETALLE DE UN COMITES REALIZADOS--------//
    public function listar_comitedetalle($codcomite) {
        $sql = "SELECT * FROM comite_aprobacion WHERE comite_aprobacion.codcomite=" . $codcomite;
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    
    

    //---------LISTAR RESPUESTAS A SOLICITUDES DE UN COMITE ENVIADAS POR EL SISTEMA-------//
    public function detalle_comitesolsis($codcomite) {
        $sql = "SELECT 
	avaluadores.nombres, 
	comite_aprobacion.funcionarios, 
	avaluadores.apellidos, 
	avaluadores.cedula, 
	comite_aprobacion.fecha as fechacomite, 
    solicitudes.detalle as solicitud,
	solicitudes_comite.respuesta, 
	solicitudes_comite.Observaciones 
from 
	solicitudes_comite 
	INNER JOIN solicitudes on solicitudes_comite.codsolicitud = solicitudes.codsolicitud 
	INNER JOIN avaluadores on avaluadores.numero_id = solicitudes.numero_id 
	INNER JOIN comite_aprobacion on comite_aprobacion.codcomite = solicitudes_comite.codcomite 
where 
	solicitudes_comite.codcomite=" . $codcomite;
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    
     //-----------LISTA LAS RESPUESTAS DE UN COMITE  ---------//
    public function detalle_comiteinscripciones($codcomite) {
        $this->db->where('codcomite',$codcomite);
        $registros = $this->db->get('SOLICITUD_INSCRIPCION');
        return $registros->result_array();
    }
    
    
    
      //---------INSERTAR SOLICITUD DE INSCRIPCION A UN COMITE---------//
    public function add_respuestainscripcion($registros) {
        $time = time();
        $datestring = "%Y-%m-%d %h:%i:%s";
        $this->db->insert('solicitud_inscripcion', $registros);
        $datas['userafectado'] = "Solicitud de inscripcion";
        $datas['fecha'] = mdate($datestring, $time);
        $datas['nombreusuario'] = $this->session->userdata("nombres");
        $datas['codtipo_transaccion'] = 1;
        $this->db->insert('transacciones_raa', $datas);
         $this->session->set_flashdata('correcto', 'Solicitud registrada correctamente');
    }
    
    //-----------------LISTAR SOLICITUDES PENDIENTES(2)DE LA ERA QUE INICIA------------//
    public function listar_solicitudes($codera) {
        $sql = "SELECT solicitudes.codsolicitud,solicitudes.detalle,solicitudes.observacion,solicitudes.numero_id,estado_solicitud.nombre as estado,avaluadores.nombres,avaluadores.cedula,avaluadores.apellidos FROM solicitudes INNER JOIN avaluadores ON solicitudes.numero_id=avaluadores.numero_id INNER JOIN estado_solicitud ON estado_solicitud.codestado_solicitud=solicitudes.codestado_solicitud WHERE avaluadores.codera=" . $codera . " and solicitudes.codestado_solicitud=2";
        $array = $this->db->query($sql, $codera);
        return $array->result_array();
    }

    //-----------------AGREGA UN COMITE A LA BD-----------//
    public function add_comite($registros) {
        $time = time();
        $datestring = "%Y-%m-%d %h:%i:%s";
        if ($this->db->insert('comite_aprobacion', $registros)) {
            $num_id = $this->db->insert_id();
            $datas['userafectado'] = "Comite: " . $registros['fecha'];
            $datas['fecha'] = mdate($datestring, $time);
            $datas['nombreusuario'] = $this->session->userdata("usuario");
            $datas['codtipo_transaccion'] = 1;
            $this->db->insert('transacciones_raa', $datas);
            redirect('adminera/comite_solinscripcion/'.$this->cifrar->enc($num_id));
            $this->session->set_flashdata('correcto', 'Comite registrado');
        }
    }

    //-----------------LISTAR  DETALELS DE LA SOLICITUD ------------//
    public function c_solicitud($codsol) {
        $sql = "SELECT solicitudes.codsolicitud,solicitudes.observacion,solicitudes.detalle,solicitudes.numero_id,estado_solicitud.nombre as estado,avaluadores.nombres,avaluadores.cedula,avaluadores.apellidos FROM solicitudes INNER JOIN avaluadores ON solicitudes.numero_id=avaluadores.numero_id INNER JOIN estado_solicitud ON estado_solicitud.codestado_solicitud=solicitudes.codestado_solicitud WHERE solicitudes.codsolicitud=" . $codsol;
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //---------LISTAR ESTADOS DE SOLICITUDES--------//
    public function listar_estado_s() {
        $sql = "SELECT * FROM estado_solicitud";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //-----------ACTUALIZAR EL ESTADO DE UNA SOLICITUD ---------//
    public function add_respuesta($datos1, $datos2) {
        $time = time();
        $datestring = "%Y-%m-%d %h:%i:%s";
        if ($this->db->insert('solicitudes_comite', $datos1)) {
            $datas['userafectado'] = "Respuesta a solicitud ";
            $datas['fecha'] = mdate($datestring, $time);
            $datas['nombreusuario'] = $this->session->userdata("usuario");
            $datas['codtipo_transaccion'] = 1;
            $this->db->insert('transacciones_raa', $datas);

            $this->db->where('numero_id', $datos2['numero_id']);
            $this->db->where('codsolicitud', $datos2['codsolicitud']);
            if ($this->db->update('solicitudes', array('codestado_solicitud' => $datos2['codestado_solicitud']))) {
                $this->session->set_flashdata('correcto', 'Respuesta Enviada Correctamente');
            }
        }
    }

    //---------LISTAR TODAS LAS SANCIONES DE LA ERA QUE INICIO--------//
    public function listar_sanciones($codera) {
        $sql = "SELECT 
	sanciones.codsancion, 
	sanciones.descripcion, 
	sanciones.fecharegistro, 
	sanciones.soporte, 
	tipo_sancion.nombre as tipo, 
	avaluadores.numero_id, 
	avaluadores.nombres, 
	avaluadores.cedula, 
	avaluadores.apellidos, 
	sanciones.fechafin 
FROM 
	sanciones 
	INNER JOIN avaluadores on sanciones.numero_id = avaluadores.numero_id 
	INNER JOIN tipo_sancion on tipo_sancion.codtipo_sancion = sanciones.codtipo_sancion 
WHERE 
	avaluadores.codera = " . $codera . " 
ORDER BY 
	fecharegistro DESC";
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    //---------LISTAR TODAS LAS SANCIONES DE LA ERA QUE INICIO POR FECHA--------//
    public function listar_sanciones_fecha($codera,$fecha) {
        $sql = "SELECT 
	sanciones.codsancion, 
	sanciones.descripcion, 
	sanciones.fecharegistro, 
	sanciones.soporte, 
	tipo_sancion.nombre as tipo, 
	avaluadores.numero_id, 
	avaluadores.nombres, 
	avaluadores.cedula, 
	avaluadores.apellidos, 
	sanciones.fechafin 
FROM 
	sanciones 
	INNER JOIN avaluadores on sanciones.numero_id = avaluadores.numero_id 
	INNER JOIN tipo_sancion on tipo_sancion.codtipo_sancion = sanciones.codtipo_sancion 
WHERE 
	avaluadores.codera = " . $codera . "
            AND sanciones.fecharegistro like '%" . $fecha . "%'            
ORDER BY 
	fecharegistro DESC";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //-----------------VERIFICAR QUE EL USUARIO EXISTA Y SEA DE LA ERA QUE INICIO------------//

    public function verificar_avaluador($id, $codera) {
        $sql = "SELECT 
	avaluadores.numero_id, 
	avaluadores.cedula, 
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
	avaluadores.cedula = " . $id . " 
	and avaluadores.codera = " . $codera;
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->row();
        }
        $this->session->set_flashdata('incorrecto', 'No se encuentra el Avaluador');
        return false;
    }

    //---------LISTAR TIPOS DE SANCION--------//
    public function listar_tipo_sancion() {
        $sql = "SELECT * FROM tipo_sancion where not tipo_sancion.codestado_tiposancion=2";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //---------INSERTAR SANCION---------//
    public function insertar_sancion($registros) {
        $time = time();
        $datestring = "%Y-%m-%d %h:%i:%s";
        $this->db->insert('sanciones', $registros);
        $datas['userafectado'] = "Sancion a Avaluador";
        $datas['fecha'] = mdate($datestring, $time);
        $datas['nombreusuario'] = $this->session->userdata("nombres");
        $datas['codtipo_transaccion'] = 1;
        $this->db->insert('transacciones_raa', $datas);
    }
    
     //---------ACTUALIZAR SANCION---------//
    public function update_sancion($registros,$codsan) {
        $this->db->where('codsancion', $codsan);
        if($this->db->update('sanciones', $registros)){
        $time = time();
        $datestring = "%Y-%m-%d %h:%i:%s";
        $datas['userafectado'] = "Sancion a Avaluador";
        $datas['fecha'] = mdate($datestring, $time);
        $datas['nombreusuario'] = $this->session->userdata("nombres");
        $datas['codtipo_transaccion'] = 2;
        $this->db->insert('transacciones_raa', $datas);
    }}

     //---------ELOMINAR SANION---------//
    public function delete_sancion($codsan) {
        $this->db->where('codsancion', $codsan);
        if($this->db->DELETE('sanciones')){
        $time = time();
        $datestring = "%Y-%m-%d %h:%i:%s";
        $datas['userafectado'] = "Sancion a Avaluador";
        $datas['fecha'] = mdate($datestring, $time);
        $datas['nombreusuario'] = $this->session->userdata("nombres");
        $datas['codtipo_transaccion'] = 3;
        $this->db->insert('transacciones_raa', $datas);
        
      
    }}
    
    
    //---------LISTAR DETALLE DE UNA SANCION-------//
    public function detalle_sancion($codsancion) {
        $sql = "SELECT 
	sanciones.codsancion, 
	sanciones.descripcion, 
	sanciones.fecharegistro, 
	sanciones.soporte, 
    sanciones.codtipo_sancion,
	tipo_sancion.nombre as tipo, 
	avaluadores.nombres, 
	avaluadores.apellidos, 
	avaluadores.cedula, 
	avaluadores.numero_id, 
    sanciones.codcomite,
	comite_aprobacion.fecha as comite, 
	sanciones.fechafin 
from 
	sanciones 
	INNER JOIN avaluadores on avaluadores.numero_id = sanciones.numero_id 
	INNER JOIN tipo_sancion ON tipo_sancion.codtipo_sancion = sanciones.codtipo_sancion 
	INNER JOIN comite_aprobacion on comite_aprobacion.codcomite = sanciones.codcomite 
where 
	sanciones.codsancion =" . $codsancion;
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //-----------ACTUALIZAR UN AVALUADOR INACTIVAR ESTADO 2(INACTIVO)---------//
    public function upd_inactivar($codava, $anterior) {
        $this->db->where('numero_id', $codava);
        $this->db->update('avaluadores', array('codestado' => '2'));
        $time = time();
        $datestring = "%Y-%m-%d %h:%i:%s";
        $data['userafectado'] = "Inactivo Avaluador : " . $anterior->nombres . " " . $anterior->apellidos;
        $data['fecha'] = mdate($datestring, $time);
        $data['nombreusuario'] = $this->session->userdata("usuario");
        $data['codtipo_transaccion'] = 2;
        $this->db->insert('transacciones_raa', $data);
    }

    //--------------------------LISTA LOS PERFILES ---------//
    public function listar_perfiles() {
        $registros = $this->db->get('perfiles');
        return $registros->result_array();
    }

    //---------- BUSCAA INFORMACION DE UN USUARIO PARA EDITAR---------//
    public function consulta_usuario($codusuario) {
        $sql = "SELECT usuarios.nombreusuario,usuarios.clave,perfiles.nombre as perfil,usuarios.codusuario,usuarios.nombres,usuarios.correo FROM usuarios INNER JOIN perfiles on usuarios.codperfil=perfiles.codperfil WHERE usuarios.codusuario=?";
        $array = $this->db->query($sql, $codusuario);
        return $array->row();
    }

    //-----------------------TRAE LOS DATOS DE UN USUARIO-----------//
    public function c_usr($id) {
        $sql = "select usuarios.nombreusuario,usuarios.clave,usuarios.codusuario,usuarios.nombres,usuarios.correo,usuarios.codperfil,perfiles.nombre,era.razonsocial_era as era from usuarios INNER JOIN perfiles on usuarios.codperfil=perfiles.codperfil inner join era on era.codera=usuarios.codera where codusuario=?";
        $array = $this->db->query($sql, $id);
        return $array->row();
    }

    //-----------------------TRAE LOS DATOS DE USUARIO DE UN RESPECTIVO AVALUADOR-----------//
    public function c_usr_ava($id) {
        $sql = "select 
	usuarios.nombreusuario, 
	usuarios.clave, 
	usuarios.codusuario, 
	usuarios.nombres, 
	usuarios.correo, 
	usuarios.codperfil, 
	perfiles.nombre, 
	era.razonsocial_era as era 
from 
usuarios 
	INNER JOIN perfiles on usuarios.codperfil = perfiles.codperfil 
	inner join era on era.codera = usuarios.codera 
where 
	usuarios.numero_id=?";
        $array = $this->db->query($sql, $id);
        return $array->row();
    }

    //---------ACTUALIZAR UN USUARIO  ------------/ 
    public function upd_usr($cod, $registros) {
        $this->db->where('codusuario', $cod);
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        if ($this->db->update('usuarios', $registros)) {
//          echo "<pre>";
//        var_dump($registros);
//        echo "</pre>";
//        exit();
            $data['userafectado'] = $registros['nombres'];
            $data['fecha'] = mdate($datestring, $time);
            $data['nombreusuario'] = $this->session->userdata("usuario");
            $data['codtipo_transaccion'] = 2;
            $this->db->insert('transacciones_raa', $data);
        }
    }

    //-----------------VERIFICAR QUE SE NO SE REPITAN LOS NOMBRE DE USUARIO-----------//
    public function verificar_usuarios_nom($nombreusuario) {

        $sql = "SELECT * from usuarios where usuarios.nombreusuario='" . $nombreusuario . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            $this->session->set_flashdata('incorrecto', 'Nombre de Usuario ya existe');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    
    //-----------------CREAR UN USUARIO EN EL SISTEMA-----------//
    public function crear_usr($datos) {
        $this->db->insert('usuarios', $datos);
    }


    //----------------LISTAR LAS ERAS REGISTRADAS------------------------//
    public function listar_eras() {
        $sql = "SELECT era.codera,era.razonsocial_era,era.nit_era,era.nombre_representante,tipo_documento.nombre as tipoid_representante,era.numeroid_representante,era.direccion_era,era.telefono_era,era.acto_administrativo,era.fecha_acto,era.fecha_registro_raa,estados.nombre as estado FROM era INNER JOIN estados on era.codestado=estados.codestado INNER JOIN tipo_documento on era.codtipo_documento=tipo_documento.codtipo_documento";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //-----------------VERIFICAR QUE NO HAYA ENVIADO UNA SOLICITUD  PENDIENTE YA DEL AVALUADOR-----------//
    public function verificar_ava_sol($numid) {
        $sql = "SELECT * FROM solicitud_traslado WHERE codestado_solicitudtras=1 AND numero_id=?";
        $query = $this->db->query($sql, $numid);
        if ($query->num_rows() >= 1) {
            $this->session->set_flashdata('incorrecto', 'Ya envio una solicitud de este Avaluador');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //-----------------INSERTAR UNA SOLICITUD DE TRASLADO-----------//
    public function add_soltras($datos,$anterior) {
        if ($this->db->insert('solicitud_traslado', $datos)) {
            $this->session->set_flashdata('correcto', 'Solicitud de traslado enviada.');
        }
        $time = time();
        $datestring = "%Y-%m-%d %h:%i:%s";
        $data['userafectado'] = "Solicitud traslado Avaluador : " . $anterior->nombres . " " . $anterior->apellidos;
        $data['fecha'] = mdate($datestring, $time);
        $data['nombreusuario'] = $this->session->userdata("usuario");
        $data['codtipo_transaccion'] = 1;
        $this->db->insert('transacciones_raa', $data);
     }

    //----------------LISTAR LAS SOLICITUDES DE TRASLADO QUE TIENE LA ERA------------------------//
    public function listar_soltraslados($codera) {
        $sql = "SELECT 
	solicitud_traslado.codsolicitud, 
	solicitud_traslado.fecha, 
	solicitud_traslado.coderasolicitante, 
	solicitud_traslado.coderasolicitada, 
	solicitud_traslado.numero_id, 
    avaluadores.nombres,
    avaluadores.apellidos,
    avaluadores.cedula,
	estado_solicitudtras.nombre as estado 
FROM 
	solicitud_traslado 
	INNER JOIN estado_solicitudtras on solicitud_traslado.codestado_solicitudtras = estado_solicitudtras.codestado_solicitudtras
    INNER JOIN avaluadores on solicitud_traslado.numero_id=avaluadores.numero_id
WHERE 
        solicitud_traslado.codestado_solicitudtras =1
        AND
	solicitud_traslado.coderasolicitada = ?";
        $array = $this->db->query($sql, $codera);
        return $array->result_array();
    }
    
    //----CONTAR LAS SOLICITUDES DE TRASLADOS ---------   
      public function contar_soltraslado($codera){
        $sql="  SELECT 
	count(*) as cantidad 
FROM 
	solicitud_traslado 
   
where  solicitud_traslado.codestado_solicitudtras=1 and solicitud_traslado.coderasolicitada=?";
        $array = $this->db->query($sql,$codera);
        return $array->row();
    }
    
    
    //----------------LISTAR LAS SOLICITUDES ENVIADAS DE TRASLADO QUE TIENE LA ERA------------------------//
    public function listar_solenviadas($codera) {
        $sql = "SELECT 
	solicitud_traslado.codsolicitud, 
	solicitud_traslado.fecha, 
	solicitud_traslado.coderasolicitante, 
	solicitud_traslado.coderasolicitada, 
	solicitud_traslado.numero_id,
        solicitud_traslado.soporte,
    avaluadores.nombres,
    avaluadores.apellidos,
    avaluadores.cedula,
	estado_solicitudtras.nombre as estado 
FROM 
	solicitud_traslado 
	INNER JOIN estado_solicitudtras on solicitud_traslado.codestado_solicitudtras = estado_solicitudtras.codestado_solicitudtras
    INNER JOIN avaluadores on solicitud_traslado.numero_id=avaluadores.numero_id
WHERE solicitud_traslado.coderasolicitante = ?";
        $array = $this->db->query($sql, $codera);
        return $array->result_array();
    }

    //----------------LISTAR TODOS LOS TRASLADOS REALIZADOS------------------------//
    public function traslados_realizados() {
        $sql = "SELECT 
	traslados.codtraslado, 
	traslados.anterior, 
	traslados.nueva, 
	traslados.fecha, 
	avaluadores.nombres, 
	avaluadores.apellidos,
        traslados.soporte, 
	avaluadores.cedula 
from 
	traslados 
	INNER JOIN solicitud_traslado ON traslados.codsolicitud = solicitud_traslado.codsolicitud 
	INNER JOIN avaluadores on solicitud_traslado.numero_id = avaluadores.numero_id";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //----------------LISTAR LAS ERAS REGISTRADAS MENOS LA QUE INICIO------------------------//
    public function listar_eras_sol($codera) {
        $sql = "SELECT *
FROM era
WHERE NOT era.codera=" . $codera;
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //---------------LISTAR UNA SOLICITUD DE TRASLADO ESPECIFICA------------------------//
    public function listar_solic($codsol) {
        $sql = "SELECT 
	solicitud_traslado.codsolicitud, 
	solicitud_traslado.fecha, 
	solicitud_traslado.coderasolicitante, 
	solicitud_traslado.coderasolicitada, 
	solicitud_traslado.numero_id, 
        solicitud_traslado.soporte,
    avaluadores.nombres,
    avaluadores.apellidos,
    avaluadores.cedula,
	estado_solicitudtras.nombre as estado 
FROM 
	solicitud_traslado 
	INNER JOIN estado_solicitudtras on solicitud_traslado.codestado_solicitudtras = estado_solicitudtras.codestado_solicitudtras
    INNER JOIN avaluadores on solicitud_traslado.numero_id=avaluadores.numero_id
            WHERE 
	solicitud_traslado.codsolicitud = ?";
        $array = $this->db->query($sql, $codsol);
        return $array->row();
    }

    //-----------LISTAR INFORMACION DE UNA ERA ---------//

    public function listar_infoera($codera) {
        $sql = "SELECT *
FROM era
WHERE  era.codera=" . $codera;
        $array = $this->db->query($sql);
        return $array->row();
    }

    //---------UPDATE AVALUADOR COD ERA  ------------/ 
    public function upd_traslado($data) {
        $this->db->where('numero_id', $data['solicitud']->numero_id);
        if ($this->db->update('avaluadores', array('codera' => $data['solicitud']->coderasolicitada))) {
            $this->db->where('codsolicitud', $data['solicitud']->codsolicitud);
            $this->db->update('solicitud_traslado', array('codestado_solicitudtras' => '2'));
            return true;
        } else {
            return FALSE;
        }
    }
    
     //---------UPDATE AVALUADOR COD ERA  ------------/ 
    public function rechaz_traslado($data) {
        $this->db->where('codsolicitud', $data['solicitud']->codsolicitud);
        if ($this->db->update('solicitud_traslado', array('codestado_solicitudtras' => '3'))) {
            return true;
        } else {
            return FALSE;
        }
    }

    //---------UPDATE AVALUADOR COD ERA  ------------/ 
    public function insertar_traslado($registros, $codsolicitud,$datas) {
        $fecha = date('Y-m-d');
        $this->db->insert('traslados', array('anterior' => $registros['anterior']->razonsocial_era, 'nueva' => $registros['nueva']->razonsocial_era, 'fecha' => $fecha, 'codsolicitud' => $codsolicitud,'soporte'=>$datas['solicitud']->soporte));
        $time = time();
        $datestring = "%Y-%m-%d %h:%i:%s";
        $data['userafectado'] = "Traslado Avaluador : " . $datas['solicitud']->nombres." ".$datas['solicitud']->apellidos;
        $data['fecha'] = mdate($datestring, $time);
        $data['nombreusuario'] = $this->session->userdata("usuario");
        $data['codtipo_transaccion'] = 1;
        $this->db->insert('transacciones_raa', $data);    
        
        
    }

}
