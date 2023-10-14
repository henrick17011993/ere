<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>E.R.E. Moveis para Locação</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/tabelaentrega.js"></script>
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
        <div class="orcamento"style="margin: 2px 0px 53px 0px;">
            <div class="card-head"style=" padding-right: 1786px;">
                <h3>Tabela de entrega</h3>
            </div>
            <div class="div-input" id="divNome">
                <label for="evento">Evento</label>
                <input type="text" value="" name="evento" id="evento" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divNome">
                <label for="montadora">Montadora</label>
                <input type="text" value="" name="montadora" id="montadora" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divContato">
                <label for="Contato">Contato</label>
                <input type="text" value="" name="Contato" id="Contato" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divEvento">
                <label for="stand">Stand</label>
                <input type="text" value="" name="stand" id="stand" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divLocal">
                <label for="Local">Local</label>
                <input type="text" value="" name="Local" id="Local" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div> 
            <div class="div-input" id="divEntrega">
                <label for="Entrega">Data de Entrega</label>
                <input type="date" value="" name="Entrega" id="Entrega" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divDatade">
                <label for="Datade">Data de Retirada:</label>
                <input type="date" value="" name="Datade" id="Datade" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
        </div>
       
        <div class="show">
            <div class="card-head">
                <h3>Produtos Disponíveis</h3>
                <li><input type="text" id="searchInput" placeholder="Pesquisar produtos..."></li>
            </div>

            <table class="tabela">
            <thead>
                <tr>
                    <th style="text-align: center;">Modelo</th>
                    <th style="text-align: center;">Observação</th>
                    <th style="text-align: center;">Imagem</th>
                    <th style="text-align: center;">Quantidade</th>
                    <th style="text-align: center;">Selecione</th>
                </tr>  
            </thead>
            <tbody>
                <?php 
                    $tipoAnterior = null;
                    foreach ($arrayResultados as $value):  
                        if ($value['TIPO'] !== $tipoAnterior) {
                            echo '<tr><td colspan="9"><h2 style="text-align: center; background-color: white; width: 100%; color: #3498db; border-radius: 10px; padding: 5px;">' . $value['TIPO'] . '</h2></td></tr>';
                            $tipoAnterior = $value['TIPO'];
                        }
                ?>
                    <tr style="text-align: -webkit-center;">

                        <td style="text-align: center;"><?= $value["MODELOS"] ?></td>

                        <td style="text-align: center" class="div-textearea">
                            <textarea name="Observacao" id="divObservacao_<?= $value['IDTIPO']?>" rows="3" cols="0" style="resize: none; font-size: 19px;"></textarea>
                        </td>

                        <td style="text-align: -webkit-center;">
                            <div class="image-container">
                                <img src="<?= htmlspecialchars($value["IMAGEM"], ENT_QUOTES, 'UTF-8') ?>" alt="Imagem">
                            </div>
                        </td>

                        <td class="div-input" style="width: 80px;height: 0px;margin-left: 12px;margin-top: 27px; text-align: center;">
                            <input type="number" name="QUANTIDADE" id="divQuantidade_<?= $value['IDTIPO']?>">
                        </td>

                        <td style="text-align: center;">
                        <input type="checkbox" name="product_checkbox[]" id="product_checkbox_<?= $value['IDTIPO'] ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
                </tr>
                    <tr>
                        <td colspan="15">
                            <button type="button" id="TabelaEntregaForm">Imprimir Tabela Entrega</button>
                        </td>
                    </tr>
            </tfoot>
        </table>
    </main>
    
    <footer>
        <span>&copy; Feito por Henrique</span>           
    </footer>
</body>
</html>