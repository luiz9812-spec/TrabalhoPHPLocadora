<?php
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();


    // recebemos o id passado pelo clique no link "Excluir" (método GET)
    $id = intval(htmlspecialchars($_GET["id"]));

    $sql = "DELETE FROM GENEROS WHERE ID_JOGO = :id";
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":id", $id);
    $sucesso = $comando->execute();

    $sql = "DELETE FROM JOGOS WHERE ID_JOGO = :id";
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":id", $id);
    $sucesso = $comando->execute();

    if ($sucesso) {
        $arquivo = __DIR__ . "/../img/jogos/" . $id . ".png";
        if (file_exists($arquivo)) {
            unlink($arquivo);
        }
        // se a exclusão teve sucesso, redirecionamos para a listagem
        header("Location: listar-jogos.php");
    }
?>
<h1 style="color: red">FALHA NA EXCLUSÃO DO PRODUTO</h1>