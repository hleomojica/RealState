<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4') ?>"></script>
<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminraa/era">Entidades</a></li>
            <li class="active">Detalle</li>
        </ol>
    </div>  
    <!--------------------ASIDE--------------------->
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">Entidades ERA</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                    <a href="<?php echo base_url() . "adminraa/era" ?>" class="list-group-item active">Entidades ERA</a>
                    <a href="<?php echo base_url() . "adminraa/nueva_era" ?>" class="list-group-item ">Nueva ERA</a>
                   
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">AVALUADORES</div>
            <div class="panel-body">

                <div class="list-group">
                    <a href="<?php echo base_url() . "adminraa/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                    <a href="<?php echo base_url() . "adminraa/ver_categorias" ?>" class="list-group-item ">Categorias</a>
                    <a href="<?php echo base_url() . "adminraa/ver_categorias" ?>" class="list-group-item">Certificados</a>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <!------------------------/ASIDE--------------->
    <!------------------------/CONTENIDO CENTRAL-------------------------------->
    <div class="col-lg-9">
       
        <?php
        $incorrecto = $this->session->flashdata('incorrecto');
        $correcto = $this->session->flashdata('realizado');
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
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Menu</div>
                <div class="panel panel-body">

                    <div class="col-sm-2">
                        <a href="<?= base_url() ?>adminraa/obtener_editar/<?= $this->cifrar->enc($registro->codera) ?>" class="thumbnail">
                            <img class="icono" src="<?= base_url() ?>herramientas/images/editar_icono.png" alt="imagen">
                            <p contenteditable>Editar</p>
                        </a>
                    </div>

                    <div class="col-xs-2">
                        <a href="<?= base_url() ?>adminraa/obtener_usuarios/<?= $this->cifrar->enc($registro->codera) ?>" class="thumbnail">
                            <img class="icono" src="<?= base_url() ?>herramientas/images/usuarios_icono.png" alt="imagen">
                            <p contenteditable>usuarios</p>
                        </a>
                    </div>
                    <div class="col-xs-2">
                        <a data-href="<?= base_url() ?>adminraa/eliminar_era/<?= $this->cifrar->enc($registro->codera) ?>" data-toggle="modal" data-target="#confirm-delete" class="thumbnail" href="#">
                            <img class="icono" src="<?= base_url() ?>herramientas/images/icono_eliminar.png" alt="imagen">
                            <p contenteditable>Eliminar</p>
                        </a>

                    </div>
                </div>
            </div>
        </div>

        
            <div class="panel panel-body">
                 <h4><strong>Entidad Reconocida de Autoregulacion : <?= $registro->razonsocial_era ?></strong></h4> 
                 <form>

                    <div class="form-group col-sm-6">
                        <label for="razon">Razon Social</label>
                        <input type="text" class="form-control" id="razon" name="razonsocial_era" value="<?= $registro->razonsocial_era ?>" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nit">NIT </label>
                        <input type="text" class="form-control" id="nit" name="nit_era" value="<?= $registro->nit_era ?>" readonly="">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="nombre">Nombre Representante legal </label>
                        <input type="text" class="form-control" id="nombre" name="nombre_representante" value="<?= $registro->nombre_representante ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="nit">Tipo documento </label>
                        <select class="form-control"  value="<?= $registro->codtipo_documento ?>" readonly>
                            <option value="cc">Cedula</option>
                            <option value="ti">Documento</option>
                            <option value="pas">Pasaporte</option>

                        </select>
                    </div>
                    <div class="form-group col-sm-8">
                        <label for="cc">Numero de documento: </label>
                        <input type="text" class="form-control" id="cc" value="<?= $registro->numeroid_representante ?>" placeholder="Documento representante" readonly>
                    </div>
                    <div class="form-group col-sm-9">
                        <label for="direccion">Direccion Entidad: </label>
                        <input type="text" class="form-control" id="direccion" value="<?= $registro->direccion_era ?>" placeholder="Direccion Fisica" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="telefono">Telefono Entidad </label>
                        <input type="text" class="form-control" id="telefono" value="<?= $registro->telefono_era ?>" placeholder="Telfono" readonly>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="acto">Acto Administrativo </label>
                        <input type="text" class="form-control" id="acto" value="<?= $registro->acto_administrativo ?>" placeholder="Acto Administrativo de La entidad" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" value="<?= $registro->fecha_acto ?>" id="fecha" readonly>
                    </div>
                    <div class="form-group col-sm-6" >
                        <label for="fecha">Fecha registro </label>
                        <input type="date" id="txtfecha" value="<?= $registro->fecha_registro_raa ?>" class="form-control"  readonly/> 
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="nit">Estado </label>
                        <select class="form-control" required value="<?= $registro->codestado ?>" readonly>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                            <option value="3">Pendiente</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label for="nit">LOGO </label>
                        <div class="thumbnail">
                            <?php if ($registro->logo) { ?>
                                <img class="logo" src="<?= base_url() ?>uploads/imagenes/<?= $registro->logo ?>" alt="imagen">
                                <?php
                            } else {
                                echo "No ha subido Foto";
                            }
                            ?>
                            <div class="caption">
                                <p>...</p>
                            </div>
                        </div>
                    </div>

                </form>

            </div>    
      

    </div>
        <p><a class="btn  btn-default btn-lg" href="<?= base_url() ?>adminraa/era" >Volver</a></p>
    

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
                    Eliminar Entidad
                </div>
                <div class="modal-body">
                    ¿Esta seguro de Eliminar la Entidad?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
