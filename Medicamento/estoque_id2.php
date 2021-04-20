<?php 
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

	?>
<!doctype>
<html>
	<head>
		<title>Estoque</title>
		
		<?php echo cabecalho() ?>

	</head>
		
	<body>
		
	<?php echo nav2() ?>

    		
		<div class="container">
		
		<?php 
		
		if(isset($_GET['lista'])){
			estoqueId_Lista($_GET['lista']);
			}
		tempo_execucao();
		echo "</br>";
		contador_acessos();
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