<?php 
    require "php/funcoes.php";        
    $dadosTabela = null;
    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';

    if ($acao === 'r' && isset($_GET['id'])) {
        printr($_GET['ID']);
        $dadosTabela = BuscaDados($_GET['id']);            
    }
?>