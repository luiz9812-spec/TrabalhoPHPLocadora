<?php 
    require("conexao.php");

    session_start();

    require('funcoes.php');

    $usuario = $_POST['login'];
    $senha   = $_POST['senha'];

    $admin = validar_admin($pdo, $usuario, $senha);

    if ($admin) {
        $_SESSION['admin'] = [
            'nome' => $admin['NOME']
        ];

        header('Location: index.php');
        exit;
    }

    $cliente = validar_cliente($pdo, $usuario, $senha);

    if ($cliente) {
        $_SESSION['cliente'] = [
            'cpf' => $cliente['CPF'],
            'nome' => $cliente['NOME'],
            'nascimento' => $cliente['NASCIMENTO'],
            'endereco' => $cliente['ENDERECO'],
            'cidade' => $cliente['CIDADE'],
            'estado' => $cliente['ESTADO'],
            'telefone' => $cliente['TELEFONE'],
            'email' => $cliente['EMAIL']
        ];

        header("Location: index.php");
        exit;
    } else {
        echo    "<script>
                    alert('Usuário ou senha inválidos!');
                    window.location.href = 'index.php';
                </script>";

        exit;
    }

    // Se continuar aqui,o login foi inválido, mostramos o elemento
    // <h1> em vermelho:
?>