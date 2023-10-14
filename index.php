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
            <div style="display: flex; justify-content: center !important;" class="card-head">
                <h3>Bem vindo á E.R.E</h3>
        </div>
       
    </main>
    
    <footer>
        <span>&copy; Feito por Henrique</span>           

    </footer>
    
</body>
</html>