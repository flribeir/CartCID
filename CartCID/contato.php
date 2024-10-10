<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Carteirinha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Inputmask Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.7/inputmask.min.js"></script>

    <style>
        body {
            background-image: url('background.jpg');
            background-size: cover;
            /* A imagem cobre a tela inteira */
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Mantém a imagem fixa enquanto rola */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Cadastro de Carteirinha</h2>

        <?php
        // Conexão com o banco de dados
        $servername = "127.0.0.1";
        $username = "root";
        $password = "univesp";
        $dbname = "CartCID";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta SQL para obter os valores de Doencas
            $query = "SELECT ID, CID, Nome FROM Doencas";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            // Armazenando resultados em uma lista para o select
            $doencas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        }
        ?>

        <form action="processar_formulario.php" method="POST">
            <div class="row">
                <!-- Nome -->
                <div class="col-md-6 mb-3">
                    <label for="Nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="Nome" name="Nome" maxlength="150">
                </div>
                <!-- CPF -->
                <div class="col-md-3 mb-3">
                    <label for="CPF" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="CPF" name="CPF">
                </div>
                <!-- RG -->
                <div class="col-md-3 mb-3">
                    <label for="RG" class="form-label">RG</label>
                    <input type="text" class="form-control" id="RG" name="RG" maxlength="25">
                </div>
            </div>

            <div class="row">
                <!-- RG Orgao Expeditor -->
                <div class="col-md-3 mb-3">
                    <label for="RG_Orgao_Expeditor" class="form-label">Órgão Expedidor do RG</label>
                    <input type="text" class="form-control" id="RG_Orgao_Expeditor" name="RG_Orgao_Expeditor" maxlength="25">
                </div>
                <!-- RG Data Expeditor -->
                <div class="col-md-3 mb-3">
                    <label for="RG_Data_Expeditor" class="form-label">Data de Expedição do RG</label>
                    <input type="date" class="form-control" id="RG_Data_Expeditor" name="RG_Data_Expeditor">
                </div>
                <!-- Sexo -->
                <div class="col-md-3 mb-3">
                    <label for="Sexo" class="form-label">Sexo</label>
                    <select class="form-select" id="Sexo" name="Sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <!-- Tipo Sanguíneo -->
                <div class="col-md-3 mb-3">
                    <label for="Tipo_Sanguineo" class="form-label">Tipo Sanguíneo</label>
                    <select class="form-select" id="Tipo_Sanguineo" name="Tipo_Sanguineo">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <!-- Data de Nascimento -->
                <div class="col-md-3 mb-3">
                    <label for="Dt_Nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="Dt_Nascimento" name="Dt_Nascimento">
                </div>
                <!-- Celular -->
                <div class="col-md-3 mb-3">
                    <label for="Celular" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="Celular" name="Celular">
                </div>
                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" maxlength="100">
                </div>
            </div>

            <div class="row">
                <!-- Naturalidade -->
                <div class="col-md-3 mb-3">
                    <label for="Naturalidade" class="form-label">Naturalidade</label>
                    <input type="text" class="form-control" id="Naturalidade" name="Naturalidade" maxlength="25">
                </div>
                <!-- Nacionalidade -->
                <div class="col-md-3 mb-3">
                    <label for="Nacionalidade" class="form-label">Nacionalidade</label>
                    <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" maxlength="25">
                </div>
                <!-- Nome Pai -->
                <div class="col-md-6 mb-3">
                    <label for="Nome_Pai" class="form-label">Nome do Pai</label>
                    <input type="text" class="form-control" id="Nome_Pai" name="Nome_Pai" maxlength="150">
                </div>
            </div>

            <div class="row">
                <!-- Nome Mãe -->
                <div class="col-md-6 mb-3">
                    <label for="Nome_Mae" class="form-label">Nome da Mãe</label>
                    <input type="text" class="form-control" id="Nome_Mae" name="Nome_Mae" maxlength="150">
                </div>
                <!-- Nome Responsável -->
                <div class="col-md-6 mb-3">
                    <label for="Nome_Responsavel" class="form-label">Nome do Responsável</label>
                    <input type="text" class="form-control" id="Nome_Responsavel" name="Nome_Responsavel" maxlength="150">
                </div>
            </div>

            <div class="row">
                <!-- Telefone Responsável -->
                <div class="col-md-3 mb-3">
                    <label for="Telefone_Responsavel" class="form-label">Telefone do Responsável</label>
                    <input type="text" class="form-control" id="Telefone_Responsavel" name="Telefone_Responsavel" maxlength="25">
                </div>
                <!-- Email Responsável -->
                <div class="col-md-6 mb-3">
                    <label for="Email_Responsavel" class="form-label">Email do Responsável</label>
                    <input type="email" class="form-control" id="Email_Responsavel" name="Email_Responsavel" maxlength="100">
                </div>
            </div>

            <div class="row">
                <!-- CEP -->
                <div class="col-md-3 mb-3">
                    <label for="CEP" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="CEP" name="CEP" maxlength="9">
                </div>
                <!-- Endereço -->
                <div class="col-md-6 mb-3">
                    <label for="Endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="Endereco" name="Endereco" maxlength="255">
                </div>
                <!-- Número -->
                <div class="col-md-3 mb-3">
                    <label for="Numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="Numero" name="Numero" maxlength="5">
                </div>
            </div>

            <div class="row">
                <!-- Complemento -->
                <div class="col-md-3 mb-3">
                    <label for="Complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="Complemento" name="Complemento" maxlength="75">
                </div>
                <!-- Bairro -->
                <div class="col-md-3 mb-3">
                    <label for="Bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="Bairro" name="Bairro" maxlength="100">
                </div>
                <!-- Cidade -->
                <div class="col-md-3 mb-3">
                    <label for="Cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="Cidade" name="Cidade" maxlength="75">
                </div>
                <!-- UF -->
                <div class="col-md-3 mb-3">
                    <label for="UF" class="form-label">Estado (UF)</label>
                    <select class="form-select" id="UF" name="UF">
                        <option value="AC">Acre (AC)</option>
                        <option value="AL">Alagoas (AL)</option>
                        <option value="AP">Amapá (AP)</option>
                        <option value="AM">Amazonas (AM)</option>
                        <option value="BA">Bahia (BA)</option>
                        <option value="CE">Ceará (CE)</option>
                        <option value="DF">Distrito Federal (DF)</option>
                        <option value="ES">Espírito Santo (ES)</option>
                        <option value="GO">Goiás (GO)</option>
                        <option value="MA">Maranhão (MA)</option>
                        <option value="MT">Mato Grosso (MT)</option>
                        <option value="MS">Mato Grosso do Sul (MS)</option>
                        <option value="MG">Minas Gerais (MG)</option>
                        <option value="PA">Pará (PA)</option>
                        <option value="PB">Paraíba (PB)</option>
                        <option value="PR">Paraná (PR)</option>
                        <option value="PE">Pernambuco (PE)</option>
                        <option value="PI">Piauí (PI)</option>
                        <option value="RJ">Rio de Janeiro (RJ)</option>
                        <option value="RN">Rio Grande do Norte (RN)</option>
                        <option value="RS">Rio Grande do Sul (RS)</option>
                        <option value="RO">Rondônia (RO)</option>
                        <option value="RR">Roraima (RR)</option>
                        <option value="SC">Santa Catarina (SC)</option>
                        <option value="SP">São Paulo (SP)</option>
                        <option value="SE">Sergipe (SE)</option>
                        <option value="TO">Tocantins (TO)</option>
                    </select>
                </div>
                <!-- CID modificado para select -->
                <div class="col-md-3 mb-3">
                    <label for="CID" class="form-label">CID</label>
                    <select class="form-select" id="CID" name="CID">
                        <option value="">Selecione o CID</option>
                        <?php
                        // Gera as opções no formato "CID - Nome"
                        foreach ($doencas as $doenca) {
                            echo "<option value='{$doenca['ID']}'>{$doenca['CID']} - {$doenca['Nome']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Botão de Enviar -->
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>

</html>