<?php 
require_once("../conexao.php");

$nome = $_POST['nome'];
$id = $_POST['id'];
$estado = $_POST['estado'];
$ativo = @$_POST['ativo'];

if($ativo == ""){
	$ativo = 'Não';
}


if($id == ""){
	$query = $pdo->prepare("INSERT INTO cidades SET nome = :nome, estado = :estado, ativo = '$ativo'");	
}else{
	$query = $pdo->prepare("UPDATE cidades SET nome = :nome, estado = :estado, ativo = '$ativo' WHERE id = '$id'");	
}


$query->bindValue(":nome", "$nome");
$query->bindValue(":estado", "$estado");
$query->execute();

echo 'Salvo com Sucesso';
 ?>