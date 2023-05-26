<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4') ?>"></script>
<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li class="active">Traslados</li>
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
                    <a href="<?php echo base_url() . "entecontrol/ver_traslados" ?>" class="list-group-item active">Traslados</a>
                     <a href="<?php echo base_url() . "entecontrol/ver_sanciones" ?>" class="list-group-item">Sanciones</a>
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
                Traslados realizados
            </div>


            <div class="panel-body">
                <!---------------------------TABLA ------------------------------->


                    <div class="panel-body">
                        <div class="table-responsive span3">
        <table  class = "table table-bordered">
            <thead>
                <tr>

                    <th>Codigo</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Anterior</th>
                    <th>Nueva</th>
                    <th>Cedula</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($traslados) {
                    foreach ($traslados as $row) {
                        echo "<tr>\n";

                        echo "<td>\n" . $row['codtraslado'] . "</td>";
                        echo "<td>\n" . $row['nombres'] . "</td>";
                        echo "<td>\n" . $row['apellidos'] . "</td>";
                        echo "<td>\n" . $row['anterior'] . "</td>";
                        echo "<td>\n" . $row['nueva'] . "</td>";
                        echo "<td>\n" . $row['cedula'] . "</td>";
                        echo "<td>\n" . $row['fecha'] . "</td>";
                        ?> 

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

                <!--------------------------------------FIN TABLA---------------------------->

            </div>   

        </div>
    </div>


