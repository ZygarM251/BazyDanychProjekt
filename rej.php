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
		Nazwisko: <input type="text" name="user_surname"><br>
		Imie: <input type="text" name="user_name"><br>
		Hasło: <input type="password" name="user_pass"><br>
		E-mail: <input type="text" name="user_email"><br>
		Data Urodzenia: <input type="date" name="user_birth_day">
		Klauzula Rodo: <input type="radio" name="user_rodo"><br>
        <input type="submit" name="" value="Zarejestruj">
    </form>
	</div>
	<?php
    require('connect.php');
 if(isset($_POST['user_surname']))
 {
     $surname = $_POST['user_surname'];
     $surname = htmlentities($surname);

    if(isset($_POST['user_name']))
    {
        $imie = $_POST['user_name'];
        $imie = htmlentities($imie);
       if(isset($_POST['user_pass']))
       {
           $haslo = $_POST['user_pass'];
           $haslo = htmlentities($haslo);
		   if(isset($_POST['user_email']))
		   {
			   $mail = $_POST['user_email'];
			   $mail= htmlentities($mail);
           	 	if(isset($_POST['user_birth_day']))
              	{
                	$dataUr = $_POST['user_birth_day'];
                	$dataUr = htmlentities($dataUr);
            	}
				if(isset($_POST['user_rodo']))
				{
					$rodo= $_POST['user_rodo'];
			   		$rodo = htmlentities($rodo);

					   $queryOsoby = "insert into osoby values('','{$surname}','{$imie}','{$mail}','{$dataUr}','{$rodo}')";
					   $bazaOsoby = mysqli_query($connection, $queryOsoby); 

					   $idOsoby = "select id from osoby where mail like '{$mail}'";
					   $idOsobyWynik = mysqli_query($connection, $idOsoby); 
					   $rzutowanie = mysqli_fetch_assoc($idOsobyWynik);
					   $queryUzytkownicy = "insert into uzytkownicy values('','{$rzutowanie['id']}', '{$haslo}','{1}')";
					   $bazaUzytkownicy= mysqli_query($connection, $queryUzytkownicy); 
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