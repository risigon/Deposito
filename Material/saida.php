<?php
require_once 'funcoes.php';
include_once '../Classes/classeMaterial.php';
include_once '../Classes/classeMovimento.php';


$usuario = sessao();

if(isset($_SESSION['usuario'])){

	
	$title = "Saída Mat";

	$material = new Material();

	if(isset($_GET['id'])){
       $mat = $material->buscarId(base64_decode($_GET['id']));
       foreach($mat as $res) {
       		$mat_id = $res['id'];
                $mat_cod = $res['codigo'];
       		$mat_desc = $res['descricao'];
       }
       $mat_est = estoqueIdValor(base64_decode($_GET['id']));
       //MensagemAlert($mat_est);
	}else{
       $mat = $material->buscar();
	}

			
	?>
<!doctype>
<html>
	<head>
		<title><?php echo $title?></title>
		
		<?php echo cabecalho() ?>

	    <script>
		$(document).ready(function(){
    		$('#idmat').change(function(){
        	$('#estoque').load('estoque_id3.php?id='+$('#idmat').val() );
    		});
		});
		
	</script>


	</head>
		
	<body class="bodyMaterial">
		
	<?php echo nav2() ?>
	
    <div class="container">
    
    <div class="form-group">
      </br></br></br></br>
      <label for="text" class="btn btn-danger container">Saída de Material</label>
  	</div>
    </br>
  <form class="form" role="form" method="post">
  	
    <div class="form-group">
      <label for="text">Material:</label></br>
      <?php if(isset($_GET['id'])) { ?>
      		<span><?php echo $mat_cod." - ".$mat_desc; ?></span>
      		<input class='form-control' type='hidden' id="idmat" name='idmat' value=<?php echo $mat_id ?> min='2016' max='2016'></input>
      <?php } else { ?>
      <select type="text" class="form-control" id="idmat" name="idmat" autofocus required>

						<option><?php echo "Selecione"?></option>
						<?php 
						foreach($mat as $res) { ?>
								<option value=<?php echo $res['id'] ?>><?php echo strtoupper($res['descricao'])." - ".$res['codigo']." - ".$res['unidade'];?></option>
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
      <input type="text" class="form-control" id="validade" name="validade" placeholder="" size="5" maxlength="5">
    </div>
    <div class="form-inline">
    	<?php if(isset($_GET['id'])) {?>
    	<span type="text" class="btn btn-default" id="" maxlength="4"><?php echo $mat_est ?></span>Estoque
    	<?php }else{?>
        <span type="text" class="btn btn-default" id="estoque" maxlength="4"></span>Estoque
        <?php } ?>
    </div>
    </br>  
    <div class="form-group">
      <label for="text">Observação:</label></br>
      <textarea type="text" class="form-control" id="obs" name="obs" placeholder="observação" row="3" cols="120" maxlength="200"></textarea>
      </br>
      <input type='checkbox' class='' name='listar' value='1' checked=""> Listar Estoque</input><br>
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
    </div>
      </br>       
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
	$id_mat = $_POST['idmat'];
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

	
	
	$movimento = new Movimento();

	$movimento->setAtributos($id, $id_mat, $quant_ent, $quant_sai, $valid, $data_mov, $data_real, $obs);
	
	$movimento->salvar($movimento);

	if(isset($_POST['listar'])){
		$encript = base64_encode($id_mat);
		$pag = "estoque_id.php?id=$encript";	
	}else{
		$pag = "saida.php";	
	}

        //$pag = "estoque_id.php?id=$id_mat";

	//MensagemAlert("Observação ->".$obs);
	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	}
	
?>

</body>
</html>		