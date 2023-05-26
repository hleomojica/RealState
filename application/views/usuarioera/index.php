<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb" >
            <li class="active"><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
        </ol>
    </div>
</div>

<!-----------ASIDE------------>
<div class="col-sm-3">
    <div class="panel panel-primary">
        <div class="panel-heading">ERA</div>
        <div class="panel-body">
            <div class="list-group">
                <a href="<?php echo base_url() ?>login/index" class="list-group-item active ">Inicio</a>
                <a href="<?php echo base_url() . "usuarioera/ver_solicitudes" ?>" class="list-group-item ">Solicitudes</a>
                <a href="<?php echo base_url() . "usuarioera/ver_sanciones" ?>" class="list-group-item ">Sanciones</a>
                <hr>
                <a href="<?php echo base_url() . "usuarioera/configuracion" ?>" class="list-group-item">Configuracion</a>
            </div>
        </div>
    </div>
</div>

<!-----------------------/ASIDE----------->


<div class="col-lg-9">
    <div class="panel panel-primary">
        <div class="panel-heading">
        </div>
        <div class="panel panel-body">
            <div class=" text-center">
                <h2><strong>Avaluador:</strong></h2>
                <h3><p class="lead"><?= $registro->nombres ?> <?= $registro->apellidos ?> </p></h3>
            </div>
            <form>
                <div class="row">
                    <div class="col-sm-4 col-md-2">
                        <div class="thumbnail">
                            <?php if ($registro->foto) { ?>
                                <img class="imgperfil" src="<?= base_url() ?>uploads/imagenes/<?= $registro->foto ?>" alt="imagen">
                                <?php
                            } else {
                                echo "No ha subido Foto";
                            }
                            ?>
                            <div class="caption">
                                <p>...</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Nombre: </label>
                        <span class="form-control-static"><?= $registro->nombres ?></span>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Apellidos: </label>
                        <span class="form-control-static"><?= $registro->apellidos ?></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Tipo documento: </label>
                        <span class="form-control-static"><?= $registro->tipodocumento ?></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Numero Documento: </label>
                        <span class="form-control-static"><?= $registro->cedula ?></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Fecha Expedicion: </label>
                        <span class="form-control-static"><?= $registro->fechaex_id ?></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>domicilio: </label>
                        <span class="form-control-static"><?= $registro->domicilio ?></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Telefono: </label>
                        <span class="form-control-static"><?= $registro->telefono ?></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Telefono Celular: </label>
                        <span class="form-control-static"><?= $registro->celular ?></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Fecha Inscripticon: </label>
                        <span class="form-control-static"><?= $registro->fechainscripcion ?></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Estado: </label>
                        <span class="form-control-static"><?= $registro->estado ?></span>
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
                     </div>
                    <div class="form-group col-sm-3">
                        <label>ERA: </label>
                        <span class="form-control-static"><?= $registro->era ?></span>
                    </div>

                </div>

            </form>

        </div> 
    </div>

</div>



