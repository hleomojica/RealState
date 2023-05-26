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
                <a href="<?php echo base_url() . "adminera/ver_sanciones" ?>" class="list-group-item active">Sanciones</a>
                <a href="<?php echo base_url() . "adminera/ver_traslados" ?>" class="list-group-item ">Traslados</a>
                <a href="<?php echo base_url() . "adminera/ver_usuarios" ?>" class="list-group-item ">Usuarios</a>
                <hr>
                <a href="<?php echo base_url() . "adminera/configuracion" ?>" class="list-group-item">Configuración</a>
            </div>
        </div>
    </div>
</div>

<!-----------------------/ASIDE----------->
<div class="col-lg-9">
    <?= @$error ?>
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
            <div class="row">
                <div class="col-sm-2">
                    <a href="#" class="thumbnail" data-toggle="modal" data-target="#modelusr">
                        <img class="icono" src="<?= base_url() ?>herramientas/images/sancion.png" alt="imagen">
                        <p contenteditable>Nueva</p>
                    </a>
                </div>

                <div class="col-sm-10"><form class="form col-sm-4" method="post" action="<?php echo base_url() ?>adminera/bus_sancion_fecha">
                        <div class="form-group">
                            <label for="buscar">Buscar Por fecha:</label>
                            <input type="text" class="form-control" id="fecha"  name="fecha" value="" placeholder="Ingrese una fecha">
                        </div>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span> Buscar
                        </button>
                    </form>
                </div>
                <div class="col-sm-12"><div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Click en<strong> Nueva</strong> para registrar una nueva sanción
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Sanciones Aplicadas
            </div>
            <div class="panel-body">
                <div class="table-responsive span3">
                    <table  class = "table table-bordered">
                        <thead>
                            <tr>
                                <th>Detalle</th>
                                <th>Fecha</th>
                                <th>Cedula</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo de Sancion</th>
                                <th>Soporte</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($sanciones) {
                                foreach ($sanciones as $sancion) {
                                    echo "<tr>\n";
                                    ?>
                                <td><a class="btn btn-primary btn-xs" href="<?php echo base_url() ?>adminera/obt_detalle_sancion/<?= $this->cifrar->enc($sancion["codsancion"]) ?>">
                                        <span class="glyphicon glyphicon-search"></span> Detalle
                                    </a></td>
                                <?php
                                echo "<td>\n" . $sancion['fecharegistro'] . "</td>";
                                echo "<td>\n" . $sancion['cedula'] . "</td>";
                                echo "<td>\n" . $sancion['nombres'] . "</td>";
                                echo "<td>\n" . $sancion['apellidos'] . "</td>";
                                echo "<td>\n" . $sancion['tipo'] . "</td>";
//                            echo "<td>\n" . $sancion['soporte'] . "</td>";
                                ?> 
                                <td> <a target="_blank" href="<?= base_url() ?>uploads/sanciones/<?= $sancion['soporte'] ?>">PDF</a></td>
                                <?php
                                echo "</tr>\n";
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7" align="center">No hay comentarios</td>
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
                    <h4 class="modal-title" id="myModalLabel">Cedula de Avaluador</h4>
                </div>
                <form action="<?php echo base_url() ?>adminera/nueva_sancion" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <div class="col-sm-12"><div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong></strong> Ingrese una cedula para buscar un avaluador
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="razon">Cedula;</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese Cedula de Avaluador" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form> 
            </div>    
        </div>
    </div>
    <!------------------------------MODAL PARA NUEVO COMITE---------------------------->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#cedula').focus();
        });

    </script>
    <script>
        $(function () {
            $("#fecha").datepicker({dateFormat: "yy-mm-dd"}).val();
        });
    </script>


