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

<!------------------------/CONTENIDO CENTRAL-------------------------------->
<div class="col-lg-9">
    <div class="panel panel-primary">
        <div class="panel-heading">
           EDITAR SANCION
        </div>
        <div class="panel-body">
            <h4>Avaluador:<span class="rojo"> <?= $registro[0]['nombres'] . " " . $registro[0]['apellidos'] ?></span></h4>
            <h4>Documento:<span class="rojo"> <?= $registro[0]['cedula'] ?></span></h4>
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
            <form action="<?php echo base_url() ?>adminera/actualizar_sancion" enctype="multipart/form-data" method="post">
                <div class="form-group col-sm-6">
                    <label for="nit">Fecha Registro: </label>
                    <input type="text" class="form-control" id="fechas" name="fecharegistro" value="<?=$registro[0]['fecharegistro']?>" placeholder="Año-Mes-Dia" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="nombre">Fecha Fin: </label>
                    <input type="text" class="form-control" id="fechass" name="fechafin" value="<?= $registro[0]['fechafin'] ?>" placeholder="Año-Mes-Dia" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="razon">Descripcion</label>
                    <textarea class="form-control" name="descripcion" placeholder="Descripcion detallada de La sancion"  required><?= $registro[0]['descripcion'] ?></textarea>
                </div>

                <div class="form-group col-sm-4">
                    <label for="nit">Tipo Sancion </label>
                    <select class="form-control"  name="codtipo_sancion" required>
                        <option value="<?= $registro[0]['codtipo_sancion'] ?>"><?= $registro[0]['tipo'] ?></option>
                        <?php
                        if ($tipo_s) {
                            foreach ($tipo_s as $row) {
                                ?>
                                <option value="<?= $row['codtipo_sancion'] ?>"><?= $row['nombre'] ?></option>
                            <?php
                            }
                        } else {
                            echo"<option value='1'>No hay datos</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-sm-4">
                        <label for="nit">Comite:</label>
                        <select class="form-control"  name="codcomite" required>
                            <option value="<?= $registro[0]['codcomite'] ?>"><?= $registro[0]['comite'] ?></option>
                            <?php
                            if ($comites){
                                foreach ($comites as $row) { ?>
                                <option value="<?= $row['codcomite'] ?>"><?= $row['fecha'] ?></option>
                            <?php }}else{
                                echo"<option value='1'>No hay datos</option>";
                            } ?>
                        </select>
                    </div>
                <div class="form-group col-sm-6">
                         <label for="fecha">Soporte:</label>
                            <a target="_blank" href="<?= base_url() ?>uploads/sanciones/<?= $registro[0]['soporte'] ?>">Ver soporte</a>
                              <input type="file" class="form-control" name="soporte"  placeholder="Documento Soporte del Comite"  >
                </div>
                

                <input type="hidden" name="numero_id" value="<?= $registro[0]['numero_id'] ?>">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success centered">Guardar</button>
                </div>
            </form>

        </div>    

    </div>
</div>
<!------------------------/CONTENIDO CENTRAL-------------------------------->
</div>


