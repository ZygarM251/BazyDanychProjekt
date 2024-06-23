<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moto-oto Logowanie</title>
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
					<form action="logout.php" method="post">
					<input type="submit" name="" value="Wyloguj">
					</form>
				</ul>
			</div>
		</div>
			<div id="menu-banner">
				<div id="message">
				<span>Mercedes w201<br /></span>
				<p>Mercedes w201 już od 15 tys zł</p>
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
        Login: <input type="text" name="user_email"><br>
        Hasło: <input type="password" name="user_pass"><br><br>
        <input type="submit" name="" value="Zaloguj">
    </form><br><br><br><br>
	</div>
	<?php
require('connect.php');
if( isset($_POST['user_email']) && isset($_POST['user_pass']) )
{
	$email = $_POST['user_email'];
	$pass = $_POST['user_pass'];
	$query="SELECT osoby.imie, uzytkownicy.haslo from osoby join uzytkownicy on osoby.id=uzytkownicy.id WHERE osoby.mail like '{$email}'";
	
	if(empty($pass) && empty($email))
	{
		echo "Nie podano hasło";
	}
	else
	{
		$result = mysqli_query($connection, $query); 
		session_start();
		$zaszyfrowanieHaslo=hash('sha256',$pass);

		if($result)
		{
			$row = mysqli_fetch_assoc($result);
			if($row['haslo']==$zaszyfrowanieHaslo)
			{
				$_SESSION['imie'] = $row['imie'];
				echo "Zalogowano, Witamy {$_SESSION['imie']}";
			}
			else
			{
				echo "Podano Błędne hasło lub login";
			}
			$result = 0;
		}
		exit();
	}

}

?>
<div id="footer">
Wszelkie prawa zastrzeżone - &copy; 2022
</div>
</body>
</html>