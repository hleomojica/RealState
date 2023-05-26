<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="#">Nueva</a></li>
        </ol>
    </div>
    <script>
        $(function () {
            $("#fecha").datepicker({dateFormat: "yy-mm-dd"}).val();
        });
    </script>
    <!--------------------ASIDE--------------------->
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">Entidades ERA</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                    <a href="<?php echo base_url() . "adminraa/era" ?>" class="list-group-item ">Entidades ERA</a>
                    <a href="<?php echo base_url() . "adminraa/nueva_era" ?>" class="list-group-item active">Nueva ERA</a>

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
                Registrar Nueva Entidad Autoreguladora en el Sistema
            </div>
            <div class="panel-body">
                <p class="rojo"> <?= @$error ?> </p>
                <form action="<?php echo base_url() ?>adminraa/add_era" enctype="multipart/form-data" method="post">
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Los campos con (*) son obligatorios <?= $correcto ?>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="razon">Razon Social*</label>
                        <input type="text" class="form-control" id="razon" name="razonsocial_era" placeholder="Razon social Era"  value="<?php echo set_value('razonsocial_era'); ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nit">NIT*</label>
                        <input type="text" class="form-control" id="nit" name="nit_era" placeholder="NIT" value="<?php echo set_value('nit_era'); ?>" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="nombre">Nombre Representante legal*</label>
                        <input type="text" class="form-control" id="nombre" name="nombre_representante" placeholder="Representante" value="<?php echo set_value('nombre_representante'); ?>" required>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="nit">Tipo documento*</label>
                        <select class="form-control"  name="codtipo_documento" value="<?php echo set_value('codtipo_documento'); ?>"  required>
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
                    <div class="form-group col-sm-8">
                        <label for="cc">Numero de documento*: </label>
                        <input type="text" class="form-control" id="cc" name="numeroid_representante" value="<?php echo set_value('numeroid_representante'); ?>" placeholder="Documento representante" required>
                    </div>
                    <div class="form-group col-sm-9">
                        <label for="direccion">Direccion Entidad*: </label>
                        <input type="text" class="form-control" id="direccion" name="direccion_era" value="<?php echo set_value('direccion_era'); ?>" placeholder="Direccion Fisica" required>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="telefono">Telefono Entidad*: </label>
                        <input type="text" class="form-control" id="telefono" name="telefono_era" placeholder="Telfono" value="<?php echo set_value('telefono_era'); ?>" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="acto">Acto Administrativo*: </label>
                        <input type="text" class="form-control" id="acto" name="acto_administrativo" placeholder="Acto Administrativo de La entidad" value="<?php echo set_value('acto_administrativo'); ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="fecha">Fecha de acto*</label>
                        <input type="date" class="form-control" name="fecha_acto" id="fecha" placeholder="Año-Mes-Dia" value="<?php echo set_value('fecha_acto'); ?>" required>
                    </div>
                    <div class="form-group col-sm-6" >
                        <label for="fecha">Fecha registro* </label>
                        <input type="text" id="txtfecha" name="fecha_registro_raa" class="form-control" value="<?= date('Y-m-d') ?>" readonly> 
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="clase">Estado*</label>
                        <select class="form-control" required="" value="<?php echo set_value('codestado'); ?>" name="codestado">
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
                    <div class="form-group col-sm-6" >
                        <label for="fecha">Correo* </label>
                        <input type="email" id="correo" name="correo" class="form-control" value="<?php echo set_value('correo'); ?>" required=""> 
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="fecha">Logo*</label>
                        <input type="file" class="form-control" name="logo" id="regimen" placeholder="Logo de la Entidad " >
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success centered">Guardar</button>
                    </div>
                </form>
            </div>    

        </div>
    </div>
</div>

