<?php 
$tabela = 'memorias';
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
	<th>Evento</th>
	<th>Data</th>
	<th>Tempo Passado</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;


for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$evento = $res[$i]['evento'];
	$data = $res[$i]['data'];
	// Formata a data para exibir no formato d/m/Y
	$dataParaExibir = date("d/m/Y", strtotime($data));
    
	// Calcula o tempo passado
	$dataEvento = new DateTime($data);
	$dataAtual = new DateTime(); // Data atual
	$diferenca = $dataAtual->diff($dataEvento);

	// Constrói a string de tempo decorrido
	$tempoPassado = [];
	
	if ($diferenca->y > 0) {
			$tempoPassado[] = $diferenca->y . " ano" . ($diferenca->y > 1 ? "s" : "");
	}
	if ($diferenca->m > 0) {
			$tempoPassado[] = $diferenca->m . " mês" . ($diferenca->m > 1 ? "es" : "");
	}
	if ($diferenca->d > 0) {
			$tempoPassado[] = $diferenca->d . " dia" . ($diferenca->d > 1 ? "s" : "");
	}

	// Caso a data seja hoje, define como "Hoje"
	if (empty($tempoPassado)) {
			$tempoPassado = "Hoje";
	} else {
			$tempoPassado = implode(", ", $tempoPassado);
	}

echo <<<HTML
<tr>
<td>{$id}</td>
<td>{$evento}</td>
<td>{$dataParaExibir}</td>
<td>{$tempoPassado}</td>
<td>
	<a href="#" onclick="editar('{$id}', '{$evento}', '{$data}')"><i class="bi bi-pencil-square text-primary"></i></a>
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

	function editar(id, evento, data){
		$('#evento').val(evento);
		$('#id').val(id);
		$('#data').val(data).change();

		$("#btn_salvar").text('Editar'); 
		$("#btn_salvar").removeClass('btn-success');
    	$("#btn_salvar").addClass('btn-primary'); 
	}
</script>