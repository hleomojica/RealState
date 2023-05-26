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
<!--<link href="<?php echo base_url('herramientas/estilos/miestilo.css') ?>" rel="stylesheet">
        -->

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
                    <a class="navbar-brand" href="#">Inicio</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">Consultas</a>
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
                    <img class=" login navbar-header " style="width: 600px; height: 120px;" src="<?php echo base_url('herramientas/images/logoraa.png') ?>" >
                    <h2 class="text-center" >.::Sistema de Registo Abierto de Avaluadores::.</h2>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <!-- Jumbotron Header -->
                    <header class="jumbotron hero-spacer">
                        <h2>R.A.A</h2>
                        <p> El Sistema de Registro Abierto a Avaluadores, es encargado de llevar el Registro y control de los mismos por parte de las Entidades Reconocidas de AutoRegulacion.</p>
                        <p class="centered"> Ingrese Aqui para registrarse como Avaluador.</p>
                        <a href="<?php echo base_url() ?>publico/nuevo_avaluador" class="btn btn-primary btn-large">Registrarse</a>

                    </header>
                </div>

                <div class="col-lg-6">
                    <!-- Jumbotron Header -->
                    <header class="jumbotron hero-spacer">
                        <?php
                        if ($this->session->flashdata('incorrecto')) {
                            ?>

                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>¡Error!</strong> <?= $this->session->flashdata('incorrecto') ?>.
                            </div>

                            <?php
                        }
                        ?>
                        <div class="login-panel panel panel-default">

                            <div class="panel-heading">
                                <h3 class="panel-title">Ingreso Usuarios Registrados</h3>
                            </div>
                            <div class="panel-body">

                                <form action="<?php echo base_url() ?>login/iniciar_session" enctype="multipart/form-data" method="post">
                                    <fieldset>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Usuario" id="usuario"  name="usuario" type="text" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Clave" id="clave" name="clave" type="password" value="">
                                        </div>

                                        <button name="Submit" id="entrar"  class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>

                                        <!-- <div id="message"></div>-->
                                    </fieldset>

                                </form>

                            </div>
                        </div>
                        <div class="caption">
                            <h3>Recuperar Datos</h3>
                            <p>Si olvido su contraseña ingrese aqui.</p>
                            <p>
                                <a href="#" class="btn btn-default">Olvido</a>
                            </p>
                        </div>
                    </header>
                </div>
            </div>

            <hr>

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


        </div>
        <footer>
            <div class="container">
                <div class="col-lg-12">
                    <p>Copyright &copy; Desarrollo Web@ Hm</p>
                    <p class="footer">Pagina actualizada en  <strong>{elapsed_time}</strong> segundos</p>
                </div>
            </div>
        </footer>
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
