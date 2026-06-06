<?php
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();


    // recebemos o id passado pelo clique no link "Excluir" (método GET)
    $id = intval(htmlspecialchars($_GET["id"]));

    $sql = "DELETE FROM JOGOS WHERE ID_PLATAFORMA = :id";
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":id", $id);
    $sucesso = $comando->execute();

    $sql = "DELETE FROM PLATAFORMAS WHERE ID_PLATAFORMA = :id";
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":id", $id);
    $sucesso = $comando->execute();

    if ($sucesso) {
        $arquivo = __DIR__ . "/../img/plataforma/" . $id . ".png";
        if (file_exists($arquivo)) {
            unlink($arquivo);
        }
        // se a exclusão teve sucesso, redirecionamos para a listagem
        header("Location: listar-plataformas.php");
    }
?>
<h1 style="color: red">FALHA NA EXCLUSÃO DO PRODUTO</h1>