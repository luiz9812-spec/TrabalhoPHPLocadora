<?php
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    // recebemos os dados do formulário
    $id = intval($_POST['id']);
    $devolvido = htmlspecialchars($_POST["devolvido"]);

    $sql = "UPDATE RESERVAS SET  FINALIZAR_RESERVA = :devolvido WHERE ID_RESERVA = :id";
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":devolvido", $devolvido);
    $comando->bindParam(":id", $id);

    $sucesso = $comando->execute();
    if ($sucesso) {
        header("Location: listar-reservas.php");
        exit;
    }
?>
<h1 style="color: red">FALHA NA INCLUSÃO</h1>