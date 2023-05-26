<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminera/ver_avaluadores">Avaluadores</a></li>
            <li><a href="<?php echo base_url() ?>adminera/obt_detalle_avaluador/<?= $this->cifrar->enc($this->session->userdata("codava")) ?>">Perfil</a></li>
            <li class="active">Usuario</li>
        </ol>
    </div>  
    <!---------------------------ASIDE------------------->
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">ERA</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                    <a href="<?php echo base_url() . "adminera/ver_avaluadores" ?>" class="list-group-item active">Avaluadores</a>
                    <a href="<?php echo base_url() . "adminera/ver_comite" ?>" class="list-group-item ">Comite</a>
                    <a href="<?php echo base_url() . "adminera/ver_certificados" ?>" class="list-group-item ">Certificados</a>
                    <a href="<?php echo base_url() . "adminera/ver_sanciones" ?>" class="list-group-item ">Sanciones</a>
                    <a href="<?php echo base_url() . "adminera/ver_traslados" ?>" class="list-group-item ">Traslados</a>
                    <a href="<?php echo base_url() . "web-usuarios" ?>" class="list-group-item ">Usuarios</a>
                    <hr>
                    <a href="<?php echo base_url() . "adminera/configuracion" ?>" class="list-group-item">Configuración</a>
                </div>
            </div>
        </div>
    </div>

    <!-----------------------/ASIDE----------->
    <!------------------------/CONTENIDO CENTRAL-------------------------------->
    <div class="col-lg-9">
       <div class="panel panel-primary">
        <div class="panel-heading">
            Configuracion de Usuario
        </div>
        <div class="panel-body">
<?php
            $incorrecto = $this->session->flashdata('incorrecto');
            $correcto = $this->session->flashdata('correcto');
            if ($incorrecto) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Error!</strong> <?= $incorrecto ?>.
                </div>
                <?php
            } else if ($correcto) {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Exito!</strong> <?= $correcto ?>
                </div>
                <?php
            }
            ?>
            <div class="form-group col-sm-6">
                <label>Nombre: </label>
                <span class="form-control-static"><?= $registro->nombres ?></span>
            </div>
            <div class="form-group col-sm-6">
                <label>Nombreusuario: </label>
                <span class="form-control-static"><?= $registro->nombreusuario ?></span>
            </div>
            <div class="form-group col-sm-6">
                <label>Correo: </label>
                <span class="form-control-static"><?= $registro->correo ?></span>
            </div>
            <div class="form-group col-sm-6">
                <label>Contraseña</label>
                <span class="form-control-static">********</span>
           </div>
            <div class="form-group col-sm-12">
                <a href="<?= base_url() ?>adminera/obt_usr_edit/<?= $this->cifrar->enc($registro->codusuario) ?>" class="btn btn-success">Editar</a>
            </div>
            
        </div>


        <script type="text/javascript">
            $(document).ready(function () {
                $('#confirm-delete').on('show.bs.modal', function (e) {
                    $(this).find('.success').attr('href', $(e.relatedTarget).data('href'));
                });
            });
        </script>


       


    </div>   

    </div>
</div>



<!-----------MODAL PARA CAMBIAR CONTRASEÑA---------------------------->

<div class="modal fade" id="modelpass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cambiar Contraseña</h4>
            </div>
            <form action="<?php echo base_url() ?>adminera/upd_pass_usr" enctype="multipart/form-data" method="POST" name="formulario">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="correo">Nueva</label>
                        <input type="password" class="form-control" name="clavenueva" id="exampleInputPassword1" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreusuario">Repetir</label>
                        <input type="password" class="form-control" name="clavenueva2" id="exampleInputPassword1" required>
                    </div>

                    <input type="hidden" value="<?= $registro->codusuario ?>" name="codusuario">
                    <input type="hidden" value="<?= $registro->clave ?>" name="claveanterior">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cambiar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>
