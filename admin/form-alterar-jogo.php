<?php 
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    $id = $_GET['id'];

    $sql = 'SELECT J.ID_JOGO, J.NOME, D.NOME AS DESENVOLVEDORA, J.ID_DESENVOLVEDORA, J.ID_PUBLISHER, J.ID_PLATAFORMA, J.LANCAMENTO, PU.NOME AS PUBLISHER, JOGADORES, DESCRICAO, P.NOME AS PLATAFORMA, DISPONIVEL
    FROM JOGOS J
    INNER JOIN DESENVOLVEDORAS D ON D.ID_DESENVOLVEDORA = J.ID_DESENVOLVEDORA
    INNER JOIN PUBLISHERS PU ON PU.ID_PUBLISHER = J.ID_PUBLISHER
    INNER JOIN PLATAFORMAS P ON P.ID_PLATAFORMA = J.ID_PLATAFORMA
    WHERE ID_JOGO = ?;';
    $comando = $pdo->prepare($sql);
    $comando->execute([$id]);
    $resultado = $comando->fetch();

    $sql = "SELECT ID_LISTAGENERO
        FROM GENEROS
        WHERE ID_JOGO = ?";
    $comando = $pdo->prepare($sql);
    $comando->execute([$id]);

$generosJogo = $comando->fetchAll(PDO::FETCH_COLUMN);

    $sql = "SELECT * FROM DESENVOLVEDORAS";
    $comando = $pdo->query($sql);
    $desenvolvedora = $comando->fetchAll();

    $sql = "SELECT * FROM PUBLISHERS";
    $comando = $pdo->query($sql);
    $publisher = $comando->fetchAll();

    $sql = "SELECT * FROM PLATAFORMAS";
    $comando = $pdo->query($sql);
    $plataforma = $comando->fetchAll();

    $sql = "SELECT * FROM LISTAGENEROS";
    $comando = $pdo->query($sql);
    $listageneros = $comando->fetchAll();

    if (isset($_SESSION['admin'])) {
        $nome = $_SESSION['admin']['nome'];
        $login = '<div class="logado">
                    <img src="" alt="">
                    <p>' . $nome . '</p>
                    <div class="botoes">
                        <form method="POST">
                            <button type="submit" formaction="painel_admin.php">Sessão do Administrador</button>
                            <button type="submit" formaction="../logoff.php">Log-off</button>
                        </form>
                    </div>
                </div>';
    } else if (isset($_SESSION['cliente'])) {
        $nome = $_SESSION['cliente']['nome'];
        $login = '<div class="logado">
                    <img src="" alt="">
                    <p>' . $nome . '</p>
                    <div class="botoes">
                        <form method="POST">
                            <button type="submit" formaction="painel_cliente.php">Sessão do Cliente</button>
                            <button type="submit" formaction="logoff.php">Log-off</button>
                        </form>
                    </div>
                </div>';
    } else {
        $login = '<div class="login">
            <form method="POST">
                <div>
                    <label for="login">Login: </label>
                    <input type="text" id="login" name="login" required>
                </div>
                <div>
                <label for="password">Senha: </label>
                <input type="password" id="senha" name="senha" required>
                </div>
                <div class="botoes">
                    <button type="submit" formaction="login.php">Log-in</button>
                    <button type="submit" formaction="form_cadastrar.php" formnovalidate>Cadastrar</button>
                </div>
            </form>
        </div>';
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Rent - Jogo id = <?= $id ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="cabecalho-main">
        <div class="cabecalho-titulo">
            <img src="" alt="">
            <h1>Game Rent</h1>
            <p>Emprestimo de Games Antigos</p>
        </div>
        <nav class="cabecalho-nav">
            <ul>
                <li><a href="../listaplataforma.php">Lista de Jogos</a></li>
                <li><a href="../noticias.php">Notícias</a></li>
            </ul>
        </nav>
        <?= $login ?>
        <!---->
    </header>
    <main>
        <article class="introducao">
            <ul class="breadcrumb">
                <li><a href="../index.php">Home</a></li>
                <li><a href="./painel_admin.php">Painel Administrador</a></li>
                <li><a href="./listar-jogos.php">Listar Jogos</a></li>
                <li>Alterar Jogo id = <?= $id ?></li>
            </ul>
        </article>
        <h1 class="titulo">Alterar Jogo</h1>
        <section class="tela-cadastro-cliente">
            <form action="alterar-jogo.php" id="form-cadastro" enctype="multipart/form-data" method="POST">
                <div>
                    <label for="nome">Nome: </label>
                    <input type="text" name="nome" id="nome" value="<?= $resultado["NOME"] ?>" required>
                </div>
                <div>
                    <label for="desenvolvedora">Desenvolvedora: </label>
                    <select name="desenvolvedora" id="desenvolvedora">
                        <option value="<?= $resultado["ID_DESENVOLVEDORA"] ?>" selected ><?= $resultado["DESENVOLVEDORA"] ?></option>
                        <?php foreach ($desenvolvedora as $dev) { ?>
                            <option value="<?= $dev['ID_DESENVOLVEDORA'] ?>"><?= $dev['NOME'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="lancamento">Ano de Lançamento: </label>
                    <input type="number" name="lancamento" min="1970" max="2026" step="1" value="<?= $resultado['LANCAMENTO'] ?>">
                </div>
                <div>
                    <label for="publisher">Publisher: </label>
                    <select name="publisher" id="publisher">
                        <option value="<?= $resultado['ID_PUBLISHER'] ?>" selected ><?= $resultado['PUBLISHER'] ?></option>
                        <?php foreach ($publisher as $pub) { ?>
                            <option value="<?= $pub['ID_PUBLISHER'] ?>"><?= $pub['NOME'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="jogadores">Nº de jogadores: </label>
                    <input type="number" name="jogadores" min="1" max="4" step="1" value="<?= $resultado['JOGADORES'] ?>">
                </div>
                <div>
                    <label for="descricao">Descrição: </label>
                    <textarea name="descricao" id="descricao"><?= htmlspecialchars($resultado['DESCRICAO']) ?></textarea>
                </div>
                <div>
                    <label for="plataforma">Plataforma: </label>
                    <select name="plataforma" id="plataforma">
                        <option value="<?= $resultado['ID_PLATAFORMA'] ?>" selected><?= $resultado['PLATAFORMA'] ?></option>
                        <?php foreach ($plataforma as $plat) { ?>
                            <option value="<?= $plat['ID_PLATAFORMA'] ?>"><?= $plat['NOME'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="generos">Gêneros:</label>
                    <select name="generos[]" id="generos" multiple required>
                        <?php foreach ($listageneros as $gen) { ?>
                        <option value="<?= $gen['ID_LISTAGENERO'] ?>"
                            <?= in_array($gen['ID_LISTAGENERO'], $generosJogo) ? 'selected' : '' ?>>
                            <?= $gen['NOME'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="imagem">Imagem:</label>
                    <input type="file" name="imagem" id="imagem" accept="image/png,image/jpeg">
                </div>
                <div>
                    <input type="hidden" name="id" value="<?= $resultado['ID_JOGO'] ?>">
                    <button>Cadastrar</button>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>Copyright © 2026-2026 FATEC.COM – All rights reserved</p>
    </footer>
</body>
</html>