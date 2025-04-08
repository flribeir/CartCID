<?php
// Configurações para mostrar erros (para fins de desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Definir o cabeçalho para JSON
header("Content-Type: application/json; charset=UTF-8");

// Verifica se o parâmetro 'qrcode' foi passado na URL
if (!isset($_GET['qrcode']) || empty($_GET['qrcode'])) {
    echo json_encode([
        "status" => "error",
        "message" => "O parâmetro 'qrcode' é obrigatório."
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit();
}

// Obtém o QRCode do parâmetro GET
$qrcode = $_GET['qrcode'];

try {
    // Configuração da conexão ao banco de dados
    // Verifica se está em produção ou desenvolvimento
    if (file_exists('production.flag')) {
        // Conexão com o banco de dados
        $servername = "sql206.infinityfree.com";
        $username   = "if0_37631008";
        $password   = "krx5w1X279";
        $dbname     = "if0_37631008_CartCID";
    } else {
        // Desenvolvimento local
        $servername = "127.0.0.1";
        $username   = "root";
        $password   = "univesp";
        $dbname     = "CartCID";
    }

    // Conectando ao banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL para buscar o registro na tabela Carteirinha com o QRCode especificado
    $sql = "SELECT ID,
                   Nome,
                   CPF,
                   QRCode,
                   Dt_Validade
              FROM Carteirinha
             WHERE QRCode = :qrcode";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':qrcode', $qrcode, PDO::PARAM_STR);
    $stmt->execute();

    // Verifica se o registro foi encontrado
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Caminho base para a imagem
        $imageBaseUrl = "http://cartcid.free.nf/files/fotos/";

        // Monta o caminho completo para a imagem baseado no ID
        $imagePath = $imageBaseUrl . $result['ID'] . "_foto.PNG";

        // Se encontrado, retorna os dados em JSON, incluindo o caminho da imagem
        echo json_encode([
            "status" => "success",
            "data" => [
                "Nome"        => $result['Nome'],
                "ID"          => $result['ID'],
                "CPF"         => $result['CPF'],
                "Dt_Validade" => $result['Dt_Validade'],
                "Imagem"      => $imagePath
            ]
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        // Se não encontrado, retorna uma mensagem de erro
        echo json_encode([
            "status"  => "error",
            "message" => "Cadastro Inválido"
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
} catch (PDOException $e) {
    // Retorna uma mensagem de erro em JSON em caso de exceção
    echo json_encode([
        "status" => "error",
        "message" => "Erro no servidor: " . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

// Fecha a conexão com o banco de dados
$conn = null;
