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
$query="SELECT ogloszenia.id, marki.nazwa_marki, modele.nazwa_modelu, ogloszenia.moc, ogloszenia.rocznik, ogloszenia.przebieg, ogloszenia.pojemnosc_silnika,
			   rodzaje_paliwa.nazwa_paliwa, rodzaje_skrzyni_biegow.nazwa_typu, kolory.nazwa_koloru, ogloszenia.cena, 
			   ogloszenia.data, ogloszenia.zdjecie FROM ogloszenia JOIN marki ON ogloszenia.id_marki=marki.id 
			   JOIN modele ON ogloszenia.id_modele=modele.id JOIN rodzaje_paliwa ON ogloszenia.id_rodzaje_paliwa=rodzaje_paliwa.id 
			   JOIN rodzaje_skrzyni_biegow ON ogloszenia.id_rodzaje_skrzyni_biegow=rodzaje_skrzyni_biegow.id JOIN kolory ON ogloszenia.id_kolory=kolory.id;";
$result=@mysqli_query($connection,$query);
if($result){
		while($row = mysqli_fetch_assoc($result)){
	echo"<div id = 'show'>
				<img src='{$row['zdjecie']}' width='250px' height='auto' />
			<div id = 'wyswietl'><div>
			<h1>
			{$row['nazwa_marki']}
			{$row['nazwa_modelu']} 
			{$row['moc']}HP
			</h1>
			{$row['rocznik']}.r
			{$row['przebieg']} km
			{$row['pojemnosc_silnika']}cm³ 
			{$row['nazwa_paliwa']}<br>
			{$row['nazwa_typu']} 
			{$row['nazwa_koloru']}  
			{$row['data']}</div>
			<form action='edit.php?id={$row['id']}' method='post'>
			<input type='hidden' name='car_id' value='{$row['id']}'>
			</form>
			<div style = 'color:red'><h2>Cena: {$row['cena']} zł</h2></div>
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