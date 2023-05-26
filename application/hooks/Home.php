<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
        !$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
        !$this->ci->load->model('loginmodel') ? $this->ci->load->model('loginmodel') : false;
    }

    public function check_login() {
        if ($verificar = $this->ci->loginmodel->userlogv($this->ci->session->userdata('codusuario'))) {
            $token1 = $verificar->token;
            $token2 = $this->ci->session->userdata('token');
            if ($token1 != $token2) {
                $this->ci->session->sess_destroy();
                $this->ci->session->set_flashdata('incorrecto', 'Ya inicio sesion en otro equipo');
                redirect(base_url('login/index/as'));
            }
        }
    }

}
