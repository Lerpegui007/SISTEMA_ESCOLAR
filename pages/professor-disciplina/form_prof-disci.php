
<?php
require_once '../../db/conexao.php';

$sql = "SELECT id_disciplina, nome_disciplina, carga_horaria
        FROM disciplinas
        ORDER BY nome_disciplina";

$resultadoDisciplinas = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relacionar professor e disciplina</title>
    <link rel="stylesheet" href="disciplina_professor.css">
</head>
<body>

    <h1>Relacionar professor e disciplina</h1>

    <form action="envio_disciplina-professor.php" method="POST" id="formRelacao">

        <label for="pesquisaProfessor">Pesquisar professor por nome ou CPF:</label>
        <input type="text" id="pesquisaProfessor" autocomplete="off" required>

        <div id="resultados"></div>

        <input type="hidden" name="id_professor" id="id_professor">

        <p id="professorSelecionado"></p>

        <label for="id_disciplina">Selecionar disciplina:</label>
        <select name="id_disciplina" id="id_disciplina" required>
            <option value="">Escolha uma disciplina</option>

            <?php while ($disciplina = mysqli_fetch_assoc($resultadoDisciplinas)): ?>
                <option value="<?= (int)$disciplina['id_disciplina'] ?>">
                    <?= htmlspecialchars($disciplina['nome_disciplina']) ?>
                    - <?= (int)$disciplina['carga_horaria'] ?> horas
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Cadastrar relação</button>

    </form>

    <script>
        const pesquisa = document.getElementById('pesquisaProfessor');
        const resultados = document.getElementById('resultados');
        const campoIdProfessor = document.getElementById('id_professor');
        const professorSelecionado = document.getElementById('professorSelecionado');

        pesquisa.addEventListener('input', async function () {
            const termo = pesquisa.value.trim();

            campoIdProfessor.value = '';
            professorSelecionado.textContent = '';
            resultados.innerHTML = '';

            if (termo.length < 2) {
                return;
            }

            try {
                const resposta = await fetch(
                    'buscar_professor.php?termo=' + encodeURIComponent(termo)
                );

                const professores = await resposta.json();

                if (professores.length === 0) {
                    resultados.textContent = 'Nenhum professor encontrado.';
                    return;
                }

                professores.forEach(function (professor) {
                    const opcao = document.createElement('button');

                    opcao.type = 'button';
                    opcao.textContent =
                        professor.nome + ' - CPF: ' + professor.cpf;

                    opcao.addEventListener('click', function () {
                        campoIdProfessor.value = professor.id_professor;
                        pesquisa.value = professor.nome;
                        professorSelecionado.textContent =
                            'Professor selecionado: ' + professor.nome;
                        resultados.innerHTML = '';
                    });

                    resultados.appendChild(opcao);
                });

            } catch (erro) {
                resultados.textContent = 'Não foi possível realizar a pesquisa.';
                console.error(erro);
            }
        });

        document.getElementById('formRelacao').addEventListener('submit', function (event) {
            if (campoIdProfessor.value === '') {
                event.preventDefault();
                alert('Selecione um professor na lista de resultados.');
            }
        });
    </script>

</body>
</html>

