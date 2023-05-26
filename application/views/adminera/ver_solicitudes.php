<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link href="<?php echo base_url('herramientas/css/jquery-ui.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('herramientas/jquery/jquery-ui.min.css') ?>" rel="stylesheet">

<!--JQUERY-->
<script src="<?php echo base_url('herramientas/jquery/jquery-ui.js') ?>"></script>
<script src="<?php echo base_url('herramientas/jquery/jquery-ui.min.js') ?>"></script>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminera/ver_comite">Comite</a></li>
            <li class="active">Solicitudes</li>
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
                <a href="<?php echo base_url() . "adminera/ver_comite" ?>" class="list-group-item active">Comite</a>
                <a href="<?php echo base_url() . "adminera/ver_certificados" ?>" class="list-group-item  ">Certificados</a>
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
    <?= @$error ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Opciones
        </div>
        <div class="panel-body">
            <div class="col-sm-2">
                <a href="<?php echo base_url() ?>adminera/ver_comite" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/home2.png" alt="imagen">
                    <p contenteditable>Inicio</p>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#modelusr">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/iconoadd.png" alt="imagen">
                    <p contenteditable>Nuevo</p>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="<?php echo base_url() ?>adminera/ver_solicitudes" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/solicitud.png" alt="imagen">
                    <p contenteditable>Solicitudes</p>
                </a>
            </div>

        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Solicitudes Pendientes 
        </div>
        <div class="panel-body">
            <div class="table-responsive span3">
                <table  class = "table table-bordered">



                    <thead>
                        <tr>
                            <th>Solucionar</th>
                            <th>codigo</th>
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>solicitud</th>
                            <th>Observaciones</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($solicitudes) {
                            foreach ($solicitudes as $solicitud) {
                                echo "<tr>\n";
                                ?>

                            <td> <a class="btn btn-success btn-xs" href="<?php echo base_url() ?>adminera/obt_sol/<?= $this->cifrar->enc($solicitud["codsolicitud"]) ?>">
                                    <span class="glyphicon glyphicon-ok-circle"></span> Solucionar
                                </a></td>
                            <?php
                            echo "<td>\n" . $solicitud['codsolicitud'] . "</td>";
                            echo "<td>\n" . $solicitud['cedula'] . "</td>";
                            echo "<td>\n" . $solicitud['nombres'] . "</td>";
                            echo "<td>\n" . $solicitud['apellidos'] . "</td>";
                            echo "<td>\n" . $solicitud['detalle'] . "</td>";
                            echo "<td>\n" . $solicitud['observacion'] . "</td>";
                            echo "<td>\n" . $solicitud['estado'] . "</td>";
                            ?> 

                            <?php
                            echo "</tr>\n";
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" align="center">No hay solicitudes pendientes</td>
                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>


                </table>
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

<!------------------------/CONTENIDO CENTRAL-------------------------------->
<!-----------------------MODAL PARA NUEVO COMITE---------------------------->

<div class="modal fade" id="modelusr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrar Nuevo Comite</h4>
            </div>
            <form action="<?php echo base_url() ?>adminera/add_comite" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="form-group col-sm-6">
                        <label for="razon">Fecha Realizacion</label>
                        <input type="text" class="form-control" id="fecha" name="fecha" placeholder="AÑO-MES-DIA" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nit">Funcionarios </label>
                        <input type="text" class="form-control" id="nit" name="funcionarios" placeholder="Funcionario" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Crear Comite</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>
<!------------------------------MODAL PARA NUEVO COMITE---------------------------->