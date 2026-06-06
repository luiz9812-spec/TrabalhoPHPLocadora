<?php 
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    $id = $_GET['id'];

    $sql = 'SELECT P.ID_PLATAFORMA, P.NOME, P.ID_DESENVOLVEDORA, D.NOME AS DESENVOLVEDORA FROM PLATAFORMAS P INNER JOIN DESENVOLVEDORAS D ON D.ID_DESENVOLVEDORA = P.ID_DESENVOLVEDORA WHERE ID_PLATAFORMA = ?;';
    $comando = $pdo->prepare($sql);
    $comando->execute([$id]);
    $resultado = $comando->fetch();// executamos o comando
    // na variavel $resultado temos agora um vetor associativo com
    // todos os registros da tabela produtos
    //$sql_ofertas = "SELECT * FROM produtos WHERE promocao = true";
    //$comando_ofertas = $pdo->query($sql_ofertas);
    //$res_ofertas = $comando->fetchAll();

    $sql = "SELECT * FROM DESENVOLVEDORAS";
    $comando = $pdo->query($sql);
    $desenvolvedora = $comando->fetchAll();

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
    <title>Game Rent - Alterar Plataforma id = <?= $id ?></title>
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
                <li><a href="./listar-plataformas.php">Listar Plataformas</a></li>
                <li>Alterar Plataforma id = <?= $id ?></li>
            </ul>
        </article>
        <h1 class="titulo">Alterar Plataforma</h1>
        <section class="tela-cadastro-cliente">
            <form action="alterar-plataforma.php" id="form-cadastro" enctype="multipart/form-data" method="POST">
                <div>
                    <label for="nome">Nome: </label>
                    <input type="text" name="nome" id="nome" value="<?= $resultado['NOME'] ?>" required>
                </div>
                <div>
                    <label for="desenvolvedora">Desenvolvedora: </label>
                    <select name="desenvolvedora" id="desenvolvedora">
                        <option value="<?= $resultado['ID_DESENVOLVEDORA'] ?>" selected><?= $resultado['DESENVOLVEDORA'] ?></option>
                        <?php foreach ($desenvolvedora as $dev) { ?>
                            <option value="<?= $dev['ID_DESENVOLVEDORA'] ?>"><?= $dev['NOME'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="imagem">Imagem:</label>
                    <input type="file" name="imagem" id="imagem" accept="image/png,image/jpeg">
                </div>
                <div>
                    <input type="hidden" name="id" value="<?= $resultado['ID_PLATAFORMA'] ?>">
                    <button>Alterar</button>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>Copyright © 2026-2026 FATEC.COM – All rights reserved</p>
    </footer>
</body>
</html>