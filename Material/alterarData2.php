<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

	//MensagemAlert($_SESSION['datareal']);

	$pag = "alterarData.php";

	$datahj = $_SESSION['datareal'];
    $dia=$datahj->format('d'); $mes=$datahj->format('m'); $ano=$datahj->format('Y');

	//$data_real = datatoview($data_real);

	//$dia = datadia($data_real);
	//$mes = datames($data_real);
	//$ano = dataano($data_real);

	//MensagemAlert($datahj);

	
$cab = cabecalho();
$nav = nav2();
			
$pagina = <<< PAGINA

<!doctype>
<html>
	<head>
		<title>Alterar Data Sistema</title>
		
		{$cab}


	</head>
		
	<body class="bodyMaterial">
		
	{$nav}

    <div class="container">

    </br></br></br>

    <label for="text" class="btn btn-success container">Alterar Data do Sistema</label>

    </br></br>
    
  <form class="form" role="form" method="post">
  	
    <div class="form-inline">
      <label for="text">Data Atual:</label></br>
      <input type="number" class="form-control" id="dia" name="dia" value="{$dia}" maxlength="2" max="31" min="1">/
      <input type="number" class="form-control" id="mes" name="mes" value="{$mes}" maxlength="2" max="12" min="1">/
      <input type="number" class="form-control" id="ano" name="ano" value="{$ano}" size="4" maxlength="4" max="2025" min="2015">
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

	$datahj = new datetime($dt_real);
  	$_SESSION['datareal'] = $datahj;

	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";

	
	}
?>
