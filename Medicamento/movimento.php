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
		<title>Movimento</title>
		
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
						$ini = $_POST['dtini'];
						$fim = $_POST['dtfim'];
						$_SESSION['mov_ini'] = $ini;
						$_SESSION['mov_fim'] = $fim;
						movPeriodo($ini,$fim);
						tempo_execucao();
						echo "</br>";
						contador_acessos();
					}elseif(isset($_SESSION['mov_ini'])){
						movPeriodo($_SESSION['mov_ini'],$_SESSION['mov_fim']);
						tempo_execucao();
						echo "</br>";
						contador_acessos();
					}
	echo divClose();
					
?>