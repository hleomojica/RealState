<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $titulo ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('herramientas/images/iconos.ico') ?>">
        <link href="<?php echo base_url('herramientas/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('herramientas/estilos/miestilo.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('herramientas/date/jquery-ui.css') ?>">
        <script src="<?php echo base_url('herramientas/date/jquery-2.1.4.js') ?>"></script>
        <script src="<?php echo base_url('herramientas/date/jquery-ui.js') ?>"></script>

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
                        <span class="icon-bar" ></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo base_url() . "login" ?>">
                        <img class="logo navbar-header icon-bar" src="<?php echo base_url('herramientas/images/logoraa.png') ?>" alt="imagen">
                    </a>  
<!--                    <a class="navbar-brand" href="<?php echo base_url() . "login" ?>">Inicio</a>-->
                </div>

                <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                     otro elemento que se pueda ocultar al minimizar la barra -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                ERA<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url() . "adminraa/era" ?>">ver Entidades</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url() . "adminraa/nueva_era" ?>">Nueva Era</a></li>


                            </ul>
                        </li>
                    </ul>

             
                 
                   
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-user"></span>user</b>
                            </a>
                            
                        </li>
                    </ul>
                </div>
            </nav>








