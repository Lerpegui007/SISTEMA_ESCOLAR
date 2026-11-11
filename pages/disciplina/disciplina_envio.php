<?php

$nome = $_POST ['nome_disciplina'];
$carga_horaria = $_POST ['carga_horaria'];

require('./db/conexao.php');
$sqlinsert = "insert into disciplinas values ('','$nome','$carga_horaria')";
mysqli_query($db,$sqlinsert) or die('Não foi possível inserir');
echo "<script>alert('cadastro inserido com sucesso')</script>";


?>