<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4') ?>"></script>
<script src="<?php echo base_url('herramientas/datatables/java.js') ?>"></script>
<link href="<?php echo base_url('herramientas/datatables/estilo.css') ?>" rel="stylesheet">

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li class="active">Categorias</li>

        </ol>
    </div>  
    <!--------------------ASIDE--------------------->
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">Entidades ERA</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item">Inicio</a>
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
                    <a href="<?php echo base_url() . "adminraa/ver_categorias" ?>" class="list-group-item active ">Categorias</a>
                    <a href="<?php echo base_url() . "adminraa/ver_certificados" ?>" class="list-group-item">Certificados</a>
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
                Categorias de Avaluadores
            </div>
            <div class="panel panel-body">
                <div class="col-sm-12">

                    <div class="col-xs-2">
                        <a href="#" class="fa thumbnail" data-toggle="modal" data-target="#modelcat">
                            <img class="icono" src="<?= base_url() ?>herramientas/images/iconoadd.png" alt="imagen">
                            <p contenteditable>Nueva</p>
                        </a>

                    </div>
                </div>
            </div>

        </div>
        <h4><strong>Categorias Registradas</strong></h4>
        <div class="table-responsive "> 
            <table  class = "table table-bordered" id="tabla">
                <thead>
                    <tr>

                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Editar</th>

                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($categorias) {
                        foreach ($categorias as $avaluadores) {
                            echo "<tr>\n";
                            ?>

                            <?php
                            echo "<td>\n" . $avaluadores['nombre'] . "</td>";
                            echo "<td>\n" . $avaluadores['estado'] . "</td>";
                            ?> 



                        <td><a class="btn btn-success btn-xs" href="<?php echo base_url() ?>adminraa/obt_cat_editar/<?= $this->cifrar->enc($avaluadores["codcategoria_avaluador"]) ?>">
                                <span class="glyphicon glyphicon-pencil"></span> Editar
                            </a></td>

                        <td><a  data-href="<?php echo base_url() ?>adminraa/cat_eliminar/<?= $this->cifrar->enc($avaluadores["codcategoria_avaluador"]) ?>"  data-toggle="modal" data-target="#confirm-delete" href="#" class="btn btn-danger btn-xs">
                                <span class="glyphicon glyphicon-trash"></span> Eliminar
                            </a></td>
                        <?php
                        echo "</tr>\n";
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" align="center">No hay Usuarios Registrados</td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>


            </table>
        </div>


        <!--------------------------------------FIN TABLA---------------------------->
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


<!----------- /MODALES PARA NUEVO USUARIO----------------------------->

<div class="modal fade" id="modelcat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nueva categoria</h4>
            </div>
            <form action="<?php echo base_url() ?>adminraa/add_cat" enctype="multipart/form-data" method="POST" name="formulario">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" name="nombre" id="exampleInputPassword1" required>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="clase">Estado</label>
                        <select class="form-control" required="" name="codestado">
                            <?php
                            if ($estados) {
                                foreach ($estados as $row) {
                                    ?>
                                    <option value="<?= $row['codestado'] ?>"><?= $row['nombre'] ?></option>
                                    <?php
                                }
                            } else {
                                echo"<option value='1'>No hay datos</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#tabla').DataTable({
            responsive: true
        });
    });
</script>

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
                Eliminar Categoria
            </div>
            <div class="modal-body">
                ¿Esta seguro de eliminar la categoria?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

