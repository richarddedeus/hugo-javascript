<?php 
$tabela = 'clientes';
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
	<th>ID</th>
	<th>Nome</th>
	<th>Telefone</th>
	<th>whatsapp</th>
	<th>Pessoa</th>
	<th>CPF/CNPJ</th>
	<th>Cidade</th>
	<th>Estado</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;


for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$telefone = $res[$i]['telefone'];
	$whatsapp = $res[$i]['whatsapp'];
	$pessoa = $res[$i]['pessoa'];
	$cpf = $res[$i]['cpf'];
	$cidade = $res[$i]['cidade'];
	$estado = $res[$i]['estado'];
	
		
echo <<<HTML
<tr onclick="editar('{$id}', '{$nome}', '{$telefone}', '{$whatsapp}', '{$pessoa}', '{$cpf}', '{$cidade}', '{$estado}')">
<td>{$id}</td>
<td>{$nome}</td>
<td>{$telefone}</td>
<td>{$whatsapp}</td>
<td>{$pessoa}</td>
<td>{$cpf}</td>
<td>{$cidade}</td>
<td>{$estado}</td>
<td>
	<a href="#" onclick="editar('{$id}', '{$nome}', '{$telefone}', '{$whatsapp}', '{$pessoa}', '{$cpf}', '{$cidade}', '{$estado}')"><i class="bi bi-pencil-square text-primary"></i></a>
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
	        url: pag + "/deleteclient.php",
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

	function editar(id, nome, telefone, whatsapp, pessoa, cpf, cidade, estado){
		$('#nameCity').val(nome);
		$('#id').val(id);
		$('#nome').val(nome);
		$('#telefone').val(telefone);

		if(whatsapp == 'Sim'){
			$('#ativo').prop('checked', true);
		}else{
			$('#inativo').prop('checked', true);
		}

		$('#pessoa').val(pessoa).change();
		$('#cpf').val(cpf);
		$('#nameCity').val(cidade).change();
		$('#nameState').val(estado).change();


		$("#btn_salvar").text('Editar'); 
		$("#btn_salvar").removeClass('btn-success');
		$("#btn_salvar").addClass('btn-primary'); 
	}
</script>