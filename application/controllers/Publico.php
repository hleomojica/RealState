<?php

class Publico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model('publicomodel', 'modelo');
        $this->load->model('avaluadormodel', 'modeloavaluador');
        $this->load->model('certificadomodel', 'modelocertificado');
    }

    //----------------------ENVIAR CORREO DE RECUPERACION DE CONTRASEÑA-----------------------/// 
    public function mailito() {
        $datos = $this->input->post();
        $verificar = $this->modelo->verificar($datos['nombreusuario'], $datos['correo']);
        if ($verificar == TRUE) {
            $nuevaclave = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
            $codusuario = $verificar->codusuario;
            $registros['clave'] = md5($nuevaclave);
            if (!$this->modelo->actualizar_pass($codusuario, $registros)) {
                $this->enviar($datos['correo'], $nuevaclave);
            } else {
                $this->session->set_flashdata('incorrecto', 'No esta actualziando.');
                redirect('login', 'refresh');
            }
        } else {
            $this->session->set_flashdata('incorrecto', 'Datos Incorrectos');
            redirect('login', 'refresh');

//              echo "<pre>";
//        echo 'CORREO NO EXISTE EN EL SISTEMA';
//        echo "</pre>";
//        exit(); 
        }

        //cargamos la libreria email de ci
    }

    public function enviar($correo, $nuevaclave) {
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
        $this->email->subject('Reestablecer contrasena');
        $this->email->message('<h3>El Sistema de Registro Abierto a Avaluadores</h3><hr><h4>Reestrableer contraseña</h4></br><p>Apreciado Usuario su nueva clave es:' . $nuevaclave . ' por favor ingrese y cambiela de inmediato</p>');
        if ($this->email->send()) {
            $this->session->set_flashdata('correcto', 'Revisa tu correo para cambiar la clave');
            redirect('login', 'refresh');
        } else {
            var_dump($this->email->print_debugger());
        }
        //con esto podemos ver el resultado
//          echo "<pre>";
//        var_dump($datos);
//        echo "</pre>";
//        exit();
    }

    //------------------------ME CARGA LA VISTA PUBLICA DE REGISTRO DE AVALUADOR-----------------------/// 

    public function consulta_certificado() {
        $pin = $this->uri->segment(2);
        $data['registro'] = $this->modelo->consulta_certificado($pin);
        if($data['registro']==NULL){
        $data['titulo'] = "Consulta Certificado";
        $this->load->view('plantilla/headerpublico', $data);
        $this->load->view('publico/consulta_certificadosnull', $data);
        $this->load->view('plantilla/footer'); 
        }  else {
             $data['titulo'] = "Consulta Certificado";
        $this->load->view('plantilla/headerpublico', $data);
        $this->load->view('publico/consulta_certificados', $data);
        $this->load->view('plantilla/footer');
        }

    }

    //----------------------ABRIR MODULO CONSULTAS-------------------------------// 
//------------------------ME CARGA LA VISTA PUBLICA DE REGISTRO DE AVALUADOR-----------------------/// 

    public function nuevo_avaluador() {

        $data['eras'] = $this->modelo->listar_era();
        $data['categorias'] = $this->modeloavaluador->ver_categorias();
        $data['estados'] = $this->modelo->listar_estados();
        $data['tipodoc'] = $this->modelo->listar_tipodocumento();
        $data['titulo'] = "Nuevo Avaluador";


        $this->load->view('inicio/nuevo_avaluador', $data);
    }

    //----------------------ABRIR MODULO CONSULTAS-------------------------------//  
    public function consultas() {
        $data['titulo'] = "Consultas";
        $this->load->view('inicio/nuevo_avaluador', $data);
    }

    //-----------------------REGISTRAR SOLICITUD DE AVALUADOR-------------------------------//  
    public function add_solicitud() {
        $this->load->library('upload');
        $nomfoto = $_FILES['foto']['name'];
        $nomsoporte = $_FILES['soporte']['name'];

        if (empty($nomfoto) && empty($nomsoporte)) {
            $registros = $this->input->post();


            $ulti = $this->modelo->add_avaluador_sol($registros);
            echo "<pre>";
            var_dump($ulti);
            echo "</pre>";
            exit();
            redirect('adminera/ver_avaluadores');
        } else if (!empty($nomfoto) && empty($nomsoporte)) {
            $config['upload_path'] = './uploads/imagenes/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '300';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $datos = array('error' => $this->upload->display_errors());
                $id = $this->session->userdata("codava");
                $datos['registro'] = $this->modelo->c_avaluador($id);
                $data['titulo'] = "Editar Avaluador";
                $this->load->view('plantilla/headeradminera', $data);
                $this->load->view('adminera/editar_avaluador', $datos);
                $this->load->view('plantilla/footer');
            } else {
                $infoto = $this->upload->data();
                $registros = $this->input->post();
                $registros['codera'] = $this->session->userdata('era');
                $registros['foto'] = $infoto['file_name'];
                $this->modelo->add_avaluador($registros);
                redirect('adminera/ver_avaluadores');
                exit();
            }
        } else {
            $config['upload_path'] = './uploads/archivos/';
            $config['allowed_types'] = 'pdf|doc';
            $config['max_size'] = '1000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('soporte')) {
                $datos = array('error' => $this->upload->display_errors());
                $id = $this->session->userdata("codava");
                $datos['registro'] = $this->modelo->c_avaluador($id);
                $data['titulo'] = "Editar Avaluador";
                $this->load->view('plantilla/headeradminera', $data);
                $this->load->view('adminera/editar_avaluador', $datos);
                $this->load->view('plantilla/footer');
            } else {
                $infosoporte = $this->upload->data();
                $registros = $this->input->post();
                $registros['soporte'] = $infosoporte['file_name'];
                $registros['codera'] = $this->session->userdata('era');
                $this->modelo->add_avaluador($registros);
                redirect('adminera/ver_avaluadores');
            }
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

}
