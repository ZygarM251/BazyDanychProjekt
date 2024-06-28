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
					<?php
                session_start();
                if (isset($_SESSION['imie'])) {
                    echo '<form action="logout.php" method="post">
                            <input type="submit" value="Wyloguj">
                          </form>';
                }
                ?>
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
if (isset($_POST['user_email']) && isset($_POST['user_pass'])) {
    $email = $_POST['user_email'];
    $pass = $_POST['user_pass'];

    if (empty($email)) {
        echo "Nie podano adresu e-mail";
    } elseif (empty($pass)) {
        echo "Nie podano hasła";
    } else {
        $query = "SELECT osoby.imie, uzytkownicy.haslo 
                  FROM osoby 
                  JOIN uzytkownicy ON osoby.id = uzytkownicy.id 
                  WHERE osoby.mail = ?";

        // Zapytanie sprawdzenie
        if ($stmt = mysqli_prepare($connection, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $imie, $haslo);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            // Szyfrowanie hasła i weryfikowanie hasła
            $zaszyfrowaneHaslo = hash('sha256', $pass);

            if ($haslo === $zaszyfrowaneHaslo) {
                
                $_SESSION['imie'] = $imie;
                echo "Zalogowano, Witamy {$_SESSION['imie']}";
            } else {
                echo "Podano błędne hasło lub login";
            }
        } else {
            echo "Błąd w zapytaniu SQL";
        }
    }
} else {
    echo "Żaden użytkownik nie jest zalogowany";
}

?>
<div id="footer">
Wszelkie prawa zastrzeżone - &copy; 2022
</div>
</body>
</html>