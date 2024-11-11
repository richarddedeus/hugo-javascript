<?php 
require_once("../conexao.php");

$evento = $_POST['evento'];
$data = $_POST['data'];
$id = $_POST['id'];


if($id == ""){
	$query = $pdo->prepare("INSERT INTO memorias SET evento = :evento, data = :data");	
}else{
	$query = $pdo->prepare("UPDATE memorias SET evento = :evento, data = :data WHERE id = '$id'");	
}


$query->bindValue( ":evento", "$evento");
$query->bindValue( ":data", "$data");
$query->execute();

echo 'Salvo com Sucesso';
 ?>