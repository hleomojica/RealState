<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4') ?>"></script>
<script src="<?php echo base_url('herramientas/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4.min.js') ?>"></script>


<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>entecontrol/ver_sanciones">Sanciones</a></li>
            <li>Detalle</li>

        </ol>
    </div>  
   <!--------------------ASIDE--------------------->
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">Sistema</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                    <a href="<?php echo base_url() . "entecontrol/era" ?>" class="list-group-item ">Entidades ERA</a>
                    <a href="<?php echo base_url() . "entecontrol/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                    <a href="<?php echo base_url() . "entecontrol/ver_categorias" ?>" class="list-group-item ">Categorias Avaluadores</a>
                    <a href="<?php echo base_url() . "entecontrol/ver_certificados" ?>" class="list-group-item">Certificados</a>
                    <a href="<?php echo base_url() . "entecontrol/ver_traslados" ?>" class="list-group-item">Traslados</a>
                     <a href="<?php echo base_url() . "entecontrol/ver_sanciones" ?>" class="list-group-item active">Sanciones</a>
                </div>
            </div>
        </div>
        
        <hr>
    </div>
    <!------------------------/ASIDE--------------->
    <!------------------------/CONTENIDO CENTRAL-------------------------------->
    <div class="col-lg-9">

        <div class="panel panel-primary">

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
                <?php
                if ($registro) {
                    ?>
                    Sancion realizada el:<?= $registro[0]['fecharegistro'] ?>


                </div>
                <div class="panel panel-body">
                    <div class="row">
                         <div class="form-group col-sm-4">
                            <label>Fecha Registro: </label>
                            <span class="form-control-static"><?= $registro[0]['fecharegistro'] ?></span>
                        </div>
                         <div class="form-group col-sm-4">
                            <label>Fecha Fin: </label>
                            <span class="form-control-static"><?= $registro[0]['fechafin'] ?></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Tipo: </label>
                            <span class="form-control-static"><?= $registro[0]['tipo'] ?></span>
                        </div>
                         <div class="form-group col-sm-4">
                            <label>Nombres </label>
                            <span class="form-control-static"><?= $registro[0]['nombres'] ?></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Apellidos: </label>
                            <span class="form-control-static"><?= $registro[0]['apellidos'] ?></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Cedula: </label>
                            <span class="form-control-static"><?= $registro[0]['cedula'] ?></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Comite: </label>
                            <span class="form-control-static"><?= $registro[0]['comite'] ?></span>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>descripcion: </label>
                            <span class="form-control-static"><?= $registro[0]['descripcion'] ?></span>
                        </div>
                         <div class="form-group col-sm-6">
                         <label for="fecha">Soporte:</label>
                    <?php if ($registro[0]['soporte']) { ?>
                    <a target="_blank" href="<?= base_url() ?>uploads/sanciones/<?= $registro[0]['soporte'] ?>">Ver soporte</a>
                                    <?php
                                } else {
                                    echo "N hay soporte";
                                }
                                ?>  </div>
                        
                    <?php } else {
                        ?>

                        <label>No hay detalles</label>

                        <?php
                    }
                    ?>

                </div>

            </div>    
        </div>
        <ul class="pager">
            <li class="previous">
                <a href="<?php echo base_url() ?>adminera/ver_comite">&larr; Atras</a>
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

