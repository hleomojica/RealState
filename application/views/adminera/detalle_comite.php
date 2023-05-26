<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4') ?>"></script>
<script src="<?php echo base_url('herramientas/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('herramientas/js/jquery-2.1.4.min.js') ?>"></script>


<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li><a href="<?php echo base_url() ?>adminera/ver_comite">Comite</a></li>
            <li class="active">Detalle</li>
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
        <div class="panel-heading">
            Comite

        </div>
        <div class="panel-body">
            <strong>Comite Realizado el </strong>:<?= $comite[0]['fecha'] ?>
            <div class="form-group col-sm-6">
                <label>Funcionarios: </label>
                <span class="form-control-static"><?= $comite[0]['funcionarios'] ?></span>
            </div>

        </div>
        <div class="panel-body">

            <div class="col-sm-2">
                <a href="<?= base_url() ?>adminera/comite_solsistema/<?= $this->cifrar->enc($comite[0]['codcomite']) ?>" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/solicitud2.png" alt="imagen">
                    <p contenteditable>Respuesta a Solicitudes del sistema</p>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="<?= base_url() ?>adminera/comite_solinscripcion/<?= $this->cifrar->enc($comite[0]['codcomite']) ?>" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/solicitudtras.jpg" alt="imagen">
                    <p contenteditable>Respuesta a Solicitudes de inscripcion</p>
                </a>
            </div>

        </div>

    </div>
</div>
<ul class="pager">
    <li class="previous">
        <a href="<?php echo base_url() ?>adminera/ver_comite">&larr; Atras</a>
    </li>
    <li class="next">
        <a href="#">Adelante &rarr;</a>
    </li>
</ul>
</div>

</div>

</div>

<!-----------------------MODAL PARA NUEVO COMITE---------------------------->

<div class="modal fade" id="modelusr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cedula de Avaluador</h4>
            </div>
            <form action="<?php echo base_url() ?>adminera/nueva_sancion" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="col-sm-12"><div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong></strong> Ingrese una cedula para buscar un avaluador
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="razon">Cedula;</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese Cedula de Avaluador" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>
<!------------------------------MODAL PARA NUEVO COMITE---------------------------->
