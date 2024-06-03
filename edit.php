<!DOCTYPE html>
<html lang="pl">
	<head>
	<title>Moto-oto Projekt</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style4.css">
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
				<span>Toyota Supra mk4<br /></span>
				<p>Toyota Supra już od 150 tys zł</p>
				</div>
                <a href="post.php">
			<div class="button">
			OGŁOSZENIA
            </div>
            </a>
			</div>
</div>
<div id="formularz"> 
    <form method="post" action="">
        <h1>Edytuj Ogłoszenie</h1>
        Marka:<input type="text" name="name" value=""><br>
        Model:<input type="text" name="model" value=""><br>
        Rocznik:<input type="number" name="year" value=""><br>
        Przebieg:<input type="number" name="run" value=""><br>
        Moc:<input type="number" name="horsepower" value=""><br>
        Kolor:<input type="text" name="color" value=""><br>
        Cena:<input type="number" name="price" value=""><br>
        Właściciele:<input type="number" name="us" value=""><br>
        <input type="hidden" name="hide_id" value="">
        <input type="submit" name="btn"  value="Aktualizuj">
    </form>
</div>
<?php     
require('connect.php');
if( isset($_POST['name']))
{
$id=$_GET['id'];
$id=htmlentities($id);

$name=$_POST['name'];
$name=htmlentities($name);

$model=$_POST['model'];
$model=htmlentities($model);

$year=$_POST['year'];
$year=htmlentities($year);

$run=$_POST['run'];
$run=htmlentities($run);

$horsepower=$_POST['horsepower'];
$horsepower=htmlentities($horsepower);

$color=$_POST['color'];
$color=htmlentities($color);

$price=$_POST['price'];
$price=htmlentities($price);

$us=$_POST['us'];
$us=htmlentities($us);

$query="Update cars set car_name='$name',car_model='$model',car_year='$year' ,car_run='$run', car_horsepower='$horsepower',car_color='$color',car_price='$price',car_us='$us' where car_id='$id';";
$result=mysqli_query($connection,$query);
if($result)
{
    header("location:post.php?status=ok");   
}}
?>
<div id="footer">
Wszelkie prawa zastrzeżone - &copy; 2022
</div>
</html>