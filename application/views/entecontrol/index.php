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
<!--------------------ASIDE--------------------->
<div class="col-sm-3">
    <div class="panel panel-default">
        <div class="panel-heading">Sistema</div>
        <div class="panel-body">
            <div class="list-group">
                <a href="<?php echo base_url() ?>login/index" class="list-group-item active ">Inicio</a>
                <a href="<?php echo base_url() . "entecontrol/era" ?>" class="list-group-item ">Entidades ERA</a>
                <a href="<?php echo base_url() . "entecontrol/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                <a href="<?php echo base_url() . "entecontrol/ver_categorias" ?>" class="list-group-item ">Categorias Avaluadores</a>
                <a href="<?php echo base_url() . "entecontrol/ver_certificados" ?>" class="list-group-item">Certificados</a>
                <a href="<?php echo base_url() . "entecontrol/ver_traslados" ?>" class="list-group-item">Traslados</a>
                <a href="<?php echo base_url() . "entecontrol/ver_sanciones" ?>" class="list-group-item">Sanciones</a>
            </div>
        </div>
    </div>

    <hr>
</div>
<!------------------------/ASIDE--------------->
<div class="col-lg-9">
   <div class=" text-center">
<h2>ETIDAD DE CONTROL</h2>
         </div>
    <div class="panel panel-primary">
        <div class="panel-heading">

        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img  class="inicio"src="<?= base_url() ?>herramientas/images/era.png" alt="...">
                        <div class="caption">
                            <h4><p>ERA Registradas: </p></h4>
                            <h2><p><?= $era->cantidad ?></p></h2>
                            <p>
                                <a href="<?php echo base_url() . "entecontrol/era" ?>" class="btn btn-primary" role="button">Ver mas</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img class="inicio" src="<?= base_url() ?>herramientas/images/ava.png" alt="...">
                        <div class="caption">
                            <h4><p>Avaluadores Registrados  </p></h4>
                            <h2><p><?= $avaluadores->cantidad ?></p></h2>
                            <p>
                                <a href="<?php echo base_url() . "entecontrol/ver_avaluadores" ?>" class="btn btn-primary" role="button">Ver mas</a>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img class="inicio" src="<?= base_url() ?>herramientas/images/usuari.png" alt="...">
                        <div class="caption">
                            <h4><p>Usuarios Registrados <p></h4>
                            <h2><p><?= $usuarios->cantidad ?></p></h2>
                            <p>
                                <a href="#" class="btn btn-primary" role="button">Ver mas</a>

                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <p class="lead">Bienvenido <?= $this->session->userdata('nombres') ?> </p>
        </div>
    </div>
</div>
