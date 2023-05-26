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
             <li><a href="<?php echo base_url() ?>usuarioera/ver_solicitudes">Sanciones</a></li>
            <li class="active">Informacion</li>
        </ol>
    </div>  
<!-----------ASIDE------------>
<div class="col-sm-3">
    <div class="panel panel-primary">
        <div class="panel-heading">ERA</div>
        <div class="panel-body">
            <div class="list-group">
                <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                <a href="<?php echo base_url() . "usuarioera/ver_solicitudes" ?>" class="list-group-item active ">Solicitudes</a>
                <a href="<?php echo base_url() . "usuarioera/ver_sanciones" ?>" class="list-group-item ">Sanciones</a>
                <hr>
                <a href="<?php echo base_url() . "usuarioera/configuracion" ?>" class="list-group-item">Configuracion</a>
            </div>
        </div>
    </div>
</div>

<!-----------------------/ASIDE----------->
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
                    FECHA DE RESPUESTA :<?= $registro[0]['fecrespuesta'] ?>


                </div>
                <div class="panel panel-body">
                    <div class="row">
                         <div class="form-group col-sm-4">
                            <label>Nombres: </label>
                            <span class="form-control-static"><?= $registro[0]['nombres'] ?></span>
                        </div>
                         <div class="form-group col-sm-4">
                            <label>Solicitud: </label>
                            <span class="form-control-static"><?= $registro[0]['solicitud'] ?></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Fecha respuesta: </label>
                            <span class="form-control-static"><?= $registro[0]['fecrespuesta'] ?></span>
                        </div>
                        <div class="form-group col-sm-12">
                            <label style="color: #0000CC">Respuesta </label>
                            <span class="form-control-static" ><?= $registro[0]['respuesta'] ?></span>
                        </div>
                         <div class="form-group col-sm-12">
                            <label style="color: #0000CC">Observaciones: </label>
                            <span class="form-control-static"><?= $registro[0]['Observaciones'] ?></span>
                        </div>
                        
                        
                        
                        
                    <?php } else {
                        ?>

                        <label>No se ha dado respuesta a la solicitud</label>

                        <?php
                    }
                    ?>

                </div>

            </div>    
        </div>
        <ul class="pager">
            <li class="previous">
                <a href="<?php echo base_url() ?>usuarioera/ver_solicitudes">&larr; Atras</a>
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

