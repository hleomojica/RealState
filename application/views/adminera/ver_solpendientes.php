<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminera/ver_traslados">Traslados</a></li>
            <li class="active">Solicitudes pendientes</li>
        </ol>
    </div> 
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
                <a href="<?php echo base_url() . "adminera/ver_certificados" ?>" class="list-group-item  ">Certificados</a>
                <a href="<?php echo base_url() . "adminera/ver_sanciones" ?>" class="list-group-item ">Sanciones</a>
                <a href="<?php echo base_url() . "adminera/ver_traslados" ?>" class="list-group-item active">Traslados</a>
                <a href="<?php echo base_url() . "adminera/ver_usuarios" ?>" class="list-group-item ">Usuarios</a>
                <hr>
                <a href="<?php echo base_url() . "adminera/configuracion" ?>" class="list-group-item">Configuración</a>
            </div>
        </div>
    </div>
</div>

<!-----------------------/ASIDE----------->
<div class="col-lg-9">
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

    <div class="panel panel-primary">
        <div class="panel-heading">
            Opciones
        </div>
        <div class="panel-body">
            <div class="col-sm-2">
                <a href="<?php echo base_url() ?>adminera/ver_traslados" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/home2.png" alt="imagen">
                    <p contenteditable>Inicio Traslados</p>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#modelusr">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/traslado.png" alt="imagen">
                    <p contenteditable>Solicitar traslado</p>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="<?= base_url() ?>adminera/ver_solicitudestras" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/solicitudtras.jpg" alt="imagen">
                    <p contenteditable>Solicitudes Pendientes</p>
                </a>
            </div>
             <div class="col-sm-2">
                <a href="<?= base_url() ?>adminera/ver_solenviadas" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/env.png" alt="imagen">
                    <p contenteditable>Solicitudes Enviadas</p>
                </a>
            </div>
        
        </div>
    </div>
    <h4><strong>Solicitudes Pendientes de Traslado</strong></h4>
   <div class="table-responsive span3">
                <table  class = "table table-bordered">
                    <thead>
                        <tr>
                            <th>Trasladar</th>
                            <th>Rechazar</th>
                            <th>Codigo</th>
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($soltraslados) {
                            foreach ($soltraslados as $row) {
                                echo "<tr>\n";
                                ?>
                             <td> <a data-href="<?= base_url()?>adminera/traslado_ok/<?= $this->cifrar->enc($row["codsolicitud"])?>" data-toggle="modal" data-target="#confirm-traslado"  href="#"><span style="color: green" class="glyphicon glyphicon-check"></span></a>
                            <td> <a data-href="<?= base_url()?>adminera/traslado_no/<?= $this->cifrar->enc($row["codsolicitud"])?>" data-toggle="modal" data-target="#confirm-delete"  href="#"><span style="color: red" class="glyphicon glyphicon-remove-sign"></span></a>
                                <?php
                            echo "<td>\n" . $row['codsolicitud'] . "</td>";
                            echo "<td>\n" . $row['cedula'] . "</td>";
                            echo "<td>\n" . $row['nombres'] . "</td>";
                            echo "<td>\n" . $row['apellidos'] . "</td>";
                            echo "<td>\n" . $row['fecha'] . "</td>";
                            ?> 

                            <?php
                            echo "</tr>\n";
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" align="center">No hay solicitudes</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>

</div>

<!-----------------------MODAL PARA BUCAR--------------------------->

<div class="modal fade" id="modelusr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cedula de Avaluador</h4>
            </div>
            <form action="<?php echo base_url() ?>adminera/nueva_soltraslado" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group col-sm-6">
                        <label for="razon">Cedula;</label>
                        <input type="text" class="form-control" id="razon" name="cedula" placeholder="Ingrese Cedula de Avaluador" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Buscar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>
<!------------------------------MODAL PARA NUEVO COMITE---------------------------->

<script type="text/javascript">
    $(document).ready(function () {
        $('#confirm-traslado').on('show.bs.modal', function (e) {
            $(this).find('.success').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>

<div class="modal fade" id="confirm-traslado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               Trasladar
            </div>
            <div class="modal-body">
                ¿Esta seguro de Trasladar el Avaluador a esta ERA?
            </div>
            <div class="modal-footer">
                 <a href="#" class="btn btn-success success">Trasladar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
               
            </div>
        </div>
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
               Trasladar
            </div>
            <div class="modal-body">
                ¿Esta seguro de rechazar la solicitud de traslado?
            </div>
            <div class="modal-footer">
                 <a href="#" class="btn btn-danger danger">Rechazar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

