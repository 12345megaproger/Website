<?php
 
require("Conn.php");
require("MySQLDao.php");

$dao = new MySQLDao();
$dao->openConnection();

$product_id = htmlentities($_GET["product_id"]);
$quantity = htmlentities($_GET["quantity"]);
$sum = htmlentities($_GET["sum"]);



$result = mysqli_query($dao->conn, 'SELECT shops.address, city.name from( shops
INNER JOIN city ON shops.city_id = city.city_id)');
// закрываем подключение
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
  
<div class="container">
  <form>
    <div class="form-group row">
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg" style="color:#ffffff;">Имя</label>
      <div class="col-sm-10">
        <input type="name" class="form-control form-control-lg" name="first_name" placeholder="Имя">
      </div>
    </div>
    
    
    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm" style="color:#ffffff;">Фамилия</label>
      <div class="col-sm-10">
        <input type="name" class="form-control form-control-sm" name="last_name" placeholder="Фамилия">
      </div>
    </div>
    <div class="form-group row">
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg" style="color:#ffffff;">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control form-control-lg" name="email" placeholder="Email">
      </div>
    </div>
    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm" style="color:#ffffff;">Телефон</label>
      <div class="col-sm-10">
        <input type="phone" class="form-control form-control-sm" name="phone" placeholder="Телефон">
      </div>
    </div>
    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm" style="color:#ffffff;">Адрес</label>
      <div class="col-sm-10">
        <input type="address" class="form-control form-control-sm" name="address" placeholder="Адрес">
      </div>
    </div>
    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm" style="color:#ffffff;">Доставка</label>
      <div class="col-sm-10">
        <select  class="form-control form-control-sm" name="delivery">
        
  <optgroup label="Доставка">
    <option>Доставка на дом</option>
  </optgroup>
  
  <optgroup label="Самовывоз">
  <?php
							while ($row = mysqli_fetch_array($result)):;
	  					?>
    <option value="<?php echo $row['address'];?>"><?php echo $row['address'];?> г. <?php echo $row['name'];?></option>
							<?php endwhile;?>
  </optgroup>
</select>
      </div>
    </div>
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"/>
    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>"/>
    <input type="hidden" name="sum" value="<?php echo $sum; ?>"/>
    <button formaction="order.php" class="btn btn-default" style="width:150px;">Далее</button>
  </form>
</div> 


 </body>
</html>
