 <?php 
 $us = $this->session->userdata('admin'); 
 ?>
 <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="javascript:;">Nexos Digital | Administración del sitio</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $us['nombre'].' '.$us['apellidos'] ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfiles de administrador</a></li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuraciones</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url() ?>logout"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">                      
                        <li>
                            <a href="<?php echo base_url(); ?>admin/dashboard/"><i class="fa fa-home fa-fw"></i> Inicio</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/articles/"><i class="fa fa-newspaper-o fa-fw"></i> Articulos / Publicaciones</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/categorias/"><i class="glyphicon glyphicon-th fa-fw"></i> Categorías</a>
                        </li>
                         <li>
                            <a href="<?php echo base_url(); ?>admin/mensajes/"><i class="fa fa-envelope-o" aria-hidden="true"></i> Solicitud de contacto</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/subscriptores/"><i class="glyphicon glyphicon-user fa-fw"></i> Subscriptores</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>