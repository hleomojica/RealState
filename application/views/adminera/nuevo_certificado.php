<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4.min.js') ?>"></script>
<script src="<?php echo base_url('herramientas/js/jquery-ui.min.js') ?>"></script>
<script src="<?php echo base_url('herramientas/jquery/jquery-ui.js') ?>"></script><!--
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4') ?>"></script>
<script src="<?php echo base_url('herramientas/bootstrap/js/bootstrap.min.js') ?>"></script>-->

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
             <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
             <li><a href="<?php echo base_url() ?>adminera/ver_certificados">Certificados</a></li>
            <li class="active">Nuevo</li>
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
                <a href="<?php echo base_url() . "adminera/ver_certificados" ?>" class="list-group-item active">Certificados</a>
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
    <div class="panel panel-primary">
        <div class="panel-heading">
            Generar Certificados
        </div>
        <div class="panel-body">

            <div class="col-sm-6">

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
                <form action="<?php echo base_url() ?>adminera/bsc_ava_c" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="razon">AVALUADOR</label>
                        <input type="text" class="form-control" id="razon" name="cedula" placeholder="Ingrese cedula" required>
                    </div>

                    <div class="col-sm-12">
                        <button type="submit"  class="btn btn-primary centered">Buscar</button>
                    </div>
                </form>

                <div class="col-sm-12">
                    <div class="alert alert-warning alert-dismissable" id="alert-message">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡!</strong>Busca una cedula para agregar a la lista para generar certificados.
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        Generar Certificados
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive span3"> 
                            <table  class = "table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cedula</th>
                                        <th>Nombres</th>
                                        <th>Eliminar</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($temporal) {
                                        foreach ($temporal as $temporal) {
                                            echo "<tr>\n";
                                            ?>

                                            <?php
                                            echo "<td>\n" . $temporal['cedula'] . "</td>";
                                            echo "<td>\n" . $temporal['nombres'] . "</td>";
                                            ?> 
                                        
                                        <td><a class="btn btn-danger btn-xs" href="<?php echo base_url() ?>certificados/eliminar_temporal/<?= $this->cifrar->enc($temporal["codtemporal_c"]) ?>">
                                    <span class="glyphicon glyphicon-trash"></span> Eliminar
                                    </a></td>
                                         <?php
                                        echo "</tr>\n";
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7" align="center">Agregue cedulas para generar certificados</td>
                                    </tr>
                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <a  data-href="<?php echo base_url() . "certificados/generar_certificado" ?>"  data-toggle="modal" data-target="#confirm-delete" href="#" class="btn btn-success ">Generar</a>
                        </div>
                    </div>
                </div>



                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                Certificados
                            </div>
                            <div class="modal-body">
                                Desea generar certificados?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <a target="_blank" class="btn btn-success success" id="rec" onclick="location.reload();">Generar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#confirm-delete').on('show.bs.modal', function (e) {
                            $(this).find('.success').attr('href', $(e.relatedTarget).data('href'));
                            
                        });
                    });
                </script>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $("#rec").click(function () {
                           location.reload();
                        });
                    });
                </script>

            </div>    

        </div>
    </div>
    <ul class="pager">
        <li class="previous">
            <a href="<?php echo base_url() ?>adminera/ver_certificados">&larr; Atras</a>
        </li>
        <li class="next">
            <a href="#">Adelante &rarr;</a>
        </li>
    </ul>



