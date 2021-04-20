<?php
require_once 'funcoes.php';
include_once '../Classes/classeMedicamento.php';
include_once '../Classes/classeMov_Medicamento.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

	
	$title = "Saída Med";
	
	$med = new Medicamento();
	

	if(isset($_GET['id'])){
	   $medmov = new Mov_Medicamento();	
	   $listar_med = $medmov->buscarEstoqueId(base64_decode($_GET['id']));
       foreach($listar_med as $res) {
       		$med_id = $res['id_med'];
       		$med_est = $res['quant_estoque'];
       		$med_desc = $res['descricao'];
       }
       //$med_est = estoqueIdValor(base64_decode($_GET['id']));
       //MensagemAlert($med_id);
	}else{
       $listar_med = $med->buscar();
	}
			
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
    
  <form class="form" role="form" method="post">

  <div class="form-group">
      </br></br></br>
      <label for="text" class="btn btn-danger container">Saída de Medicamento</label>
    </div>
  	</br>
    <div class="form-group">
      <label for="text">Medicamento:</label></br>

      <?php if(isset($_GET['id'])) { ?>
      		<span><?php echo $med_id." - ".$med_desc; ?></span>
      		<input class='form-control' type='hidden' id="idmed" name='idmed' value=<?php echo $med_id ?> min='2016' max='2016'></input>
      <?php } else { ?>
      <select type="text" class="form-control" id="idmed" name="idmed" autofocus required>

						<option><?php echo "Selecione..."?></option>
						<?php 
						foreach($listar_med as $res) { ?>
								<option value=<?php echo $res['id'] ?>><?php echo strtoupper($res['descricao'])." - ".$res['id']." - ".$res['unidade'];?></option>
								<?php
								}
							?>
      	

      </select>
      <?php } ?>
     
      <!--input type="text" class="form-control" id="idmat" name="idmat" placeholder="" size="4" maxlength="4" required-->
    </div>
    <div class="form-group">
      <label for="text">Quantidade:</label></br>
      <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="" size="12" maxlength="12" required>
    </div>
    <div class="form-group">
      <label for="text">Validade:</label></br>
      <input type="text" class="form-control" id="validade" name="validade" placeholder="" size="5" maxlength="5" >
    </div>
    <div class="form-inline">
    	<?php if(isset($_GET['id'])) {?>
    	<span type="text" class="btn btn-default" id="" maxlength="4"><?php echo $med_est ?></span>Estoque
    	<?php }else{?>
        <span type="text" class="btn btn-default" id="estoque" maxlength="4"></span>Estoque
        <?php } ?>

    </div>
    <br>
    <div class="form-group">
      <label for="text">Observação:</label></br>
      <textarea type="text" class="form-control" id="obs" name="obs" row="3" cols="120"></textarea>
      
    </div>
    <div class="form-inline">
      
	    <span>Data</span>
	    <?php 
	    $datahj = $_SESSION['datareal'];
    	$dia=$datahj->format('d'); $mes=$datahj->format('m'); $ano=$datahj->format('Y');
	    ?>
	    <input class='form-control' type='number' name='dia' value= <?php echo $dia ?> min='1' max='31'>/</input>
	    <input class='form-control' type='number' name='mes' value=<?php echo $mes ?> min='1' max='12'>/</input>
	    <input class='form-control' type='number' name='ano' value=<?php echo $ano ?> min='2016' max='2025'></input>

    	<input type='checkbox' class='' name='listar' value='1' checked=""> Listar Estoque</input><br>
    </div>
    <br>
                
    <button type="submit" class="btn btn-primary btn-block" name="cadastrar" value="Cadastrar">Salvar</button>
    
  </form>
</div>


		</form>

		
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
	$quant_ent=0;
	$quant_sai=$_POST['quantidade'];
	$valid=isset($_POST['validade'])?$_POST['validade']:"";
	$data_mov = date("Y-m-d");
	$data_real = $data;
	if(isset($_POST['obs'])){
		$obs = utf8_decode($_POST['obs']);
	}else{
		$obs = "";
	}

	if(isset($_POST['listar'])){
		$encript = base64_encode($id_med);
		$pag = "estoque_id.php?id=$encript";	
	}else{
		$pag = "saida.php";	
	}

        //$pag = "estoque_id.php?id=$id_med";

	
	$mov = new Mov_Medicamento();

	$mov->setAtributos($id, $id_med, $novocod, $quant_ent, $quant_sai, $valid, $data_mov, $data_real, $obs);
	
	$mov->salvar($mov);

	//MensagemAlert("Teste");
	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	}
?>

</body>
</html>