<?php 
$tabela = 'estados';
require_once("../conexao.php");

$query = $pdo->query("SELECT * from $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table">
	<thead> 
	<tr>
	<th>Id</th>	
	<th>Nome</th>
	<th>Ativo</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;


for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$ativo = $res[$i]['ativo'];
		
echo <<<HTML
<tr onclick="editar('{$id}', '{$nome}', '{$ativo}')">
<td>{$id}</td>
<td>{$nome}</td>
<td>{$ativo}</td>
<td>
	<a href="#" onclick="editar('{$id}', '{$nome}', '{$ativo}')"><i class="bi bi-pencil-square text-primary"></i></a>
	<a href="#" onclick="excluir('{$id}')"><i class="bi bi-trash3 text-danger"></i></a>
</td>

</tr>
HTML;

}


echo <<<HTML
</tbody>
</table>
HTML;

}else{
	echo '<small>Nenhum Registro Encontrado!</small>';
}

?>

<script type="text/javascript">
	function excluir(id){
		$.ajax({
	        url: pag + "/deleteState.php",
	        method: 'POST',
	        data: {id},
	        dataType: "html",

	        success:function(result){
	            if(result.trim() == 'Excluído com Sucesso'){
	            	listar();
	            }else{
	            	$('#mensagem').addClass('text-danger')
                $('#mensagem').text(mensagem)
	            }        
	        }
    	});
	}

	function editar(id, nome, ativo){
		$('#nameState').val(nome);
		$('#id').val(id);

		if(ativo == 'Sim'){
			$('#ativo').prop('checked', true);
		}else{
			$('#inativo').prop('checked', true);
		}

		$("#btn_saveState").text('Editar'); 
		$("#btn_saveState").removeClass('btn-success');
    $("#btn_saveState").addClass('btn-primary'); 
	}
</script>