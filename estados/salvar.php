<?php 
require_once("../conexao.php");

$nome = $_POST['nome'];
$id = $_POST['id'];
$ativo = $_POST['ativo'];

if($id == ""){
	$query = $pdo->prepare("INSERT INTO estados SET nome = :nome, ativo = '$ativo'");	
}else{
	$query = $pdo->prepare("UPDATE estados SET nome = :nome, ativo = '$ativo' WHERE id = '$id'");	
}


$query->bindValue(":nome", "$nome");
$query->execute();

echo 'Salvo com Sucesso';
 ?>