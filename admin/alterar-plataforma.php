<?php
    require('../conexao.php');
    require('../funcoes.php');

    autenticarAdmin();

    // Recebe dados do formulário
    $id = intval($_POST['id']); // Id da plataforma a ser alterada
    $novoNome = htmlspecialchars($_POST['nome']);
    $desenvolvedora = intval($_POST['desenvolvedora']);

    // Busca o nome antigo para renomear o arquivo
    $sql = "SELECT NOME FROM PLATAFORMAS WHERE ID_PLATAFORMA = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $plataforma = $stmt->fetch(PDO::FETCH_ASSOC);

    $nomeAntigoArquivo = preg_replace('/[^a-zA-Z0-9_-]/', '_', $plataforma['NOME']) . ".png";
    $novoNomeArquivo = preg_replace('/[^a-zA-Z0-9_-]/', '_', $novoNome) . ".png";

    $caminhoAntigo = __DIR__ . "/../img/plataforma/" . $nomeAntigoArquivo;
    $caminhoNovo = __DIR__ . "/../img/plataforma/" . $novoNomeArquivo;

    // Renomeia o arquivo se existir
    if (file_exists($caminhoAntigo)) {
        rename($caminhoAntigo, $caminhoNovo);
    }

    // Se o administrador enviou uma nova imagem, substitui a imagem atual
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoNovo);
    }

    // Atualiza dados da plataforma no banco
    $sql = "UPDATE PLATAFORMAS SET NOME = :nome, ID_DESENVOLVEDORA = :desenvolvedora WHERE ID_PLATAFORMA = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $novoNome);
    $stmt->bindParam(':desenvolvedora', $desenvolvedora);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: listar-plataformas.php");
        exit;
    } else {
        echo "<h1 style='color:red'>Falha na atualização</h1>";
    }
?>