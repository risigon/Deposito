<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

	
	$title = "Entrada Med";
	
	$medicamento = new Medicamento();
	$med = $medicamento->buscar();
			
	?>
<!doctype>
<html>
	<head>
		<title><?php echo $title?></title>
		
		<?php echo cabecalho() ?>

		<script>
		$(document).ready(function(){
    		$('#idmed').change(function(){
        	$('#estoque').load('estoque_id3.php?id='+$('#idmed').val() );
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
  	  </br></br></br>
      <label for="text" class="btn btn-success container">Entrada de Medicamento</label>
    </div>
  	</br>
    <div class="form-group">
      <label for="text">Medicamento:</label></br>
      <select type="text" class="form-control" id="idmed" name="idmed" autofocus required>

						<option><?php echo "SELECIONE..."?></option>
						<?php 
						foreach($med as $res) { ?>
								<option value=<?php echo $res['id'] ?>><?php echo strtoupper($res['descricao'])." - ".$res['id']." - ".$res['unidade'];?></option>
								<?php
								}
							?>
      	

      </select>
      <!--input type="text" class="form-control" id="idmat" name="idmat" placeholder="" size="4" maxlength="4" required-->
    </div>
    <div class="form-group">
      <label for="text">Quantidade:</label></br>
      <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="" size="12" maxlength="12" required>
    </div>
    <div class="form-group">
      <label for="text">Validade:</label></br>
      <input type="text" class="form-control" id="validade" name="validade" placeholder="" size="5" maxlength="5">
    </div>

    <div class="form-inline">
        Estoque <span type="text" class="btn btn-success" id="estoque" maxlength="4"></span>
            	
    </div>
    <br>

    <div class="form-group">
      <label for="text">Observação:</label></br>
      <textarea type="text" class="form-control" id="obs" name="obs" placeholder="observação" row="3" cols="120" maxlength="200"></textarea>
    </div>
      
    <div class="form-inline">
    	<span>Data</span>
    <?php 

    $datahj = $_SESSION['datareal'];
    $dia=$datahj->format('d'); $mes=$datahj->format('m'); $ano=$datahj->format('Y');

    ?>
    	<input class='form-control' type='number' name='dia' value= <?php echo $dia ?> min='1' max='31'>/</input>
    	<input class='form-control' type='number' name='mes' value= <?php echo $mes ?> min='1' max='12'>/</input>
    	<input class='form-control' type='number' name='ano' value= <?php echo $ano ?> min='2016' max='2025'></input>
      
    </div>
    <div class="form-inline">
        	<input type='checkbox' class='' name='listar' value='1'> Listar Estoque</input>
    </div>
    
     
    <br>
            
    <button type="submit" class="btn btn-primary btn-block" name="cadastrar" value="Cadastrar">Salvar</button>
    
  </form>
</div>


		
<?php

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}

	
	//Teste se o botão salvar foi clicado
	if(isset($_POST['cadastrar'])){

	$data = $_POST['ano'].'-'.$_POST['mes'].'-'.$_POST['dia'];

	$id = "000000";
	$id_med = $_POST['idmed'];
	$quant_ent=$_POST['quantidade'];
	$quant_sai=0;
	$valid=$_POST['validade'];
	$data_mov = date("Y-m-d");
	$data_real = $data;
	$obs = isset($_POST['obs'])?$_POST['obs']:"";

	
	$movimento = new Mov_Medicamento();

	$movimento->setAtributos($id, $id_med, $codnovo, $quant_ent, $quant_sai, $valid, $data_mov, $data_real, $obs);
	
	$movimento->salvar($movimento);

	if(isset($_POST['listar'])){
                $encript = base64_encode($id_med);
		$pag = "estoque_id.php?id=$encript";
	}else{
		$pag = "entrada.php";
	}

	//$pag = "estoque_id.php?id=$id_med";

	//MensagemAlert("Teste");
	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	}
?>

</body>
</html>