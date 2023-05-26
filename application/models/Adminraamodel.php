<?php

class AdminraaModel extends CI_Model {

    protected $tabla = 'era';

    //========================FUNCIONES BASE DE DATOS ERA======================//

    public function listar_era() {
        $sql = "SELECT era.codera,era.razonsocial_era,era.nit_era,era.nombre_representante,tipo_documento.nombre as tipoid_representante,era.numeroid_representante,era.direccion_era,era.telefono_era,era.acto_administrativo,era.fecha_acto,era.fecha_registro_raa,estados.nombre as estado FROM era INNER JOIN estados on era.codestado=estados.codestado INNER JOIN tipo_documento on era.codtipo_documento=tipo_documento.codtipo_documento";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //---------------BUSCA UNA ERA SEGUN EL NOMBRE ----------------//
    public function c_era_nombre($nombre) {
        $sql = "SELECT 
	era.codera, 
	era.razonsocial_era, 
	era.nit_era, 
	era.nombre_representante, 
	tipo_documento.nombre as tipoid_representante, 
	era.numeroid_representante, 
	era.direccion_era, 
	era.telefono_era, 
	era.acto_administrativo, 
	era.fecha_acto, 
	era.fecha_registro_raa, 
	estados.nombre as estado 
FROM 
	era 
	INNER JOIN estados on era.codestado = estados.codestado 
	INNER JOIN tipo_documento on era.codtipo_documento = tipo_documento.codtipo_documento
        where
    era.razonsocial_era like '%" . $nombre . "%' ";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

//--------------- CONSULTA UNA ERA SEGUN EL ID ----------------//
    public function consulta_era($id) {
        $sql = "SELECT era.codera,era.razonsocial_era,era.codestado,era.logo,era.codtipo_documento,era.nit_era,era.nombre_representante,tipo_documento.nombre as tipoid_representante,era.codtipo_documento,era.numeroid_representante,era.direccion_era,era.telefono_era,era.acto_administrativo,era.fecha_acto,era.fecha_registro_raa,estados.nombre as estado FROM era INNER JOIN estados on era.codestado=estados.codestado INNER JOIN tipo_documento on era.codtipo_documento=tipo_documento.codtipo_documento where era.codera=" . $id;
//        $this->db->where('codera',$id);
        $registros = $this->db->query($sql);
        return $registros->row();
    }

    //--------------- CONSULTA LOS USUARIOS DE UNA ERA----------------//
    public function consulta_era_usuarios($id) {
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
	usuarios.codera =?";
        $array = $this->db->query($sql, $id);
        return $array->result_array();
    }

    //-CONSULTAR DATOS DE UN USUARIO---//
    public function c_usr($id) {
        $sql = "select 
	usuarios.nombreusuario, 
	usuarios.codusuario, 
	usuarios.codera, 
	usuarios.clave, 
	usuarios.nombres, 
	usuarios.correo, 
	usuarios.codperfil, 
	perfiles.nombre,
        usuarios.codestado,
        estado_usuarios.nombre as estado,
	era.razonsocial_era as era 
from 
	usuarios 
	INNER JOIN perfiles on usuarios.codperfil = perfiles.codperfil 
        INNER JOIN estado_usuarios on usuarios.codestado=estado_usuarios.codestado_usuarios
	left join era on era.codera = usuarios.codera 
where 
	codusuario =?";
        $array = $this->db->query($sql, $id);
        return $array->row();
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
    
          
    
     //----------LISTA USUARIOS POR NOBRE--------//
    public function c_usr_nombre($nombre) {
        $sql = "SELECT 
	usuarios.nombreusuario, 
	perfiles.nombre as perfil, 
	usuarios.codusuario, 
	usuarios.nombres, 
	usuarios.correo,
        estado_usuarios.nombre as estado,
        era.razonsocial_era as era 
FROM 
	usuarios 
	INNER JOIN perfiles on usuarios.codperfil = perfiles.codperfil 
        INNER JOIN estado_usuarios on usuarios.codestado=estado_usuarios.codestado_usuarios
        LEFT JOIN era on era.codera = usuarios.codera
        where not usuarios.codperfil = 1 
        AND usuarios.nombres like '%" . $nombre . "%'";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    
    
	
    
    //-----------LISTA LOS ESTADOS ---------//
    public function listar_estados() {
        $registros = $this->db->get('estados');
        return $registros->result_array();
    }
    //-----------LISTA LOS ESTADOS DE USUARIOS---------//
    public function listar_estados_usr() {
        $registros = $this->db->get('estado_usuarios');
        return $registros->result_array();
    }

//-----------LISTA TIPOS DE DOCUMENTO ---------//
    public function listar_tipodocumento() {
        $registros = $this->db->get('tipo_documento');
        return $registros->result_array();
    }

    //-----------LISTA TIPOS DE DOCUMENTO ---------//
    public function listar_tiposan() {
        $sql="SELECT 
	tipo_sancion.codtipo_sancion, 
	tipo_sancion.nombre, 
	tipo_sancion.codestado_tiposancion, 
	estado_tiposancion.nombre as estado
from 
	tipo_sancion 
	INNER JOIN estado_tiposancion on tipo_sancion.codestado_tiposancion = estado_tiposancion.codestado_tiposancion";
        $registros = $this->db->query($sql);
        return $registros->result_array();
    }

    //-----------LISTA ESTADO SOLICITUD---------//
    public function listar_estadosol() {
        $registros = $this->db->get('estado_solicitud');
        return $registros->result_array();
    }
    //-----------LISTAR TABLA AVALUADORES---------//
    public function listar_tavaluadores() {
        $registros = $this->db->get('avaluadores');
        return $registros->result_array();
    }

    //-----------LISTA ESTADO SOLICITUD---------//
    public function listar_tipotransa() {
        $registros = $this->db->get('tipo_transaccion');
        return $registros->result_array();
    }

    //-----------LISTA UN ESTADO ESPECIFICO---------//
    public function consultar_estado($cod) {
        $this->db->where('codestado', $cod);
        $registros = $this->db->get('estados');
        return $registros->row();
    }

    //---------ACTUALIZAR Un ESTADO  ------------/ 
    public function update_estado($cod, $registros) {
        $this->db->where('codestado', $cod);
        $this->db->update('estados', $registros);
    }

    //-----------LISTA UN TIPO DOC ESPECIFICO---------//
    public function consultar_tipodoc($cod) {
        $this->db->where('codtipo_documento', $cod);
        $registros = $this->db->get('tipo_documento');
        return $registros->row();
    }

    //---------ACTUALIZAR UN TIPO DE DOC  ------------/ 
    public function update_tipodoc($cod, $registros) {
        $this->db->where('codtipo_documento', $cod);
        $this->db->update('tipo_documento', $registros);
    }

    //-----------LISTA UN TIPO SANCION ESPECIFICO---------//
    public function consultar_tiposan($cod) {
        $sql="SELECT 
	tipo_sancion.codtipo_sancion, 
	tipo_sancion.nombre, 
	tipo_sancion.codestado_tiposancion, 
	estado_tiposancion.nombre as estado
from 
	tipo_sancion 
	INNER JOIN estado_tiposancion on tipo_sancion.codestado_tiposancion = estado_tiposancion.codestado_tiposancion
        where tipo_sancion.codtipo_sancion=".$cod;
        $registros = $this->db->query($sql);
        return $registros->row();
    }

    
     //-----------LISTA UN ESTADO ESPECIFICO---------//
    public function consultar_estadotiposan() {
        $registros = $this->db->get('estado_tiposancion');
        return $registros->result_array();
    }
  
    //----------ACTUALIZA UNA CATECORIA ---------//
     public function update_tiposan($cod,$registros){
        $this->db->where('tipo_sancion.codtipo_sancion',$cod);
        if( $this->db->update('tipo_sancion',$registros)){
        $time = time();
        $datestring = "%Y-%m-%d %h:%i:%s";
        $data['userafectado'] = "Actualizo tipo sancion : " . $registros['nombre'];
        $data['fecha'] = mdate($datestring, $time);
        $data['nombreusuario'] = $this->session->userdata("usuario");
        $data['codtipo_transaccion'] = 2;
        $this->db->insert('transacciones_raa', $data);  
     }}
    
    //-----------LISTA UN ESTADO DE SOLICITUD ESPECIFICO---------//
    public function consultar_estadosol($cod) {
        $this->db->where('codestado_solicitud', $cod);
        $registros = $this->db->get('estado_solicitud');
        return $registros->row();
    }

    //---------ACTUALIZAR UN TIPO DE SANCION ------------/ 
    public function update_estadosol($cod, $registros) {
        $this->db->where('codestado_solicitud', $cod);
        $this->db->update('estado_solicitud', $registros);
    }

    //-----------LISTA UN TIOPO TRANSACCION ESPECIFICO---------//
    public function consultar_tipotrans($cod) {
        $this->db->where('codtipo_transaccion', $cod);
        $registros = $this->db->get('tipo_transaccion');
        return $registros->row();
    }

    //---------ACTUALIZAR UN TIPO DE SANCION ------------/ 
    public function update_tipotrans($cod, $registros) {
        $this->db->where('codtipo_transaccion', $cod);
        $this->db->update('tipo_transaccion', $registros);
    }

    //-----------LISTA LOS PERFILES ---------//
    public function listar_perfiles() {
        $sql="SELECT * FROM perfiles WHERE NOT perfiles.codperfil=1";
        
        $registros = $this->db->query($sql);
        return $registros->result_array();
    }

    public function crear_era($registros) {
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        if ($this->db->insert('era', $registros)) {
            $codera = $this->db->insert_id();
            $datas['nombreusuario'] = $registros['numeroid_representante'];
            $datas['clave'] = md5($registros['numeroid_representante']);
            $datas['codera'] = $codera;
            $datas['codperfil'] = 2;
            $datas['nombres'] = $registros['nombre_representante'];
            $datas['correo'] = $registros['correo'];
            $datas['codestado'] = 1;
            $this->db->insert('usuarios', $datas);
            $this->session->set_flashdata('correcto', 'ERA Registrada');
            $data['userafectado'] = "ERA : " . $registros['razonsocial_era'];
            $data['fecha'] = mdate($datestring, $time);
            $data['nombreusuario'] = $this->session->userdata("usuario");
            $data['codtipo_transaccion'] = 1;
            $this->db->insert('transacciones_raa', $data);
        }
    }

    //------------CREAR UN USUARIO DE UNA ERA  --------------//

    public function crear_usr($registros) {
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        if ($this->db->insert('usuarios', $registros)) {
            $data['userafectado'] = "Usuario: " . $registros['nombres'];
            $data['fecha'] = mdate($datestring, $time);
            $data['nombreusuario'] = $this->session->userdata("usuario");
            $data['codtipo_transaccion'] = 1;
            $this->db->insert('transacciones_raa', $data);
        }
    }

    //--------------CREAR UNA CATEGORIA EN EL SISTEMA ----------//
    public function crear_cat($registros) {
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        if ($this->db->insert('categoria_avaluador', $registros)) {
            $data['userafectado'] = "Categoria: " . $registros['nombre'];
            $data['fecha'] = mdate($datestring, $time);
            $data['nombreusuario'] = $this->session->userdata("usuario");
            $data['codtipo_transaccion'] = 1;
            $this->db->insert('transacciones_raa', $data);
        }
    }

    //----------------ACTUALIZA UN ERA -----------------------//
    public function upd_era($cod, $registros) {
        $this->db->where('codera', $cod);
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        if ($this->db->update('era', $registros)) {
            $data['userafectado'] = "ERA : " . $registros['razonsocial_era'];
            $data['fecha'] = mdate($datestring, $time);
            $data['nombreusuario'] = $this->session->userdata("usuario");
            $data['codtipo_transaccion'] = 2;
            $this->db->insert('transacciones_raa', $data);
        }
    }

    //---------ACTUALIZAR UN USUARIO  ------------/ 
    public function upd_usr($cod, $registros) {
        if($registros['codestado']==1){
             $this->db->where('codusuario', $cod);
             $this->db->delete('intentos');
        }
        $this->db->where('codusuario', $cod);
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        if ($this->db->update('usuarios', $registros)) {
            $data['userafectado'] = "Usuario : " . $registros['nombres'];
            $data['fecha'] = mdate($datestring, $time);
            $data['nombreusuario'] = $this->session->userdata("usuario");
            $data['codtipo_transaccion'] = 2;
            $this->db->insert('transacciones_raa', $data);
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

//    //---------REVISAR IMPLEMENTACION ------------/ 
//
//    public function upd_usr2($codperf, $codusr, $registros) {
//        $datestring = "%Y-%m-%d %h:%i:%s";
//        $time = time();
//        $this->db->where('codperfil', $codperf);
//        $this->db->where('codusuario', $codusr);
//        if ($this->db->update('usuarios', $registros)) {
//            echo "<pre>";
//            var_dump($registros);
//            echo "</pre>";
//            exit();
//
//            $data['userafectado'] = "ERA : " . $registros['nombres'];
//            $data['fecha'] = mdate($datestring, $time);
//            $data['codusuario'] = $this->session->userdata("codusuario");
//            $data['codtipo_transaccion'] = 2;
//            $this->db->insert('transacciones_raa', $data);
//        }
//    }

    //-------- ------ELIMINAR UNA ERA----------------//
    public function delete_era($id) {
        $sql1="SELECT usuarios.codusuario FROM `era` INNER JOIN usuarios on era.codera=usuarios.codera WHERE era.codera=".$id;
        $query1 = $this->db->query($sql1);
        $sql2="SELECT avaluadores.numero_id FROM `era` INNER JOIN avaluadores on era.codera=avaluadores.codera WHERE era.codera=".$id;
        $query2 = $this->db->query($sql2);
         $sql3="SELECT comite_aprobacion.fecha FROM `era` INNER JOIN comite_aprobacion on era.codera=comite_aprobacion.codera WHERE era.codera=".$id;
        $query3 = $this->db->query($sql3);
        if ($query1->num_rows() >= 1) {
            $this->session->set_flashdata('incorrecto', 'No se puede elininar la Entidad por que tiene Usuarios ASOCIADOS');
             redirect('adminraa/era');
            }
            else if($query2->num_rows() >= 1) {
            $this->session->set_flashdata('incorrecto', 'No se puede elininar la Entidad por que tiene Avaluadores ASOCIADOS');
            redirect('adminraa/era');
        }
        else if($query3->num_rows() >= 1) {
            $this->session->set_flashdata('incorrecto', 'No se puede elininar la Entidad por que tiene Comites ASOCIADOS');
            redirect('adminraa/era');
        }
         $this->db->where('codera', $id);
        if($this->db->delete($this->tabla)){
            $this->session->set_flashdata('correcto', 'Era eliminada correctamente');
        }
        else {
            $this->session->set_flashdata('incorrecto', 'No se puede eliminar la Entidad , debido a que tiene usuarios activos');
        }
    }

    //-----------ELIMINAR UN USUARIO-------------------//
    public function delete_usr($registros) {
        $datestring = "%Y-%m-%d %h:%i:%s";
        $time = time();
        $this->db->where('codusuario', $registros['usuarios']->codusuario);
        if ($this->db->delete('usuarios')) {
            $this->session->set_flashdata('correcto', 'Usuario Eliminado');
            $data['userafectado'] = "Usuario : " . $registros['usuarios']->nombreusuario;
            $data['fecha'] = mdate($datestring, $time);
            $data['nombreusuario'] = $this->session->userdata("usuario");
            $data['codtipo_transaccion'] = 3;
            $this->db->insert('transacciones_raa', $data);
        } else {
            $this->session->set_flashdata('incorrecto', 'No es posible Eliminar el Usuario');
        }
    }

    //-----------------CONTAR LOS AVALUADORES-------------//
    public function contar_avaluadores() {
        $sql = "SELECT count(*)as cantidad FROM avaluadores";
        $array = $this->db->query($sql);
        return $array->row();
    }

    //-----------------CONTAR LOS USUARIOS-------------//
    public function contar_usuarios() {
        $sql = "SELECT count(*)as cantidad FROM usuarios";
        $array = $this->db->query($sql);
        return $array->row();
    }

    //-----------------CONTAR LAS ERAS-------------//
    public function contar_era() {
        $sql = "SELECT count(*)as cantidad FROM era";
        $array = $this->db->query($sql);
        return $array->row();
    }

    //-----------------MOSTRAR TODOS LOS USUARIOS-------------//
    public function consulta_usuarios() {
        $sql = "SELECT 
	usuarios.nombreusuario, 
	perfiles.nombre as perfil, 
	usuarios.codusuario, 
	usuarios.nombres, 
	usuarios.correo, 
	usuarios.clave,
        estado_usuarios.nombre as estado,
	era.razonsocial_era as era 
FROM 
	usuarios 
	INNER JOIN perfiles on usuarios.codperfil = perfiles.codperfil 
        INNER JOIN estado_usuarios on usuarios.codestado=estado_usuarios.codestado_usuarios
	LEFT JOIN era on era.codera = usuarios.codera
        where not usuarios.codperfil=1";
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    
     //---------- BUSCAA INFORMACION DE UN USUARIO PARA EDITAR---------//
    public function consulta_usuario($codusuario) {
        $sql = "SELECT usuarios.nombreusuario,usuarios.clave,perfiles.nombre as perfil,usuarios.codusuario,usuarios.nombres,usuarios.correo FROM usuarios INNER JOIN perfiles on usuarios.codperfil=perfiles.codperfil WHERE usuarios.codusuario=?";
        $array = $this->db->query($sql, $codusuario);
        return $array->row();
    }

    //-----------------VERIFICAR QUE SOLO HAYA UN ADMIN ERA Y NO SEA ADMINRAA------------//
    public function verificar_usuarios($codperfil, $codera) {
        $sql = "SELECT * from usuarios where usuarios.codperfil=" . $codperfil . " and usuarios.codera=" . $codera;
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            $this->session->set_flashdata('incorrecto', 'La Era ya tiene Administrador');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //-----------------VERIFICAR QUE SOLO HAYA UN ADMIN ERA -----------//
    public function verificar_usuarios_era($codera) {
        $sql = "SELECT * from usuarios where usuarios.codperfil=2 and usuarios.codera=" . $codera;
        $query = $this->db->query($sql);
        if ($query->num_rows() == 1) {
            $this->session->set_flashdata('incorrecto', 'La Era ya tiene Administrador');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //-----------------VERIFICAR QUE VA ACTUALIZAR EL ADMINRRAA------------//
    public function verificar_adminraa($codperfil, $codera, $nombreusuario) {
        $sql = "SELECT * from usuarios where usuarios.codperfil=" . $codperfil . " and usuarios.codera=" . $codera . " and usuarios.nombreusuario='" . $nombreusuario . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    //-----------------VERIFICAR QUE S NO SE REPITAN LOS NOMBRE DE USUARIO-----------//
    public function verificar_usuarios_nom($nombreusuario) {
        $sql = "SELECT * from usuarios where usuarios.nombreusuario='" . $nombreusuario . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            $this->session->set_flashdata('incorrecto', 'Nombre de Usuario Ya existe');
            return true;
        } else {
            return FALSE;
        }
    }

    //----------------LISTAR LAS TRANSACCIONES REALIZADAS-----------//
    public function listar_transacciones() {
        $sql = "SELECT 
	transacciones_raa.codtransaccion, 
	transacciones_raa.userafectado as afectado, 
	transacciones_raa.fecha, 
	transacciones_raa.nombreusuario, 
	tipo_transaccion.nombre as tipo 
from 
	transacciones_raa 
	INNER JOIN tipo_transaccion on tipo_transaccion.codtipo_transaccion = transacciones_raa.codtipo_transaccion
        ORDER BY transacciones_raa.fecha DESC ";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //---------LISTAR TODAS LAS SANCIONES O--------//
    public function listar_sanciones() {
        $sql = "SELECT sanciones.codsancion,sanciones.descripcion,sanciones.fecharegistro,sanciones.soporte,tipo_sancion.nombre as tipo, avaluadores.numero_id,avaluadores.nombres,avaluadores.apellidos,sanciones.fechafin FROM sanciones INNER JOIN avaluadores on sanciones.numero_id=avaluadores.numero_id INNER JOIN tipo_sancion on tipo_sancion.codtipo_sancion=sanciones.codtipo_sancion";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //----------------LISTAR LAS TRANSACCIONES REALIZADAS-----------//
    public function listar_transacciones_nom($nombre) {
        $sql = "SELECT 
	transacciones_raa.codtransaccion, 
	transacciones_raa.userafectado as afectado, 
	transacciones_raa.fecha, 
	transacciones_raa.nombreusuario, 
	tipo_transaccion.nombre as tipo 
from 
	transacciones_raa 
	INNER JOIN tipo_transaccion on tipo_transaccion.codtipo_transaccion = transacciones_raa.codtipo_transaccion 
WHERE 
	transacciones_raa.nombreusuario  like '%" . $nombre . "%' ORDER BY transacciones_raa.fecha DESC";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //----------------LISTAR LAS TRANSACCIONES REALIZADAS POR FECHA-----------//
    public function listar_transacciones_fecha($fecha) {
        $sql = "SELECT 
	transacciones_raa.codtransaccion, 
	transacciones_raa.userafectado as afectado, 
	transacciones_raa.fecha, 
	transacciones_raa.nombreusuario, 
	tipo_transaccion.nombre as tipo 
from 
	transacciones_raa 
	INNER JOIN tipo_transaccion on tipo_transaccion.codtipo_transaccion = transacciones_raa.codtipo_transaccion 
WHERE 
	transacciones_raa.fecha  like '%" . $fecha . "%' ORDER BY transacciones_raa.fecha DESC";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //---------LISTAR  TIPO TRANSACCION--------//
    public function listar_tipotrans() {
        $sql = "select * from tipo_transaccion";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

    //----------------LISTAR LAS TRANSACCIONES REALIZADAS POR FECHA-----------//
    public function listar_transacciones_tipo($codtipo) {
        $sql = "SELECT 
	transacciones_raa.codtransaccion, 
	transacciones_raa.userafectado as afectado, 
	transacciones_raa.fecha, 
	transacciones_raa.nombreusuario, 
	tipo_transaccion.nombre as tipo 
from 
	transacciones_raa 
	INNER JOIN tipo_transaccion on tipo_transaccion.codtipo_transaccion = transacciones_raa.codtipo_transaccion 
WHERE 
	transacciones_raa.codtipo_transaccion=" . $codtipo . " ORDER BY transacciones_raa.fecha DESC";
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    //----------------LISTAR LAS TRANSACCIONES REALIZADAS POR PERIODO DE FECHAS-----------//
    public function listar_transacciones_pfecha($fecha1,$fecha2) {
        $sql = "SELECT 
	transacciones_raa.codtransaccion, 
	transacciones_raa.userafectado as afectado, 
	transacciones_raa.fecha, 
	transacciones_raa.nombreusuario, 
	tipo_transaccion.nombre as tipo 
from 
	transacciones_raa 
	INNER JOIN tipo_transaccion on tipo_transaccion.codtipo_transaccion = transacciones_raa.codtipo_transaccion 
WHERE  
	transacciones_raa.fecha BETWEEN '".$fecha1."' and '".$fecha2."' ORDER BY transacciones_raa.fecha DESC";
        $array = $this->db->query($sql);
        return $array->result_array();
    }

}
