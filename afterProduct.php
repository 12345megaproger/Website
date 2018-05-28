<!DOCTYPE html>
<?php
	require("Conn.php");
	require("MySQLDao.php");
	
	$product_id = htmlentities($_GET["product_id"]);
	$quantity = htmlentities($_GET["quantity"]);
	
	$returnValue = array();

	$dao = new MySQLDao();
	$dao->openConnection();

	
    $dao->closeConnection();
?>

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
	  	
	 <form action="afterProduct.php"> 	
  	<table class="table">
  <thead class="thead-default">
    <tr>
      <th style="color:#ffffff;">Фото</th>
      <th style="color:#ffffff;">Модель</th>
      <th style="color:#ffffff;">Размер</th>
      <th style="color:#ffffff;">Цена</th>
      <th style="color:#ffffff;">Количество,шт</th>
      <th style="color:#ffffff;">Сумма</th>
    </tr>
  </thead>
  <?php $dao = new MySQLDao();
	$dao->openConnection();
	
    $userEnter = $dao -> filldiv1($product_id,$quantity);
    // echo json_encode($userEnter);
    $dao->closeConnection();
				
				 ?>
</table>
<button formaction="client.php" class="btn btn-default" style="width:150px; margin-left:8px;">Далее</button>
<button class="btn btn-default" style="width:150px; margin-left:8px;">Обновить Сумму</button>
  	</form>
	
    </body>
</html>