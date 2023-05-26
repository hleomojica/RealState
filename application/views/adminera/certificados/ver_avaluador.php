<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb">
           <li><a href="<?php echo base_url() ?>login/index">Inicio</a></li>
             <li><a href="<?php echo base_url() ?>adminera/ver_certificados">Certificados</a></li>
            <li class="active">Nuevo</li>

        </ol>
    </div> 
</div>
<!-----------ASIDE------------>
<div class="col-sm-3">
    <div class="panel panel-default">
        <div class="panel-heading">ERA</div>
        <div class="panel-body">
            <div class="list-group">
                <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                <a href="<?php echo base_url() . "adminera/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                <a href="<?php echo base_url() . "adminera/ver_comite" ?>" class="list-group-item ">Comite</a>
                <a href="<?php echo base_url() . "adminera/ver_certificados" ?>" class="list-group-item active">Certificados</a>
                <a href="<?php echo base_url() . "adminera/nueva_era" ?>" class="list-group-item ">Comite</a>
                <a href="#" class="list-group-item">Historico</a>
                <a href="#" class="list-group-item ">Avaluadores</a>
                <a href="#" class="list-group-item ">Categorias</a>
                <hr>
                <a href="#" class="list-group-item">Certificados</a>
            </div>
        </div>
    </div>
</div>

<!-----------------------/ASIDE----------->
<div class="col-lg-9">

    <div class="panel panel-primary">
        <div class="panel-heading">
            Generar Certificado
        </div>
        <div class="panel-body">
            <div class="table-responsive"> 

                <table  class = "table table-bordered">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>ERA</th>
                            <th>Estado</th>


                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        if ($avaluadores) {

                            echo "<td>\n" . $avaluadores->cedula . "</td>";
                            echo "<td>\n" . $avaluadores->nombres . "</td>";
                            echo "<td>\n" . $avaluadores->apellidos . "</td>";
                            echo "<td>\n" . $avaluadores->era . "</td>";
                            echo "<td>\n" . $avaluadores->estado . "</td>";
                            ?> 

                            <?php
                            echo "</tr>\n";
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
            <div class="col-sm-2">
                <a href="<?= base_url() ?>certificados/agregar_certificado/<?= $avaluadores->numero_id ?>" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/iconoadd.png" alt="imagen">
                    <p contenteditable>Agregar </p>
                </a>
            </div>
            <div class="col-lg-9"><div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Click en<strong> Agregar</strong> Para añadir Avaluador a la lista y generar certifiados
                </div>
            </div>
        </div>

    </div>





