<?php
require_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

	
	$title = "Entrada Med";
	
	$medicamento = new Medicamento();
	$med = $medicamento->buscar();
			
	?>
<!doctype>
<html>
	<head>
		<title><?php echo $title?></title>
		
		<?php echo cabecalho() ?>

	</head>
		
	<body>
		
	<?php echo nav2() ?>

    <div class="container">  

    <div class='form-group'>
    </br>
    </br>
    </br>
    <label for='text' class='btn btn-success container'>Entrada de Medicamento</label>
    </div>

    <?php

    echo "<form class='form-inline' role='form' method='post'>";
   

	echo "<table id='table-left' class='table table-condensed table-hover table-striped table-bordered'>";

    echo "<tr>";
    echo "<th>Medicamento</th>	<th>Quantidade</th>		<th>Validade</th>";
    echo "</tr>";
    
    $i=0;  
    do{

    $medicamento = new Medicamento();
	$med = $medicamento->buscar();

	$i++;

    echo "<tr>";
    echo "<col width='50%'>";
    echo "<col width='15%'>";
    echo "<col width='15%'>";

    echo "<td>";
    $idmed='idmed'.$i;
    //MensagemAlert($idmed);
    echo "<select type='text' class='form-control' id='idmed' name='$idmed' autofocus>";

						echo "<option>'SELECIONE...'</option>";
						foreach($med as $res) { 
								
								echo "<option value='".$res['id']."'>" . strtoupper($res['descricao'])." - ".$res['id']." - ".$res['unidade']."</option>";

								
								}
							
      	

    echo "</select>";
  	echo "<td>";
  	$quantidade = 'quantidade'.$i;
    echo "<input type='number' class='form-control' style='text-align:center' id='quantidade' name='$quantidade' placeholder='' size='12' maxlength='12'>";
    echo "</td>";
    echo "<td>";
    $validade = 'validade'.$i;
    echo "<input type='text' class='form-control' style='text-align:center' id='validade' name='$validade' placeholder='' size='5' maxlength='5'>";
    echo "</td>";       
	echo "</tr>";
	
	}while($i<8);

    echo "</table>";

    echo "<tr>";
	echo "<td>";
    echo "<textarea type='text' class='form-control' id='obs' name='obs' row='3' cols='117' placeholder='Observação'></textarea>";
    echo "</td>";
    echo "</tr>";

    echo "</br>";
    //$datahj = date('d/m/Y');
    $datahj = $_SESSION['datareal'];

    echo "<span>Data</span>";
    $dia=$datahj->format('d'); $mes=$datahj->format('m'); $ano=$datahj->format('Y');
    //$dia = date('d'); $mes = date('m'); $ano = date('Y');
    echo 	"<input class='form-control' type='number' name='dia' value=$dia min='1' max='31'>/</input>";
    echo    "<input class='form-control' type='number' name='mes' value=$mes min='1' max='12'>/</input>";
    echo    "<input class='form-control' type='number' name='ano' value=$ano min='2016' max='2025'></input>";
        
    echo "</br>";
    echo "<input type='checkbox' class='' name='listar' value='1'> Listar Estoque</input>";
    echo "</br></br>";

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
	$id_med = $_POST['idmed'.$a];
	$quant_ent=$_POST['quantidade'.$a];
	$quant_sai=0;
	$valid=$_POST['validade'.$a];
	$data_mov = date("Y-m-d");
	$data_real = $data;
	$obs = isset($_POST['obs'])?$_POST['obs']:"";

	
	if($id_med>0&&$quant_ent>0){

	//MensagemAlert($id_med);

	$movimento = new Mov_Medicamento();

	$movimento->setAtributos($id, $id_med, $codnovo, $quant_ent, $quant_sai, $valid, $data_mov, $data_real, $obs);
	
	$movimento->salvar($movimento);

	$arrayLista[$a-1] = $id_med;
	
	}

	}while($a<8);

	$tam = sizeof($arrayLista);

	$lista = base64_encode(serialize($arrayLista));

	//MensagemAlert("Tamanho array ->".$tam);

	if($tam>0&&isset($_POST['listar'])){
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