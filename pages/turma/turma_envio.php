<?php

$nome = $_POST ['nome_turma'];
$serie = $_POST ['ano_letivo'];
$turno = $_POST ['turno'];

require('../../db/conexao.php');
$sqlinsert = "insert into turmas values('','$nome','$serie','$turno')";
mysqli_query($db,$sqlinsert) or die('Não foi possível inserir');
echo "<script>alert('cadastro inserido com sucesso')</script>";

?>
