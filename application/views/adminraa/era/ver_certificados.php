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
 <!--------------------ASIDE--------------------->
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">Entidades ERA</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?php echo base_url() ?>login/index" class="list-group-item  ">Inicio</a>
                    <a href="<?php echo base_url() . "adminraa/era" ?>" class="list-group-item ">Entidades ERA</a>
                    <a href="<?php echo base_url() . "adminraa/nueva_era" ?>" class="list-group-item ">Nueva ERA</a>
               
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">AVALUADORES</div>
            <div class="panel-body">

                <div class="list-group">
                    <a href="<?php echo base_url() . "adminraa/ver_avaluadores" ?>" class="list-group-item ">Avaluadores</a>
                    <a href="<?php echo base_url() . "adminraa/ver_categorias" ?>" class="list-group-item ">Categorias</a>
                    <a href="<?php echo base_url() . "adminraa/ver_certificados" ?>" class="list-group-item active">Certificados</a>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <!------------------------/ASIDE--------------->
<div class="col-lg-9">

    <div class="panel panel-primary">
        <div class="panel-heading">
         Ver certificados
        </div>
        <div class="panel-body">
            <div class="col-sm-2">
                <a href="<?php echo base_url() ?>adminera/nuevo_certificado_btn" class="thumbnail">
                    <img class="icono" src="<?= base_url() ?>herramientas/images/iconoadd.png" alt="imagen">
                    <p contenteditable>Nuevo</p>
                </a>
                 </div>
            
                
            </div>
             </div>


 <div class="table-responsive span3"> 
      <table  class = "table table-bordered">
                <thead>
                    <tr>
                        <th>Codigo</th>
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
                           
                        echo "<td>\n" . $certi['codcertificado'] . "</td>";
                        echo "<td>\n" . $certi['pin'] . "</td>";
                        echo "<td>\n" . date('Y-m-d',strtotime($certi['fechagenerado'])) . "</td>";
                        echo "<td>\n" . $certi['fechavencimiento'] . "</td>";
                        echo "<td>\n" . $certi['cedula'] . "</td>";
                        
                        ?> 

                       <?php
                       
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





