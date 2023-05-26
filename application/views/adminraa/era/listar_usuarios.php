<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript">
    function confirma() {
        if (confirm("¿Desea eliminar Usuario??")) {
            alert("El registro ha sido eliminado.")
        }
        else {
            return false
        }
    }
</script>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li>Usuarios</li>
        </ol>
    </div>    
<!--    ------------------ASIDE-------------------
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">Entidades ERA</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                    <a href="<?php echo base_url() . "adminraa/era" ?>" class="list-group-item">Entidades ERA</a>
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
    ----------------------/ASIDE--------------->
    <!----------------------------/ASIDE------------------------------->
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
        <div class="panel panel-primary">
            <div class="panel-heading">
               Usuarios del Sistema
            </div>

            <div class="panel panel-body">
                <div class="col-sm-12">

                    <div class="col-xs-2">
                        <a href="#" class="fa thumbnail" data-toggle="modal" data-target="#modelusr">
                            <img class="icono" src="<?= base_url() ?>herramientas/images/iconoadd.png" alt="imagen">
                            <p contenteditable>Nuevo</p>
                        </a>

                    </div>
                    <form class="form col-sm-4" method="post" action="<?php echo base_url() ?>adminraa/bus_usr_nombre">
                    <div class="form-group">
                        <label for="buscar">Buscar Por nombre</label>
                        <input type="text" class="form-control" id="buscar"  name="nombre" value="" placeholder="Escriba aqui el nombre">
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span> Buscar
                    </button>
                </form>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
               Todos los usuarios
            </div>
            <div class="panel-body">
                
            </div>
            <div class="table-responsive span3"> 
                <table  class = "table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Correo</th>
                            <th>nombre Usuario</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>ERA</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($registro) {
                            foreach ($registro as $avaluadores) {
                                echo "<tr>\n";
                                ?>

                                <?php
                                echo "<td>\n" . $avaluadores['nombres'] . "</td>";
                                echo "<td>\n" . $avaluadores['correo'] . "</td>";
                                echo "<td>\n" . $avaluadores['nombreusuario'] . "</td>";
                                echo "<td>\n" . $avaluadores['perfil'] . "</td>";
                                echo "<td>\n" . $avaluadores['estado'] . "</td>";
                                echo "<td>\n" . $avaluadores['era'] . "</td>";
                                ?> 

                            <td><a class="btn btn-success btn-xs" href="<?php echo base_url() ?>adminraa/obt_usr_edit2/<?= $this->cifrar->enc($avaluadores["codusuario"]) ?>">
                                    <span class="glyphicon glyphicon-pencil"></span> Editar
                                </a></td>

                            <td><a  data-href="<?php echo base_url() ?>adminraa/usr_eliminar2/<?= $this->cifrar->enc($avaluadores["codusuario"]) ?>"  data-toggle="modal" data-target="#confirm-delete" href="#" class="btn btn-danger btn-xs">
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
        </div>
    </div>

    <!--------------------------------------FIN TABLA---------------------------->

    <!----------- /MODALES PARA NUEVO USUARIO----------------------------->

    <div class="modal fade" id="modelusr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Crear Nuevo Usuario en el Sistema</h4>
                </div>
                <form action="<?php echo base_url() ?>adminraa/add_usr2" enctype="multipart/form-data" method="POST" name="formulario">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control" name="nombres" id="exampleInputPassword1" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" name="correo" id="exampleInputPassword1" required>
                        </div>
                        <div class="form-group">
                            <label for="nombreusuario">Nombre de Usuario</label>
                            <input type="text" class="form-control" name="nombreusuario" id="exampleInputPassword1" required>
                        </div>
                        <div class="form-group">
                            <label for="clave">Clave</label>
                            <input type="password" class="form-control" name="clave" id="clave" required>
                        </div>
                        <div class="form-group">
                            <label for="clave">Era</label>
                            <select class="form-control"  name="codera" required>
                                <option value="0">No tiene</option>
                                <?php
                                if ($eras) {
                                    foreach ($eras as $row) {
                                        ?>
                                        <option value="<?= $row['codera'] ?>"><?= $row['razonsocial_era'] ?></option>
                                        <?php
                                    }
                                } else {
                                    echo"<option value='1'>No hay datos</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="clave">Perfil</label>
                            <select class="form-control"  name="codperfil" required>

                                <?php
                                if ($perfiles) {
                                    foreach ($perfiles as $row) {
                                        ?>
                                        <option value="<?= $row['codperfil'] ?>"><?= $row['nombre'] ?></option>
                                        <?php
                                    }
                                } else {
                                    echo"<option value='1'>No hay datos</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="clase">Estado</label>
                            <select class="form-control" required="" name="codestado">

                                <?php
                                if ($estados) {
                                    foreach ($estados as $row) {
                                        ?>
                                        <option value="<?= $row['codestado_usuarios'] ?>"><?= $row['nombre'] ?></option>
                                        <?php
                                    }
                                } else {
                                    echo"<option value='1'>No hay estados</option>";
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form> 
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
                Eliminar Usuario
            </div>
            <div class="modal-body">
                ¿Esta seguro de eliminar el usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>