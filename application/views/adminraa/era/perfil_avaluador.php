<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminraa/ver_avaluadores">Avaluadores</a></li>
            <li class="active">Perfil</li>
        </ol>
    </div>  
<!--------------------ASIDE--------------------->
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">Entidades ERA</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                    <a href="<?php echo base_url() . "adminraa/era" ?>" class="list-group-item ">Entidades ERA</a>
                    <a href="<?php echo base_url() . "adminraa/nueva_era" ?>" class="list-group-item ">Nueva ERA</a>
                    
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">AVALUADORES</div>
            <div class="panel-body">

                <div class="list-group">
                    <a href="<?php echo base_url() . "adminraa/ver_avaluadores" ?>" class="list-group-item active">Avaluadores</a>
                    <a href="<?php echo base_url() . "adminraa/ver_categorias" ?>" class="list-group-item ">Categorias</a>
                    <a href="<?php echo base_url() . "adminraa/ver_certificados" ?>" class="list-group-item">Certificados</a>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <!------------------------/ASIDE--------------->
    <!------------------------/CONTENIDO CENTRAL-------------------------------->
    <div class="col-lg-9">

        <div class="panel panel-primary">

            <div class="panel-heading">
                Avaluador : <?= $registro->nombres ?>
            </div>
            <div class="panel panel-body">
                 <form>
                    <div class="row">
                         <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img class="imgperfil" src="<?= base_url() ?>uploads/imagenes/<?=$registro->foto?>" alt="imagen">
                                <div class="caption">
                                    <p>...</p>
                                     </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Nombre: </label>
                            <span class="form-control-static"><?= $registro->nombres ?></span>
                        </div>
                         <div class="form-group col-sm-3">
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
                        <label>Codigo Avaluador: </label>
                        <span class="form-control-static"><?= $registro->codigoavaluador ?></span>
                    </div>
                        <div class="form-group col-sm-3">
                        <label>Fecha Expedicion: </label>
                        <span class="form-control-static"><?= $registro->fechaex_id ?></span>
                    </div>
                       
                        <div class="form-group col-sm-3">
                        <label>Domicilio: </label>
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
                       <span  class="<?php
                            if ($registro->estado == 'Activo') {
                                echo 'verde';
                            } else {
                                echo 'rojo';
                            }
                            ?>"><strong><?= $registro->estado ?></strong></span>
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
                        <div class="form-group col-sm-6">
                            <label for="fecha">Hoja de vida:</label>
                            <?php if ($registro->soporte) { ?>
                                <a target="_blank" href="<?= base_url() ?>uploads/archivos/<?= $registro->soporte ?>">Hoja de vida</a>
                                <?php
                            } else {
                                echo "No ha Subido Hoja de vida";
                            }
                            ?>

                        </div>
                        <div class="form-group col-sm-6">
                            <label for="fecha">Formato de solicitud:</label>
                            <?php if ($registro->formato_solicitud) { ?>
                                <a target="_blank" href="<?= base_url() ?>uploads/archivos/solicitudes/<?= $registro->formato_solicitud ?>">Ver formato de solicitud</a>
                                <?php
                            } else {
                                echo "No ha subido formato de solicitud";
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


    <p><a class="btn  btn-default btn-lg" href="<?= base_url() ?>adminraa/ver_avaluadores" >Volver</a></p>

</div>
