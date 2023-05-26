<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li class="active"><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
        </ol>
    </div>
</div>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
<script type="text/javascript" src="<?= base_url() ?>js/bootstrapValidator.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/funciones.js"></script>
<!---------------------------ASIDE------------------->
<div class="col-sm-3">
    <div class="panel panel-default">
        <div class="panel-heading">ERA</div>
        <div class="panel-body">
            <div class="list-group">
                <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                <a href="<?php echo base_url() . "adminera/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                <a href="<?php echo base_url() . "adminera/ver_comite" ?>" class="list-group-item ">Comite</a>
                <a href="<?php echo base_url() . "adminera/ver_certificados" ?>" class="list-group-item ">Certificados</a>
                <a href="<?php echo base_url() . "adminera/ver_sanciones" ?>" class="list-group-item active">Sanciones</a>
                <a href="<?php echo base_url() . "adminera/ver_traslados" ?>" class="list-group-item ">Traslados</a>
                <a href="<?php echo base_url() . "adminera/ver_usuarios" ?>" class="list-group-item ">Usuarios</a>
                <hr>
                <a href="<?php echo base_url() . "adminera/configuracion" ?>" class="list-group-item">Configuración</a>
            </div>
        </div>
    </div>
</div>

<!-----------------------/ASIDE----------->
<script>
    $(function () {
        $("#fechas").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>
<script>
    $(function () {
        $("#fechass").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>
<script>
    $(function () {
        $("#fecharegistro").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>
<script>
    $(function () {
        $("#fechafin").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>

<!------------------------/CONTENIDO CENTRAL-------------------------------->
<div class="col-lg-9">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Registrar Nueva sanción en el Sistema Con AJAX:
        </div>
        <div class="panel-body">
            <hr>
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
            <?= @$error ?>
          <form action="<?php echo base_url() ?>adminera/do_uploads" enctype="multipart/form-data" method="post" id="defaultForm">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Error!</strong><?php echo validation_errors(); ?>
            </div>

           
            <div class="form-group col-sm-6">
                <label for="nit">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value('nombre'); ?>" placeholder="Año-Mes-Dia" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="nombre">Numero</label>
                <input type="text" class="form-control" id="numero" name="numero" value="<?php echo set_value('numero'); ?>" placeholder="Año-Mes-Dia"  required>
            </div>

            <div class="form-group col-sm-12">
                <label for="soporte">Imagen</label>
                <input type="file" class="form-control" name="foto" placeholder="Documento Soporte del Comite"  required="" >
            </div>
            <div class="col-sm-12">
                <button type="submit" id="btnreg" class="btn btn-success centered ">Guardar</button>
            </div>
          
                        </form>


        </div>
    </div>

</div>    

</div>
</div>
<!------------------------/CONTENIDO CENTRAL-------------------------------->
</div>
