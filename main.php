<?php
	require("Conn.php");
	require("MySQLDao.php");
	
	$season = htmlentities($_GET["season"]);
	$manifacturer = htmlentities($_GET["manufacturer"]);
	$width = htmlentities($_GET["width"]);
	$height = htmlentities($_GET["height"]);
	$diameter = htmlentities($_GET["diameter"]);

	$returnValue = array();

	$dao = new MySQLDao();
	$dao->openConnection();


	
    $dao->closeConnection();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Интернет магазин Дисков и Шин</title>

    <link href="mycss/box.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  	<body>
  	<style>
   body {
    background-image: url(background.jpg); /* Путь к фоновому изображению */
    background-position: center top;
   }
  </style>
  	<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://localhost:8888/kursach/index.php">SHINDISK</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="info.php">About</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  	
  	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet"/>
 


				<!--
				PHP FUNCTION
				-->
				
<?php $dao = new MySQLDao();
	$dao->openConnection();

    $userEnter = $dao -> filldiv($season, $manifacturer, $width, $height, $diameter);
    // echo json_encode($userEnter);
	
    $dao->closeConnection();
				
				 ?>	



	
    </body>
</html>