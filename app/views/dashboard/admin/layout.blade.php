<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/metro.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/metro-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/metro-responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/metro-schemes.css') }}">

    <script src="{{ asset('js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('js/metro.js') }}"></script>

    <style>
        html, body {
            height: 100%;
        }
        body {
        }
        .page-content {
            padding-top: 3.125rem;
            min-height: 100%;
            height: 100%;
        }
        .table .input-control.checkbox {
            line-height: 1;
            min-height: 0;
            height: auto;
        }

        @media    screen and (max-width: 800px){
            #cell-sidebar {
                flex-basis: 52px;
            }
            #cell-content {
                flex-basis: calc(100% - 52px);
            }
        }
    </style>

    <script>
        function pushMessage(t){
            var mes = 'Info|Implement independently';
            $.Notify({
                caption: mes.split("|")[0],
                content: mes.split("|")[1],
                type: t
            });
        }

        $(function(){
            $('.sidebar').on('click', 'li', function(){
                if (!$(this).hasClass('active')) {
                    $('.sidebar li').removeClass('active');
                    $(this).addClass('active');
                }
            })
        })
    </script>
    @yield('style')
</head>
<body class="bg-steel">
    <div class="app-bar fixed-top darcula" data-role="appbar">
        <a class="app-bar-element branding"><strong>DMA</strong> - IT Dept. KSA</a>
        <div class="app-bar-element place-right">
            <span class="dropdown-toggle"><span class="mif-cog"></span>  Hi, {{ Sentry::getUser()->first_name }}</span>
            <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 220px">
                <h3 class="fg-white">Panel</h3>
                <hr class="thin bg-grayLighter">
                <ul class="unstyled-list fg-white">
                    <li><a href="" class="fg-white fg-hover-yellow">Profile</a></li>
                    <li><a href="" class="fg-white fg-hover-yellow">Security</a></li>
                    <li><a href="{{ action('UserController@getLogout') }}" class="fg-white fg-hover-yellow">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="flex-grid no-responsive-future" style="min-height: 120%; height: auto;">
            <div class="row" style="height: 100%">
                <div class="cell size-x200" id="cell-sidebar" style="background-color: #3c3f41; height: auto">
                    <ul class="sidebar darcula">
                    <div class="image-container rounded">
                        <div class="frame"><img src="{{ asset('images/gambar.jpg') }}"></div>
                    </div>
                    <br/>
                        <li><a href="{{ action('AdminController@getIndex') }}">
                            <span class="mif-home icon"></span>
                            <span class="title">Dash<br/>board</span>
                        </a></li>
                        <li><a href="{{ action('AdminController@getProfile') }}">
                            <span class="mif-profile icon"></span>
                            <span class="title">My<br/>Profile</span>
                        </a></li>
                        <li><a href="{{ action('AdminController@getManageUser') }}">
                            <span class="mif-users icon"></span>
                            <span class="title">User<br/>Management</span>
                        </a></li>
                        <li><a href="{{ action('LogbookController@getShowLogbook') }}">
                            <span class="mif-list2 icon"></span>
                            <span class="title">Manage<br/>Logbook</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-database icon"></span>
                            <span class="title">Manage<br/>Report</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-cogs icon"></span>
                            <span class="title">Help</span>
                        </a></li>
                    </ul>
                </div>
                <div class="cell auto-size padding20 bg-white" id="cell-content" style="height: auto">
                    @yield('header')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>