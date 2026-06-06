<?php 
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    $sql = "SELECT * FROM NOTICIAS;"; // String com o comando SQL SELECT
    $comando = $pdo->query($sql); // Montamos e deixamos o comando preparado
    $resultado = $comando->fetchAll(); // Executamos o comando de consulta

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
    <title>Game Rent - Listar Notícias</title>
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
                <li>Listar Notícias</li>
            </ul>
        </article>
        <h1 class="titulo">Lista de Noticias</h1>
        <table border="1">
            <tr>
                <th>AÇÕES</th>
                <th>ID</th><th>TITULO</th>
            </tr>
            <?php foreach($resultado as $noticias) { ?>
            <tr>
                <td>
                    <a href="excluir-noticia.php?id=<?= $noticias["ID_NOTICIA"] ?>">Excluir</a>
                    |
                    <a href="form-alterar-noticia.php?id=<?= $noticias["ID_NOTICIA"] ?>">Alterar</a>
                </td>
                <td><?= $noticias["ID_NOTICIA"] ?></td>
                <td><?= $noticias["TITULO"] ?></td>
            </tr>
            <?php } ?>
        </table>
        <div>
            <form action="incluir-noticia.php">
                <button>Incluir Noticia</button>
            </form>
        </div>
    </main>
    <footer>
        <p>Copyright © 2026-2026 FATEC.COM – All rights reserved</p>
    </footer>
</body>
</html>