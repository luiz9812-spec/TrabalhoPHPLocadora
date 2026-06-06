<?php 
    require('./conexao.php');

    require('./funcoes.php');

    autenticar();

    $idcliente = $_SESSION['cliente']['cpf'];

    $sql = "SELECT E.ID_EMPRESTIMO AS ID, J.NOME AS JOGO, C.CPF, C.NOME, E.DATA_EMPRESTIMO, E.DATA_ENTREGA, E.DEVOLVIDO
    FROM EMPRESTIMOS E
    INNER JOIN JOGOS J ON J.ID_JOGO = E.ID_JOGO
    INNER JOIN CLIENTES C ON C.CPF = E.CPF
    WHERE E.CPF = ?;"; // String com o comando SQL SELECT
    $comando = $pdo->prepare($sql);
    $comando->execute([$idcliente]);
    $resultado = $comando->fetchAll();

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
    <title>Game Rent - Listar Emprestimos</title>
    <link rel="stylesheet" href="./css/style.css">
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
                <li><a href="./listaplataforma.php">Lista de Jogos</a></li>
                <li><a href="./noticias.php">Notícias</a></li>
            </ul>
        </nav>
        <?= $login ?>
        <!---->
    </header>
    <main>
        <article class="introducao">
            <ul class="breadcrumb">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../painel_cliente.php">Painel Cliente</a></li>
                <li>Listar Emprestimos</li>
            </ul>
        </article>
        <h1 class="titulo">Lista de Emprestimos</h1>
        <table border="1">
            <tr>
                <th>JOGO</th><th>DATA DO EMPRESTIMO</th><th>DATA DE ENTREGA</th><th>STATUS DE DEVOLUÇÃO</th>
            </tr>
            <?php foreach($resultado as $emprestimo) { ?>
            <tr>
                <td><?= $emprestimo["JOGO"] ?></td>
                <td><?= $emprestimo["DATA_EMPRESTIMO"] ?></td>
                <td><?= $emprestimo["DATA_ENTREGA"] ?></td>
                <?php if($emprestimo['DEVOLVIDO'] == 1)  { ?>
                <td>DEVOLVIDO</td>
                <?php } else { ?>
                <td>NÃO DEVOLVIDO</td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
    </main>
    <footer>
        <p>Copyright © 2026-2026 FATEC.COM – All rights reserved</p>
    </footer>
</body>
</html>