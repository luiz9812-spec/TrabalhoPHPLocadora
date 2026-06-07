<?php
    $tipo_banco = "mysql";      // banco de dados usado (mysql, oracle, etc)
    $servidor   = "localhost";  // endereço do servidor onde está o banco
    $porta      = 3306;         // porta no servidor para o banco
    $banco      = "locadora";       // nome do banco de dados
    $usuario    = "root";        // usuário usado para acessar o banco
    $senha      = "";   // senha do usuário

    // montamos a DSN (uma string que informa à biblioteca dados sobre o banco)
    $dsn = "$tipo_banco:host=$servidor;dbname=$banco;port=$porta";
    
    try {
        $pdo = new PDO($dsn, $usuario, $senha);
    } catch (PDOException $e) {
        echo "Falha ao conectar no banco: " . $e->getMessage();
        exit();
    }

    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>