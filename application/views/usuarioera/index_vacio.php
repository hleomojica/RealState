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
<!-----------ASIDE------------>
<!--<div class="col-sm-3">
    <div class="panel panel-default">
        <div class="panel-heading">ERA</div>
        <div class="panel-body">
            <div class="list-group">
                <a href="<?php echo base_url() ?>login/index" class="list-group-item active ">Inicio</a>
                <a href="<?php echo base_url() . "adminera/ver_avaluadores" ?>" class="list-group-item ">Solicitudes</a>
                <a href="<?php echo base_url() . "adminera/ver_comite" ?>" class="list-group-item ">Configuracion</a>
                <hr>
                <a href="#" class="list-group-item">Certificados</a>
            </div>
        </div>
    </div>
</div>-->

<!-----------------------/ASIDE----------->
<div class="col-lg-12">
    <div class=" text-center">

        <h2>Usuario de la ERA:</h2>
         <h3><p class="lead"><?= $this->session->userdata('razon_era') ?> </p></h3>

    </div>


    <div class="panel panel-default">
        <div class="panel-heading">

        </div>
        <div class="panel panel-body">
            <h2><p>No tiene asociado un avaluador el usuario</p></h2>
            </div> 
    </div>

</div>



