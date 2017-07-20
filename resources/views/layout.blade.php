<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/logo.png">
    <link rel="stylesheet" href="/css/w3.css">
    <link rel="stylesheet" href="/css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/Supernice.css">
    
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/sticky-footer.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/css/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="/js/actions.js"></script>
    <script src="/js/validator.js"></script>
    <script src="/js/validator.min.js"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiQk8VXh5nJs0I_O-zC5kmyJaiMvQ7apk">
    </script>
  </head>
  <body>
    <div class="container-fluid">
        <nav class="navbar navbar-default">
          <div class="container">
            <div class="navbar-header" id="navbar-brand">
              <a class="navbar-brand" href="/home"><image src="/logo.png" style="width: 30px; height: 30px; margin-top: -7px" class="pull-left"></image> <b>Hotel Cataloging System</b></a>
            </div>
            @if(session('status') < 1)
              <ul class="nav navbar-nav navbar-right">
                <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            @else
              @if(session('type') == 'superadmin')
                <ul class="nav navbar-nav navbar-right">

                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hotels
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="/addhotel">Add Hotel</a></li>
                      <li><a href="/viewhotels">View Hotels</a></li>
                      <li><a href="/managerooms">Manage Rooms</a></li>
                      <li><a href="/managegallery">Manage Gallery</a></li>
                    </ul>
                  </li>

                  <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                </ul>
              @else
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Hotel
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="/edithotel">Edit My Hotel</a></li>
                      <li><a href="/gallery">Manage My Gallery</a></li>
                      <li><a href="/myrooms">Manage My Rooms</a></li>
                    </ul>
                  </li>
                  <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
                </ul>
              @endif
            @endif
          </div>
        </nav>
    @yield('homepage')
    @yield('index')
    @yield('loginpage')
    @yield('addhotel')
    @yield('viewhotels')
    @yield('edithotel')
    @yield('editmyhotel')
    @yield('mygallery')
    @yield('viewgallery')
    @yield('viewmap')
    @yield('myroomtypes')
    @yield('myrooms')
    </div>
   </body>
    <footer class="footer">
        jasonsolis@gmail.com || Lyceum-Northwestern University || Tapuac District, Dagupan City, Pangasinan 
    </footer>
</html>
