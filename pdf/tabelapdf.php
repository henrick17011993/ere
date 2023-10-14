<?php
require "../php/funcoes.php";

$usuario = $_POST['data'];

$dados = json_decode($usuario, true);
printr($dados);
var_dump($dados);

?>