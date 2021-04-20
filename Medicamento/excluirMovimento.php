<?php

include_once "funcoes.php";

$usuario = sessao();

if(isset($_SESSION['usuario'])){

$pagina = isset($_SESSION['pg'])?$_SESSION['pg']:"movimento.php";

$pag = <<< PAG

<!doctype>
<html>
	<head>
		<title> Cadastro-Cliente</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css">
		<link rel="stylesheet" href="css/estilo2.css" type="text/css">
		<script type="text/javascript" src="js/Confirmar.js"> </script>

<script type="text/javascript">
			function voltar(){
				setTimeout("window.location='$pagina'",0);
			}
			
			function ver(id){
			var res='0';
			if(confirm('Excluir?')){
				res = '1';
			}
			window.location.href = "excluirMovimento.php?name=" + res + "&id="+id; 
			}
			
		    
</script>

	</head>
		
	<body>

	</body>

</html>

PAG;
echo $pag;

	if(!isset($_GET['name'])){
		$id=base64_decode($_GET['id']);
		echo "<script>ver($id)</script>";
	}else{
		$id=$_GET['id'];
		$conf = $_GET['name'];
	}

	
	$valor = '1';
	$igual=strcmp($valor,$conf);
	//MensagemAlert("excluirMovimento = ".$igual);
	
	//MensagemAlert($id);
	
	if(isset($id)){

		if($igual == 0){

		$id_med = $quant_ent = $quant_sai = $quant_sai = $validade = $data_mov = $data_real = $obs = "";

		$mov = new Mov_Medicamento();

		$mov->setAtributos($id, $id_med, $quant_ent, $quant_sai, $validade, $data_mov, $data_real, $obs);
		
		$mov->excluirMov($mov);

	}
	    
}
	echo "<script>voltar()</script>";

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}

?>