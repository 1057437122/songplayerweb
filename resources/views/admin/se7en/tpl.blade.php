<!DOCTYPE html>
<html>
  
<head>
    <title>
      se7en - Dashboard
    </title>
    <link href="/se7en/stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/se7en/stylesheets/font-awesome.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/se7en/stylesheets/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
    
    <link href="/se7en/stylesheets/select2.css" media="all" rel="stylesheet" type="text/css" />
    
    
    <link href="/se7en/stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/se7en/stylesheets/mystyle.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/se7en/stylesheets/color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" />
    <link href="/se7en/stylesheets/color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" />
    <link href="/se7en/stylesheets/color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" />
    <link href="/se7en/stylesheets/color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" />
    
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              
              <li class="dropdown settings hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-gear"></span>
                  <div class="sr-only">
                    Settings
                  </div>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="settings-link blue" href="javascript:chooseStyle('none', 30)"><span></span>Blue</a>
                  </li>
                  <li>
                    <a class="settings-link green" href="javascript:chooseStyle('green-theme', 30)"><span></span>Green</a>
                  </li>
                  <li>
                    <a class="settings-link orange" href="javascript:chooseStyle('orange-theme', 30)"><span></span>Orange</a>
                  </li>
                  <li>
                    <a class="settings-link magenta" href="javascript:chooseStyle('magenta-theme', 30)"><span></span>Magenta</a>
                  </li>
                  <li>
                    <a class="settings-link gray" href="javascript:chooseStyle('gray-theme', 30)"><span></span>Gray</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img width="34" height="34" src="/se7en/images/avatar-male.jpg" />{{ $user->name }}<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li style="display:none;"><a href="#">
                    <i class="icon-user"></i>My Account</a>
                  </li>
                  <li><a href="{{ URL($background.'/edit_myaccount') }}">
                    <i class="icon-gear"></i>修改账户</a>
                  </li>
                  <li><a href="{{ URL($background.'/logout') }}">
                    <i class="icon-signout"></i>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" href="#">se7en</a>
          
        </div>

        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              <li>
                <a id="admin_home" href="{{ URL('/'.$background )}}"><span aria-hidden="true" class="se7en-home"></span>Dashboard</a>
              </li>
              <li>
                <a id="player" href="{{ URL('/'.$background.'/player' )}}"><span aria-hidden="true" class="se7en-feed"></span>播放器</a>
              </li>
              

              @if($isAdmin || Auth::user()->can("songs*"))
              
              <li class="dropdown"><a id="songlists" data-toggle="dropdown" href="#">
                <span aria-hidden="true" class="se7en-gallery"></span>歌曲库<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="{{ URL('/'.$background.'/songs/') }}">全部歌曲</a>
                  </li>
                  <li>
                    <a href="{{ URL('/'.$background.'/songs/list') }}">播放歌单</a>
                  </li>
                  
                </ul>
              </li>
              @endif
              
            </ul>
          </div>
        </div>
      </div>
      <!-- End Navigation -->
      <div class="container-fluid main-content">

        @yield('content')
        
        
      </div>
    </div>
  </body>
  <script src="/se7en/javascripts/jquery-1.10.2.min.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/jquery-ui.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/bootstrap.min.js" type="text/javascript"></script>
  
  <script src="/se7en/javascripts/select2.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/styleswitcher.js" type="text/javascript"></script>
  
  <script src="/se7en/javascripts/jquery.validate.js" type="text/javascript"></script>
  
  <script src="/se7en/javascripts/respond.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/jquery.bootpag.min.js" type="text/javascript"></script>
  <script src="/layer/layer.js" type="text/javascript"></script>

  <script src="/se7en/javascripts/bootstrap-fileupload.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/bootstrap-datepicker.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/jquery.sparkline.min.js" type="text/javascript"></script>
  <script src="/se7en/javascripts/mymain.js" type="text/javascript"></script>
  <script>
  $(function () {
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      });
  });
  @if($show_info)
    layer.msg("{{ $show_info }}");
  @endif
  </script>
  @yield('scripts')
</html>