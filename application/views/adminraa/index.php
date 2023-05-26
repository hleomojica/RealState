<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li class="active"><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
        </ol>
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
    <div class="col-lg-9">
         <div class=" text-center">
<h2>PANEL DE ADMINISTRADOR R.A.A</h2>
         </div>
        
        <div class="panel panel-primary">
            <div class="panel-heading">

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img  class="inicio"src="<?= base_url() ?>herramientas/images/era.png" alt="...">
                            <div class="caption">
                                <h4><p>ERA Registradas: </p></h4>
                                <h2><p><?= $era->cantidad ?></p></h2>
                                <p>
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modelera">Ver mas</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img class="inicio" src="<?= base_url() ?>herramientas/images/ava.png" alt="...">
                            <div class="caption">
                                <h4><p>Avaluadores Registrados  </p></h4>
                                <h2><p><?= $avaluadores->cantidad ?></p></h2>
                                <p>
                                    <a href="<?php echo base_url() . "adminraa/ver_avaluadores" ?>" class="btn btn-primary" role="button">Ver mas</a>

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img class="inicio" src="<?= base_url() ?>herramientas/images/usuari.png" alt="...">
                            <div class="caption">
                                <h4><p>Usuarios Registrados <p></h4>
                                <h2><p><?= $usuarios->cantidad ?></p></h2>
                                <p>
                                    <a href="<?php echo base_url() . "adminraa/ver_usuarios" ?>" class="btn btn-primary" role="button">Ver mas</a>

                                </p>
                            </div>
                        </div>
                    </div>

                </div>
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
                    <a href="<?php echo base_url() . "adminraa/era" ?>" type="button"  class="btn btn-primary">Ver mas</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>

            </div>    
        </div>
        <!----------- /MODALES PARA VER OPCIONES INICIO---------------------------->


    </div>



