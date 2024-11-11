<?php 
require_once("cabecalho.php");
$pag = 'memorias';
?>

<div class="container" style="background: #f5f2f2; padding:10px">
	<form id="form">
	<div class="row">
		
			<div class="col-md-3"> 	    
				<input type="text" class="form-control" id="evento" name="evento" placeholder="Minha memória" >
			</div>

            <div class="col-md-2">      
            <input type="date" class="form-control" id="data" name="data" value="1902-07-21"> 
            </div>

            

			<div class="col-md-1"> 	    
				<button id="btn_salvar" type="submit" class="btn btn-primary">Salvar</button>
			</div>

			<div class="col-md-6"> 	    
				<div id="mensagem"></div>
			</div>

			<input type="hidden" name="id" id="id">
		
	</div>
	</form>

	<div id="listar" style="margin-top: 20px">
		
	</div>


</div>

<script type="text/javascript">var pag = "<?=$pag?>"</script>

<script type="text/javascript">

$(document).ready( function () {    
    listar();
    limparCampos();
});
    
$("#form").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $("#btn_salvar").hide(); 
    $('#mensagem').text('Salvando!!!');

    $.ajax({
        url: pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {
                $('#mensagem').addClass('text-success')
                $('#mensagem').text(mensagem)                
                listar();
                limparCampos();      

            } else {
                $('#mensagem').addClass('text-danger')
                $('#mensagem').text(mensagem)
            }

            $("#btn_salvar").show(); 


        },



        cache: false,
        contentType: false,
        processData: false,

    });

});


    function listar(p1, p2, p3, p4, p5, p6){    
    $.ajax({
        url: pag + "/listar.php",
        method: 'POST',
        data: {p1, p2, p3, p4, p5, p6},
        dataType: "html",

        success:function(result){
            $("#listar").html(result);            
        }
    });
}


function limparCampos(){
    $("#ento").val('');  
    $("#id").val(''); 
    $("#btn_salvar").text('Salvar'); 
    $("#btn_salvar").addClass('btn-success'); 
}
</script>