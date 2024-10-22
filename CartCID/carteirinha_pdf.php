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
       DATE_FORMAT (c.Dt_Nascimento,'%d/%m/%Y') Dt_Nascimento,
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
       DATE_FORMAT (c.Dt_Validade,'%d/%m/%Y') Dt_Validade
  FROM Carteirinha c
 WHERE ID = " . $ID;
    //    die($sql);

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id); // Supondo que $id contém o ID desejado
    $stmt->execute();
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    // Cria o conteúdo HTML da carteirinha
    $html = '
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carteirinha de Identificação</title>
<style>
                            .carteirinha {
                                width: 650px;
                                height: auto;
                                border: 2px solid #000;
                                padding: 10px;
                                box-sizing: border-box;
                                position: relative;
                            }
                            .fundo {
                                background-image: url("background_carteirinha.jpg"); /* Adicione o caminho para seu arquivo PNG */
                                background-size: cover;
                            }
                            .logo {
                                position: absolute;
                                top: 10px;
                                right: 10px;
                                width: 60px;
                                height: 60px;
                            }
                            .qrcode {
                                position: absolute;
                                bottom: 0px;
                                right: 0px;
                                width: 90px;
                                height: 90px;
                                border: 1px solid #000;
                                text-align: center;
                                line-height: 80px;
                            }
                            .validade {
                                position: absolute;
                                bottom: 100px;
                                right: 10px;
                            }
                            .foto {
                                width: 90px;
                                height: 110px;
                                border: 1px solid #000;
                                margin-right: 11px;
                                text-align: center;
                                line-height: 100px;
                                float: left;
                            }
                            .info {
                                overflow: hidden;
                            }
                        </style>
    </head>
<body>
                        <div class="carteirinha fundo">
                            <br>
                            <br>
                            <br><br><br><br>
                            <p><strong> </strong></p>
                            <div class="foto">
                                <img src="' . $fotoDir . '" alt="Foto" class="foto">
                            </div>
                            <div class="info">
                                <p> <strong>Registro:</strong> ' . htmlspecialchars($registro['ID']) . '</p>
                                <p> <strong>Nome:</strong> ' . htmlspecialchars($registro['Nome']) . '</p>
                                <p> <strong>CPF:</strong> ' . htmlspecialchars($registro['CPF']) . '</p>
                                <p> <strong>Nascimento:</strong> ' . htmlspecialchars($registro['Dt_Nascimento']) . '</p>
                                <p> <strong>Naturalidade:</strong> ' . htmlspecialchars($registro['Naturalidade']) . '</p>
                                <p> <strong>UF:</strong> ' . htmlspecialchars($registro['UF']) . '</p>
                            </div>
                            <div class="qrcode">
                                <p><img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data=' . htmlspecialchars($registro['QRCode']) . '" class="qrcode" alt="QR Code"></p>
                            </div>
                            <div class="validade">
                                <p><strong>Validade:</strong> ' . htmlspecialchars($registro['Dt_Validade']) . '</p>
                            </div>
                        </div>
                    </body>
    </html>
    ';

    die($html);

    // Incluir a biblioteca TCPDF
    require_once('/usr/share/php/tcpdf/tcpdf.php'); // Atualize o caminho conforme necessário

    // Criar uma nova instância do TCPDF
    $pdf = new \TCPDF();

    // Remover cabeçalho e rodapé padrão
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    // Definir imagem de fundo
    //    $pdf->Image('background_carteirinha.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

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
