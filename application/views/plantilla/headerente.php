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
         <script src="<?php echo base_url('herramientas/date/espa.js') ?>"></script>
         <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">



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
                        <img class="logo navbar-header icon-bar" src="<?php echo base_url('herramientas/images/logoraa.png') ?>" alt="imagen">
                    </a>
<!--                    <a class="navbar-brand" href="<?php echo base_url() . "login/index" ?>">Inicio</a>-->
                </div>

                <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                     otro elemento que se pueda ocultar al minimizar la barra -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    
                    <ul class="nav navbar-nav">
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Reportes<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#"  data-toggle="modal" data-target="#modelgen"  role="button">Generar</a></li>
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
                                <li><a href="#">Ente de Control</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url() . "entecontrol/configuracion" ?>">Cambiar Contraseña</a></li>

                                <li class="divider"></li>
                                <li><a href="<?php echo base_url() . "login/logout" ?>">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
          





<script>
    $(function () {
        $("#fecha").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>
<script>
    $(function () {
        $("#fecha2").datepicker({dateFormat: "yy-mm-dd"}).val();
    });
</script>
<!-----------------------MODAL PARA REPORTE GENERAL---------------------------->

<div class="modal fade" id="modelgen"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Generar nuevo reporte</h4>
            </div>
            <form action="<?php echo base_url() ?>reportes/raagenerar" enctype="multipart/form-data" target="_blank" onSubmit="location.href='<?= base_url() ?>adminera/nuevo_reporte';" method="post">
                <div class="modal-body">
                    <h4>Rango de Fechas:</h4>
                    <div class="form-group col-sm-6">
                        <label for="razon">Desde:</label>
                        <input type="text" class="form-control" id="fecha" name="fecha1" placeholder="año-mes-dia" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="nit">Hasta:</label>
                        <input type="text" class="form-control" id="fecha2" name="fecha2" placeholder="año-mes-dia" required>
                    </div>
                    <h4>Reporte de:</h4>

                    <div class="checkbox">
                         <label><input type="checkbox" id="todos"  class="checks" value="">Seleccionar todos</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" class="checks" name="filtro[]"  value="1">Usuarios</label>
                    </div>
                    <div class="checkbox ">
                        <label><input type="checkbox" class="checks" name="filtro[]" value="2">Avaluadores</label>
                    </div>
                    <div class="checkbox ">
                        <label><input type="checkbox" class="checks" name="filtro[]" value="3">Comites</label>
                    </div>
                    <div class="checkbox ">
                        <label><input type="checkbox" class="checks" name="filtro[]" value="4">Certificados</label>
                    </div>
                    <div class="checkbox ">
                        <label><input type="checkbox" class="checks" name="filtro[]" value="5">Sanciones</label>
                    </div>
                    <div class="checkbox ">
                        <label><input type="checkbox" class="checks" name="filtro[]" value="6">Traslados</label>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" id="rec" class="btn btn-success" >Generar reporte</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </form> 
        </div>    
    </div>
</div>
<!------------------------------MODAL PAR REPORTE GENERAL---------------------------->




              <script type="text/javascript">
function refrescar()
{
     location.reload();
//location.href='tu-pagina-web.html';
}
</script>
<script type="text/javascript">
    $("#todos").click(function () {
        $(".checks").prop('checked', $(this).prop('checked'));
    });
</script>

