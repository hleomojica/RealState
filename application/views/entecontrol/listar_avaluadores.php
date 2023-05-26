<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li class="active">Avaluadores</li>
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
                    <a href="<?php echo base_url() . "entecontrol/ver_avaluadores" ?>" class="list-group-item active">Avaluadores</a>
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

        <div class="panel panel-primary">
            <div class="panel-heading">
                Todos Los avaluadores
            </div>
            <div class="panel-body">
                <form class="form col-sm-6" action="<?php echo base_url() ?>entecontrol/bus_ava_nombre" method="post">
                    <div class="form-group">
                        <label for="buscar">Buscar Por nombre</label>
                        <input type="text" class="form-control" id="buscar"  name="nombre" placeholder="Escriba aqui el nombre">
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span> Buscar
                    </button>

                </form>
                <form class="form col-sm-6" method="post" action="<?php echo base_url() ?>entecontrol/bus_ava_estado">
                    <div class="form-group">
                        <label for="clase"> Buscar por Estado</label>
                        <select class="form-control"  name="codestado">
                            <option value="">Seleccione Una Opcion</option>        
                            <?php
                            if ($estados) {
                                foreach ($estados as $row) {
                                    ?>
                                    <option value="<?= $row['codestado'] ?>"><?= $row['nombre'] ?></option>
                                    <?php
                                }
                            } else {
                                echo"<option value='1'>Activo</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span> Buscar
                    </button>
                </form>
            </div>
            <div class="table-responsive span3" > 
                <table  class = "table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Ver Perfil</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Cedula</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Codigo</th>
                            <th>estado</th>

                        </tr>
                    </thead>
                   
                        <tbody>
                             <?php
                            if ($avaluadores) {
                                foreach ($avaluadores as $avaluadores) {
                                    echo "<tr>\n";
                                    ?>
                             <td><a class="btn btn-success btn-xs" href="<?php echo base_url() ?>entecontrol/obt_detaller_avaluador/<?= $this->cifrar->enc($avaluadores["numero_id"]) ?>">
                                    <span class="glyphicon glyphicon-eye-open"></span> Perfil
                     </a></td>
                                
                                <?php
                                echo "<td>\n" . $avaluadores['nombres'] . "</td>";
                                echo "<td>\n" . $avaluadores['apellidos'] . "</td>";
                                echo "<td>\n" . $avaluadores['cedula'] . "</td>";
                                echo "<td>\n" . $avaluadores['telefono'] . "</td>";
                                echo "<td>\n" . $avaluadores['correo'] . "</td>";
                                echo "<td>\n" . $avaluadores['codigoavaluador'] . "</td>";
                                echo "<td>\n" . $avaluadores['estado'] . "</td>";
                                ?> 

                                <?php
                                echo "</tr>\n";
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7" align="center">No Hay Avaluadores registrados</td>
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
