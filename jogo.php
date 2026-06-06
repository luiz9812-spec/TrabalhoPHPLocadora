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

    $idjogo = $_GET['idjogo'];

    $sql = 'SELECT J.NOME, D.NOME AS DESENVOLVEDORA, LANCAMENTO, PU.NOME AS PUBLISHER, JOGADORES, DESCRICAO, P.NOME AS PLATAFORMA, P.ID_PLATAFORMA, MAX(DISPONIVEL) AS DISPONIVEL FROM JOGOS J INNER JOIN DESENVOLVEDORAS D ON D.ID_DESENVOLVEDORA = J.ID_DESENVOLVEDORA INNER JOIN PUBLISHERS PU ON PU.ID_PUBLISHER = J.ID_PUBLISHER INNER JOIN PLATAFORMAS P ON P.ID_PLATAFORMA = J.ID_PLATAFORMA WHERE J.NOME = (SELECT NOME FROM JOGOS WHERE ID_JOGO = ?) GROUP BY J.NOME, D.NOME, LANCAMENTO, PU.NOME, JOGADORES, DESCRICAO, P.NOME, P.ID_PLATAFORMA;';
    $comando = $pdo->prepare($sql);
    $comando->execute([$idjogo]);
    $resultado = $comando->fetch();// executamos o comando
    // na variavel $resultado temos agora um vetor associativo com
    // todos os registros da tabela produtos
    //$sql_ofertas = "SELECT * FROM produtos WHERE promocao = true";
    //$comando_ofertas = $pdo->query($sql_ofertas);
    //$res_ofertas = $comando->fetchAll();

    $sql = 'SELECT J.NOME AS JOGO, LG.NOME AS GENEROS, LG.ID_LISTAGENERO
            FROM JOGOS J
            JOIN GENEROS G ON J.ID_JOGO = G.ID_JOGO
            JOIN LISTAGENEROS LG ON G.ID_LISTAGENERO = LG.ID_LISTAGENERO
            WHERE G.ID_JOGO = ?;';
    $comando = $pdo->prepare($sql);
    $comando->execute([$idjogo]);
    $generos = $comando->fetchAll();

    if ($resultado['DISPONIVEL'] == 0) {
        $disponivel = 'Alugado';
    }
    else {
        $disponivel = 'Disponível para ser alugado';
    }
    $nome = ucwords(strtolower($resultado["NOME"]));
    $desenvolvedora = ucwords(strtolower($resultado["DESENVOLVEDORA"]));
    $publisher = ucwords(strtolower($resultado["PUBLISHER"]));
    $plataforma = ucwords(strtolower($resultado["PLATAFORMA"]));

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Rent - <?= $nome ?></title>
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
                <li><a href="listaplataforma.php">Lista de Jogos</a></li>
                <li><a href="noticias.php">Notícias</a></li>
            </ul>
        </nav>
        <?= $login ?>
    </header>
    <main>
        <article class="introducao">
            <ul class="breadcrumb">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../listaplataforma.php">Lista de Plataformas</a></li>
                <li><a href="../listajogos.php?idplataforma=<?= $resultado['ID_PLATAFORMA'] ?>"><?= $plataforma ?></a></li>
                <li><?= $nome ?></li>
            </ul>
        </article>
        <h1 class="titulo"><?= $nome ?></h1>
        <section class="tela-jogo">
            <img src="./img/jogos/<?= $idjogo ?>.png" alt="Capa do jogo <?= $nome ?>">
            <table>
                <tr>
                    <th>Desenvolvedora: </th>
                    <td><?= $desenvolvedora ?></td>
                </tr>
                <tr>
                    <th>Publisher: </th>
                    <td><?= $publisher ?></td>
                </tr>
                <tr>
                    <th>Plataforma: </th>
                    <td><?= $plataforma ?></td>
                </tr>
                <tr>
                    <th>Generos: </th>
                    <td><?php foreach($generos as $i => $genero): 
                        if($i > 0) echo ', '?>
                        <a href="genero.php?id=<?= $genero['ID_LISTAGENERO'] ?>">
                            <?= ucwords(strtolower($genero['GENEROS'])) ?>
                        </a>
                    <?php endforeach; ?></td>
                </tr>
                <tr>
                    <th>Nº Máximo de Jogadores: </th>
                    <td><?= $resultado['JOGADORES'] ?></td>
                </tr>
                <tr>
                    <th>Ano de Lançamento: </th>
                    <td><?= $resultado['LANCAMENTO'] ?></td>
                </tr>
                <tr>
                    <th>Disponivel: </th>
                    <td><?= $disponivel ?></td>
                </tr>
            </table>
        </section>
        <section class="tela-jogo">
            <p><?= $resultado['DESCRICAO'] ?></p>
        </section>
        <aside class="reservar-button">
            <?php 
                if($resultado['DISPONIVEL'] == 0 || !isset($_SESSION['cliente'])) { ?>
                    <button type="button" disabled>Reservar</button>
            <?php } else { ?>
                    <form action="reservar.php" method="POST">
                        <input type="hidden" name="idjogo" value="<?= $idjogo ?>">
                        <button type="submit">Reservar</button>
                    </form>     
            <?php } ?>
        </aside>
    </main>
    <footer>
        <p>Copyright © 2026-2026 FATEC.COM – All rights reserved</p>
    </footer>
</body>
</html>