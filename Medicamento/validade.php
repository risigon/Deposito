<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){
		
	?>
<!doctype>
<html>
	<head>
		<title>Buscar Validades</title>
		
		<?php echo cabecalho() ?>

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
		
		<?php echo nav2() ?>

		<div class="container">
			<?php 
					if(isset($_GET['id'])){
						buscarValidades(base64_decode($_GET['id']));
						
					}
					

			?>
			
		
		</div>
	
	</body>
</html>

<?php
}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}
?>		

