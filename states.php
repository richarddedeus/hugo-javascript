<?php 
require_once("header.php");
$pag = 'states';
?>
<div class="container" style="background: #f5f2f2; padding:10px">
  <form id="form">
    <div class="row">
    
      <div class="col-md-2">
        <input type="text" class="form-control" id="nameState" name="nameState" placeholder="Sigla" required>
      </div>
      <div class="col-md-2">     
        <div class="form-check">
          <input class="form-check-input" type="radio" name="ativo" id="ativo" value="Sim" checked>
          <label class="form-check-label" for="flexRadioDefault1">
            Ativo
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="ativo" id="inativo" value="Não" >
          <label class="form-check-label" for="flexRadioDefault2">
            Inativo
          </label>
        </div>
      </div>
      <div class="col-md-2">
          <button id="btn_saveState" type="submit" class="btn btn-success">Salvar</button>
      </div>
      <div class="col-md-6">
        <div id="message"></div>
      </div><!--mensagem-->

      <input type="hidden" name="id" id="id">
    
    </div><!--row-->
  </form>
  <div id="listar" style="margin-top: 20px">
  
    
  </div><!--listar-->
  
</div><!--container-->

<script type="text/javascript">
  
  var pag = "<?=$pag?>"

  $(document).ready(function(){
    listar()
    limparCampos()
  })

  $("#form").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $("#btn_salvar").hide(); 
    $('#mensagem').text('Salvando!!!');

    $.ajax({
      url: pag + '/saveStates.php',
      type: 'POST',
      data: formData,

      success: function (message) {
        $('#message').text('');
        $('#message').removeClass()
        if (message.trim() == "Salvo com Sucesso") {
          //$('#message').addClass('text-success')
          //$('#message').text(message)  
          listar(); 
          limparCampos();         

        } else {

            $('#message').addClass('text-danger')
            $('#message').text(message)
        }

        $("#btn_salvar").show();
      },

      cache: false,
      contentType: false,
      processData: false,

    });
  });

  function listar(p1, p2, p3, p4, p5, p6) {
    $.ajax({
      url: pag + "/listState.php",
      method: 'POST',
      data: {
        p1,
        p2,
        p3,
        p4,
        p5,
        p6
      },
      dataType: "html",

      success: function(result) {
        $("#listar").html(result);
      }
    });
  }

  function limparCampos(){
       $("#nameState").val('');  
       $("#id").val(''); 
       $("#btn_saveState").text('Salvar'); 
       $("#btn_saveState").addClass('btn-success'); 
   }
</script>