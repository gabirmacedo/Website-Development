<?php 

$host = "Redes_12";
$user = "root";
$pass = "";
$db = "";
$porta = "3306";

$conn = mysqli_connect($host, $user, $pass, $db, $porta);
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>