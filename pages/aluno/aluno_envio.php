<?php
$nome=$_POST['nome'];
$data_nascimento=$_POST['data-nascimento'];
$cpf=$_POST['numero_cpf'];
$telefone=$_POST['telefone-user'];
$email=$_POST['email'];
$endereco=$_POST['endereco-completo'];
$bairro=$_POST['bairro'];
$ativo = $_POST ['ativo'];

require('../../db/conexao.php');
$sqlinsert="insert into alunos values ('','$nome','$cpf','$data_nascimento','$bairro','$endereco','$telefone','$email','$ativo')";
mysqli_query($db,$sqlinsert) or die('Não foi possível inserir');
echo "<script>alert('cadastro inserido com sucesso')</script>";
?>
