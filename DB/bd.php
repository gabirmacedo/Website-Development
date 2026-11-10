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

$query = "CREATE DATABASE IF NOT EXISTS biblioteca;";

$criarbiblioteca = mysqli_query($conn, $query);

if (!$criarbiblioteca) 
    die  ("Erro ao criar db");

$query = "USE biblioteca;";

$usarbiblioteca = mysqli_query($conn, $query);
if (!$usarbiblioteca) 
    die  ("Erro ao usar db");

$query = "CREATE TABLE IF NOT EXISTS Leitor (
    n_leitor INT NOT NULLAUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    morada VARCHAR(250) NOT NULL,
    contacto VARCHAR(10) NOT NULL
);";

$criarLeitor = mysqli_query($conn, $query);
if (!$criarLeitor)
    die  ("Erro ao criar tabela Leitor");



?>