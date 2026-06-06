<?php
    require('./conexao.php');

    require('./funcoes.php');

    autenticar();

    // recebemos os dados do formulário
    $cpf = htmlspecialchars($_SESSION['cliente']['cpf']);
    $idjogo = htmlspecialchars(intval($_POST["idjogo"]));

    if (date('w', strtotime('+1 days')) == 0) {
        $prazo = date('Y-m-d', strtotime('+2 days'));
    } else {
        $prazo = date('Y-m-d', strtotime('+1 days'));
    }

    $sql = "INSERT INTO RESERVAS (CPF, ID_JOGO, PRAZO_RESERVA) "
        . " VALUES (:cpf, :idjogo, :prazo)";
    
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":cpf", $cpf);
    $comando->bindParam(":idjogo", $idjogo);
    $comando->bindParam(":prazo", $prazo);

    $sucesso = $comando->execute();
    if ($sucesso) {
        header("Location: jogo.php?idjogo=" . $idjogo);
        exit;
    }
?>
<h1 style="color: red">FALHA NA INCLUSÃO</h1>