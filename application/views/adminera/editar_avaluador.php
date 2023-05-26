<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript">var baseurl = "<?php echo base_url() ?>";</script>
<script type="text/javascript" src="<?= base_url() ?>validaciones/funciones.js"></script>
<script>
    $(function () {
        $("#fechav").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>
<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminera/ver_avaluadores">Avaluadores</a></li>
            <li class="active"><a href="<?php echo base_url() ?>adminera/obt_detalle_avaluador/<?= $this->cifrar->enc($this->session->userdata("codava")) ?>">Perfil</a></li>
            <li class="active">Editar</li>
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
            Editar Avaluador
        </div>
        <div class="panel-body">
            <?= @$error ?>
            <form action="<?php echo base_url() ?>adminera/update_avaluador" enctype="multipart/form-data" method="post">

                <div class="form-group col-sm-6">
                    <label for="razon">Nombres</label>
                    <input type="text" class="form-control" id="razon" name="nombres" placeholder="Nombre del Avaluador" value="<?= $registro->nombres ?>" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="nit">Apellidos </label>
                    <input type="text" class="form-control" id="nit" name="apellidos" placeholder="Apellidos AVALUADOR" value="<?= $registro->apellidos ?>" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="nombre">Lugar de Nacimiento </label>
                    <input type="text" class="form-control" id="nombre" name="lugar_nac" placeholder="Lugar Nacimiento" value="<?= $registro->lugar_nac ?>" required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="nit">Tipo documento </label>
                    <select class="form-control"  name="codtipo_documento" required>
                        <option value="<?= $registro->codtipo_documento ?>"><?= $registro->tipodocumento ?></option>
                        <?php
                        if ($tipodoc) {
                            foreach ($tipodoc as $row) {
                                ?>
                                <option value="<?= $row['codtipo_documento'] ?>"><?= $row['nombre'] ?></option>
                                <?php
                            }
                        } else {
                            echo"<option value='1'>No hay datos</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <label for="cc">Numero de documento: </label>
                     <span id="msjver"></span>
                    <input type="text" class="form-control" id="ncedula" name="cedula" value="<?= $registro->cedula ?>" placeholder="Documento del Avaluador" required>
                </div>
                <div class="form-group col-sm-4" >
                    <label for="fecha">Fecha Expedicion </label>
                    <input type="date" id="txtfecha" name="fechaex_id" class="form-control" value="<?= $registro->fechaex_id ?>" required=""/> 
                </div>
                <div class="form-group col-sm-6">
                    <label for="telefono">Domicilio </label>
                    <input type="text" class="form-control" id="telefono" name="domicilio" value="<?= $registro->domicilio ?>" placeholder="Direccion de Residencia" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="acto">Telefono </label>
                    <input type="text" class="form-control" id="acto" name="telefono" value="<?= $registro->telefono ?>" placeholder="Telefono" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Celular</label>
                    <input type="text" class="form-control" name="celular" id="celular" value="<?= $registro->celular ?>"  placeholder="Celular Avaluador" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Correo</label>
                    <input type="email" class="form-control" name="correo" placeholder="Correo Electronico" value="<?= $registro->correo ?>" id="fecha" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Regimen inscripcion</label>
                    <input type="text" class="form-control" name="regimen_inscripcion"  placeholder="Regimen de Incripcion" value="<?= $registro->regimen_inscripcion ?>" id="regimen" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Fecha Inscripcion</label>
                    <input type="text" class="form-control" name="fechainscripcion" id="fecha" value="<?= $registro->fechainscripcion ?>" readonly="">
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Fecha de Vencimiento</label>
                    <input type="text" class="form-control" name="fechainscripcion" id="fechav" value="<?= $registro->fechavencimiento ?>" required="">
                </div>

                <div class="form-group col-sm-6">
                    <label for="clase">Estado</label>
                    <select class="form-control" required="" name="codestado">
                        <option value="<?= $registro->codestado ?>"><?= $registro->estado ?></option>
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
                <div class="form-group col-sm-6">

                    <label>Categorias: </label>
                    <?php
                    if ($categorias) {
                        foreach ($categorias as $row) {
                            ?>
                            <span class="form-control-static"><?= $row['nombre'] ?></span>,
                            <?php
                        }
                    } else {
                        echo"<option value='1'>No tiene categoria</option>";
                    }
                    ?>
                    <a target="_blank"  data-toggle="modal" data-target="#modelpass" class="btn btn-default btn-small">Cambiar categorias</a>       
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Registro de Industria</label>
                    <input type="text" class="form-control" name="regindustria" value="<?= $registro->regindustria ?>" placeholder="Registro de Industria" id="regimen">
                </div>
                <div class="col-sm-12">
                    <div class="thumbnail">
                        <img class="imgperfil" src="<?= base_url() ?>uploads/imagenes/<?= $registro->foto ?>" alt="imagen">
                        <div class="caption">

                            <label for="fecha">Foto</label>
                            <input type="file" class="form-control" name="foto" id="regimen" placeholder="Imagen del perfil"  >
                        </div>
                    </div>
                </div>

                <div class="form-group col-sm-6">
                    <label for="fecha">Hoja de vida</label>
                    <?php if ($registro->soporte) { ?>
                        <a target="blank" href="<?= base_url() ?>uploads/archivos/<?= $registro->soporte ?>">Hoja de vida</a>
                        <?php
                    } else {
                        echo "No ha Subido Hoja de vida";
                    }
                    ?>
                    <input type="file" class="form-control" name="soporte" placeholder="Hoja de vida PDF con soportes" value="<?= base_url() ?>uploads/imagenes/<?= $registro->foto ?>" id="regimen" >
                </div>
                
                 <div class="form-group col-sm-6">
                    <label for="fecha">Formato Solicitud</label>
                    <?php if ($registro->formato_solicitud) { ?>
                        <a target="blank" href="<?= base_url() ?>uploads/archivos/solicitudes/<?= $registro->formato_solicitud ?>">Ver formato</a>
                        <?php
                    } else {
                        echo "No ha subido formato de solicitud";
                    }
                    ?>
                    <input type="file" class="form-control" name="formato_solicitud" placeholder="Formato de solicitud" >
                </div>


                <div class="col-sm-12">
                    <button type="submit" id="btnreg" class="btn btn-success centered">Actualizar</button>
                    <span id="msjverbtn"></span>
                </div>
            </form>

        </div>    

    </div>
    <ul class="pager">
        <li class="previous">
            <a href="<?php echo base_url() ?>adminera/obt_detalle_avaluador/<?= $this->cifrar->enc($this->session->userdata("codava")) ?>">&larr; Atras</a>

        </li>
        <li class="next">
            <a href="#">Adelante &rarr;</a>
        </li>
    </ul>
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

<!-----------MODAL PARA CAMBIAR LAS CATEGORIAS DE UN AVALAUDOR-------------------------->

<div class="modal fade" id="modelpass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cambiar Contraseña</h4>
            </div>
            <form action="<?php echo base_url() ?>adminera/upd_cat_ava" enctype="multipart/form-data" method="POST" name="formulario">
                <div class="modal-body">
                    <div class="form-group col-sm-6">
                        <label>Categorias Asignadas: </label>
                        <?php
                        if ($categorias) {
                            foreach ($categorias as $row) {
                                ?>
                                <span class="form-control-static"><?= $row['nombre'] ?></span>,
                                <?php
                            }
                        } else {
                            echo"<option value='1'>No tiene categoria</option>";
                        }
                        ?>

                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nit">Cambiar a: </label>
                        <select id="done" name="categorias[]" class="selectpicker" multiple data-done-button="true">

                            <?php
                            if ($categoriasv) {
                                foreach ($categoriasv as $row) {
                                    ?>
                                    <option value="<?= $row['codcategoria_avaluador'] ?>"><?= $row['nombre'] ?></option>
                                    <?php
                                }
                            } else {
                                echo"<option value='1'>No hay datos</option>";
                            }
                            ?>

                        </select>
                    </div>

                </div>
                <input type="hidden" name="numero_id" value="<?= $registro->numero_id ?>" >
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cambiar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>


<!-----------MODAL PARA EDITAR USUARIO---------------------------->








