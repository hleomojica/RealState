<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4.min.js') ?>"></script><!--
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4') ?>"></script>
<script src="<?php echo base_url('herramientas/bootstrap/js/bootstrap.min.js') ?>"></script>-->

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li class="active"><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
        </ol>
    </div>
</div>
<!-----------ASIDE------------>
<div class="col-sm-3">
    <div class="panel panel-primary">
        <div class="panel-heading">ERA</div>
        <div class="panel-body">
            <div class="list-group">
                <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                <a href="<?php echo base_url() . "usuarioera/ver_solicitudes" ?>" class="list-group-item ">Solicitudes</a>
                <a href="<?php echo base_url() . "usuarioera/ver_sanciones" ?>" class="list-group-item ">Sanciones</a>
                <hr>
                <a href="<?php echo base_url() . "usuarioera/configuracion" ?>" class="list-group-item active">Configuracion</a>
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
                <span class="form-control-static"><?= $usuario->nombres ?></span>
            </div>
            <div class="form-group col-sm-6">
                <label>Nombreusuario: </label>
                <span class="form-control-static"><?= $usuario->nombreusuario ?></span>
            </div>
            <div class="form-group col-sm-6">
                <label>Correo: </label>
                <span class="form-control-static"><?= $usuario->correo ?></span>
            </div>
            <div class="form-group col-sm-6">
                <label>Contraseña</label>
                <span class="form-control-static">**********</span>
                

            </div>
             <div class="form-group col-sm-12">
                <a target="_blank"  data-toggle="modal" data-target="#modelusr" class="btn btn-success ">Editar Informacion</a>
                 <a target="_blank"  data-toggle="modal" data-target="#modelpass" class="btn btn-primary ">Cambiar Contraseña</a>
             </div>
           
            
        </div>


        <script type="text/javascript">
            $(document).ready(function () {
                $('#confirm-delete').on('show.bs.modal', function (e) {
                    $(this).find('.success').attr('href', $(e.relatedTarget).data('href'));
                });
            });
        </script>


        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Certificados
                    </div>
                    <div class="modal-body">
                        Desea generar certificados?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="#" target="_blank"  onclick="window.location = '<?php echo base_url() . "adminera/nuevo_certificado_btn" ?>'" class="btn btn-success success">Generar</a>
                    </div>
                </div>
            </div>
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
            <form action="<?php echo base_url() ?>usuarioera/upd_pass" enctype="multipart/form-data" method="POST" name="formulario">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombres">Contraseña Anterior:</label>
                        <input type="password" class="form-control" name="claveanterior" id="exampleInputPassword1" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Nueva</label>
                        <input type="password" class="form-control" name="clavenueva" id="exampleInputPassword1" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreusuario">Repetir</label>
                        <input type="password" class="form-control" name="clavenueva2" id="exampleInputPassword1" required>
                    </div>
                    
                    <input type="hidden" value="<?= $usuario->codusuario ?>" name="codusuario">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cambiar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>

<!-----------MODAL PARA EDITAR USUARIO---------------------------->

<div class="modal fade" id="modelusr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar Informaion</h4>
            </div>
            <form action="<?php echo base_url() ?>usuarioera/upd_usr" enctype="multipart/form-data" method="POST" name="formulario">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <input type="text" class="form-control" name="nombres" value="<?= $usuario->nombres ?>" id="exampleInputPassword1" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" name="correo" value="<?= $usuario->correo ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreusuario">Nombre de Usuario</label>
                        <input type="text" class="form-control" name="nombreusuario" value="<?= $usuario->nombreusuario ?>" required>
                    </div>
                    
                    <input type="hidden" value="<?= $usuario->codusuario ?>" name="codusuario">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cambiar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>




