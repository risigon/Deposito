<?php 
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){



		if(isset($_GET['id'])){
			echo estoqueIdValor($_GET['id']);	
		}
		
}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}
?>