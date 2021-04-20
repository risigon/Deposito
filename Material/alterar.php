<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

	$pg = isset($_GET['pagina'])?$_GET['pagina']:"";

	$pag = (isset($_GET['pagina'])?"index.php?pagina=$pg":"index.php");

	$id = base64_decode($_GET['id']); //atribui o código_cod de registro do cheque
	
	
	$material = new Material();
	$mat = $material->buscarId($id);

	//Caso a busca retorne valor estes serão atribuidos a variável $consul
	foreach($mat as $consul) {
		$id= $consul['id']; //atribui o valor credor a vaviável $cre
		$desc= $consul['descricao'];
		$unid= $consul['unidade'];
		$cod= $consul['codigo'];
		$val1 = $consul['val1']<'2010-01-01'?'':datatoview($consul['val1']);
        $val2 = $consul['val2']<'2010-01-01'?'':datatoview($consul['val2']);
        $val3 = $consul['val3']<'2010-01-01'?'':datatoview($consul['val3']);
        $status = empty($consul['status'])?'':$consul['status'];
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
		<title>Material Alterar</title>
		
		{$cab}

		<script>
			function JumpField(fields) {
			 if (fields.value.length == fields.maxLength) {
			  for (var i = 0; i < fields.form.length; i++) {
			   if (fields.form[i] == fields && fields.form[(i + 1)] && fields.form[(i + 1)].type != "hidden") {
				fields.form[(i + 1)].focus();
				break;
			   }
			  }
			 }
			}
		</script>


	</head>
		
	<body class="bodyMaterial">
		
	{$nav}

    <div class="container">
    
  <form class="form" role="form" method="post">
  	<div class="form-group">
      <label for="text">ID:</label></br>
      <input type="text" class="form-control" id="id" name="id" value="{$id}" placeholder="Enter Nome" size="4" maxlength="4" disabled>
    </div>
    <div class="form-group">
      <label for="text">Código:</label></br>
      <input type="text" class="form-control" id="codigo" name="codigo" value="{$cod}" placeholder="9999" size="4" maxlength="4">
    </div>
    <div class="form-group">
      <label for="text">Descricao:</label></br>
      <input type="text" class="form-control" id="descricao" name="descricao" value="{$desc}" placeholder="Enter Nome" size="120" maxlength="120" required>
    </div>
    <div class="form-group">
      <label for="text">Unidade:</label></br>
      <input type="text" class="form-control" id="unidade" name="unidade" value="{$unid}" placeholder="" size="4" maxlength="4" required>
    </div>
    <div class="form-inline">
      <label for="text">Validade 1</label>
      <input type="number" class="form-control" id="unidade" name="val1_dia" value="{$val1_dia}" placeholder="" min="1" max="31" onkeyup="if(this.value.length >= 2) { val1_mes.focus(); }" maxlength="2" size="2">/
      <input type="number" class="form-control" id="unidade" name="val1_mes" value="{$val1_mes}" placeholder="" min="1" max="12" onkeyup="if(this.value.length >= 2) { val1_ano.focus(); }" maxlength="2" size="2">/
      <input type="number" class="form-control" id="unidade" name="val1_ano" value="{$val1_ano}" placeholder="" min="2016" max="2025" onkeyup="if(this.value.length >= 4) { val2_dia.focus(); }" maxlength="4" size="4">
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

    <br>
            
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

	
	//Teste se o botão salvar "alterar"	foi clicado
	if(isset($_POST['alterar'])){

	$desc=strtoupper($_POST['descricao']); //Pega o valor do POST credor, passa para maiuscula, atribui a variável $credor
	$unid=strtoupper($_POST['unidade']); //Pega o valor do POST credor, passa para maiuscula, atribui a variável $credor
	$cod=$_POST['codigo']; //Pega o valor do POST credor, passa para maiuscula, atribui a variável $credor

	if(isset($_POST['val1_dia'])&&isset($_POST['val1_mes'])&&isset($_POST['val1_ano'])){
        $val1 = $_POST['val1_ano']."-".$_POST['val1_mes']."-".$_POST['val1_dia'];
        }
        if(isset($_POST['val2_dia'])&&isset($_POST['val2_mes'])&&isset($_POST['val2_ano'])){
        $val2 = $_POST['val2_ano']."-".$_POST['val2_mes']."-".$_POST['val2_dia'];
        }
        if(isset($_POST['val3_dia'])&&isset($_POST['val3_mes'])&&isset($_POST['val3_ano'])){
        $val3 = $_POST['val3_ano']."-".$_POST['val3_mes']."-".$_POST['val3_dia'];
        }

    $sta = empty($_POST['status'])?'':strtoupper($_POST['status']);
		
	//MensagemAlert("Alter.php Codigo->".$cod);
	
	$material->setAtributos($id, $desc, $unid, $cod, $val1, $val2, $val3, $sta);
	
	$material->atualizar($material);

	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	}

?>
