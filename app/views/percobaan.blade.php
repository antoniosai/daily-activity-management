<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Masih Rahasia</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Custom Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}">
    
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery.dataTables.css">
    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <script type="text/javascript" src="/assets/media/js/jquery.dataTables.min.js"></script>
    
</head>
<body>


      <h3>Users</h3>
  {{ $table->render() }}
  {{ $table->script() }}
  </div>


        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
