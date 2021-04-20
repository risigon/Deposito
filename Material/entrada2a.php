<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){
	
	$title = "Entrada Mat";
	
	$material = new Material();
	$mat = $material->buscar();

				
	?>
<!doctype>
<html>
	<head>
		<title><?php echo $title?></title>
		
		<?php echo cabecalho() ?>

	</head>
		
	<body class="bodyMaterial">
		
	<?php echo nav2() ?>

    
	<div class="container">  

	<div class="form-group">
	  </br></br></br>
      <label for="text" class="btn btn-success container">Entrada de Material</label>
  	</div>

    <?php

    echo "<form class='form-inline' role='form' method='post'>";

	echo "<table id='table-left' class='table table-bordered table-condensed table-striped'>";

    echo "<tr>";
    echo "<th>Descrição</th>";
    echo "<th>Quantidade</th>";
    echo "<th>Validade</th>";
    echo "</tr>";
    
    $i=0;  
    do{

    $material = new Material();
	$mat = $material->buscar();

	$i++;

	echo "<tbody>";
    echo "<tr>";
    echo "<col width='50%'>";
    echo "<col width='15%'>";
    echo "<col width='15%'>";

    echo "<td>";
    $idmat='idmat'.$i;
    //MensagemAlert($idmat);
    echo "<select type='text' class='form-control' id='idmat' name='$idmat' autofocus>";

						echo "<option>'SELECIONE...'</option>";
						foreach($mat as $res) { 
								
								echo "<option value='".$res['id']."'>" . strtoupper($res['descricao'])." - ".$res['codigo']." - ".$res['unidade']."</option>";

								
								}
							
      	

    echo "</select>";
  	echo "<td>";
  	$quantidade = 'quantidade'.$i;
    echo "<input type='number'  id='quantidade' class='form-control' style='text-align:center' name='$quantidade' placeholder='' size='12' maxlength='12'>";
    echo "</td>";

    echo "<td>";
  	$validade = 'validade'.$i;
    echo "<input type='text'  id='validade' class='form-control' style='text-align:center' name='$validade' placeholder='' size='5' maxlength='5'>";
    echo "</td>";
           
	echo "</tr>";
	
	}while($i<8);

	echo "</tbody>";
	echo "</table>";

        echo "<tr>";
		echo "<td align='left'>";
        echo "<textarea type='text' class='form-control' id='obs' name='obs' row='3' cols='117' placeholder='Observação'></textarea>";
        echo "</td>";
        echo "</tr>";
       
    echo "</br>";

    echo "<input type='checkbox' class='' name='listar' value='1'> Listar Estoque</input>";
    echo "</br>";

    //$datahj = date('d/m/Y');
    $datahj = $_SESSION['datareal'];
    //print_r($datahj);
    //$datahj = ('d/m/y');
    
    echo "<span>Data</span>";
    $dia=$datahj->format('d'); $mes=$datahj->format('m'); $ano=$datahj->format('Y');
    //$dia = date('d'); $mes = date('m'); $ano = date('Y');
    echo 	"<input class='form-control' type='number' name='dia' value=$dia min='1' max='31'>/</input>";
    echo    "<input class='form-control' type='number' name='mes' value=$mes min='1' max='12'>/</input>";
    echo    "<input class='form-control' type='number' name='ano' value=$ano min='2016' max='2025'></input>";


    echo "<button type='submit' class='btn btn-primary btn-block' name='cadastrar' value='Cadastrar'>Salvar</button>";

  echo "</form>";

	?>


</div>

		

<?php

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}
	
	//Teste se o botão salvar foi clicado
	if(isset($_POST['cadastrar'])){
	
	$a = 0;

        $data = $_POST['ano'].'-'.$_POST['mes'].'-'.$_POST['dia'];
        
	do{

		$a++;

		$id = "000000";
		$id_mat = $_POST['idmat'.$a];
		$quant_ent=$_POST['quantidade'.$a];
		$quant_sai=0;
		$valid=isset($_POST['validade'.$a])?$_POST['validade'.$a]:"";
		$data_mov = date("Y-m-d");
		$data_real = $data;
		$obs = isset($_POST['obs'])?$_POST['obs']:"";

	
	if($id_mat>0&&$quant_ent>0){

	//MensagemAlert($id_mat);

	$movimento = new Movimento();

	$movimento->setAtributos($id, $id_mat, $quant_ent, $quant_sai, $valid, $data_mov, $data_real, $obs);
	
	$movimento->salvar($movimento);

	$array_Lista[$a-1] = $id_mat;
	
	}

	}while($a<8||empty($id_mat));

	$tam = sizeof($array_Lista);

	$lista = base64_encode(serialize($array_Lista));

	//MensagemAlert("Tamanho array ->".$tam);

	if($tam>0&&isset($_POST['listar'])){
		$pag = "estoque_id2.php?lista=$lista";
	}else{
		$pag = "entrada2a.php";
	}
		
	//MensagemAlert("Alterar Desc->".$desc);
	
	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	}
?>

</body>
</html>		