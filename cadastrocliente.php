<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
        <title>E.R.E. Moveis para Locação</title>
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.1.0/vanilla-masker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" crossorigin="anonymous"></script>
        <script src="./js/main.js"></script>
        <script src="./js/cadastrocliente.js"></script>

        
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
                <label for="RazaoSocial">Razão Social</label>
                <input type="text" value="" name="RazaoSocial" id="RazaoSocial" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divEndereco">
                <label for="Endereco">Endereço</label>
                <input type="text" value="" name="Endereco" id="Endereco" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>            
            <div class="div-input" id="divBairro">
                <label for="Bairro">Bairro</label>
                <input type="text" value="" name="Bairro" id="Bairro" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divCep">
                <label for="Cep">Cep</label>
                <input type="text" value="" name="Cep" id="Cep" placeholder="Digite o CEP" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divCpfCnpj">
                <label for="CpfCnpj">CPF/CNPJ</label>
                <input type="text" value="" name="CpfCnpj" id="CpfCnpj" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>            
            <div class="div-input" id="divContato">
                <label for="Contato">Contato</label>
                <input type="text" value="" name="Contato" id="Contato" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divTelefone">
                <label for="Telefone">Telefone</label>
                <input type="text" value="" name="Telefone" id="Telefone" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divWhatsApp">
                <label for="WhatsApp">WhatsApp</label>
                <input type="text" value="" name="WhatsApp" id="WhatsApp" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>
            <div class="div-input" id="divEmail">
                <label for="Email">Email</label>
                <input type="email" value="" name="Email" placeholder="Digite seu e-mail" id="Email" required="True" style="width: 200px; padding: 5px; box-sizing: border-box;">
            </div>           
               
        </div>       
        <div class="show">
            <div class="card-head">
                <h3>Dados Clientes</h3>
                <li><input type="text" id="searchInput" placeholder="Pesquisar produtos..."></li>
            </div>

            <table class="tabelaCliente">

            </table>
    </main>
    
    <footer>
        <span>&copy; Feito por Henrique</span>           
    </footer>
</body>
</html>