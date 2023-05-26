<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminera/ver_avaluadores">Avaluadores</a></li>
            <li class="active"><a href="#">Perfil</a></li>
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
                    <a href="<?php echo base_url() . "adminera/ver_usuarios" ?>" class="list-group-item ">Usuarios</a>
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
            <?php
            $noasignado = $this->session->flashdata('noasignado');

            if ($noasignado) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Error!</strong> <?= $noasignado ?>.
                    <a target="_blank"  data-toggle="modal" data-target="#modelpass" class="btn btn-danger btn-small">Asignar</a> 
                </div>
                <?php
            }
            ?>
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
            <div class="panel-heading">
                Avaluador : <?= $registro->nombres ?>
            </div>
            <div class="panel panel-body">
                <div class="col-sm-12">

                    <div class="col-sm-2">
                        <a href="<?= base_url() ?>adminera/obt_ava_edit/<?= $this->cifrar->enc($registro->numero_id) ?>" class="thumbnail">
                            <img class="icono" src="<?= base_url() ?>herramientas/images/editar_icono.png" alt="imagen">
                            <p contenteditable>Editar</p>
                        </a>
                    </div>

                    <div class="col-sm-2">
                        <a data-href="<?= base_url() ?>adminera/inactivar_av/<?= $this->cifrar->enc($registro->numero_id) ?>" data-toggle="modal" data-target="#confirm-delete" class="thumbnail" href="#">
                            <img class="icono" src="<?= base_url() ?>herramientas/images/inactivo.jpg" alt="imagen">
                            <p contenteditable>Inactivar</p>
                        </a>
                    </div>
                    <div class="col-sm-2">
                        <a href="<?= base_url() ?>adminera/obt_usr_ava/<?= $this->cifrar->enc($registro->numero_id) ?>" class="thumbnail">
                            <img class="icono" src="<?= base_url() ?>herramientas/images/usuario.png" alt="imagen">
                            <p contenteditable>Usuario</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="panel panel-body">
                <form>
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <?php if ($registro->foto) { ?>
                                    <img class="imgperfil" src="<?= base_url() ?>uploads/imagenes/<?= $registro->foto ?>" alt="imagen">
                                    <?php
                                } else {
                                    echo "No ha subido Foto";
                                }
                                ?>

                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Nombre: </label>
                            <span class="form-control-static"><?= $registro->nombres ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Apellidos: </label>
                            <span class="form-control-static"><?= $registro->apellidos ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Tipo documento: </label>
                            <span class="form-control-static"><?= $registro->tipodocumento ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Numero Documento: </label>
                            <span class="form-control-static"><?= $registro->cedula ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Fecha Expedicion: </label>
                            <span class="form-control-static"><?= $registro->fechaex_id ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Codigo Avaluador </label>
                            <span class="form-control-static"><?= $registro->codigoavaluador ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>domicilio: </label>
                            <span class="form-control-static"><?= $registro->domicilio ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Telefono: </label>
                            <span class="form-control-static"><?= $registro->telefono ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Telefono Celular: </label>
                            <span class="form-control-static"><?= $registro->celular ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Fecha Inscripcion: </label>
                            <span class="form-control-static"><?= $registro->fechainscripcion ?></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Fecha Vencimiento: </label>
                            <span class="form-control-static"><?= $registro->fechavencimiento ?></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Tarjeta Profesional: </label>
                            <span class="form-control-static"><?= $registro->tarjetaprofesional ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Estado: </label>
                            <span  class="<?php
                            if ($registro->estado == 'Activo') {
                                echo 'verde';
                            } else {
                                echo 'rojo';
                            }
                            ?>"><strong><?= $registro->estado ?></strong></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Categorias: </label>
                            <?php
                            if ($categorias) {
                                foreach ($categorias as $row) {
                                    ?>
                                    <span class="form-control-static"><?= $row['nombre'] ?></span>,
                                    <?php
                                }
                            } else {
                                echo"<option value='1'>No tiene categoria</option>";
                            }
                            ?>


                        </div>
                        <div class="form-group col-sm-6">
                            <label for="fecha">Registro de Industria</label>
                            <span class="form-control-static"><?= $registro->regindustria ?></span>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="fecha">Hoja de vida:</label>
                            <?php if ($registro->soporte) { ?>
                                <a target="_blank" href="<?= base_url() ?>uploads/archivos/hojas_vida/<?= $registro->soporte ?>">Hoja de vida</a>
                                <?php
                            } else {
                                echo "No ha Subido Hoja de vida";
                            }
                            ?>

                        </div>
                        <div class="form-group col-sm-6">
                            <label for="fecha">Formato de solicitud:</label>
                            <?php if ($registro->formato_solicitud) { ?>
                                <a target="_blank" href="<?= base_url() ?>uploads/archivos/solicitudes/<?= $registro->formato_solicitud ?>">Ver formato de solicitud</a>
                                <?php
                            } else {
                                echo "No ha subido formato de solicitud";
                            }
                            ?>

                        </div>
                        <div class="form-group col-sm-6">
                            <label>ERA: </label>
                            <span class="form-control-static"><?= $registro->era ?></span>
                        </div>

                    </div>

                </form>

            </div>    
        </div>
        <ul class="pager">
            <li class="previous">
                <a href="<?php echo base_url() ?>adminera/ver_avaluadores"><span class="label label-default"></span>&larr; Atras</a>

            </li>
            <li class="next">
                <a href="#">Adelante &rarr;</a>
            </li>
        </ul>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        $('#confirm-delete').on('show.bs.modal', function (e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Inactivar Avaluador
            </div>
            <div class="modal-body">
                ¿Desea inactivar Avaluador del Sistema?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger">Inactivar</a>
            </div>
        </div>
    </div>
</div>



<!----------- /MODALES PARA NUEVO USUARIO----------------------------->
<div class="modal fade" id="modelpass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Asignar Usuarios a ERA</h4>
            </div>
            <form action="<?php echo base_url() ?>adminera/add_usr_ava" enctype="multipart/form-data" method="POST" name="formulario">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" name="nombres" id="exampleInputPassword1" value="<?= $registro->nombres . " " . $registro->apellidos ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" name="correo" id="exampleInputPassword1" value="<?= $registro->correo ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreusuario">Nombre de Usuario</label>
                        <input type="text" class="form-control" name="nombreusuario" id="exampleInputPassword1" value="<?= $registro->cedula ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="clave">Clave</label>
                        <input type="password" class="form-control" name="clave" id="clave" required>
                    </div>
                    <input type="hidden" value="<?= $registro->numero_id ?>" name="numero_id">
                    <input type="hidden" value="<?= $this->session->userdata('era'); ?>" name="codera">
                    <input type="hidden" value="3" name="codperfil"><!--  PERFIL 3 USUARIO ERA-->
                    <input type="hidden" value="1" name="codestado"><!--  ESTADO 1 ACTIVO-->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>