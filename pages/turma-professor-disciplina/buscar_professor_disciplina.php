<?php
require_once '../../db/conexao.php';

header('Content-Type: application/json; charset=utf-8');

$id_disciplina = (int) ($_GET['id_disciplina'] ?? 0);

if ($id_disciplina <= 0) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT p.id_professor, p.nome
        FROM professores p
        INNER JOIN disciplina_professor dp
            ON p.id_professor = dp.id_professor
        WHERE dp.id_disciplina = ?
        ORDER BY p.nome";

$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_disciplina);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$professores = [];

while ($linha = mysqli_fetch_assoc($resultado)) {
    $professores[] = $linha;
}

echo json_encode($professores);
?>
