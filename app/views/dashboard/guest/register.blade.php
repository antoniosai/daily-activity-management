<!DOCTYPE html>
<html>
<head>
    <title>Register: DMA - IT Dept. KSA</title>

    <link href="../css/metro.css" rel="stylesheet">
    <link href="../css/metro-icons.css" rel="stylesheet">
    <link href="../css/metro-responsive.css" rel="stylesheet">

    <script src="../js/jquery-2.1.3.min.js"></script>
    <script src="../js/metro.js"></script>
    
    <style>
        .login-form {
            width: 25rem;
            height: 18.75rem;
            position: fixed;
            top: 50%;
            margin-top: -15.5rem;
            left: 50%;
            margin-left: -12.5rem;
            background-color: #ffffff;
            opacity: 0;
            -webkit-transform: scale(.8);
            transform: scale(.8);
        }
    </style>

    <script>

        /*
        * Do not use this is a google analytics fro Metro UI CSS
        * */
        if (window.location.hostname !== 'localhost') {

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-58849249-3', 'auto');
            ga('send', 'pageview');

        }


        $(function(){
            var form = $(".login-form");

            form.css({
                opacity: 1,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": ".5s",
                "transition": ".5s"
            });
        });
    </script>
</head>
<body class="bg-darkTeal">
    <div class="login-form padding20 block-shadow" style="height: auto;">

        <form action="{{ action('UserController@postRegister') }}" method="post" role="form" style="display: block;">
            <h1 class="text-light">DMA - IT Dept. KSA</h1>
            <hr class="thin"/>
            <?php $error = Session::get('errorMessage'); ?>
            @if($error)
            <div class="fg-white bg-red padding10" style="text-align: center">{{ $error }}</div>
            <hr class="thin"/>
            @endif
            <?php $success = Session::get('successMessage'); ?>
            @if($success)
            <div class="fg-white bg-green padding10" style="text-align: center">{{ $success }}</div>
            <hr class="thin"/>
            @endif
            <br />
            <div class="input-control text full-size">
      <input type="text" name="first_name" placeholder="Masukan Nama Pertama">
    </div><br/>
    <div class="input-control text full-size">
      <input type="text" name="last_name" placeholder="Masukan Nama Akhir">
    </div><br/>
    <div class="input-control text full-size">
      <input type="text" name="email" placeholder="Masukan Alamat Email">
    </div><br/>
    <div class="row">
      <div class="cell colspan6">
        <div class="input-control password full-size" style="padding-right: 15px">
          <input type="password" name="password" placeholder="Masukan Password">
        </div>
      </div>
      <div class="cell colspan6">
        <div class="input-control password full-size">
          <input type="password" name="password_confirmation" placeholder="Ketik Ulang Pasword">
        </div>
      </div>
    </div>

    <br/><br/>
    <hr class="thin bg-grayLighter">
    <div class="place-right">
      <button class="button success large-button">Add</button>
    </div>
        </form>
    </div>

    <!-- hit.ua -->
    <a href='http://hit.ua/?x=136046' target='_blank'>
        <script language="javascript" type="text/javascript"><!--
            Cd=document;Cr="&"+Math.random();Cp="&s=1";
            Cd.cookie="b=b";if(Cd.cookie)Cp+="&c=1";
            Cp+="&t="+(new Date()).getTimezoneOffset();
            if(self!=top)Cp+="&f=1";
            //--></script>
            <script language="javascript1.1" type="text/javascript"><!--
                if(navigator.javaEnabled())Cp+="&j=1";
                //--></script>
                <script language="javascript1.2" type="text/javascript"><!--
                    if(typeof(screen)!='undefined')Cp+="&w="+screen.width+"&h="+
                        screen.height+"&d="+(screen.colorDepth?screen.colorDepth:screen.pixelDepth);
                    //--></script>
                    <script language="javascript" type="text/javascript"><!--
                        Cd.write("<img src='http://c.hit.ua/hit?i=136046&g=0&x=2"+Cp+Cr+
                            "&r="+escape(Cd.referrer)+"&u="+escape(window.location.href)+
                            "' border='0' wi"+"dth='1' he"+"ight='1'/>");
                            //--></script></a>
                            <!-- / hit.ua -->


  </body>
</html>