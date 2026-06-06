<?php 
    require('../conexao.php');

    require('../funcoes.php');

    autenticarAdmin();

    $id = $_GET['id'];

    $sql = "SELECT * FROM EMPRESTIMOS WHERE ID_EMPRESTIMO = ?";
    $comando = $pdo->prepare($sql);
    $comando->execute([$id]);
    $resultado = $comando->fetch();

    $sql = "SELECT * FROM JOGOS";
    $comando = $pdo->query($sql);
    $jogos = $comando->fetchAll();

    $sql = "SELECT * FROM CLIENTES";
    $comando = $pdo->query($sql);
    $clientes = $comando->fetchAll();

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
    <title>Game Rent - Alterar Emprestimo id = <?= $id ?></title>
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
                <li><a href="./listar-emprestimos.php">Listar Emprestimos</a></li>
                <li>Alterar Emprestimo id = <?= $id ?></li>
            </ul>
        </article>
        <h1 class="titulo">Alterar Emprestimo</h1>
        <section class="tela-cadastro-cliente">
            <form action="alterar-emprestimo.php" id="form-cadastro" enctype="multipart/form-data" method="POST">
                <div>
                    <label for="cpf">CPF do cliente: </label>
                    <input type="text" name="cpf" id="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}$" required maxlength="14" value="<?= $resultado["CPF"] ?>">
                </div>
                <div>
                    <label for="jogo">ID do Jogo: </label>
                    <input type="number" name="idjogo" id="idjogo" required value="<?= $resultado["ID_JOGO"] ?>">
                </div>
                <div>
                    <label for="emprestimo">Data Emprestimo: </label>
                    <input type="date" name="emprestimo" id="emprestimo" value="<?= $resultado["DATA_EMPRESTIMO"] ?>" required>
                </div>
                <div>
                    <label for="entrega">Data Entrega: </label>
                    <input type="date" name="entrega" id="entrega" required value="<?= $resultado["DATA_ENTREGA"] ?>">
                </div>
                <div>
                    <label for="devolvido">Estatus da Devolução: </label>
                    <select name="devolvido" id="devolvido" required>
                        <option value="1" <?= $resultado['DEVOLVIDO'] == 1 ? 'selected' : '' ?>>Devolvido</option>
                        <option value="0" <?= $resultado['DEVOLVIDO'] == 0 ? 'selected' : '' ?>>Não Devolvido</option>
                    </select>
                </div>
                <div>
                    <input type="hidden" name="id" value="<?= $resultado['ID_EMPRESTIMO'] ?>">
                    <button>Alterar Emprestimo</button>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>Copyright © 2026-2026 FATEC.COM – All rights reserved</p>
    </footer>
    <script>
        document.getElementById('cpf').addEventListener('input', function(e) {
            let valor = e.target.value;

            // Remove tudo que não for número
            valor = valor.replace(/\D/g, '');

            // Aplica a máscara
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            e.target.value = valor;
        });
    </script>
</body>
</html>