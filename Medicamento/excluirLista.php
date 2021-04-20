<?php

include_once "funcoes.php";

$usuario = sessao();

if(isset($_SESSION['usuario'])){

//echo $_SESSION['pg'];

$pagina = isset($_SESSION['pg'])?$_SESSION['pg']:"movimento.php";
//MensagemAlert('Pagina = '.$pagina);

if(isset($_POST['edit'])){
	
    $cont = 0;
    $cont = count($_POST['listaexcluir']);
    //MensagemAlert('Contador = '.$cont);

    if($cont>0){
    	$_SESSION['edit'] = $_POST['listaexcluir'];        
	    echo "<meta http-equiv='refresh' content='0; url=alterar_mov.php'>";
	exit;	
    }else{
    	echo "<meta http-equiv='refresh' content='0; url=$pagina'>";
    }
	
}

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
			
			function ver(){
			var res='0';
			if(confirm('Excluir?')){
				res = '1';
			}
			window.location.href = "excluirLista.php?name=" + res; 
			}
			
		    
</script>

	</head>
		
	<body>

	</body>

</html>

PAG;
echo $pag;

$conf = '0';

if(!isset($_GET['name'])){
		
		$itens = empty($_POST['listaexcluir'])?0:count($_POST['listaexcluir']);

		if($itens>0){
			$_SESSION['listaexcluir'] = $_POST['listaexcluir'];
			echo "<script>ver()</script>";	
		}else{
			echo "<script>voltar()</script>";
			exit;
		}
		
	}else{
		$conf = $_GET['name'];
	}



$valor = '1';

$igual=strcmp($valor,$conf);//Verifica se $valor é igual $conf ($conf é gerado pelo script ver() - 1 excluir / 0 cancelar)


    if($igual==0){		

		foreach ($_SESSION['listaexcluir'] as $id) {
		
		$idmov = base64_decode($id);	

		//MensagemAlert($idmov);

		$id_med = $codnovo = $quant_ent = $quant_sai = $quant_sai = $validade = $data_mov = $data_real = $obs = "";

		$mov = new Mov_Medicamento();

		$mov->setAtributos($idmov, $id_med, $codnovo, $quant_ent, $quant_sai, $validade, $data_mov, $data_real, $obs);
		
		$mov->excluirMov($mov);

		}
	}
	   
	
	echo "<script>voltar()</script>";

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}

?>

	
