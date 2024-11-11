<?php 
require_once("../conexao.php");

$id = $_POST['id'];

$pdo->query("DELETE FROM memorias WHERE id = '$id'");

echo 'Excluído com Sucesso';
 ?>