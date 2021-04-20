<?php
require_once 'funcoes.php';

$cab = cabecalho();
$nav = nav2();
$usuario = sessao();

if(isset($_SESSION['usuario'])){
			
$pagina = <<< PAGINA
<!doctype>
<html>
	<head>
		<title>Saidas</title>
		
		{$cab}

	    <style style="text/css">
		  	#zebra{
				width:100%; 
				border-collapse:collapse;
			}
			#zebra th, td{ 
				padding:7px; border:#ccc 2px solid;
			}
			/* Define the default color for all the table rows */
			#zebra tr{
				background: #b8d1f3;
			}
			/* Define the hover highlight color for the table row */
		    #zebra tr:hover {
		          background-color: #ffff99;
		    }
		</style>

	</head>
		
	<body class="bodyMaterial">
		
		{$nav}

    </body>
</html>

PAGINA;

echo $pagina;

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}

	echo divOpen("container");
					
					if(isset($_POST['saidasperiodo'] )){
						echo "</br></br></br>";
						//echo $_POST['dtini']." a ".$_POST['dtfim'];
						$ini = $_POST['dtini'];
						$fim = $_POST['dtfim'];
                                                $_SESSION['sai_ini'] = $ini;
						$_SESSION['sai_fim'] = $fim;
						movsaidasPeriodo($ini,$fim);
						tempo_execucao();
						echo "</br>";
						contador_acessos();
					}elseif(isset($_SESSION['sai_ini'])){
						movsaidasPeriodo($_SESSION['sai_ini'],$_SESSION['sai_fim']);
						tempo_execucao();
						echo "</br>";
						contador_acessos();
					}
	echo divClose();
					
?>