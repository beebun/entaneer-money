<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entaneer CMU Money Analysis</title>

    <!-- Bootstrap -->
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

    .disabled{
      background-color:#efefef;
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

<?php 
  $year = date("Y")+543;
  $semester = 1 ;
?>

<div class="container">

  <div class="row">
  <div style="padding:10px" class="col-md-12">
    <h4 style="float:left;margin-left:0px;margin-top:30px">Entaneer CMU Money Analysis</h4>

    <div style="float:right;margin-top:25px">

    <div class="btn-group">
    <div class="dropdown btn-group">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        รายรับ
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <li><a href="{{ route('additem') }}">เพิ่มรายรับ</a></li>
        <li><a href="{{ route('additem2') }}">เพิ่มรายรับประเภท Service/OH</a></li> 
      </ul>
    </div>

    <div class="dropdown btn-group">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        รายจ่าย
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <li>{{ link_to('expenditure1','แก้ไขรายจ่ายประจำปี ตามภาควิชา') }}</li>
        <li>{{ link_to('expenditure2','เพิ่มราย รับ(+) จ่าย(-) ประจำปี') }}</li> 
      </ul>
    </div>


      <div class="dropdown btn-group">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        รายงาน
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <li><a href="{{ route('report', array('semaster' => $semester,  'year' => $year)) }}">รายงานประจำเทอม/ปีการศึกษา</a></li>
        <li><a href="{{ route('report-year', array('year' => $year)) }}">รายงานสรุปตามภาควิชา</a></li> 
      </ul>
    </div>
      
      
      <button class="btn btn-default">{{ link_to('constant','เปลี่ยนแปลงค่า SCCH/จำนวนคน') }}</button>
    </div>
      

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
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>