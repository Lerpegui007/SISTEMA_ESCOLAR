
<?php

// Conexão com o banco de dados
require_once '../../db/conexao.php';

// Verifica se o formulário foi enviado pelo método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form_turma-aluno.php');
    exit;
}

// Recebe os IDs enviados pelo formulário
$id_aluno = filter_input(INPUT_POST, 'id_aluno', FILTER_VALIDATE_INT);
$id_turma = filter_input(INPUT_POST, 'id_turma', FILTER_VALIDATE_INT);

// Verifica se os campos foram preenchidos corretamente
if (!$id_aluno || !$id_turma || $id_aluno <= 0 || $id_turma <= 0) {
    $mensagem = "Selecione um aluno e uma turma válidos.";
} else {

    // Verifica se a matrícula já existe
    $sqlVerificar = "SELECT id_aluno
                     FROM turma_aluno
                     WHERE id_aluno = ? AND id_turma = ?";

    $stmtVerificar = mysqli_prepare($db, $sqlVerificar);

    mysqli_stmt_bind_param($stmtVerificar, "ii", $id_aluno, $id_turma);

    mysqli_stmt_execute($stmtVerificar);

    $resultado = mysqli_stmt_get_result($stmtVerificar);

    if (mysqli_num_rows($resultado) > 0) {

        $mensagem = "Este aluno já está matriculado nesta turma.";

    } else {

        // Insere a matrícula na tabela
        $sqlInserir = "INSERT INTO turma_aluno (id_aluno, id_turma)
                       VALUES (?, ?)";

        $stmtInserir = mysqli_prepare($db, $sqlInserir);

        mysqli_stmt_bind_param($stmtInserir, "ii", $id_aluno, $id_turma);

        if (mysqli_stmt_execute($stmtInserir)) {

            $mensagem = "Matrícula realizada com sucesso!";

        } else {

            // Trata possíveis erros de chave estrangeira
            if (mysqli_errno($db) == 1452) {
                $mensagem = "O aluno ou a turma selecionada não existe.";
            } else {
                $mensagem = "Não foi possível realizar a matrícula.";
            }

        }

        mysqli_stmt_close($stmtInserir);
    }

    mysqli_stmt_close($stmtVerificar);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da matrícula</title>
</head>
<body>

    <h2>Resultado da operação</h2>

    <p><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></p>

    <a href="form_turma-aluno.php">Voltar ao formulário</a>

</body>
</html>

