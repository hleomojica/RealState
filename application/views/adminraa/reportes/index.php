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

<div class="col-lg-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
            <p>Generar reportes del Sistema RAA</p>
        </div>
        <div class="panel-body">
           <div class="row">
                <div class="col-sm-4 col-md-4">
                    <div class="thumbnail ">
                        <img class="icono" src="<?= base_url() ?>herramientas/images/descargar.png" alt="...">
                        <div class="caption">
                            <h4><p>Reporte General</p></h4>
                            <p>Entidades-Avaluadores-Usuarios</p>
                            
                            <p>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modelgen"  role="button">Generar</a>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="thumbnail ">
                        <img class="icono" src="<?= base_url() ?>herramientas/images/descargar.png" alt="...">
                        <div class="caption">
                            <h4><p>Registro de transacciones <p></h4>
                            <p>Transacciones realizadas en el sistema</p>
                            <p>
                                <a target="_blank" href="<?= base_url() ?>certificados/reportesraa/<?=$this->cifrar->enc('transacciones')?>" class="btn btn-success" role="button">Desargar</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="thumbnail ">
                        <img class="icono" src="<?= base_url() ?>herramientas/images/descargar.png" alt="...">
                        <div class="caption">
                            <h4><p>Avaluadores Registrados<p></h4>
                           <p>Avaluadores  registrados en el sistema</p>
                            <p>
                                <a target="_blank" href="<?= base_url() ?>certificados/reportesraa/<?=$this->cifrar->enc('avaluadores')?>" class="btn btn-success" role="button">Desargar</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <p class="lead">Bienvenido <?= $this->session->userdata('nombres') ?> </p>
    </div>

</div>



<script>
    $(function () {
        $("#fecha").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>
<script>
    $(function () {
        $("#fecha2").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>
<!-----------------------MODAL PARA REPORTE GENERAL---------------------------->

<div class="modal fade" id="modelgen"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Generar reporte</h4>
            </div>
            <form action="<?php echo base_url() ?>reportes/raagenerar" enctype="multipart/form-data" target="_blank" onSubmit="location.href='<?= base_url() ?>adminraa/nuevo_reporte';" method="post">
                <div class="modal-body">
                    <h4>Rango de Fechas:</h4>
                    <div class="form-group col-sm-6">
                        <label for="razon">Desde:</label>
                        <input type="text" class="form-control" id="fecha" name="fecha1" placeholder="año-mes-dia" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nit">Hasta:</label>
                        <input type="text" class="form-control" id="fecha2" name="fecha2" placeholder="año-mes-dia" required>
                    </div>
                    <h4>Reporte de:</h4>

                    <div class="checkbox">
                         <label><input type="checkbox" id="todos"  class="checks" value="">Seleccionar todos</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" class="checks" name="filtro[]"  value="1">Usuarios</label>
                    </div>
                    <div class="checkbox ">
                        <label><input type="checkbox" class="checks" name="filtro[]" value="2">Avaluadores</label>
                    </div>
                    <div class="checkbox ">
                        <label><input type="checkbox" class="checks" name="filtro[]" value="3">Comites</label>
                    </div>
                    <div class="checkbox ">
                        <label><input type="checkbox" class="checks" name="filtro[]" value="4">Certificados</label>
                    </div>
                    <div class="checkbox ">
                        <label><input type="checkbox" class="checks" name="filtro[]" value="5">Sanciones</label>
                    </div>
                    <div class="checkbox ">
                        <label><input type="checkbox" class="checks" name="filtro[]" value="6">Traslados</label>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" id="rec" class="btn btn-success" >Generar reporte</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>
<!------------------------------MODAL PAR REPORTE GENERAL---------------------------->

<script type="text/javascript">
    $("#todos").click(function () {
        $(".checks").prop('checked', $(this).prop('checked'));
    });
</script>
