<?php 
    require('./conexao.php');

    require('./funcoes.php');

    autenticar();

    $idcliente = $_SESSION['cliente']['cpf'];

    $sql = "SELECT R.ID_RESERVA AS ID, J.NOME AS JOGO, C.CPF, C.NOME, R.DATA_RESERVA, R.PRAZO_RESERVA, R.FINALIZAR_RESERVA AS DEVOLVIDO
    FROM RESERVAS R
    INNER JOIN JOGOS J ON J.ID_JOGO = R.ID_JOGO
    INNER JOIN CLIENTES C ON C.CPF = R.CPF
    WHERE R.CPF = ?;"; // String com o comando SQL SELECT
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
    <title>Game Rent - Listar Reservas</title>
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
                <li>Listar Reservas</li>
            </ul>
        </article>
        <h1 class="titulo">Lista de Jogos</h1>
        <table border="1">
            <tr>
                <th>JOGO</th><th>DATA DA RESERVA</th><th>EXPIRA EM</th><th>STATUS DE RESERVA</th>
            </tr>
            <?php foreach($resultado as $reserva) { ?>
            <tr>
                <td><?= $reserva["JOGO"] ?></td>
                <td><?= $reserva["DATA_RESERVA"] ?></td>
                <td><?= $reserva["PRAZO_RESERVA"] ?></td>
                <?php if($reserva['DEVOLVIDO'] == 1)  { ?>
                <td>RESERVA EM VIGOR</td>
                <?php } else { ?>
                <td>RESERVA EXPIRADA</td>
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