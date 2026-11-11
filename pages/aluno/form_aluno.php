<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do Aluno</title>
    <link rel="stylesheet" href="aluno.css">
</head>
<body>
    <h1>Cadastro Aluno</h1>
    <form action="aluno_envio.php" method="POST">
    

                <label for="nome">Nome completo: </label>
                <input type="text" name="nome" id="nome" required>
                
                <label for="data-nasc">Data de nascimento: </label>
                <input id="data-nasc" type="date" name="data-nascimento" required>

                <label for="cpf">C.P.F.: </label>
                <input id="cpf" type="text" name="numero_cpf" required>

                <label for="telefone">Telefone: </label>
                <input type="tel" id="telefone" name="telefone-user" placeholder="(00) 9 1234-5678" required>

                <label for="campo-email">E-mail: </label>
                <input type="email" name="email" id="campo-email" placeholder="seulogin@hospedagem.com" required>

                <label for="endereco">Endereço: </label>
                <input id="endereco" type="text" name="endereco-completo" required>

                <label for="bairro">Bairro: </label>
                <input id="bairro" type="text" name="bairro" required>

                <label>Ativo:</label>
                <input type="checkbox" name="ativo" value="1" checked> 

                <button type="submit">Cadastrar Aluno</button>
   
    </form>

</body>
</html>