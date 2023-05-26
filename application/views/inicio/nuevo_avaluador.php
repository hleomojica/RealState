<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Sistema de Registro Abierto de Avaluadores</title>


        <link href="<?php echo base_url('herramientas/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">


        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url('herramientas/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url('herramientas/bootstrap/css/heroic-features.css') ?>" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar">asd</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url() ?>login/index">Inicio</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">Acerca de</a>
                        </li>
                        <li>
                            <a href="#">Informacion</a>
                        </li>
                        <li>
                            <a href="#">contacto</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <!-- Jumbotron Header -->
                    <img class=  "  navbar-header icon-bar" src="<?php echo base_url('herramientas/images/logoraa.png') ?>" alt="imagen">
                    <h2 class="text-center" >.::Sistema de Registo Abierto de Avaluadores::.</h2>
                </div>
            </div>
            

               <hr>
            
           
            <!-- CONTENIDO -->
           <!------------------------/CONTENIDO CENTRAL-------------------------------->
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                Solicitud de Registro en el R.A.A
            </div>
            <div class="panel-body">
                  <?=@$error?>
                <form action="<?php echo base_url() ?>publico/add_solicitud" enctype="multipart/form-data" method="post">

                    <div class="form-group col-sm-6">
                        <label for="razon">Nombres</label>
                        <input type="text" class="form-control" id="razon" name="nombres" placeholder="Nombre del Avaluador" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nit">Apellidos </label>
                        <input type="text" class="form-control" id="nit" name="apellidos" placeholder="Apellidos AVALUADOR" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="nombre">Lugar de Nacimiento </label>
                        <input type="text" class="form-control" id="nombre" name="lugar_nac" placeholder="Lugar Nacimiento" required>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="nit">Tipo documento </label>
                        <select class="form-control"  name="codtipo_documento" required>
                            <?php
                            if ($tipodoc){
                                foreach ($tipodoc as $row) { ?>
                                <option value="<?= $row['codtipo_documento'] ?>"><?= $row['nombre'] ?></option>
                            <?php }}else{
                                echo"<option value='1'>No hay datos</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-8">
                        <label for="cc">Numero de documento: </label>
                        <input type="text" class="form-control" id="cc" name="numero_id" placeholder="Documento del Avaluador" required>
                    </div>
                     <div class="form-group col-sm-6" >
                        <label for="fecha">Fecha Expedicion </label>
                        <input type="date" id="fech" name="fechaex_id" class="form-control" value="" required=""/> 
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="telefono">Domicilio </label>
                        <input type="text" class="form-control" id="telefono" name="domicilio" placeholder="Direccion de Residencia" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="acto">Telefono </label>
                        <input type="text" class="form-control" id="acto" name="telefono" placeholder="Telefono" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="fecha">Celular</label>
                        <input type="text" class="form-control" name="celular" id="celular"  placeholder="Celular Avaluador" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="fecha">Correo</label>
                        <input type="email" class="form-control" name="correo" placeholder="Correo Electronico" id="fecha" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="fecha">Regimen inscripcion</label>
                        <input type="text" class="form-control" name="regimen_inscripcion"  placeholder="Regimen de Incripcion" id="regimen" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="fecha">Fecha Inscripcion</label>
                        <input type="text" class="form-control" name="fechainscripcion" id="fecha" value="<?php echo date("Y-m-d"); ?>" disabled="">
                    </div>
                    
                     <div class="form-group col-sm-4">
                        <label for="clase">Estado</label>
                         <select class="form-control"  name="codestado" >
                            <option value="3">Pendiente</option>
                         </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="nit">Categoria </label>
                        <select class="form-control" required name="codcategoria_avaluador">
                        <?php
                            if ($categorias){
                                foreach ($categorias as $row) { ?>
                                <option value="<?= $row['codcategoria_avaluador'] ?>"><?= $row['nombre'] ?></option>
                            <?php }}else{
                                echo"<option value='1'>No hay datos</option>";
                            } ?>
                                </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="codera">Entidad </label>
                        <select class="form-control" name="codera" required>
                        <?php
                            if ($eras){
                                foreach ($eras as $row) { ?>
                                <option value="<?= $row['codera'] ?>"><?= $row['razonsocial_era'] ?></option>
                            <?php }}else{
                                echo"<option value='1'>No hay datos</option>";
                            } ?>
                                </select>
                    </div>
                     <div class="form-group col-sm-12">
                        <label for="fecha">Foto</label>
                        <input type="file" class="form-control" name="foto" id="regimen" placeholder="Imagen del perfil " >
                    </div>
                     <div class="form-group col-sm-12">
                        <label for="fecha">Hoja de vida</label>
                        <input type="file" class="form-control" name="soporte" placeholder="Hoja de vida PDF con soportes" id="regimen" >
                    </div>
                    <input type="hidden" value="00" name="codigoavaluador">

                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success centered">Enviar</button>
                    </div>
                </form>

            </div>    

        </div>
    </div>
    <!------------------------/CONTENIDO CENTRAL-------------------------------->
            
             <!-- CONTENIDO -->

   

        <!-- ELIMINAR ESTA INFORMACION  -->
        <div class="row">
            <div class="col-lg-12">
                <h3>USUARIOS Y ROLES</h3>
            </div>
        </div>
        <!-- /.row -->

        <div class="col-md-12 col-sm-6 hero-feature">
            <div class="thumbnail">
                <div class="caption">
                    <p>Super Administrador RAA : adminraa -123456</p>
                    <p>Administrador ERA : adminera -123456</p>
                    <p>Ususario ERA: usuarioera -123456</p>
                    <p>Ente de Control: entecontrol -123456</p>

                </div>
            </div>
        </div>
        <!-- Page Features -->

        <!-- /.row -->


        <!-- Footer -->

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Desarrollo Web@ Hm</p>
                    <p class="footer">Pagina actualizada en  <strong>{elapsed_time}</strong> segundos</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.container -->

<!----------- /MODALES PARA NUEVO USUARIO----------------------------->

<div class="modal fade" id="registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Asignar Usuarios a ERA</h4>
            </div>
            <form action="<?php echo base_url() ?>adminraa/add_usr" enctype="multipart/form-data" method="POST" name="formulario">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" name="nombres" id="exampleInputPassword1" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" name="correo" id="exampleInputPassword1" required>
                    </div>
                    <div class="form-group">
                        <label for="nombreusuario">Nombre de Usuario</label>
                        <input type="text" class="form-control" name="nombreusuario" id="exampleInputPassword1" required>
                    </div>
                    <div class="form-group">
                        <label for="clave">Clave</label>
                        <input type="password" class="form-control" name="clave" id="clave" required>
                    </div>
                    <select class="form-control"  name="codperfil" required>

                        <?php
                        if ($perfiles) {
                            foreach ($perfiles as $row) {
                                ?>
                                <option value="<?= $row['codperfil'] ?>"><?= $row['nombre'] ?></option>
                                <?php
                            }
                        } else {
                            echo"<option value='1'>No hay datos</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" value="<?= $codera ?>" name="codera">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>

<!----------- /MODALES PARA NUEVO USUARIO----------------------------->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('herramientas/js/login.js') ?>"></script>
    <script src="<?php echo base_url('herramientas/jquery/jquery-2.1.4.min.js') ?>"></script>
    <script src="<?php echo base_url('herramientas/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('herramientas/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('herramientas/datatables/js/dataTables.bootstrap.js') ?>"></script>








</body>

</html>
