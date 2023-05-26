<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script src="<?php echo base_url('herramientas/datatables/java.js') ?>"></script>
<link href="<?php echo base_url('herramientas/datatables/estilo.css') ?>" rel="stylesheet">


<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li class="active">Trasacciones</li>
        </ol>
    </div> 


    <div class="col-lg-12">

        <div class="panel panel-primary">
            <div class="panel-heading">
                Transacciones Realizadas
            </div>
            <div class="panel-body">

                <form class="form col-sm-3" method="post" action="<?php echo base_url() ?>adminraa/bus_transa_nombre">
                    <div class="form-group">
                        <label for="buscar">Nombre Usuario</label>
                        <input type="text" class="form-control" id="buscar"  name="nombre" value="" placeholder="Escriba aqui el nombre">
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span> Buscar
                    </button>

                </form>
                <form class="form col-sm-3" method="post" action="<?php echo base_url() ?>adminraa/bus_transa_fecha">
                    <div class="form-group">
                        <label for="buscar">Fecha de realizado:</label>
                        <input type="text" class="form-control" id="fecha"  name="fecha" placeholder="Fecha transaccion">
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span> Buscar
                    </button>

                </form>
                <form class="form col-sm-3" method="post" action="<?php echo base_url() ?>adminraa/bus_transa_tipo">
                    <div class="form-group">
                        <label for="clase"> Tipo transaccion</label>
                        <select class="form-control"  name="codtipo">
                            <option value="">Seleccione Una Opcion</option>        
                            <?php
                            if ($tipotrans) {
                                foreach ($tipotrans as $row) {
                                    ?>
                                    <option value="<?= $row['codtipo_transaccion'] ?>"><?= $row['nombre'] ?></option>
                                    <?php
                                }
                            } else {
                                echo"<option value='1'>No hay opciones</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span> Buscar
                    </button>
                </form>
               
                <div class="form col-sm-3">
                    <label for="clase"> Buscar por periodo</label>
                    <p>
                      <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modelgen"  role="button"><span class="glyphicon glyphicon-search"></span>Buscar</a>
                      </p>
                    

                </div>
            </div>
            <div  > 
                <table  class = "table table-bordered table-striped" id="tabla">
                    <thead>
                        <tr>
                            <th>Codigo</th>

                            <th>Nombre Usuario</th>
                            <th>Fecha</th>
                            <th>Transacion</th>
                            <th>Entidad afectada</th>


                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if ($transacciones) {
                            foreach ($transacciones as $transacion) {
                                echo "<tr>\n";

                                echo "<td>\n" . $transacion['codtransaccion'] . "</td>";

                                echo "<td>\n" . $transacion['nombreusuario'] . "</td>";
                                echo "<td>\n" . $transacion['fecha'] . "</td>";
                                echo "<td>\n" . $transacion['tipo'] . "</td>";
                                echo "<td>\n" . $transacion['afectado'] . "</td>";
                                ?> 

                                <?php
                                echo "</tr>\n";
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7" align="center">No hay registros</td>
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
            <a href="<?php echo base_url() ?>login/index">&larr; Atras</a>
        </li>
        <li class="next">
            <a href="#">Adelante &rarr;</a>
        </li>
    </ul>

</div>
<script>
    $(function () {
        $("#fecha").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>

<script>
    $(document).ready(function () {
        $('#tabla').DataTable({
            responsive: true
        });
    });
</script>


<script>
    $(function () {
        $("#fecha1").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>
<script>
    $(function () {
        $("#fecha2").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>
<!-----------------------MODAL PARA BUSCAR POR PERIODO DE FECHAS---------------------------->

<div class="modal fade" id="modelgen"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Buscar Auditoria</h4>
            </div>
            <form action="<?php echo base_url() ?>adminraa/bus_transa_periodo" enctype="multipart/form-data"  method="post">
                <div class="modal-body">
                    <h4>Rango de Fechas:</h4>
                    <div class="form-group col-sm-6">
                        <label for="razon">Desde:</label>
                        <input type="text" class="form-control" id="fecha1" name="fecha1" placeholder="año-mes-dia" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nit">Hasta:</label>
                        <input type="text" class="form-control" id="fecha2" name="fecha2" placeholder="año-mes-dia" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" id="rec" class="btn btn-success" ><span class="glyphicon glyphicon-search"></span>Buscar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>
<!------------------------------MODAL PAR REPORTE GENERAL---------------------------->