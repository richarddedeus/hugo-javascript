<?php 
require_once("header.php");
$pag = 'clients';
?>
<div class="container-fluid" style="background: #f5f2f2; padding:10px">
  <form id="form">
    <div class="row">
    
      <div class="col-md-3">
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
      </div>
      <div class="col-md-1">
        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
      </div>
      <div class="col-md-1">     
        <div class="form-check">
          <input class="form-check-input" type="radio" name="whatsapp" id="whatsapp" value="Sim" checked>
          <label class="form-check-label" for="flexRadioDefault1">
            whatsapp
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="whatsapp" id="inativo" value="Não" >
          <label class="form-check-label" for="flexRadioDefault2">
            não
          </label>
        </div>
      </div>
      <div class="col-md-1" style="padding:0px">      
         <select class="form-select" id="pessoa" name="pessoa" onchange="mudarPessoa()">
             <option value="Física">Física</option>
             <option value="Jurídica">Jurídica</option>
         </select>
     </div>´
     <div class="col-md-1" style="padding:0px; padding-left: 2px">      
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required="">
    </div>
    <div class="col-md-2" id="listar_cidades">      

    </div>
      <div class="col-md-1">
        <select class="form-select" id="nameState" name="nameState">
        <?php 
          $query = $pdo->query("SELECT * from estados order by id desc");
          $res = $query->fetchAll(PDO::FETCH_ASSOC);
          $linhas = @count($res);
          for($i=0; $i<$linhas; $i++){
              echo '<option value="'.$res[$i]['nome'].'">'.$res[$i]['nome'].'</option>';
          }

        ?>
        </select>
      </div>
      
      
      <div class="col-md-1">
          <button id="btn_salvar" type="submit" class="btn btn-success">Salvar</button>
      </div>
      

      <input type="hidden" name="id" id="id">
    
    </div><!--row-->
    <div class="col-md-12" align="center" style="margin-top: 5px">      
        <small><div id="mensagem"></div></small>
      </div>
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
      url: pag + '/saveClient.php',
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
      url: pag + "/listClient.php",
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
    $("#nome").val('');  
        $("#id").val('');
        $("#telefone").val('');
        $("#whatsapp").val('Sim');
        $("#pessoa").val('Física'); 
        $("#cpf").val('');
        $("#btn_salvar").text('Salvar'); 
        $("#btn_salvar").addClass('btn-success'); 
        $("#dados_clientes").hide();
   }

   function mudarPessoa(){ 
        var pessoa = $("#pessoa").val();
        if(pessoa == 'Física'){
            $("#cpf").attr("placeholder", "CPF");
            $('#cpf').mask('000.000.000-00');  
        }else{
            $("#cpf").attr("placeholder", "CNPJ"); 
            $('#cpf').mask('00.000.000/0000-00');     
        }

    }
</script>