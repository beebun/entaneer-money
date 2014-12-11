<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entaneer CMU Money Analysis</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">

	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <style>
    /*@import url(//fonts.googleapis.com/css?family=Lato:700);*/

    body {
      margin:0;
      font-family:'Lato', sans-serif;
      color: #333;
    }

    .welcome {
      width: 300px;
      height: 200px;
      position: absolute;
      left: 50%;
      top: 50%;
      margin-left: -150px;
      margin-top: -100px;
    }

    a, a:visited {
      text-decoration:none;
    }

    h1 {
      font-size: 32px;
      margin: 16px 0 0 0;
    }
  </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<div class="container">

  <div class="row">
  <div style="padding:10px" class="col-md-12">
    <h2 style="float:left;margin-left:50px">Entaneer CMU Money Analysis</h2>

    <div style="float:right;margin-top:25px">
      {{ link_to('additem','Add Item') }} |
      {{ link_to('expenditure1','Edit Expenditure1') }} |
      {{ link_to('expenditure2','Add Expenditure2') }} |
      {{ link_to('constant','Constant (SCCH, People Num)') }} |

      <a href="{{ route('report', array('semaster' => 1,  'year' => 2557)) }}">Report</a> |
      <a href="{{ route('report-year', array('year' => 2557)) }}">Report year</a>

    </div>
    <div style="clear:both"></div>
    <hr>
  </div>
  </div>

  <div class="row">

        <div class="col-md-1">
        </div>

        <div class="col-md-10">
        @yield('content')
        </div>

        <div class="col-md-1">
        </div>

  </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>