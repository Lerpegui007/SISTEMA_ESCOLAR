
<?php
require_once '../../db/conexao.php';

header('Content-Type: application/json; charset=utf-8');

$termo = trim($_GET['termo'] ?? '');

if ($termo === '') {
    echo json_encode([]);
    exit;
}

$pesquisaNome = '%' . $termo . '%';
$cpfLimpo = preg_replace('/[^0-9]/', '', $termo);
$pesquisaCpf = '%' . $cpfLimpo . '%';

$sql = "SELECT id_professor, nome, cpf
        FROM professores
        WHERE nome LIKE ?
           OR REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') LIKE ?
        ORDER BY nome
        LIMIT 10";

$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "ss", $pesquisaNome, $pesquisaCpf);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$professores = [];

while ($professor = mysqli_fetch_assoc($resultado)) {
    $professores[] = $professor;
}

echo json_encode($professores, JSON_UNESCAPED_UNICODE);

mysqli_stmt_close($stmt);
?>

