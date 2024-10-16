<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Configuração da conexão ao banco de dados
    $servername = "127.0.0.1";
    $username   = "root";
    $password   = "univesp";
    $dbname     = "CartCID";
    $ID         = isset($_GET['id']) ? intval($_GET['id']) : (isset($_POST['id']) ? intval($_POST['id']) : 0);
    //    die('aki' . $ID);

    // Conectando ao banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT c.ID,
       c.Nome,
       c.Tipo_Sanguineo,
       c.RG,
       c.Dt_Nascimento,
       c.Naturalidade,
       CASE
          WHEN c.Nome_Pai IS NOT NULL
          THEN CONCAT(c.Nome_Mae, ' e ', c.Nome_Pai)
          ELSE c.Nome_Mae
       END Filiacao,
       CONCAT(c.Endereco,',',c.Numero) Endereco,
       c.Bairro,
       c.Cidade,
       c.UF
  FROM Carteirinha c
 WHERE ID = " . $ID;
    //    die($sql);

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id); // Supondo que $id contém o ID desejado
    $stmt->execute();
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    // Cria o conteúdo HTML da carteirinha
    $html = '<!DOCTYPE html>
    <html lang="pt-BR">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carteirinha de Identificação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            width: 600px;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header, .card-body, .card-footer {
            text-align: center;
        }
        .card-header img {
            width: 80px;
            vertical-align: middle;
        }
        .card-header h1 {
            font-size: 20px;
            margin: 5px 0;
        }
        .card-header p {
            font-size: 12px;
            margin: 0;
            line-height: 1.2;
        }
        .card-body {
            margin-top: 20px;
            text-align: left;
        }
        .card-body .section {
            margin-bottom: 10px;
        }
        .card-body .label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }
        .card-body img {
            float: left;
            width: 100px;
            height: auto;
            margin-right: 20px;
            border-radius: 10px;
        }
        .card-footer img {
            width: 60px;
            margin-top: 20px;
        }
        .ribbon {
            float: right;
            width: 40px;
        }

    </style>
    </head>
    <body>

    <div class="card">
        <div class="card-header">
            <img src="logo_rs.png" alt="Logo do Estado">
            <h1>CARTEIRA DE IDENTIFICAÇÃO DA PESSOA COM AUTISMO</h1>
            <p>GOVERNO DO ESTADO DE SÃO PAULO<br>
            SECRETARIA DA IGUALDADE, CIDADANIA,<br>
            DIREITOS HUMANOS E ASSISTÊNCIA SOCIAL<br>
            FUNDAÇÃO DE ARTICULAÇÃO E DESENVOLVIMENTO<br>
            DE POLÍTICAS PÚBLICAS PARA PESSOAS COM DEFICIÊNCIA<br>
            E PESSOAS COM ALTAS HABILIDADES EM SP</p>
        </div>

        <div class="card-body">
            <img src="avatar.png" alt="Foto da Pessoa">
            <img src="ribbon.png" class="ribbon" alt="Laço colorido">

            <div class="section">
                <span class="label">Nome:</span>' . htmlspecialchars($registro['Nome']) . '<br>
                <span class="label">Número:</span> ' . htmlspecialchars($registro['ID']) . '
            </div>

            <div class="section">
                <span class="label">Tipo Sanguíneo:</span>' . htmlspecialchars($registro['Tipo_Sanguineo']) . '<br>
                <span class="label">RG:</span>' . htmlspecialchars($registro['RG']) . '<br>
                <span class="label">Data de Nascimento:</span>' . htmlspecialchars($registro['Dt_Nascimento']) . '
            </div>

            <div class="section">
                <span class="label">Local de Nascimento:</span>' . htmlspecialchars($registro['Naturalidade']) . '<br>
                <span class="label">Filiação:</span>' . htmlspecialchars($registro['Filiacao']) . '
            </div>

            <div class="section">
                <span class="label">Endereço Residencial:</span>' . htmlspecialchars($registro['Endereco']) . ' - ' .
        htmlspecialchars($registro['Bairro'])   . ', '  .
        htmlspecialchars($registro['Cidade'])   . '/'   .
        htmlspecialchars($registro['UF']) . '
            </div>
        </div>

        <div class="card-footer">
            <img src="logo_faders.png" alt="Logo da Faders">
        </div>
    </div>

    </body>
    </html>
    ';

    // Incluir a biblioteca TCPDF
    require_once('/usr/share/php/tcpdf/tcpdf.php'); // Atualize o caminho conforme necessário

    // Criar uma nova instância do TCPDF
    $pdf = new \TCPDF();

    // Remover cabeçalho e rodapé padrão
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Adicionar uma página
    $pdf->AddPage();

    // Definir a fonte
    $pdf->SetFont('helvetica', '', 12);

    // Escrever o conteúdo HTML no PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Forçar o download do PDF
    $pdf->Output('carteirinha.pdf', 'I');

    //    echo ($html);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados
$conn = null;
