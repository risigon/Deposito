<?php
require_once 'funcoes.php';
include_once '../Classes/classeMaterial.php';
include_once '../Classes/classeMovimento.php';


$usuario = sessao();

if(isset($_SESSION['usuario'])){

	
	$title = "Saída Mat";
	
	$material = new Material();
	$mat = $material->buscar();

	if(isset($_SESSION['salvar'])){
		$i=1;
		do{  
			$idmat_sal[$i] = $_SESSION['salvar']['idmat'.$i];
			$qtde_sal[$i] = $_SESSION['salvar']['quantidade'.$i];
			$val_sal[$i] = $_SESSION['salvar']['validade'.$i];
			//MensagemAlert($idmat);
			$i++;
		}while(!empty($_SESSION['salvar']['quantidade'.$i]));
	}
			
	?>
<!doctype>
<html>
	<head>

                <?php cabecalho()?>

		<title><?php echo $title?></title>
		
	<script>
	function focusFunction() {
	    // Focus = Changes the background color of input to yellow
	    document.getElementById("myInput").style.background = "yellow";
	}

	function blurFunction() {
	    // No focus = Changes the background color of input to red
	    document.getElementById("myInput").style.background = "red";
	}
	</script>	


	</head>
		
	<body class="bodyMaterial">
		
	<?php echo nav2()?>

    
	<div class="container">  
	
	<div class="form-group">
	  </br></br></br>
      <label for="text" class="btn btn-danger container">Saída de Material</label>
  	</div>
  	</br>
    <?php

    echo "<form class='form-inline' role='form' method='post'>";

	echo "<table id='table-left' class='table table-bordered table-condensed table-striped'>";

    echo "<tr>";
    echo "<th>Material</th>	<th>Qtde</th> <th>Validade</th>";
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
    echo "<select type='text' class='form-control' id='idmat' name='$idmat' autofocus >";

						if(isset($idmat_sal[$i])&&(isset($qtde_sal[$i]))){
							 $desc = $material->buscarId($idmat_sal[$i]);
							  	foreach ($desc as $key) {
							  		$descricao = $key['descricao'];
							  	}
							  	//MensagemAlert($descricao);
							 	echo "<option value='$idmat_sal[$i]'>$descricao</option>";	
															 	
						}else{
						     echo "<option>'SELECIONE...'</option>";	
						}
						
						foreach($mat as $res) { 
								
								echo "<option value='".$res['id']."'>" . strtoupper($res['descricao'])." - ".$res['codigo']." - ".$res['unidade']."</option>";

								
								}
							
      	

    echo "</select>";
  	echo "<td>";
  	$quantidade = 'quantidade'.$i;
  	$qtde_sal[$i] = isset($qtde_sal[$i])?$qtde_sal[$i]:"";
    echo "<input type='number' class='form-control' style='text-align:center' id='quantidade' name='$quantidade' placeholder='' value='$qtde_sal[$i]' size='12' maxlength='12'>";
    echo "</td>";
  	echo "<td>";
  	$validade = 'validade'.$i;
  	$val_sal[$i] = isset($val_sal[$i])?$val_sal[$i]:"";
        echo "<input type='text' class='form-control' style='text-align:center' id='validade' name='$validade' placeholder='' value='$val_sal[$i]' size='5' maxlength='5'>";
        echo "</td>";
           
	echo "</tr>";
	
	}while($i<8);

	//print_r($idmat_sal);

	echo "</tbody>";
    echo "</table>";

    echo "<div class='form-group'>";
    echo "<textarea type='text' class='form-control' id='obs' name='obs' row='3' cols='117' placeholder='Observação'></textarea>";
    echo "</br>";
    echo "<input type='checkbox' class='' name='listar' value='1'> Listar Estoque</input>";
    echo "</br>";

    echo "<span>Data</span>";
    $datahj = $_SESSION['datareal'];
    $dia=$datahj->format('d'); $mes=$datahj->format('m'); $ano=$datahj->format('Y'); 
    echo "<input class='form-control' type='number' name='dia' value=$dia min='1' max='31'>/</input>";
    echo "<input class='form-control' type='number' name='mes' value=$mes min='1' max='12'>/</input>";
    echo "<input class='form-control' type='number' name='ano' value=$ano min='2016' max='2025'></input>";

    echo "</br>";
    
    echo "<input type='checkbox' class='' name='memo' value='1'> Memorizar</input><br>";
    echo "</div>";
    echo "</br></br>";

    echo "<button type='submit' class='btn btn-primary btn-block' name='cadastrar' value='Cadastrar'>Salvar</button>";
    echo "</br></br>";
    echo "<button type='submit' class='btn btn-danger btn-block' name='limpar'>Limpar</button>";

  echo "</form>";

	?>


</div>

		

<?php

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}

	
	if(isset($_POST['limpar'])){
		unset($_SESSION['salvar']);
		echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	}

	//Teste se o botão salvar foi clicado
	if(isset($_POST['cadastrar'])){

		if(isset($_POST['memo'])){
			$_SESSION['salvar'] = $_POST;
		}

	$a = 0;

        $data = $_POST['ano'].'-'.$_POST['mes'].'-'.$_POST['dia'];

	do{

		$a++;

		$id = "000000";
		$id_mat = $_POST['idmat'.$a];
		$quant_ent=0;
		$quant_sai=$_POST['quantidade'.$a];
		$valid=(isset($_POST['validade'.$a]))?$_POST['validade'.$a]:"";
		$data_mov = date("Y-m-d");
		$data_real = $data;
		$obs = (isset($_POST['obs']))?$_POST['obs']:"";	

	
	if($id_mat>0&&$quant_sai>0){

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
		$pag = "saida2.php";
	}
		
	//MensagemAlert("Alterar Desc->".$desc);
	
	
	echo "<meta http-equiv='refresh' content='0; url=$pag'>";
	
	
	}
?>

</body>
</html>	