<?php
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    // recebemos os dados do formulário
    $nome = htmlspecialchars($_POST["nome"]);
    $desenvolvedora = htmlspecialchars(intval($_POST["desenvolvedora"]));

    $nomeArquivo = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nome);
    $nomeArquivo .= '.png';

    $arquivo = $_FILES['imagem'];
    var_dump($_FILES['imagem']);
    $destino = __DIR__ . "/../img/plataforma/" . $nomeArquivo;

    move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);

    $sql = "INSERT INTO PLATAFORMAS (NOME, ID_DESENVOLVEDORA) "
        . " VALUES (:nome, :desenvolvedora)";
    
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":nome", $nome);
    $comando->bindParam(":desenvolvedora", $desenvolvedora);

    $sucesso = $comando->execute();
    if ($sucesso) {
        header("Location: listar-plataformas.php");
        exit;
    }
?>
<h1 style="color: red">FALHA NA INCLUSÃO</h1>