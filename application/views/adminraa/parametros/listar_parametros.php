<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li class="active"><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
        </ol>
    </div>
</div>

<!--------------------ASIDE--------------------->
<div class="col-sm-3">
    <div class="panel panel-default">
        <div class="panel-heading">Entidades ERA</div>
        <div class="panel-body">
            <div class="list-group">
                <a href="<?php echo base_url() ?>login/index" class="list-group-item active ">Inicio</a>
                <a href="<?php echo base_url() . "adminraa/era" ?>" class="list-group-item ">Entidades ERA</a>
                <a href="<?php echo base_url() . "adminraa/nueva_era" ?>" class="list-group-item ">Nueva ERA</a>
                <a href="#" class="list-group-item">Reportes ERA</a>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">AVALUADORES</div>
        <div class="panel-body">

            <div class="list-group">
                <a href="<?php echo base_url() . "adminraa/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                <a href="<?php echo base_url() . "adminraa/ver_categorias" ?>" class="list-group-item ">Categorias</a>
                <a href="<?php echo base_url() . "adminraa/ver_certificados" ?>" class="list-group-item">Certificados</a>
            </div>
        </div>
    </div>
    <hr>
</div>
<!------------------------/ASIDE--------------->
<div class="col-sm-9">

    <div class="panel panel-default">
        <div class="panel-heading">Parametros Iniciales</div>
        <div class="panel-body">
            <!--------------------------TABLA ESTADOS------------------------->
            <div class="col-sm-6">
                <div class="panel panel-default">

                    <div class="panel-heading">Estados</div>
                    <div class="panel-body">
                        <table  class = "table table-bordered">
                            <thead>
                                <tr>
                                    <th>codigo</th>
                                    <th>valor</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($estados) {
                                    foreach ($estados as $row) {
                                        echo "<tr>\n";
                                        echo "<td>\n" . $row['codestado'] . "</td>";
                                        echo "<td>\n" . $row['nombre'] . "</td>";
                                        ?> 
                                    <td><?= anchor("adminraa/obt_usr_edit2/{$row["codestado"]}", '<span class="glyphicon glyphicon-pencil"></span>') ?> ,
                                        <?= anchor("adminraa/usr_eliminar/{$row["codestado"]}", '<span class="glyphicon glyphicon-trash"></span>') ?> </td>
                                    <?php
                                    echo "</tr>\n";
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" align="center">No hay Parametros</td>
                                </tr>
                                <?php
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--------------------------TABLA ESTADOS------------------------->
            <!--------------------------TABLA TIPO DOCUMENTO------------------------->
            <div class="col-sm-6">
                <div class="panel panel-default">
                     <div class="panel-heading">Tipo Documento</div>
                    <div class="panel-body">
                        <table  class = "table table-bordered">
                            <thead>
                                <tr>
                                    <th>codigo</th>
                                    <th>valor</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($estados) {
                                    foreach ($estados as $row) {
                                        echo "<tr>\n";
                                        echo "<td>\n" . $row['codestado'] . "</td>";
                                        echo "<td>\n" . $row['nombre'] . "</td>";
                                        ?> 
                                    <td><?= anchor("adminraa/obt_usr_edit2/{$row["codestado"]}", '<span class="glyphicon glyphicon-pencil"></span>') ?> ,
                                        <?= anchor("adminraa/usr_eliminar/{$row["codestado"]}", '<span class="glyphicon glyphicon-trash"></span>') ?> </td>
                                    <?php
                                    echo "</tr>\n";
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" align="center">No hay Parametros</td>
                                </tr>
                                <?php
                            }
                            ?>
                         </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--------------------------TABLA ESTADOS------------------------->
            <!--------------------------TABLA ESTADOS------------------------->
            <div class="col-sm-6">
                <div class="panel panel-default">

                    <div class="panel-heading">Estado Solicitudes</div>
                    <div class="panel-body">
                        <table  class = "table table-bordered">
                            <thead>
                                <tr>
                                    <th>codigo</th>
                                    <th>valor</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($estados) {
                                    foreach ($estados as $row) {
                                        echo "<tr>\n";
                                        echo "<td>\n" . $row['codestado'] . "</td>";
                                        echo "<td>\n" . $row['nombre'] . "</td>";
                                        ?> 
                                    <td><?= anchor("adminraa/obt_usr_edit2/{$row["codestado"]}", '<span class="glyphicon glyphicon-pencil"></span>') ?> ,
                                        <?= anchor("adminraa/usr_eliminar/{$row["codestado"]}", '<span class="glyphicon glyphicon-trash"></span>') ?> </td>
                                    <?php
                                    echo "</tr>\n";
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" align="center">No hay Parametros</td>
                                </tr>
                                <?php
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--------------------------TABLA ESTADOS------------------------->
            <!--------------------------TABLA ESTADOS------------------------->
            <div class="col-sm-6">
                <div class="panel panel-default">

                    <div class="panel-heading">Tipo Sancion</div>
                    <div class="panel-body">
                        <table  class = "table table-bordered">
                            <thead>
                                <tr>
                                    <th>codigo</th>
                                    <th>valor</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($estados) {
                                    foreach ($estados as $row) {
                                        echo "<tr>\n";
                                        echo "<td>\n" . $row['codestado'] . "</td>";
                                        echo "<td>\n" . $row['nombre'] . "</td>";
                                        ?> 
                                    <td><?= anchor("adminraa/obt_usr_edit2/{$row["codestado"]}", '<span class="glyphicon glyphicon-pencil"></span>') ?> ,
                                        <?= anchor("adminraa/usr_eliminar/{$row["codestado"]}", '<span class="glyphicon glyphicon-trash"></span>') ?> </td>
                                    <?php
                                    echo "</tr>\n";
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" align="center">No hay Parametros</td>
                                </tr>
                                <?php
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--------------------------TABLA ESTADOS------------------------->
            
        </div>
    </div>




    <p class="lead">Bienvenido <?= $this->session->userdata('nombres') ?> </p>
</div>




<!----------- /MODALES PARA VER OPCIONES INICIO---------------------------->

<div class="modal fade" id="modelera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Entidades Reconocidas de Autoregulacion de avalaudores.</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
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
                                    <td><?= anchor("adminraa/obtener_detalle/{$avaluadores["codera"]}", '<span class="glyphicon glyphicon-eye-open"></span>') ?> </td>
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
        <div class="modal-footer">

            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

    </div>    
</div>
<!----------- /MODALES PARA VER OPCIONES INICIO---------------------------->


</div>



