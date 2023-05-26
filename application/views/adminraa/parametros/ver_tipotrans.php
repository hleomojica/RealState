<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>

        </ol>
    </div> 
</div>
<!---------------------------ASIDE------------------->


<!-----------------------/ASIDE----------->
<div class="col-lg-12">
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
 <div class="alert alert-success alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Precaucion! </strong>Cualquier modificacion de estos parametros puede afectar el correcto funcionamiento del sistema.
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            PARAMETROS INICIALES
        </div>
        <div class="panel-body">
            <div class="col-sm-2">
                <a href="<?php echo base_url() ?>adminraa/ver_parametros" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/home2.png" alt="imagen">
                    <p contenteditable>Inicio</p>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="<?php echo base_url() ?>adminraa/ver_estados" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/ok.png" alt="imagen">
                    <p contenteditable>Estados</p>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="<?php echo base_url() ?>adminraa/ver_tipodoc" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/documento.png" alt="imagen">
                    <p contenteditable>Tipo Documento</p>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="<?= base_url() ?>adminraa/ver_tiposan" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/sancion.png" alt="imagen">
                    <p contenteditable>Tipo Sancion</p>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="<?= base_url() ?>adminraa/ver_estadosol" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/solicitud.png" alt="imagen">
                    <p contenteditable>Estado Solicitud</p>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="<?= base_url() ?>adminraa/ver_tipotrans" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/solicitudtras.jpg" alt="imagen">
                    <p contenteditable>Tipo Transaccion</p>
                </a>
            </div>

        </div>
    </div>
    <h4><strong>Parametros Iniciales del Sistema</strong></h4>
    <a data-href=""  data-toggle="modal" data-target="#confirm-delete" href="#" class="btn btn-primary btn-sm">
        <span class="glyphicon glyphicon-plus"></span> Nueva
    </a>
    <div class="table-responsive span3">
        <table  class = "table table-bordered">
            <thead>
                <tr>

                    <th>Codigo</th>
                    <th>Valor</th>
                    <th>Editar</th>
                    


                </tr>
            </thead>
            <tbody>
                <?php
                if ($tipo_trans) {
                    foreach ($tipo_trans as $row) {
                        echo "<tr>\n";

                        echo "<td>\n" . $row['codtipo_transaccion'] . "</td>";
                        echo "<td>\n" . $row['nombre'] . "</td>";
                        ?> 
                    <td><a class="btn btn-success btn-xs" href="<?php echo base_url() ?>adminraa/obt_tipotrans_edit/<?= $this->cifrar->enc($row['codtipo_transaccion']) ?>">
                            <span class="glyphicon glyphicon-pencil"></span> Editar
                        </a></td>

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

<!-----------------------MODAL PARA BUCAR--------------------------->

<div class="modal fade" id="modelusr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cedula de Avaluador</h4>
            </div>
            <form action="<?php echo base_url() ?>adminera/nueva_soltraslado" enctype="multipart/form-data" method="post">
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



