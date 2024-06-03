<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moto-oto Rejestracja</title>
    <link rel="stylesheet" href="style3.css">
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
					<form action="logout.php" method="post">
		<input type="submit" name="" value="Wyloguj">
		</form>
				</ul>
			</div>
		</div>
			<div id="menu-banner">
				<div id="message">
				<span>Volkswagen golf 8 GTI<br /></span>
				<p>Volkswagen golf 8 GTI 130 tys zł</p>
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
		Imie: <input type="text" name="user_name"><br>
        Login: <input type="text" name="user_login"><br>
		E-mail: <input type="text" name="user_email"><br>
		Nr. tel <input type="number" name="user_phone"><br>
        Hasło: <input type="password" name="user_pass"><br><br>
        <input type="submit" name="" value="Zarejestruj">
    </form>
	</div>
	<?php
    require('connect.php');
 if(isset($_POST['user_name']))
 {
     $t = $_POST['user_name'];
     $t = htmlentities($t);
    if(isset($_POST['user_login']))
    {
        $n = $_POST['user_login'];
        $n = htmlentities($n);
       if(isset($_POST['user_pass']))
       {
           $x = $_POST['user_pass'];
           $x = htmlentities($x);
		   $x = hash('sha256', $x);
		   if(isset($_POST['user_email']))
		   {
			   $j = $_POST['user_email'];
			   $j = htmlentities($j);
           	 	if(isset($_POST['user_phone']))
              	{
                	$z = $_POST['user_phone'];
                	$z = htmlentities($z);
                $q = "insert into users values('','{$t}','{$n}','{$j}','{$z}','{$x}')";
                $r = mysqli_query($connection, $q); 
            	}
            }
        }
    }
}      
?>
<div id="formularz">
<a href="login.php">Przejdź do logowania</a>
</div>
<div id="footer">
Wszelkie prawa zastrzeżone - &copy; 2022
</div>
</body>
</html>