<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li>Sanciones</li>

        </ol>
    </div> 
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
                    <a href="<?php echo base_url() . "entecontrol/ver_traslados" ?>" class="list-group-item">Traslados</a>
                     <a href="<?php echo base_url() . "entecontrol/ver_sanciones" ?>" class="list-group-item active">Sanciones</a>
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
            Sanciones Aplicadas
        </div>
        <div class="panel-body">
            <div class="table-responsive span3">
                <table  class = "table table-bordered">
                    <thead>
                        <tr>
                            <th>Detalle</th>
                            <th>Codigo</th>
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Tipo de Sancion</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
                        if ($sanciones) {
                            foreach ($sanciones as $sancion) {
                                echo "<tr>\n";
                                ?>
                        <td><a class="btn btn-primary btn-xs" href="<?php echo base_url() ?>entecontrol/obt_detalle_sancion/<?= $this->cifrar->enc($sancion["codsancion"]) ?>">
                                    <span class="glyphicon glyphicon-search"></span> Detalle
                                </a></td>
                           
                            <?php
                            echo "<td>\n" . $sancion['codsancion'] . "</td>";
                            echo "<td>\n" . $sancion['numero_id'] . "</td>";
                            echo "<td>\n" . $sancion['nombres'] . "</td>";
                            echo "<td>\n" . $sancion['apellidos'] . "</td>";
                            echo "<td>\n" . $sancion['tipo'] . "</td>";
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
                    <div class="form-group col-sm-6">
                        <label for="razon">Cedula;</label>
                        <input type="text" class="form-control" id="razon" name="cedula" placeholder="Ingrese Cedula de Avaluador" required>
                    </div>
                  </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Buscar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>
<!------------------------------MODAL PARA NUEVO COMITE---------------------------->



