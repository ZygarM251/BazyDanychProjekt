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
        Login: <input type="text" name="user_login"><br>
        Hasło: <input type="password" name="user_pass"><br><br>
        <input type="submit" name="" value="Zaloguj">
    </form><br><br><br><br>
	</div>
	<?php
require('connect.php');
if( isset($_POST['user_login']) )
{
	$l = $_POST['user_login'];
	$p = $_POST['user_pass'];
	$p = hash('sha256', $p);
	$query = "select * from users where user_login='{$l}' and user_pass='{$p}'";
	$result = mysqli_query($connection, $query);
	session_start();
	if($result)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$_SESSION['user_log']=$row['user_login'];
			$_SESSION['user_id']=$row['user_id'];
		}
		echo "Zalogowano, Witamy {$_SESSION['user_log']}";
		$u = mysqli_num_rows($result);
	}
	else
	{
		echo "Spróbuj jeszcze raz";
	}
}
?>
<div id="footer">
Wszelkie prawa zastrzeżone - &copy; 2022
</div>
</body>
</html>