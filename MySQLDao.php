<?php

class MySQLDao {
var $dbhost = null;
var $dbuser = null;
var $dbpass = null;
var $conn = null;
var $dbname = null;
var $result = null;

function __construct() {
    $this->dbhost = Conn::$dbhost;
    $this->dbuser = Conn::$dbuser;
    $this->dbpass = Conn::$dbpass;
    $this->dbname = Conn::$dbname;
}

public function openConnection() {
    $this->conn = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
    if (mysqli_connect_errno())
        echo new Exception("Could not establish connection with database");
       
}

public function getConnection() {
    return $this->conn;
}

public function closeConnection() {
    if ($this->conn != null)
        $this->conn->close();
}




function filldiv($season, $manifacturer, $width, $height, $diameter) {
    $loopResult = '';
    $sql = "select product.product_id, product.title, product.cost, photo.url, width.w_name, height.h_name, diameter.d_name
from( tire
     INNER JOIN product on tire.product_id = product.product_id
     INNER JOIN photo on photo.photo_id = product.photo_id
     INNER JOIN width on product.width_id = width.width_id
     INNER JOIN height on height.height_id = tire.height_id
     INNER JOIN diameter on diameter.diameter_id = product.diameter_id
     ) Where product.diameter_id = $diameter and product.width_id = $width and tire.season_id = $season and tire.height_id = $height and product.manifacturer_id = $manifacturer
     ";
    $result = $this->conn->query($sql);
    while($row = ($result->fetch_array(MYSQLI_ASSOC))) { 
        $loopResult .= ' 
        <div class="w-100">
	
		<div class="row" style="border:none; height:230px; ">
		<form action="afterProduct.php" method:post>
		<div class="col-xs-6 col-xs-4" style="margin-left:15px; ">
		
			<h3 style="color:#ffffff;">'.$row['title'].'</h3>
			<p style="font-size:13px; color:#ffffff;">Размер: '.$row['w_name'].'/'.$row['h_name'].'/'.$row['d_name'].'</p>
			<h4 style="color:#ffffff;">'.$row['cost'].' руб</h4>
			<div class="col-xs-6 col-xs-4">
						<input type="hidden" name="product_id" value="'.$row['product_id'].'"/>
				    	<button class="btn btn-default" style="width:150px; margin-left:-15px;">Купить</button>
			    		
			</div>
		
</form>	
		</div>
		
		<div class="col-xs-6 col-xs-4" style="width:300px" >  
		<img src="photos/'.$row['url'].'" class="img-rounded" style="height:200px; position: relative;">
		
		</div> 
		
		</div>
	
	</div>
		
        '; 
    } 
    echo $loopResult;
}



function filldiv1($product_id,$quantity) {
	
    $loopResult = '';
    $sql = "
    select product.product_id, product.title, product.cost, photo.url, width.w_name, height.h_name, diameter.d_name
from( tire
     INNER JOIN product on tire.product_id = product.product_id
     INNER JOIN photo on photo.photo_id = product.photo_id
     INNER JOIN width on product.width_id = width.width_id
     INNER JOIN height on height.height_id = tire.height_id
     INNER JOIN diameter on diameter.diameter_id = product.diameter_id AND product.product_id = $product_id)
    
     ";
     
    $result = $this->conn->query($sql);
    while($row = ($result->fetch_array(MYSQLI_ASSOC))) { 
    $sum=$row['cost'];
   if(empty($quantity))
   {$quantity=4;}
    $sum = $sum*$quantity;
        $loopResult .= ' 
        <tbody>
    <tr style="color:#ffffff;">
      <th scope="row" style="color:#ffffff;"><img src="photos/'.$row['url'].'" class="img-rounded" style="height:200px; position: relative;"></th>
      <td style="color:#ffffff;">'.$row['title'].'</td>
      <td style="color:#ffffff;">'.$row['w_name'].'/'.$row['h_name'].'/'.$row['d_name'].'</td>
      <td style="color:#ffffff;">'.$row['cost'].' руб</td>
      <td style="color:#ffffff;">
        <input type="hidden" name="product_id" value="'.$row['product_id'].'"/>
        <input type="hidden" name="sum" value="'.$sum.'"/>
        
    <input class="form-control" style="width:100px;" name="quantity" type="number" value="'.$quantity.'">
  </div>               
      	
                         
      </td>
      <td style="color:#ffffff;">'.($sum).' руб</td>
    </tr>
      </tbody>
		
        '; 
    }
    echo $loopResult;
}

function basketOrder($product_id, $quantity ,$sum, $first_name, $last_name, $delivery, $email, $phone, $address) {
    $sql_insert = "insert into user set email = '$email', phone = '$phone', first_name = '$first_name', last_name = '$last_name', address = '$address'";
    $statement = $this->conn->query($sql_insert);
    
    $sql_select_user = "select user.user_id from user where email = '$email' and phone = '$phone' and first_name = '$first_name' and last_name = '$last_name' and address = '$address' limit 1";
    $result = $this->conn->query($sql_select_user);
    $row = ($result->fetch_array(MYSQLI_ASSOC));
    $id_of_user = $row['user_id'];
    
    $sql_insert_basket = "insert into basket set user_id = '$id_of_user', date = now()";
    $statement2 = $this->conn->query($sql_insert_basket);
    
    $sql_select_basket = "select basket.basket_id from basket where user_id = '$id_of_user' limit 1";
    $result2 = $this->conn->query($sql_select_basket);
    $row2 = ($result2->fetch_array(MYSQLI_ASSOC));
    $id_of_basket = $row2['basket_id'];
    
    $sql_insert_basket_product = "insert into basket_product set basket_id = '$id_of_basket', product_id = '$product_id', quantity='$quantity'";
    $statement3 = $this->conn->query($sql_insert_basket_product);
    
    $sql_select_shop = "select shops.shop_id from shops where address = '$delivery' limit 1";
    $result3 = $this->conn->query($sql_select_shop);
    $row3 = ($result3->fetch_array(MYSQLI_ASSOC));
    $id_of_shop = $row3['shop_id'];
    
    if($delivery == 'Доставка на дом')
    {
	    $delivery = '1';
	    $sql_insert_oder_delivery1 = "insert into _order set basket_id = '$id_of_basket', delivary_id = '$delivery', shop_id = '1', date = now(), sum = '$sum'";
    $statement4 = $this->conn->query($sql_insert_oder_delivery1);
    }else
    {
	    $sql_insert_oder_delivery2 = "insert into _order set basket_id = '$id_of_basket', delivary_id = '2', shop_id = '$id_of_shop', date = now(), sum = '$sum'";
    $statement5 = $this->conn->query($sql_insert_oder_delivery2);
    }
    
    
}
/*
function deliveryOrder($product_id, $quantity ,$sum, $first_name, $last_name, $delivery, $email, $phone, $address) {
    

}
*/

/*
QUERY

SELECT product.cost, user.email,user.phone,user.address,user.first_name, product.title,basket_product.quantity, _order.sum
FROM( product
     INNER JOIN basket_product ON basket_product.product_id = product.product_id
     INNER JOIN basket ON basket.basket_id = basket_product.basket_id
     INNER JOIN user ON user.user_id = basket.user_id
     INNER JOIN _order ON _order.basket_id = basket.basket_id
)




SELECT shops_product.quantity, product.title, shops.address, city.name
FROM(product
    INNER JOIN shops_product ON shops_product.product_id = product.product_id
    INNER JOIN shops ON shops_product.shop_id = shops.shop_id
    INNER JOIN city ON city.city_id = shops.city_id
    )ORDER BY quantity DESC
    
    
    
    
SELECT user.first_name,user.phone,user.address,delivery.name
FROM(_order 
     INNER JOIN basket ON basket.basket_id = _order.basket_id
     INNER JOIN user ON user.user_id = basket.user_id
     INNER JOIN delivery ON delivery.delivary_id = _order.delivary_id
)




SELECT basket.date, user.user_id,user.first_name,user.email
FROM (basket
      INNER JOIN user ON user.user_id = basket.user_id
)ORDER BY date DESC



SELECT shops.address, city.name, delivery.name, user.first_name,user.phone
FROM(_order 
    INNER JOIN basket ON basket.basket_id = _order.basket_id
    INNER JOIN shops ON shops.shop_id = _order.shop_id
    INNER JOIN user ON basket.user_id = user.user_id
    INNER JOIN delivery ON _order.delivary_id = delivery.delivary_id
    INNER JOIN city ON city.city_id = shops.city_id)
    




SELECT photo.url, product.title, product.cost
FROM( product
     INNER JOIN photo ON product.photo_id = photo.photo_id
)



SELECT product.title, _order.order_id, _order.date
FROM( product
     INNER JOIN basket_product ON product.product_id = basket_product.product_id
     INNER JOIN basket ON basket.basket_id = basket_product.basket_id
     INNER JOIN _order ON _order.basket_id = basket.basket_id
)ORDER BY date DESC



SELECT COUNT(*)
FROM (disk
	INNER JOIN product ON disk.product_id = product.product_id)
	
	
	
SELECT COUNT(*)
FROM (tire
	INNER JOIN product ON tire.product_id = product.product_id)
	
	
SELECT product.title, COUNT(product.product_id)
FROM( product
     INNER JOIN basket_product ON product.product_id = basket_product.product_id
     INNER JOIN basket ON basket.basket_id = basket_product.basket_id
     INNER JOIN _order ON _order.basket_id = basket.basket_id
)GROUP BY product.product_id



select product.product_id, product.title, product.cost, photo.url, width.w_name,diameter.d_name, pcd_lenght.name as len_name, pcd_quentity.name as quen_name, central_holl.name as centr_name
from( disk
     INNER JOIN product on disk.product_id = product.product_id
     INNER JOIN photo on photo.photo_id = product.photo_id
     INNER JOIN width on product.width_id = width.width_id
     INNER JOIN diameter on diameter.diameter_id = product.diameter_id
     INNER JOIN pcd_lenght ON pcd_lenght.pcd_length_id = disk.pcd_length_id
     INNER JOIN pcd_quentity ON pcd_quentity.pcd_quentity_id = disk.pcd_quentity_id
     INNER JOIN central_holl ON central_holl.central_holl_id = disk.central_holl_id)
     
     
     
SELECT MAX(product.cost),product.title, photo.url
FROM (product
      INNER JOIN photo ON product.photo_id = photo.photo_id
)



SELECT MIN(product.cost),product.title, photo.url
FROM (product
      INNER JOIN photo ON product.photo_id = photo.photo_id
)




SELECT COUNT(_order.delivary_id), delivery.name
FROM (_order
     INNER JOIN delivery ON delivery.delivary_id = _order.delivary_id) GROUP BY delivery.name
*/
/*
function filldiv() {
    $loopResult = '';
   
    $sql = "select product.id, product.title, product.cost, photos.url, width_tire.w_name, height_tire.h_name, diameter_tire.d_name
from( product
     INNER JOIN photos on photos.id = product.avatar
     INNER JOIN width_tire on product.width = width_tire.id
     INNER JOIN height_tire on height_tire.id = product.height
     INNER JOIN diameter_tire on diameter_tire.id = product.diameter
    )";
    $result = $this->conn->query($sql);
    while($row = ($result->fetch_array(MYSQLI_ASSOC))) { 
        $loopResult .= ' 
        <div class="w-100">
	
		<div class="row" style="border:none; height:230px; background:gray;">
		<form action="afterProduct.php" method:post>
		<div class="col-xs-6 col-xs-4" style="margin-left:15px;">
		
			<h3>'.$row['title'].'</h3>
			<p style="font-size:13px; color:#03225C;">Размер: '.$row['w_name'].'/'.$row['h_name'].'/'.$row['d_name'].'</p>
			<h4>'.$row['cost'].' руб</h4>
			<div class="col-xs-6 col-xs-4">
						<input type="hidden" name="product_id" value="'.$row['id'].'"/>
				    	<button class="btn btn-default" style="width:150px; margin-left:-15px;">Добавить в корзину</button>
			    		
			</div>
		
</form>	
		</div>
		
		<div class="col-xs-6 col-xs-4" style="width:300px" >  
		<img src="photos/'.$row['url'].'" style="height:200px; position: relative;">
		
		</div> 
		
		</div>
	
	</div>
		
        '; 
    } 
    echo $loopResult;
}
*/


}
?>


