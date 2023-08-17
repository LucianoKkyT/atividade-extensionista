<?php
// Configuração de conexão ao banco de dados
$host = "localhost"; // Host do banco de dados
$db_user = "id21099851_userdorh"; // Usuário do banco de dados
$db_pass = "senh@d0RH"; // Senha do banco de dados
$db_name = "id21099851_bancodorh"; // Nome do banco de dados

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Erro de conexão ao banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cidade = $_POST["cidade"];
    $bairro = $_POST["bairro"];
    $telefone = $_POST["telefone"];

    // Processar o upload do arquivo de currículo
    $curriculo_nome = $_FILES["curriculo"]["name"];
    $curriculo_tmp = $_FILES["curriculo"]["tmp_name"];
    $curriculo_destino = "uploads/" . $curriculo_nome;

    if (move_uploaded_file($curriculo_tmp, $curriculo_destino)) {
        // Inserir dados no banco de dados
        $sql = "INSERT INTO candidatos (nome, email, cidade, bairro, telefone, curriculo) VALUES ('$nome', '$email', '$cidade', '$bairro', '$telefone', '$curriculo_nome')";

        if ($conn->query($sql) === TRUE) {
            echo "Formulário enviado com sucesso. Obrigado!";
        } else {
            echo "Erro ao inserir os dados no banco de dados: " . $conn->error;
        }
    } else {
        echo "Ocorreu um erro ao fazer o upload do currículo.";
    }
}

$conn->close();
?>
