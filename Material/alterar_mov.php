<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

	//MensagemAlert($_SESSION['pg']);

	$pag = isset($_SESSION['pg'])?$_SESSION['pg']:"movimento.php";
	
	$id_mov = isset($_GET['id'])?base64_decode($_GET['id']):""; //atribui o código do movimento

	if(isset($_SESSION['edit'])){
		foreach ($_SESSION['edit'] as $id) {
			$id_mov = base64_decode($id);
			//MensagemAlert($id_mov);
		}
	}
		
	$movimento = new Movimento();
	$mov = $movimento->buscarId($id_mov);

	//Caso a busca retorne valor estes serão atribuidos a variável $consul
	foreach($mov as $consul) {
		$id_mov= $consul['id_mov']; //atribui o valor 
		$id_mat=$consul['id_mat'];
		$quant_ent= $consul['quant_ent'];
		$quant_sai= $consul['quant_sai'];
		$validade = $consul['validade'];
		$data_mov = $consul['data_mov'];
		$data_real = $consul['data_real'];
		$obs = $consul['obs'];
	}

	$data_real = datatoview($data_real);

	$dia = datadia($data_real);
	$mes = datames($data_real);
	$ano = dataano($data_real);

	//MensagemAlert($dia);

	$material = new Material();
	$mat = $material->buscarId($id_mat);

	//Caso a busca retorne valor estes serão atribuidos a variável $consul
	foreach($mat as $cons) {
		$desc=$cons['descricao'];
	}

$cab = cabecalho();
$nav = nav2();
			
$pagina = <<< PAGINA

<!doctype>
<html>
	<head>
		<title>Material Alterar Movimento</title>
		
		{$cab}


	</head>
		
	<body class="bodyMaterial">
		
	{$nav}

    <div class="container">

    </br></br></br>
    
  <form class="form" role="form" method="post">
  	<div class="form-group">
      <label for="text">Cod Movimento:</label></br>
      <input type="text" class="form-control" id="id_mov" name="id_mov" value="{$id_mov}" placeholder="Enter Nome" size="4" maxlength="4" disabled>
    </div>
    <div class="form-group">
      <label for="text">Cod Material:</label></br>
      <input type="text" class="form-control" id="id_mat" name="id_mat" value="{$id_mat}" placeholder="9999" size="4" maxlength="4">
    </div>
    <div class="form-group">
      <label for="text">Descrição:</label></br>
      <input type="text" class="form-control" id="desc" name="desc" value="{$desc}" placeholder="Enter Nome" size="80" maxlength="80" disabled>
    </div>
    <div class="form-group">
      <label for="text">Quantidade Entrada:</label></br>
      <input type="number" class="form-control" id="quant_ent" name="quant_ent" value="{$quant_ent}" placeholder="Enter Nome" size="4" maxlength="4" required>
    </div>
    <div class="form-group">
      <label for="text">Quantidade Saída:</label></br>
      <input type="number" class="form-control" id="quant_sai" name="quant_sai" value="{$quant_sai}" placeholder="Enter Nome" size="4" maxlength="4" required>
    </div>
    <div class="form-inline">
      <label for="text">Data:</label></br>
      <input type="number" class="form-control" id="dia" name="dia" value="{$dia}" maxlength="2" max="31" min="1">/
      <input type="number" class="form-control" id="mes" name="mes" value="{$mes}" maxlength="2" max="12" min="1">/
      <input type="number" class="form-control" id="ano" name="ano" value="{$ano}" size="4" maxlength="4" max="2025" min="2015">
    </div>
    <div class="form-group">
      <label for="text">Validade:</label></br>
      <input type="text" class="form-control" id="validade" name="validade" value="{$validade}" placeholder="" size="5" maxlength="5">
    </div>
    <div class="form-group">
      <label for="text">Obs:</label></br>
      <textarea type="text" class="form-control" id="obs" name="obs" value="" placeholder="" cols="80" rows="3" size="120" maxlength="120">{$obs}</textarea>
    </div>
    
    </br>        
    <button type="submit" class="btn btn-primary btn-block" name="alterar" value="Cadastrar">Salvar</button>

  </form>
</div>

</body>
</html>

PAGINA;

echo $pagina;

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}

	
	//Teste se o botão salvar "alterar"	foi clicado
	if(isset($_POST['alterar'])){

	$dt_real = $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];

	$id_mat=$_POST['id_mat'];
	$quant_ent=$_POST['quant_ent'];
	$quant_sai=$_POST['quant_sai'];
	$validade = $_POST['validade'];
	$obs = $_POST['obs'];
	//MensagemAlert("Alter.php Codigo->".$cod);
	
	$movimento->setAtributos($id_mov, $id_mat,$quant_ent, $quant_sai, $validade, $data_mov, $dt_real, $obs);
	
	$movimento->atualizar($movimento);

	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	}
?>
