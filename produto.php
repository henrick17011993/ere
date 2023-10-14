<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>E.R.E Moveis para Locação</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./js/main.js"></script>
</head>
<body>
    <?php 
        require "php/funcoes.php";        
        $dadosTabela = null;
        $acao = isset($_GET['acao']) ? $_GET['acao'] : '';

        if ($acao === 'r' && isset($_GET['id'])) {
            $dadosTabela = BuscaDados($_GET['id']);
        }
    ?>

    <header>
        <?php include 'php/header.php'; ?>
    </header>

    <main>
        <div class="showw">
            <div class="card-head">
                <h3>Cadastro</h3>
                <a href="./" id="btnVoltar">voltar</a>
            </div>
            <fieldset>
                <div class="div-input" id="divImagem">
                    <img id="imagemExibicao" style="max-width: 194px; max-height: 238px;">
                    <input type="file" id="imagemInput" accept="image/*" required="True">
                </div>
                <div>
                    <label for="imagemInput"> </label>
                    <span id="linkDinamico"></span>
                </div>
                <div class="div-input" id="divCategoria">
                    <form style=" padding: 22px 0px 0px 0px;">
                        <label for="Tipo"></label>
                        <select <?= $acao === 'r' ? 'readonly' : '';?> name="Tipo" id="Tipo" required="True">
                            <option value="">Escolha a Categoria</option>
                            <option value="Banquetas">Banquetas</option>
                            <option value="Sofá/Poltronas">Sofá/Poltronas</option>
                            <option value="Bistrô">Bistrô</option>
                            <option value="Mesas/Cadeiras">Mesas/Cadeiras</option>
                            <option value="Eletro/Acessórios">Eletro/Acessórios</option>
                            <option value="Puff's">Puff's</option>
                        </select>
                    </form>
                </div>
                <div class="div-input" id="divNome">
                    <label for="Modelos">Modelo</label>
                    <input type="text" value="<?= $dadosTabela ? $dadosTabela["MODELOS"] : '';?>" <?= $acao === 'r' ? 'readonly' : '';?> name="Modelos" id="Modelos" required="True">
                </div>

                <div class="div-input" id="divCor">
                    <label for="Cor">Cor</label>
                    <input type="text" value="<?= $dadosTabela ? $dadosTabela["COR"] : '';?>" <?= $acao === 'r' ? 'readonly' : '';?> name="Cor" id="Cor" required="True">
                </div>
                <div class="div-input" id="divValor">
                    <label for="Valor">Valor</label>
                    <input type="number" value="<?= $dadosTabela ? $dadosTabela["VALOR"] : '';?>" <?= $acao === 'r' ? 'readonly' : '';?> name="Valor" id="Valor" required="True">
                </div>
            </fieldset>


            
            <?php if ($acao !== 'r'): ?>
                <div class="buttons">
                    <?php if ($acao === 'u'): ?>             
                        <button id="btnAtualizar" type="submit" data-id="<?= isset($_GET['id']) ? $_GET['id'] : '';?>">atualizar</button>
                    <?php else: ?>
                        <button id="btnButton" type="submit">enviar</button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>   
        </div>
    </main>
    <footer>
        <span>&copy; Feito por Henrique</span>
    </footer>
</body>
</html>
