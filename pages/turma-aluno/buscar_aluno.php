
<?php

header('Content-Type: application/json; charset=utf-8');

// Conexão com o banco de dados
require_once '../../db/conexao.php';

// Recebe o texto digitado pelo usuário
$termo = trim($_GET['termo'] ?? '');

// Verifica se o usuário digitou alguma coisa
if ($termo === '') {
    echo json_encode([]);
    exit;
}

// Prepara o termo para pesquisar nome e CPF
$pesquisaNome = '%' . $termo . '%';

// Remove pontos, traços e espaços do CPF digitado
$cpfLimpo = preg_replace('/[^0-9]/', '', $termo);
$pesquisaCpf = '%' . $cpfLimpo . '%';

// Consulta os alunos pelo nome ou CPF
$sql = "SELECT id_aluno, nome, cpf
        FROM alunos
        WHERE nome LIKE ?
        OR REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') LIKE ?
        ORDER BY nome ASC
        LIMIT 10";

$stmt = mysqli_prepare($db, $sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao preparar a consulta.']);
    exit;
}

// Associa os parâmetros à consulta
mysqli_stmt_bind_param($stmt, "ss", $pesquisaNome, $pesquisaCpf);

// Executa a consulta
mysqli_stmt_execute($stmt);

// Obtém os resultados
$resultado = mysqli_stmt_get_result($stmt);

$alunos = [];

while ($aluno = mysqli_fetch_assoc($resultado)) {
    $alunos[] = $aluno;
}

// Devolve os resultados em JSON
echo json_encode($alunos, JSON_UNESCAPED_UNICODE);

// Fecha a consulta
mysqli_stmt_close($stmt);

?>

