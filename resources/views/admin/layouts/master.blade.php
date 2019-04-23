<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت مقدم چاپ | داشبورد</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="/adminAsset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/adminAsset/css/bootstrap-rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminAsset/css/adminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/adminAsset/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/adminAsset/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/adminAsset/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/adminAsset/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/adminAsset/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/adminAsset/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/adminAsset/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="/adminAsset/fonts/fonts-fa.css">
<link rel="stylesheet" href="/assets/css/sweetalert2.min.css">
  <style>
  .navbar-nav > li > .dropdown-menu > li .menu > li > a > p {
    margin: 0 0 0 51px;
    font-size: 12px;
    color: #212121;
    word-break: break-word;
    white-space: normal;
    overflow: hidden;
    text-overflow: ellipsis;
}
    
    .navbar-nav > li > .dropdown-menu > li .menu > li > a {
    margin: 0;
    padding: 10px 10px;
}
    .navbar-nav > li > .dropdown-menu > li .menu > li > a > h4 {
    padding: 0;
    margin: 0 45px 0 0;
    color: #444444;
    font-size: 15px;
    position: relative;
}
    .navbar-nav > li > .dropdown-menu > li .menu > li > a > p {
    margin: 0 0 0 45px;
    font-size: 12px;
    color: #888888;
}
    .navbar-nav > li > .dropdown-menu > li .menu > li > a > h4 > small {
    color: #999999;
    font-size: 10px;
    position: absolute;
    top: 0;
    left: 0;
}
  </style>
@yield('extraStyle')
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>M</b>.print</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><h3 style="line-height: 0.5"><b>مقدم</b> چاپ</h3></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user-plus"></i>
                  <span class="label label-success">{{ $usersNotifications->count() }}</span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      @foreach($usersNotifications as $notification)
                      <li><!-- start message -->
                        <a href="{{ url($notification->link) }}" target="_blank" onclick="seenedNotification({{ $notification->id }},'register')">
                          <h4>
                            <small><i class="fa fa-clock-o"></i>{{ jdate(strtotime($notification->created_at))->ago() }}</small>
                          </h4>
                          <p>{{ $notification->description }}</p>
                        </a>
                      </li>
                      @endforeach
                    </ul>
                  </li>
                  <li class="footer"><a href="#">مشاهده همه پیام ها</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-shopping-bag"></i>
                  <span class="label label-warning">{{ $orderNotifications->count() }}</span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      @foreach($orderNotifications as $notification)
                      <li><!-- start message -->
                        <a href="{{ url($notification->link) }}" target="_blank" onclick="seenedNotification({{ $notification->id }},'order')">
                          <h4>
                            <small><i class="fa fa-clock-o"></i>{{ jdate(strtotime($notification->created_at))->ago() }}</small>
                          </h4>
                          <p>{{ $notification->description }}</p>
                        </a>
                      </li>
                      @endforeach
                    </ul>
                  </li>
                  <li class="footer"><a href="#">مشاهده همه</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope"></i>
                  <span class="label label-danger">{{ $ticketNotifications->count() }}</span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      @foreach($ticketNotifications as $notification)
                      <li><!-- start message -->
                        <a href="{{ url($notification->link) }}" target="_blank" onclick="seenedNotification({{ $notification->id }},'ticket')">
                          <h4>
                            <small><i class="fa fa-clock-o"></i>{{ jdate(strtotime($notification->created_at))->ago() }}</small>
                          </h4>
                          <p>{{ $notification->description }}</p>
                        </a>
                      </li>
                      @endforeach
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">مشاهده همه</a>
                  </li>
                </ul>
              </li>
                
                  <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ auth()->user()->avatar?asset(auth()->user()->avatar):"/adminAsset/img/avatar.png" }}"
                                 class="user-image">
                            <span class="hidden-xs">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ auth()->user()->avatar?asset(auth()->user()->avatar):"/adminAsset/img/avatar.png" }}"
                                     class="img-circle">
                                <p>
                                    {{ auth()->user()->name }} - مدیر سایت
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">پروفایل</a>
                                </div>
                                <div class="pull-left">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="btn btn-default btn-flat">خروج</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
    @include('admin.layouts.sidebar')
    <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        @if(count($errors->failed)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->failed->all() as $error)
                        <li><i class="fa fa-warning"></i> {!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(count($errors->success)>0)
            <div class="alert alert-success">
                <ul>
                    @foreach($errors->success->all() as $error)
                        <li><i class="fa fa-check"></i> {!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
    <footer class="main-footer">
        <div class="pull-left hidden-xs">
            <b>نسخه</b> 2.2.0
        </div>
        طراحی و اجرا توسط <a href="https://hugenet.ir" target="_blank">ایده پردازان تدبیر بنیان</a>
    </footer>

</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="/adminAsset/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.4 -->
<script src="/adminAsset/js/bootstrap.min.js"></script>
<!-- Sparkline -->
<script src="/adminAsset/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/adminAsset/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/adminAsset/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/adminAsset/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="/adminAsset/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/adminAsset/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/adminAsset/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/adminAsset/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/adminAsset/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminAsset/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/adminAsset/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminAsset/js/demo.js"></script>
  <script src="/assets/js/sweetalert2.all.min.js"></script>
<script src="/assets/js/sweetalert2.min.js"></script>
  <script>
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $(document).on('click', ".deleteBTN", function (e) {
      e.preventDefault();
      var href = $(this).attr('href');
      swal({
          title: "آیا اطمینان دارید؟",
          text: "این عملیات قابل بازگشت نیست ",
          type: "warning",
          showCancelButton: true,
          cancelButtonText:"خیر",
          confirmButtonText:"بله اطمینان دارم"
      }).then(function (result) {
          if (result.value) {
              window.location = href;
          }
        });
    });
    function checkUsers(){
      $.ajax({
        type:'POST',
        url:'{{ route("admin.checkUsers") }}',
        success:function(response){
          response=JSON.parse(response);    
          if($(".messages-menu span").html()!=response.length){
             var audio = new Audio('/adminAsset/definite.mp3');
             audio.play();
          }
          $(".messages-menu span").html(' '+response.length);
          var result="";
          for(var item in response){
            item=response[item];
            result=result+("<li><a href='"+item['link']+"' target='_blank' onclick='seenedNotification("+item['id']+",\"register\")'><h4><small><i class='fa fa-clock-o'></i>"+item['created_at']+"</small></h4><p>"+item['description']+"</p></a></li>");
          }  
          $(".messages-menu ul ul").html(result);

        }
      });  
    }
    function checkOrders(){
      $.ajax({
        type:'POST',
        url:'{{ route("admin.checkOrders") }}',
        success:function(response){
          response=JSON.parse(response);    
          if($(".notifications-menu span").html()!=response.length){
             var audio = new Audio('/adminAsset/definite.mp3');
             audio.play();
          }
          $(".notifications-menu span").html(' '+response.length);
          var result="";
          for(var item in response){
            item=response[item];
            result=result+("<li><a href='"+item['link']+"' target='_blank' onclick='seenedNotification("+item['id']+",\"order\")'><h4><small><i class='fa fa-clock-o'></i>"+item['created_at']+"</small></h4><p>"+item['description']+"</p></a></li>");
          }  
          $(".notifications-menu ul ul").html(result);

        }

      });  
    } 
    function checkTickets(){
      $.ajax({
        type:'POST',
        url:'{{ route("admin.checkTickets") }}',
        success:function(response){
          response=JSON.parse(response);    
          if($(".tasks-menu span").html()!=response.length){
             var audio = new Audio('/adminAsset/definite.mp3');
             audio.play();
          }
          $(".tasks-menu span").html(' '+response.length);
          var result="";
          for(var item in response){
            item=response[item];
            result=result+("<li><a href='"+item['link']+"' target='_blank' onclick='seenedNotification("+item['id']+",\"ticket\")'><h4><small><i class='fa fa-clock-o'></i>"+item['created_at']+"</small></h4><p>"+item['description']+"</p></a></li>");
          }  
          $(".tasks-menu ul ul").html(result);

        }

      });
    }
    function seenedNotification(id,category){
      $.ajax({
        type:'POST',
        data:{
          id:id
        },
        url:'{{ route("admin.seenNotification") }}',
        success:function(){
            if(category=="register")
              $(".messages-menu span").html($(".messages-menu span").html()-1);
            else if(category=='order')
              $(".notifications-menu span").html($(".notifications-menu span").html()-1);
            else if(category=='ticket')
              $(".tasks-menu span").html($(".tasks-menu span").html()-1);
        }
    });
    }
    
    setInterval(function(){ checkOrders() }, 20000);
    setInterval(function(){ checkUsers() }, 20000);
    setInterval(function(){ checkTickets() }, 20000);
  </script>
  @yield('extraScripts')

</body>
</html>