<?php
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    // recebemos os dados do formulário
    $id = intval($_POST['id']);
    $cpf = htmlspecialchars(preg_replace('/\D/', '', $_POST['cpf']));
    $idjogo = htmlspecialchars(intval($_POST["idjogo"]));
    $emprestimo = htmlspecialchars($_POST["emprestimo"]);
    $entrega = htmlspecialchars($_POST["entrega"]);
    $devolvido = htmlspecialchars($_POST["devolvido"]);

    $sql = "UPDATE EMPRESTIMOS SET CPF = :cpf, ID_JOGO = :idjogo, DATA_EMPRESTIMO = :emprestimo, DATA_ENTREGA = :entrega, DEVOLVIDO = :devolvido WHERE ID_EMPRESTIMO = :id";
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":cpf", $cpf);
    $comando->bindParam(":idjogo", $idjogo);
    $comando->bindParam(":emprestimo", $emprestimo);
    $comando->bindParam(":entrega", $entrega);
    $comando->bindParam(":devolvido", $devolvido);
    $comando->bindParam(":id", $id);

    $sucesso = $comando->execute();
    if ($sucesso) {
        header("Location: listar-emprestimos.php");
        exit;
    }
?>
<h1 style="color: red">FALHA NA INCLUSÃO</h1>