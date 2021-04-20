<?php 
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

?>
<!doctype>
<html>
<head>
	<title>Estoque</title>

	<?php echo cabecalho()?>


</head>

<body class="bodyMaterial">

	<?php echo nav2()?>

	<div class="container">
		<?php 
		
		if(empty($_GET['lista'])){
			estoqueId2($_POST['lista']);	
		}else{
			//estoqueId2($_GET['lista']);
			//$lista = unserialize($_GET['lista']);
			//print_r($lista);
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
	echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}
?>