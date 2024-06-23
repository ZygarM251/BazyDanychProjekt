<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moto-oto Ogłoszenia</title>
    <link rel="stylesheet" href="style6.css">
    <script>
        function updateModels(brandId) {
            var carModelSelect = document.getElementById("car_model");

            carModelSelect.innerHTML = '<option value="">Wybierz model</option>';

           
            if (brandId !== "") {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                
                        console.log("Odpowiedź z serwera: " + this.responseText); 
                        var models;
                        try {
                            models = JSON.parse(this.responseText);
                        } catch (e) {
                            console.error("Błąd parsowania JSON: " + e);
                            return;
                        }

                        models.forEach(function(model) {
                            var option = document.createElement("option");
                            option.text = model.nazwa_modelu;
                            option.value = model.id;
                            carModelSelect.appendChild(option);
                        });
                    }
                };
                xmlhttp.open("GET", "get_models.php?brand_id=" + brandId, true);
                xmlhttp.send();
            }
        }
    </script>
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
<?php
echo '<div id="formularz">';
    echo '<form action="" method="post" id="carForm">';
        echo 'Marka:';
        
        session_start();

        if(isset($_SESSION['imie'])){
        
            
        require('connect.php');
        $query = mysqli_query($connection, "SELECT * FROM marki ORDER BY id ASC");

        if (!$query) {
            die("Query failed: " . mysqli_error($connection));
        }

        echo '<select name="car_brand" onchange="document.getElementById(\'carForm\').submit();">';
        echo '<option value="">-</option>';
    while ($option = mysqli_fetch_assoc($query)) {
        $selected = (isset($_POST['car_brand']) && $_POST['car_brand'] == $option['id']) ? ' selected' : '';
        echo '<option value="'.$option['id'].'"'.$selected.'>'.$option['nazwa_marki'].'</option>';
    }
    echo '</select><br>';
	
	echo 'Model:';
    if (isset($_POST['car_brand']) && !empty($_POST['car_brand'])) {
        $selected_brand_id = $_POST['car_brand'];
        $query = mysqli_query($connection, "SELECT * FROM modele WHERE id_marki = '$selected_brand_id' ORDER BY id ASC");

        if (!$query) {
            die("Query failed: " . mysqli_error($connection));
        }

        echo '<select name="car_model">';
        echo '<option value="">Wybierz model</option>';
        while ($option = mysqli_fetch_assoc($query)) {
            $selected_model = (isset($_POST['car_model']) && $_POST['car_model'] == $option['id']) ? ' selected' : '';
            echo '<option value="'.$option['id'].'"'.$selected_model.'>'.$option['nazwa_modelu'].'</option>';
        }
        echo '</select>';
    } else {
        echo '<select name="car_model">';
        echo '<option value="">Wybierz markę najpierw</option>';
        echo '</select>';
    }
    
    echo ' <br>';
	echo 'Przebieg: <input type="number" name="car_run"><br>';
    echo 'Rocznik: <input type="number" name="car_year"><br>';
    echo 'Pojemność(cm³): <input type="number" name="car_engine"><br>';
	echo 'Moc: <input type="number" name="car_horsepower"><br>';
    echo 'Skrzynia Biegów: ';
	
    $query_gear = mysqli_query($connection, "SELECT * FROM rodzaje_skrzyni_biegow ORDER BY id ASC");

    if (!$query_gear) {
        die("Query failed: " . mysqli_error($connection));
    }

    echo '<select name="car_gear">';
    echo '<option value="">-</option>';
    while ($option_gear = mysqli_fetch_assoc($query_gear)) {
        echo '<option value="'.$option_gear['id'].'">'.$option_gear['nazwa_typu'].'</option>';
    }
    echo '</select>';
    echo '<br>';
    echo 'Rodzaj Paliwa:';
    
    $query_fuel = mysqli_query($connection, "SELECT * FROM rodzaje_paliwa ORDER BY id ASC");

    if (!$query_fuel) {
        die("Query failed: " . mysqli_error($connection));
    }

    echo '<select name="car_fuel">';
    echo '<option value="">-</option>';
    while ($option_fuel = mysqli_fetch_assoc($query_fuel)) {
        echo '<option value="'.$option_fuel['id'].'">'.$option_fuel['nazwa_paliwa'].'</option>';
    }
    echo '</select>';
    echo '<br>';
    echo 'Kolor:'; 
    
    $query_fuel = mysqli_query($connection, "SELECT * FROM kolory ORDER BY id ASC");

    if (!$query_fuel) {
        die("Query failed: " . mysqli_error($connection));
    }

    echo '<select name="car_color">';
    echo '<option value="">-</option>';
    while ($option_fuel = mysqli_fetch_assoc($query_fuel)) {
    echo '<option value="'.$option_fuel['id'].'">'.$option_fuel['nazwa_koloru'].'</option>';
    }
    echo '</select>';
    echo '<br>';
    echo'Zdjęcie: <input type="text" name="car_img"><br>';
    echo'Cena: <input type="number" name="car_price"><br><br>';
    echo'<input type="submit" name="submit_car" value="Dodaj">';
    echo'</form>';
    echo '</div>';




if (isset($_POST['car_brand']) && isset($_POST['car_model']) && isset($_POST['car_year'])&& 
isset($_POST['car_run']) && isset($_POST['car_engine']) && isset($_POST['car_gear']) && isset($_POST['car_horsepower'])&& 
isset($_POST['car_color']) && isset($_POST['car_price']) && isset($_POST['car_img']) && isset($_POST['car_fuel'] ))
{
    $cMarka = $_POST['car_brand'];
    $cMarka = htmlentities($cMarka);

    $cModel = $_POST['car_model'];
    $cModel = htmlentities($cModel);

    $cRok = $_POST['car_year'];
    $cRok = htmlentities($cRok);

    $cPrzebieg = $_POST['car_run'];
    $cPrzebieg = htmlentities($cPrzebieg);

    $cPojemnosc = $_POST['car_engine'];
    $cPojemnosc = htmlentities($cPojemnosc);

    $cSkrzynia = $_POST['car_gear'];
    $cSkrzynia = htmlentities($cSkrzynia);

    $cMoc = $_POST['car_horsepower'];
    $cMoc = htmlentities($cMoc);

    $cKolor = $_POST['car_color'];
    $cKolor = htmlentities($cKolor);

    $cCena = $_POST['car_price'];
    $cCena = htmlentities($cCena);

    $cZdjecie = $_POST['car_img'];
    $cZdjecie = htmlentities($cZdjecie);

    $cPaliwo = $_POST['car_fuel'];
    $cPaliwo = htmlentities($cPaliwo);

    $czyAktywne = 1;
    $waznoscOgloszenia = 30;
    $login=$_SESSION['imie'];
    $data=date('Y-m-d H:i:s');

    $q = "insert into ogloszenia values('','{$login}','{$data}','{$cMarka}','{$cModel}','{$cPrzebieg}','{$cRok}','{$cPojemnosc}','{$cMoc}','{$cSkrzynia}','{$cPaliwo}',
    '{$cKolor}','{$czyAktywne}','{$waznoscOgloszenia}','{$cZdjecie}','{$cCena}' );"; 
	$r = mysqli_query($connection,$q); 

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