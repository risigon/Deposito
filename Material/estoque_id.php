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
		
	<body class="bodyMaterial">
		
	<?php echo nav2() ?>

		   		
		<div class="container">
		</br></br></br>
		<?php 

                if(isset($_GET['nome'])){
                        unset($_SESSION['idmat']);
			estoqueNome($_GET['nome']);
		}

                if(isset($_POST['nome'])){
			if(empty($_POST['nome'])){
				MensagemAlert("Favor preencher o campo de Busca");
				echo "<meta http-equiv='refresh' content='0; url=index.php'>";
				exit;
			}else{
                                unset($_SESSION['idmat']);
				estoqueNome($_POST['nome']);
			}
		}
		
		if(isset($_GET['id'])){
			estoqueId(base64_decode($_GET['id']));	
            echo "<br>";
				if(isset($_GET['mov'])){
				entradasId(base64_decode($_GET['id']));
				echo "<br>";
				saidasId(base64_decode($_GET['id']));
				}
                        exit; 
		    }

		
                if(isset($_POST['id'])||isset($_SESSION['idmat'])){
			
			$idmat = isset($_POST['id'])?$_POST['id']:$_SESSION['idmat'];

			estoqueId($idmat);
                        echo "<br>";
			entradasId($idmat);
                        echo "<br>";
			saidasId($idmat);

			}

		
		
			
			//MensagemAlert($_POST['nome']);
			
		
		tempo_execucao();
		echo "</br>";
		contador_acessos();
		?>
		</div>	
		

		
</body>
</html>
<?php }else{
	echo "<meta http-equiv='refresh' content='0; url=login.php'>";
} ?>		