<?php 
	require_once("../conexao.php");
	$nome = $_POST['nome'];
	$id = $_POST['id'];
	$telefone = $_POST['telefone'];
	$whatsapp = $_POST['whatsapp'];
	$pessoa = $_POST['pessoa'];
	$cpf = $_POST['cpf'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];
	
	if($id == ""){
		$query = $pdo->prepare("INSERT INTO clientes SET nome = :nome, telefone = :telefone, whatsapp = '$ativo', pessoa = :pessoa, cpf = :cpf, cidade = :cidade, estado = :estado  ");	
	}else{
		$query = $pdo->prepare("UPDATE clientes SET nome = :nome, ativo = '$ativo' WHERE id = '$id'");	
	}
	$query->bindValue(":nome", "$nome");
	$query->execute();
	echo "Salvo com Sucesso";

 ?>