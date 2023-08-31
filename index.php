<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>E.R.E.com</title>
=======
    <title>Henrimack.com</title>
>>>>>>> 27d3988e75865ef6028949983a861ddc7f28d092
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./js/main.js"></script>
</head>
<body>
    <?php 
        require "php/funcoes.php";
        $arrayResultados = show();
        ?>        
    <header>
<<<<<<< HEAD
        <h1>E.R.E</h1>
=======
        <h1>Henrimack</h1>
>>>>>>> 27d3988e75865ef6028949983a861ddc7f28d092
        <ul>
            <li><a href="produto.php">Cadastro de Produtos</a></li>
            <li><a href="sobrenos.php">Sobre Nós</a></li>
            <li><a href="contato.php">Contate-nos</a></li>
        </ul>
    </header>
    <main>
        <div class ="show">
            <div class="card-head">
                <h3>Produtos Disponiveis</h3>
            </div>
       
        <table class="tabela">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Modelo</th>
                    <th>Cor</th>
                    <th>Valor</th>
                    <th>ações</th>
                </tr>                    
            </thead>
            <tbody>
                <?php foreach ($arrayResultados as $value):?>
                    <tr>
                        <td><?=$value["TIPO"]?></td>
                        <td><?=$value["MODELOS"]?></td>
                        <td><?=$value["COR"]?></td>
                        <td><?=$value["VALOR"]?></td>
                        <td>
                            <div class="actions">
                            <a id="btnR_<?=$value['IDTIPO']?>" href="produto.php?id=<?=$value['IDTIPO']?>&acao=r">🔍︎</a>
                            <a id="btnU_<?=$value['IDTIPO']?>" href="produto.php?id=<?=$value['IDTIPO']?>&acao=u">✎</a>
                            <a id="btnD_<?=$value['IDTIPO']?>" data-id="<?=$value['IDTIPO']?>">🗑</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>     
    </main>
    
    <footer>
        <span>&copy; Feito por Henrique</span>           

    </footer>
    
</body>
</html>