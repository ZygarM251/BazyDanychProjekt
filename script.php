<?php
session_start();
$id=$_POST['car_id'];
if(isset($_SESSION['user_log'])){
$query ="SELECT user_login,car_id,car_us,user_id from cars join users on car_us=user_id where car_id='$id';";
$result = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($result)){
if($_SESSION['user_log'] == $row['user_login']){
}
}
}
else
{
header('location: index.php');
}
?>