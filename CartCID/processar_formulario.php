<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
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
    $QRCode               = rand(1, 2000);
    $Validade             = new DateTime();
    $Validade->modify('+1 year');
    $Validadetratada      = $Validade->format('Y-m-d H:i:s'); // Formato desejado

    // Verificar se o CPF já existe na tabela
    $sqlCheck = "SELECT COUNT(*) FROM Carteirinha WHERE CPF = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->execute([$cpf]);
    $existe = $stmtCheck->fetchColumn();

    if ($existe > 0) {
        // CPF já cadastrado
        echo "<!DOCTYPE html>
        <html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Erro de CPF</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body class='bg-light'>
            <div class='container mt-5'>
                <div class='alert alert-danger' role='alert'>
                    Este CPF já está cadastrado no sistema!
                </div>
                <a href='javascript:history.back()' class='btn btn-primary'>Voltar</a>
            </div>
        </body>
        </html>";
        exit();
    }

    // SQL para inserir dados na tabela Carteirinha
    $sql = "INSERT INTO Carteirinha (Nome, CPF, RG, RG_Orgao_Expeditor, RG_Data_Expeditor, Sexo, Tipo_Sanguineo, Dt_Nascimento, Celular, Email, Naturalidade, Nacionalidade, Nome_Pai, Nome_Mae, Nome_Responsavel, Telefone_Responsavel, Email_Responsavel, CEP, Endereco, Numero, Complemento, Bairro, Cidade, UF, CID, QRCode, Dt_Validade)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
        $CID,
        $QRCode,
        $Validadetratada
    ]);

    // Obter o ID do último registro inserido
    $lastInsertId = $conn->lastInsertId();

    // Diretórios para salvar arquivos
    $fotoDir        = "files/fotos/";
    $comprovanteDir = "files/comprovante_residencia/";
    $laudoDir       = "files/laudo/";

    // Verifica e cria diretórios, se não existirem
    if (!is_dir($fotoDir)) mkdir($fotoDir, 0777, true);
    if (!is_dir($comprovanteDir)) mkdir($comprovanteDir, 0777, true);
    if (!is_dir($laudoDir)) mkdir($laudoDir, 0777, true);

    // Renomeia e move os arquivos usando $lastInsertId
    $fotoPath        = $fotoDir        . $lastInsertId . "_foto."        . pathinfo($_FILES['Foto']['name'], PATHINFO_EXTENSION);
    $comprovantePath = $comprovanteDir . $lastInsertId . "_comprovante." . pathinfo($_FILES['ComprovanteEndereco']['name'], PATHINFO_EXTENSION);
    $laudoPath       = $laudoDir       . $lastInsertId . "_laudo."       . pathinfo($_FILES['LaudoMedico']['name'], PATHINFO_EXTENSION);

    // Movendo arquivos para os diretórios específicos
    move_uploaded_file($_FILES['Foto']['tmp_name'], $fotoPath);
    move_uploaded_file($_FILES['ComprovanteEndereco']['tmp_name'], $comprovantePath);
    move_uploaded_file($_FILES['LaudoMedico']['tmp_name'], $laudoPath);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit();
}

// Exibe o modal com a carteirinha em PDF
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processamento de Formulário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Modal para exibir o PDF -->
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Carteirinha PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Iframe para carregar carteirinha_pdf.php -->
                    <iframe src="carteirinha_pdf.php?id=<?php echo $lastInsertId; ?>" width="100%" height="600px" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts do Bootstrap e JavaScript para o modal -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <script>
        // Abre o modal automaticamente
        var pdfModal = new bootstrap.Modal(document.getElementById('pdfModal'), {});
        pdfModal.show();

        // Redireciona para index.html ao fechar o modal
        document.getElementById('pdfModal').addEventListener('hidden.bs.modal', function() {
            window.location.href = 'index.html';
        });
    </script>
</body>

</html>