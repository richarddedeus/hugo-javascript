<?php 
require_once("../conexao.php");

$evento = $_POST['evento'];
$data = $_POST['data'];
$datafinal = $_POST['datafinal'];
$id = $_POST['id'];


if($id == ""){
	$query = $pdo->prepare("INSERT INTO memorias SET evento = :evento, data = :data, datafinal = :datafinal ");	
}else{
	$query = $pdo->prepare("UPDATE memorias SET evento = :evento, data = :data, datafinal = :datafinal WHERE id = '$id'");	
}


$query->bindValue( ":evento", "$evento");
$query->bindValue( ":data", "$data");
$query->bindValue( ":datafinal", "$datafinal");
$query->execute();

echo 'Salvo com Sucesso';
 ?>