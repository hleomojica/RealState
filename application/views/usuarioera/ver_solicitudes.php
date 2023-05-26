<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li class="active">Solicitudes</li>
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
                <a href="<?php echo base_url() . "usuarioera/ver_solicitudes" ?>" class="list-group-item active ">Solicitudes</a>
                <a href="<?php echo base_url() . "usuarioera/ver_sanciones" ?>" class="list-group-item ">Sanciones</a>
                <hr>
                <a href="<?php echo base_url() . "usuarioera/configuracion" ?>" class="list-group-item">Configuracion</a>
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
            Menu
        </div>
        <div class="panel-body">
            <div class="col-sm-2">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#modelusr">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/iconoadd.png" alt="imagen">
                    <p contenteditable>Nueva</p>
                </a>
            </div>
            <div class="col-lg-9"><div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Click en<strong> !Nueva!</strong> Para registrar una nueva solicitud.
                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Solicitudes Realizadas
        </div>
        <div class="panel-body">
            <div class="table-responsive span3">
                <table  class = "table table-bordered">
                    <thead>
                        <tr>
                            <th>VER</th>
                            <th>Codigo</th>
                            <th>Detalle</th>
                            <th>Observacion</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($solicitudes) {
                            foreach ($solicitudes as $solicitud) {
                                echo "<tr>\n";
                                ?>
                            <td><a class="btn btn-success btn-xs" href="<?php echo base_url() ?>usuarioera/obt_detalle_solicitud/<?= $this->cifrar->enc($solicitud["codsolicitud"]) ?>">
                                    <span class="glyphicon glyphicon-search"></span> Detalle
                                </a></td>
                           
                            <?php
                            echo "<td>\n" . $solicitud['codsolicitud'] . "</td>";
                            echo "<td>\n" . $solicitud['detalle'] . "</td>";
                            echo "<td>\n" . $solicitud['observacion'] . "</td>";
                            echo "<td>\n" . $solicitud['fecha'] . "</td>";
                            ?> 
                            <td class="<?php
                            if ($solicitud['estado'] == 'Solucionada') {
                                echo 'verde';
                            } else {
                                echo 'rojo';
                            }
                            ?>" ><strong><?= $solicitud['estado'] ?></strong></td>
                                <?php
                                echo "</tr>\n";
                            }
                        } else {
                            ?>
                        <tr>
                            <td colspan="7" align="center">No ha hecho ninguna solicitud</td>
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
                <h4 class="modal-title" id="myModalLabel"><strong>Nueva Solicitud</strong></h4>
            </div>
            <form action="<?php echo base_url() ?>usuarioera/add_solicitud" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group col-sm-6">
                        <label for="cc">Fecha </label>
                        <input type="text" class="form-control" id="cc" name="fecha" value="<?= date('Y-m-d') ?>" placeholder="Observaciones" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="cc">Asunto:</label>
                        <input type="text" class="form-control" id="cc" name="detalle" placeholder="Asunto de la solicitud." required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="razon">Observaciones</label>
                        <textarea class="form-control" name="observacion" placeholder="Descripcion detallada de la solicitud."></textarea>
                    </div>


                    <input type="hidden" name="codestado_solicitud" value="2">


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Enviar solicitud</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>
<!------------------------------MODAL PARA NUEVO COMITE---------------------------->



