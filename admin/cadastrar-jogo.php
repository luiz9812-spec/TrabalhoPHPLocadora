<?php
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    // recebemos os dados do formulário
    $nome = htmlspecialchars($_POST["nome"]);
    $desenvolvedora = htmlspecialchars(intval($_POST["desenvolvedora"]));
    $lancamento = htmlspecialchars(intval($_POST["lancamento"]));
    $publisher = htmlspecialchars(intval($_POST["publisher"]));
    $jogadores = htmlspecialchars(intval($_POST["jogadores"]));
    $descricao = htmlspecialchars($_POST["descricao"]);
    $plataforma = htmlspecialchars(intval($_POST["plataforma"]));

    $sql = "INSERT INTO JOGOS (NOME, ID_DESENVOLVEDORA, LANCAMENTO, ID_PUBLISHER, JOGADORES, DESCRICAO, ID_PLATAFORMA) "
        . " VALUES (:nome, :desenvolvedora, :lancamento, :publisher, :jogadores, :descricao, :plataforma)";
    
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":nome", $nome);
    $comando->bindParam(":desenvolvedora", $desenvolvedora);
    $comando->bindParam(":lancamento", $lancamento);
    $comando->bindParam(":publisher", $publisher);
    $comando->bindParam(":jogadores", $jogadores);
    $comando->bindParam(":descricao", $descricao);
    $comando->bindParam(":plataforma", $plataforma);

    $sucesso = $comando->execute();

    $idJogo = $pdo->lastInsertId();

    $nomeArquivo = $idJogo;
    $nomeArquivo .= '.png';

    $arquivo = $_FILES['imagem'];
    var_dump($_FILES['imagem']);
    $destino = __DIR__ . "/../img/jogos/" . $nomeArquivo;

    move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);

    $sqlGenero = "INSERT INTO GENEROS (ID_JOGO, ID_LISTAGENERO)
                  VALUES (:jogo, :genero)";

    $comandoGenero = $pdo->prepare($sqlGenero);

    foreach ($_POST['generos'] as $genero) {
        $comandoGenero->execute([
            ':jogo' => $idJogo,
            ':genero' => $genero
        ]);
    }

    if ($sucesso) {
        header("Location: listar-jogos.php");
        exit;
    }
?>
<h1 style="color: red">FALHA NA INCLUSÃO</h1>