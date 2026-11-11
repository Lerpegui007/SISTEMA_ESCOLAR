
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Turmas</title>
    <link rel="stylesheet" href="turma.css">
</head>
<body>

    <h2>Cadastro de Turmas</h2>

    <form action="cadastrar_turmas.php" method="POST">

        <label>Nome da turma:</label>
        <input type="text" name="nome_turma" required>
        <br><br>

        <label>Ano letivo:</label>
        <input type="number" name="ano_letivo">
        <br><br>

        <label>Turno:</label>
        <select name="turno">
            <option value="">Selecione</option>
            <option value="Manhã">Manhã</option>
            <option value="Tarde">Tarde</option>
            <option value="Noite">Noite</option>
        </select>
        <br><br>

        <button type="submit">Cadastrar Turma</button>
    
    </form>

</body>
</html>
