<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>E.R.E. Moveis para Locação</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" crossorigin="anonymous"></script>
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
        <div class="orcamento"style="margin: 2px 0px 53px 0px;">
            <div class="card-head"style=" padding-right: 2000px;">
                <h3>Dados Cadastrais da Empresa</h3>
            </div>

            <div class="div-input" id="divNome">
                <label for="razaosocial">Razão Social</label>
                <input type="text" value="" name="razaosocial" id="razaosocial" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divEndereço">
                <label for="Endereço">Endereço</label>
                <input type="text" value="" name="Endereço" id="Endereço" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>            
            <div class="div-input" id="divBairro">
                <label for="Bairro">Bairro</label>
                <input type="text" value="" name="Bairro" id="Bairro" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divCep">
                <label for="Cep">Cep</label>
                <input type="text" value="" name="Cep" id="Cep" placeholder="Digite o CEP" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divCidade">
                <label for="Cidade">Cidade</label>
                <input type="text" value="" name="Cidade" id="Cidade" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>            
            <div class="div-input" id="divcpfcnpj">
                <label for="cpfcnpj">CPF/CNPJ</label>
                <input type="text" value="" name="cpfcnpj" id="cpfcnpj" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>            
            <div class="div-input" id="divContato">
                <label for="Contato">Contato</label>
                <input type="text" value="" name="Contato" id="Contato" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divTelefone">
                <label for="Telefone">Telefone</label>
                <input type="text" value="" name="Telefone" id="Telefone" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divEmail">
                <label for="Email">Email</label>
                <input type="email" value="" name="Email" placeholder="Digite seu e-mail" id="Email" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divEstado">
                <label for="Estado"></label>
                <input type="hidden" value="" name="Estado" id="Estado" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
                <div class="div-input" id="divRG">
                <label for="RG"></label>
                <input type="hidden" value="" name="RG" id="RG" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
                <div class="div-input" id="divCCM">
                <label for="CCM"></label>
                <input type="hidden" value="" name="CCM" id="CCM" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
        </div>       
        <div class="orcamento"style="margin: 2px 0px 53px 0px;">
            <div class="card-head"style=" padding-right: 2140px;">
                <h3>Informações do Evento</h3>
            </div>
            <div class="div-input" id="divEvento">
                <label for="Evento">Nome Evento</label>
                <input type="text" value="" name="Evento" id="Evento" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divLocal">
                <label for="Local">Local</label>
                <input type="text" value="" name="Local" id="Local" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div> 
            <div class="div-input" id="divEntrega">
                <label for="Entrega">Data de Entrega</label>
                <input type="date" value="" name="Entrega" id="Entrega" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divDatade">
                <label for="Datade">Data de:</label>
                <input type="date" value="" name="Datade" id="Datade" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divDataAte">
                <label for="DataAte">Data ate:</label>
                <input type="date" value="" name="DataAte" id="DataAte" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divEstado">
                <label for="Estado"></label>
                <input type="hidden" value="" name="Estado" id="Estado" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
                <div class="div-input" id="divRG">
                <label for="RG"></label>
                <input type="hidden" value="" name="RG" id="RG" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
                <div class="div-input" id="divCCM">
                <label for="CCM"></label>
                <input type="hidden" value="" name="CCM" id="CCM" style="width: 200px; padding: 5px; box-sizing: border-box;">
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
                    <th >Imagem</th>
                    <th >Tipo</th>
                    <th >Modelo</th>
                    <th >Cor</th>
                    <th style="padding-right: 60px;">Valor</th>
                    <th style="padding-right: 7px;">Quantidade</th>
                    <th style="padding-right: 80px;">Total: </th>
                    <th style="padding-right: 20px;">Selecione</th>
                    <th style="padding-right: 0px;">Desconto</th>
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
                    <tr>
                        <td>
                            <div class="image-container">
                                <img src="<?= htmlspecialchars($value["IMAGEM"], ENT_QUOTES, 'UTF-8') ?>" alt="Imagem">
                            </div>
                        </td>
                        <td><?= $value["TIPO"] ?></td>
                        <td><?= $value["MODELOS"] ?></td>
                        <td><?= $value["COR"] ?></td>
                        <td id="valor_<?= $value['IDTIPO'] ?>"><?=" R$ ". $value["VALOR"] ?></td>

                        <td class="div-input" style="width: 80px;height: 0px;margin-left: 12px;margin-top: 27px;">
                            <input type="number" name="QUANTIDADE" id="divQuantidade_<?= $value['IDTIPO']?>">
                        </td>

                        <td id="result_<?= $value['IDTIPO'] ?>">R$ 0.00</td>

                        <td style="text-align: center;">
                        <input type="checkbox" name="product_checkbox[]" id="product_checkbox_<?= $value['IDTIPO'] ?>">
                        </td>
                        
                        <td class="div-input" style="width: 80px;height: 0px;margin-left: 12px;margin-top: 27px;">
                            <input type="number" name="desconto" id="divdesconto_<?= $value['IDTIPO']?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5"></td>
                    <td style="padding-left: 187px;"><b>Total:</b></td>
                    <td id="total_valor">R$ 0.00</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td style="text-align: right;"><b>Desconto:</b></td>
                    <td ><input type="number" id="frete" name="frete"></td>
                    <td></td>
                </tr>
                    <tr>
                        <td colspan="15">
                            <button type="button" id="orcamentoForm">Imprimir Orçamento</button>
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