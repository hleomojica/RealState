<?php

Class Adminera extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model('admineramodel', 'modelo');
        $this->load->model('adminraamodel', 'modeloraa');
        $this->load->model('avaluadormodel', 'modeloavaluador');
        $this->load->model('certificadomodel', 'modelocertificado');
        $this->load->library('cifrar');
    }

    //=============== FUNCION CARGAR LA VISTA DE INICIO DEL MODULO ADMINRAA  =======================================//
    public function index() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = 'Administrador ERA';
        $codera = $this->session->userdata('era');
        $data['avaluadores'] = $this->modelo->contar_avaluadores($codera);
        $data['usuarios'] = $this->modelo->contar_usuarios($codera);
        $data['solicitudes'] = $this->modelo->contar_solicitudes($codera);
        $data['solicitudestras'] = $this->modelo->contar_soltraslado($codera);
        
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/index', $data);
        $this->load->view('plantilla/footer');
    }

//-----------------LISTAR TODAS LAS ERA ------------------------/// 
    public function era() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminraa') {
            redirect(base_url() . 'login');
        }
        $data['eras'] = $this->modelo->listar_era();
        $this->load->view('plantilla/headeradmin');
        $this->load->view('adminraa/listar_era', $data);
        $this->load->view('plantilla/footer');
    }

    //----------------LISTAR TODOS LOS AVALUADORES DE LA ERA QUE INICIO SESSION------------------------/// 
    public function ver_avaluadores() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->session->userdata('era');
        $data['avaluadores'] = $this->modelo->ver_avaluadores($id);
        $data['estados'] = $this->modelo->listar_estados();
        $data['titulo'] = "Listado de Avaluadores";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/listar_avaluadores', $data);
        $this->load->view('plantilla/footer');
    }

    //---------------BUSCAR  AVALUADORES POR ESTADO DE LA ERA QUE INICIOS SESSION------------------------/// 
    public function bus_ava_estado() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codestado = $this->input->post('codestado');
        if (!empty($codestado)) {
            $codera = $this->session->userdata('era');
            $data['avaluadores'] = $this->modelo->c_avaluador_estado($codestado, $codera);
            $data['estados'] = $this->modelo->listar_estados();
            $data['titulo'] = "Listado de avaluadores";
            $this->load->view('plantilla/headeradminera', $data);
            $this->load->view('adminera/listar_avaluadores', $data);
            $this->load->view('plantilla/footer');
        } else {
            $this->ver_avaluadores();
        }
    }

    //---------------BUSCAR  AVALUADORES NOMBRE DE LA ERA QUE INICIOS SESSION------------------------/// 
    public function bus_ava_nombre() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $nombre = $this->input->post('nombre');
        $codera = $this->session->userdata('era');
        $data['avaluadores'] = $this->modelo->c_avaluador_nombre($nombre, $codera);
        $data['estados'] = $this->modelo->listar_estados();
        $data['titulo'] = "Listado de avaluadores";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/listar_avaluadores', $data);
        $this->load->view('plantilla/footer');
    }

    //---------------BUSCAR  AVALUADORES CEDULA DE LA ERA QUE INICIOS SESSION------------------------/// 
    public function bus_ava_cedula() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $cedula = $this->input->post('cedula');
        $codera = $this->session->userdata('era');
        $data['avaluadores'] = $this->modelo->c_avaluador_cedula($cedula, $codera);
        $data['estados'] = $this->modelo->listar_estados();
        $data['titulo'] = "Listado de avaluadores";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/listar_avaluadores', $data);
        $this->load->view('plantilla/footer');
    }

    //-------------------------OBT CODIGO PARA VER UN AVALUADOR -------------------------------//  
    public function obt_detalle_avaluador() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codava', $id);
        $datos['registro'] = $this->modelo->c_avaluador($id);
        $datos['categorias'] = $this->modelo->c_cat_ava($id);
        $data['titulo'] = "Ver perfil Avaluador";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/perfil_avaluador', $datos);
        $this->load->view('plantilla/footer');
    }

    //------------------------AGREGAR UN USUARIO A UN AVALUADOR DESDE EL PERFIL DE AVALUADOR-----------------------//
    public function add_usr_ava() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codava = $this->cifrar->enc($this->session->userdata("codava"));
        $registros = $this->input->post();
        $nombreusuario = $this->input->post('nombreusuario');
        $verificarnombre = $this->modelo->verificar_usuarios_nom($nombreusuario);
        if ($verificarnombre == true) {
            redirect('adminera/obt_detalle_avaluador/' . $codava);
        }
        $registros['clave'] = md5($this->input->post('clave'));
        $this->modelo->crear_usr($registros);
        $this->session->set_flashdata('correcto', 'Usuario Asignado');

        redirect('adminera/obt_detalle_avaluador/' . $codava);
    }

    //------------------------CARGA LA VISTA DE CREAR AVALUADOR-------------------------------// 
    public function crear_avaluador() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $data['categorias'] = $this->modeloavaluador->ver_categorias();
        $data['estados'] = $this->modelo->listar_estados();
        $data['tipodoc'] = $this->modelo->listar_tipodocumento();
        $data['titulo'] = "Nuevo Avaluador";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/nuevo_avaluador');
        $this->load->view('plantilla/footer');
    }

    //------------------------VERIFICA SI EL NUMERO DE CEDULA YA EXISTE AJAX-------------------------------// 
    public function verificar_ncedula() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $cc = $this->input->post('ncedula');
        $this->modelo->verificar_usuarios_cc($cc);
    }

    //------------------------AGREGAR AVALUADOR CON FOTO Y SOPORTE-------------------------------//  
    public function add_avaluador() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $this->form_validation->set_rules('nombres', 'nombres', 'required|min_length[3]');
        $this->form_validation->set_rules('categorias[]', 'Categorias', 'required');
        $this->form_validation->set_message('required', '*Debe ingresar %s  para continuar');
        $this->form_validation->set_message('min_length', '*El campo %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length', 'El campo no puede tener más de %s carácteres');
        if ($this->form_validation->run() == TRUE) {

            $registros['nombres'] = $this->input->post('nombres');
            $registros['apellidos'] = $this->input->post('apellidos');
            $registros['domicilio'] = $this->input->post('domicilio');
            $registros['lugar_nac'] = $this->input->post('lugar_nac');
            $registros['codtipo_documento'] = $this->input->post('codtipo_documento');
            $registros['cedula'] = $this->input->post('cedula');
            $registros['fechaex_id'] = $this->input->post('fechaex_id');
            $registros['telefono'] = $this->input->post('telefono');
            $registros['celular'] = $this->input->post('celular');
            $registros['correo'] = $this->input->post('correo');
            $registros['regimen_inscripcion'] = $this->input->post('regimen_inscripcion');
            $registros['fechainscripcion'] = $this->input->post('fechainscripcion');
            $registros['codestado'] = $this->input->post('codestado');
            $registros['regindustria'] = $this->input->post('regindustria');
            $registros['foto'] = $this->input->post('foto');
            $registros['soporte'] = $this->input->post('soporte');
            $registros['codera'] = $this->session->userdata('era');
            $registros['fechavencimiento'] = $this->input->post('fechavencimiento');
            $registros['tarjetaprofesional'] = $this->input->post('tarjetaprofesional');
            $categorias = $this->input->post('categorias');
//        if ($this->modelo->verificar_usuarios_cc($registros['cedula'])) {
//            redirect('adminera/crear_avaluador');
//        }
            $codera = $this->session->userdata('era');
            $this->load->library('upload');
            $nomfoto = $_FILES['foto']['name'];
            $nomsoporte = $_FILES['soporte']['name'];
            $nomformato = $_FILES['formato_solicitud']['name'];
            if (empty($nomsoporte) && empty($nomformato)) {
                $subir = $this->subir_foto();
                if ($subir != false) {
                    $registros['foto'] = $subir;
                    $this->modelo->add_avaluador($registros, $codera, $categorias);
                    redirect('adminera/ver_avaluadores');
                }
                $this->crear_avaluador();
            } else if (!empty($nomsoporte) && empty($nomformato)) {
                $subf = $this->subir_foto();
                $subs = $this->subir_soporte();
                if ($subf != false && $subs != false) {
                    $registros['foto'] = $subf;
                    $registros['soporte'] = $subs;
                    $this->modelo->add_avaluador($registros, $codera, $categorias);
                    redirect('adminera/ver_avaluadores');
                }
                $this->crear_avaluador();
            } else if (empty($nomsoporte) && !empty($nomformato)) {
                $subf = $this->subir_foto();
                $subfor = $this->subir_formato();
                if ($subf != false && $subfor != false) {
                    $registros['foto'] = $this->$subf;
                    $registros['formato_solicitud'] = $subfor;
                    $this->modelo->add_avaluador($registros, $codera, $categorias);
                    redirect('adminera/ver_avaluadores');
                }
                $this->crear_avaluador();
            } else {
                $subf = $this->subir_foto();
                $subs = $this->subir_soporte();
                $subfor = $this->subir_formato();
                if ($subf != false && $subfor != false && $subs) {
                    $registros['foto'] = $subf;
                    $registros['soporte'] = $subs;
                    $registros['formato_solicitud'] = $subfor;
                    $this->modelo->add_avaluador($registros, $codera, $categorias);
                    redirect('adminera/ver_avaluadores');
                }
                $this->crear_avaluador();
            }
        } else {
            
            $this->crear_avaluador();
        }
    }

    //------------------------METODOS PARA SUBIR LOS ARCHIVOS-------------------------------//  
    public function subir_foto() {
        $config['upload_path'] = './uploads/imagenes/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '1024';
        $config['max_height'] = '1024';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('foto')) {
            $data = array('error' => '*Imagen:  ' . $this->upload->display_errors());
            $this->session->set_flashdata('incorrecto', $data['error']);
            return false;
        } else {
            $infoto = $this->upload->data();
            return $infoto['file_name'];
        }
    }

    public function subir_soporte() {
        $config['upload_path'] = './uploads/archivos/hojas_vida';
        $config['allowed_types'] = 'pdf|doc';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('soporte')) {
            $data = array('error' => '*Hoja de vida:  ' . $this->upload->display_errors());
            $this->session->set_flashdata('incorrecto', $data['error']);
            return false;
        } else {
            $infosoporte = $this->upload->data();
            return $infosoporte['file_name'];
        }
    }

    public function subir_formato() {
        $config['upload_path'] = './uploads/archivos/solicitudes/';
        $config['allowed_types'] = 'pdf|doc';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('formato_solicitud')) {
            $data = array('error' => '*Formato de solicitud:  ' . $this->upload->display_errors());
            $this->session->set_flashdata('incorrecto', $data['error']);
            return false;
        } else {
            $infosolicitud = $this->upload->data();
            return $infosolicitud['file_name'];
        }
    }

    public function subir_foto_upd() {
        $config['upload_path'] = './uploads/imagenes/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '1024';
        $config['max_height'] = '1024';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('foto')) {
            $data = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('incorrecto', $data['error']);
            $codavaluador = $this->session->userdata("codava");
            redirect('adminera/obt_ava_edit/' . $this->cifrar->enc($codavaluador));
        } else {
            $infoto = $this->upload->data();
            return $infoto['file_name'];
        }
    }

    public function subir_soporte_upd() {
        $config['upload_path'] = './uploads/archivos/hojas_vida/';
        $config['allowed_types'] = 'pdf|doc';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('soporte')) {
            $data = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('incorrecto', $data['error']);
            $codavaluador = $this->session->userdata("codava");
            redirect('adminera/obt_ava_edit/' . $this->cifrar->enc($codavaluador));
        } else {
            $infosoporte = $this->upload->data();
            return $infosoporte['file_name'];
        }
    }

    public function subir_formato_upd() {
        $config['upload_path'] = './uploads/archivos/solicitudes';
        $config['allowed_types'] = 'pdf|doc';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('formato_solicitud')) {
            $data = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('incorrecto', $data['error']);
            $codavaluador = $this->session->userdata("codava");
            redirect('adminera/obt_ava_edit/' . $this->cifrar->enc($codavaluador));
        } else {
            $infosolicitud = $this->upload->data();
            return $infosolicitud['file_name'];
        }
    }

    function _create_thumbnail($filename) {
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = 'uploads/' . $filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image'] = 'uploads/thumbs/';
        $config['width'] = 150;
        $config['height'] = 150;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }

    //---------------------OBTENER AVALAUDOR PARA EDITAR-------------------------------//
    public function obt_ava_edit() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }

        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codava', $id);
        $datos['registro'] = $this->modelo->c_avaluador($id);
        $data['categoriasv'] = $this->modeloavaluador->ver_categorias();
        $data['categorias'] = $this->modelo->c_cat_ava($id);
        $data['estados'] = $this->modelo->listar_estados();
        $data['tipodoc'] = $this->modelo->listar_tipodocumento();
        $data['titulo'] = "Editar Avaluador";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/editar_avaluador', $datos);
        $this->load->view('plantilla/footer');
    }

    //-------------PLNATILLA PARA PRUEBAS -----//
    public function pruebita() {
        $data['titulo'] = "Editar Avaluador";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/pruebita');
        $this->load->view('plantilla/footer');
    }

 


    //---------------------ACTUALZIAR LAS CATEGORIAS DE UN AVALUADOR------------------------------//
    public function upd_cat_ava() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codavaluador = $this->cifrar->enc($this->session->userdata("codava"));
        $registros = $this->input->post('categorias');
        $numero_id = $this->input->post('numero_id');
        $this->modelo->act_cat_ava($registros, $numero_id);
        $this->session->set_flashdata('correcto', 'Categorias cambiadas');
        redirect('adminera/obt_ava_edit/' . $codavaluador);
    }

    //---------------------ACTUALZIAR AVALAUDOR PARA EDITAR-------------------------------//
    public function update_avaluador() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }

        $anterior = $this->modelo->c_avaluador($this->session->userdata("codava"));
        $registros['cedula'] = $this->input->post('cedula');
        if ($registros['cedula'] != $anterior->cedula) {
            if ($this->modelo->verificar_usuarios_cc($registros['cedula'])) {
                $codavaluador = $this->cifrar->enc($this->session->userdata("codava"));
                redirect('adminera/obt_ava_edit/' . $codavaluador);
            }
        }
        $this->load->library('upload');
        $nomfoto = $_FILES['foto']['name'];
        $nomsoporte = $_FILES['soporte']['name'];
        $nomformato = $_FILES['formato_solicitud']['name'];
        if (empty($nomfoto) && empty($nomsoporte) && empty($nomformato)) {
            $registros = $this->input->post();
            $codavaluador = $this->session->userdata("codava");
            $this->modelo->upd_avaluador($codavaluador, $registros);
            redirect('adminera/obt_detalle_avaluador/' . $this->cifrar->enc($codavaluador));
        } else if (!empty($nomfoto) && empty($nomsoporte) && empty($nomformato)) {
            $registros = $this->input->post();
            $codavaluador = $this->session->userdata("codava");
            $registros['foto'] = $this->subir_foto_upd();
            $this->modelo->upd_avaluador($codavaluador, $registros);
            redirect('adminera/obt_detalle_avaluador/' . $this->cifrar->enc($codavaluador));
        } else if (empty($nomfoto) && !empty($nomsoporte) && empty($nomformato)) {
            $registros = $this->input->post();
            $codavaluador = $this->session->userdata("codava");
            $registros['soporte'] = $this->subir_soporte_upd();
            $this->modelo->upd_avaluador($codavaluador, $registros);
            redirect('adminera/obt_detalle_avaluador/' . $this->cifrar->enc($codavaluador));
        } else if (empty($nomfoto) && empty($nomsoporte) && !empty($nomformato)) {
            $registros = $this->input->post();
            $codavaluador = $this->session->userdata("codava");
            $registros['formato_solicitud'] = $this->subir_formato_upd();
            $this->modelo->upd_avaluador($codavaluador, $registros);
            redirect('adminera/obt_detalle_avaluador/' . $this->cifrar->enc($codavaluador));
        } else if (!empty($nomfoto) && !empty($nomsoporte) && empty($nomformato)) {
            $registros = $this->input->post();
            $codavaluador = $this->session->userdata("codava");
            $registros['foto'] = $this->subir_foto_upd();
            $registros['soporte'] = $this->subir_soporte_upd();
            $this->modelo->upd_avaluador($codavaluador, $registros);
            redirect('adminera/obt_detalle_avaluador/' . $this->cifrar->enc($codavaluador));
        } else if (!empty($nomfoto) && empty($nomsoporte) && !empty($nomformato)) {
            $registros = $this->input->post();
            $codavaluador = $this->session->userdata("codava");
            $registros['foto'] = $this->subir_foto_upd();
            $registros['formato_solicitud'] = $this->subir_formato_upd();
            $this->modelo->upd_avaluador($codavaluador, $registros);
            redirect('adminera/obt_detalle_avaluador/' . $this->cifrar->enc($codavaluador));
        } else {
            $registros = $this->input->post();
            $codavaluador = $this->session->userdata("codava");
            $registros['soporte'] = $this->subir_soporte_upd();
            $registros['formato_solicitud'] = $this->subir_formato_upd();
            $this->modelo->upd_avaluador($codavaluador, $registros);
            redirect('adminera/obt_detalle_avaluador/' . $this->cifrar->enc($codavaluador));
        }
    }

    //---------------------INACTIVAR AVALUADOR DE UNA ERA-------------------------------//
    public function inactivar_av() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $enc = $this->uri->segment(3);
        $codava = $this->cifrar->dec($enc);
        $anterior = $this->modelo->c_avaluador($codava);

        $this->modelo->upd_inactivar($codava, $anterior);
        redirect('adminera/obt_detalle_avaluador/' . $enc);
    }

    //---------------------ABRIR PANEL DE COMITE-------------------------------//
    public function ver_comite() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codera = $this->session->userdata('era');
        $data['titulo'] = "Comites ERA";
        $data['comites'] = $this->modelo->listar_comite($codera);

        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/ver_comite', $data);
        $this->load->view('plantilla/footer');
    }

//    //---------------------BUSCAR UN COMITE POR FECHA-------------------------------//
//    public function bus_comite_fecha() {
//        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
//            redirect(base_url() . 'login');
//        }
//        $codera = $this->session->userdata('era');
//        $fecha = $this->input->post('fecha');
//        echo "<pre>";
//        var_dump($fecha);
//        echo "</pre>";
//        exit();
//
//        $data['titulo'] = "Comites ERA";
//        $data['comites'] = $this->modelo->listar_comite_fecha($codera, $fecha);
//
//        $this->load->view('plantilla/headeradminera', $data);
//        $this->load->view('adminera/ver_comite', $data);
//        $this->load->view('plantilla/footer');
//    }

    
    
 //---------------------NUEVO COMITE------------------------------//
    public function add_comite() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
        $registros['codera'] = $this->session->userdata('era');
        $this->modelo->add_comite($registros);
        redirect('adminera/ver_comite');
    }    

//---------------------OBTENER CODCOMITE PARA VER DETALLE-------------------------------//
    public function obt_detalle_comite() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codmite', $id);
        $codera = $this->session->userdata('era');

        $data['titulo'] = "DETALLE COMITE";
        $data['comite'] = $this->modelo->listar_comitedetalle($id);
         $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/detalle_comite', $data);
        $this->load->view('plantilla/footer');
    }
    //---------------------VER RESPUESTA A SOLICITUDES ENVIADAS DEL SISTEMA EN UN COMITE-------------------------------//
    public function comite_solsistema() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codmite', $id);
        $codera = $this->session->userdata('era');
        $data['titulo'] = "DETALLE COMITE";
        $data['comite'] = $this->modelo->listar_comitedetalle($id);
        $data['registro'] = $this->modelo->detalle_comitesolsis($id);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/detalle_comitesol', $data);
        $this->load->view('plantilla/footer');
    }
    //---------------------VER RESPUESTA A SOLICITUDES DE INSCRIPCION DE UN COMITE-------------------------------//
    public function comite_solinscripcion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codmite', $id);
        $codera = $this->session->userdata('era');
        $data['titulo'] = "Detalle comite";
        $data['comite'] = $this->modelo->listar_comitedetalle($id);
        $data['registro'] = $this->modelo->detalle_comiteinscripciones($id);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/detalle_comiteinscripcion', $data);
        $this->load->view('plantilla/footer');
    }
    //--------------------AGREGAR UNA RESPUESTA  EN UN COMITE-------------------------------//
    public function add_respuestainscripcion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
       $codcomite = $this->cifrar->enc($this->session->userdata('codmite'));
       $datos=  $this->input->post();
       $this->modelo->add_respuestainscripcion($datos);
       redirect('adminera/comite_solinscripcion/'.$codcomite);
 }

    //---------------------VER SOLICITUDES------------------------------//
    public function ver_solicitudes() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codera = $this->session->userdata('era');
        $data['titulo'] = "Comites ERA";
        $data['solicitudes'] = $this->modelo->listar_solicitudes($codera);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/ver_solicitudes', $data);
        $this->load->view('plantilla/footer');
    }

    //---------------------OBTENER SOLICITUD PARA DAR RESPUESTA-------------------------------//
    public function obt_sol() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codsol', $id);
        $codera = $this->session->userdata('era');
        $data['solicitudes'] = $this->modelo->c_solicitud($id);
        $data['comites'] = $this->modelo->listar_comite($codera);
        $data['estados'] = $this->modelo->listar_estado_s();
        $data['titulo'] = "Respuesta Solicitud";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/solucionar_sol', $data);
        $this->load->view('plantilla/footer');
    }

   

    //---------------------ABRIR PANEL CERTIFICADOS-------------------------------//
    public function ver_certificados() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codera = $this->session->userdata('era');
        $data['titulo'] = "Editar Avaluador";
        $data['certificados'] = $this->modelo->listar_certificado($codera);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/ver_certificados', $data);
        $this->load->view('plantilla/footer');
    }

    //----------------CARGAR LA VISTA DE BUSCAR AVA PARA NUEVO CERTIFICADO(Elimina la tab temporal)-------------------------//

    public function nuevo_certificado_btn() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Nuevo Certificado ";
        $codera = $this->session->userdata('era');
        $this->modelocertificado->eliminar_t($codera);
        $data['temporal'] = $this->modelocertificado->c_temporal($codera);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/nuevo_certificado');
        $this->load->view('plantilla/footer');
    }

    //----------------CARGAR LA VISTA DE BUSCAR AVA PARA NUEVO CERTIFICADO-------------------------//

    public function nuevo_certificado() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Nuevo Certificado ";
        $codera = $this->session->userdata('era');
        $data['temporal'] = $this->modelocertificado->c_temporal($codera);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/nuevo_certificado');
        $this->load->view('plantilla/footer');
    }

    //--------------------BUSCAR AVALAUDOR POR CEDULA PARA AGREGAR A TEMPORAL-------------------------------// 
    public function bsc_ava_c() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $idava = $this->input->post('cedula');
        $codera = $this->session->userdata('era');
        $data['avaluadores'] = $this->modelo->c_avaluador_e($idava, $codera);
        if (!$data['avaluadores'] == NULL) {
            $data['titulo'] = "Listado de avaluadores";
            $this->load->view('plantilla/headeradminera', $data);
            $this->load->view('adminera/certificados/ver_avaluador', $data);
            $this->load->view('plantilla/footer');
        } else {
            $this->session->set_flashdata('incorrecto', '!No se encontro el Avaluador !');
            redirect('adminera/nuevo_certificado', 'refresh');
        }
    }

    //-------------------RESPONDER SOLICITUD Y ACTUALIZARLA------------------------------// 
    public function responder_solicitud() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $datos['codsolicitud'] = $this->input->post('codsolicitud');
        $datos['codcomite'] = $this->input->post('codcomite');
        $datos['respuesta'] = $this->input->post('respuesta');
        $datos['observaciones'] = $this->input->post('observaciones');
        $registros['codsolicitud'] = $this->input->post('codsolicitud');
        $registros['numero_id'] = $this->input->post('numero_id');
        $registros['codestado_solicitud'] = $this->input->post('codestado_solicitud');
        $this->modelo->add_respuesta($datos, $registros);
        redirect('adminera/ver_solicitudes');
    }

    //------------------ABRIR PANEL SANCIONES-----------------------------// 

    public function ver_sanciones() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codera = $this->session->userdata('era');
        $data['titulo'] = "Sanciones";
        $data['sanciones'] = $this->modelo->listar_sanciones($codera);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/ver_sanciones', $data);
        $this->load->view('plantilla/footer');
    }

    //------------------ABRIR PANEL SANCIONES-----------------------------// 

    public function bus_sancion_fecha() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codera = $this->session->userdata('era');
        $data['titulo'] = "Sanciones";
        $fecha = $this->input->post('fecha');

        $data['sanciones'] = $this->modelo->listar_sanciones_fecha($codera, $fecha);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/ver_sanciones', $data);
        $this->load->view('plantilla/footer');
    }

    //----------------CARGA LA VISTA PARA REGISTRAR UNA NUEVA SANCION ------------------------//

    public function nueva_sancion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codera = $this->session->userdata('era');
        $cedula = $this->input->post();
        $data['avaluadores'] = $this->modelo->verificar_avaluador($cedula['cedula'], $codera);

        if ($data['avaluadores'] == false) {
            redirect('adminera/ver_sanciones');
        } else {
            $data['tipo_s'] = $this->modelo->listar_tipo_sancion();
            $data['comites'] = $this->modelo->listar_comite($codera);
            $data['titulo'] = "Registrar Sancion ";
            $this->load->view('plantilla/headeradminera', $data);
            $this->load->view('adminera/nueva_sancion', $data);
            $this->load->view('plantilla/footer');
        }
    }

    //--------------------REGISTRAR NUEVA SANCION-----------------------------//
    public function add_sancion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }

        $registros = $this->input->post();
        $fechareg = $registros['fecharegistro'];
        $fechafin = $registros['fechafin'];
        if ($fechareg > $fechafin) {
            $this->session->set_flashdata('incorrecto', 'La fecha fin de la sancion es antes de la del registro ');
            redirect('adminera/ver_sanciones');
        }

        $this->load->library('upload');
        $config['upload_path'] = './uploads/sanciones/';
        $config['allowed_types'] = 'pdf|doc';
        $config['remove_spaces'] = TRUE;
        $config['max_size'] = '2048000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('soporte')) {
            $datos = array('error' => $this->upload->display_errors());
            $codera = $this->session->userdata('era');
            $data['titulo'] = "Sanciones";
            $data['sanciones'] = $this->modelo->listar_sanciones($codera);
            $this->load->view('plantilla/headeradminera', $data);
            $this->load->view('adminera/ver_sanciones', $datos);
            $this->load->view('plantilla/footer');
        } else {
            $infosoporte = $this->upload->data();
            $registros = $this->input->post();
            $registros['soporte'] = $infosoporte['file_name'];
            $this->modelo->insertar_sancion($registros);
            $this->session->set_flashdata('correcto', 'Sancion registrada Correctamente');
            redirect('adminera/ver_sanciones', 'refresh');
        }
    }

    //---------------------OBTENER CODASANCION PARA VER DETALLE SANCION-------------------------------//
    public function obt_detalle_sancion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codsancion', $id);
        $codera = $this->session->userdata('era');
        $data['titulo'] = "Detalle Sancion";
        $data['registro'] = $this->modelo->detalle_sancion($id);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/detalle_sancion', $data);
        $this->load->view('plantilla/footer');
    }

    //---------------------OBTENER CODASANCION PARA EDITAR SANCION-------------------------------//
    public function obt_sancion_edit() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codsancion', $id);
        $codera = $this->session->userdata('era');
        $data['titulo'] = "Detalle Sancion";
        $data['registro'] = $this->modelo->detalle_sancion($id);
        $data['tipo_s'] = $this->modelo->listar_tipo_sancion();
        $data['comites'] = $this->modelo->listar_comite($codera);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/editar_sancion', $data);
        $this->load->view('plantilla/footer');
    }

    //------------------EDIAR UNA SANCION-----------------------------//
    public function actualizar_sancion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->session->userdata('codsancion');
        $registros = $this->input->post();
        $fechareg = $registros['fecharegistro'];
        $fechafin = $registros['fechafin'];
        if ($fechareg > $fechafin) {
            $this->session->set_flashdata('incorrecto', 'La fecha fin de la sancion es antes de la del registro ');
            redirect('adminera/ver_sanciones');
        }
        $nomsoporte = $_FILES['soporte']['name'];
        if (empty($nomsoporte)) {
            $registros = $this->input->post();
            $this->modelo->update_sancion($registros, $id);
//            echo "<pre>";
//            var_dump($registros);
//            echo "</pre>";
//            exit();
            $this->session->set_flashdata('correcto', 'Sancion Editada Correctamente');
            redirect('adminera/ver_sanciones', 'refresh');
        } else {
            $this->load->library('upload');
            $config['upload_path'] = './uploads/sanciones/';
            $config['allowed_types'] = 'pdf|doc';
            $config['remove_spaces'] = TRUE;
            $config['max_size'] = '2048000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('soporte')) {
                $data = array('error' => $this->upload->display_errors());
                $codera = $this->session->userdata('era');
                $id = $this->session->userdata('era');
                $data['titulo'] = "Detalle Sancion";
                $data['registro'] = $this->modelo->detalle_sancion($id);
                $data['tipo_s'] = $this->modelo->listar_tipo_sancion();
                $data['comites'] = $this->modelo->listar_comite($codera);
                $this->load->view('plantilla/headeradminera', $data);
                $this->load->view('adminera/editar_sancion', $data);
                $this->load->view('plantilla/footer');
            } else {
                $infosoporte = $this->upload->data();
                $registros = $this->input->post();
                $registros['soporte'] = $infosoporte['file_name'];
                $this->modelo->update_sancion($registros, $id);
                $this->session->set_flashdata('correcto', 'Sancion Editada Correctamente');
                redirect('adminera/ver_sanciones', 'refresh');
            }
        }
    }

    //--------------------ELIMINAR SANCION ------------------------///
    public function eliminar_sancion() {
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->modelo->delete_sancion($id);
        $this->session->set_flashdata('correcto', 'Sancion eliminada Correctamente');
        redirect('adminera/ver_sanciones', 'refresh');
    }

    // -----------OBTENER USUARIOS PARA EDITAR DESDE LA ERA (PENDIENTE)--------------//
    public function obt_usr_edit() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3)); //descifrado
        $this->session->set_userdata('codusr', $id);
        $datos['perfiles'] = $this->modelo->listar_perfiles();
        $datos['registro'] = $this->modelo->c_usr($id);
        $datos['estados'] = $this->modelo->listar_estados_usr();

        $data['titulo'] = "Actualiza Usuario";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminera/editar_usr', $datos);
        $this->load->view('plantilla/footer');
    }

    // -----------OBTENER USUARIO DE UN AVALUADOR--------------//
    public function obt_usr_ava() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3)); //descifrado
        $this->session->set_userdata('codusr', $id);
        $datos['perfiles'] = $this->modelo->listar_perfiles();
        $datos['registro'] = $this->modelo->c_usr_ava($id);
        if ($datos['registro'] == NULL) {
            $this->session->set_flashdata('noasignado', 'El avaluador no tiene asignado un usuario');
            redirect('adminera/obt_detalle_avaluador/' . $this->uri->segment(3));
        }
//        echo "<pre>";
//        var_dump($datos);
//        echo "</pre>";
//        exit();
        $data['titulo'] = "Actualiza Usuario";
        $this->load->view('plantilla/headeradmin', $data);
        $this->load->view('adminera/editar_usr_ava', $datos);
        $this->load->view('plantilla/footer');
    }

// -----------VER LOS USUARIOS DE UNA ERA--------------//
    function ver_usuarios() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codera = $this->session->userdata('era');
        $datos['codera'] = $codera;
        $datos['registro'] = $this->modelo->consulta_usuarios($codera);
        $data['titulo'] = "Usuarios";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/listar_usuarios', $datos);
        $this->load->view('plantilla/footer');
    }

    //---------------BUSCAR USUARIOS POR NOMBRE------------------------/// 
    public function bus_usr_nombre() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $nombre = $this->input->post('nombre');
        $codera = $this->session->userdata('era');
        $datos['registro'] = $this->modelo->c_usr_nombre($nombre, $codera);
        $data['estados'] = $this->modelo->listar_estados();
        $data['titulo'] = "Usuarios";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/listar_usuarios', $datos);
        $this->load->view('plantilla/footer');
    }

    //--------------------ELIMINAR USUARIO ------------------------///
    public function usr_eliminar() {
        $id = $this->cifrar->dec($this->uri->segment(3));
        $datos['usuarios'] = $this->modeloraa->c_usr($id);
        $this->modeloraa->delete_usr($datos);
        redirect('adminera/ver_usuarios');
    }

    // -----------ABRIL EL PANEL DE CONFIGURACIONES--------------//
    public function configuracion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $usuarioera = $this->session->userdata('codusuario');
        $data['usuario'] = $this->modelo->consulta_usuario_era($usuarioera);
        ;
        $data['titulo'] = "Configuracion";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/configuracion', $data);
        $this->load->view('plantilla/footer');
    }

    //--------------------ACTUALIZAR CONTRASEÑA DE  USUARIO QUE INICIA SESION ERA-----------------------------//
    public function upd_pass() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
        if ($this->modelo->verificar_pass($registros['codusuario'], md5($registros['claveanterior'])) == true) {
            if ($registros['clavenueva'] == $registros['clavenueva2']) {
                $this->modelo->actualizar_pass($registros['codusuario'], $registros);
                $this->session->set_flashdata('correcto', 'Clave Acualizada');
                redirect('adminera/configuracion');
            }
            $this->session->set_flashdata('incorrecto', 'No coinciden Las claves');
            redirect('adminera/configuracion');
        } else {
            redirect('adminera/configuracion');
        }
    }

    //--------------------ACTUALIZAR CONTRASEÑA DE  USUARIO DE UNA ERA-----------------------------//
    public function upd_pass_usr() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();

        if ($this->modelo->verificar_pass($registros['codusuario'], ($registros['claveanterior'])) == true) {
            if ($registros['clavenueva'] == $registros['clavenueva2']) {
                $this->modelo->actualizar_pass($registros['codusuario'], $registros);
                $this->session->set_flashdata('correcto', 'Clave Acualizada');
                $cusc = $this->cifrar->enc($registros['codusuario']);
                redirect('adminera/obt_usr_edit/' . $cusc);
            }
            $this->session->set_flashdata('incorrecto', 'No coinciden Las claves');
            $cusc = $this->cifrar->enc($registros['codusuario']);
            redirect('adminera/obt_usr_edit/' . $cusc);
        } else {
            $cusc = $this->cifrar->enc($registros['codusuario']);
            redirect('adminera/obt_usr_edit/' . $cusc);
        }
    }

    //--------------------ACTUALIZAR DATOS DE USUARIO ADMIN QUE INICIA SESSION -----------------------------//

    public function upd_usr() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $idusr = $this->session->userdata("codusuario");
        $registros['anterior'] = $this->modelo->consulta_usuario($idusr);
        $registros['nuevo'] = $this->input->post();
        if ($registros['anterior']->nombreusuario != $registros['nuevo']['nombreusuario']) {
            if ($this->modelo->verificar_usuarios_nom($registros['nuevo']['nombreusuario']) == true) {
                redirect('adminera/configuracion');
            }
            $this->modelo->upd_usr($idusr, $registros['nuevo']);
            $this->session->set_flashdata('correcto', 'Informacion actualizada correctamente.');
            redirect('adminera/configuracion');
        } else {
            $this->modelo->upd_usr($idusr, $registros['nuevo']);
            $this->session->set_flashdata('correcto', 'Informacion actualizada correctamente.');
            redirect('adminera/configuracion');
        }
    }

    //--------------------ACTUALIZAR DATOS DE UN USUARIO-----------------------------//

    public function update_usr() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }

        $registros = $this->input->post();
        $codusr = $this->session->userdata("codusr");
        $datos['registros'] = $this->modelo->c_usr($codusr);
        $datos['registronuevo'] = $this->input->post();

        if ($datos['registros']->nombreusuario != $datos['registronuevo']['nombreusuario']) {
            if ($this->modelo->verificar_usuarios_nom($registros['nombreusuario']) == TRUE) {
                redirect('adminera/ver_usuarios');
            }
        }

        $idusr = $this->session->userdata("codusr");
        $cusc = $this->cifrar->enc($idusr);
        $this->modelo->upd_usr($idusr, $registros);
        $this->session->set_flashdata('correcto', 'Usuario Actualizado Correctamente.');
        redirect('adminera/ver_usuarios');
    }

    //------------------------AGREGAR UN USUARIO A UNA ENTIDAD-----------------------//
    public function add_usr() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codera = $this->session->userdata('era');
        $registros = $this->input->post();
        $nombreusuario = $this->input->post('nombreusuario');
        $verificarnombre = $this->modelo->verificar_usuarios_nom($nombreusuario);
        if ($verificarnombre == true) {
            redirect('adminera/ver_usuarios/');
        }
        $registros['clave'] = md5($this->input->post('clave'));
        $registros['codestado'] = 1;
        $this->modelo->crear_usr($registros);
        $this->session->set_flashdata('correcto', 'Usuario creado');

        redirect('adminera/ver_usuarios');
    }

    //-----------------------ABRIR LA VISTA DE NUEVO REPORTE-----------------------//
    public function nuevo_reporte() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Reportes";
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/reportes/index');
        $this->load->view('plantilla/footer');
    }

    //-----------------------ABRIR LA VISTA DE TRASLADOS -----------------------//
    public function ver_traslados() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Traslados";
        $data['traslados'] = $this->modelo->traslados_realizados();
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/ver_traslados');
        $this->load->view('plantilla/footer');
    }

    //----------------CARGA LA VISTA PARA REGISTRAR UNA SOLICITUD DE TRASLADO ------------------------//
    public function nueva_soltraslado() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $codera = $this->session->userdata('era');
        $cedula = $this->input->post();
        $data['avaluadores'] = $this->modelo->verificar_avaluador($cedula['cedula'], $codera);

        if ($data['avaluadores'] == false) {
            redirect('adminera/ver_traslados');
        } else {
            $data['titulo'] = "Registrar Traslado ";
            $data['eras'] = $this->modelo->listar_eras_sol($codera);
            $this->load->view('plantilla/headeradminera', $data);
            $this->load->view('adminera/nueva_soltraslado', $data);
            $this->load->view('plantilla/footer');
        }
    }

    //------------------------AGREGAR UNA SOLICITUD DE TRASLADO-----------------------//
    public function add_soltraslado() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
        $numeroid = $this->input->post('numero_id');
        if ($this->modelo->verificar_ava_sol($numeroid) == TRUE) {
            redirect('adminera/ver_traslados');
        } else {
            $anterior = $this->modelo->c_avaluador($numeroid);
            $registros['soporte'] = $this->subir_soporte_solicitud();
            $this->modelo->add_soltras($registros, $anterior);
            redirect('adminera/ver_traslados');
        }
    }

    public function subir_soporte_solicitud() {
        $config['upload_path'] = './uploads/archivos/solicitud_traslado';
        $config['allowed_types'] = 'pdf|doc';
        $config['max_size'] = '2000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('soporte')) {
            $data = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('incorrecto', $data['error']);
            redirect('adminera/ver_traslados');
        } else {
            $infosoporte = $this->upload->data();
            return $infosoporte['file_name'];
        }
    }

    //----------------CARGA LA VISTA PARA VER LAS SOLICITUDES PENDIETES ENVIADAS DE TRASLADO ------------------------//
    public function ver_solicitudestras() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Ver solicitudes de traslado ";
        $data['eras'] = $this->modelo->listar_eras();
        $codera = $this->session->userdata('era');
        $data['soltraslados'] = $this->modelo->listar_soltraslados($codera);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/ver_solpendientes');
        $this->load->view('plantilla/footer');
    }

    //----------------CARGA LA VISTA PARA VER LAS SOLICITUDES ENVIADAS ------------------------//
    public function ver_solenviadas() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Solicitudes enviadas";
        $codera = $this->session->userdata('era');
        $data['soltraslados'] = $this->modelo->listar_solenviadas($codera);
        $this->load->view('plantilla/headeradminera', $data);
        $this->load->view('adminera/ver_solenviadas');
        $this->load->view('plantilla/footer');
    }

    //------------------------TRASLADAR DE ERA AVALUADOR-----------------------//
    public function traslado_ok() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));

        $data['solicitud'] = $this->modelo->listar_solic($id);
        $registros['anterior'] = $this->modelo->listar_infoera($data['solicitud']->coderasolicitante);
        $registros['nueva'] = $this->modelo->listar_infoera($data['solicitud']->coderasolicitada);
        if ($this->modelo->upd_traslado($data) == TRUE) {
            $this->modelo->insertar_traslado($registros, $data['solicitud']->codsolicitud, $data);
            $this->session->set_flashdata('correcto', 'Avaluador ahora pertenece a esta ERA');
            redirect('adminera/ver_solicitudestras');
        } else {
            $this->session->set_flashdata('incorrecto', 'Tenemos un problema con el traslado');
            redirect('adminera/ver_solicitudestras');
        }
    }

    //------------------------ RECHAZAR TRASLADO DE AVALUADOR-----------------------//
    public function traslado_no() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'adminera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));

        $data['solicitud'] = $this->modelo->listar_solic($id);

        if ($this->modelo->rechaz_traslado($data) == TRUE) {

            $this->session->set_flashdata('correcto', 'Fue rechazada la solicitud');
            redirect('adminera/ver_solicitudestras');
        } else {
            $this->session->set_flashdata('incorrecto', 'Tenemos un problema con el traslado');
            redirect('adminera/ver_solicitudestras');
        }
    }

}
