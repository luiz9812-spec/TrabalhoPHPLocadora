<?php 
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

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
    <title>Game Rent - Incluir Noticia</title>
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
                <li><a href="./listar-noticias.php">Listar Notícias</a></li>
                <li>Incluir Notícia</li>
            </ul>
        </article>
        <h1 class="titulo">Cadastrar Notícia</h1>
        <section class="tela-cadastro-cliente">
            <form action="cadastrar-noticia.php" id="form-cadastro" enctype="multipart/form-data" method="POST">
                <div>
                    <label for="titulo">Título: </label>
                    <input type="text" name="titulo" id="titulo" required>
                </div>
                <div>
                    <label for="desenvolvedora">Desenvolvedora: </label>
                    <input type="text" name="autor" id="autor" required>
                </div>
                <div>
                    <label for="corpo">Corpo da notícia: </label>
                    <textarea name="corpo" id="corpo"></textarea>
                </div>
                <div>
                    <label for="credito">Credito: </label>
                    <input type="text" name="credito" id="credito" required>
                </div>
                <div>
                    <label for="imagem">Imagem:</label>
                    <input type="file" name="imagem" id="imagem" accept="image/png,image/jpeg">
                </div>
                <div>
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