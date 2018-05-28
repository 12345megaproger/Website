<?php
 
require("Conn.php");
require("MySQLDao.php");

$dao = new MySQLDao();
$dao->openConnection();

$product_id = htmlentities($_GET["product_id"]);
$quantity = htmlentities($_GET["quantity"]);
$sum = htmlentities($_GET["sum"]);

$result_2 = mysqli_query($dao->conn, 'SELECT photo.url, width.w_name, product.product_id, product.title, diameter.d_name, product.cost, height.h_name
From( tire
	INNER JOIN product on tire.product_id = product.product_id
	INNER JOIN width on width.width_id = product.width_id
	INNER JOIN diameter on diameter.diameter_id = product.diameter_id
	INNER JOIN photo on photo.photo_id = product.photo_id
  INNER JOIN height on height.height_id = tire.height_id)');

$result_2_='SELECT photo.url, width.w_name, product.product_id, product.title, diameter.d_name, product.cost, height.h_name
From( tire
	INNER JOIN product on tire.product_id = product.product_id
	INNER JOIN width on width.width_id = product.width_id
	INNER JOIN diameter on diameter.diameter_id = product.diameter_id
	INNER JOIN photo on photo.photo_id = product.photo_id
  INNER JOIN height on height.height_id = tire.height_id)';

$result_1 = mysqli_query($dao->conn, 'SELECT city.name, shops.address
FROM( shops 
  INNER JOIN city on city.city_id = shops.city_id)
');

$result_1_='SELECT city.name, shops.address
FROM( shops 
  INNER JOIN city on city.city_id = shops.city_id)';

$result0 = mysqli_query($dao->conn, 'SELECT photo.url, width.w_name, product.product_id, product.title, diameter.d_name, product.cost, pcd_lenght.name as name_1, pcd_quentity.name as name_2
From( disk
  INNER JOIN product on disk.product_id = product.product_id
  INNER JOIN width on width.width_id = product.width_id
  INNER JOIN diameter on diameter.diameter_id = product.diameter_id
  INNER JOIN photo on photo.photo_id = product.photo_id
  INNER JOIN pcd_lenght on pcd_lenght.pcd_length_id = disk.pcd_length_id
INNER JOIN pcd_quentity on disk.pcd_quentity_id = pcd_quentity.pcd_quentity_id)');
  
  $result0_='SELECT photo.url, width.w_name, product.product_id, product.title, diameter.d_name, product.cost, pcd_lenght.name as name_1, pcd_quentity.name as name_2
  From( disk
    INNER JOIN product on disk.product_id = product.product_id
    INNER JOIN width on width.width_id = product.width_id
    INNER JOIN diameter on diameter.diameter_id = product.diameter_id
    INNER JOIN photo on photo.photo_id = product.photo_id
    INNER JOIN pcd_lenght on pcd_lenght.pcd_length_id = disk.pcd_length_id
  INNER JOIN pcd_quentity on disk.pcd_quentity_id = pcd_quentity.pcd_quentity_id)';

$result = mysqli_query($dao->conn, 'SELECT product.cost, user.email,user.phone,user.address,user.first_name, product.title,basket_product.quantity, _order.sum
FROM( product
     INNER JOIN basket_product ON basket_product.product_id = product.product_id
     INNER JOIN basket ON basket.basket_id = basket_product.basket_id
     INNER JOIN user ON user.user_id = basket.user_id
     INNER JOIN _order ON _order.basket_id = basket.basket_id
)');

$result_='SELECT product.cost, user.email,user.phone,user.address,user.first_name, product.title,basket_product.quantity, _order.sum
FROM( product
     INNER JOIN basket_product ON basket_product.product_id = product.product_id
     INNER JOIN basket ON basket.basket_id = basket_product.basket_id
     INNER JOIN user ON user.user_id = basket.user_id
     INNER JOIN _order ON _order.basket_id = basket.basket_id
)';

$result2 = mysqli_query($dao->conn, 'SELECT shops_product.quantity, product.title, shops.address, city.name
FROM(product
    INNER JOIN shops_product ON shops_product.product_id = product.product_id
    INNER JOIN shops ON shops_product.shop_id = shops.shop_id
    INNER JOIN city ON city.city_id = shops.city_id
    )ORDER BY quantity DESC
');

$result2_='SELECT shops_product.quantity, product.title, shops.address, city.name
FROM(product
    INNER JOIN shops_product ON shops_product.product_id = product.product_id
    INNER JOIN shops ON shops_product.shop_id = shops.shop_id
    INNER JOIN city ON city.city_id = shops.city_id
    )ORDER BY quantity DESC';

$result3 = mysqli_query($dao->conn, 'SELECT user.first_name,user.phone,user.address,delivery.name
FROM(_order 
     INNER JOIN basket ON basket.basket_id = _order.basket_id
     INNER JOIN user ON user.user_id = basket.user_id
     INNER JOIN delivery ON delivery.delivary_id = _order.delivary_id
)
');

$result3_='SELECT user.first_name,user.phone,user.address,delivery.name
FROM(_order 
     INNER JOIN basket ON basket.basket_id = _order.basket_id
     INNER JOIN user ON user.user_id = basket.user_id
     INNER JOIN delivery ON delivery.delivary_id = _order.delivary_id
)';

$result4 = mysqli_query($dao->conn, 'SELECT basket.date, user.user_id,user.first_name,user.email
FROM (basket
      INNER JOIN user ON user.user_id = basket.user_id
)ORDER BY date DESC
');

$result4_='SELECT basket.date, user.user_id,user.first_name,user.email
FROM (basket
      INNER JOIN user ON user.user_id = basket.user_id
)ORDER BY date DESC';

$result5 = mysqli_query($dao->conn, 'SELECT shops.address, city.name as city_name, delivery.name as del_name, user.first_name,user.phone
FROM(_order 
    INNER JOIN basket ON basket.basket_id = _order.basket_id
    INNER JOIN shops ON shops.shop_id = _order.shop_id
    INNER JOIN user ON basket.user_id = user.user_id
    INNER JOIN delivery ON _order.delivary_id = delivery.delivary_id
    INNER JOIN city ON city.city_id = shops.city_id)');

$result5_='SELECT shops.address, city.name as city_name, delivery.name as del_name, user.first_name,user.phone
FROM(_order 
    INNER JOIN basket ON basket.basket_id = _order.basket_id
    INNER JOIN shops ON shops.shop_id = _order.shop_id
    INNER JOIN user ON basket.user_id = user.user_id
    INNER JOIN delivery ON _order.delivary_id = delivery.delivary_id
    INNER JOIN city ON city.city_id = shops.city_id)';

$result6 = mysqli_query($dao->conn, 'SELECT photo.url, product.title, product.cost
FROM( product
     INNER JOIN photo ON product.photo_id = photo.photo_id
)');

$result6_='SELECT photo.url, product.title, product.cost
FROM( product
     INNER JOIN photo ON product.photo_id = photo.photo_id';

$result7 = mysqli_query($dao->conn, 'SELECT product.title, _order.order_id, _order.date
FROM( product
     INNER JOIN basket_product ON product.product_id = basket_product.product_id
     INNER JOIN basket ON basket.basket_id = basket_product.basket_id
     INNER JOIN _order ON _order.basket_id = basket.basket_id
)ORDER BY date DESC');

$result7_='SELECT product.title, _order.order_id, _order.date
FROM( product
     INNER JOIN basket_product ON product.product_id = basket_product.product_id
     INNER JOIN basket ON basket.basket_id = basket_product.basket_id
     INNER JOIN _order ON _order.basket_id = basket.basket_id
)ORDER BY date DESC';

$result8 = mysqli_query($dao->conn, 'SELECT COUNT(*)
FROM (disk
  INNER JOIN product ON disk.product_id = product.product_id)');
  
  $result8_='SELECT COUNT(*)
  FROM (disk
    INNER JOIN product ON disk.product_id = product.product_id)';

	$result9 = mysqli_query($dao->conn, 'SELECT COUNT(*)
FROM (tire
  INNER JOIN product ON tire.product_id = product.product_id)');
  
  $result9_='SELECT COUNT(*)
  FROM (tire
    INNER JOIN product ON tire.product_id = product.product_id)';

$result10 = mysqli_query($dao->conn, 'SELECT product.title, COUNT(product.product_id)
FROM( product
     INNER JOIN basket_product ON product.product_id = basket_product.product_id
     INNER JOIN basket ON basket.basket_id = basket_product.basket_id
     INNER JOIN _order ON _order.basket_id = basket.basket_id
)GROUP BY product.product_id');

$result10_='SELECT product.title, COUNT(product.product_id)
FROM( product
     INNER JOIN basket_product ON product.product_id = basket_product.product_id
     INNER JOIN basket ON basket.basket_id = basket_product.basket_id
     INNER JOIN _order ON _order.basket_id = basket.basket_id
)GROUP BY product.product_id';

$result11 = mysqli_query($dao->conn, 'SELECT MIN(product.cost),product.title, photo.url
FROM (product
      INNER JOIN photo ON product.photo_id = photo.photo_id
)Group By product.cost');

$result11_='SELECT MIN(product.cost),product.title, photo.url
FROM (product
      INNER JOIN photo ON product.photo_id = photo.photo_id
)Group By product.cost';

$result12 = mysqli_query($dao->conn, 'SELECT COUNT(_order.delivary_id), delivery.name
FROM (_order
     INNER JOIN delivery ON delivery.delivary_id = _order.delivary_id) GROUP BY delivery.name');

$result12_='SELECT COUNT(_order.delivary_id), delivery.name
FROM (_order
     INNER JOIN delivery ON delivery.delivary_id = _order.delivary_id) GROUP BY delivery.name';     

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


    </style>
  </head>

  <body>

  <style>
   body {
    background-image: url(background.jpg); /* Путь к фоновому изображению */
    background-position:absolute;
    color:#aaaaa;
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
  <h2 style="color:#ffffff;">5.2.1.</h2>
  <p style="color:#ffffff;">Показывает данные о всех шинах в интернет магазине</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">Product_id</th>
        <th style="color:#ffffff;">Name</th>
        <th style="color:#ffffff;">Width</th>
        <th style="color:#ffffff;">Diameter</th>
        <th style="color:#ffffff;">Height name</th>
        <th style="color:#ffffff;">Url</th>
        <th style="color:#ffffff;">Cost</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row = mysqli_fetch_array($result_2)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><?php echo $row['product_id'];?></td>
        <td style="color:#ffffff;"><?php echo $row['title'];?></td>
        <td style="color:#ffffff;"><?php echo $row['w_name'];?></td>
        <td style="color:#ffffff;"><?php echo $row['d_name'];?></td>
        <td style="color:#ffffff;"><?php echo $row['h_name'];?></td>
        <td style="color:#ffffff;"><?php echo $row['url'];?></td>
        <td style="color:#ffffff;"><?php echo $row['cost'];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result_2_; ?>   </p>
</div>

<div class="container">
<h2 style="color:#ffffff;">5.2.2.</h2>
  <p style="color:#ffffff;">Демонстрирует все адреса магазинах в различных городах страны</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">Shop Address</th>
        <th style="color:#ffffff;">City</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row2 = mysqli_fetch_array($result_1)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><?php echo $row2['name'];?></td>
        <td style="color:#ffffff;"><?php echo $row2['address'];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result_1_; ?>   </p>
</div>


<div class="container">
  <h2 style="color:#ffffff;">5.2.3.</h2>
  <p style="color:#ffffff;">Показывает данные о всех шинах в интернет магазине</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">Product_id</th>
        <th style="color:#ffffff;">Name</th>
        <th style="color:#ffffff;">Width</th>
        <th style="color:#ffffff;">Diameter</th>
        <th style="color:#ffffff;">PCD Lenght</th>
        <th style="color:#ffffff;">PCD Quantity</th>
        <th style="color:#ffffff;">Url</th>
        <th style="color:#ffffff;">Cost</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row = mysqli_fetch_array($result0)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><?php echo $row['product_id'];?></td>
        <td style="color:#ffffff;"><?php echo $row['title'];?></td>
        <td style="color:#ffffff;"><?php echo $row['w_name'];?></td>
        <td style="color:#ffffff;"><?php echo $row['d_name'];?></td>
        <td style="color:#ffffff;"><?php echo $row['name_1'];?></td>
        <td style="color:#ffffff;"><?php echo $row['name_2'];?></td>
        <td style="color:#ffffff;"><?php echo $row['url'];?></td>
        <td style="color:#ffffff;"><?php echo $row['cost'];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result0_; ?>   </p>
</div>

<div class="container">
  <h2 style="color:#ffffff;">5.2.4.</h2>
  <p style="color:#ffffff;">Демонстрация клиенских данных и инормации о его покупках</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">Firstname</th>
        <th style="color:#ffffff;">Addres</th>
        <th style="color:#ffffff;">Phone</th>
        <th style="color:#ffffff;">Email</th>
        <th style="color:#ffffff;">Product name</th>
        <th style="color:#ffffff;">Cost</th>
        <th style="color:#ffffff;">Quentity</th>
        <th style="color:#ffffff;">Sum</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row = mysqli_fetch_array($result)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><?php echo $row['first_name'];?></td>
        <td style="color:#ffffff;"><?php echo $row['address'];?></td>
        <td style="color:#ffffff;"><?php echo $row['phone'];?></td>
        <td style="color:#ffffff;"><?php echo $row['email'];?></td>
        <td style="color:#ffffff;"><?php echo $row['title'];?></td>
        <td style="color:#ffffff;"><?php echo $row['cost'];?></td>
        <td style="color:#ffffff;"><?php echo $row['quantity'];?></td>
        <td style="color:#ffffff;"><?php echo $row['sum'];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result_; ?>   </p>
</div>


<div class="container">
<h2 style="color:#ffffff;">5.2.5.</h2>
  <p style="color:#ffffff;">Наличие товаров во всех точках (Филиалах)</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">Product name</th>
        <th style="color:#ffffff;">Quantity</th>
        <th style="color:#ffffff;">City</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row2 = mysqli_fetch_array($result2)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><?php echo $row2['title'];?></td>
        <td style="color:#ffffff;"><?php echo $row2['quantity'];?></td>
        <td style="color:#ffffff;"><?php echo $row2['name'];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result2_; ?>   </p>
</div>


<div class="container">
<h2 style="color:#ffffff;">5.2.6.</h2>
  <p style="color:#ffffff;">Демострация того, какой тип доставки выбрал клиент, либо адрес, на который надо осуществить доставку</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">First Name</th>
        <th style="color:#ffffff;">Phone</th>
        <th style="color:#ffffff;">Address</th>
        <th style="color:#ffffff;">Delivery Name</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row3 = mysqli_fetch_array($result3)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><?php echo $row3['first_name'];?></td>
        <td style="color:#ffffff;"><?php echo $row3['phone'];?></td>
        <td style="color:#ffffff;"><?php echo $row3['address'];?></td>
        <td style="color:#ffffff;"><?php echo $row3['name'];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result3_; ?>   </p>
</div>


<div class="container">
<h2 style="color:#ffffff;">5.2.7.</h2>
  <p style="color:#ffffff;">Деманстрация покупателя, его данных и время приобретения товара через веб-сайт</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">id</th>
        <th style="color:#ffffff;">First Name</th>
        <th style="color:#ffffff;">Email</th>
        <th style="color:#ffffff;">Datetime of order</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row4 = mysqli_fetch_array($result4)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><?php echo $row4['user_id'];?></td>
        <td style="color:#ffffff;"><?php echo $row4['first_name'];?></td>
        <td style="color:#ffffff;"><?php echo $row4['email'];?></td>
        <td style="color:#ffffff;"><?php echo $row4['date'];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result4_; ?>   </p>
</div>


<div class="container">
<h2 style="color:#ffffff;">5.2.8.</h2>
  <p style="color:#ffffff;">Выводит номер телефона, имя и адрес доставки покупателя, для осуществления связи оператором</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">First Name</th>
        <th style="color:#ffffff;">Phone</th>
        <th style="color:#ffffff;">Address of shop</th>
        <th style="color:#ffffff;">Delivery</th>
        <th style="color:#ffffff;">City</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row5 = mysqli_fetch_array($result5)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><?php echo $row5['first_name'];?></td>
        <td style="color:#ffffff;"><?php echo $row5['phone'];?></td>
        <td style="color:#ffffff;"><?php echo $row5['address'];?></td>
        <td style="color:#ffffff;"><?php echo $row5['del_name'];?></td>
        <td style="color:#ffffff;"><?php echo $row5['city_name'];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result5_; ?>   </p>
</div>


<div class="container">
<h2 style="color:#ffffff;">5.2.9.</h2>
  <p style="color:#ffffff;">Демонстрация всей продукции с ее ценами</p>  
  <p style="color:#ffffff;">   <?php echo $result6_; ?>   </p>          
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">Photo</th>
        <th style="color:#ffffff;">Product Name</th>
        <th style="color:#ffffff;">Cost</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row6 = mysqli_fetch_array($result6)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><img src="photos/<?php echo $row6['url'];?>" class="img-rounded" style="height:200px; position: relative;"></td>
        <td style="color:#ffffff;"><?php echo $row6['title'];?></td>
        <td style="color:#ffffff;"><?php echo $row6['cost'];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   
</div>


<div class="container">
<h2 style="color:#ffffff;">5.2.10.</h2>
  <p style="color:#ffffff;">Предоставление данных о самых последних приобретениях на веб-сайте</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">Order ID</th>
        <th style="color:#ffffff;">Product Name</th>
        <th style="color:#ffffff;">Datetime</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row7 = mysqli_fetch_array($result7)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><?php echo $row7['order_id'];?></td>
        <td style="color:#ffffff;"><?php echo $row7['title'];?></td>
        <td style="color:#ffffff;"><?php echo $row7['date'];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result7_; ?>   </p>
</div>


<div class="container">
<h2 style="color:#ffffff;">5.2.11./5.2.12.</h2>
  <p style="color:#ffffff;">Демонстрация преобладающего количества шин или дисков (сколько продукции того или иного)</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">Quantity of Disks</th>
        <th style="color:#ffffff;">Quantity of Tires</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row8 = mysqli_fetch_array($result8)):;
	  	?>

      <tr>
        <td style="color:#ffffff;"><?php echo $row8[0];?></td>
        <?php endwhile;?>
        <?php
while ($row9 = mysqli_fetch_array($result9)):;
	  	?>
	  	<td style="color:#ffffff;"><?php echo $row9[0];?></td>
	  	<?php endwhile;?>
      </tr>
    </tbody>
  </table>   <p style="color:#ffffff;"> <?php echo $result8_; ?> </p><p style="color:#ffffff;">  <?php echo $result9_; ?>   </p>
</div>



<div class="container">
<h2 style="color:#ffffff;">5.2.13.</h2>
  <p style="color:#ffffff;">Деманстрация хитов продаж</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">Product Quantity</th>
        <th style="color:#ffffff;">Product Name</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row10 = mysqli_fetch_array($result10)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><?php echo $row10[1];?></td>
        <td style="color:#ffffff;"><?php echo $row10['title'];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result10_; ?>   </p>
</div>




<div class="container">
<h2 style="color:#ffffff;">5.2.14.</h2>
  <p style="color:#ffffff;">Сортировка от самых дешевых товаров до элитных</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">From Cheapest to Expensive</th>

      </tr>
    </thead>
    <tbody>
    <?php
while ($row11 = mysqli_fetch_array($result11)):;
	  	?>

      <tr>
        <td style="color:#ffffff;"><?php echo $row11[0];?>/<?php echo $row11[1];?></td>
        
        <?php endwhile;?>
       
      </tr>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result11_; ?>   </p>
</div>

<div class="container">
<h2 style="color:#ffffff;">5.2.15.</h2>
  <p style="color:#ffffff;">Демострация наиболее распространенного осуществления доставки</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th style="color:#ffffff;">Count of deliveries</th>
        <th style="color:#ffffff;">Delivery Name</th>
      </tr>
    </thead>
    <tbody>
    <?php
while ($row12 = mysqli_fetch_array($result12)):;
	  	?>
      <tr>
        <td style="color:#ffffff;"><?php echo $row12[0];?></td>
        <td style="color:#ffffff;"><?php echo $row12[1];?></td>
      </tr>
      <?php endwhile;?>
    </tbody>
  </table>   <p style="color:#ffffff;">   <?php echo $result12_; ?>   </p>
</div>

	  		


 </body>
</html>
