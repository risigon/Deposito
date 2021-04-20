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
		<title>Consumo</title>
		
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
		
	<body>
		
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
					
					if(isset($_POST['periodo'] )){
						//echo $_POST['dtini']." a ".$_POST['dtfim'];
						$ini = $_POST['dtini'];
						$fim = $_POST['dtfim'];
						$_SESSION['ent_ini'] = $ini;
						$_SESSION['ent_fim'] = $fim;
						entradasPeriodo($ini,$fim);
						tempo_execucao();
						echo "</br>";
						contador_acessos();
					}elseif(isset($_SESSION['ent_ini'])){
						entradasPeriodo($_SESSION['ent_ini'],$_SESSION['ent_fim']);
						tempo_execucao();
						echo "</br>";
						contador_acessos();
					}
	echo divClose();
					
?>