
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Professores</title>
    <link rel="stylesheet" href="professor.css">
</head>
<body>

    <h2>Cadastro de Professores</h2>

    <form action="professor_envio.php" method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" required>
        <br><br>

        <label>CPF:</label>
        <input type="text" name="cpf" required>
        <br><br>

        <label>Especialidade:</label>
        <input type="text" name="especialidade" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>

        <label>Telefone:</label>
        <input type="text" name="telefone">
        <br><br>

        <label>Ativo:</label>
        <input type="checkbox" name="ativo" value="1" checked>
        <br><br>

        <button type="submit">Cadastrar Professor</button>
        


    </form>

</body>
</html>

