<?php
$cakeDescription = 'Admin - Visitas';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('admin.min.css') ?>
    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->css('datepicker.css') ?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('admin', 1) }}">Visita</a>
            </div>
            <ul class="nav navbar-right top-nav">
                <li class="dropdown"></li>
                <li class="dropdown"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $authUser ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <!-- <i class="fa fa-fw fa-power-off"></i>  -->
                            <?php echo $this->Html->link('Salir', ['controller' => 'Usuario', 'action' => 'logout']) ?>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="/persona"><i class="fa fa-fw fa-dashboard"></i> Registrar Visita</a>
                    </li>
                    <li>
                        <a href="/persona/visitas">
                            <i class="fa fa-fw fa-bar-chart-o"></i> Visitas
                        </a>
                    </li>
                    <li>
                        <a href="/organigrama">
                            <i class="fa fa-fw fa-bar-chart-o"></i> Organigrama
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <ol class="breadcrumb mb0">
              <li><a href="#">Inicio</a></li>
              <li class="active"><?= $title ?></li>
            </ol>
            <?= $this->Flash->render() ?>
            <div class="container-fluid">
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
    <footer>
    </footer>
    <?= $this->Html->script('jquery-2.1.1.min') ?>
    <?= $this->Html->script('bootstrap.min') ?>
    <?= $this->Html->script('jquery.autocomplete.min') ?>
    <?= $this->Html->script('bootstrap-datepicker') ?>
    <?= $this->Html->script('bootstrap-datepicker.es') ?>    
    <script src="/bower_components/handlebars/handlebars.min.js"></script>
    <?= $this->Html->script('visita') ?>
    <?= $this->Html->script('registroVisita') ?>
</body>
</html>
