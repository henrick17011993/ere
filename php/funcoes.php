<?php
// printr($_POST);
function conect(){
    try {
        return new PDO("mysql:host=localhost;dbname=cadeira", "root", "");
    } catch (PDOException $e) {
        echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        exit();
    }
}

function show() {
    $conn = conect();
    if (!$conn) {
        return false;
    }

    $SQL = "SELECT * 
            FROM henrimack 
            ORDER BY 
                CASE 
                    WHEN TIPO = 'Banquetas' THEN 1
                    WHEN TIPO = 'Sofá/Poltronas' THEN 2
                    WHEN TIPO = 'Bistrô' THEN 3
                    WHEN TIPO = 'Cadeiras' THEN 4
                    WHEN TIPO = 'Mesareunião' THEN 5
                    WHEN TIPO = 'Mesacanto' THEN 6
                    WHEN TIPO = 'Mesacentro' THEN 7
                    WHEN TIPO = 'Eletro/Acessórios' THEN 999
                    ELSE 8
                END, 
        TIPO DESC;";

    try {
        $stmt = $conn->query($SQL);
        if (!$stmt) {
            return false;
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Manejo de erro apropriado
        echo "Erro: " . $e->getMessage();
        return false;
    }
}



function BuscaDados($id){
    $conn = conect();
    $SQL = "SELECT * FROM henrimack WHERE IDTIPO = :id";
    $query = $conn->prepare($SQL);
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function editar($post){
    $conn = conect();
    $SQL = "UPDATE henrimack 
            SET TIPO = :TIPO, MODELOS = :MODELOS, COR = :COR, VALOR = :VALOR 
            WHERE IDTIPO = :id";
    $query = $conn->prepare($SQL);
    $query->bindParam(":id", $post["id"], PDO::PARAM_INT);
    $query->bindParam(":TIPO", $post["tipo"]);
    $query->bindParam(":MODELOS", $post["modelos"]);
    $query->bindParam(":COR", $post["cor"]);
    $query->bindParam(":VALOR", $post["valor"]);
}

function Deleta($post){
    $conn = conect();
    $SQL = "DELETE FROM henrimack WHERE IDTIPO = :id";
    $query = $conn->prepare($SQL);
    $query->bindParam(":id", $post["id"], PDO::PARAM_INT);
    $query->execute();
}

function DeletaCliente($post){
    $conn = conect();
    $SQL = "DELETE FROM cliente WHERE IDCliente = :IDCliente";
    $query = $conn->prepare($SQL);
    $query->bindParam(":IDCliente", $post["idCliente"], PDO::PARAM_INT);
    
    $query->execute();
}

function BuscaMaxSequencia($conn, $tableName, $id) {
    try {
        $sqlVerificaId = "SELECT COUNT(*) AS count FROM $tableName WHERE id = :id";
        $queryVerificaId = $conn->prepare($sqlVerificaId);
        $queryVerificaId->bindParam(':id', $id);
        $queryVerificaId->execute();

        $result = $queryVerificaId->fetch(PDO::FETCH_ASSOC);
        $count = $result['count'];

        if ($count > 0) {
            $sqlExcluir = "DELETE FROM $tableName WHERE id = :id";
            $queryExcluir = $conn->prepare($sqlExcluir);
            $queryExcluir->bindParam(':id', $id);

            if (!$queryExcluir->execute()) {
                throw new Exception("Erro ao excluir registro da tabela $tableName: " . implode(", ", $queryExcluir->errorInfo()));
            }

            echo "Registro excluído com sucesso!";
        } else {
            echo "Registro não encontrado. Nenhuma exclusão necessária.";
        }
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}

function printr($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;

    if (isset($post['funcao'])) {

        switch ($post['funcao']) {
            case 'Insere':
                Insere($post);
                break;
            case 'Deleta':
                Deleta($post);
                break;
            case 'Orcamento':
                Orcamento($post);
                break;
            case 'Estoque':
                Estoque($post);
                break;
            case 'Cliente':
                Cliente($post);
                break;
            case 'ClienteRepetido':
                ClienteRepetido($post);
                break;
            case 'AtualizarCliente':
                AtualizarCliente($post);
                break;
            case 'DeletaCliente':
                DeletaCliente($post);
                break;
                case 'buscarClientes':
                    $filtro = isset($_POST['filtro']) ? $_POST['filtro'] : null;
                    $clientes = buscarClientes($filtro);
                    echo json_encode($clientes);
                    break;
        }
    }
}

function GerarCodigo($cpfcnpj,$razaoSocial,$codigo) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cadeira";
    
    $conexao = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }
    
    $query ="SELECT pa.codigounico
            FROM orcamento pa
            WHERE pa.cpfcnpj = '$cpfcnpj' AND pa.razaosocial = '$razaoSocial'
            ORDER BY pa.idorcamento DESC
            LIMIT 1";

    $resultado = mysqli_query($conexao, $query);

    if ($resultado) {
        $linha = mysqli_fetch_assoc($resultado);
        $codigounico = $linha['codigounico'];

        $parteNumerica = intval(substr($codigounico, strpos($codigounico, '-') + 1));

        $novoCodigoNumerico = $parteNumerica + 1;

        $primeirasLetras = substr($razaoSocial, 0, 3);
        $primeirosDigitos = substr($cpfcnpj, 0, 3);
        $prefixo = $primeirasLetras . $primeirosDigitos;

        $parteNumericaFormatada = str_pad($novoCodigoNumerico, 4, '0', STR_PAD_LEFT);

        $novoCodigoFormatado = $prefixo . '-' . $parteNumericaFormatada;
        
    } else {
        $inicio = 0000;
        $primeirasLetras = substr($razaoSocial, 0, 3);
        $primeirosDigitos = substr($cpfcnpj, 0, 3);
        
        $prefixo = $primeirasLetras . $primeirosDigitos;

        $novoCodigoFormatado = $prefixo . '-' . $inicio;
        
        return $novoCodigoFormatado; 
    }

    return $novoCodigoFormatado; 
}


function Orcamento($post) {
    try {
        $conn = conect();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dataAtual = date('Y-m-d');

        $razaoSocial = $_POST['razaoSocial'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $cep = $_POST['cep'];
        $WhatsApp = $_POST['WhatsApp'];
        $estado = $_POST['estado'];
        $cpfcnpj = $_POST['cpfcnpj'];
        $rg = $_POST['rg'];
        $ccm = $_POST['ccm'];
        $contato = $_POST['contato'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $nomeEvento = $_POST['nomeEvento'];
        $local = $_POST['local'];
        $data_entrega = $_POST['dataEntrega'];
        $data_de = $_POST['dataDe'];
        $data_ate = $_POST['dataAte'];
        $DAorcfeito = $_POST['dataAte'];

        $codigo = '';
        $codigoUnico = GerarCodigo($cpfcnpj,$razaoSocial,$codigo);

        $sql = "INSERT INTO orcamento (codigounico, razaosocial, endereco, bairro, cep, WhatsApp, estado, cpfcnpj, rg, ccm, contato, telefone, email, nome_evento, local, data_entrega, data_de, data_ate, DAorcfeito) VALUES (:codigounico, :razaosocial, :endereco, :bairro, :cep, :WhatsApp, :estado, :cpfcnpj, :rg, :ccm, :contato, :telefone, :email, :nome_evento, :local, :data_entrega, :data_de, :data_ate, :DAorcfeito)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':codigounico', $codigoUnico);
        $stmt->bindParam(':razaosocial', $razaoSocial);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':WhatsApp', $WhatsApp);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cpfcnpj', $cpfcnpj);
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':ccm', $ccm);
        $stmt->bindParam(':contato', $contato);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nome_evento', $nomeEvento);
        $stmt->bindParam(':local', $local);
        $stmt->bindParam(':data_entrega', $data_entrega);
        $stmt->bindParam(':data_de', $data_de);
        $stmt->bindParam(':data_ate', $data_ate);
        $stmt->bindParam(':DAorcfeito',$dataAtual);

        $stmt->execute();

        $idOrcamento = $conn->lastInsertId();

        if (isset($_POST['checkboxSelections']) && is_array($_POST['checkboxSelections'])) {
            foreach ($_POST['checkboxSelections'] as $checkboxSelection) {
                $checkboxData = json_decode($checkboxSelection, true);

                $sqlProdutos = "INSERT INTO produtos (codigounico, idorcamento, imagem, tipo, modelos, cor, valor, quantidade) VALUES (:codigounico, :idorcamento, :imagem, :tipo, :modelos, :cor, :valor, :quantidade)";

                $stmtProdutos = $conn->prepare($sqlProdutos);

                $stmtProdutos->bindParam(':codigounico', $codigoUnico);
                $stmtProdutos->bindParam(':idorcamento', $idOrcamento);
                $stmtProdutos->bindParam(':imagem', $checkboxData['imagem']);
                $stmtProdutos->bindParam(':tipo', $checkboxData['tipo']);
                $stmtProdutos->bindParam(':modelos', $checkboxData['modelos']);
                $stmtProdutos->bindParam(':cor', $checkboxData['cor']);
                $stmtProdutos->bindParam(':valor', $checkboxData['valor']);
                $stmtProdutos->bindParam(':quantidade', $checkboxData['quantidade']);

                $stmtProdutos->execute();
            }
        }

        echo "Dados inseridos com sucesso!";
    } catch (PDOException $e) {
        echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}

function Insere($post) {
    try {
        $conn = conect();      

        if (empty($post)) {
            throw new Exception("Nenhum dado enviado.");
        }

        $imagem = $_FILES['imagem'];
        $nomeImagem = $imagem['name'];
        $caminhoImagem = 'C:\\xampp\\htdocs\\everton\\uploads\\' . $nomeImagem;
        $urlImagem = '/everton/uploads/' . $nomeImagem; 

        if (!file_exists('C:\\xampp\\htdocs\\everton\\uploads\\')) {
            mkdir('C:\\xampp\\htdocs\\everton\\uploads\\', 0777, true);
        }

        if (move_uploaded_file($imagem['tmp_name'], $caminhoImagem)) {
            $SQL = "INSERT INTO henrimack (TIPO, MODELOS, COR, VALOR, IMAGEM)
                    VALUES (:TIPO, :MODELOS, :COR, :VALOR, :IMAGEM)";

            $query = $conn->prepare($SQL);

            $query->bindParam(":TIPO", $post["tipo"]);
            $query->bindParam(":MODELOS", $post["modelos"]);
            $query->bindParam(":COR", $post["cor"]);
            $query->bindParam(":VALOR", $post["valor"]);
            $query->bindParam(":IMAGEM", $urlImagem); 

            if ($query->execute()) {
                echo "Dados e imagem inseridos com sucesso.";
                return true;
            } else {
                throw new Exception("Erro ao inserir dados: " . implode(", ", $query->errorInfo()));
            }
        } else {
            throw new Exception("Erro ao mover a imagem para o diretório de upload.");
        }
        
        return true;
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
        return false;
    }
}

function printc($data)
{
    echo '<script>';
    echo 'console.log('.json_encode($data).')';
    echo '</script>';
}

function Estoque($post){
    if(isset($post['id']) && isset($post['quantidade'])){
        $id = $post['id'];
        $quantidade = $post['quantidade'];
        
        $conn = conect();

        $sql_verifica = "SELECT COUNT(*) AS count FROM estoque WHERE idproduto = :idproduto";
        $stmt_verifica = $conn->prepare($sql_verifica);
        $stmt_verifica->bindParam(':idproduto', $id);
        $stmt_verifica->execute();
        $resultado = $stmt_verifica->fetch(PDO::FETCH_ASSOC);

        if($resultado['count'] > 0){
            $sql_atualiza = "UPDATE estoque SET Nestoque = :Nestoque WHERE idproduto = :idproduto";
            $stmt_atualiza = $conn->prepare($sql_atualiza);
            $stmt_atualiza->bindParam(':Nestoque', $quantidade);
            $stmt_atualiza->bindParam(':idproduto', $id);
            if($stmt_atualiza->execute()){
                echo "Quantidade de estoque atualizada com sucesso!";
            } else {
                echo "Erro ao atualizar a quantidade de estoque.";
            }
        } else {
            $sql_insere = "INSERT INTO estoque (idproduto, Nestoque) VALUES (:idproduto, :Nestoque)";
            $stmt_insere = $conn->prepare($sql_insere);
            $stmt_insere->bindParam(':idproduto', $id);
            $stmt_insere->bindParam(':Nestoque', $quantidade);
            if($stmt_insere->execute()){
                echo "Quantidade de estoque inserida com sucesso!";
            } else {
                echo "Erro ao inserir a quantidade de estoque.";
            }
        }
    } else {
        echo "Dados não recebidos.";
    }
}

function getPuxarEstoque($idproduto) {
    $conn = conect();
    $stmt = $conn->prepare("SELECT Nestoque FROM estoque WHERE idproduto = :idproduto");
    $stmt->bindParam(':idproduto', $idproduto);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['Nestoque'];
    } else {
        return false;
    }
}

function Cliente($post){
    $conn= conect();
    
    $stmt = $conn->prepare("INSERT INTO cliente (Endereco, Bairro, RazaoSocial, Cep, CpfCnpj, Telefone, WhatsApp, email, Contato) VALUES (:Endereco, :Bairro, :RazaoSocial, :Cep, :CpfCnpj, :Telefone, :WhatsApp, :email, :Contato)");
    $stmt->bindParam(':Endereco', $Endereco);
    $stmt->bindParam(':Bairro', $Bairro);
    $stmt->bindParam(':RazaoSocial', $RazaoSocial);
    $stmt->bindParam(':Cep', $Cep);
    $stmt->bindParam(':CpfCnpj', $CpfCnpj);
    $stmt->bindParam(':Telefone', $Telefone);
    $stmt->bindParam(':WhatsApp', $WhatsApp);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':Contato', $Contato);

    $Endereco = $post['Endereco'];
    $Bairro = $post['Bairro'];
    $RazaoSocial = $post['RazaoSocial'];
    $Cep = $post['Cep'];
    $CpfCnpj = $post['CpfCnpj'];
    $Telefone = $post['Telefone'];
    $WhatsApp = $post['WhatsApp'];
    $email = $post['email'];
    $Contato = $post['Contato'];

    $stmt->execute();

    return "Cliente salvo com sucesso!";
}

function AtualizarCliente($post){
    $conn = conect();

    $stmt = $conn->prepare("UPDATE cliente SET Endereco = :Endereco, Bairro = :Bairro, RazaoSocial = :RazaoSocial, Cep = :Cep, CpfCnpj = :CpfCnpj, Telefone = :Telefone, WhatsApp = :WhatsApp, email = :email, Contato = :Contato WHERE IDCliente = :IDCliente");

    $stmt->bindParam(':Endereco', $Endereco);
    $stmt->bindParam(':Bairro', $Bairro);
    $stmt->bindParam(':RazaoSocial', $RazaoSocial);
    $stmt->bindParam(':Cep', $Cep);
    $stmt->bindParam(':CpfCnpj', $CpfCnpj);
    $stmt->bindParam(':Telefone', $Telefone);
    $stmt->bindParam(':WhatsApp', $WhatsApp);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':Contato', $Contato);
    $stmt->bindParam(':IDCliente', $IDCliente);

    $Endereco = $post['Endereco'];
    $Bairro = $post['Bairro'];
    $RazaoSocial = $post['RazaoSocial'];
    $Cep = $post['Cep'];
    $CpfCnpj = $post['CpfCnpj'];
    $Telefone = $post['Telefone'];
    $WhatsApp = $post['WhatsApp'];
    $email = $post['email'];
    $Contato = $post['Contato'];
    $IDCliente = $post['idCliente'];

    $stmt->execute();

    return "Cliente atualizado com sucesso!";
}

if (isset($_POST['action']) && $_POST['action'] == 'atualizar_tabela') {
    $clientes = buscarClientes();

    // Construa a tabela em HTML
    $html = '<table class="tabelaCliente">';
    $html .= '<thead>';
    $html .= '<tr>';   
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    foreach ($clientes as $cliente) {
        $html .= '<tr>';
        $html .= '<td>' . $cliente['RazaoSocial'] . '</td>';
        $html .= '<td>' . $cliente['Endereco'] . '</td>';
        $html .= '<td>' . $cliente['Bairro'] . '</td>';
        $html .= '<td>' . $cliente['Cep'] . '</td>';
        $html .= '<td>' . $cliente['CpfCnpj'] . '</td>';
        $html .= '<td>' . $cliente['Telefone'] . '</td>';
        $html .= '<td>' . $cliente['WhatsApp'] . '</td>';
        $html .= '<td>' . $cliente['Contato'] . '</td>';
        $html .= '<td>' . $cliente['Email'] . '</td>';
        $html .= '<td>';
        $html .= '<div class="button-group">';
        $html .= '<a class="actions"><button id="buttonEditar_' . $cliente['IDCliente'] . '">✎</button></a>';
        $html .= '<a class="actions"><button id="buttonCancelarEdicao">X</button></a>';
        $html .= '<a class="actions"><button id="buttonExcluir_' . $cliente['IDCliente'] . '">🗑</button></a>';
        $html .= '</div>';
        $html .= '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';

    echo $html;
}

function buscarClientes($filtro = null){
    $conn = conect();

    if (!$conn) {
        return array();
    }
    $sql = "SELECT * FROM cliente";
    if($filtro){
        $sql .= " WHERE $filtro";
    }
    try {
        $result = $conn->query($sql);
    } catch (PDOException $e) {
        $conn = null;
        return array();
    }
    $clientes = array();
    if ($result) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $clientes[] = $row;
        }
    }
    $conn = null; 
    return $clientes;
}

function ClienteRepetido($post){
    $conn = conect(); 
    $campoCC = null;
    $campoRS = null;

    if (isset($post["campo"])) {
        if ($post["campo"] === "CpfCnpj") {
            $campoCC = $post["valor"];
        } else {
            $campoRS = $post["valor"];
        }
    }

    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM cliente WHERE CpfCnpj = :CpfCnpj OR RazaoSocial = :RazaoSocial");

    if ($campoCC !== null) {
        $stmt_check->bindParam(':CpfCnpj', $campoCC);
    } else {
        $stmt_check->bindValue(':CpfCnpj', null, PDO::PARAM_NULL);
    }

    if ($campoRS !== null) {
        $stmt_check->bindParam(':RazaoSocial', $campoRS);
    } else {
        $stmt_check->bindValue(':RazaoSocial', null, PDO::PARAM_NULL);
    }

    $stmt_check->execute();
    $count = $stmt_check->fetchColumn();

    if ($count > 0) {
        echo 'existe';
    }
}

