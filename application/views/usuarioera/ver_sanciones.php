<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li class="active">Sanciones</li>

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
                <a href="<?php echo base_url() . "usuarioera/ver_solicitudes" ?>" class="list-group-item  ">Solicitudes</a>
                <a href="<?php echo base_url() . "usuarioera/ver_sanciones" ?>" class="list-group-item active">Sanciones</a>
                <hr>
                <a href="<?php echo base_url() . "usuarioera/configuracion" ?>" class="list-group-item">Configuracion</a>
            </div>
        </div>
    </div>
</div>
 <!-- Menu -->

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
            Sanciones aplicadas
        </div>
        <div class="panel-body">
            <div class="table-responsive span3">
                <table  class = "table table-bordered">
                    <thead>
                        <tr>

                            <th>Ver detalle</th>
                            <th>Codigo</th>
                            <th>fecha registro</th>
                            <th>fecha fin</th>
                            <th>Tipo</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($sanciones) {
                            foreach ($sanciones as $sancion) {
                                echo "<tr>\n";
                                ?>
                        <td><a class="btn btn-success btn-xs" href="<?php echo base_url() ?>usuarioera/obt_detalle_sancion/<?= $this->cifrar->enc($sancion["codsancion"]) ?>">
                                    <span class="glyphicon glyphicon-search"></span> Detalle
                                </a></td>
                            
                            <?php
                            echo "<td>\n" . $sancion['codsancion'] . "</td>";
                            echo "<td>\n" . $sancion['fecharegistro'] . "</td>";
                            echo "<td>\n" . $sancion['fechafin'] . "</td>";
                            echo "<td>\n" . $sancion['tipo'] . "</td>";
                            ?> 

                            <?php
                            echo "</tr>\n";
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" align="center">No se han realizado sanciones.</td>
                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-----------------------MODAL PARA NUEVO COMITE---------------------------->

<div class="modal fade" id="modelusr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nueva Solicitud</h4>
            </div>
            <form action="<?php echo base_url() ?>usuarioera/add_solicitud" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group col-sm-6">
                        <label for="cc">Fecha </label>
                        <input type="text" class="form-control" id="cc" name="fecha" value="<?= date('Y-m-d') ?>" placeholder="Observaciones" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="cc">Detalle </label>
                        <input type="text" class="form-control" id="cc" name="detalle" placeholder="Detalle de la Soliitud" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="razon">Observaciones</label>
                        <textarea class="form-control" name="observacion" placeholder="Descripcion detallada de La sancion"></textarea>
                    </div>


                    <input type="hidden" name="codestado_solicitud" value="2">


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Enviar Solicitud</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>
<!------------------------------MODAL PARA NUEVO COMITE---------------------------->



