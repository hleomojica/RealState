<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminraa/era">Entidades</a></li>
            <li class="active"><a href="#">Editar</a></li>
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
                    <a href="<?php echo base_url() . "adminraa/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                    <a href="<?php echo base_url() . "adminraa/ver_categorias" ?>" class="list-group-item active">Categorias</a>
                    <a href="<?php echo base_url() . "adminraa/ver_categorias" ?>" class="list-group-item">Certificados</a>
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
                Eitar Categoria
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url() ?>adminraa/update_cat" enctype="multipart/form-data" method="post">

                    <div class="form-group col-sm-6">
                        <label for="razon">Nombre</label>
                        <input type="text" class="form-control" id="razon" name="nombre" value="<?= $registro->nombre ?>"  required>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="nit">Estado</label>
                        <select class="form-control"  name="codestado" value="<?= $registro->estado?>" required>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                            
                        </select>
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

</div>
