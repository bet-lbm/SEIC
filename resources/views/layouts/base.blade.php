<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/css/toastr.css" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name','laravel') }}</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
</head>

<body class="sidebar-mini fixed">

<div class="wrapper">
      <!-- Navbar-->
      <header class="main-header hidden-print"><a class="logo" href=""><p>S e i c</p></a>
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
          <!-- Navbar Right Menu-->
          <div class="navbar-custom-menu">
            <ul class="top-nav">
              @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
              @else
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      {{ Auth::user()->email }} <span class="caret"></span>
                  </a>

                    <ul class="dropdown-menu settings-menu">
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
              @endif
            </ul>
          </div>
        </nav>
      </header>
      <!-- Side-Nav-->
      <aside class="main-sidebar hidden-print">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image"><img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image"></div>
            <div class="pull-left info">
              <p> {{ Auth::user()->name }} </p>
              <p class="designation">{{ Auth::user()->email }}</p>
            </div>
          </div>
          <!-- Sidebar Menu-->
          <ul class="sidebar-menu">
            <li class="treeview"><a href="#"><i class="fa fa-laptop"></i><span>Mantenimiento</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ route('aulas.list') }}"><i class="fa fa-circle-o"></i>Aulas</a></li>
                <li><a href="{{ route('alumnos.list') }}"><i class="fa fa-circle-o"></i>Alumnos</a></li>
                <li><a href="{{ route('cursos.list') }}"><i class="fa fa-circle-o"></i>Cursos</a></li>
                <li><a href="{{ route('horarios.list') }}"><i class="fa fa-circle-o"></i>Horarios</a></li>
              </ul>
            </li>
            <li class="treeview"><a href="#"><i class="fa fa-edit"></i><span>Procesos</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="form-components.html"><i class="fa fa-circle-o"></i>Asistencia</a></li>
                <li><a href="form-custom.html"><i class="fa fa-circle-o"></i>Certificados</a></li>
                <li><a href="form-samples.html"><i class="fa fa-circle-o"></i>Leccion</a></li>
                <li><a href="form-notifications.html"><i class="fa fa-circle-o"> Matriculas</i></a></li>
                <li><a href="form-notifications.html"><i class="fa fa-circle-o"> Notas</i></a></li>
              </ul>
            </li>
            <li class="treeview"><a href="#"><i class="fa fa-th-list"></i><span>Reportes</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="table-basic.html"><i class="fa fa-circle-o"></i> alumnos por Curso</a></li>
                <li><a href="table-data-table.html"><i class="fa fa-circle-o"></i>Asistencia de Alumnos</a></li>
                <li><a href="table-data-table.html"><i class="fa fa-circle-o"></i>Notas</a></li>
              </ul>
            </li>
          </ul>
        </section>
      </aside>
      <div class="content-wrapper" id="app">
        <!--Contenido heredado-->
        @yield('content')    
      </div>
    </div>
    <!-- Javascripts-->

    <script src="/js/jquery-2.1.4.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/pace.min.js"></script>
    <script src="/js/main.js"></script>
    
    <script src="/js/toastr.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
