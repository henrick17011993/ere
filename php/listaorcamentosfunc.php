<?php
require_once "funcoes.php";

function conectarAoBanco() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ere";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

$conn = conectarAoBanco();
$sql = "SELECT * FROM orcamento";
$result = $conn->query($sql);

// $conn = conectarAoBanco();
// $sql = "SELECT * 
//         FROM orcamento
//         ORDER BY 
//             CASE 
//                 WHEN STATUS = 'Ag/Confir' THEN 1
//                 WHEN STATUS = 'Em Andamento' THEN 2
//                 WHEN STATUS = 'Concluido' THEN 3
//                 ELSE 4
//             END, 
//             STATUS DESC;";
// $result = $conn->query($sql);

?>


