<?php
require_once '../../db/conexao.php';

$id_turma = (int) ($_POST['id_turma'] ?? 0);
$id_disciplina = (int) ($_POST['id_disciplina'] ?? 0);
$id_professor = (int) ($_POST['id_professor'] ?? 0);

if ($id_turma <= 0 || $id_disciplina <= 0 || $id_professor <= 0) {
    echo "Preencha todos os campos corretamente.";
    exit;
}

/* Confere se o professor realmente leciona a disciplina selecionada */
$sql_verifica = "SELECT id_professor
                 FROM disciplina_professor
                 WHERE id_professor = ?
                   AND id_disciplina = ?";

$stmt_verifica = mysqli_prepare($db, $sql_verifica);
mysqli_stmt_bind_param($stmt_verifica, "ii", $id_professor, $id_disciplina);
mysqli_stmt_execute($stmt_verifica);

$resultado_verifica = mysqli_stmt_get_result($stmt_verifica);

if (mysqli_num_rows($resultado_verifica) === 0) {
    echo "Esse professor não leciona a disciplina selecionada.";
    exit;
}

/* Insere a relação entre turma, disciplina e professor */
$sql = "INSERT INTO turma_disciplina_professor
        (id_turma, id_disciplina, id_professor)
        VALUES (?, ?, ?)";

$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "iii", $id_turma, $id_disciplina, $id_professor);

if (mysqli_stmt_execute($stmt)) {
    echo "Relação cadastrada com sucesso!";
} else {
    if (mysqli_errno($db) == 1062) {
        echo "Essa relação já está cadastrada.";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($db);
    }
}
?>
