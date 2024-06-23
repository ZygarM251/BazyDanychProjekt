<?php
require('connect.php');

$brand_id = $_GET['brand_id'];

$brand_id = mysqli_real_escape_string($connection, $brand_id);

$query = "SELECT id, nazwa_modelu FROM modele WHERE id_marki = $brand_id ORDER BY id ASC";

$result = mysqli_query($connection, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

$models = array();

while ($row = mysqli_fetch_assoc($result)) {
    $models[] = $row;
}

echo json_encode($models);

exit;
?>