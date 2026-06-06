<?php 
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    $sql = "SELECT P.ID_PLATAFORMA, P.NOME, D.NOME AS DESENVOLVEDORA
            FROM PLATAFORMAS P
            INNER JOIN DESENVOLVEDORAS D ON D.ID_DESENVOLVEDORA = P.ID_DESENVOLVEDORA"; // String com o comando SQL SELECT
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
    <title>Game Rent - Listar Plataformas</title>
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
                <li>Listar Plataformas</li>
            </ul>
        </article>
        <h1 class="titulo">Lista de Plataformas</h1>
        <table border="1">
            <tr>
                <th>AÇÕES</th>
                <th>ID</th><th>NOME</th><th>DESENVOLVEDORA</th>
            </tr>
            <?php foreach($resultado as $plataforma) { ?>
            <tr>
                <td>
                    <a href="excluir-plataforma.php?id=<?= $plataforma["ID_PLATAFORMA"] ?>">Excluir</a>
                    |
                    <a href="form-alterar-plataforma.php?id=<?= $plataforma["ID_PLATAFORMA"] ?>">Alterar</a>
                </td>
                <td><?= $plataforma["ID_PLATAFORMA"] ?></td>
                <td><?= $plataforma["NOME"] ?></td>
                <td><?= $plataforma["DESENVOLVEDORA"] ?></td>
            </tr>
            <?php } ?>
        </table>
        <div>
            <form action="incluir-plataformas.php">
                <button>Incluir Plataformas</button>
            </form>
        </div>
    </main>
    <footer>
        <p>Copyright © 2026-2026 FATEC.COM – All rights reserved</p>
    </footer>
</body>
</html>