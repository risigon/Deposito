<?php 
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){
			
	?>
<!doctype>
<html>
	<head>
		<title>Depósito</title>
		
		<?php echo cabecalho() ?>

	</head>
		
	<body>
		
	<?php echo nav2() ?>
    		
		<div class="container">
		<br><br><br>
		<?php 

		$id = isset($_GET['id'])?$_GET['id']:'';

		$_SESSION['pg'] = 'estoque_id.php?id='.$id.'&mov='.$id;

		if(isset($_POST['id'])){

			$_SESSION['pg'] = 'estoque_id.php?id='.base64_encode($_POST['id']).'&mov='.base64_encode($_POST['id']);
			
			estoqueId($_POST['id']);	
            echo "<br>";
			entradasId($_POST['id']);
			echo "<br>";
			saidasId($_POST['id']);
		}
		
		if(isset($_GET['id'])){
			estoqueId(base64_decode($_GET['id']));	
            echo "<br>";
				if(isset($_GET['mov'])){
				entradasId(base64_decode($_GET['id']));
				echo "<br>";
				saidasId(base64_decode($_GET['id']));
				}
		    }

		if(isset($_GET['nome'])){
			estoqueNome($_GET['nome']);
		}

		if(isset($_POST['nome'])){
			if(empty($_POST['nome'])){
				MensagemAlert("Favor preencher o campo de Busca");
				echo "<meta http-equiv='refresh' content='0; url=index.php'>";
				exit;
			}else{
				estoqueNome($_POST['nome']);
			}
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