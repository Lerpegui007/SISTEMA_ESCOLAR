
<?php

require_once '../../db/conexao.php';

// Busca as turmas cadastradas
$sqlTurmas = "SELECT id_turma, nome_turma, ano_letivo, turno
              FROM turmas
              ORDER BY ano_letivo DESC, nome_turma ASC";

$resultadoTurmas = mysqli_query($db, $sqlTurmas);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Matrícula de Alunos</title>

    <link rel="stylesheet" href="turma_aluno.css">
</head>
<body>

    <main class="container">

        <h1>Matricular aluno em turma</h1>

        <p class="descricao">
            Pesquise um aluno e selecione a turma na qual deseja matriculá-lo.
        </p>

        <form action="envio_turma-aluno.php" method="POST" id="formMatricula">

            <!-- Pesquisa do aluno -->
            <div class="campo">
                <label for="pesquisaAluno">Pesquisar aluno</label>

                <input
                    type="text"
                    id="pesquisaAluno"
                    placeholder="Digite o nome ou CPF do aluno..."
                    autocomplete="off"
                    required
                >

                <!-- Resultados da pesquisa -->
                <div id="resultadosAlunos" class="resultados"></div>

                <!-- ID do aluno selecionado -->
                <input type="hidden" name="id_aluno" id="id_aluno">

                <p id="alunoSelecionado" class="selecionado"></p>
            </div>

            <!-- Seleção da turma -->
            <div class="campo">
                <label for="id_turma">Selecionar turma</label>

                <select name="id_turma" id="id_turma" required>

                    <option value="">Escolha uma turma</option>

                    <?php if ($resultadoTurmas && mysqli_num_rows($resultadoTurmas) > 0): ?>

                        <?php while ($turma = mysqli_fetch_assoc($resultadoTurmas)): ?>

                            <option value="<?= (int)$turma['id_turma'] ?>">
                                <?= htmlspecialchars($turma['nome_turma']) ?>
                                - <?= htmlspecialchars($turma['ano_letivo']) ?>
                                (<?= htmlspecialchars($turma['turno']) ?>)
                            </option>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <option value="" disabled>
                            Nenhuma turma cadastrada
                        </option>

                    <?php endif; ?>

                </select>
            </div>

            <button type="submit">Cadastrar matrícula</button>

        </form>

    </main>

    <script>

        const pesquisaAluno = document.getElementById('pesquisaAluno');
        const resultadosAlunos = document.getElementById('resultadosAlunos');
        const idAluno = document.getElementById('id_aluno');
        const alunoSelecionado = document.getElementById('alunoSelecionado');
        const formMatricula = document.getElementById('formMatricula');

        // Pesquisa os alunos enquanto o usuário digita
        pesquisaAluno.addEventListener('input', async function() {

            const termo = this.value.trim();

            // Limpa a seleção anterior
            idAluno.value = '';
            alunoSelecionado.textContent = '';
            resultadosAlunos.innerHTML = '';

            if (termo.length < 2) {
                return;
            }

            try {

                const resposta = await fetch(
                    'buscar_aluno.php?termo=' + encodeURIComponent(termo)
                );

                if (!resposta.ok) {
                    throw new Error('Erro na pesquisa.');
                }

                const alunos = await resposta.json();

                if (!Array.isArray(alunos)) {
                    throw new Error('Resposta inválida.');
                }

                if (alunos.length === 0) {
                    resultadosAlunos.textContent = 'Nenhum aluno encontrado.';
                    return;
                }

                // Exibe os alunos encontrados
                alunos.forEach(function(aluno) {

                    const opcao = document.createElement('button');

                    opcao.type = 'button';
                    opcao.className = 'opcao-aluno';

                    opcao.textContent = aluno.nome + ' - CPF: ' + aluno.cpf;

                    opcao.addEventListener('click', function() {

                        // Guarda o ID do aluno
                        idAluno.value = aluno.id_aluno;

                        // Preenche o campo com o nome escolhido
                        pesquisaAluno.value = aluno.nome;

                        // Exibe a confirmação
                        alunoSelecionado.textContent =
                            'Aluno selecionado: ' + aluno.nome;

                        // Fecha a lista de resultados
                        resultadosAlunos.innerHTML = '';

                    });

                    resultadosAlunos.appendChild(opcao);

                });

            } catch (erro) {

                resultadosAlunos.textContent =
                    'Não foi possível realizar a pesquisa.';

                console.error(erro);

            }

        });

        // Impede o envio sem selecionar um aluno
        formMatricula.addEventListener('submit', function(event) {

            if (idAluno.value === '') {

                event.preventDefault();

                alert('Selecione um aluno antes de cadastrar a matrícula.');

                pesquisaAluno.focus();

            }

        });

    </script>

</body>
</html>

