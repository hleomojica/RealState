<!DOCTYPE html>
<html lang="en">

    <head>

        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('herramientas/images/iconos.ico') ?>">
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
                <div class="col-sm-12 text-center">
                    <!-- Jumbotron Header -->
                    
                    <div class="col-sm-6"><img class="img-responsive" alt="Imagen responsive" style="width: 700px; height: 90px;" src="<?php echo base_url('herramientas/images/logoraa.png') ?>" ></div>
                    <div class="col-sm-6"> <h2 class="text-center" >.::Sistema de Registo Abierto de Avaluadores::.</h2></div>
                </div>
            </div>
            <div class="row">
                <?php
                $userlog = $this->session->flashdata('userlog');
                if ($userlog) {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Error!</strong> <?= $userlog ?>.
                    </div>
                    <?php
                }
                ?>

                <div class="col-lg-6">
                    <!-- Jumbotron Header -->
                    <header class="jumbotron hero-spacer">
                        <h3>R.A.A</h3>
                        <p> El Sistema de Registro Abierto a Avaluadores, es encargado de llevar el Registro y control de los Avaluadores por parte de las Entidades Reconocidas de AutoRegulacion.</p>
                        <p class="centered">Si desea verificar informacion acerca de avaluadores Ingrese aqui.</p>
                        

                    </header>
                </div>

                <div class="col-lg-6">
                    <header class="jumbotron hero-spacer">
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
                        <div class="login-panel panel panel-default">

                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Ingreso Usuarios Registrados</strong></h3>
                            </div>
                            <div class="panel-body">

                                <form action="<?php echo base_url() ?>login/iniciar_session" enctype="multipart/form-data" method="post">
                                    <fieldset>
                                        <div class="form-group">
                                            <input class="form-control" title="Ingrese Usuario suministrado por el Administrador" placeholder="Usuario" id="usuario"  name="usuario" type="text" autofocus required="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" title="Ingrese Clave suministrada por el Administrador" placeholder="Clave" id="clave" name="clave" type="password" value="" required="">
                                        </div>
                                        <input type="hidden" name="token" value="<?= $token ?>" >
                                        <button  id="entrar"  class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>

                                        <!-- <div id="message"></div>-->
                                    </fieldset>

                                </form>

                            </div>
                        </div>
                        <div class="caption">
                            <a href="#" class="fa thumbnail" data-toggle="modal" data-target="#olvido">Olvide mi contraseña</a>

                        </div>
                    </header>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="col-lg-12">
                    <p>Copyright &copy; Desarrollo  HenrryM</p>
                    <p class="footer">Pagina actualizada en  <strong>{elapsed_time}</strong> segundos</p>
                </div>
            </div>
        </footer>
        <!-- /.container -->

        <!----------- /MODALES PARA NUEVO USUARIO----------------------------->

        <div class="modal fade" id="olvido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Recuperar Contraseña</h4>
                    </div>
                    <form action="<?php echo base_url() ?>publico/mailito" enctype="multipart/form-data" method="POST" name="formulario">
                        <div class="modal-body">
                            <p>Enviaremos Un correo para Cambiar la contraseña</p>
                            <div class="form-group">
                                <label for="nombreusuario">Nombre de Usuario</label>
                                <input type="text" class="form-control" name="nombreusuario" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" name="correo" id="exampleInputPassword1" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form> 
                </div>    
            </div>
        </div>

        <!----------- /MODALES PARA NUEVO USUARIO----------------------------->
        <!-- jQuery -->


        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('herramientas/js/login.js') ?>"></script>
        <script src="<?php echo base_url('herramientas/jquery/jquery-2.1.4.min.js') ?>"></script>
        <script src="<?php echo base_url('herramientas/js/jquery-ui.min.js') ?>"></script>
        <script src="<?php echo base_url('herramientas/js/jquery-2.1.4.js') ?>"></script>
        <script src="<?php echo base_url('herramientas/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('herramientas/datatables/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo base_url('herramientas/datatables/js/dataTables.bootstrap.js') ?>"></script>








    </body>

</html>
