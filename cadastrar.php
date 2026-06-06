<?php
    require("conexao.php");

    require('funcoes.php');


    // recebemos os dados do formulário
    $cpf = htmlspecialchars(preg_replace('/\D/', '', $_POST['cpf']));
    $nome = htmlspecialchars($_POST['nome']);
    $nascimento = htmlspecialchars($_POST["nascimento"]);
    $endereco = htmlspecialchars($_POST["endereco"]);
    $cidade = htmlspecialchars($_POST["cidade"]);
    $estado = htmlspecialchars($_POST["estado"]);
    $telefone = htmlspecialchars(preg_replace('/\D/', '', $_POST['telefone']));
    $email = htmlspecialchars($_POST["email"]);
    $senha1 = htmlspecialchars($_POST["senha1"]);
    $senha2 = htmlspecialchars($_POST["senha2"]);

    validar_cpf($cpf);

    if (!validar_cpf($cpf)) {
        die("CPF inválido PHP");
    }

    $senha = password_hash($senha1, PASSWORD_DEFAULT);

    $sql = "INSERT INTO CLIENTES (CPF, NOME, NASCIMENTO, ENDERECO, CIDADE, ESTADO, TELEFONE, EMAIL, SENHA) VALUES (:cpf, :nome, :nascimento, :endereco, :cidade, :estado, :telefone, :email, :senha)";
    
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":cpf", $cpf);
    $comando->bindParam(":nome", $nome);
    $comando->bindParam(":nascimento", $nascimento);
    $comando->bindParam(":endereco", $endereco);
    $comando->bindParam(":cidade", $cidade);
    $comando->bindParam(":estado", $estado);
    $comando->bindParam(":telefone", $telefone);
    $comando->bindParam(":email", $email);
    $comando->bindParam(":senha", $senha);


    $sucesso = $comando->execute();
    if ($sucesso) {
        header("Location: index.php");
    }
?>
<h1 style="color: red">FALHA NA INCLUSÃO</h1>