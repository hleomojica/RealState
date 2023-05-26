<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">var baseurl = "<?php echo base_url() ?>";</script>
<script type="text/javascript" src="<?= base_url() ?>validaciones/funciones.js"></script>


<script>
    $(function () {
        $("#fecha").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>
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
            <li class="active">Nuevo</li>
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
    <div class="panel panel-primary">
        <div class="panel-heading">
            Registrar Nuevo Avaluador en el Sistema
        </div>
        <div class="panel-body">
            <?php
            $incorrecto = $this->session->flashdata('incorrecto');
            $correcto = $this->session->flashdata('realizado');
            if ($incorrecto) {
                ?>
             <span class="rojo"><?= $incorrecto ?></span>
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
            <div class="rojo"><?= @$error ?></div>
            <span class="rojo"><?php echo validation_errors(); ?></span>
            <form action="<?php echo base_url() ?>adminera/add_avaluador" enctype="multipart/form-data" id="formava" method="post">
                
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Los campos con (*) son obligatorios <?= $correcto ?>
                </div>
                <div class="form-group col-sm-6">
                    <label for="razon">Nombres *</label>
                    <input type="text" class="form-control" id="razon" name="nombres" value="<?php echo set_value('nombres'); ?>" placeholder="Nombre del Avaluador" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="nit">Apellidos * </label>
                    <input type="text" class="form-control" id="nit" name="apellidos"  value="<?php echo set_value('apellidos'); ?>" placeholder="Apellidos del Avaluador" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="nombre">Lugar de Nacimiento * </label>
                    <input type="text" class="form-control" id="nombre" name="lugar_nac" value="<?php echo set_value('lugar_nac'); ?>"  placeholder="Lugar de nacimiento" required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="nit">Tipo de documento * </label>
                    <select class="form-control"  name="codtipo_documento" value="<?php echo set_value('codtipo_documento'); ?>" required>
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
                    <label for="cc">Numero de documento: * </label>
                    <span id="msjver"></span>
                    <input type="text" class="form-control" id="ncedula" name="cedula" value="<?php echo set_value('cedula'); ?>" placeholder="Documento del Avaluador" required>
                </div>
                <div class="form-group col-sm-3" >
                    <label for="fecha">Fecha Expedicion * </label>
                    <input type="text" id="fecha" name="fechaex_id" class="form-control" value="<?php echo set_value('fechaex_id'); ?>" placeholder="Año-Mes-Dia" value="" required=""/> 
                </div>
                <div class="form-group col-sm-8">
                    <label for="telefono">Domicilio * </label>
                    <input type="text" class="form-control" id="domicilio" name="domicilio" value="<?php echo set_value('domicilio'); ?>" placeholder="Dirección de residencia" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="acto">Telefono * </label>
                    <span id="msjtel"></span>
                    <input type="text" class="form-control" id="tel" name="telefono" value="<?php echo set_value('telefono'); ?>" placeholder="Telefono" required="">
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Celular * </label>
                    <input type="text" class="form-control" id="cel" name="celular" id="celular" value="<?php echo set_value('celular'); ?>"  placeholder="Numero celular del avaluador" required="">
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Correo * </label>
                    <input type="email" class="form-control" name="correo" value="<?php echo set_value('correo'); ?>" placeholder="Correo electronico" id="fecha" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Regimen inscripcion *</label>
                    <input type="text" class="form-control" name="regimen_inscripcion" value="<?php echo set_value('regimen_inscripcion'); ?>"  placeholder="Regimen de Incripcion" id="regimen" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Fecha Inscripcion *</label>
                    <input type="txt" class="form-control" name="fechainscripcion" id="fecha"  placeholder="AAAA-MM-DD" value="<?= date('Y-m-d') ?>" readonly>
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Fecha Vencimiento *</label>
                    <input type="txt" class="form-control" name="fechavencimiento" id="fechav" value="<?php echo set_value('fechavencimiento'); ?>" placeholder="Año-Mes-Dia"  required="">
                </div>
                <div class="form-group col-sm-4">
                    <span class="rojo"> <?php echo form_error('categorias[]'); ?></span>
                    <label for="nit">Categoria * </label>
                    <select id="done" name="categorias[]" class="selectpicker"  multiple data-done-button="true" >

                        <?php
                        if ($categorias) {
                            foreach ($categorias as $row) {
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
                <div class="form-group col-sm-4">
                    <label for="clase">Estado *</label>
                    <select class="form-control" required="" name="codestado">
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
                    <label for="fecha">Registro de Industria y Comercio </label>
                    <input type="text" class="form-control" name="regindustria"  value="<?php echo set_value('regindustria'); ?>"  placeholder="Numero de Industria y Comercio" id="regimen" >
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Tarjeta Profesional</label>
                    <input type="text" class="form-control" name="tarjetaprofesional"  value="<?php echo set_value('tarjetaprofesional'); ?>"  placeholder="Si tiene ingrese el numero" id="regimen" >
                </div>
                <div class="form-group col-sm-12">
                    <label for="fecha">Foto *</label>
                    <input type="file" class="form-control" name="foto" id="regimen" placeholder="Imagen del perfil " value="<?php echo set_value('foto'); ?>" required>
                    <p class="rojo">Maximo tamaño 1MB</p>
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Hoja de vida</label>
                    <input type="file" class="form-control" name="soporte" placeholder="Hoja de vida PDF con soportes" id="regimen" >
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Formato de solicitud</label>
                    <input type="file" class="form-control" name="formato_solicitud" placeholder="Formato de solicitud" id="regimen" >
                </div>
                

                <div class="col-sm-12">
                    <button type="submit" id="btnreg" class="btn btn-success centered">Registrar</button>
                    <span id="msjverbtn"></span>
                </div>
            </form>

        </div>    

    </div>
    <ul class="pager">
            <li class="previous">
                <a href="<?php echo base_url() ?>adminera/ver_avaluadores"><span class="label label-default"></span>&larr; Atras</a>
                
            </li>
            <li class="next">
                <a href="#">Adelante &rarr;</a>
            </li>
        </ul>
</div>
<!------------------------/CONTENIDO CENTRAL-------------------------------->
</div>

</div>

