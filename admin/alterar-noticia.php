<?php
    require('../conexao.php');
    require('../funcoes.php');

    autenticarAdmin();

    $id = intval($_POST['id']);

    $id = intval($_POST['id']);
    $titulo = htmlspecialchars($_POST["titulo"]);
    $autor = htmlspecialchars($_POST["autor"]);
    $corpo = htmlspecialchars($_POST["corpo"]);
    $credito = htmlspecialchars($_POST["credito"]);

    $nomeArquivo = $id;
    $nomeArquivo .= '.png';

    $arquivo = $_FILES['imagem'];
    var_dump($_FILES['imagem']);
    $destino = __DIR__ . "/../img/noticias/" . $nomeArquivo;

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);
    }

    $sql = "UPDATE NOTICIAS SET TITULO = :titulo, CORPO = :corpo, AUTOR = :autor, CREDITO = :credito WHERE ID_NOTICIA = :id";
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":titulo", $titulo);
    $comando->bindParam(":corpo", $corpo);
    $comando->bindParam(":autor", $autor);
    $comando->bindParam(":credito", $credito);
    $sucesso = $comando->execute();
    
    if ($sucesso) {
        header("Location: listar-noticias.php");
    }
?>
<h1 style="color: red">FALHA NA ALTERAÇÃO DO PRODUTO</h1>