<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

	
	$title = "Entrada de Medicamento";
	
	$material = new Material();
	$mat = $material->buscar();
			
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
				dayNames: ['Domingo','Segunda','Ter?a','Quarta','Quinta','Sexta','S?bado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S?b','Dom'],
				monthNames: ['Janeiro','Fevereiro','Mar?o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
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
				
				dayNames: ['Domingo','Segunda','Ter?a','Quarta','Quinta','Sexta','S?bado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S?b','Dom'],
				monthNames: ['Janeiro','Fevereiro','Mar?o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
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
				dayNames: ['Domingo','Segunda','Ter?a','Quarta','Quinta','Sexta','S?bado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S?b','Dom'],
				monthNames: ['Janeiro','Fevereiro','Mar?o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				
			});
		</script>

	</head>
		
	<body class="bodyMaterial">
		
	<?php echo nav2() ?>

    <div class="container">
    </br></br></br>
  <form class="form" role="form" method="post">

  	<div class="form-group">
      <label for="text" class="btn btn-success container">Entrada de Validades</label>
    </div>
  	</br>
    <div class="form-group">
      <label for="text">Material:</label></br>
      <select type="text" class="form-control" id="idmat" name="idmat" autofocus required>

						<option><?php echo "SELECIONE..."?></option>
						<?php 
						foreach($mat as $res) { ?>
								<option value=<?php echo $res['id'] ?>><?php echo strtoupper(utf8_encode($res['descricao']))." - ".$res['codigo'];?></option>
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
        
            
    <button type="submit" class="btn btn-primary btn-block" name="cadastrar" value="Cadastrar">Salvar</button>
    <button type="submit" class="btn btn-info btn-block" onClick="history.go(-1)">Voltar</button>
  </form>
</div>


		
<?php

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}

	
	//Teste se o bot?o salvar foi clicado
	if(isset($_POST['cadastrar'])){

	$id = $_POST['idmat'];
	$val1 = datatobd($_POST['val1']);
	$val2 = datatobd($_POST['val2']);
	$val3 = datatobd($_POST['val3']);

	$mat = $material->buscarId($id);

	foreach ($mat as $res) {
		$desc = $res['descricao'];
		$unid = $res['unidade'];
		$cod = $res['codigo'];
	}

	//echo $desc;

	$material->setAtributos($id, $desc, $unid, $cod, $val1, $val2, $val3);
	
	$material->atualizar($material);
	
	$pag = "../Medicamento/entValidade.php";
		
	
	//MensagemAlert("Teste");
	
	//echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	}
?>

</body>
</html>