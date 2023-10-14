<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>E.R.E. Moveis para Locação</title>
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
        <?php include 'php/header.php'; ?>
    </header>

        <main>
        <div class ="show">
            <div class="card-head">
                <h3>Produtos Disponiveis</h3>
                <li><input type="text" id="searchInput" placeholder="Pesquisar produtos..."></li>
        </div>
       
        <?php
            $produtosAgrupados = [];
            foreach ($arrayResultados as $produto) {
                $tipo = $produto["TIPO"];
                if (!isset($produtosAgrupados[$tipo])) {
                    $produtosAgrupados[$tipo] = [];
                }
                $produtosAgrupados[$tipo][] = $produto;
            }
            ?>

            <?php foreach ($produtosAgrupados as $tipo => $produtos): ?>
                <div class="tipo-produto">
                    <h2 style="text-align: center; background-color: white; width: 100%; color: #3498db; border-radius: 10px; padding: 5px;"><?= $tipo ?></h2>
                    <table class="tabela">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Tipo</th>
                                <th>Modelo</th>
                                <th>Cor</th>
                                <th>Valor</th>
                                <th>Ações</th>
                                <?php if ($tipo === array_key_first($produtosAgrupados)): ?>
                                    <th>
                                        <label for="checkboxSemValores" class="tooltip-container">
                                            <input type="checkbox" id="checkboxSemValores" class="tooltip-trigger" />
                                            <div class="tooltip" data-tooltip="Meu Tooltip">Imprimir S/Valor</div>
                                        </label>
                                    </th>
                                    <th><a id="btnPDF">🖶</a></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtos as $produto): ?>
                                <tr>
                                    <td>
                                        <div class="image-container">
                                            <img src="<?= htmlspecialchars($produto["IMAGEM"], ENT_QUOTES, 'UTF-8') ?>" alt="Imagem">
                                        </div>
                                    </td>
                                    <td><?= $produto["TIPO"] ?></td>
                                    <td><?= $produto["MODELOS"] ?></td>
                                    <td><?= $produto["COR"] ?></td>
                                    <td><?= $produto["VALOR"] ?></td>
                                    <td>
                                        <div class="actions">
                                            <a id="btnR_<?= $produto['IDTIPO'] ?>" href="produto.php?id=<?= $produto['IDTIPO'] ?>&acao=r">🔍</a>
                                            <a id="btnD_<?= $produto['IDTIPO'] ?>" data-id="<?= $produto['IDTIPO'] ?>">🗑</a>
                                            <a id="btnU_<?= $produto['IDTIPO'] ?>" href="produto.php?id=<?= $produto['IDTIPO'] ?>&acao=u">✎</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>     
    </main>
    
    <footer>
        <span>&copy; Feito por Henrique</span>           

    </footer>
    
</body>
</html>