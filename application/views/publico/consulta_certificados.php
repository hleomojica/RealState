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
            <p>CONSULTA DE CERTIFICADOS: </p>
        </div>
             <div class="panel panel-body">
                <form>
                    <div class="row">
                        <h4><P>AVALUADOR :</P></h4>
                        <div class="form-group col-sm-6">
                            <label>Nombre: </label>
                            <span class="form-control-static"><?= $registro->nombres ?></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Apellidos: </label>
                            <span class="form-control-static"><?= $registro->apellidos ?></span>
                        </div>
                       
                        <div class="form-group col-sm-6">
                            <label>Numero Documento: </label>
                            <span class="form-control-static"><?= $registro->cedula ?></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Codigo Avaluador </label>
                            <span class="form-control-static"><?= $registro->codigoavaluador ?></span>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>ERA: </label>
                            <span class="form-control-static"><?= $registro->era ?></span>
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label>Estado: </label>
                            <span  class="<?php
                            if ($registro->estado == 'Activo') {
                                echo 'verde';
                            } else {
                                echo 'rojo';
                            }
                            ?>"><strong><?= $registro->estado ?></strong></span>
                        </div>
                         <div class="form-group col-sm-6">
                            <label>correo: </label>
                            <span class="form-control-static"><?= $registro->correo ?></span>
                        </div>
                        
                        <h4><P>CERTIFICADO :</P></h4>
                       
                        <div class="form-group col-sm-3">
                            <label>Fecha Generado: </label>
                            <span class="form-control-static"><?= $registro->fechagenerado ?></span>
                        </div>
                         <div class="form-group col-sm-6">
                            <label>fecha vencimiento Certificado </label>
                            <span class="form-control-static"><?= $registro->fechavencimiento ?></span>
                        </div>
                        
                        <div class="form-group col-sm-3">
                            <label>PIN CERTIFICADO: </label>
                            <span class="form-control-static"><?= $registro->pin ?></span>
                        </div>

                    </div>

                </form>

            </div> 
          
    </div>

</div>



