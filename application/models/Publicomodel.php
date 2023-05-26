<?php

class PublicoModel extends CI_Model {

    protected $tabla = 'usuarios';
 
    
    //---------VERIFICA SI EXISTEN LOS USUARIOS ---------//
       public function verificar($usuario,$correo) {
          $this->db->where('nombreusuario', $usuario);
          $this->db->where('correo', $correo);
          $query = $this->db->get($this->tabla);
        
        if ($query->num_rows() == 1) {
           
//            $this->session->set_flashdata('incorrecto', 'Ya agrego el avaluador a la lista');
            return $query->row();
           
        } else {
             return false;
        } }
        
         //-----------ACTUALIZAR CONTRASEÑA  ---------//
    public function actualizar_pass($cod, $registros) {
        $this->db->where('codusuario', $cod);
         $this->db->update('usuarios',$registros);
         }
         
         public function consulta_certificado($pin) {
             $sql="SELECT 
	certificados.codcertificado, 
	certificados.pin, 
	certificados.fechagenerado, 
	certificados.fechavencimiento, 
	avaluadores.nombres, 
	avaluadores.apellidos, 
	avaluadores.cedula, 
        avaluadores.codigoavaluador,
	avaluadores.correo, 
	estados.nombre as estado,
    era.razonsocial_era as era
FROM 
	certificados 
	INNER JOIN avaluadores on certificados.numero_id = avaluadores.numero_id 
	INNER JOIN estados on avaluadores.codestado = estados.codestado 
    INNER JOIN era on avaluadores.codera=era.codera
WHERE 
	certificados.pin = '".$pin."'";
        $array=$this->db->query($sql);
         return $array->row();
         }    
       
        
    
}
