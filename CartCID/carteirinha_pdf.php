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
    $fotoDir    = "files/fotos/" . $ID . "_foto.PNG";
    $APIQRCode  = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . $ID;
    //    die('aki' . $ID);

    // Conectando ao banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT c.ID,
       c.Nome,
       c.Tipo_Sanguineo,
       c.RG,
       c.CPF,
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
       c.UF,
       c.QRCode,
       c.Dt_Validade
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
        @media print {
            body {
                width: 15cm;
                height: 10cm;
                margin: 0;
                padding: 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            td {
                padding: 5px;
                vertical-align: top;
            }

            img {
                display: block;
                max-width: 100%;
                height: auto;
            }

            .logo img, .foto img, .qrcode img {
                max-width: 100%;
                height: auto;
            }

            .logo {
                text-align: center;
            }

            .titulo {
                text-align: center;
                font-size: 10pt;
                font-weight: bold;
            }

            .foto {
                text-align: center;
                border: 1px solid black;
                height: 5cm; /* Altura aproximada para a foto */
                width: 4cm; /* Largura aproximada para a foto */
            }

            p {
                margin: 0;
                font-size: 10pt;
                text-align: center;
            }

            .bold {
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td class="logo" colspan="1" width="25%">
                <img src="https://servicos.prefeituradearuja.sp.gov.br/tbw/imagens/system/login/img-cliente.fw.png" alt="Logo" style="width: 80px; height: 80px;">
            </td>
            <td colspan="4" width="75%">
                <p class="titulo">
                    GOVERNO DO ESTADO DE SÃO PAULO<br>
                    PREFEITURA DE ARUJÁ
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p class="titulo">CARTEIRINHA DE IDENTIFICAÇÃO DE PESSOA COM AUTISMO</p>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <p class="titulo">Nome: ' . htmlspecialchars($registro['Nome']) . '</p>
            </td>
        </tr>
        <tr>
            <td colspan="2" rowspan="6" class="foto">
                <img src="' . $fotoDir . '" alt="Foto" style="width: 100px; height: 151px;">
            </td>
            <td>
                <p class="titulo">Tipo Sanguíneo</p>
            </td>
            <td>
                <p class="titulo">CPF</p>
            </td>
            <td>
                <p class="titulo">Data de Nascimento</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>' . htmlspecialchars($registro['Tipo_Sanguineo']) . '</p>
            </td>
            <td>
                <p>' . htmlspecialchars($registro['CPF']) . '</p>
            </td>
            <td>
                <p>' . htmlspecialchars($registro['Dt_Nascimento']) . '</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p class="titulo">Local de Nascimento</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p>' . htmlspecialchars($registro['Naturalidade']) . '</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p class="titulo">FILIAÇÃO</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p>' . htmlspecialchars($registro['Filiacao']) . '</p>
            </td>
        </tr>
    </table>

    <div style="text-align: center">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . htmlspecialchars($registro['QRCode']) . '" alt="QR Code"  style="width: 100px; height: 100px;">
        <br>
        <p><b>VALIDADE:</b></p>
        <p><b>' . htmlspecialchars($registro['Dt_Validade']) . '</b></p>
    </div>
</body>
</html>
';
    //    die($html);

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
