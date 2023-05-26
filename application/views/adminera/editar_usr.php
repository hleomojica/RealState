<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminera/ver_usuarios">Usuarios</a></li>
            <li class="active">Editar</li>
        </ol>
    </div>  
    <!---------------------------ASIDE------------------->
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">ERA</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                    <a href="<?php echo base_url() . "adminera/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                    <a href="<?php echo base_url() . "adminera/ver_comite" ?>" class="list-group-item ">Comite</a>
                    <a href="<?php echo base_url() . "adminera/ver_certificados" ?>" class="list-group-item ">Certificados</a>
                    <a href="<?php echo base_url() . "adminera/ver_sanciones" ?>" class="list-group-item ">Sanciones</a>
                    <a href="<?php echo base_url() . "adminera/ver_traslados" ?>" class="list-group-item ">Traslados</a>
                    <a href="<?php echo base_url() . "web-usuarios" ?>" class="list-group-item active">Usuarios</a>
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
                Eitar Usuarios
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
                <form action="<?php echo base_url() ?>adminera/update_usr" enctype="multipart/form-data" method="post">
                    <div class="form-group col-sm-6">
                        <label for="razon">Nombre de usuario</label>
                        <input type="text" class="form-control" id="razon" name="nombreusuario" value="<?= $registro->nombreusuario ?>"  required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Contraseña</label>
                        <span class="form-control-static">************</span>
                        <a target="_blank"  data-toggle="modal" data-target="#modelpass" class="btn btn-primary ">Cambiar</a>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="nombre">Nombres </label>
                        <input type="text" class="form-control" id="nombre" name="nombres" value="<?= $registro->nombres ?>" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="nombre">Correo </label>
                        <input type="text" class="form-control" id="nombre" name="correo" value="<?= $registro->correo ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="clase">Estado</label>
                        <select class="form-control" required="" name="codestado">

                            <?php
                            if ($estados) {
                                foreach ($estados as $row) {
                                    ?>
                                    <option value="<?= $row['codestado_usuarios'] ?>"><?= $row['nombre'] ?></option>
                                    <?php
                                }
                            } else {
                                echo"<option value='1'>No hay estados</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" value="3" name="codperfil"><!--  PERFIL 3 USUARIO ERA-->
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success centered">Guardar</button>
                    </div>
                </form>
            </div>

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
