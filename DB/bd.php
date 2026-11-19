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

$checkcolumn = mysqli_query($conn, "SHOW COLUMNS FROM Livro LIKE 'datapublicacao'");
if (mysqli_num_rows($checkcolumn) == 0) {
    $query = "ALTER TABLE Livro ADD COLUMN datapublicacao DATE;";
    $alterLivro = mysqli_query($conn, $query);
    if (!$alterLivro)
        die  ("Erro ao alterar tabela Livro");
}

$checkcolumn = mysqli_query($conn, "SHOW COLUMNS FROM Livro LIKE 'genero'");
if (mysqli_num_rows($checkcolumn) == 0) {
    $query = "ALTER TABLE Livro ADD COLUMN genero VARCHAR(100);";
    $alterLivro = mysqli_query($conn, $query);
    if (!$alterLivro)
        die  ("Erro ao alterar tabela Livro");
}

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

$query = "INSERT INTO Livro (cod_livro, nome, genero, autor, editora, n_leitor, datapublicacao) VALUES 
    (1,'O Senhor dos Anéis','Fantasia','Goblin','editora 1',1,'2020-01-01'),
    (2,'Senhora linda','Romance','George macedo','editora 2',2,'2020-02-01'),
    (3,'O Pequeno Príncipe','Infantil','Alice boavista','Editora 1',3,'2015-03-01'),
    (4,'A Menina que Roubava Livros','Ficção','Markus Zusak','Editora 2',4,'2020-04-01'),
    (5,'O Código Da Vinci','Thriller','James Brown','Editora 2',5,'2013-05-01'),
    (6,'Harry Potter e a Pedra Filosofal','Fantasia','J.K. Rowling','Editora 3',6,'2020-06-01'),
    (7,'O Hobbit','Fantasia','Tolkien','Editora 3',7,'2011-07-01'),
    (8,'Declinio de um Homem','Ficção','Osamu Dazai','Editora 3',6,'2006-08-01'),
    (9,'Noites Brancas','Informática','Fyodor Dostoevsky','Editora 2',5,'2020-09-01'),
    (10,'A metamorfose','Ficção','Franz Kafka','Editora 1',4,'2003-10-01'),
    (11,'De bom a excelente','Negócios','Jim Collins','Editora 2',3,'1989-11-01'),
    (12,'Dom Casmurro','Ficção','Machado de Assis','Editora 3',2,'2020-12-01');";    

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

echo "<br>";
echo "<h1>Listagen de Leitores</h1>";
echo "<br>";

$query = "SELECT * FROM Leitor;";
$selectLeitor = mysqli_query($conn, $query);
if (!$selectLeitor)
    die  ("Erro ao selecionar dados na tabela Leitor");
if($selectLeitor->num_rows > 0){
    while( $registro = $selectLeitor->fetch_assoc()){
        echo "ID: " . $registro["n_leitor"]. " - Nome: " . $registro["nome"]. " - Morada: " . $registro["morada"]. " - Contacto: " . $registro["contacto"]. "<br>";
    }
} 
echo "<h1>Listagem de Livros</h1>";
echo "<br>";

$query = "SELECT * FROM Livro;";
$selectLivro = mysqli_query($conn, $query);
if (!$selectLivro)
    die  ("Erro ao selecionar dados na tabela Livro");
if($selectLivro->num_rows > 0){
    while( $registro = $selectLivro->fetch_assoc()){
        echo "ID: " . $registro["cod_livro"]. " - Nome: " . $registro["nome"]. " - Autor: " . $registro["autor"]. " - Editora: " . $registro["editora"]. " - n_leitor: " . $registro["n_leitor"]. "<br>"; 
    }
} 
echo "<h1>Listagem de Livros por Género</h1>";
echo "<br>";

$query = "SELECT nome,autor FROM Livro Where genero = 'informática';";
$selectLivroGenero = mysqli_query($conn, $query);
if (!$selectLivroGenero)
    die  ("Erro ao selecionar dados na tabela Livro");
if($selectLivroGenero->num_rows > 0){
    while( $registro = $selectLivroGenero->fetch_assoc()){
        echo "Titulo: " . $registro["nome"]. " - Autor: " . $registro["autor"]. "<br>"; 
    }
} 
echo "<h1>Listagem de Livros Por Ordem Alfabética</h1>";
echo "<br>";

$query = "SELECT nome FROM Livro ORDER BY nome;";
$selectLivroOrdenado = mysqli_query($conn, $query);
if (!$selectLivroOrdenado)
    die  ("Erro ao selecionar dados na tabela Livro");
if($selectLivroOrdenado->num_rows > 0){
    while( $registro = $selectLivroOrdenado->fetch_assoc()){
        echo "Titulo: " . $registro["nome"]. "<br>"; 
    }
} 
echo "<h1>Listagem de Livros Publicados depois de 2015</h1>";
echo "<br>";

$query = "SELECT nome, autor FROM Livro WHERE datapublicacao BETWEEN '2015-01-01' AND '2028-01-01';";
$selectLivroOrdenadoData = mysqli_query($conn, $query);
if (!$selectLivroOrdenadoData)
    die  ("Erro ao selecionar dados na tabela Livro");
if($selectLivroOrdenadoData->num_rows > 0){
    while( $registro = $selectLivroOrdenadoData->fetch_assoc()){
        echo "Titulo: " . $registro["nome"]. " - Autor: " . $registro["autor"]. "<br>"; 
    }
} 
echo "<h1>Pesquisa de Leitores pela letra 'A'</h1>";
echo "<br>";

$query = "SELECT * FROM Leitor WHERE nome LIKE 'A%';";
$selectLeitorA = mysqli_query($conn, $query);
if (!$selectLeitorA)
    die  ("Erro ao selecionar dados na tabela Leitor");
if($selectLeitorA->num_rows > 0){
    while( $registro = $selectLeitorA->fetch_assoc()){
        echo "ID: " . $registro["n_leitor"]. " - Nome: " . $registro["nome"]. " - Morada: " . $registro["morada"]. " - Contacto: " . $registro["contacto"]. "<br>"; 
    }
}
echo "<h1>Consulta de Cartão</h1>";
echo "<br>";

$query = "SELECT nome,Cartao.n_leitor FROM Leitor, Cartao WHERE Leitor.n_leitor = Cartao.n_leitor;";
$selectLeitorCartao = mysqli_query($conn, $query);
if (!$selectLeitorCartao)
    die  ("Erro ao selecionar dados na tabela Leitor e Cartao");
if($selectLeitorCartao->num_rows > 0){
    while( $registro = $selectLeitorCartao->fetch_assoc()){
        echo "Nome: " . $registro["nome"]. " - Número do Cartão: " . $registro["n_leitor"]. "<br>"; 
    }
}
echo "<h1>Consulta de Emprestimos</h1>";
echo "<br>";

$query = "SELECT Leitor.nome AS nome_leitor,Livro.nome AS nome_livro, Emprestimo.data_inicio FROM Emprestimo JOIN Leitor ON Emprestimo.n_leitor = Leitor.n_leitor JOIN Livro ON Emprestimo.cod_livro = Livro.cod_livro;";
$selectLeitorLivroEmprestimo = mysqli_query($conn, $query);
if (!$selectLeitorLivroEmprestimo)
    die  ("Erro ao selecionar dados na tabela Leitor, Livro e Emprestimo");
if($selectLeitorLivroEmprestimo->num_rows > 0){
    while( $registro = $selectLeitorLivroEmprestimo->fetch_assoc()){
        echo "Nome do Leitor: " . $registro["nome_leitor"]. " - Nome do Livro: " . $registro["nome_livro"]. " - Data de Início: " . $registro["data_inicio"]. "<br>"; 
    }
}
echo "<h1>Livros por Devolver</h1>";
echo "<br>";

$query = "SELECT Leitor.nome AS nome_leitor, Livro.nome AS nome_livro, Emprestimo.data_FIM FROM Emprestimo JOIN Leitor ON Emprestimo.n_leitor = Leitor.n_leitor JOIN Livro ON Emprestimo.cod_livro = Livro.cod_livro WHERE Emprestimo.data_fim IS NULL;";
$selectLeitorLivroEmprestimoFim = mysqli_query($conn, $query);
if (!$selectLeitorLivroEmprestimoFim)
    die  ("Erro ao selecionar dados na tabela Leitor, Livro e Emprestimo");
if($selectLeitorLivroEmprestimoFim->num_rows > 0){
    while( $registro = $selectLeitorLivroEmprestimoFim->fetch_assoc()){
        echo "Nome do Leitor: " . $registro["nome_leitor"]. " - Nome do Livro: " . $registro["nome_livro"]. " - Data de Devolução: " . $registro["data_fim"]. "<br>"; 
    }
}
else {
    echo "Não tem livros por devolver";
}

echo "<h1>Listagem de</h1>";
echo "<br>";

$query = "SELECT Leitor.nome AS nome_Leitor, COUNT(Emprestimo.n_emprestimo) AS total_emprestimos FROM Emprestimo LEFT JOIN Leitor ON Emprestimo.n_leitor = Leitor.n_leitor GROUP BY Leitor.nome, Leitor.n_leitor;";
$selectLeitorEmprestimos = mysqli_query($conn, $query);
if (!$selectLeitorEmprestimos)
    die  ("Erro ao selecionar dados na tabela Leitor e Emprestimo");
if($selectLeitorEmprestimos->num_rows > 0){
    while( $registro = $selectLeitorEmprestimos->fetch_assoc()){
        echo "Nome do Leitor: " . $registro["nome_Leitor"]. " - Total de Empréstimos: " . $registro["total_emprestimos"]. "<br>"; 
    }
}

?>