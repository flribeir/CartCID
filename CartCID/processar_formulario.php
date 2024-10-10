<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Configuração da conexão ao banco de dados
    $servername = "127.0.0.1";
    $username   = "root";     // Nome de usuário do banco de dados
    $password   = "univesp";  // Senha do banco de dados
    $dbname     = "CartCID";  // Nome do banco de dados

    // Conectando ao banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Configura o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Captura os dados enviados via POST do formulário
    $nome                 = $_POST['Nome'];
    $cpf                  = $_POST['CPF'];
    $rg                   = $_POST['RG'];
    $rg_orgao_expeditor   = $_POST['RG_Orgao_Expeditor'];
    $rg_data_expeditor    = $_POST['RG_Data_Expeditor'];
    $sexo                 = $_POST['Sexo'];
    $tipo_sanguineo       = $_POST['Tipo_Sanguineo'];
    $dt_nascimento        = $_POST['Dt_Nascimento'];
    $celular              = $_POST['Celular'];
    $email                = $_POST['Email'];
    $naturalidade         = $_POST['Naturalidade'];
    $nacionalidade        = $_POST['Nacionalidade'];
    $nome_pai             = $_POST['Nome_Pai'];
    $nome_mae             = $_POST['Nome_Mae'];
    $nome_responsavel     = $_POST['Nome_Responsavel'];
    $telefone_responsavel = $_POST['Telefone_Responsavel'];
    $email_responsavel    = $_POST['Email_Responsavel'];
    $cep                  = $_POST['CEP'];
    $endereco             = $_POST['Endereco'];
    $numero               = $_POST['Numero'];
    $complemento          = $_POST['Complemento'];
    $bairro               = $_POST['Bairro'];
    $cidade               = $_POST['Cidade'];
    $uf                   = $_POST['UF'];
    $CID                  = $_POST['CID'];

    // SQL para inserir dados na tabela Carteirinha
    $sql = "INSERT INTO Carteirinha (Nome, CPF, RG, RG_Orgao_Expeditor, RG_Data_Expeditor, Sexo, Tipo_Sanguineo, Dt_Nascimento, Celular, Email, Naturalidade, Nacionalidade, Nome_Pai, Nome_Mae, Nome_Responsavel, Telefone_Responsavel, Email_Responsavel, CEP, Endereco, Numero, Complemento, Bairro, Cidade, UF, CID)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração SQL para execução
    $stmt = $conn->prepare($sql);

    // Executa a declaração SQL com os dados capturados
    $stmt->execute([
        $nome,
        $cpf,
        $rg,
        $rg_orgao_expeditor,
        $rg_data_expeditor,
        $sexo,
        $tipo_sanguineo,
        $dt_nascimento,
        $celular,
        $email,
        $naturalidade,
        $nacionalidade,
        $nome_pai,
        $nome_mae,
        $nome_responsavel,
        $telefone_responsavel,
        $email_responsavel,
        $cep,
        $endereco,
        $numero,
        $complemento,
        $bairro,
        $cidade,
        $uf,
        $CID
    ]);

    echo "Cadastro realizado com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados
$conn = null;
