<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link href="<?php echo base_url('herramientas/css/jquery-ui.min.css') ?>" rel="stylesheet">
<script src="<?php echo base_url('herramientas/js/jquery-ui.min.js') ?>"></script>
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4.js') ?>"></script>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminera/ver_traslados">Traslados</a></li>
            <li class="active">Nueva solicitud</li>
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
                <a href="<?php echo base_url() . "adminera/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                <a href="<?php echo base_url() . "adminera/ver_comite" ?>" class="list-group-item ">Comite</a>
                <a href="<?php echo base_url() . "adminera/ver_certificados" ?>" class="list-group-item ">Certificados</a>
                <a href="<?php echo base_url() . "adminera/ver_sanciones" ?>" class="list-group-item ">Sanciones</a>
                <a href="<?php echo base_url() . "adminera/ver_traslados" ?>" class="list-group-item active">Traslados</a>
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
    <div class="panel panel-primary">
        <div class="panel-heading">
            Registrar Traslado y generar Paz y salvo
        </div>
        <div class="panel-body">
            <h3>Solicitar traslado de Avaluador: </h3>
            <h4>Avaluador:<span class="rojo"> <?= $avaluadores->nombres . " " . $avaluadores->apellidos ?></span></h4>
            <h4>Documento:<span class="rojo"> <?= $avaluadores->cedula ?></span></h4>
            <a href="<?php echo base_url() ?>certificados/pazysalvo/<?= $this->cifrar->enc($avaluadores->numero_id)?>"
               class="btn btn-primary centered"><span class="glyphicon glyphicon-save"></span>Certificado</a> 
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
            <form action="<?php echo base_url() ?>adminera/add_soltraslado" enctype="multipart/form-data" method="post" id="formulario">

                <div class="form-group col-sm-6">
                    <label for="cc">Fecha:</label>
                    <input type="text" class="form-control" id="cc" name="fecha" value="<?= date('Y-m-d') ?>" placeholder="Observaciones" readonly>
                </div>

                <div class="form-group col-sm-4">
                    <label for="nit">Traslado a: </label>
                    <select class="form-control"  name="coderasolicitada" required>
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
                <div class="form-group col-sm-6">
                    <label for="fecha">Formato de solicitud de traslado</label>
                    <input type="file" class="form-control" name="soporte" placeholder="Formato de solicitud" id="regimen" required="" >
                     <p class="rojo">Maximo tamaño 2MB</p>
                </div>
                <input type="hidden" name="coderasolicitante" value="<?= $this->session->userdata('era'); ?>">
                <input type="hidden" name="numero_id" value="<?= $avaluadores->numero_id; ?>">
                <input type="hidden" name="codestado_solicitudtras" value="1">

                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <button  type="submit" class="btn btn-success centered " id="eviar">Registrar</button>

                    </div>
                    <div class="col-sm-9"><div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Click en<strong> Registrar</strong> Para registrar solicitud y generar Paz y Salvo.
                        </div>
                    </div>
                </div>
            </form>


        </div>    

    </div>
</div>
<!------------------------/CONTENIDO CENTRAL-------------------------------->
</div>

</div>


<script>
    $(function () {
        $("#fechita").datepicker();
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#envio").click(function () {
            location.reload();
        });
    });
</script>
