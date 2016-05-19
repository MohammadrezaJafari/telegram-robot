<!DOCTYPE html>
<?php $publicPath = config("ui.publicPath") ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--    <link rel="shortcut icon" href="images/icon.png">-->

    <title>EArzeh</title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap core CSS -->
    <link href='<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/js/bootstrap/dist/css/bootstrap.css'?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/fonts/font-awesome-4/css/font-awesome.min.css'?>' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <link href='<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/../../assets/js/html5shiv.js'?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/../../assets/js/respond.min.js'?>' rel='stylesheet' type='text/css'>

    <![endif]-->

    <link href='<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/js/jquery.nanoscroller/nanoscroller.css'?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo  $publicPath .'packages/module/ui' . "/assets/layout/css/fa/style.css"?>' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/js/jquery.js' ?>"></script>

    {{\Module\UI\Facade\Asset::styles()}}


</head>
<body>

<div id="cl-wrapper">

    <div class="cl-sidebar" style="  height: 2200px;">
        <div class="cl-toggle"><i class="fa fa-bars"></i></div>
        <div class="cl-navblock">
            <div class="menu-space">
                <div class="content">
                    <div class="sidebar-logo">
                        <div class="logo">
                            <a href="index2.html"></a>
                        </div>
                    </div>
                    <div class="side-user">
                        <div class="avatar"><img style="width: 100px" src="{{config('ui.publicPath') ."frontend/images/"}}AIRWHEEL-BRAND-FINAL1.png" alt="Avatar" /></div>
                    </div>
                    <ul class="cl-vnavigation">
                        {!! \App\Backend\Navigation\Facade\Navigation::renderNav() !!}
                        {{--@include("ui::nav")--}}
                    </ul>
                </div>
            </div>
            <div class="text-right collapse-button" style="padding:7px 9px;">
                <input type="text" class="form-control search" placeholder="Search..." />
                <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
            </div>
        </div>
    </div>


    <div class="container-fluid" id="pcont">
        <!-- TOP NAVBAR -->
        <div id="head-nav" class="navbar navbar-default" style="width: 100%">
            <div class="container-fluid">
                <div class="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right user-nav">
                        <li class="dropdown profile_menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img style="width: 100px" src="{{config('ui.publicPath') ."frontend/images/"}}AIRWHEEL-BRAND-FINAL1.png" alt="Avatar" />
                                <span></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="divider"></li>
                                <li><a href="{{ url('/auth/logout') }}">Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse animate-collapse -->
            </div>
        </div>


        <div class="cl-mcont">
            <?php if(isset($this->message)): ?>
            <div class="alert alert-<?php echo  $publicPath .$this->message['type'] ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa fa-info-circle sign"></i><strong></strong> <?php echo  $publicPath .$this->message['content'] ?>
            </div>
            <?php endif; ?>
            @yield('content')

        </div>
    </div>

</div>


<script type="text/javascript" src="<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/js/jquery.cookie/jquery.cookie.js' ?>"></script>
<script type="text/javascript" src="<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/js/jquery.pushmenu/js/jPushMenu.js' ?>"></script>
<script type="text/javascript" src="<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/js/jquery.nanoscroller/jquery.nanoscroller.js' ?>"></script>
<script type="text/javascript" src="<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/js/jquery.sparkline/jquery.sparkline.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/js/jquery.ui/jquery-ui.js' ?>"></script>
<script type="text/javascript" src="<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/js/behaviour/core.js' ?>"></script>

<script type="text/javascript" src="<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/js/behaviour/dashboard.js' ?>"></script>


<!-- Bootstrap core JavaScript================================================== -->
<!-- Placed at the end of the document so the pages load faster -->



<script type="text/javascript" src="<?php echo  $publicPath .'packages/module/ui' . '/assets/layout/js/bootstrap/dist/js/bootstrap.min.js' ?>"></script>

{{\Module\UI\Facade\Asset::scripts()}}


<script type="text/javascript">

</script>


</body>
</html>