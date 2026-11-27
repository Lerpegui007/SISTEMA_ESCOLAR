
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escola Projeto - Página Inicial</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f7;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #243b55;
            color: white;
            text-align: center;
            padding: 25px;
        }

        header h1 {
            margin: 0;
        }

        main {
            width: 80%;
            max-width: 900px;
            margin: 30px auto;
        }

        h2 {
            color: #243b55;
            margin-bottom: 15px;
        }

        .menu-btn {
            position: absolute;
            left: 20px;
            top: 25px;
            background: none;
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -260px;
            width: 260px;
            height: 100%;
            background-color: #243b55;
            padding: 20px;
            box-sizing: border-box;
            z-index: 1000;
            transition: left 0.3s ease;
        }

        .sidebar.aberto {
            left: 0;
        }

        .sidebar h2 {
            color: white;
            margin-bottom: 25px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 10px;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #365d85;
        }

        #overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 999;
        }

        #overlay.ativo {
            display: block;
        }


        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 35px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h3 {
            color: #243b55;
        }

        .card p {
            color: #666;
        }

        .card a {
            display: inline-block;
            background-color: #243b55;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .card a:hover {
            background-color: #365d85;
        }

        footer {
            background-color: #243b55;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }

        @media (max-width: 600px) {
            .container {
                grid-template-columns: 1fr;
            }

            main {
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <header>
        <h1>Sistema Escolar</h1>
        <p>Gerenciamento de Cadastros Escolares</p>
        <button class="menu-btn" onclick="abrirMenu()">
            ☰
        </button>
    </header>

    <div class="sidebar" id="sidebar">

        <h2>Menu</h2>

        <a href="../index.php">Início</a>

        <a href="home.php">Cadastros</a>

        <a href="consulta.php">Consultas</a>

    </div>

    <div class="overlay" id="overlay" onclick="fecharMenu()"></div>

    <main>

        <h2>Cadastros Principais</h2>

        <div class="container">

            <div class="card">
                <h3>Alunos</h3>
                <p>Cadastre alunos da escola.</p>
                <a href="./pages/aluno/form_aluno.php">Acessar cadastro</a>
            </div>

            <div class="card">
                <h3>Professores</h3>
                <p>Cadastre professores</p>
                <a href="./pages/professor/form_professor.php">Acessar cadastro</a>
            </div>

            <div class="card">
                <h3>Disciplinas</h3>
                <p>Cadastre disciplinas</p>
                <a href="./pages/disciplina/forms_disciplina.php">Acessar cadastro</a>
        </div>

            <div class="card">
                <h3>Turmas</h3>
                <p>Cadastre turmas</p>
                <a href="./pages/turma/form_turma.php">Acessar cadastro</a>
            </div>

        </div>

        <h2>Relacionamentos</h2>

        <div class="container">

            <div class="card">
                <h3>Professor e Disciplina</h3>
                <p>Vincule professores às disciplinas.</p>
                <a href="professor-disciplina/form_prof-disci.php">Acessar cadastro</a>
            </div>

            <div class="card">
                <h3>Turma, Disciplina e Professor</h3>
                <p>Organize as disciplinas e professores de cada turma.</p>
                <a href="turma-professor-disciplina/form_turma-disciplina-professor.php">Acessar cadastro</a>
            </div>

            <div class="card">
                <h3>Matrícula de Alunos</h3>
                <p>Vincule os alunos às suas respectivas turmas.</p>
                <a href="turma-aluno/form_turma-aluno.php">Acessar cadastro</a>
            </div>

        </div> 

    </main>

    <footer>
        <p>Sistema Escolar - Projeto em Desenvolvimento por Lucas Emanuel</p>
    </footer>

    <script>

        function abrirMenu() {

            document.getElementById("sidebar").classList.add("aberto");

            document.getElementById("overlay").classList.add("ativo");

        }

        function fecharMenu() {

            document.getElementById("sidebar").classList.remove("aberto");

            document.getElementById("overlay").classList.remove("ativo");

        }

        function abrirRelacionamentos() {

            document.getElementById("relacionamentos").classList.toggle("ativo");

        }

    </script>


</body>
</html>

2
