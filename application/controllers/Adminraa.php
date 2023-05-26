<?php

Class Adminraa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model('adminraamodel', 'modelo');
        $this->load->model('admineramodel', 'modeloera');
        $this->load->model('avaluadormodel', 'modeloavaluador');
        $this->load->library('codificar');
        $this->load->library('cifrar');
    }
    
// =============== FUNCION CARGAR LA VISTA DE INICIO DEL MODULO ADMINRAA  =======================================//
    public function index() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $data['eras'] = $this->modelo->listar_era();
        $data['era'] = $this->modelo->contar_era();
        $data['avaluadores'] = $this->modelo->contar_avaluadores();
        $data['usuarios'] = $this->modelo->contar_usuarios();
        $data['titulo'] = 'Administrador';
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/index');
        $this->load->view('plantilla/footer');
    }

// =================================ADMINISTRACION DE FUNCIONES ERA ========================================//
// 
    //-- ----------SE ENCARGA DE TRAER TODAS LAS ENTIDADES. -----------//
    public function era() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $data['eras'] = $this->modelo->listar_era();
        $data['titulo'] = "Listado de ERA";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/listar_era', $data);
        $this->load->view('plantilla/footer');
    }

    //-----------------  BUSCAR  ERA POR NOMBRE -----------------------------/// 
    public function bus_era_nombre() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $nombre = $this->input->post('nombre');
        $data['eras'] = $this->modelo->c_era_nombre($nombre);
        $data['titulo'] = "Listado de ERA";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/listar_era', $data);
        $this->load->view('plantilla/footer');
    }
   //-----------------VISTA PARA REGISTRAR UNA NUEVA ENTIDAD-----------------------------/// 
    public function nueva_era() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Nueva Entidad";
        $data['estados'] = $this->modelo->listar_estados();
        $data['tipodoc'] = $this->modelo->listar_tipodocumento();
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/nueva_era');
        $this->load->view('plantilla/footer');
    }
   //----------------METODO PARA REGISTRAR UNA NUEVA ERA EN EL SISTEMA----------------------------/// 
    public function add_era() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $this->form_validation->set_rules('razonsocial_era', 'nombres', 'required|min_length[3]');
        $this->form_validation->set_message('required', '*Debe ingresar %s  para continuar');
        $this->form_validation->set_message('min_length', '*El campo %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length', 'El campo %s no puede tener más de %s carácteres');
        if ($this->form_validation->run() == TRUE) {
     
        $this->load->library('upload');
        $nomfoto = $_FILES['logo']['name'];

        if (empty($nomfoto)) {
            $registros = $this->input->post();
            $this->modelo->crear_era($registros);
            redirect('adminraa/era');
        } else {
            $config['upload_path'] = './uploads/imagenes/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '300';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('logo')) {
                $data = array('error' => $this->upload->display_errors());
                $data['titulo'] = "Nueva Entidad";
                $data['estados'] = $this->modelo->listar_estados();
                $data['tipodoc'] = $this->modelo->listar_tipodocumento();
                $this->load->view('plantilla/headeradmin', $data);
                $this->load->view('adminraa/era/nueva_era');
                $this->load->view('plantilla/footer');
            } else {
                $infoto = $this->upload->data();
                $registros = $this->input->post();
                $registros['logo'] = $infoto['file_name'];
                $this->modelo->crear_era($registros);
                $this->session->set_flashdata('correcto', 'ERA Creada');
                redirect('adminraa/era');
            }
        }
        }else {
            
            $this->nueva_era();
        }
    }

//------------ OBTIENE EL CODIGO DE UNA ERA PARA VER EL DETALLE--------- /

    public function obtener_detalle() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $datos['registro'] = $this->modelo->consulta_era($id);
        $data['titulo'] = "Ver detalles de entidad";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/detalle_era', $datos);
        $this->load->view('plantilla/footer');
    }

    //------------ OBTIENE EL CODIGO DE UNA ERA PARA EDITAR--------- /
    public function obtener_editar() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codent', $id);
        $datos['registro'] = $this->modelo->consulta_era($id);
        $data['titulo'] = "Ver detalles de entidad";
        $data['estados'] = $this->modelo->listar_estados();
        $data['tipodoc'] = $this->modelo->listar_tipodocumento();
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/editar_era', $datos);
        $this->load->view('plantilla/footer');
    }

    //---------------ACTUALZAR UNA ERA-----------------------//
    public function update_era() {

        $this->load->library('upload');
        $nomfoto = $_FILES['logo']['name'];
        $idera = $this->session->userdata("codent");

        if (empty($nomfoto)) {
            $registros = $this->input->post();
            $this->modelo->upd_era($idera, $registros);
            $idera = $this->cifrar->enc($this->session->userdata("codent"));
            $this->session->set_flashdata('realizado', 'Actualizada Correctamente');
            redirect('adminraa/obtener_detalle/' . $idera);
        } else {
            $config['upload_path'] = './uploads/imagenes/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '300';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('logo')) {
                $data = array('error' => $this->upload->display_errors());
                $data['titulo'] = "Ver detalles de entidad";
                $idera = $this->session->userdata("codent");
                $data['registro'] = $this->modelo->consulta_era($idera);
                $data['estados'] = $this->modelo->listar_estados();
                $data['tipodoc'] = $this->modelo->listar_tipodocumento();
                $this->load->view('plantilla/headeradmin', $data);
                $this->load->view('adminraa/era/editar_era', $data);
                $this->load->view('plantilla/footer');
            } else {
                $infoto = $this->upload->data();
                $registros = $this->input->post();
                $idera = $this->session->userdata("codent");
                $registros['logo'] = $infoto['file_name'];

                $this->modelo->upd_era($idera, $registros);
                $idera = $this->cifrar->enc($this->session->userdata("codent"));
                $this->session->set_flashdata('realizado', 'Actualizada Correctamente');
                redirect('adminraa/obtener_detalle/' . $idera);
            }
        }
    }

// -----------OBTENER LOS USUARIOS DE UNA DETERMINADA ERA --------------//
    public function obtener_usuarios() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codent', $id);
        $datos['codera'] = $id;
        $datos['registro'] = $this->modelo->consulta_era_usuarios($id);
        $datos['perfiles'] = $this->modelo->listar_perfiles();
        $data['titulo'] = "Ver detalles de entidad";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/listar_era_usuarios', $datos);
        $this->load->view('plantilla/footer');
    }

// -----------OBTENER USUARIOS PARA EDITAR DESDE LA ERA--------------//
    public function obt_usr_edit() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codusr', $id);
        $datos['estados'] = $this->modelo->listar_estados_usr();
        $datos['perfiles'] = $this->modelo->listar_perfiles();
        $datos['registro'] = $this->modelo->c_usr($id);
        $data['titulo'] = "Actualizar Usuario";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/editar_usr', $datos);
        $this->load->view('plantilla/footer');
    }

    //--------------------ACTUALIZAR CONTRASEÑA DE  USUARIO DE UNA ERA-----------------------------//
    public function upd_pass_usr() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
        if ($registros['clavenueva'] == $registros['clavenueva2']) {
            $this->modelo->actualizar_pass($registros['codusuario'], $registros);
            $this->session->set_flashdata('correcto', 'Clave Acualizada');
            $cusc = $this->cifrar->enc($registros['codusuario']);
            redirect('adminraa/obt_usr_edit/' . $cusc);
        } else {
            $this->session->set_flashdata('incorrecto', 'No coinciden Las claves');
            $cusc = $this->cifrar->enc($registros['codusuario']);
            redirect('adminraa/obt_usr_edit/' . $cusc);
        }
    }

    //--------------------ACTUALIZAR CONTRASEÑA DE  USUARIO DE UNA ERA-----------------------------//
    public function upd_pass_usr2() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
        if ($registros['clavenueva'] == $registros['clavenueva2']) {
            $this->modelo->actualizar_pass($registros['codusuario'], $registros);
            $this->session->set_flashdata('correcto', 'Clave Acualizada');
            $cusc = $this->cifrar->enc($registros['codusuario']);
            redirect('adminraa/obt_usr_edit2/' . $cusc);
        } else {
            $this->session->set_flashdata('incorrecto', 'No coinciden Las claves');
            $cusc = $this->cifrar->enc($registros['codusuario']);
            redirect('adminraa/obt_usr_edit2/' . $cusc);
        }
    }

    // -----------OBTENER USUARIOS PARA EDITAR DESDE EL ADMIN--------------//
    public function obt_usr_edit2() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codusr', $id);
        $datos['estados'] = $this->modelo->listar_estados_usr();
        $datos['perfiles'] = $this->modelo->listar_perfiles();
        $datos['registro'] = $this->modelo->c_usr($id);
        $datos['eras'] = $this->modelo->listar_era();
        $data['titulo'] = "Actualiza Usuario";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/editar_usr2', $datos);
        $this->load->view('plantilla/footer');
    }

    // -----------CAMBIAR DE ERA UN USUARIO-------------//

    public function add_usr2_cera() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $codusu = $this->session->userdata("codusr");
        $codpr = $this->input->post('codperfil');
        $registros['codera'] = $this->input->post('codera');

        $this->modelo->upd_usr2($codusu, $codpr, $registros);
        redirect('adminraa/ver_usuarios');
    }

//-------------ACTUALZAAR UN USUARIO------------------//
    public function update_usr() {
        $codusr = $this->session->userdata("codusr");
        $datos['registros'] = $this->modelo->c_usr($codusr);
        $datos['registronuevo'] = $this->input->post();
        $codper = $this->input->post('codperfil');
        $registros = $this->input->post();
        if ($datos['registros']->codperfil != 3) {
            if ($datos['registros']->nombreusuario != $datos['registronuevo']['nombreusuario']) {
                if ($verificarnom = $this->modelo->verificar_usuarios_nom($datos['registronuevo']['nombreusuario']) == true) {
                    $codent = $this->cifrar->enc($this->session->userdata("codent"));
                    redirect('adminraa/obtener_usuarios/' . $codent);
                } else if ($codper == 1 || $codper == 4) {
                    $codent = $this->cifrar->enc($this->session->userdata("codent"));
                    $this->session->set_flashdata('incorrecto', 'No le puede Asignar ese perfil');
                    redirect('adminraa/obtener_usuarios/' . $codent);
                } else {
                    $idusr = $this->session->userdata("codusr");
                    $codent = $this->cifrar->enc($this->session->userdata("codent"));
                    $this->modelo->upd_usr($idusr, $registros);
                    $this->session->set_flashdata('correcto', 'Usuario Actualizado Correctamente.');
                    redirect('adminraa/obtener_usuarios/' . $codent);
                }
            } else {
                if ($codper == 1 || $codper == 4) {
                    $codent = $this->cifrar->enc($this->session->userdata("codent"));
                    $this->session->set_flashdata('incorrecto', 'No le puede Asignar ese perfil');
                    redirect('adminraa/obtener_usuarios/' . $codent);
                } else {
                    $idusr = $this->session->userdata("codusr");
                    $codent = $this->cifrar->enc($this->session->userdata("codent"));
                    $this->modelo->upd_usr($idusr, $registros);
                    $this->session->set_flashdata('correcto', 'Usuario Actualizado Correctamente.');
                    redirect('adminraa/obtener_usuarios/' . $codent);
                }
            }
        } else {

            if ($codper == 1 || $codper == 4 || $codper == 2) {
                $codent = $this->cifrar->enc($this->session->userdata("codent"));
                $this->session->set_flashdata('incorrecto', 'No le puede Asignar ese perfil');
                redirect('adminraa/obtener_usuarios/' . $codent);
            } else {
                $idusr = $this->session->userdata("codusr");
                $codent = $this->cifrar->enc($this->session->userdata("codent"));
                $this->modelo->upd_usr($idusr, $registros);
                $this->session->set_flashdata('correcto', 'Usuario Actualizado Correctamente.');
                redirect('adminraa/obtener_usuarios/' . $codent);
            }
        }
    }

    //-------------ACTUALZAAR UN USUARIO DESDE EL PANEL RAA------------------//
    public function update_usr2() {
        $codusr = $this->session->userdata("codusr");
        $datos['registros'] = $this->modelo->c_usr($codusr);
        $datos['registronuevo'] = $this->input->post();
        $cod = $this->cifrar->enc($codusr);

        if ($datos['registronuevo']['nombreusuario'] != $datos['registros']->nombreusuario) {
            if ($verificarnom = $this->modelo->verificar_usuarios_nom($datos['registronuevo']['nombreusuario']) == true) {
                $this->session->set_flashdata('incorrecto', 'Nombre de usuario ya existe');
                $cod = $this->cifrar->enc($codusr);
                redirect('adminraa/obt_usr_edit2/' . $cod);
            }
        }

        if ($datos['registronuevo']['codperfil'] != $datos['registros']->codperfil) {
            if ($datos['registronuevo']['codperfil'] == 1) {
                $this->session->set_flashdata('incorrecto', 'No se le puede asignar este perfil');
                $cod = $this->cifrar->enc($codusr);
                redirect('adminraa/obt_usr_edit2/' . $cod);
            }
            if ($datos['registronuevo']['codperfil'] == 2) {
                if ($datos['registros']->codera == NULL) {
                    $this->session->set_flashdata('incorrecto', 'No se le puede asignar este perfil');
                    redirect('adminraa/obt_usr_edit2/' . $cod);
                }
                if ($this->modelo->verificar_usuarios_era($datos['registros']->codera) == TRUE) {
                    redirect('adminraa/obt_usr_edit2/' . $cod);
                }
            }
        }
        $this->modelo->upd_usr($codusr, $datos['registronuevo']);
        $this->session->set_flashdata('correcto', 'Usuario Actualizado Correctamente.');
        redirect('adminraa/ver_usuarios/');
    }

//------------------------AGREGAR UN USUARIO A UNA ENTIDAD-----------------------//
    public function add_usr() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $codperfil = $this->input->post('codperfil');

        $idera = $this->cifrar->enc($this->session->userdata("codent"));
        $registros = $this->input->post();
        $codera = $this->input->post('codera');
        $nombreusuario = $this->input->post('nombreusuario');
        $verificarnombre = $this->modelo->verificar_usuarios_nom($nombreusuario);
        if ($verificarnombre == true) {
            redirect('adminraa/obtener_usuarios/' . $idera);
        } else if ($codperfil == 1 || $codperfil == 4) {
            $this->session->set_flashdata('incorrecto', 'No puede ser Adminra!');
            redirect('adminraa/obtener_usuarios/' . $idera);
        } else if ($codperfil == 2) {//aca
            if ($this->modelo->verificar_usuarios_era($codera) == true) {
                redirect('adminraa/obtener_usuarios/' . $idera);
            } else {
                $registros['clave'] = md5($this->input->post('clave'));
//                        echo "<pre>";
//        var_dump($registros);
//        echo "</pre>";
//        exit();
                $this->modelo->crear_usr($registros);
                $this->session->set_flashdata('correcto', 'Uusario Creado!');
                $idera = $this->cifrar->enc($this->session->userdata("codent"));
                redirect('adminraa/obtener_usuarios/' . $idera);
            }
        }
    }

//------------------------AGREGAR UN USUARIO EN GENERAL SISTEMA RAA-----------------------//
    public function add_usr2() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
        if ($this->modelo->verificar_usuarios_nom($registros['nombreusuario']) == true) {
            redirect('adminraa/ver_usuarios');
        }
        $codera = $this->input->post('codera');
        if ($codera == 0) {
            $registros['codera'] = NULL;
        }
        $registros['clave'] = md5($this->input->post('clave'));
        $this->modelo->crear_usr($registros);
        $this->session->set_flashdata('correcto', 'Uusario Creado!');
        redirect('adminraa/ver_usuarios');
    }

    //--------------------ELIMINAR USUARIO ------------------------///
    public function usr_eliminar() {
        $id = $this->cifrar->dec($this->uri->segment(3));
        $datos['usuarios'] = $this->modelo->c_usr($id);
        $this->modelo->delete_usr($datos);
        $idera = $this->cifrar->enc($this->session->userdata("codent"));
        redirect('adminraa/obtener_usuarios/' . $idera);
    }

    //--------------------ELIMINAR USUARIO ------------------------///
    public function usr_eliminar2() {
        $id = $this->cifrar->dec($this->uri->segment(3));
        $datos['usuarios'] = $this->modelo->c_usr($id);
        $this->modelo->delete_usr($datos);
        $idera = $this->cifrar->enc($this->session->userdata("codent"));
        redirect('adminraa/ver_usuarios');
    }

    //-------------------------ELIMINAR ERA---------------//

    public function eliminar_era() {
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->modelo->delete_era($id);
        redirect('adminraa/era');
    }

//-------------------------------ME LISTA TODOS LOS AVALUADORES -------------------------------//
    public function ver_avaluadores() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $data['avaluadores'] = $this->modeloavaluador->ver_avaluadores();
        $data['estados'] = $this->modeloera->listar_estados();
        $data['titulo'] = "Listado de avaluadores";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/listar_avaluadores', $data);
        $this->load->view('plantilla/footer');
    }

    //-------------------------------LISTA AVALUADORES POR ESTADO -------------------------------//
    public function bus_ava_estado() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $codestado = $this->input->post('codestado');
        if (!empty($codestado)) {
            $data['avaluadores'] = $this->modeloavaluador->c_avaluador_estado($codestado);

            $data['estados'] = $this->modeloera->listar_estados();
            $data['titulo'] = "Listado de avaluadores";
            $this->load->view('plantilla/headeradmin', $data);
            $this->load->view('adminraa/era/listar_avaluadores', $data);
            $this->load->view('plantilla/footer');
        } else {
            $this->ver_avaluadores();
        }
    }

    //---------------BUSCAR  AVALUADORES NOMBRE DE LA ERA QUE INICIOS SESSION------------------------/// 
    public function bus_ava_nombre() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $nombre = $this->input->post('nombre');
        $data['avaluadores'] = $this->modeloavaluador->c_avaluador_nombre($nombre);
        $data['estados'] = $this->modeloera->listar_estados();
        $data['titulo'] = "Listado de avaluadores";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/listar_avaluadores', $data);
        $this->load->view('plantilla/footer');
    }

    //-------------------------OBT CODIGO APRA VER UN AVALUADOR -------------------------------//  
    public function obt_detaller_avaluador() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $datos['registro'] = $this->modeloavaluador->c_avaluador($id);
        $datos['categorias'] = $this->modeloera->c_cat_ava($id);
        $data['titulo'] = "Ver perfil Avaluador";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/perfil_avaluador', $datos);
        $this->load->view('plantilla/footer');
    }

    //--------------------------ME LISTA TODAS LAS CATEGORIAS -------------------------------//

    public function ver_categorias() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $data['categorias'] = $this->modeloavaluador->ver_allcategorias();
        $data['estados'] = $this->modeloera->listar_estados();
        $data['titulo'] = "Listado de Categorias";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/listar_categorias', $data);
        $this->load->view('plantilla/footer');
    }

    //------------------------AGREGAR UNA CATEGORIA DE AVALAUDOR-----------------------//
    public function add_cat() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
        $this->modelo->crear_cat($registros);
        $this->session->set_flashdata('correcto', 'Categoria Creada Exitosamente.');
        redirect('adminraa/ver_categorias');
    }

    // --------------OBT UNA CATEGORIA PARA EDITAR----------------//

    public function obt_cat_editar() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codcat', $id);
        $datos['registro'] = $this->modeloavaluador->consultar_cat($id);
        $data['titulo'] = "Ver detalles de entidad";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/editar_cat', $datos);
        $this->load->view('plantilla/footer');
    }

    //-------------ACTUALZAAR UNA CAATEGORIA------------------//
    public function update_cat() {
        $registros = $this->input->post();
        $idcat = $this->session->userdata("codcat");
        $this->modeloavaluador->upd_cat($idcat, $registros);
        $this->session->set_flashdata('correcto', 'Categoria Actualizada Exitosamente.');
        redirect('adminraa/ver_categorias');
    }

    //--------------------ELIMINAR UNA CATEGORIA ------------------------///
    public function cat_eliminar() {
        
        $id = $this->cifrar->dec($this->uri->segment(3));
        
        if($this->modeloavaluador->c_delete_cat($id)==FALSE){
            $this->session->set_flashdata('incorrecto', 'La categoria esta asignada a un avaluador, por lo cual no se puede eliminar');
            redirect('adminraa/ver_categorias','refresh');
        }   
        $this->modeloavaluador->delete_cat($id);
        $this->session->set_flashdata('correcto', 'Categoria Eliminada');
        redirect('adminraa/ver_categorias');
    }

    // -----------LISTAR TODOS LOS USUARIOS DEL SISTEMA --------------//
    public function ver_usuarios() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }

        $datos['registro'] = $this->modelo->consulta_usuarios();
        $datos['perfiles'] = $this->modelo->listar_perfiles();
        $datos['estados'] = $this->modelo->listar_estados_usr();
        $datos['eras'] = $this->modelo->listar_era();
        $data['titulo'] = "Usuarios";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/listar_usuarios', $datos);
        $this->load->view('plantilla/footer');
    }

    //---------------BUSCAR USUARIOS POR NOMBRE------------------------/// 
    public function bus_usr_nombre() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $nombre = $this->input->post('nombre');

        $datos['registro'] = $this->modelo->c_usr_nombre($nombre);
        $datos['perfiles'] = $this->modelo->listar_perfiles();
        $datos['estados'] = $this->modelo->listar_estados_usr();
        $datos['eras'] = $this->modelo->listar_era();
        $data['titulo'] = "Usuarios";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/listar_usuarios', $datos);
        $this->load->view('plantilla/footer');
    }

    // -----------LISTAR TODOS LOS USUARIOS DEL SISTEMA --------------//
    public function ver_parametros() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }

        $datos['estados'] = $this->modeloera->listar_estados();
        $datos['tipo_doc'] = $this->modeloera->listar_tipodocumento();
        $datos['perfiles'] = $this->modelo->listar_perfiles();
        $data['titulo'] = "Ver detalles de entidad";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/parametros/ver_parametros', $datos);
        $this->load->view('plantilla/footer');
    }

    // ----------PARAMETRO ESTADO --------------//
    public function ver_estados() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $datos['estados'] = $this->modeloera->listar_estados();
        $data['titulo'] = "Ver detalles de entidad";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/parametros/ver_estados', $datos);
        $this->load->view('plantilla/footer');
    }

    // ----------PARAMETRO TIPO DOCUMENTO --------------//
    public function ver_tipodoc() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $datos['tipo_doc'] = $this->modeloera->listar_tipodocumento();
        $data['titulo'] = "Ver detalles de entidad";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/parametros/ver_tipodoc', $datos);
        $this->load->view('plantilla/footer');
    }

    // ----------PARAMETRO TIPO SANCION --------------//
    public function ver_tiposan() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $datos['tipo_san'] = $this->modelo->listar_tiposan();
        $data['titulo'] = "Ver detalles de entidad";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/parametros/ver_tiposan', $datos);
        $this->load->view('plantilla/footer');
    }

    // ----------PARAMETRO ESTADO SOLICITUD --------------//
    public function ver_estadosol() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $datos['estado_sol'] = $this->modelo->listar_estadosol();
        $data['titulo'] = "Ver detalles de entidad";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/parametros/ver_estadosol', $datos);
        $this->load->view('plantilla/footer');
    }

    // ----------PARAMETRO ESTADO SOLICITUD --------------//
    public function ver_tipotrans() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $datos['tipo_trans'] = $this->modelo->listar_tipotransa();
        $data['titulo'] = "Ver detalles de entidad";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/parametros/ver_tipotrans', $datos);
        $this->load->view('plantilla/footer');
    }

    // --------------OBT CODESTADO PAARA EDITAR---------------//
    public function obt_estado_edit() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codestado', $id);
        $datos['registro'] = $this->modelo->consultar_estado($id);
        $data['titulo'] = "Editard";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/parametros/editar_estado', $datos);
        $this->load->view('plantilla/footer');
    }

    //-------------ACTUALZAAR UN ESTADO------------------//
    public function upd_estado() {
        $registros = $this->input->post();
        $id = $this->session->userdata("codestado");
        $this->modelo->update_estado($id, $registros);
        $this->session->set_flashdata('correcto', 'Estado Actualizado.');
        redirect('adminraa/ver_estados');
    }

    // --------------OBT CODTIPO DOC  PAARA EDITAR---------------//
    public function obt_tipodoc_edit() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codtipodoc', $id);
        $datos['registro'] = $this->modelo->consultar_tipodoc($id);
        $data['titulo'] = "Editard";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/parametros/editar_tipodoc', $datos);
        $this->load->view('plantilla/footer');
    }

    //-------------ACTUALZAAR UN TIPO DOCUMENTO------------------//
    public function upd_tipodoc() {
        $registros = $this->input->post();
        $id = $this->session->userdata("codtipodoc");
        $this->modelo->update_tipodoc($id, $registros);
        $this->session->set_flashdata('correcto', 'Tipo de Documento Actualizado.');
        redirect('adminraa/ver_tipodoc');
    }

    // --------------OBT CODTIPOSANCION PAARA EDITAR---------------//
    public function obt_tiposan_edit() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codtiposan', $id);
        $datos['registro'] = $this->modelo->consultar_tiposan($id);
        $datos['estados'] = $this->modelo->consultar_estadotiposan();
        $data['titulo'] = "Editard";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/parametros/editar_tiposan', $datos);
        $this->load->view('plantilla/footer');
    }

    //-------------ACTUALZAAR UN TIPO DE SANCION------------------//
    public function upd_tiposan() {
        $registros = $this->input->post();
//        $registros['nombre']=$this->input->post('nombre');
//        $registros['codestado_tiposancion']=$this->input->post('codestado_tiposancion');
        $id = $this->session->userdata("codtiposan");
        $this->modelo->update_tiposan($id, $registros);
        $this->session->set_flashdata('correcto', 'Tipo de Sancion Actualizado.');
        redirect('adminraa/ver_tiposan');
    }

    // --------------OBT CODESTADO SOLIITUD EDITAR---------------//
    public function obt_estadosol_edit() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codestadosol', $id);
        $datos['registro'] = $this->modelo->consultar_estadosol($id);
        $data['titulo'] = "Editard";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/parametros/editar_estadosol', $datos);
        $this->load->view('plantilla/footer');
    }

    //-------------ACTUALZAAR UN ESTADO DE SOLICITUD-----------------//
    public function upd_estadosol() {
        $registros = $this->input->post();
                
        $id = $this->session->userdata("codestadosol");
        $this->modelo->update_estadosol($id, $registros);
        $this->session->set_flashdata('correcto', 'Estado de solicitud Actualizado.');
        redirect('adminraa/ver_estadosol');
    }

    // --------------OBT CODTIPO TRANSACION PARA EDITAR---------------//
    public function obt_tipotrans_edit() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codtipotrans', $id);
        $datos['registro'] = $this->modelo->consultar_tipotrans($id);
        $data['titulo'] = "Editard";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/parametros/editar_tipotrans', $datos);
        $this->load->view('plantilla/footer');
    }

    //-------------ACTUALZAAR UN TIPO DE TRANSACCION-----------------//
    public function upd_tipotrans() {
        $registros = $this->input->post();
        $id = $this->session->userdata("codtipotrans");
        $this->modelo->update_tipotrans($id, $registros);
        $this->session->set_flashdata('correcto', 'Tipo de Transaccion actualizado');
        redirect('adminraa/ver_tipotrans');
    }

    // -----------LISTAR TODOS LOS CERTIFICADOS GENERADOS--------------//

    public function ver_certificados() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Editar Avaluador";
        $data['certificados'] = $this->modeloera->listar_todos_certificado();

        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/era/ver_certificados', $data);
        $this->load->view('plantilla/footer');
    }

    // -----------LISTAR TODAS LAS TRANSACCIONES DEL SISTEMA--------------//

    public function ver_transacciones() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Transacciones";
        $data['transacciones'] = $this->modelo->listar_transacciones();
        $data['tipotrans'] = $this->modelo->listar_tipotrans();
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/auditoria/ver_transacciones', $data);
        $this->load->view('plantilla/footer');
    }

    //-----------------------ABRIR LA VISTA DE NUEVO REPORTE-----------------------//
    public function nuevo_reporte() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Reportes";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/reportes/index');
        $this->load->view('plantilla/footer');
    }

    //---------------BUSCAR  TRANSACCION POR  NOMBRE -----------------------/// 
    public function bus_transa_nombre() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $nombre = $this->input->post('nombre');
        $data['transacciones'] = $this->modelo->listar_transacciones_nom($nombre);
        $data['tipotrans'] = $this->modelo->listar_tipotrans();
        $data['titulo'] = "Registro de transacciones";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/auditoria/ver_transacciones', $data);
        $this->load->view('plantilla/footer');
    }

    //---------------BUSCAR  TRANSACCION POR FECHA -----------------------/// 
    public function bus_transa_fecha() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $fecha = $this->input->post('fecha');
        $data['transacciones'] = $this->modelo->listar_transacciones_fecha($fecha);
        $data['tipotrans'] = $this->modelo->listar_tipotrans();
        $data['titulo'] = "Registro de transacciones";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/auditoria/ver_transacciones', $data);
        $this->load->view('plantilla/footer');
    }

    //---------------BUSCAR  TRANSACCION POR FECHA -----------------------/// 
    public function bus_transa_tipo() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $codtipo = $this->input->post('codtipo');
        $data['transacciones'] = $this->modelo->listar_transacciones_tipo($codtipo);
        $data['tipotrans'] = $this->modelo->listar_tipotrans();
        $data['titulo'] = "Registro de transacciones";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/auditoria/ver_transacciones', $data);
        $this->load->view('plantilla/footer');
    }
    //---------------BUSCAR  TRANSACCION POR PERIODO DE FECHAS -----------------------/// 
    public function bus_transa_periodo() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        $data['transacciones'] = $this->modelo->listar_transacciones_pfecha($fecha1,$fecha2);
        $data['tipotrans'] = $this->modelo->listar_tipotrans();
        $data['titulo'] = "Registro de transacciones";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/auditoria/ver_transacciones', $data);
        $this->load->view('plantilla/footer');
    }

    // -----------ABRIL EL PANEL DE CONFIGURACIONES--------------//
    public function configuracion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $usuarioera = $this->session->userdata('codusuario');
        $data['usuario'] = $this->modelo->c_usr($usuarioera);

        $data['titulo'] = "Configuracion";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminraa/configuracion', $data);
        $this->load->view('plantilla/footer');
    }

    //--------------------ACTUALIZAR CONTRASEÑA DE  USUARIO QUE INICIA SESION ERA-----------------------------//
    public function upd_pass() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
        if ($this->modelo->verificar_pass($registros['codusuario'], md5($registros['claveanterior'])) == true) {
            if ($registros['clavenueva'] == $registros['clavenueva2']) {
                $this->modelo->actualizar_pass($registros['codusuario'], $registros);
                $this->session->set_flashdata('correcto', 'Clave Acualizada');
                redirect('adminraa/configuracion');
            }
            $this->session->set_flashdata('incorrecto', 'No coinciden Las claves');
            redirect('adminraa/configuracion');
        } else {
            redirect('adminraa/configuracion');
        }
    }

    //--------------------ACTUALIZAR DATOS DE USUARIO ADMIN QUE INICIA SESSION -----------------------------//

    public function upd_usr() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $idusr = $this->session->userdata("codusuario");
        $registros['anterior'] = $this->modelo->consulta_usuario($idusr);
        $registros['nuevo'] = $this->input->post();
        if ($registros['anterior']->nombreusuario != $registros['nuevo']['nombreusuario']) {
            if ($this->modelo->verificar_usuarios_nom($registros['nuevo']['nombreusuario']) == true) {
                redirect('adminraa/configuracion');
            }
            $this->modelo->upd_usr($idusr, $registros['nuevo']);
            $this->session->set_flashdata('correcto', 'Informacion actualizada correctamente.');
            redirect('adminraa/configuracion');
        } else {
            $this->modelo->upd_usr($idusr, $registros['nuevo']);
            $this->session->set_flashdata('correcto', 'Informacion actualizada correctamente.');
            redirect('adminraa/configuracion');
        }
    }

}
