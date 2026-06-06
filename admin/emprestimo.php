<?php
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    // recebemos os dados do formulário
    $cpf = htmlspecialchars(preg_replace('/\D/', '', $_POST['cpf']));
    $idjogo = htmlspecialchars(intval($_POST["idjogo"]));
    $dataemprestimo = date('Y-m-d');

    if (date('w', strtotime('+3 days')) == 0) {
        $dataentrega = date('Y-m-d', strtotime('+4 days'));
    } else {
        $dataentrega = date('Y-m-d', strtotime('+3 days'));
    }

    $sql = "INSERT INTO EMPRESTIMOS (ID_JOGO, CPF, DATA_EMPRESTIMO, DATA_ENTREGA) "
        . " VALUES (:idjogo, :cpf, :dataemprestimo, :dataentrega)";
    
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":idjogo", $idjogo);
    $comando->bindParam(":cpf", $cpf);
    $comando->bindParam(":dataemprestimo", $dataemprestimo);
    $comando->bindParam(":dataentrega", $dataentrega);

    $sucesso = $comando->execute();
    if ($sucesso) {
        header("Location: listar-emprestimos.php");
        exit;
    }
?>
<h1 style="color: red">FALHA NA INCLUSÃO</h1>