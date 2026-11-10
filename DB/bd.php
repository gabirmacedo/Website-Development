<?php 

$host = "localhost";
$user = "root";
$pass = "root";
$db = "";
$porta = "8889";

$conn = mysqli_connect($host, $user, $pass, $db, $porta);
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
echo "Conexão bem-sucedida!";

?>