<?php
require_once 'funcoes.php';
include_once '../Classes/classeMaterial.php';
include_once '../Classes/classeMovimento.php';


$title = "Saída de Material";

$material = new Material();
$mat = $material->buscar();

?>
<!doctype>
<html>
<head>
	<title><?php echo $title?></title>
	<meta charset="utf-8">

	<script type="text/javascript" src="masc.js"> </script>

	<!-- Bootstrap Core CSS -->
	<link href="../../css/bootstrap.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="../../css/landing-page.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="estilo.css" type="text/css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script>
		$(document).ready(function(){
    		$('#idmat').change(function(){
        	$('#estoque').load('estoque_id3.php?id='+$('#idmat').val() );
    		});
		});
	</script>


</head>

<body>

	<?php echo nav()?>


	<div class="entradas">  


		<?php

    echo "<form class='' role='' method='post'>";

	echo "<table class='table'>";

    echo "<tr>";
    echo "<th>Material</th>	<th>Quantidade</th>";
    echo "</tr>";
    
    $i=0;  
    do{

    $material = new Material();
	$mat = $material->buscar();

	$i++;

    echo "<tr>";
    echo "<col width='50%'>";
    echo "<col width='15%'>";
    echo "<col width='15%'>";

    echo "<td>";
    $idmat='idmat'.$i;
    //MensagemAlert($idmat);
    echo "<select type='text' class='' id='idmat' name='$idmat' >";

						echo "<option>'SELECIONE...'</option>";
						foreach($mat as $res) { 
								
								echo "<option value='".$res['id']."'>" . strtoupper(utf8_encode($res['descricao']))." - ".$res['id']."</option>";

								
								}
							
      	

    echo "</select>";
  	echo "<td>";
  	$quantidade = 'quantidade'.$i;
    echo "<input type='text' style='text-align:center' id='quantidade' name='$quantidade' placeholder='' size='12' maxlength='12'>";
    echo "<span id='estoque'></span>";
    echo "</td>";
           
	echo "</tr>";
	
	}while($i<8);

    echo "</table>";

    echo "<button type='submit' class='btn btn-default' name='cadastrar' value='Cadastrar'>Salvar</button>";

  echo "</form>";

	?>

	</div>

	
	﻿

	<?php
	
	//Teste se o botão salvar foi clicado
	if(isset($_POST['cadastrar'])){

		$a = 0;

		do{

			$a++;

			$id = "000000";
			$id_mat = $_POST['idmat'.$a];
			$quant_ent=0;
			$quant_sai=$_POST['quantidade'.$a];
			$valid="";
			$data_mov = date("Y-m-d");


			if($id_mat>0&&$quant_sai>0){

	//MensagemAlert($id_mat);

				$movimento = new Movimento();

				$movimento->setAtributos($id, $id_mat, $quant_ent, $quant_sai, $valid, $data_mov);

				$movimento->salvar($movimento);

				$array_Lista[$a-1] = $id_mat;

			}

		}while($a<8||empty($id_mat));

		$tam = sizeof($array_Lista);

		$lista = base64_encode(serialize($array_Lista));

		MensagemAlert("Tamanho array ->".$tam);

		if($tam>0){
			$pag = "estoque_id2.php?lista=$lista";
		}else{
			$pag = "entrada2.php";
		}
		
	//MensagemAlert("Alterar Desc->".$desc);


		echo "<meta http-equiv='refresh' content='0; url=$pag'>";


	}
	?>

</body>
</html>