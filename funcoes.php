<?php 
    function validar_cliente($pdo, $usuario, $senha) {

        $sql = "SELECT * FROM CLIENTES
                WHERE CPF = :usuario OR EMAIL = :usuario";

        $comando = $pdo->prepare($sql);
        $comando->bindParam(":usuario", $usuario);
        $comando->execute();

        $cliente = $comando->fetch(PDO::FETCH_ASSOC);

        if (!$cliente) {
            return false; // usuário não existe
        }

        if (password_verify($senha, $cliente['SENHA'])) {
            return $cliente;
        }

        return false;
    }

    function validar_admin($pdo, $usuario, $senha) {

        $sql = "SELECT * FROM ADMINS
                WHERE NOME = :usuario";

        $comando = $pdo->prepare($sql);
        $comando->bindParam(":usuario", $usuario);
        $comando->execute();

        $admins = $comando->fetch(PDO::FETCH_ASSOC);

        if (!$admins) {
            return false;
        }  
        if (password_verify($senha, $admins['SENHA'])){
            return $admins;
        }

        return false;
    }

    function validar_cpf($cpf) {
        $cpf = preg_replace('/\D/', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        $soma = 0;

        for ($i = 0; $i < 9; $i++) {
        $soma += $cpf[$i] * (10 - $i);
        }

        $resto = $soma % 11;

        if ($resto < 2) {
            $digito1 = 0;
        } else {
            $digito1 = 11 - $resto;
        }

        if ($digito1 != (int)$cpf[9]) {
            return false;
        }

        $soma = 0;

        for ($i = 0; $i < 10; $i++) {
            $soma += $cpf[$i] * (11 - $i);
        }

        $resto = $soma % 11;

        if ($resto < 2) {
            $digito2 = 0;
        } else {
            $digito2 = 11 - $resto;
        }

        if ($digito2 != (int)$cpf[10]) {
        return false;
        }

        return true;
    }

    function comparar_senha($senha1, $senha2) {
        if ($senha1 == $senha2) {
            return true;
        } else {
            return false;
        }
    }

    function autenticar() {
        session_start();
        // verifica se a variável de sessão para o admin está
        //configurada, se não estiver, redireciona para o login
        if (!isset($_SESSION['cliente'])) {
            header("Location: login.php");
            exit;
        }
    }

    function autenticarAdmin() {
        session_start();
        // verifica se a variável de sessão para o admin está
        //configurada, se não estiver, redireciona para o login
        if (!isset($_SESSION['admin'])) {
            header("Location: login.php");
        }
    }

?>