<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moto-oto Ogłoszenia</title>
    <link rel="stylesheet" href="style6.css">
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
				</ul>
			</div>
		</div>
			<div id="menu-banner">
				<div id="message">
				<span>BMW e38<br /></span>
				<p>BMW e38 już od 30 tys zł</p>
				</div>
                <a href="post.php">
			<div class="button">
			OGŁOSZENIA
            </div>
            </a>
			</div>
</div>
<div id="formularz">
<form action="" method="post">
		Marka: <input type="text" name="car_name"><br>
        Model: <input type="text" name="car_model"><br>
		Rocznik: <input type="number" name="car_year"><br>
		Przebieg <input type="number" name="car_run"><br>
        Pojemność(cm³): <input type="number" name="car_engine"><br>
		Skrzynia Biegów: <input type="text" name="car_gear"><br>
		Moc: <input type="number" name="car_horsepower"><br>
		Kolor: <input type="text" name="car_color"><br>
		Zdjęcie: <input type="text" name="car_img"><br>
		Cena: <input type="number" name="car_price"><br>
        <input type="submit" name="" value="Dodaj">
</form>
</div>
<?php
session_start();

if(isset($_SESSION['user_log'])){

	$login=$_SESSION['user_log'];

    require('connect.php');
 if(isset($_POST['car_name']))
 {
     $a = $_POST['car_name'];
     $a = htmlentities($a);
    
    if(isset($_POST['car_model']))
    {
     $b = $_POST['car_model'];
     $b = htmlentities($b);
        
       if(isset($_POST['car_year']))
       {
         $c = $_POST['car_year'];
         $c = htmlentities($c);
           
		   if(isset($_POST['car_run']))
		   {
			 $d = $_POST['car_run'];
			 $d = htmlentities($d);

			   if(isset($_POST['car_engine']))
				{
			   	 $e = $_POST['car_engine'];
			   	 $e = htmlentities($e);

					if(isset($_POST['car_gear']))
					{
					 $f = $_POST['car_gear'];
					 $f = htmlentities($f);

						if(isset($_POST['car_horsepower']))
						{
						 $g = $_POST['car_horsepower'];
						 $g = htmlentities($g);

						 	if(isset($_POST['car_color']))
						 	{
						  	 $h = $_POST['car_color'];
						  	 $h = htmlentities($h);

							   	if(isset($_POST['car_price']))
							   	{
								 $i = $_POST['car_price'];
								 $i = htmlentities($i);

           	 						if(isset($_POST['car_img']))
              						{
                			 	 	  $j = $_POST['car_img'];
                			 		  $j = htmlentities($j);

									   	$q = "insert into cars values('','{$a}','{$b}','{$c}','{$d}','{$e}','{$f}','{$g}','{$h}','{$j}',NOW(),'{$i}','{$_SESSION['user_id']}' );"; 
									   	$r = mysqli_query($connection,$q); 
										if($r)
										{
											header("location:index.php?status=ok");
									  	}
										else
										{
											header("location:index.php?status=error");  
										}
									}
								}	 
							}		
						}
					}
            	}
            }
        }
    }
}
}
else
{
	header("location:mustlog.php");
}  
?>
<div id="footer">
Wszelkie prawa zastrzeżone - &copy; 2022
</div>
</body>
</html>