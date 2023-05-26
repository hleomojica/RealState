<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminera/ver_comite">Comite</a></li>
            <li><a href="<?php echo base_url() ?>adminera/ver_solicitudes">Solicitudes</a></li>
            <li class="active">Respuesta</li>
        </ol>
    </div>  
<!---------------------------ASIDE------------------->
<div class="col-sm-3">
    <div class="panel panel-default">
        <div class="panel-heading">ERA</div>
        <div class="panel-body">
            <div class="list-group">
                <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                <a href="<?php echo base_url() . "adminera/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                <a href="<?php echo base_url() . "adminera/ver_comite" ?>" class="list-group-item active">Comite</a>
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

        <div class="panel panel-primary">

            <div class="panel-heading">
               Responder Solicitud
            </div>
            
            <div class="panel panel-body">
                
                    <div class="row">
                       <div class="form-group col-sm-3">
                            <label>Avaluador: </label>
                            <span class="form-control-static"><?= $solicitudes[0]['nombres'] ?></span>
                            <span class="form-control-static"><?= $solicitudes[0]['apellidos'] ?></span>
                        </div>
                        
                        <div class="form-group col-sm-3">
                            <label>Numero Documento: </label>
                            <span class="form-control-static"><?= $solicitudes[0]['cedula'] ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Detalle </label>
                            <span class="form-control-static"><?= $solicitudes[0]['detalle'] ?></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Observaciones: </label>
                            <span class="form-control-static"><?= $solicitudes[0]['observacion'] ?></span>
                        </div>
                        
                  <?=@$error?>
                <form action="<?php echo base_url() ?>adminera/responder_solicitud" enctype="multipart/form-data" method="post">
                    <div class="form-group col-sm-4">
                        <label for="nit">Comite:</label>
                        <select class="form-control"  name="codcomite" required>
                            <?php
                            if ($comites){
                                foreach ($comites as $row) { ?>
                                <option value="<?= $row['codcomite'] ?>"><?= $row['fecha'] ?></option>
                            <?php }}else{
                                echo"<option value='1'>No hay datos</option>";
                            } ?>
                        </select>
                    </div>
                       <div class="form-group col-sm-4">
                           <label for="nit">Estado Solicitud:</label>
                        <select class="form-control"  name="codestado_solicitud" required>
                            <?php
                            if ($estados){
                                foreach ($estados as $row) { ?>
                                <option value="<?= $row['codestado_solicitud'] ?>"><?= $row['nombre'] ?></option>
                            <?php }}else{
                                echo"<option value='1'>No hay datos</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="cc">Respuesta </label>
                        <input type="text" class="form-control" id="cc" name="respuesta" placeholder="Respuesta" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="cc">Observacion </label>
                        <input type="text" class="form-control" id="cc" name="observaciones" placeholder="Observaciones" required>
                    </div>
                    <input type="hidden" name="codsolicitud" value="<?= $solicitudes[0]['codsolicitud'] ?>" >
                    <input type="hidden" name="numero_id" value="<?= $solicitudes[0]['numero_id'] ?>" >
                    
                    
                    
                        <div class="col-sm-12">
                        <button type="submit" class="btn btn-success centered">Enviar</button>
                    </div>

                </form>

            </div>    
        </div>
    </div>
</div>
<ul class="pager">
        <li class="previous">
            <a href="<?= base_url() ?>adminera/ver_solicitudes">&larr; Atras</a>
        </li>
        <li class="next">
            <a href="#">Adelante &rarr;</a>
        </li>
    </ul>
</div>

