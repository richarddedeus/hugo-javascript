<?php 
	require_once("../conexao.php");
	$nome = $_POST['nameCity'];
	$estado = $_POST['nameState'];
	$id = $_POST['id'];
	$ativo = $_POST['ativo'];
	if($id == ""){
		$query = $pdo->prepare("INSERT INTO cidades SET nome = :nome, estado = :estado, ativo = '$ativo'");	
	}else{
		$query = $pdo->prepare("UPDATE cidades SET nome = :nome, estado = :estado, ativo = '$ativo' WHERE id = '$id'");	
	}
	$query->bindValue(":nome", "$nome");
	$query->bindValue(":estado", "$estado");
	$query->execute();
	echo "Salvo com Sucesso";

 ?>