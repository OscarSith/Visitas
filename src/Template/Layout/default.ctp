<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Visitas - ONAGI</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <?= $this->Html->css('bootstrap.min.css') ?>
    <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->css('dist/AdminLTE.min.css') ?>
    <?= $this->Html->css('dist/skins/_all-skins.min.css') ?>
    <?= $this->Html->css('datepicker.css') ?>
    <?= $this->Html->css('bootstrap-timepicker.min.css') ?>
    <?= $this->Html->css('fullcalendar.css') ?>
    <?= $this->Html->css('fullcalendar.print.css') ?>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>LTE</span>
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
                  <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">Alexander Pierce</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $authUser ?>
                      <small><?php getdate()?></small>
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
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Visitas</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="/persona"><i class="fa fa-fw fa-dashboard"></i> Registrar Visita</a>
                </li>
                <li>
                  <a href="/persona/visitas"><i class="fa fa-fw fa-icon-desktop"></i> Visitas</a>
                </li>
              </ul>
            </li>
                        
            <li><a href="/persona/vercalendario"><i class="fa fa-book"></i> <span>Agenda</span></a></li>
            
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
            <div class="box-footer">
              Footer
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>
      
      
    <?= $this->Html->script('jquery-2.1.1.min') ?>
    <!-- Bootstrap 3.3.2 JS -->
	  <?= $this->Html->script('bootstrap.min') ?>
    <!-- AdminLTE App -->
	  <?= $this->Html->script('dist/app.min') ?>
    <?= $this->Html->script('jquery.autocomplete.min') ?>
    <?= $this->Html->script('bootstrap-datepicker') ?>
    <?= $this->Html->script('bootstrap-datepicker.es') ?>
    <?= $this->Html->script('bootstrap-timepicker') ?>    
    <script src="/bower_components/handlebars/handlebars.min.js"></script>
    <?= $this->Html->script('registroVisita') ?>
    <?= $this->Html->script('visita') ?>
    <?= $this->Html->script('visitavistante') ?>
        
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