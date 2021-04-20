<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){


$cab = cabecalho();
$nav = nav2();
			
$pagina = <<< PAGINA
<!doctype>
<html>
	<head>
		<title>Validades</title>
		
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


	echo "<div class='container'>";
										
					if(isset($_POST['periodo'])){
						$ini = $_POST['dtini'];
						$fim = $_POST['dtfim'];
						validadesPeriodo($ini,$fim);
					}
					
	echo "</div>";
?>