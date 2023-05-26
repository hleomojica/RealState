<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
            <li class="active">Certificados</li>

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
                <a href="<?php echo base_url() . "adminera/ver_certificados" ?>" class="list-group-item active ">Certificados</a>
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
<div class="col-lg-9">

    <div class="panel panel-primary">
        <div class="panel-heading">
            Opciones
        </div>
        <div class="panel-body">
            <div class="col-sm-2">
                <a href="<?php echo base_url() ?>adminera/nuevo_certificado_btn" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/iconoadd.png" alt="imagen">
                    <p contenteditable>Nuevo</p>
                </a>
            </div>
            <div class="col-lg-9"><div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Click en<strong> !Nuevo!</strong> Para generar Certificados
                </div>
            </div>

        </div>
    </div>






    <div class="table-responsive span3"> 
        <table  class = "table table-bordered">
            <thead>
                <tr>
                   
                    <th>Pin</th>
                    <th>Fecha Generado</th>
                    <th>Fecha Vencimiento</th>
                    <th>Cedula</th>
                </tr>
            </thead>
            <tbody>


                <?php
                if ($certificados) {
                    foreach ($certificados as $certi) {
                        echo "<tr>\n";
//                        echo "<td>\n" . $certi['codcertificado'] . "</td>";
                        echo "<td>\n" . $certi['pin'] . "</td>";
                        echo "<td>\n" . date('Y-m-d', strtotime($certi['fechagenerado'])) . "</td>";
                        echo "<td>\n" . $certi['fechavencimiento'] . "</td>";
                        echo "<td>\n" . $certi['cedula'] . "</td>";
                        echo "</tr>\n";
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" align="center">No hay comentarios</td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>


        </table>
    </div>
</div>
</div>
</div>





