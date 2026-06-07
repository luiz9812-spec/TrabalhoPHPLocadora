<?php 
    require('./conexao.php');

    session_start();

    if (isset($_SESSION['admin'])) {
        $nome = $_SESSION['admin']['nome'];
        $login = '<div class="logado">
                    <img src="" alt="">
                    <p>' . $nome . '</p>
                    <div class="botoes">
                        <form method="POST">
                            <button type="submit" formaction="admin/painel_admin.php">Sessão do Administrador</button>
                            <button type="submit" formaction="logoff.php">Log-off</button>
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

    $sql = 'SELECT * FROM JOGOS ORDER BY ID_JOGO DESC LIMIT 3';
    $comando = $pdo->query($sql); // preparamos com comando
    $resultado = $comando->fetchAll();// executamos o comando
    // na variavel $resultado temos agora um vetor associativo com
    // todos os registros da tabela produtos
    //$sql_ofertas = "SELECT * FROM produtos WHERE promocao = true";
    //$comando_ofertas = $pdo->query($sql_ofertas);
    //$res_ofertas = $comando->fetchAll();

    $sql = 'SELECT * FROM NOTICIAS ORDER BY ID_NOTICIA DESC LIMIT 3';
    $comando = $pdo->query($sql); // preparamos com comando
    $noticia = $comando->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Rent - Home</title>
    <link rel="stylesheet" href="css/style.css">
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
                <li><a href="listaplataforma.php">Lista de Jogos</a></li>
                <li><a href="noticias.php">Notícias</a></li>
            </ul>
        </nav>
        <?= $login ?>
        <!---->
    </header>
    <main>
        <article class="introducao">
            <h2>Bem Vindo(a) a GameRent!</h2>
            <p>Emprestimo de Jogos!</p>
        </article>
        <h1 class="titulo">Ultimos Cadastros</h1>
        <section class="ultimos-cadastros">
            <?php foreach($resultado as $jogo) { ?>
            <a class="card-link" href="jogo.php?idjogo=<?= $jogo['ID_JOGO'] ?>">    
                <div class="card">
                    <img src="./img/jogos/<?= $jogo["ID_JOGO"] ?>.png" alt="Lista de jogo para <?= $jogo["NOME"] ?>">
                    <h2><?= $jogo["NOME"] ?></h2>
                </div>
            </a>
            <?php } ?>
        </section>
        <h1 class="titulo">Ultimas Notícias</h1>
        <section class="ultimos-cadastros">
            <?php foreach($noticia as $noticias) { ?>
            <a class="card-link" href="noticia.php?idnoticia=<?= $noticias['ID_NOTICIA'] ?>">    
                <div class="card">
                    <img src="./img/noticias/<?= $noticias["ID_NOTICIA"] ?>.png" alt="Link para a noticia <?= $noticias["TITULO"] ?>">
                    <h2><?= $noticias["TITULO"] ?></h2>
                </div>
            </a>
            <?php } ?>
        </section>
    </main>
    <footer>
        <p>Copyright © 2026-2026 FATEC.COM – All rights reserved</p>
    </footer>
</body>
</html>