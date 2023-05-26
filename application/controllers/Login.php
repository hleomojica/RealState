<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url', 'form'));
        $this->load->database('default');
    }

    // =============== FUNCION VERIFICA SI YA SE INICIO SESSION Y REDIRECCIONA=======================================//
    public function index() {
        if ($this->uri->segment(3)) {
            $this->session->set_flashdata('userlog', 'Acaba de iniciar sesion en otro equipo.');
        }
        switch ($this->session->userdata('perfil')) {
            case '':
                $data['token'] = $this->token();
                $data['titulo'] = 'Sistema de Registro Abierto';
                $this->load->view('inicio/login', $data);
                break;
            case 'adminraa':
                redirect(base_url() . 'adminraa');
                break;
            case 'adminera':
                redirect(base_url() . 'adminera');
                break;
            case 'entecontrol':
                redirect(base_url() . 'entecontrol');
                break;
            case 'usuarioera':
                redirect(base_url() . 'usuarioera');
                break;
            default:
                $data['titulo'] = 'INICIAR SESION ';
                $this->load->view('inicio/login', $data);
                break;
        }
    }

    public function iniciar_session() {
        if ($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')) {
            $username = $this->input->post('usuario');
            $password = md5($this->input->post('clave'));
            $usr = $this->loginmodel->nom_usr($username);
            if ($usr == true) {
                 $intentos = $this->loginmodel->c_intentos($usr->codusuario);
                 if($intentos->cantidad>=3){
                 $this->loginmodel->update_usr_estado($usr->codusuario);
                $this->session->set_flashdata('incorrecto', 'EL USUARIO HA SIDO BLOQUEDO POR SEGURIDAD ENVIE UN CORREO A : raagerenciaadm@gmail.com PARA REACTIVAR SU USUARIO');
                redirect(base_url() . 'login');
              }
               }
           
            $verificar = $this->loginmodel->login_user($username, $password);
          if ($verificar == TRUE) {
             if($intentos->cantidad<=2){
                 $this->loginmodel->eliminar_intentos($usr->codusuario);
                 }
                if ($verificar->codestado == 2) {
                    $this->session->set_flashdata('incorrecto', 'El usuario se encuentra Inactivo');
                    redirect(base_url() . 'login');
                }
                if ($userlog = $this->loginmodel->userlogv($verificar->codusuario)) {
                    $datos['token'] = $this->input->post('token');
                    $coduserlog = $userlog->coduserlog;
                    $this->loginmodel->update_userlog($coduserlog, $datos);
                    $data = array(
                        'log' => TRUE,
                        'codusuario' => $verificar->codusuario,
                        'perfil' => $verificar->perfil,
                        'usuario' => $verificar->nombreusuario,
                        'era' => $verificar->codera,
                        'nombres' => $verificar->nombres,
                        'razon_era' => $verificar->razonsocial_era,
                        'logo' => $verificar->logo,
                        'numero_id' => $verificar->numero_id
                    );
                    $this->session->set_userdata($data);
                    $this->index();
                } else {
                    $datos['codusuario'] = $verificar->codusuario;
                    $datos['token'] = $this->input->post('token');
                    $this->loginmodel->insert_userlog($datos);
                    $data = array(
                        'log' => TRUE,
                        'codusuario' => $verificar->codusuario,
                        'perfil' => $verificar->perfil,
                        'usuario' => $verificar->nombreusuario,
                        'era' => $verificar->codera,
                        'nombres' => $verificar->nombres,
                        'razon_era' => $verificar->razonsocial_era,
                        'logo' => $verificar->logo,
                        'numero_id' => $verificar->numero_id
                    );
                    $this->session->set_userdata($data);
                    $this->index();
                }
            } else {
                $username = $this->input->post('usuario');
                $usr = $this->loginmodel->nom_usr($username);
                if ($usr == true) {
                    $data['codusuario'] = $usr->codusuario;
                    $this->loginmodel->insertar_intento($data);
//                     
//                    echo '<pre>';
//                    echo var_dump($usr);
//                    echo '</pre>';
//                    exit();
                }
                redirect(base_url() . 'login');
            }
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function logout() {
        $cod = $this->session->userdata('codusuario');
        $this->session->sess_destroy();
//        $this->session->set_flashdata('incorrecto', 'Los datos introducidos son incorrectos');
        redirect(base_url() . 'login');
    }

    public function token() {
        $token = md5(uniqid(rand(), true));
        $this->session->set_userdata('token', $token);
        return $token;
    }

}
