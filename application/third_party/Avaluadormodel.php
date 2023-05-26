<?php

class AvaluadorModel extends CI_Model {

    protected $tabla = 'avaluadores';
    
   //-----------LISTA TODOS LOS AVALUADORES ---------//
      public function ver_avaluadores() {
        $sql = "SELECT avaluadores.numero_id,avaluadores.cedula,avaluadores.codigoavaluador,avaluadores.foto,avaluadores.nombres,avaluadores.apellidos,avaluadores.lugar_nac,tipo_documento.nombre,avaluadores.numero_id,avaluadores.fechaex_id,avaluadores.domicilio,avaluadores.telefono,avaluadores.celular,avaluadores.correo,avaluadores.regimen_inscripcion,avaluadores.soporte,avaluadores.fechainscripcion,estados.nombre as estado, categoria_avaluador.nombre,era.razonsocial_era as era,avaluadores.codera FROM avaluadores INNER JOIN estados on estados.codestado=avaluadores.codestado INNER JOIN categoria_avaluador on categoria_avaluador.codcategoria_avaluador=avaluadores.codcategoria_avaluador INNER JOIN era on era.codera=avaluadores.codera INNER JOIN tipo_documento on tipo_documento.codtipo_documento=avaluadores.codtipo_documento";
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    
//-----------LISTA UN AVALUADOR ESPECIFICO ---------//
      public function c_avaluador($id) {
        $sql = "SELECT avaluadores.numero_id,avaluadores.foto,avaluadores.codigoavaluador,avaluadores.nombres,avaluadores.apellidos,avaluadores.lugar_nac,tipo_documento.nombre as tipodocumento,avaluadores.numero_id,avaluadores.fechaex_id,avaluadores.domicilio,avaluadores.telefono,avaluadores.celular,avaluadores.correo,avaluadores.regimen_inscripcion,avaluadores.soporte,avaluadores.fechainscripcion,estados.nombre as estado, categoria_avaluador.nombre as categoria,era.razonsocial_era as era,avaluadores.codera FROM avaluadores INNER JOIN estados on estados.codestado=avaluadores.codestado INNER JOIN categoria_avaluador on categoria_avaluador.codcategoria_avaluador=avaluadores.codcategoria_avaluador INNER JOIN era on era.codera=avaluadores.codera INNER JOIN tipo_documento on tipo_documento.codtipo_documento=avaluadores.codtipo_documento WHERE avaluadores.numero_id=?";
        $array = $this->db->query($sql,$id);
        return $array->row();
    }
   //-----------LISTA TODOS LAS CATEGORIAS ---------//
      public function ver_categorias() {
        $sql = "select categoria_avaluador.codcategoria_avaluador, categoria_avaluador.nombre, estados.nombre as estado FROM categoria_avaluador INNER JOIN estados on  estados.codestado=categoria_avaluador.codestado";
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    
     //----------CONSULTA UNA CATEGORIA ---------//
    public function consultar_cat($id) {
        $sql = "select categoria_avaluador.codcategoria_avaluador, categoria_avaluador.nombre, estados.nombre as estado FROM categoria_avaluador INNER JOIN estados on  estados.codestado=categoria_avaluador.codestado where categoria_avaluador.codcategoria_avaluador=?";
        $array = $this->db->query($sql,$id);
        return $array->row();
    }
    
  //----------ACTUALIZA UNA CATECORIA ---------//
     public function upd_cat($cod,$registros){
        $this->db->where('codcategoria_avaluador',$cod);
        return $this->db->update('categoria_avaluador',$registros);
    }
    
    //---------ELIMINA UNA CATECORIA ---------//
  public function delete_cat($id){
        $this->db->where('codcategoria_avaluador',$id);
        return $this->db->delete('categoria_avaluador');
    }
    
    //-----------LISTA UN AVALUADOR ESPECIFICO POR ESTADO ---------//
      public function c_avaluador_estado($id) {
        $sql = "SELECT avaluadores.numero_id,avaluadores.foto,avaluadores.codigoavaluador,avaluadores.cedula,avaluadores.nombres,avaluadores.apellidos,avaluadores.lugar_nac,tipo_documento.nombre as tipodocumento,avaluadores.numero_id,avaluadores.fechaex_id,avaluadores.domicilio,avaluadores.telefono,avaluadores.celular,avaluadores.correo,avaluadores.regimen_inscripcion,avaluadores.soporte,avaluadores.fechainscripcion,estados.nombre as estado, categoria_avaluador.nombre as categoria,era.razonsocial_era as era,avaluadores.codera FROM avaluadores INNER JOIN estados on estados.codestado=avaluadores.codestado INNER JOIN categoria_avaluador on categoria_avaluador.codcategoria_avaluador=avaluadores.codcategoria_avaluador INNER JOIN era on era.codera=avaluadores.codera INNER JOIN tipo_documento on tipo_documento.codtipo_documento=avaluadores.codtipo_documento WHERE avaluadores.codestado=?";
        $array = $this->db->query($sql,$id);
        return $array->result_array();
    }
    
    //---------BUSCAR POR NOMBRE ---------//
    public function c_avaluador_nombre($nombre) {
        $sql = "SELECT avaluadores.numero_id,avaluadores.codigoavaluador,avaluadores.cedula,avaluadores.foto,avaluadores.nombres,avaluadores.apellidos,avaluadores.lugar_nac,tipo_documento.nombre as tipodocumento,avaluadores.numero_id,avaluadores.fechaex_id,avaluadores.domicilio,avaluadores.telefono,avaluadores.celular,avaluadores.correo,avaluadores.regimen_inscripcion,avaluadores.soporte,avaluadores.fechainscripcion,estados.nombre as estado, categoria_avaluador.nombre as categoria,era.razonsocial_era as era,avaluadores.codera FROM avaluadores INNER JOIN estados on estados.codestado=avaluadores.codestado INNER JOIN categoria_avaluador on categoria_avaluador.codcategoria_avaluador=avaluadores.codcategoria_avaluador INNER JOIN era on era.codera=avaluadores.codera INNER JOIN tipo_documento on tipo_documento.codtipo_documento=avaluadores.codtipo_documento WHERE avaluadores.nombres like '%" . $nombre ."%'";
        $array = $this->db->query($sql);
        return $array->result_array();
    }
    
     
     public function eliminar($id) {
        $this->db->where('idavaluador', $id);
        return $this->db->delete($this->tabla);
    }
    
    
     public function delete($id) {
        $this->db->where('idavaluador', $id);
        return $this->db->delete('avaluador');
    }

}
