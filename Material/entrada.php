<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){
	
	$title = "Entrada Mat";
	
	$material = new Material();
	$mat = $material->buscar();
			
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

  <?php echo divOpen("container")?>
  	
	<div class="form-group">
	  </br></br></br>
      <label for="text" class="btn btn-success container">Entrada de Material</label>
  	</div>
    
  <!--form class="form" role="form" method="post"-->
  <?php echo formOpen("form", "form", "post")?>

    <?php echo divOpen("form-group")?>
    <?php echo label("text", "Material:")?></br>
      <select type="text" class="form-control" id="idmat" name="idmat" autofocus required>

			<?php echo option("","SELECIONE...")?>
						<?php
						foreach($mat as $res) {
							echo option($res['id'], strtoupper($res['descricao'])." - ".$res['codigo']." - ".$res['unidade']);
													
								}
							?>
      	

      </select>
      
    <?php echo divClose()?>
    
    <?php echo divOpen("form-group")?>
    <?php echo label("text", "Quantidade")?></br>
    <?php echo input("number", "quantidade", "quantidade", "form-control","99" ,"12", "12", "required")?>
    <?php echo divClose()?>

    <?php echo divOpen("form-group")?>	
    <?php echo label("text", "Validade")?></br>
    <?php echo input("text", "validade", "validade", "form-control","99/99" ,"5", "5", "")?>
    <?php echo divClose()?>

    <?php echo divOpen("form-inline")?>
    <?php echo "Estoque <span type='text' class='btn btn-success' id='estoque' maxlength='4'></span>"?>
    <?php echo divClose()?>
    <?php echo "<br>" ?>

    <?php echo divOpen("form-group")?>
    <?php echo label("text", "Observação")?></br>
    <?php echo textarea("text", "obs", "obs", "form-control","100" ,"3", "")?>
    <?php echo divClose()?>

    <?php echo divOpen("form-inline")?>
    <?php echo "Data" ?>
    <?php 
    	$datahj = $_SESSION['datareal'];
    	$dia=$datahj->format('d'); $mes=$datahj->format('m'); $ano=$datahj->format('Y');
    ?>

    <?php echo 	"<input class='form-control' type='number' name='dia' value=$dia min='1' max='31'>/</input>" ?>
    <?php echo 	"<input class='form-control' type='number' name='mes' value=$mes min='1' max='12'>/</input>" ?>
    <?php echo 	"<input class='form-control' type='number' name='ano' value=$ano min='2016' max='2025'></input>" ?>
    <?php echo divClose()?>

    <?php echo divOpen("form-group")?>
    <?php echo "<input type='checkbox' class='' name='listar' value='1'> Listar Estoque</input>";?>
    <?php echo divClose()?>
    <br>        
    <button type="submit" class="btn btn-primary btn-block" name="cadastrar" value="Cadastrar">Salvar</button><br>
    
  	<?php echo formClose()?>
	<?php echo divClose()?>

		
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
	$quant_ent=$_POST['quantidade'];
	$quant_sai=0;
	$valid=$_POST['validade'];
	$data_mov = date("Y-m-d");
	$data_real = $data;
	$obs = isset($_POST['obs'])?$_POST['obs']:"";        

	//MensagemAlert("Alterar Desc->".$desc);
	
	$movimento = new Movimento();

	$movimento->setAtributos($id, $id_mat, $quant_ent, $quant_sai, $valid, $data_mov, $data_real, $obs);
	
	$movimento->salvar($movimento);

	if(isset($_POST['listar'])){
                $encript = base64_encode($id_mat);
		$pag = "estoque_id.php?id=$encript";
	}else{
		$pag = "entrada.php";
	}

	//$pag = "estoque_id.php?id=$id_mat";
	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	}
?>

</body>
</html>