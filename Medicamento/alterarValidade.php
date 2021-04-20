<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){


	$id = base64_decode($_GET['id']); //atribui o código_cod de registro do cheque
	$codmed = base64_decode($_GET['codmed']); //atribui o código_cod de registro do cheque
	
	//MensagemAlert ("id=$id"."codmed=$codmed");

	$encript_codmed = base64_encode($codmed);

	$pag = "validade.php?id=$encript_codmed";
	
	$med = new Medicamento();
	$lis_med = $med->buscarId($codmed);

	//Caso a busca retorne valor estes serão atribuidos a variável $consul
	foreach($lis_med as $consul) {
		$idmed= $consul['id']; //atribui o valor credor a vaviável $cre
		$desc= utf8_encode($consul['descricao']);
		$unid= $consul['unidade'];
	}

	$mov_med = new Mov_Medicamento();
	$lis_mov = $mov_med->buscarId($id);

	//Caso a busca retorne valor estes serão atribuidos a variável $consul
	foreach($lis_mov as $consulmov) {
		$idmov= $consulmov['id_mov']; //atribui o valor credor a vaviável $cre
		$qtd= $consulmov['quantidade'];
		$val= $consulmov['validade'];
		$dtmov= $consulmov['data_mov'];
                $obs= $consulmov['obs'];
	
	}
			
	?>
<!doctype>
<html>
	<head>
		<title>Controle Cheques</title>
		
		<?php echo cabecalho() ?>

	</head>
		
	<body>
		
	<?php echo nav2() ?>

    <div class="contain">
    
  <form class="form" role="form" method="post">
  	<div class="form-group">
      <label for="text">Código:</label></br>
      <input type="text" class="form-control" id="id" name="id" value="<?php echo $id?>" placeholder="" size="4" maxlength="4" disabled>
    </div>
    <div class="form-group">
      <label for="text">Descricao:</label></br>
      <input type="text" class="form-control" id="descricao" name="descricao" value="<?php echo $desc?>" placeholder="Enter Nome" size="120" maxlength="120" disabled>
    </div>
    <div class="form-group">
      <label for="text">Unidade:</label></br>
      <input type="text" class="form-control" id="unidade" name="unidade" value="<?php echo $unid?>" placeholder="" size="4" maxlength="4" disabled>
    </div>
    <div class="form-group">
      <label for="text">Validade:</label></br>
      <input type="text" class="form-control" id="validade" name="validade" value="<?php echo $val?>" placeholder="" size="5" maxlength="5" required>
    </div>
    <div class="form-group">
      <label for="text">Data Movimento:</label></br>
      <input type="text" class="form-control" id="datamov" name="datamov" value="<?php echo datatoview($dtmov)?>" placeholder="" size="10" maxlength="10" disabled>
    </div>
    <div class="form-group">
      <label for="text">Obs:</label></br>
      <textarea type="text" class="form-control" id="obs" name="obs" value="" rows="3" cols="120"><?php echo $obs?></textarea>
    </div>
            
    <button type="submit" class="btn btn-primary" name="alterar" value="Cadastrar">Salvar</button></br>
    <button type="submit" class="btn btn-info" onClick="history.go(-1)">Voltar</button>
  </form>
</div>


		</form>

		
	<?php

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}
	
	//Teste se o botão salvar "alterar"	foi clicado
	if(isset($_POST['alterar'])){

	$id_mov = $id;
	$val= $_POST['validade']; //Pega o valor do POST credor, passa para maiuscula, atribui a variável $credor
	$qtd2 = 0;
        $obs = isset($_POST['obs'])?$_POST['obs']:"";
		
	//MensagemAlert("ID Alterar->".$id);
	
	$mov_med->setAtributos($id_mov, $codmed, $qtd, $qtd2, $val, $dtmov, $obs);
	
	$mov_med->atualizar($mov_med);

	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	}
?>
</body>
</html>