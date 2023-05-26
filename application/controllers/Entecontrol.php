<?php

class Entecontrol extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->library('codificar');
        $this->load->model('entecontrolmodel', 'modelo');
        $this->load->model('adminraamodel', 'modeloraa');
        $this->load->model('avaluadormodel', 'modeloavaluador');
        $this->load->model('admineramodel', 'modeloera');
        $this->load->library('cifrar');
    }

    //=============== FUNCION CARGAR LA VISTA DE INICIO DEL MODULO ENTECONTROL  =====================//
    public function index() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = 'Bienvenido';
        $data['era'] = $this->modeloraa->contar_era();
        $data['avaluadores'] = $this->modeloraa->contar_avaluadores();
        $data['usuarios'] = $this->modeloraa->contar_usuarios();
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/index', $data);
        $this->load->view('plantilla/footer');
    }

    //-- -----------LISTA TODAS LAS ERA-----------//
    public function era() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $data['eras'] = $this->modeloraa->listar_era();


        $data['titulo'] = "Listado de ERA";
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/listar_era', $data);
        $this->load->view('plantilla/footer');
    }

    //------------ OBTIENE EL CODIGO DE UNA ERA PARA VER EL DETALLE--------- /

    public function obtener_detalle_era() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $datos['registro'] = $this->modeloraa->consulta_era($id);
        $data['titulo'] = "Ver detalles de entidad";
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/detalle_era', $datos);
        $this->load->view('plantilla/footer');
    }

    //-------------------------------ME LISTA TODOS LOS AVALUADORES -------------------------------//
    public function ver_avaluadores() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $data['avaluadores'] = $this->modeloavaluador->ver_avaluadores();
        $data['estados'] = $this->modeloera->listar_estados();
        $data['titulo'] = "Listado de avaluadores";
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/listar_avaluadores', $data);
        $this->load->view('plantilla/footer');
    }

    //-------------------------------LISTA AVALUADORES POR ESTADO -------------------------------//
    public function bus_ava_estado() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $codestado = $this->input->post('codestado');
        if (!empty($codestado)) {
            $data['avaluadores'] = $this->modeloavaluador->c_avaluador_estado($codestado);
            $data['estados'] = $this->modeloera->listar_estados();
            $data['titulo'] = "Listado de avaluadores";
            $this->load->view('plantilla/headerente', $data);
            $this->load->view('entecontrol/listar_avaluadores', $data);
            $this->load->view('plantilla/footer');
        } else {
            $this->ver_avaluadores();
        }
    }

    //---------------BUSCAR  AVALUADORES NOMBRE DE LA ERA QUE INICIOS SESSION------------------------/// 
    public function bus_ava_nombre() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $nombre = $this->input->post('nombre');
        $data['avaluadores'] = $this->modeloavaluador->c_avaluador_nombre($nombre);
        $data['estados'] = $this->modeloera->listar_estados();
        $data['titulo'] = "Listado de avaluadores";
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/listar_avaluadores', $data);
        $this->load->view('plantilla/footer');
    }

    //-------------------------OBT CODIGO APRA VER UN AVALUADOR -------------------------------//  
    public function obt_detaller_avaluador() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $datos['registro'] = $this->modeloavaluador->c_avaluador($id);
        $data['categorias'] = $this->modeloera->c_cat_ava($id);
        $data['titulo'] = "Ver perfil Avaluador";
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/perfil_avaluador', $datos);
        $this->load->view('plantilla/footer');
    }

    //--------------------------ME LISTA TODAS LAS CATEGORIAS -------------------------------//
    public function ver_categorias() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $data['categorias'] = $this->modeloavaluador->ver_categorias();
        $data['estados'] = $this->modeloera->listar_estados();
        $data['titulo'] = "Listado de Categorias";
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/listar_categorias', $data);
        $this->load->view('plantilla/footer');
    }

    // -----------LISTAR TODOS LOS CERTIFICADOS GENERADOS--------------//

    public function ver_certificados() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Editar Avaluador";
        $data['certificados'] = $this->modeloera->listar_todos_certificado();
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/ver_certificados', $data);
        $this->load->view('plantilla/footer');
    }

    //------------------ABRIR PANEL SANCIONES-----------------------------// 

    public function ver_sanciones() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $codera = $this->session->userdata('era');
        $data['titulo'] = "Sanciones";
        $data['sanciones'] = $this->modeloraa->listar_sanciones();
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/ver_sanciones', $data);
        $this->load->view('plantilla/footer');
    }

    //---------------------OBTENER CODASANCION PARA VER DETALLE SANCION-------------------------------//
    public function obt_detalle_sancion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codsancion', $id);
        $data['titulo'] = "Detalle Sancion";
        $data['registro'] = $this->modeloera->detalle_sancion($id);
//        echo "<pre>";
//        var_dump($data);
//        echo "</pre>";
//        exit();
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/detalle_sancion', $data);
        $this->load->view('plantilla/footer');
    }

    //-----------------------ABRIR LA VISTA DE TRASLADOS -----------------------//
    public function ver_traslados() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Traslados";
        $data['traslados'] = $this->modeloera->traslados_realizados();
//                        echo "<pre>";
//        var_dump($data);
//        echo "</pre>";
//        exit();
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/ver_traslados');
        $this->load->view('plantilla/footer');
    }

    // -----------ABRIL EL PANEL DE CONFIGURACIONES--------------//
    public function configuracion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $usuarioera = $this->session->userdata('codusuario');
        $data['usuario'] = $this->modeloera->consulta_usuario_era($usuarioera);
        $data['titulo'] = "Configuracion";
        $this->load->view('plantilla/headerente', $data);
        $this->load->view('entecontrol/configuracion', $data);
        $this->load->view('plantilla/footer');
    }

    //--------------------ACTUALIZAR DATOS DE USUARIO ADMIN QUE INICIA SESSION -----------------------------//

    public function upd_usr() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $idusr = $this->session->userdata("codusuario");
        $registros['anterior'] = $this->modeloera->consulta_usuario($idusr);
        $registros['nuevo'] = $this->input->post();
        if ($registros['anterior']->nombreusuario != $registros['nuevo']['nombreusuario']) {
            if ($this->modeloera->verificar_usuarios_nom($registros['nuevo']['nombreusuario']) == true) {
                redirect('entecontrol/configuracion');
            }
            $this->modelo->upd_usr($idusr, $registros['nuevo']);
            $this->session->set_flashdata('correcto', 'Informacion actualizada correctamente.');
            redirect('entecontrol/configuracion');
        } else {
            $this->modelo->upd_usr($idusr, $registros['nuevo']);
            $this->session->set_flashdata('correcto', 'Informacion actualizada correctamente.');
            redirect('entecontrol/configuracion');
        }
    }

    //--------------------ACTUALIZAR CONTRASEÑA DE  USUARIO QUE INICIA SESION ERA-----------------------------//
    public function upd_pass() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'entecontrol') {
            redirect(base_url() . 'login');
        }
        $registros = $this->input->post();
//        echo "<pre>";
//            var_dump($registros);
//            echo "</pre>";
//            exit();
        if ($this->modeloera->verificar_pass($registros['codusuario'], md5($registros['claveanterior'])) == true) {
            if ($registros['clavenueva'] == $registros['clavenueva2']) {
                $this->modelo->actualizar_pass($registros['codusuario'], $registros);
                $this->session->set_flashdata('correcto', 'Clave Acualizada');
                redirect('entecontrol/configuracion');
            }
            $this->session->set_flashdata('incorrecto', 'No coinciden Las claves');
            redirect('entecontrol/configuracion');
        } else {
            redirect('entecontrol/configuracion');
        }
    }

}
