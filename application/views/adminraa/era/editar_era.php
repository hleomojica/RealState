<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminraa/era">Entidades</a></li>
            <li><a href="<?php echo base_url() ?>adminraa/obtener_detalle/<?=$this->cifrar->enc($this->session->userdata("codent")); ?>">Detalle</a></li>
            <li class="active">Editar</li>
        </ol>
    </div>  
   <!--------------------ASIDE--------------------->
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">Entidades ERA</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                    <a href="<?php echo base_url() . "adminraa/era" ?>" class="list-group-item active">Entidades ERA</a>
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
                    <a href="#" class="list-group-item">Certificados</a>
                </div>
            </div>
        </div>
        <hr>
    </div>
<!------------------------/ASIDE--------------->
    <div class="col-lg-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Eitar Entidad Autoreguladora en el Sistema
            </div>
            <div class="panel-body">
                   <?= @$error ?>
                <form action="<?php echo base_url() ?>adminraa/update_era" enctype="multipart/form-data" method="post">

                    <div class="form-group col-sm-6">
                        <label for="razon">Razon Social</label>
                        <input type="text" class="form-control" id="razon" name="razonsocial_era" value="<?= $registro->razonsocial_era ?>"  required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nit">NIT </label>
                        <input type="text" class="form-control" id="nit" name="nit_era"value="<?= $registro->nit_era ?>" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="nombre">Nombre Representante legal </label>
                        <input type="text" class="form-control" id="nombre" name="nombre_representante" value="<?= $registro->nombre_representante ?>" required>
                    </div>
                   <div class="form-group col-sm-4">
                    <label for="nit">Tipo documento </label>
                    <select class="form-control"  name="codtipo_documento" required>
                        <option value="<?= $registro->codtipo_documento ?>"><?= $registro->tipoid_representante ?></option>
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
                        <label for="cc">Numero de documento: </label>
                        <input type="text" class="form-control" id="cc" name="numeroid_representante" value="<?= $registro->numeroid_representante ?>" required>
                    </div>
                    <div class="form-group col-sm-9">
                        <label for="direccion">Direccion Entidad: </label>
                        <input type="text" class="form-control" id="direccion" name="direccion_era" value="<?= $registro->direccion_era ?>" required>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="telefono">Telefono Entidad </label>
                        <input type="text" class="form-control" id="telefono" name="telefono_era" value="<?= $registro->telefono_era ?>" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="acto">Acto Administrativo </label>
                        <input type="text" class="form-control" id="acto" name="acto_administrativo" value="<?= $registro->acto_administrativo ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" name="fecha_acto" value="<?= $registro->fecha_acto ?>" id="fecha" required>
                    </div>
                    <div class="form-group col-sm-6" >
                        <label for="fecha">Fecha registro </label>
                        <input type="date" id="txtfecha" name="fecha_registro_raa" class="form-control" value="<?php echo date("Y-n-j"); ?>" disabled/> 
                    </div>

                     <div class="form-group col-sm-4">
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
                    <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img class="logo" src="<?= base_url() ?>uploads/imagenes/<?= $registro->logo ?>" alt="imagen">
                        <div class="caption">
                           
                                <label for="fecha">Logo</label>
                                <input type="file" class="form-control" name="logo" id="regimen" placeholder="Logo de la ENTIDAD"  >
                           </div>
                    </div>
                </div>

                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success centered">Guardar</button>
                    </div>
                </form>

            </div>    

        </div>
    </div>
</div>

</div>
