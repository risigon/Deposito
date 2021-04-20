<?php

	$usuario = "root";
	$senha = "";
	$host = "localhost";
	$nomeBanco = "cheque";

	$conecta = mysql_connect($host,$usuario,$senha) or die('Erro ao conectar com o MySql '.mysql_error());

	mysql_set_charset('utf8',$conecta);
	mysql_select_db("$nomeBanco", $conecta);
		 
	
?>


</body>
</html>