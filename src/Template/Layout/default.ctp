<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Visitas - ONAGI</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('../bower_components/fontawesome/css/font-awesome.min.css') ?>
    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->css('dist/AdminLTE.css') ?>
    <?= $this->Html->css('dist/skins/_all-skins.min.css') ?>
    <?= $this->Html->css('datepicker.css') ?>
    <?= $this->Html->css('bootstrap-timepicker.min.css') ?>
    <?= $this->Html->css('bootstrap-colorpicker.min.css') ?>
    <?= $this->Html->css(['fullcalendar.css', 'fullcalendar.print.css']) ?>
  </head>
  <body class="skin-red sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <?php echo $this->Html->image('onagi.png', ['alt' => 'CakePHP']);?>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php echo $this->Html->image('/js/dist/img/user2-160x160.jpg', ['alt' => 'Usuario','class'=>'user-image']);?>
                  <span class="hidden-xs"><?php echo $authUser ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?php echo $this->Html->image('/js/dist/img/user2-160x160.jpg', ['alt' => 'Usuario']);?>
                    <p>
                      <?php echo $authUser ?>
                      <small><?php $fecha=getdate(); echo $fecha['mday'].'/'.$fecha['mon'].'/'.$fecha['year'].'<br>'; ?>
                        <?php 
                          if( $this->request->session()->read('usuario.perfil')==1 ){
                            echo "Administrador";
                          }else if($this->request->session()->read('usuario.perfil')==2){
                            echo "Seguridad";
                          }else{
                            echo "Otro";
                          }
                        ?> 
                      </small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <?php echo $this->Html->link('Salir', array('controller' => 'Usuario', 'action' => 'logout'),array('class' => 'btn btn-default btn-flat')) ?>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">OPCIONES</li>

            <li class="treeview <?= ( $titleP=='Visitas' ) ? "active": ""  ?>">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Visitas</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?= ($title=='Registro de Visitas')?"class='active'":"" ?>>
                        <a href="/persona"><i class="fa fa-fw fa-dashboard"></i> Registrar Visita</a>
                    </li>
                    <li <?= ($title=='Listado de visitas')?"class='active'":"" ?>>
                        <a href="/persona/visitas"><i class="fa fa-fw fa-icon-desktop"></i> Visitas</a>
                    </li>
                </ul>
            </li>
            <li <?= ($titleP=='Calendario de Visitas')?"class='active'":""  ?>>
                <a href="/persona/vercalendario"><i class="fa fa-book"></i> <span>Agenda</span></a>
            </li>
            <li class="treeview <?= ($titleP=='Mantenimientos')?"active":""  ?>">
                <a href="#">
                    <i class="fa fa-group fa-fw"></i> <span>Mantenimientos</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?= ($title=='Usuarios')?"class='active'":"" ?>>
                        <a href="/usuario"><i class="fa fa-list fa-fw"></i> Usuarios</a>
                    </li>
                    <li <?= ($title=='Motivos')?"class='active'":"" ?>>
                        <a href="/motivo"><i class="fa fa-fw fa-plus"></i> Motivos</a>
                    </li>
                </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?= $title ?>
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->          
            <div class="box">
            
            <div class="box-body">
              <?= $this->Flash->render() ?>
              <div class="container-fluid">
                  <?= $this->fetch('content') ?>
              </div>
            </div><!-- /.box-body -->
            
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2015 <a class="red" href="http://onagi.gob.pe">ONAGI - Oficina Nacional de Gobierno Interior</a>.</strong> Todos los derechos reservados.
      </footer>
      
      
    <?= $this->Html->script('jquery-2.1.1.min') ?>
    <!-- Bootstrap 3.3.2 JS -->
	  <?= $this->Html->script('bootstrap.min') ?>
    <?= $this->Html->script('bootbox') ?>
    <!-- AdminLTE App -->
	  <?= $this->Html->script('dist/app.min') ?>
    <?= $this->Html->script('jquery.autocomplete.min') ?>
    <?= $this->Html->script('bootstrap-datepicker') ?>
    <?= $this->Html->script('bootstrap-datepicker.es') ?>
    <?= $this->Html->script('bootstrap-timepicker') ?>    
    <?= $this->Html->script('bootstrap-colorpicker.min') ?>
    <script src="/bower_components/handlebars/handlebars.min.js"></script>
    <?= $this->Html->script('registroVisita') ?>
    <?= $this->Html->script('visita') ?>
    <?= $this->Html->script('visitavistante') ?>
    <?= $this->Html->script('motivo') ?>
        
    <script class="cssdesk" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js" type="text/javascript"></script>
    <script class="cssdesk" src="//arshaw.com/js/fullcalendar-1.5.3/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
  <script type="text/javascript">
  $('#calendar').fullCalendar({
            header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: '2015-02-12',
        editable: true,
        events: '/persona/getvisitas'
    });
  </script>
  </body>
</html>