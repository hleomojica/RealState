<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li class="active">Entidades</li>
        </ol>
    </div>    
    <!--------------------ASIDE--------------------->
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">Sistema</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                    <a href="<?php echo base_url() . "entecontrol/era" ?>" class="list-group-item active">Entidades ERA</a>
                    <a href="<?php echo base_url() . "entecontrol/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                    <a href="<?php echo base_url() . "entecontrol/ver_categorias" ?>" class="list-group-item ">Categorias Avaluadores</a>
                    <a href="<?php echo base_url() . "entecontrol/ver_certificados" ?>" class="list-group-item">Certificados</a>
                    <a href="<?php echo base_url() . "entecontrol/ver_traslados" ?>" class="list-group-item">Traslados</a>
                    <a href="<?php echo base_url() . "entecontrol/ver_sanciones" ?>" class="list-group-item">Sanciones</a>
                </div>
            </div>
        </div>

        <hr>
    </div>
    <!------------------------/ASIDE--------------->

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
                Entidades Reconocidas de Autoregulacion de avalaudores.
            </div>

            <div class="table-responsive"> 

                <table  class = "table table-bordered">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Codigo</th>
                            <th>razon social</th>
                            <th>Nit</th>
                            <th>Representante legal</th>
                            <th>Tipo documento</th>
                            <th>Numero documento</th>
                            <th>Direccion Entidad</th>
                            <th>Telefono Entidad</th>
                            <th>Fecha acto</th>
                            <th>Estado</th>
                     </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($eras) {
                            foreach ($eras as $avaluadores) {
                                echo "<tr>\n";
                                ?>
                            <td><a class="btn btn-success btn-xs" href="<?php echo base_url() ?>entecontrol/obtener_detalle_era/<?= $this->cifrar->enc($avaluadores["codera"]) ?>">
                                    <span class="glyphicon glyphicon-eye-open"></span> Perfil
                                </a></td>
                            <?php
                            echo "<td>\n" . $avaluadores['codera'] . "</td>";
                            echo "<td>\n" . $avaluadores['razonsocial_era'] . "</td>";
                            echo "<td>\n" . $avaluadores['nit_era'] . "</td>";
                            echo "<td>\n" . $avaluadores['nombre_representante'] . "</td>";
                            echo "<td>\n" . $avaluadores['tipoid_representante'] . "</td>";
                            echo "<td>\n" . $avaluadores['numeroid_representante'] . "</td>";
                            echo "<td>\n" . $avaluadores['direccion_era'] . "</td>";
                            echo "<td>\n" . $avaluadores['telefono_era'] . "</td>";
                            echo "<td>\n" . $avaluadores['fecha_acto'] . "</td>";
                            echo "<td>\n" . $avaluadores['estado'] . "</td>";
                            ?> 
                         <?php
                            echo "</tr>\n";
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" align="center">No hay ninguna ERA Registrada</td>
                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>
                 </table>
            </div>
        </div>
        <ul class="pager">
            <li class="previous">
                <a href="#">&larr; Atras</a>
            </li>
            <li class="next">
                <a href="#">Adelante &rarr;</a>
            </li>
        </ul>
    </div>


</div>
</div>
