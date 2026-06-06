<?php
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    // recebemos os dados do formulário
    $titulo = htmlspecialchars($_POST["titulo"]);
    $autor = htmlspecialchars($_POST["autor"]);
    $corpo = htmlspecialchars($_POST["corpo"]);
    $credito = htmlspecialchars($_POST["credito"]);

    $sql = "INSERT INTO NOTICIAS (TITULO, CORPO, AUTOR, CREDITO) VALUES (:titulo, :corpo, :autor, :credito)";
    
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":titulo", $titulo);
    $comando->bindParam(":corpo", $corpo);
    $comando->bindParam(":autor", $autor);
    $comando->bindParam(":credito", $credito);

    $sucesso = $comando->execute();

    $idNoticia = $pdo->lastInsertId();

    $nomeArquivo = $idNoticia;
    $nomeArquivo .= '.png';

    $arquivo = $_FILES['imagem'];
    var_dump($_FILES['imagem']);
    $destino = __DIR__ . "/../img/noticias/" . $nomeArquivo;

    move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);

    if ($sucesso) {
        header("Location: listar-noticias.php");
        exit;
    }
?>
<h1 style="color: red">FALHA NA INCLUSÃO</h1>