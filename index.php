<?php
 
require("Conn.php");
require("MySQLDao.php");

$dao = new MySQLDao();
$dao->openConnection();

$result = mysqli_query($dao->conn, 'SELECT * from width');
$result1 = mysqli_query($dao->conn,'SELECT * from height');
$result2 = mysqli_query($dao->conn,'SELECT * FROM `diameter`');
$result3 = mysqli_query($dao->conn,'select * from season');
$result4 = mysqli_query($dao->conn,'SELECT * FROM `manifacturer`');


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
    
<style>
   body {
    background-image: url(background.jpg); /* Путь к фоновому изображению */
		background-position: center top;
   }
  </style>
  
  
   

    <div class="container">
    	<div class="row">
	    	<div class="col-sm-6">
		    	<div class="searchTire">
		    	  <form method="get" action="main.php">
		    		<div class="header-select-tire" align="center">Подбор шин</div>
		    		<div class="position-top-parameters">	
		    		<div class="col-xs-16">
		    		
		    			<div class="col-xs-6" align="center">
		    			
				    		<select id="select-bus-season" name="season" class="select1">
					    		<?php
							while ($row3 = mysqli_fetch_array($result3)):;
	  					?>
							<option value="<?php echo $row3[0];?>"><?php echo $row3[1];?></option>
							<?php endwhile;?>
					    	</select>
					    	
		    			
					    </div>
			    	
					    <div class="col-xs-6" align="center">
				    		<select id="select-bus-manufacturers" name="manufacturer" class="select1">
					    		<?php
							while ($row4 = mysqli_fetch_array($result4)):;
	  					?>
							<option value="<?php echo $row4[0];?>"><?php echo $row4[1];?></option>
							<?php endwhile;?>
					    	</select>
					    </div>
					    
		    		</div>
		    		</div>
		 <div class="table-parameters" align="center">
		   <table class="table-selection" style="font-size:15px;">
		  	 <thead><tr>
			  	 <th>Ширина</th>
			  	 <th>Высота</th>
			  	 <th>Диаметр</th>
			</tr></thead>
				<tbody><tr>
					<td>
						<select class="select" name="width">
						<?php
							while ($row = mysqli_fetch_array($result)):;
	  					?>
							<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
							<?php endwhile;?>
						</select>
					</td>
					<td>
						<select id="select-height" name="height" class="select">
							<?php
							while ($row1 = mysqli_fetch_array($result1)):;
	  					?>
							<option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>
							<?php endwhile;?>
						</select>
					</td>
					<td>
						<select id="select-diameter" name="diameter" class="select">
							<?php 
							while ($row2 = mysqli_fetch_array($result2)):;
	  					?>
							<option value="<?php echo $row2[0];?>"><?php echo $row2[1];?></option>
							<?php endwhile;?>
						</select>
						
					</td>
				</tr>
				</tbody>
		   </table>
		 </div>
		 
		 
				 <div class="buttonFindLeft"align="center">
				    	<button class="btn btn-default" style="width:150px;">Подобрать</button>
				</div>
		   
		    	  </form>
		    	</div>
		    	
	    	</div>
	    	
	    	
	    	<div class="col-sm-6">
		    	<div class="searchTire">
		    	<div class="header-select-tire" align="center">Подбор дисков</div>	
		    		<div class="mark-position">
		    		<span class="Mark" style="font-size:16px;">Марка</span>
		    		</div>
		    		<div class="select-mark" align="right">
		    		<select id="select-mark-right" name="mark" class="select1" style="width:55%;">
		    			<option value="all-marks" selected>Выберите из списка</option>
		    			<option value="michaline">Michaline</option>
		    		</select> 
		    		</div>
		    		<div class="mark-position">
		    		<span class="Mark" style="font-size:16px;">Модель</span>
		    		</div>
		    		<div class="select-model" align="right">	
		    		<select id="select-mark-right" name="mark" class="select1" style="width:55%;">
		    			<option value="all-marks" selected>Выберите из списка</option>
		    			<option value="michaline">Michaline</option>
		    		</select> 
		    		</div>
		    		<div class="mark-position">
		    		<span class="Mark" style="font-size:16px;">Модификация</span>
		    		</div>
		    		<div class="select-modification" align="right">	
		    		<select id="select-mark-right" name="mark" class="select1" style="width:55%;">
		    			<option value="all-marks" selected>Выберите из списка</option>
		    			<option value="michaline">Michaline</option>
		    		</select> 	
		    		</div>  
		    		<div class="buttonFindLeft"align="center">
				    	<button type="button" class="btn btn-default" style="width:150px;">Подобрать</button>
				</div>  
				    
		    	</div>
	    	</div>



    	</div>
    </div>    
  </body>
</html>
