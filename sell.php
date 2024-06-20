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
        <div id="menu-left">Moto-Oto</div>
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
            <div class="button">OGŁOSZENIA</div>
        </a>
    </div>
</div>
<form action="" method="post">
    Marka:
    <?php
    require('connect.php');
    $query = mysqli_query($connection, "SELECT * FROM marki ORDER BY id ASC");

    if (!$query) {
        die("Query failed: " . mysqli_error($connection));
    }

    echo '<select name="car_brand" onchange="updateModels(this.value)">';
    echo '<option value="">-</option>';
    while ($option = mysqli_fetch_assoc($query)) {
        $selected = (isset($_POST['car_brand']) && $_POST['car_brand'] == $option['id']) ? ' selected' : '';
        echo '<option value="'.$option['id'].'"'.$selected.'>'.$option['nazwa_marki'].'</option>';
    }
    echo '</select><br>';
    ?>
    Model:
    <select name="car_model" id="car_model">
        <option value="">Wybierz markę najpierw</option>
    </select>
    <br>
    Przebieg: <input type="number" name="car_run"><br>
    Rocznik: <input type="year" name="car_year"><br>
    Pojemność(cm³): <input type="number" name="car_engine"><br>
    Moc: <input type="number" name="car_horsepower"><br>
    Skrzynia Biegów:
    <?php
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
    ?><br>
    Rodzaj paliwa:
    <?php
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
    ?><br>
    Kolor: 
    <?php
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
    ?><br>
    Zdjęcie: <input type="text" name="car_img"><br>
    Cena: <input type="number" name="car_price"><br><br>
    <input type="submit" name="submit_car" value="Dodaj">
</form>
</div>
<?php
if (isset($_POST['submit_car'])) {
    //$login = $_SESSION['imie'];
    $login = 'dupa';
    require('connect.php');

    if ($_POST['car_brand'] == '-' ||
    $_POST['car_model'] == 'Wybierz model' ||
    $_POST['car_model'] == 'Wybierz markę najpierw' ||
    empty($_POST['car_year']) ||
    empty($_POST['car_run']) ||
    empty($_POST['car_engine']) ||
    $_POST['car_gear'] == '-' ||
    empty($_POST['car_horsepower']) ||
    $_POST['car_color'] == '-' ||
    empty($_POST['car_price']) ||
    empty($_POST['car_img']) ||
    $_POST['car_fuel'] == '-'
    ) {
    echo "Ogłoszenie jest niekompletne!"; 
    } else {
        $a = $_POST['car_brand'];
        $b = $_POST['car_model'];
        $c = $_POST['car_year'];
        $d = $_POST['car_run'];
        $e = $_POST['car_engine'];
        $f = $_POST['car_gear'];
        $g = $_POST['car_horsepower'];
        $h = $_POST['car_color'];
        $i = $_POST['car_price'];
        $j = $_POST['car_img'];
        $k = $_POST['car_fuel'];
        $l = 1;
        $m = 7;
        $n = $_POST['car_img'];
        $current_date = date("Y-m-d H:i:s");
        if ($connection->connect_error) {
            die("Connection failed: ". $connection->connect_error);
        }
        
        $stmt = $connection->prepare("INSERT INTO ogloszenia ( id_uzytkownicy, data, id_marki, id_modele, przebieg, rocznik, pojemnosc_silnika, moc, id_rodzaje_skrzyni_biegow, id_rodzaje_paliwa, id_kolory, id_status_ogloszenia, waznosc,zdjecie) VALUES (?, ?,?,?,?,?,?,?,?,?,?,?,?,?)");
        if (!$stmt) {
            die("Prepare failed: ". $connection->error);
        }
        $stmt->bind_param("isiiiiiiiiiiis",$login,$current_date, $a, $b, $d, $c, $e, $g, $f, $k, $h, $l, $m,$n);
        $stmt->execute();
        $a = '-';
        if ($stmt->affected_rows > 0) {
            //header("location:index.php?status=ok");
            echo "Jest ok";
        } else {
            //header("location:index.php?status=error");
            echo "Erorr";
        }
    }
} else {
    //header("location:mustlog.php");
}
?>
<div id="footer">
Wszelkie prawa zastrzeżone - &copy; 2022
</div>
</body>
</html>