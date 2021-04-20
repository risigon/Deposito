<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

	$pagina = (isset($_GET['pagina'])?$_GET['pagina']:"");

	$id = base64_decode($_GET['id']); //atribui o cÃ³digo_cod de registro do cheque
	
	$pag = (isset($_GET['pagina'])?"index.php?pagina=$pagina":"index.php");
	
	$med = new Medicamento();
	$lis_med = $med->buscarId($id);

	//Caso a busca retorne valor estes serÃ£o atribuidos a variÃ¡vel $consul
	foreach($lis_med as $consul) {
		$id= $consul['id']; //atribui o valor credor a vaviÃ¡vel $cre
		$codnovo= $consul['codnovo'];
    $desc= $consul['descricao'];
		$unid= $consul['unidade'];
                $val1 = $consul['val1']<'2010-01-01'?'':datatoview($consul['val1']);
                $val2 = $consul['val2']<'2010-01-01'?'':datatoview($consul['val2']);
                $val3 = $consul['val3']<'2010-01-01'?'':datatoview($consul['val3']);
                $status= $consul['status'];
	}

$cab = cabecalho();
$nav = nav2();

$val1_dia = datadia($val1); $val1_mes = datames($val1); $val1_ano = dataano($val1); 
$val2_dia = datadia($val2); $val2_mes = datames($val2); $val2_ano = dataano($val2); 
$val3_dia = datadia($val3); $val3_mes = datames($val3); $val3_ano = dataano($val3); 
			
$pagina = <<< PAGINA

<!doctype>
<html>
	<head>
		<title>Alteração</title>
		
		{$cab}

	</head>
		
	<body>
		
	{$nav}

    <div class="container">
    
  <form class="form" role="form" method="post">
  	<div class="form-group">
      <label for="text">Código:</label></br>
      <input type="text" class="form-control" id="codigo" name="codigo" value="{$id}" placeholder="Enter Nome" size="5" maxlength="5" required>
    </div>
    <div class="form-group">
      <label for="text">Descricão:</label></br>
      <input type="text" class="form-control" id="descricao" name="descricao" value="{$desc}" placeholder="Enter Nome" size="120" maxlength="120" required>
    </div>
    <div class="form-group">
      <label for="text">Unidade:</label></br>
      <input type="text" class="form-control" id="unidade" name="unidade" value="{$unid}" placeholder="" size="4" maxlength="4" required>
    </div>
    <div class="form-inline">
      <label for="text">Validade 1</label>
      <input type="number" class="form-control" id="unidade" name="val1_dia" value="{$val1_dia}" placeholder="" min="1" max="31" onkeyup="if(this.value.length >= 2) { val1_mes.focus(); }" maxlength="2">/
      <input type="number" class="form-control" id="unidade" name="val1_mes" value="{$val1_mes}" placeholder="" min="1" max="12" onkeyup="if(this.value.length >= 2) { val1_ano.focus(); }" maxlength="2">/
      <input type="number" class="form-control" id="unidade" name="val1_ano" value="{$val1_ano}" placeholder="" min="2016" max="2025" onkeyup="if(this.value.length >= 4) { val2_dia.focus(); }" maxlength="4">
    </div>
    <div class="form-inline">
      <label for="text">Validade 2</label>
      <input type="number" class="form-control" id="unidade" name="val2_dia" value="{$val2_dia}" placeholder="" min="1" max="31" onkeyup="if(this.value.length >= 2) { val2_mes.focus(); }" maxlength="2">/
      <input type="number" class="form-control" id="unidade" name="val2_mes" value="{$val2_mes}" placeholder="" min="1" max="12" onkeyup="if(this.value.length >= 2) { val2_ano.focus(); }" maxlength="2">/
      <input type="number" class="form-control" id="unidade" name="val2_ano" value="{$val2_ano}" placeholder="" min="2016" max="2025" onkeyup="if(this.value.length >= 4) { val3_dia.focus(); }" maxlength="4">
    </div>
    <div class="form-inline">
      <label for="text">Validade 3</label>
      <input type="number" class="form-control" id="unidade" name="val3_dia" value="{$val3_dia}" placeholder="" min="1" max="31" onkeyup="if(this.value.length >= 2) { val3_mes.focus(); }" maxlength="2">/
      <input type="number" class="form-control" id="unidade" name="val3_mes" value="{$val3_mes}" placeholder="" min="1" max="12" onkeyup="if(this.value.length >= 2) { val3_ano.focus(); }" maxlength="2">/
      <input type="number" class="form-control" id="unidade" name="val3_ano" value="{$val3_ano}" placeholder="" min="2016" max="2025" onkeyup="if(this.value.length >= 4) { alterar.focus(); }" maxlength="4">
    </div>
    <div class="form-group">
      <label for="text">Status</label>
      <select name="status" class="form-control">
      		<option checked>{$status}</option> 
      		<option class="form-control" disabled>----</option>     			
      		<option class="form-control">A</option>
      		<option class="form-control">B</option>      			
      		
      		
      </select>
      <!--input type="text" class="form-control" id="status" name="status" value="{$status}" placeholder="" size="10" maxlength="10"-->
    </div>

            
    <button type="submit" class="btn btn-primary btn-block" name="alterar" value="Cadastrar">Salvar</button></br>

  </form>
</div>

</body>
</html>

PAGINA;

echo $pagina;

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}
		
	
	//Teste se o botÃ£o salvar "alterar"	foi clicado
	if(isset($_POST['alterar'])){

	$id = ($_POST['codigo']);
    $desc = $_POST['descricao'];
	$desc = strtoupper($desc);
	$unid=strtoupper($_POST['unidade']); //Pega o valor do POST credor, passa para maiuscula, atribui a variÃ¡vel $credor

        if(isset($_POST['val1_dia'])&&isset($_POST['val1_mes'])&&isset($_POST['val1_ano'])){
        $val1 = $_POST['val1_ano']."-".$_POST['val1_mes']."-".$_POST['val1_dia'];
        }
        if(isset($_POST['val2_dia'])&&isset($_POST['val2_mes'])&&isset($_POST['val2_ano'])){
        $val2 = $_POST['val2_ano']."-".$_POST['val2_mes']."-".$_POST['val2_dia'];
        }
        if(isset($_POST['val3_dia'])&&isset($_POST['val3_mes'])&&isset($_POST['val3_ano'])){
        $val3 = $_POST['val3_ano']."-".$_POST['val3_mes']."-".$_POST['val3_dia'];
        }

    $sta = strtoupper($_POST['status']);

		
	//MensagemAlert("Alterar Desc->".$desc);
	
	$med->setAtributos($id, $codnovo, $desc, $unid, $val1, $val2, $val3, $sta);
	
	$med->atualizar($med);

	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	}
?>
			