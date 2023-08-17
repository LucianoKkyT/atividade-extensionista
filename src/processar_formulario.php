<?php
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
        // Enviar email com os detalhes do formulário
        $to = "devleandrocoelho@gmail.com"; // Substitua pelo seu endereço de e-mail
        $subject = "Nova candidatura de $nome";
        $message = "Nome: $nome\nE-mail: $email\nCidade: $cidade\nBairro: $bairro\nTelefone: $telefone";
        $headers = "From: $email";

        if (mail($to, $subject, $message, $headers)) {
            echo "Formulário enviado com sucesso. Obrigado!";
        } else {
            echo "Ocorreu um erro ao enviar o formulário.";
        }
    } else {
        echo "Ocorreu um erro ao fazer o upload do currículo.";
    }
}
?>
