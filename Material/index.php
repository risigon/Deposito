<?php
require_once 'funcoes.php';


$cab = cabecalho();

janela();

$rel = relogio();

$usuario = sessao();

$title = "<title>Material</title>";

if(isset($_SESSION['usuario'])){

$nav = nav($usuario);


$pagina = <<< PAGINA

<!doctype>
<html>
	<head>

		{$cab}
		{$title}

		<style>
		#lenda{ border-left:3px solid #66CDAA;
				border-right:3px solid #66CDAA;
				border-radius: 20px; } 
		</style>
        
		<link rel="icon" href="favicon.ico" type="image/ico" />
		<link rel="icon" type="image/gif" href="animated_favicon1.gif">

		{$rel}
		
	</head>
		
	<body class="bodyMaterial" onload="startTime()">
		
	{$nav}

	</br></br></br>

  <div class="container" id="lenda">

  <img src="../img/relogio.png" class="right"></img>

  <div class="text-success text-right" id="txt"></div>
  
  <div class="form-group">
  	  	
      <label for="text" class="btn btn-info">Cadastro de Material</label>
  </div>



  <form class="form-inline" role="form" method="post">

  	<div class="form-group">
      <label for="text">Código:</label></br>
      <input type="text" class="form-control" id="codigo" name="codigo" placeholder="9999" size="4" maxlength="4">
    </div>  	
    <div class="form-group">
      <label for="text">Descricao:</label></br>
      <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Nome do Material" size="70" maxlength="120">
    </div>
    <div class="form-group">
        <label for="text">Unidade:</label></br>
        <input type="text" class="form-control" id="unidade" name="unidade" placeholder="PC" size="4" maxlength="4">
    	<button type="submit" class="btn btn-primary" name="cadastrar" value="Cadastrar">Salvar</button>
    </div>
  </form>
</div>
	
			
	</body>
	</html>
		
			
PAGINA;

echo $pagina;

echo divOpen("container");
		if(isset($_POST['nome'])){
		estoque_hoje($_POST['nome']);	
		}else{
		estoque_hoje();
		}
		tempo_execucao();
		echo "</br>";
		contador_acessos();
echo divClose();

}else{
	echo "Acesso Restrito";
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$_SESSION['login'] = $actual_link;
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}

if(isset($_POST['cadastrar'])){

	$id = "000000";
	$cod = intval($_POST['codigo']);
	if(!is_int($cod)){
		MensagemAlert("Código ".$cod." Inválido");
		exit;
		}
	$desc = strtoupper(utf8_decode($_POST['descricao']));

	//testa se o texto para descrição tem mais de 6 caracteres
	if(!isset($desc[6])){
		MensagemAlert("A descrição deve ter mais de 6 caracteres");
		exit;
	}

	$unid = strtoupper($_POST['unidade']);

	$uni = array("PC", "PCT", "PAA", "CX", "KG", "M");
	
	if(!in_array($unid, $uni)){
		MensagemAlert("Unidade Inválida");
		exit;
	}

        $val1 = $val2 = $val3 = "";

        $status = 'A';

		
	$material = new Material();
	
	$material->setAtributos($id, $desc, $unid, $cod, $val1, $val2, $val3, $status);

	$novo = $material->existe($cod);

	if($novo > 0){
		MensagemAlert("Código ".$cod." Cadastrado");
		exit;
	}else{
		$material->salvar($material);
	}
	
	echo "<meta http-equiv='refresh' content='0; url=../Material'>";
	
	}

?>		