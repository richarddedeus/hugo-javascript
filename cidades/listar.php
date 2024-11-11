<?php 
$tabela = 'cidades';
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
	<th>Estado</th>
	<th>Ativa</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;


for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$estado = $res[$i]['estado'];
	$ativo = $res[$i]['ativo'];
		
echo <<<HTML
<tr>
<td>{$id}</td>
<td>{$nome}</td>
<td>{$estado}</td>
<td>{$ativo}</td>
<td>
	<a href="#" onclick="editar('{$id}', '{$nome}', '{$estado}', '{$ativo}')"><i class="bi bi-pencil-square text-primary"></i></a>
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
	        url: pag + "/excluir.php",
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

	function editar(id, nome, estado, ativo){
		$('#nome').val(nome);
		$('#id').val(id);
		$('#estado').val(estado).change();

		if(ativo == 'Sim'){
			$('#ativo').prop('checked', true);
		}else{
			$('#ativo').prop('checked', false);
		}
		

		$("#btn_salvar").text('Editar'); 
		$("#btn_salvar").removeClass('btn-success');
    	$("#btn_salvar").addClass('btn-primary'); 
	}
</script>