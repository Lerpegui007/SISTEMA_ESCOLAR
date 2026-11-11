<?php

$nome = $_POST ['nome'];
$cpf = $_POST ['cpf'];
$especialidade = $_POST ['especialidade'];
$email = $_POST ['email'];
$telefone = $_POST ['telefone1'];
$ativo = $_POST ['ativo'];

require('../../db/conexao.php');
$sqlinsert = "inset into professores values ('','$cpf','$nome','$especialidade','$email','$telefone','$ativo')";
mysqli_query($db,$sqlinsert) or die('Não foi possível inserir');
echo "<script>alert('cadastro inserido com sucesso')</script>";

?>
