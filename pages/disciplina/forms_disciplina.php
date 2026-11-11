
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Disciplinas</title>
    <link rel="stylesheet" href="disciplina.css">
    

</head>
<body>

    <h2>Cadastro de Disciplinas</h2>

    <form action="disciplina_envio.php" method="POST">

        <label>Nome da disciplina:</label>
        <input type="text" name="nome_disciplina" required>
        <br><br>

        <label>Carga horária:</label>
        <input type="number" name="carga_horaria">
        <br><br>

        <button type="submit">Cadastrar Disciplina</button>

    </form>

</body>
</html>
