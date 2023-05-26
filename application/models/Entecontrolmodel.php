<?php

class EntecontrolModel extends CI_Model {

   

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
}
