<?php

class LoginModel extends CI_Model {

    protected $tabla = 'clientes';
    protected $tabla2 = 'clase_vehiculo';
    protected $tabla3 = 'danos';

    public function __construct() {

        parent::__construct();
    }


    
    public function login_user($usuario, $clave) {
        $sql = "select usuarios.codusuario,usuarios.nombreusuario,usuarios.codestado,usuarios.numero_id as numero_id,era.logo,usuarios.clave,usuarios.codera,usuarios.codperfil,usuarios.nombres,usuarios.correo,perfiles.nombre as perfil,era.razonsocial_era FROM usuarios INNER JOIN perfiles on perfiles.codperfil=usuarios.codperfil LEFT JOIN era on era.codera=usuarios.codera where usuarios.nombreusuario='" . $usuario . "' AND usuarios.clave='" . $clave . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 1) {
            return $query->row();
            }
            else {
            $this->session->set_flashdata('incorrecto', 'Los datos introducidos son incorrectos');
//            redirect(base_url() . 'login');
        }
    }
    
    //---- VERIFICAR QUE EXISTA UN USUARIO CON ESE NOMBRE DE USUARIO
    public function nom_usr($usuario) {
        $sql = "select usuarios.codusuario,usuarios.nombreusuario,usuarios.codestado,usuarios.numero_id as numero_id,era.logo,usuarios.clave,usuarios.codera,usuarios.codperfil,usuarios.nombres,usuarios.correo,perfiles.nombre as perfil,era.razonsocial_era FROM usuarios INNER JOIN perfiles on perfiles.codperfil=usuarios.codperfil LEFT JOIN era on era.codera=usuarios.codera where usuarios.nombreusuario='" . $usuario."'";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->row();
            }
            else {
                return false;
        }
    }
    
        //-------- ----ACTUALIZAR El ESTADO DE UN USUARIO---------------//
    public function update_usr_estado($cod) {
        $this->db->where('codusuario', $cod);
        $this->db->update('usuarios', array('codestado'=>3));
    }
    
    
    //-------- ----VERIFICA QUE ESTE EN USERLOG---------------//
    public function userlogv($cod) {
        $this->db->where('codusuario',$cod);
         $query = $this->db->get('userlog');
         if($query->num_rows()==1){
             return $query->row();
         }else{
             return false;
         }
//        echo '<pre>';
//        echo var_dump($data);
//        echo '</pre>';
//        exit();
        
    }
    
    
     //-----------------CONTAR LAS SOLICITUDES DE LA ERA QUE INICIA-------------//
    public function c_intentos($codava) {
        $sql = "SELECT COUNT(*)as cantidad FROM intentos WHERE intentos.codusuario=?";
        $array = $this->db->query($sql, $codava);
        return $array->row();
    }

    
    
//-------- -----INSERTAR UN INTENTO FALLIDO DE LOGIN---------------//
    public function insertar_intento($datos) {
        $this->db->insert('intentos', $datos);
    }
    
//-------- ----ELIMINAR INTENTOS FALLIDOS DE UN USUARIO---------------//
    public function eliminar_intentos($cod) {
       $this->db->where('codusuario', $cod);
             $this->db->delete('intentos');
    }
    
    
    
//-------- -----INSERTAR EN USER_LOG---------------//
    public function insert_userlog($datos) {
        $this->db->insert('userlog', $datos);
    }
    
    
        //-------- ----ACTUALIZAR EN USER_LOG---------------//
    public function update_userlog($cod,$datos) {
        $this->db->where('coduserlog', $cod);
       $this->db->update('userlog', $datos);
    }


    
    
    
    
   

}
