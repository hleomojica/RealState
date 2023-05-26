<?php

Class Usuarioera extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model('usuarioeramodel', 'modelo');
        $this->load->model('admineramodel', 'modeloera');
        $this->load->library('cifrar');
    }

//-----------------CARGA EL INICIO  ------------------------/// 
    public function index() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'usuarioera') {
            redirect(base_url() . 'login');
        }
        $id = $this->session->userdata('numero_id');
        if ($id == NULL) {
            $datos['registro'] = "";
            $datos['titulo'] = 'Usuario ERA';
            $this->load->view('plantilla/headerusuarioera', $datos);
            $this->load->view('usuarioera/index_vacio', $datos);
            $this->load->view('plantilla/footer');
        } else {
            $datos['registro'] = $this->modeloera->c_avaluador($id);
            $datos['categorias'] = $this->modeloera->c_cat_ava($id);
            $datos['titulo'] = 'Usuario ERA';
            $this->load->view('plantilla/headerusuarioera', $datos);
            $this->load->view('usuarioera/index', $datos);
            $this->load->view('plantilla/footer');
        }
    }

    //-----------------LISTAR TODAS LAS ERA ------------------------/// 
    //-------------------RESPONDER SOLICITUD Y ACTUALIZARLA------------------------------// 
    public function nueva_solicitud() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'usuarioera') {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = "Nueva Solicitud";
        $this->load->view('plantilla/headerusuarioera', $data);
        $this->load->view('usuarioera/nueva_solicitud', $data);
        $this->load->view('plantilla/footer');
    }

    //-------------------RESPONDER SOLICITUD Y ACTUALIZARLA------------------------------// 
    public function ver_solicitudes() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'usuarioera') {
            redirect(base_url() . 'login');
        }
        $codava = $this->session->userdata('numero_id');
        $data['solicitudes'] = $this->modelo->solicitudes($codava);

        $data['titulo'] = "Solicitudes";
        $this->load->view('plantilla/headerusuarioera', $data);
        $this->load->view('usuarioera/ver_solicitudes', $data);
        $this->load->view('plantilla/footer');
    }

    //-------------------AGREGAR NUEVA SOLICITUD-----------------------------// 
    public function add_solicitud() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'usuarioera') {
            redirect(base_url() . 'login');
        }
        $codava = $this->session->userdata('numero_id');
        $data = $this->input->post();
        $data['numero_id'] = $codava;
        if ($this->modelo->insertar_solicitud($data)==TRUE) {
            $datos['datos'] = $this->modelo->list_correoadm($codava);
//                        echo "<pre>";
//            var_dump($datos['datos']->correo);
//            echo "</pre>";
//            exit();
             $this->enviar($datos['datos']->correo, $datos['datos']->nombres);
            $this->session->set_flashdata('correcto', 'Solicitud Enviada Correctamente');
               redirect('usuarioera/ver_solicitudes');

        }
//        
    }

    //------------------ENVIAR CORREO DE NUEVA SOLICITUD------------------------------// 
    public function enviar($correo, $nombre) {
        $this->load->library("email");

        //configuracion para gmail
        $configGmail = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'raagerenciaadm@gmail.com',
            'smtp_pass' => 'adminraa123456',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );

        //cargamos la configuración para enviar con gmail
        $this->email->initialize($configGmail);

        $this->email->from('noreply@gmail');
        $this->email->to($correo);
        $this->email->subject('Nueva solicitud pendiente');
        $this->email->message('<h3> Sistema de Registro Abierto a Avaluadores</h3><hr><h4>Solicitud</h4></br><p>Apreciado '.$nombre.' Acaba de llegar una nueva solicitud de un avaluador, porfavor revise el sistema para dar pronta respuesta</p>');
        if ($this->email->send()) {
            return TRUE;
//            $this->session->set_flashdata('correcto', 'Solicitud Enviada Correctamente');
//        redirect('usuarioera/ver_solicitudes');
        } else {
            return FALSE;
//            var_dump($this->email->print_debugger());
        }
        //con esto podemos ver el resultado
//          echo "<pre>";
//        var_dump($datos);
//        echo "</pre>";
//        exit();
    }

    //-------------------RESPONDER SOLICITUD Y ACTUALIZARLA------------------------------// 
    public function ver_sanciones() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'usuarioera') {
            redirect(base_url() . 'login');
        }
        $codava = $this->session->userdata('numero_id');
        $data['sanciones'] = $this->modelo->listar_sanciones($codava);
        $data['titulo'] = "Solicitudes";
        $this->load->view('plantilla/headerusuarioera', $data);
        $this->load->view('usuarioera/ver_sanciones', $data);
        $this->load->view('plantilla/footer');
    }

    //---------------------OBTENER CODASANCION PARA VER DETALLE SANCION-------------------------------//
    public function obt_detalle_sancion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'usuarioera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codsancion', $id);
        $data['titulo'] = "Detalle Sancion";
        $data['registro'] = $this->modeloera->detalle_sancion($id);
        $this->load->view('plantilla/headerusuarioera', $data);
        $this->load->view('usuarioera/detalle_sancion', $data);
        $this->load->view('plantilla/footer');
    }

    //---------------------OBTENER COD SOLICITUD PARA VER DETALLE SOLICITUD-------------------------------//
    public function obt_detalle_solicitud() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'usuarioera') {
            redirect(base_url() . 'login');
        }
        $id = $this->cifrar->dec($this->uri->segment(3));
        $this->session->set_userdata('codsolicitud', $id);
        $data['titulo'] = "Detalle Solicitud";
        $data['registro'] = $this->modelo->ver_detallesol($id);
        $this->load->view('plantilla/headerusuarioera', $data);
        $this->load->view('usuarioera/detalle_solicitud', $data);
        $this->load->view('plantilla/footer');
    }

// -----------ABRIL EL PANEL DE CONFIGURACIONES--------------//
    public function configuracion() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'usuarioera') {
            redirect(base_url() . 'login');
        }
        $codusuario = $this->session->userdata('codusuario');
        $data['usuario'] = $this->modelo->consulta_usuario($codusuario);
        $data['titulo'] = "Configuracion";
        $this->load->view('plantilla/headerusuarioera', $data);
        $this->load->view('usuarioera/configuracion', $data);
        $this->load->view('plantilla/footer');
    }

    //--------------------ACTUALIZAR DATOS DE UN USUARIO-----------------------------//

    public function upd_usr() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'usuarioera') {
            redirect(base_url() . 'login');
        }
        $idusr = $this->session->userdata("codusuario");
        $registros['anterior'] = $this->modelo->consulta_usuario($idusr);
        $registros['nuevo'] = $this->input->post();
        if ($registros['anterior']->nombreusuario != $registros['nuevo']['nombreusuario']) {
            if ($this->modelo->verificar_usuarios_nom($registros['nuevo']['nombreusuario']) == true) {
               
                redirect('usuarioera/configuracion');
            }
            $this->modelo->upd_usr($idusr, $registros['nuevo']);
            $this->session->set_flashdata('correcto', 'Informacion actualizada correctamente.');
            redirect('usuarioera/configuracion');
        } else {
            $this->modelo->upd_usr($idusr, $registros['nuevo']);
            $this->session->set_flashdata('correcto', 'Informacion actualizada correctamente.');
            redirect('usuarioera/configuracion');
        }
    }

    //--------------------ACTUALIZAR CONTRASEÑA DE  USUARIO ----------------------------//
    public function upd_pass() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'usuarioera') {
            redirect(base_url() . 'login');
        }

        $registros = $this->input->post();
//        echo "<pre>";
//        var_dump($registros);
//        echo "</pre>";
//        exit();
        if ($this->modelo->verificar_pass($registros['codusuario'], (md5($registros['claveanterior']))) == true) {
            if ($registros['clavenueva'] == $registros['clavenueva2']) {
                $this->modelo->actualizar_pass($registros['codusuario'], $registros);
                $this->session->set_flashdata('correcto', 'Cambio de clave correcto');
                redirect('usuarioera/configuracion');
            }
            $this->session->set_flashdata('incorrecto', 'No coinciden las claves');
            redirect('usuarioera/configuracion');
        } else {
            redirect('usuarioera/configuracion');
        }
    }

}
