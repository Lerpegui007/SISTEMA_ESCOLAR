
<?php
require_once '../../db/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form_disciplina-professor.php');
    exit;
}

$id_professor = (int) ($_POST['id_professor'] ?? 0);
$id_disciplina = (int) ($_POST['id_disciplina'] ?? 0);

if ($id_professor <= 0 || $id_disciplina <= 0) {
    echo "Selecione um professor e uma disciplina.";
    exit;
}

$sql = "INSERT INTO disciplina_professor (id_professor, id_disciplina)
        VALUES ($id_professor, $id_disciplina)";

if (mysqli_query($db, $sql)) {
    echo "Relação cadastrada com sucesso!";
} elseif (mysqli_errno($db) == 1062) {
    echo "Esse professor já está relacionado a essa disciplina.";
} else {
    echo "Erro ao cadastrar relação: " . mysqli_error($db);
}
?>

<br><br>
<a href="form_disciplina-professor.php">Voltar ao formulário</a>

