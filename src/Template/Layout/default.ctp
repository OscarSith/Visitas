<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Visitas - ONAGI</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>    
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('../bower_components/fontawesome/css/font-awesome.min.css') ?>
    <?= $this->Html->css('dist/AdminLTE.css') ?>
    <?= $this->Html->css('dist/skins/_all-skins.min.css') ?>
    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->css('datepicker.css') ?>
    <?= $this->Html->css('bootstrap-timepicker.min.css') ?>
    <?= $this->Html->css('../bower_components/fullcalendar/dist/fullcalendar.min.css') ?>
    <?= $this->Html->css('bootstrap-colorpicker.min.css') ?>
    <?= $this->Html->css('chosen.css') ?>
    <?php $codPerfil = $this->request->session()->read('usuario.perfil'); ?>
  </head>
  <body class="skin-red sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <?php echo $this->Html->image('onagi.png', ['alt' => 'ONAGI']);?>
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
                  <span class="hidden-xs"><?php echo $authUser ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <p>
                      <?php echo $authUser ?>
                      <small><?php $fecha=getdate(); echo $fecha['mday'].'/'.$fecha['mon'].'/'.$fecha['year'].'<br>'; ?>
                        <?php 
                          if( $codPerfil==1 ){
                            echo "Administrador";
                          }else if($codPerfil==2){
                            echo "Seguridad";
                          }else if($codPerfil==3){
                            echo "Secretaría";
                          }else if($codPerfil==4){
                            echo "Jefatura";
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
            <?php if ( $codPerfil!=2 ) { ?>
            <li <?= ($titleP=='Dashboad')?"class='active'":""  ?>>
                <?php echo $this->Html->link('<i class="fa fa-dashboard"></i> <span>Dashboard</span>', '/dashboard', ['escape' => false]); ?>
            </li>

            <li <?= ($titleP=='Calendario de Visitas')?"class='active'":""  ?>>
                <?php echo $this->Html->link('<i class="fa fa-calendar"></i> <span>Agenda</span>', '/visita/vercalendario', ['escape' => false]); ?>
            </li>
            <?php } ?>
            
            <li class="treeview <?= ( $titleP=='Visitas' ) ? "active": ""  ?>">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Visitas</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?= ($title=='Registro de Visitas')?"class='active'":"" ?>>
                      <?php echo $this->Html->link('<i class="fa fa-fw fa-dashboard"></i> Registrar Visita','/persona', ['escape' => false]); ?>
                    </li>
                    <li <?= ($title=='Listado de visitas')?"class='active'":"" ?>>
                      <?php echo $this->Html->link('<i class="fa fa-fw fa-edit"></i> Visitas', "/persona/visitas", ['escape' => false]); ?>
                    </li>
                </ul>
            </li>
                        
            <?php if ( $codPerfil==1 ) { ?>
            <li class="treeview <?= ($titleP=='Mantenimientos')?"active":""  ?>">
                <a href="#">
                    <i class="fa fa-group fa-fw"></i> <span>Mantenimientos</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?= ($title=='Usuarios')?"class='active'":"" ?>>
                        <?php echo $this->Html->link('<i class="fa fa-list fa-fw"></i> Usuarios', '/usuario', ['escape' => false]) ?>
                    </li>
                    <li <?= ($title=='Motivos')?"class='active'":"" ?>>
                        <?php echo $this->Html->link('<i class="fa fa-fw fa-plus"></i> Motivos', '/motivo', ['escape' => false]) ?>
                    </li>
                </ul>
            </li>
            <?php } ?>
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
        <strong>Copyright &copy; <?php echo date('Y') ?> <a class="red" href="http://onagi.gob.pe">ONAGI - Oficina Nacional de Gobierno Interior</a>.</strong> Todos los derechos reservados.
      </footer>
    <?= $this->Html->script('../bower_components/jquery/dist/jquery.min') ?> 
    <?= $this->Html->script('jquery.validate.min.js') ?>
    <script>
      $.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una dirección de correo válida",
        url: "Por favor, escribe una URL válida.",
        date: "Por favor, escribe una fecha válida.",
        dateISO: "Por favor, escribe una fecha (ISO) válida.",
        number: "Por favor, escribe un número entero válido.",
        digits: "Por favor, escribe sólo dígitos.",
        creditcard: "Por favor, escribe un número de tarjeta válido.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        accept: "Por favor, escribe un valor con una extensión aceptada.",
        maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
        minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
        rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
        range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
        max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
        min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
      });
      var validateOptions = {
        errorClass: 'text-danger',
        errorPlacement: function(error, elem) {
          $(elem).parent().addClass('has-error').append(error);
        },
        success: function(e) {
          $(e).parent().removeClass('has-error').addClass('has-success');
        }
      };
      var url_app = 'http://<?php echo $_SERVER['HTTP_HOST'] . '/PyVisita' ?>';
    </script>
    <!-- Bootstrap 3.3.2 JS -->
	  <?= $this->Html->script('../bower_components/bootstrap/dist/js/bootstrap.min') ?>
    <!-- AdminLTE App -->
	  <?= $this->Html->script('dist/app.min') ?>
    <?= $this->Html->script('jquery.autocomplete.min') ?>
    <?= $this->Html->script('../bower_components/handlebars/handlebars.min') ?>
    <?= $this->Html->script('../bower_components/moment/min/moment.min') ?>
    <?= $this->Html->script('../bower_components/fullcalendar/dist/fullcalendar.min') ?>
    <?= $this->Html->script('../bower_components/fullcalendar/dist/lang/es') ?>
    <?= $this->Html->script('bootstrap-datepicker') ?>
    <?= $this->Html->script('bootstrap-datepicker.es') ?>
    <?= $this->Html->script('bootstrap-timepicker') ?>    
    <?= $this->Html->script('bootstrap-colorpicker.min') ?>
    <?= $this->Html->script('chosen.jquery.min') ?>
    
    <?= $this->Html->script('registroVisita') ?>
    <?= $this->Html->script('visita') ?>
    <?= $this->Html->script('visitavistante') ?>
    <?= $this->Html->script('motivo') ?>

    <?= $this->Html->script('jquery.canvasjs.min') ?>
    <?= $this->Html->script('excanvas') ?>
    <script id="cbo-organigramas" type="text/x-handlebars-template">
      <div class="form-group form-group-sm">
        <div class="row">
          <label class="control-label col-sm-2">{{ label }}</label>
          <div class="col-sm-4">
            <select name="organigrama" class="form-control organigrama_cbo" data-place="{{ place }}">
              {{{ options }}}
            </select>
          </div>
        </div>
      </div>
    </script>
    <script type="text/javascript">
    var $calendar = $('#calendar');
    if ($calendar.length) {
      $('#calendar').fullCalendar({
          header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: new Date(),
        editable: true,
        lang: 'es',
        events: '/visita/getvisitas'
      });
    }

    var dataEstado = [],
        dataOficina = [],
        $pieContainer = $('#pieContainer');
    if ($pieContainer.length) {
      $.getJSON( url_app + "/visita/visitantesbyestado", function (data) {
        var contvisitas=0;
          for (var i = 0; i <= data.length -1; i++) {
            var estado= ( data[i].estado=='R' ) ? 'Registrado': ( data[i].estado=='F' )? 'Finalizado': ( data[i].estado=='D' )? 'En Desarrollo':( data[i].estado=='A' )? 'Anulado':'Si definir';
            contvisitas=contvisitas+data[i].count;
           dataEstado.push({ label: estado, y: parseInt(data[i].count) });
         }
         var chart = new CanvasJS.Chart("barContainer", {
             theme: "theme1",//theme1
             title: {
                 text: "Visitas por Estado"
              },
              legend: { text: "Visitas" },
              // Change type to "bar", "splineArea", "area", "spline", "pie",etc.
              data: [ {                    
                       type: "doughnut",
                       dataPoints: dataEstado
                     }
                 ]
         });
         chart.render();
      });
      $.getJSON(url_app + "/visita/visitantesbyoficina", function (data) {
         for (var i = 0; i <= data.length -1; i++) {
             dataOficina.push({ label: data[i].o.organigrama_nombre, y: parseInt(data[i].count) });
          }
          var chart = new CanvasJS.Chart("pieContainer", {
              theme: "theme1",//theme1
              title: {
                  text: "Visitas por Oficina"
              },
              // Change type to "bar", "splineArea", "area", "spline", "pie",etc.
              data: [ {
                    type: "bar",
                    dataPoints: dataOficina
                  }
              ]
          });
          chart.render();
      });
    }
    var $registerUser = $('#frm-register-user');
    if ($registerUser.length) {
      $registerUser.validate(validateOptions);
    }
  </script>
  </body>
</html>