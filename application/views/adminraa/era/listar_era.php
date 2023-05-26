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
            <div class="panel-heading">Entidades ERA</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                    <a href="<?php echo base_url() . "adminraa/era" ?>" class="list-group-item active">Entidades ERA</a>
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
            <div class="panel-body">
                <form class="form-inline"  action="<?php echo base_url() ?>adminraa/bus_era_nombre" method="post">
                    <div class="form-group">
                        <label for="buscar">Buscar Por nombre</label>
                        <input type="text" class="form-control" id="buscar"  name="nombre" placeholder="Escriba aqui el nombre">
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span> Buscar
                    </button>
                </form>
            </div>



            <div class="table-responsive"> 

                <table  class = "table table-bordered">
                    <thead>
                        <tr>
                            <th>Opciones</th>
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
                            <td><a class="btn btn-success btn-group-sm" href="<?php echo base_url() ?>adminraa/obtener_detalle/<?= $this->cifrar->enc($avaluadores["codera"]) ?>">
                                    <span class="glyphicon glyphicon-eye-open"></span> Opciones
                                </a></td>

                            <?php
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
                <a href="<?php echo base_url() . "adminraa/index" ?>">&larr; Atras</a>
            </li>
            <li class="next">
                <a href="#">Adelante &rarr;</a>
            </li>
        </ul>

    </div>

</div>
</div>
