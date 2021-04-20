<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

	
	$title = "Entrada de Medicamento";
	
	$medicamento = new Medicamento();
	$med = $medicamento->buscar();
			
	?>
<!doctype>
<html>
	<head>
		<title><?php echo $title?></title>
		
		<?php echo cabecalho() ?>

		<script>
			$(function() {
				$("#calendario").datepicker({
			    changeMonth: true,
                            changeYear: true,
                            yearRange: '2010:2030',
                            dateFormat : 'dd/mm/yy',
                            defaultDate: new Date().getDay+360,
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				
			});
			$(function() {
				$("#calendario1").datepicker({
                            changeMonth: true,
                            changeYear: true,
                            yearRange: '2010:2030',
                            dateFormat : 'dd/mm/yy',
                            defaultDate: new Date(2017, 0, 30),
				
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				
			});
			$(function() {
				$("#calendario2").datepicker({
			    changeMonth: true,
                            changeYear: true,
                            yearRange: '2010:2030',
                            dateFormat : 'dd/mm/yy',
                            defaultDate: new Date(2017, 0, 30),
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				
			});
		</script>

	</head>
		
	<body>
		
	<?php echo nav2() ?>

    <div class="container">
    </br></br></br>
  <form class="form" role="form" method="post">

  	<div class="form-group">
      <label for="text" class="btn btn-success container">Entrada de Validades</label>
    </div>
  	</br>
    <div class="form-group">
      <label for="text">Medicamento:</label></br>
      <select type="text" class="form-control" id="idmed" name="idmed" autofocus required>

						<option><?php echo "SELECIONE..."?></option>
						<?php 
						foreach($med as $res) { ?>
								<option value=<?php echo $res['id'] ?>><?php echo strtoupper(utf8_encode($res['descricao']))." - ".$res['id'];?></option>
								<?php
								}
							?>
      	

      </select>
      <!--input type="text" class="form-control" id="idmat" name="idmat" placeholder="" size="4" maxlength="4" required-->
    </div>
    <div class="form-group">
      <label for="text">Validade 1:</label></br>
      <input type="text" class="form-control" id="calendario" name="val1" placeholder="" size="10" maxlength="10" required>
    </div>
    <div class="form-group">
      <label for="text">Validade 2:</label></br>
      <input type="text" class="form-control" id="calendario1" name="val2" placeholder="" size="10" maxlength="10" >
    </div>
    <div class="form-group">
      <label for="text">Validade 3:</label></br>
      <input type="text" class="form-control" id="calendario2" name="val3" placeholder="" size="10" maxlength="10" >
    </div>
        
            
    <button type="submit" class="btn btn-primary" name="cadastrar" value="Cadastrar">Salvar</button>
    <button type="submit" class="btn btn-info" onClick="history.go(-1)">Voltar</button>
  </form>
</div>


		
<?php

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}

	
	//Teste se o botÃ£o salvar foi clicado
	if(isset($_POST['cadastrar'])){

	$id = $_POST['idmed'];
	$val1 = datatobd($_POST['val1']);
	$val2 = datatobd($_POST['val2']);
	$val3 = datatobd($_POST['val3']);

	$med = $medicamento->buscarId($id);

	foreach ($med as $res) {
		$desc = $res['descricao'];
		$unid = $res['unidade'];
	}

	$medicamento->setAtributos($id, $desc, $unid, $val1, $val2, $val3);
	
	$medicamento->atualizar($medicamento);
	
	$pag = "../Medicamento/entValidade.php";
		
	
	//MensagemAlert("Teste");
	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	}
?>

</body>
</html>