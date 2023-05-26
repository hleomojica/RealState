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
                <a href="<?php echo base_url() ?>login/index" class="list-group-item active ">Inicio</a>
                <a href="<?php echo base_url() . "adminera/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                <a href="<?php echo base_url() . "adminera/ver_comite" ?>" class="list-group-item ">Comite</a>
                <a href="<?php echo base_url() . "adminera/ver_certificados" ?>" class="list-group-item ">Certificados</a>
                <a href="<?php echo base_url() . "adminera/ver_sanciones" ?>" class="list-group-item ">Sanciones</a>
                <a href="<?php echo base_url() . "adminera/ver_traslados" ?>" class="list-group-item ">Traslados</a>
                <a href="<?php echo base_url() . "web-usuarios" ?>" class="list-group-item ">Usuarios</a>
                <hr>
                <a href="<?php echo base_url() . "adminera/configuracion" ?>" class="list-group-item">Configuración</a>
            </div>
        </div>
    </div>
</div>

<!-----------------------/ASIDE----------->
<div class="col-lg-9">
    <div class=" text-center">
<h2><?= $this->session->userdata('razon_era') ?> </h2>
        <div class="thumbnail">
            <?php if ($this->session->userdata('logo')) { ?>
                <img class="logo" src="<?= base_url() ?>uploads/imagenes/<?= $this->session->userdata('logo') ?>" alt="imagen">
            <?php
            } else {
                echo "No ha Logo";
            }
            ?>
        </div>
      </div>
     <div class="panel panel-primary">
        <div class="panel-heading">

        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <div class="thumbnail ">
                        <img class="inicio" src="<?= base_url() ?>herramientas/images/ava.png" alt="...">
                        <div class="caption">
                            <h4><p>Avaluadores Registrados  </p></h4>
                            <h2><p><?= $avaluadores->cantidad ?></p></h2>
                            <p>
                                <a href="<?= base_url() ?>adminera/ver_avaluadores" class="btn btn-primary" role="button">Ver mas</a>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="thumbnail ">
                        <img class="inicio" src="<?= base_url() ?>herramientas/images/usuari.png" alt="...">
                        <div class="caption">
                            <h4><p>Usuarios Registrados <p></h4>
                            <h2><p><?= $usuarios->cantidad ?></p></h2>
                            <p>
                                <a href="<?= base_url() ?>adminera/ver_usuarios" class="btn btn-primary" role="button">Ver mas</a>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="thumbnail ">
                        <img class="inicio" src="<?= base_url() ?>herramientas/images/solicitud.png" alt="...">
                        <div class="caption">
                            <h4><p>Solicitudes Pendientes<p></h4>
                            <h2><p><?= $solicitudes->cantidad ?></p></h2>
                            <p>
                                <a href="<?= base_url() ?>adminera/ver_solicitudes" class="btn btn-primary" role="button">Ver mas</a>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="thumbnail ">
                        <img class="inicio" src="<?= base_url() ?>herramientas/images/solicitudtras.jpg" alt="...">
                        <div class="caption">
                            <h4><p>Solicitudes de traslado<p></h4>
                            <h2><p><?= $solicitudestras->cantidad ?></p></h2>
                            <p>
                                <a href="<?= base_url() ?>adminera/ver_solicitudestras" class="btn btn-primary" role="button">Ver mas</a>
                             </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> <p class="lead">Bienvenido <?= $this->session->userdata('nombres') ?> </p>
    </div>

</div>
</div>



