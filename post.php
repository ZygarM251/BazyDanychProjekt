<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moto-oto ITAS</title>
    <link rel="stylesheet" href="style7.css">
</head>
<body>
<div id="header">
		<div id="menu">
			<div id="menu-left">
			Moto-Oto
			    </div>
			    <div id="menu-right">
				<ul>
					<li><a href="index.php">Strona Główna</a></li>
					<li><a href="sell.php">Sprzedaj</a></li>
					<li><a href="rej.php">Rejestracja</a></li>
					<li><a href="login.php">Zaloguj</a></li>
					<li><a href="post.php">Ogłoszenia</a></li>
				</ul>
			</div>
		</div>
			<div id="menu-banner">
				<div id="message">
				<span>BMW e30 M3<br /></span>
				BMW e30 już od 30 tys zł
				</div>
            <a href="index.php">
			<div class="button">
			STRONA GŁÓWNA
            </div>
            </a>
		</div>
</div>
<?php
require('connect.php');
$query="select  car_id,car_name , car_model , car_year , car_run , car_engine , car_gear  , 
car_horsepower  , car_color  , car_img , car_date,car_price  FROM cars order by car_year ;";
$result=@mysqli_query($connection,$query);
if($result){
		while($row = mysqli_fetch_assoc($result)){
	echo"<div id = 'show'>
				<img src='{$row['car_img']}' width='250px' height='auto' />
			<div id = 'wyswietl'><div>
			<h1>
			{$row['car_name']}
			{$row['car_model']} 
			{$row['car_horsepower']}HP
			</h1>
			{$row['car_year']}.r
			{$row['car_run']} km
			{$row['car_engine']}cm³
			{$row['car_gear']} 
			{$row['car_color']}  
			{$row['car_date']}</div>
			<form action='edit.php?id={$row['car_id']}' method='post'>
			<input type='hidden' name='car_id' value='{$row['car_id']}'>
			<input type='submit' name='' value='Edytuj'>
			</form>
			<div style = 'color:red'><h2>Cena: {$row['car_price']} zł</h2></div>
			</div>
		</div>";
	}
	}
?>
<div id="footer">
Wszelkie prawa zastrzeżone - &copy; 2021
</div>
</body>
</html>