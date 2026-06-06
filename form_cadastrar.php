<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Rent - Cadastrar</title>
    <link rel="stylesheet" href="css/style.css">
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
        <div class="login">
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
        </div>
        <!--<div class="logado">
            <img src="" alt="">
            <p>Nome</p>
        </div>-->
    </header>
    <main>
        <article class="introducao">
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li>Novo Cadastro</li>
            </ul>
        </article>
        <h1 class="titulo">Tela de Cadastro</h1>
        <section class="tela-cadastro-cliente">
            <form action="cadastrar.php" id="form-cadastro" method="POST">
                <div>
                    <label for="cpf">CPF: </label>
                    <input type="text" name="cpf" id="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}$" placeholder="000.000.000-00" required maxlength="14">
                </div>
                <div>
                    <label for="nome">Nome: </label>
                    <input type="text" name="nome" id="nome" required>
                </div>
                <div>
                    <label for="nascimento">Data de Nascimento: </label>
                    <input type="date" name="nascimento" id="nascimento" required>
                </div>
                <div>
                    <label for="endereco">Endereço: </label>
                    <input type="text" name="endereco" id="endereco" required>
                </div>
                <div>
                    <label for="cidade">Cidade: </label>
                    <input type="text" name="cidade" id="cidade" required>
                </div>
                <div>
                    <label for="estado">Estado: </label>
                    <select name="estado" id="estado" required>
                        <option value="">Selecione...</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
                <div>
                    <label for="telefone">Telefone para contato: </label>
                    <input type="tel" name="telefone" id="telefone" required>
                </div>
                <div>
                    <label for="email">E-Mail: </label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div>
                    <label for="senha1">Senha: </label>
                    <input type="password" name="senha1" id="senha1" required>
                </div>
                <div>
                    <label for="senha2">Repita a Senha: </label>
                    <input type="password" name="senha2" id="senha2" required>
                </div>
                <div>
                    <button>Cadastrar</button>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>Copyright © 2026-2026 FATEC.COM – All rights reserved</p>
    </footer>
    <script>
        function validarCPF(cpf) {
                cpf = cpf.replace(/\D/g, '');

                if (cpf.length !== 11) return false;
                if (/^(\d)\1{10}$/.test(cpf)) return false;

                let soma = 0;

                for (let i = 0; i < 9; i++) {
                    soma += cpf[i] * (10 - i);
                }

                let resto = (soma * 10) % 11;
                if (resto === 10) resto = 0;

                if (resto !== Number(cpf[9])) return false;

                soma = 0;

                for (let i = 0; i < 10; i++) {
                    soma += cpf[i] * (11 - i);
                }

                resto = (soma * 10) % 11;
                if (resto === 10) resto = 0;

                if (resto !== Number(cpf[10])) return false;

                return true;
        }

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

        document.getElementById('telefone').addEventListener('input', function (e) {
            let v = e.target.value;

            // remove tudo que não for número
            v = v.replace(/\D/g, '');

            // limita a 11 dígitos
            v = v.substring(0, 11);

            // aplica máscara
            if (v.length > 10) {
                // celular
                v = v.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
            } else if (v.length > 6) {
                // fixo parcial
                v = v.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
            } else if (v.length > 2) {
                v = v.replace(/(\d{2})(\d{0,5})/, '($1) $2');
            } else {
                v = v.replace(/(\d*)/, '($1');
            }

            e.target.value = v;
        });

        document.getElementById("form-cadastro").addEventListener("submit", function(e) {
            let cpf = document.getElementById("cpf").value;
            let senha1 = document.getElementById("senha1").value;
            let senha2 = document.getElementById("senha2").value;

            if (senha1 !== senha2) {
                e.preventDefault();
                alert("As senhas não coincidem!");
                return;
            }

            if (!validarCPF(cpf)) {
                e.preventDefault();
                alert("CPF inválido!");
                return;
            }
        });
    </script>
</body>
</html>