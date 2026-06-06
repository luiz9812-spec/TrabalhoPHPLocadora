<?php
    require('../conexao.php');
    require('../funcoes.php');

    autenticarAdmin();

    $id = intval($_POST['id']);


    $nome = htmlspecialchars($_POST["nome"]);
    $desenvolvedora = htmlspecialchars($_POST["desenvolvedora"]);
    $lancamento = htmlspecialchars(intval($_POST["lancamento"]));
    $publisher = htmlspecialchars($_POST["publisher"]);
    $jogadores = htmlspecialchars(intval($_POST["jogadores"]));
    $descricao = htmlspecialchars($_POST["descricao"]);
    $plataforma = htmlspecialchars($_POST["plataforma"]);

    $nomeArquivo = $id;
    $nomeArquivo .= '.png';

    $arquivo = $_FILES['imagem'];
    var_dump($_FILES['imagem']);
    $destino = __DIR__ . "/../img/jogos/" . $nomeArquivo;

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);
    }

    $sql = "UPDATE JOGOS SET NOME = :nome, ID_DESENVOLVEDORA = :desenvolvedora, LANCAMENTO = :lancamento, ID_PUBLISHER = :publisher, JOGADORES = :jogadores, DESCRICAO = :descricao, ID_PLATAFORMA = :plataforma  WHERE ID_JOGO = :id";
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":nome", $nome);
    $comando->bindParam(":desenvolvedora", $desenvolvedora);
    $comando->bindParam(":lancamento", $lancamento);
    $comando->bindParam(":publisher", $publisher);
    $comando->bindParam(":jogadores", $jogadores);
    $comando->bindParam(":descricao", $descricao);
    $comando->bindParam(":plataforma", $plataforma);
    $comando->bindParam(":id", $id, PDO::PARAM_INT);
    $sucesso = $comando->execute();

    if ($sucesso) {
        $sqlDel = "DELETE FROM GENEROS WHERE ID_JOGO = :id";
        $stmtDel = $pdo->prepare($sqlDel);
        $stmtDel->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDel->execute();
        // 2. Insere os novos gêneros selecionados
        $sqlIns = "INSERT INTO GENEROS (ID_JOGO, ID_LISTAGENERO) VALUES (:id, :genero)";
        $stmtIns = $pdo->prepare($sqlIns);
        foreach ($_POST['generos'] as $genero) {
            $stmtIns->execute([
                ':id' => $id,
                ':genero' => intval($genero)
            ]);
        }
    }
    
    if ($sucesso) {
        header("Location: listar-jogos.php");
    }
?>
<h1 style="color: red">FALHA NA ALTERAÇÃO DO PRODUTO</h1>