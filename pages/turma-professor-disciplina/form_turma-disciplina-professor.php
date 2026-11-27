<?php
require_once '../../db/conexao.php';

$sql = "SELECT id_disciplina, nome_disciplina
        FROM disciplinas
        ORDER BY nome_disciplina";

$resultado = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relacionar turma, disciplina e professor</title>
    <link rel="stylesheet" href="turma_disciplina_professor.css">
</head>
<body>

<h2>Relacionar turma, disciplina e professor</h2>

<form action="envio_turma-disciplina-professor.php" method="POST">

    <label for="busca_turma">Turma:</label>
    <input type="text" id="busca_turma" placeholder="Digite o nome, ano ou turno da turma" autocomplete="off">

    <div id="resultado_turmas"></div>

    <input type="hidden" name="id_turma" id="id_turma">

    <label for="id_disciplina">Disciplina:</label>
    <select name="id_disciplina" id="id_disciplina" required>
        <option value="">Selecione uma disciplina</option>

        <?php while ($disciplina = mysqli_fetch_assoc($resultado)) { ?>
            <option value="<?= $disciplina['id_disciplina'] ?>">
                <?= htmlspecialchars($disciplina['nome_disciplina']) ?>
            </option>
        <?php } ?>
    </select>

    <label for="id_professor">Professor:</label>
    <select name="id_professor" id="id_professor" required disabled>
        <option value="">Selecione primeiro uma disciplina</option>
    </select>

    <button type="submit">Salvar relação</button>

</form>

<script>
const buscaTurma = document.getElementById('busca_turma');
const resultadoTurmas = document.getElementById('resultado_turmas');
const idTurma = document.getElementById('id_turma');

const disciplina = document.getElementById('id_disciplina');
const professor = document.getElementById('id_professor');

buscaTurma.addEventListener('input', function () {
    const termo = this.value.trim();

    idTurma.value = '';
    resultadoTurmas.innerHTML = '';

    if (termo.length < 1) {
        return;
    }

    fetch('buscar_turma.php?termo=' + encodeURIComponent(termo))
        .then(resposta => resposta.json())
        .then(turmas => {
            resultadoTurmas.innerHTML = '';

            turmas.forEach(turma => {
                const botao = document.createElement('button');
                botao.type = 'button';
                botao.textContent =
                    turma.nome_turma + ' - ' + turma.ano_letivo + ' - ' + turma.turno;

                botao.addEventListener('click', function () {
                    buscaTurma.value = botao.textContent;
                    idTurma.value = turma.id_turma;
                    resultadoTurmas.innerHTML = '';
                });

                resultadoTurmas.appendChild(botao);
            });
        });
});

disciplina.addEventListener('change', function () {
    professor.innerHTML = '<option value="">Carregando professores...</option>';
    professor.disabled = true;

    if (this.value === '') {
        professor.innerHTML = '<option value="">Selecione primeiro uma disciplina</option>';
        return;
    }

    fetch('buscar_professor_disciplina.php?id_disciplina=' + encodeURIComponent(this.value))
        .then(resposta => resposta.json())
        .then(professores => {
            professor.innerHTML = '';

            if (professores.length === 0) {
                professor.innerHTML = '<option value="">Nenhum professor leciona esta disciplina</option>';
                professor.disabled = true;
                return;
            }

            professor.innerHTML = '<option value="">Selecione um professor</option>';

            professores.forEach(item => {
                const opcao = document.createElement('option');
                opcao.value = item.id_professor;
                opcao.textContent = item.nome;
                professor.appendChild(opcao);
            });

            professor.disabled = false;
        });
});

document.querySelector('form').addEventListener('submit', function (evento) {
    if (idTurma.value === '') {
        evento.preventDefault();
        alert('Selecione uma turma da lista.');
    }
});
</script>

</body>
</html>
