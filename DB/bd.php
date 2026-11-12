<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="tenor-gif-embed" data-postid="18411835051317170850" data-share-method="host" data-aspect-ratio="1"
        data-width="20%"><a
            href="https://tenor.com/view/meisho-doto-baile-uma-musume-anime-bailando-gif-18411835051317170850">Meisho
            Doto Baile GIF</a>from <a href="https://tenor.com/search/meisho+doto-gifs">Meisho Doto GIFs</a> </div>
    <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
</body>

</html>
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
    n_leitor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    morada VARCHAR(250),
    contacto VARCHAR(10));";
    
$criarLeitor = mysqli_query($conn, $query);
if (!$criarLeitor)
    die  ("Erro ao criar tabela Leitor");

$query = "CREATE TABLE IF NOT EXISTS Cartao (
    n_leitor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(20),
    validade DATE,
    FOREIGN KEY (n_leitor) REFERENCES Leitor(n_leitor));";

$criarCartao = mysqli_query($conn, $query);
if (!$criarCartao)
    die  ("Erro ao criar tabela Cartao");

$query = "CREATE TABLE IF NOT EXISTS Livro (
    cod_livro INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200),
    autor VARCHAR(200),
    editora VARCHAR(150),
    n_leitor INT,
    FOREIGN KEY (n_leitor) REFERENCES Leitor(n_leitor));";

$criarLivro = mysqli_query($conn, $query);
if (!$criarLivro)
    die  ("Erro ao criar tabela Livro");

$query = "CREATE TABLE IF NOT EXISTS Emprestimo (
    n_emprestimo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    n_leitor INT,
    cod_livro INT,
    data_inicio DATE,
    data_fim DATE,
    FOREIGN KEY (n_leitor) REFERENCES Leitor(n_leitor),
    FOREIGN KEY (cod_livro) REFERENCES Livro(cod_livro));";

$criarEmprestimo = mysqli_query($conn, $query);
if (!$criarEmprestimo)
    die  ("Erro ao criar tabela Emprestimo");

mysqli_query($conn, "DELETE FROM Emprestimo");
mysqli_query($conn, "DELETE FROM Livro");
mysqli_query($conn, "DELETE FROM Cartao");
mysqli_query($conn, "DELETE FROM Leitor");


$query = "INSERT INTO Leitor (n_leitor, nome, morada, contacto) VALUES 
    (1,'João','Rua da boa vista','912345678'),
    (2,'Maria','Avenida central','912345679'),
    (3,'Carlos','Travessa do meio','912345680'),
    (4,'Bruna','Praça da liberdade','912345681'),
    (5,'Paulo','Rua do comércio','912345682'),
    (6,'Alice','Avenida da paz','912345683'),
    (7,'Hermes','Rua do comércio','912345684');";

$inserirLeitor = mysqli_query($conn, $query);
if (!$inserirLeitor)
    die  ("Erro ao inserir dados na tabela Leitor");

$query = "INSERT INTO Cartao (n_leitor, estado, validade) VALUES 
    (1,'Ativo','2025-12-31'),
    (2,'Inativo','2023-06-30'),
    (3,'Ativo','2024-09-15'),
    (4,'Ativo','2025-03-20'),
    (5,'Inativo','2022-11-10'),
    (6,'Ativo','2024-07-05'),
    (7,'Ativo','2025-01-01');";    

$inserirCartao = mysqli_query($conn, $query);
if (!$inserirCartao)
    die  ("Erro ao inserir dados na tabela Cartao");

$query = "INSERT INTO Livro (cod_livro, nome, autor, editora, n_leitor) VALUES 
    (1,'O Senhor dos Anéis','Goblin','editora 1',1),
    (2,'Senhora linda','George macedo','editora 2',2),
    (3,'O Pequeno Príncipe','Alice boavista','Editora 1',3),
    (4,'A Menina que Roubava Livros','Markus Zusak','Editora 2',4),
    (5,'O Código Da Vinci','James Brown','Editora 2',5),
    (6,'Harry Potter e a Pedra Filosofal','J.K. Rowling','Editora 3',6),
    (7,'O Hobbit','Tolkien','Editora 3',7),
    (8,'Declinio de um Homem','Osamu Dazai','Editora 3',6),
    (9,'Noites Brancas','Fyodor Dostoevsky','Editora 2',5),
    (10,'A metamorfose','Franz Kafka','Editora 1',4),
    (11,'De bom a excelente','Jim Collins','Editora 2',3),
    (12,'Dom Casmurro','Machado de Assis','Editora 3',2);";    

$inserirLivro = mysqli_query($conn, $query);
if (!$inserirLivro)
    die  ("Erro ao inserir dados na tabela Livro");

$query = "INSERT INTO Emprestimo (n_leitor, cod_livro, data_inicio, data_fim) VALUES 
    (1, 1, '2023-01-01', '2023-01-15'),
    (2, 2, '2023-02-01', '2023-02-15'),
    (3, 3, '2023-03-01', '2023-03-15'),
    (4, 4, '2023-04-01', '2023-04-15'),
    (5, 5, '2023-05-01', '2023-05-15'),
    (6, 6, '2023-06-01', '2023-06-15'),
    (7, 7, '2023-07-01', '2023-07-15'),
    (6, 8, '2023-08-01', '2023-08-15'),
    (5, 9, '2023-09-01', '2023-09-15'),
    (4, 10, '2023-10-01', '2023-10-15'),
    (3, 11, '2023-11-01', '2023-11-15'),
    (2, 12, '2023-12-01', '2023-12-15'),
    (7, 5, '2023-12-01', '2023-12-15'),
    (3, 3, '2023-12-01', '2023-12-15'),
    (1, 1, '2023-12-01', '2023-12-15');";    

$inserirEmprestimo = mysqli_query($conn, $query);
if (!$inserirEmprestimo)
    die  ("Erro ao inserir dados na tabela Emprestimo");