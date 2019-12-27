<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Sistema Financeiro</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/adminlte/dist/css/adminlte.min.css">
    
    <!-- Theme style nova proposta-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/novaProposta/NovaPasta.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!--CSS Interno-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <!--Bootastrap 4.4.1
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">-->


</head>
<body class="hold-transition sidebar-mini" style="background: #ebebeb; box-sizing: border-box;">
<div class="wrapper" style="width: 100vw;">

    <!-- Navbar -->
    <nav class="navbar navbar-light container-fluid" style="">
    <div class="container-fluid">
    <!-- Left navbar links -->
        <ul class="navbar-nav botao-menu">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            
        </ul>

       

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->

            <!-- Notifications Dropdown Menu -->

            <li class="nav-item">
                <a  href="<?php  echo BASE_URL; ?>login/logout">
                <i class="fas fa-sign-out-alt" style="color: #0c496e; font-size: 1.5rem"></i>
            </li>
        </ul>
    </div>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-style elevation-4 bg-info">
        <!-- Brand Logo -->
        <div class="brand-logo">
            <img src="<?php echo BASE_URL; ?>assets/img/logo_ms.png" alt="Logo Sistema MS" class="brand-image"
                 style="max-width: 80%;">
        </div>



        <!-- Sidebar -->
        <div class="sidebar list-sidebar" >
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel d-flex justify-content-center" style="padding: 3% 0; border-bottom: solid 1px rgba(255, 255, 255, 0.603); border-top: solid 1px rgba(255, 255, 255, 0.603);">
                    <span class="brand-text font-weight-light" style="color: yellow; font-size: 90%;"></span>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-4">
                <ul class="nav nav-pills nav-sidebar flex-column"  data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item mb-1" >
                        <a href="<?php echo BASE_URL;?>" class="item-style p-3">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p style="margin: 0;">
                                Proposta
                            </p>
                        </a>
                    </li>



                    <li class="nav-item mb-1">
                        <a href="<?php echo BASE_URL;?>simulador" class="item-style p-3">
                            <i class="nav-icon fas fa-calculator"></i>
                            <p style="margin: 0;">
                                Simulador
                            </p>
                        </a>
                    </li>



                    <li class="nav-item mb-1">
                        <a href="" class="item-style p-3">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p style="margin: 0;">
                                Buscar Cliente
                            </p>
                        </a>
                    </li>

                    <li class="nav-item mb-1">
                        <a href="" class="item-style p-3">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p style="margin: 0;">
                                Relatórios
                            </p>
                        </a>
                    </li>

                    <?php if ( $viewData['colaborador']->temPermissao('cad_colaborador')): ?>
                        <li class="nav-item mb-1" >
                            <a href="<?php echo BASE_URL;?>colaborador" class="item-style p-3">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p style="margin: 0;">
                                    Colaboradores
                                </p>
                            </a>
                        </li>
                    <?php endif;?>
                </ul>

                <?php if ( $viewData['colaborador']->temPermissao('cad_permissoes')): ?>
                    <li class="nav-item mb-1" >
                        <a href="<?php echo BASE_URL;?>permissao" class="item-style p-3">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p style="margin: 0;">
                               Permissões
                            </p>
                        </a>
                    </li>
                <?php endif;?>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper content-template main-conteudo" style="">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <?php $this->loadViewInTemplate($viewName, $viewData); ?>
                <!-- /.row -->
            </div><!-- /.container-fluid -->

        </div>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer container-fluid" style="text-align: center;">
        <!-- To the right -->
        
        <!-- Default to the left -->
        <strong>Copyright &copy; <?php echo date('Y');?> <a href="#" style="color: orange;">FabricaDeSoftaware</a>.</strong> Todos os direitos reservados.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo BASE_URL; ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo BASE_URL; ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_URL; ?>assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- jQuery mask min-->
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/jquery.mask.min.js"></script>
<!--  scripts-->

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/colaborador.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/permissao.js"></script>
</body>
</html>
