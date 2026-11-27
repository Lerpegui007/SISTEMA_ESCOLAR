<?php
require_once '../../db/conexao.php';

header('Content-Type: application/json; charset=utf-8');

$termo = trim($_GET['termo'] ?? '');

if ($termo === '') {
    echo json_encode([]);
    exit;
}

$pesquisa = '%' . $termo . '%';

$sql = "SELECT id_turma, nome_turma, ano_letivo, turno
        FROM turmas
        WHERE nome_turma LIKE ?
           OR CAST(ano_letivo AS CHAR) LIKE ?
           OR turno LIKE ?
        ORDER BY ano_letivo DESC, nome_turma
        LIMIT 10";

$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "sss", $pesquisa, $pesquisa, $pesquisa);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$turmas = [];

while ($linha = mysqli_fetch_assoc($resultado)) {
    $turmas[] = $linha;
}

echo json_encode($turmas);
?>
