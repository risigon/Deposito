<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

	//MensagemAlert($_SESSION['datareal']);

	$pag = "alterarData.php";

	$dataSistema = $_SESSION['datareal'];

    $dia=$dataSistema->format('d'); 
    $mes=$dataSistema->format('m'); 
    $ano=$dataSistema->format('Y');

	

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
      <label for="text">Data Sistema:</label></br>
      <input type="number" class="form-control" id="dia" name="dia" value="{$dia}" maxlength="2" max="31" min="1">/
      <input type="number" class="form-control" id="mes" name="mes" value="{$mes}" maxlength="2" max="12" min="1">/
      <input type="number" class="form-control" id="ano" name="ano" value="{$ano}" size="4" maxlength="4" max="2025" min="2015">
    </div>

    </br></br>

    <button type="submit" class="btn btn-primary btn-block" name="alterar" value="Cadastrar">Salvar</button>
        	
    </br></br>
    
    <button type="submit" class="btn btn-success btn-block" name="hoje" value="CadastrarHoje">Hoje</button>

    </br></br>
    
    <button type="submit" class="btn btn-warning btn-block" name="ontem" value="CadastrarOntem">Ontem</button>

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

	$dt_sistema = $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];

	$datasistema = new datetime($dt_sistema);
  	$_SESSION['datareal'] = $datasistema;

	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	exit;
	}
	
	if(isset($_POST['hoje'])){

	$datahj = date("d/m/Y");

    $diahj=datadia($datahj); 
    $meshj=datames($datahj);
    $anohj=dataano($datahj);

	$dt_real = $anohj."-".$meshj."-".$diahj;

	$datahj = new datetime($dt_real);
  	$_SESSION['datareal'] = $datahj;

	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";

	exit;
	}

	if(isset($_POST['ontem'])){

	$datahj = date("d/m/Y",strtotime("-1 days"));

    $diahj=datadia($datahj); 
    $meshj=datames($datahj);
    $anohj=dataano($datahj);

	$dt_real = $anohj."-".$meshj."-".$diahj;

	$datahj = new datetime($dt_real);
  	$_SESSION['datareal'] = $datahj;

	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";

	exit;
	}
	
?>
