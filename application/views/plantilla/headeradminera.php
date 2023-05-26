<html lang="en">
    <head>
        
         <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('herramientas/images/iconos.ico') ?>">
        <title><?php echo $titulo ?></title>
        <link href="<?php echo base_url('herramientas/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('herramientas/estilos/miestilo.css') ?>" rel="stylesheet">
         <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="<?php echo base_url('herramientas/date/jquery-2.1.4.js') ?>"></script>
        <script src="<?php echo base_url('herramientas/date/jquery-ui.js') ?>"></script>
        <script src="<?php echo base_url('herramientas/date/espa.js') ?>"></script>
        <link href="<?php echo base_url('herramientas/date/bootstrap-select.css') ?>" rel="stylesheet">
        <script src="<?php echo base_url('herramientas/date/bootstrap-select.js') ?>"></script>
        <script src="<?php echo base_url('herramientas/datatables/java.js') ?>"></script>
        <link href="<?php echo base_url('herramientas/datatables/estilo.css') ?>" rel="stylesheet">
       



    </head>
    <body>
        
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <!-- El logotipo y el icono que despliega el menú se agrupan
                     para mostrarlos mejor en los dispositivos móviles -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Desplegar navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo base_url() . "login" ?>">
                        <img  class="img-responsive logo" alt="Imagen responsive" src="<?php echo base_url('herramientas/images/logoraa.png') ?>" alt="imagen">
                    </a>
<!--                    <a class="navbar-brand" href="<?php echo base_url() . "login/index" ?>">Inicio</a>-->
                </div>

                <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                     otro elemento que se pueda ocultar al minimizar la barra -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Avaluadores<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                
                                <li><a href="<?php echo base_url() . "adminera/ver_avaluadores" ?>">Ver Avaluadores</a></li>
                                  <li class="divider"></li>
                                <li><a href="<?php echo base_url() . "adminera/crear_avaluador" ?>">Nuevo Avaluador</a></li>
                                 <li class="divider"></li>
                                <li><a href="<?php echo base_url() . "adminera/ver_traslados" ?>">Traslados</a></li>
                                 <li class="divider"></li>
                                <li><a href="<?php echo base_url() . "adminera/ver_solicitudes" ?>">Solicitudes</a></li>
                            </ul>
                        </li>
                    </ul> 

                    <ul class="nav navbar-nav">
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Reportes<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url() . "adminera/nuevo_reporte" ?>">Nuevo Reporte</a></li>
                            </ul>
                        </li>
                    </ul> 
                    <ul class="nav navbar-nav">
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Informacion<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url() . "adminera/nuevo_reporte" ?>">Informacion ERA</a></li>
                            </ul>
                        </li>
                    </ul> 

                    <ul class="nav navbar-nav navbar-right">
                        
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-book"> </span>   Ayuda<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a  target="_blank" href="<?php echo base_url('ayuda/index.htm') ?>">Manual de Usuario</a></li>
                                </ul>
                            </li>
                        </ul>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-user"></span> <?= $this->session->userdata('nombres') ?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a>Administrador de ERA</a></li>
                                 <li class="divider"></li>
                                <li><a href="<?php echo base_url() . "adminera/configuracion" ?>">Cambiar Contraseña</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url() . "login/logout" ?>">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>




