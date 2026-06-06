<?php 
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    $sql = "SELECT ID_JOGO, J.NOME, D.NOME AS DESENVOLVEDORA, LANCAMENTO, PU.NOME   AS    PUBLISHER, JOGADORES, DESCRICAO, P.NOME AS PLATAFORMA, DISPONIVEL
    FROM JOGOS J 
    INNER JOIN DESENVOLVEDORAS D ON D.ID_DESENVOLVEDORA = J.ID_DESENVOLVEDORA
    INNER JOIN PUBLISHERS PU ON PU.ID_PUBLISHER = J. ID_PUBLISHER
    INNER JOIN PLATAFORMAS P ON P.ID_PLATAFORMA = J.ID_PLATAFORMA;"; // String com o comando SQL SELECT
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
    <title>Game Rent - Listar Jogos</title>
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
                <li>Listar Jogos</li>
            </ul>
        </article>
        <h1 class="titulo">Lista de Jogos</h1>
        <table border="1">
            <tr>
                <th>AÇÕES</th>
                <th>ID</th><th>NOME</th><th>DESENVOLVEDORA</th><th>LANÇAMENTO</th><th>PUBLISHER</th><th>JOGADORES</th><th>DESCRIÇÃO</th><th>PLATAFORMA</th><th>DISPONIVEL</th>
            </tr>
            <?php foreach($resultado as $jogo) { ?>
            <tr>
                <td>
                    <a href="excluir-jogo.php?id=<?= $jogo["ID_JOGO"] ?>">Excluir</a>
                    |
                    <a href="form-alterar-jogo.php?id=<?= $jogo["ID_JOGO"] ?>">Alterar</a>
                </td>
                <td><?= $jogo["ID_JOGO"] ?></td>
                <td><?= $jogo["NOME"] ?></td>
                <td><?= $jogo["DESENVOLVEDORA"] ?></td>
                <td><?= $jogo["LANCAMENTO"] ?></td>
                <td><?= $jogo["PUBLISHER"] ?></td>
                <td><?= $jogo["JOGADORES"] ?></td>
                <td><?= $jogo["DESCRICAO"] ?></td>
                <td><?= $jogo["PLATAFORMA"] ?></td>
                <td><?= $jogo["DISPONIVEL"] ?></td>
            </tr>
            <?php } ?>
        </table>
        <div>
            <form action="incluir-jogo.php">
                <button>Incluir Jogo</button>
            </form>
        </div>
    </main>
    <footer>
        <p>Copyright © 2026-2026 FATEC.COM – All rights reserved</p>
    </footer>
</body>
</html>