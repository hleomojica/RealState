<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
             <li><a href="#">Avaluadores</a></li>
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
                <a href="<?php echo base_url() . "adminera/ver_avaluadores" ?>" class="list-group-item active">Avaluadores</a>
                <a href="<?php echo base_url() . "adminera/ver_comite" ?>" class="list-group-item ">Comite</a>
                <a href="<?php echo base_url() . "adminera/ver_certificados" ?>" class="list-group-item ">Certificados</a>
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
<div class="col-lg-9">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Opciones
        </div>
        <div class="panel-body">
            <div class="col-sm-2">
                <a href="<?= base_url() ?>adminera/crear_avaluador" class="thumbnail">
                    <img class="iconop" src="<?= base_url() ?>herramientas/images/iconoadd.png" alt="imagen">
                    <p contenteditable>Nuevo</p>
                </a>
            </div>
            <div class="col-lg-9"><div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Click en<strong> !Nuevo!</strong> Para registrar un nuevo avaluador
                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Todos Los avaluadores
        </div>
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
        <div class="panel-body">
            <form class="form col-sm-4" method="post" action="<?php echo base_url() ?>adminera/bus_ava_nombre">
                <div class="form-group">
                    <label for="buscar">Buscar Por nombre</label>
                    <input type="text" class="form-control" id="buscar"  name="nombre" value="" placeholder="Escriba aqui el nombre">
                </div>
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span> Buscar
                </button>

            </form>
            <form class="form col-sm-4" method="post" action="<?php echo base_url() ?>adminera/bus_ava_cedula">
                <div class="form-group">
                    <label for="buscar">Buscar Por Cedula</label>
                    <input type="text" class="form-control" id="buscar"  name="cedula" placeholder="Escriba aqui la cedula">
                </div>
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span> Buscar
                </button>

            </form>
            <form class="form col-sm-4" method="post" action="<?php echo base_url() ?>adminera/bus_ava_estado">
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
                            echo"<option value='1'>No hay opciones</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span> Buscar
                </button>
            </form>
         </div>



        <div class="table-responsive span3"> 

            <table  class = "table table-bordered">
                <thead>
                    <tr>
                        <th>Ver Perfil</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Documento</th>
                        <th>Celular</th>
                        <th>telefono</th>
                        <th>Codigo </th>
                        <th>estado</th>

                    </tr>
                </thead>
                <tbody>


                    <?php
                    if ($avaluadores) {
                        foreach ($avaluadores as $avaluadores) {
                            echo "<tr>\n";
                            ?>
                    <td><a class="btn btn-success btn-xs" href="<?php echo base_url() ?>adminera/obt_detalle_avaluador/<?= $this->cifrar->enc($avaluadores["numero_id"]) ?>">
                                    <span class="glyphicon glyphicon-eye-open"></span> Perfil
                     </a></td>
                        <?php
                        echo "<td>\n" . $avaluadores['nombres'] . "</td>";
                        echo "<td>\n" . $avaluadores['apellidos'] . "</td>";
                        echo "<td>\n" . $avaluadores['cedula'] . "</td>";
                        echo "<td>\n" . $avaluadores['celular'] . "</td>";
                        echo "<td>\n" . $avaluadores['telefono'] . "</td>";
                        echo "<td>\n" . $avaluadores['codigoavaluador'] . "</td>";
//                        echo "<td>\n" . $avaluadores['estado'] . "</td>";
                        ?> 
                            <td class="<?php
                if ($avaluadores['estado'] == 'Activo') {
                    echo 'verde';
                } else {
                    echo 'rojo';
                }?>" ><strong><?= $avaluadores['estado'] ?></strong></td>
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

</div>






<script type="text/javascript">
    $(document).ready(function () {
        $('#confirm-delete').on('show.bs.modal', function (e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Eliminar Registro
            </div>
            <div class="modal-body">
                Esta seguro que desea Eliminar El registro del sistema?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger">Delete</a>
            </div>
        </div>
    </div>
</div>


</div>
</div>
