<?php //armazena o html como uma variável e envia ao navegador

require_once 'funcoes.php';


janela();
$cab = cabecalho();

$usuario = sessao();

$title = "<title>Medicamento</title>";

if(!empty($usuario)){

$nav = nav($usuario);

$rel = relogio();
			
$pagina = <<< PAGINA
<!doctype>
<html>
	<head>

	{$title}	
        {$cab}

    <style>
	#lenda{ border-left:3px solid #87CEEB;
			border-right:3px solid #87CEEB;
			border-radius: 20px; } 
	</style>
        
		
	</head>
		
	<body onload="startTime()">
		
	{$nav}

	</br></br></br>

    <div class="container" id="lenda">
    
    <img src="../img/relogio.png" class="right"></img>
    <div class="text-info text-right" id="txt"></div>

    <div class="form-group">
    
      <label for="text" class="btn btn-info">Cadastro de Medicamento</label>
    </div>
    
  <form class="form-inline" role="form" method="post">
  	
    <div class="form-group">
      <label for="text">Código:</label></br>
      <input type="text" class="form-control" id="cod" name="cod" placeholder="9999" size="4" maxlength="4" required>
    </div>  	
    <div class="form-group">
      <label for="text">Descricao:</label></br>
      <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Nome do Material" size="70" maxlength="120" required>
    </div>
    <div class="form-group">
      <label for="text">Unidade:</label></br>
      <input type="text" class="form-control" id="unidade" name="unidade" placeholder="PC" size="4" maxlength="4" required>
      <button type="submit" class="btn btn-primary" name="cadastrar" value="Cadastrar">Salvar</button>
    </div>

  </form>


</div>

</body>
</html>

PAGINA;

echo $pagina;

		
	echo "<div class='container'>";
		estoque_hoje();
		tempo_execucao();
		echo "</br>";
		contador_acessos();

	echo "</div>";

}else{
	echo "Acesso Restrito";
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$_SESSION['login'] = $actual_link;
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}

			
	if(isset($_POST['cadastrar'])){

	$id = intval($_POST['cod']);
	$codnovo = 0;
	if(!is_int($id)){
		MensagemAlert("Código ".$id." Inválido");
		exit;
		}
	$descricao = strtoupper($_POST['descricao']);

	//testa se o texto para descrição tem mais de 6 caracteres
	if(!isset($descricao[6])){
		MensagemAlert("A descrição deve ter mais de 6 caracteres");
		exit;
	}	
	
	$uni = array("PC", "FR", "CPR", "CX", "CPS", "AMP");
	
	$unidade = strtoupper($_POST['unidade']);

	$val1 = $val2 = $val3 = "";

	$status = 'A';

	//verifica se $unidade esta presente no array $uni	
	if(!in_array($unidade, $uni)){
		MensagemAlert("Unidade Inválida");
		exit;
	}
		
	$med = new Medicamento();
	
	$med->setAtributos($id, $codnovo, $descricao, $unidade, $val1, $val2, $val3, $status);

	$novo = $med->existe($id);

	if($novo > 0){
		MensagemAlert("Código ".$id." Cadastrado");
		exit;
	}else{
		$med->salvar($med);
	}
	
	echo "<meta http-equiv='refresh' content='0; url=../Medicamento'>";
	
	}

?>
