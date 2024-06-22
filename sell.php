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
<div id="formularz">
    <form action="" method="post" id="carForm">
        Marka:
        <?php
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
    ?>
    <br>
	Przebieg: <input type="number" name="car_run"><br>
    Rocznik: <input type="number" name="car_year"><br>
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
    Kolor: <input type="text" name="car_color"><br>
    Zdjęcie: <input type="text" name="car_img"><br>
    Cena: <input type="number" name="car_price"><br><br>
    <input type="submit" name="submit_car" value="Dodaj">
</form>
</div>
<?php
session_start();

if(isset($_SESSION['imie'])){

	$login=$_SESSION['imie'];

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