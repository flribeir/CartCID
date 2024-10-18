<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Carteirinha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Inputmask Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>

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
        $dbname   = "CartCID";

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

        <form action="processar_formulario.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <!-- Nome -->
                <div class="col-md-6 mb-3">
                    <label for="Nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="Nome" name="Nome" maxlength="150" required>
                </div>
                <!-- CPF -->
                <div class="col-md-3 mb-3">
                    <label for="CPF" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="CPF" name="CPF" required>
                </div>
                <!-- RG -->
                <div class="col-md-3 mb-3">
                    <label for="RG" class="form-label">RG</label>
                    <input type="text" class="form-control" id="RG" name="RG" maxlength="25" required>
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
                    <select class="form-select" id="Sexo" name="Sexo" required>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <!-- Tipo Sanguíneo -->
                <div class="col-md-3 mb-3">
                    <label for="Tipo_Sanguineo" class="form-label">Tipo Sanguíneo</label>
                    <select class="form-select" id="Tipo_Sanguineo" name="Tipo_Sanguineo" required>
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
                    <input type="date" class="form-control" id="Dt_Nascimento" name="Dt_Nascimento" required>
                </div>
                <!-- Celular -->
                <div class="col-md-3 mb-3">
                    <label for="Celular" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="Celular" name="Celular" required>
                </div>
                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" maxlength="100" required>
                </div>
            </div>

            <div class="row">
                <!-- Naturalidade -->
                <div class="col-md-3 mb-3">
                    <label for="Naturalidade" class="form-label">Naturalidade</label>
                    <input type="text" class="form-control" id="Naturalidade" name="Naturalidade" maxlength="25" required>
                </div>
                <!-- Nacionalidade -->
                <div class="col-md-3 mb-3">
                    <label for="Nacionalidade" class="form-label">Nacionalidade</label>
                    <input type="text" class="form-control" id="Nacionalidade" name="Nacionalidade" maxlength="25" required>
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
                    <input type="text" class="form-control" id="Nome_Mae" name="Nome_Mae" maxlength="150" required>
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
                    <input type="text" class="form-control" id="CEP" name="CEP" maxlength="9" required>
                </div>
                <!-- Endereço -->
                <div class="col-md-6 mb-3">
                    <label for="Endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="Endereco" name="Endereco" maxlength="255" required>
                </div>
                <!-- Número -->
                <div class="col-md-3 mb-3">
                    <label for="Numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="Numero" name="Numero" maxlength="5" required>
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
                    <input type="text" class="form-control" id="Bairro" name="Bairro" maxlength="100" required>
                </div>
                <!-- Cidade -->
                <div class="col-md-3 mb-3">
                    <label for="Cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="Cidade" name="Cidade" maxlength="75" required>
                </div>
                <!-- UF -->
                <div class="col-md-3 mb-3">
                    <label for="UF" class="form-label">Estado (UF)</label>
                    <select class="form-select" id="UF" name="UF" required>
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
                    <select class="form-select" id="CID" name="CID" required>
                        <option value="">Selecione o CID</option>
                        <?php
                        // Gera as opções no formato "CID - Nome"
                        foreach ($doencas as $doenca) {
                            echo "<option value='{$doenca['ID']}'>{$doenca['CID']} - {$doenca['Nome']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Campos de Upload -->
                <div class="row">
                    <!-- Foto -->
                    <div class="col-md-4 mb-3">
                        <label for="Foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="Foto" name="Foto" accept="image/*" required>
                    </div>
                    <!-- Comprovante de Endereço -->
                    <div class="col-md-4 mb-3">
                        <label for="ComprovanteEndereco" class="form-label">Comprovante de Endereço</label>
                        <input type="file" class="form-control" id="ComprovanteEndereco" name="ComprovanteEndereco" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                    <!-- Laudo Médico -->
                    <div class="col-md-4 mb-3">
                        <label for="LaudoMedico" class="form-label">Laudo Médico</label>
                        <input type="file" class="form-control" id="LaudoMedico" name="LaudoMedico" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                </div>

            </div>
    </div>

    <!-- Botão de Enviar -->
    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <button type="button" class="btn btn-secondary" onclick="window.location.href='index.html'">Cancelar</button>
    </form>
    </div>

    <script>
        $(document).ready(function() {
            // Evento blur no campo CEP
            $('#CEP').on('blur', function() {
                var cep = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos

                if (cep.length === 8) { // Verifica se o CEP tem 8 dígitos
                    // URL da API de consulta
                    var url = `http://cep.republicavirtual.com.br/web_cep.php?cep=${cep}&formato=json`;

                    // Faz a requisição para a API
                    $.getJSON(url, function(data) {
                        if (data.resultado === "1") {
                            // Preenche os campos com os dados retornados
                            $('#Endereco').val(data.logradouro);
                            $('#Bairro').val(data.bairro);
                            $('#Cidade').val(data.cidade);
                            $('#UF').val(data.uf);
                        } else {
                            alert('CEP não encontrado.');
                        }
                    }).fail(function() {
                        alert('Erro ao buscar o CEP. Tente novamente.');
                    });
                } else {
                    alert('Por favor, insira um CEP válido com 8 dígitos.');
                }
            });
        });

        $(document).ready(function() {
            // Validação de e-mail ao sair do campo
            $('#Email').on('blur', function() {
                var email = $(this).val();
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expressão regular para validar e-mails

                if (!emailRegex.test(email)) {
                    alert('Por favor, insira um e-mail válido.');
                    $(this).focus(); // Foca no campo de email novamente
                }
            });

            // Máscara para o campo CEP (formato 00000-000)
            $('#CEP').inputmask('99999-999');

            // Máscara para o campo CPF (formato 000.000.000-00)
            $('#CPF').inputmask('999.999.999-99');

            // Máscara para o campo Celular (formato (00) 00000-0000 ou (00) 0000-0000)
            $('#Celular, #Telefone_Responsavel').inputmask({
                mask: ['(99) 9999-9999', '(99) 99999-9999'], // Formato adaptável para fixo e celular
                keepStatic: true // Escolhe o formato correto dinamicamente
            });



            // Validação de CPF ao sair do campo
            $('#CPF').on('blur', function() {
                var cpf = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
                if (!validarCPF(cpf)) {
                    alert('Por favor, insira um CPF válido.');
                    $(this).focus(); // Foca no campo de CPF novamente
                }
            });

            // Função para validar CPF
            function validarCPF(cpf) {
                if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
                    return false; // Verifica se tem 11 dígitos ou todos são iguais
                }

                var soma = 0;
                var resto;

                // Verificação do primeiro dígito verificador
                for (var i = 1; i <= 9; i++) {
                    soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
                }

                resto = (soma * 10) % 11;
                if ((resto === 10) || (resto === 11)) resto = 0;
                if (resto !== parseInt(cpf.substring(9, 10))) return false;

                soma = 0;
                // Verificação do segundo dígito verificador
                for (i = 1; i <= 10; i++) {
                    soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
                }

                resto = (soma * 10) % 11;
                if ((resto === 10) || (resto === 11)) resto = 0;
                if (resto !== parseInt(cpf.substring(10, 11))) return false;

                return true; // CPF válido
            }
        });
    </script>
</body>

</html>