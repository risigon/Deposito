<?php
//require_once 'conecta.php';
include_once '../Classes/classeConexaoPDO.php';
include_once '../Classes/classeMedicamento.php';
include_once '../Classes/classeMov_Medicamento.php';


function MensagemAlert($parametro) {
echo '<script>alert("'.$parametro.'");</script>';
}

function Confirmar() {
echo '<script>if (confirm("Press a button!") == true)
		return 1;</script>';
}

function registros($total, $colunas){
	echo "<td colspan=$colunas><b>Registros $total</b></td>";
}

function cabecalho(){
$pag = <<< PAG
	<meta charset="utf-8">
		
		<script type="text/javascript" src="masc.js"> </script>

		<!-- Bootstrap Core CSS -->
	    <link href="../css/bootstrap.css" rel="stylesheet">
	    <link href="../css/jquery-ui.css" rel="stylesheet">

	    <!-- Custom CSS -->
	    <link href="../css/landing-page.css" rel="stylesheet">

	    <!-- Custom Fonts>
	    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css"-->

	    <link rel="stylesheet" href="estilo.css" type="text/css">
		
		<!-- Bibliotecas JQuery -->
		<script src="../js/jquery-3.1.1.min.js" type="text/javascript"> </script>
		<script src="../js/jquery-ui.min.js"> </script>
		<!--link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
		<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script-->
PAG;
echo $pag;
}

function datepicker(){

$pagdate = <<< DATE

		<script>
			$(function() {
				$("#calendario").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#calendario").datepicker("setDate", new Date());
			});

			$(function() {
				$("#calendario2").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#calendario2").datepicker("setDate", new Date());
			});

			$(function() {
				$("#calendario3").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#calendario3").datepicker("setDate", new Date());
			});

			$(function() {
				$("#calendario4").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#calendario4").datepicker("setDate", new Date());
			});

			$(function() {
				$("#calendario5").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#calendario5").datepicker("setDate", new Date());
			});

			$(function() {
				$("#calendario6").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#calendario6").datepicker("setDate", new Date());
			}); 

			$(function() {
				$("#calendario7").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#calendario7").datepicker("setDate", new Date());
			});                             

                                $(function() {
				$("#calendario8").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#calendario8").datepicker("setDate", new Date());
			});
			
				$(function() {
				$("#calendario9").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#calendario9").datepicker("setDate", new Date());
			});

				$(function() {
				$("#calendario10").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#calendario10").datepicker("setDate", new Date());
			});

			$(function() {
				$("#val").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#val").datepicker("setDate", new Date());
			});

			$(function() {
				$("#val2").datepicker({
				showOtherMonths: true,
				selectOtherMonths: true,
				dateFormat: 'dd/mm/yy',
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
				});
				$("#val2").datepicker("setDate", new Date());
			});



		</script>

DATE;
echo $pagdate;

}

function relogio(){

$pag = <<< PAG
	<script>
		function startTime() {
		    var today = new Date();
		    var h = today.getHours();
		    var m = today.getMinutes();
		    var s = today.getSeconds();
		    m = checkTime(m);
		    s = checkTime(s);
		    document.getElementById('txt').innerHTML =
		    h + ":" + m + ":" + s;
		    var t = setTimeout(startTime, 500);
		}
		function checkTime(i) {
		    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		    return i;
		}
	</script>
PAG;
echo $pag;
}

function nav($usuario){

$usuario = ucfirst($usuario);

$pag = <<< PAG
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

<div>
      <ul class = "nav navbar-nav">
         
                    			
      </ul>
   </div>

        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <!--img src="http://placehold.it/150x50&text=Logo" alt=""-->
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="javascript:abrir('entrada.php');" accesskey="t" title="ALT + t">+</a>
                    </li>
                    <li>
                        <a href="javascript:abrir('entrada2.php');" accesskey="n" title="ALT + n">+++</a>
                    </li>
                    <li>
                        <a href="javascript:abrir('entValidade.php');">Val</a>
                    </li>
                    <li>
                        <a href="javascript:abrir('saida.php');" accesskey="s" title="ALT + s">-</a>
                    </li>
                    <li>
                        <a href="javascript:abrir('saida2.php');" accesskey="n" title="ALT + n">---</a>
                    </li>
                    <li>
                        <a href="javascript:abrir('pesquisa.php');" accesskey="u" title="ALT + u">Pesquisar</a>
                    </li>
                    
                    <li>
                        <a href="exportarXLS2.php" accesskey="x" title="ALT + x">XLS</a>
                    </li>
                    <li>
                        <a href="../Material/" accesskey="m" title="ALT + m">Material</a>
                    </li>
                    <li>
                        <a href="javascript:abrir('alterarData.php');" accesskey="u" title="ALT + d">Alterar Data</a>
                    </li>
                    <li>
                        <a href="">{$usuario}</a>
                    </li>                    
                   <li>
                        <a href="../logout.php" accesskey="q" title="ALT + q">Sair</a>
                    </li>                    
                </ul>

                <div class="col-sm-2 col-md-2 pull-right">
			        <form class="navbar-form" role="search" action="estoque_id.php" method="post">
			        <div class="input-group">
			        	
			            <input type="text" class="btn btn-default" placeholder="descriÃ§Ã£o" name="nome" id="nome" size="30" maxlength="30">
			            <span class="input-group-btn">
			        		<button class="btn btn-success" type="submit">Buscar</button>
			        	</span>

			        </div>
			        
			        </form>
			    </div>
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
PAG;
echo $pag;
}

function nav2(){

$caminho = $_SERVER['PHP_SELF'];

$arr = explode("/", $caminho);

$actual_link = end($arr); //pegar só o nome da pagina

$xls = $actual_link == 'validades.php'?'exportarVal.php':'exportarXLS2.php';

$pag = <<< PAG
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <!--img src="http://placehold.it/150x50&text=Logo" alt=""-->
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                	<li>
                    	<a href="javascript: window.history.go(-1)">Voltar</a>
                    </li>
                    
                    <li>
                        <a href="entrada.php" accesskey="e" title="ALT + e">+</a>
                    </li>
                    <li>
                        <a href="entrada2.php" accesskey="m" title="ALT + m">+++</a>
                    </li>
                    <li>
                        <a href="entValidade.php">Val</a>
                    </li>
                    <li>
                        <a href={$xls} accesskey="x" title="ALT + x">XLS</a>
                    </li>
                    <li>
                        <a href="saida.php" accesskey="s" title="ALT + s">-</a>
                    </li>
                    <li>
                        <a href="saida2.php" accesskey="n" title="ALT + n">---</a>
                    </li>
                    <li>
                        <a href="pesquisa.php" accesskey="p" title="ALT + p">Pesquisar</a>
                    </li>  
                                
                </ul>
                <ul class='nav navbar-nav navbar-right'>
                	<li>
                        <a href="javascript:window.close()" accesskey="f" title="ALT + f">X</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
PAG;
echo $pag;
}

function janela(){
$pag = <<< PAG
		<script language="JavaScript">
			function abrir(URL) {
			 
			  var width = 1400;
			  var height = 850;
			 
			  var left = 99;
			  var top = 99;
			 
			  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
			 
			}
		</script>
PAG;
echo $pag;
}


function formOpen($class, $role, $action){
	$pag = <<< PAG
	<form class=$class role=$role method=$action>
PAG;
	echo $pag;
}

function formClose(){
	echo "</form>";
}

function option($valor, $descricao){
	echo "<option value=$valor>$descricao</option>";
}

function input($tipo, $name, $id, $class, $placeholder, $size, $maxlength, $required){

	if($required==="required"){
		echo "<input type=$tipo name=$name id=$id class=$class placeholder=$placeholder size=$size maxlength=$maxlength required></input>";	
	}else{			
		echo "<input type=$tipo name=$name id=$id class=$class placeholder=$placeholder size=$size maxlength=$maxlength></input>";
	}
	}

function label($tipo, $descricao){
	echo "<label for=$tipo>$descricao</label>";
}

function divOpen($class){
	echo "<div class=$class>";
}

function divClose(){
	echo "</div>";
}

function sessao(){

$usuario = "";

session_start();

if(isset($_SESSION["usuario"])){
$usuario = $_SESSION["usuario"];
}

return $usuario;

}

function tempo_execucao(){

$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]; // calcula o tempo de execucao do script

$time = number_format($time,4); // formata com 4 casas

echo "<label class='registros' align='center'>Tempo de Execucao: $time</label>"; // mostra na tela

}

function contador_acessos(){
$arquivo = "contador.txt";
$handle = fopen($arquivo, 'r+');// abrir o arquivo para leitura e gravaÃ§Ã£o
$data = fread($handle, 512); // obtem a quantidade do arquivo
$contador = $data + 1; // incrementa o contador
echo "<label class='registros' align='center'>Acessos: $contador</label>"; // mostra na tela
fseek($handle, 0); //volta o ponteiro ao inÃ­cio do arquivo
fwrite($handle, $contador); // salva o valor da variÃ¡vel
fclose($handle); // fecha o arquivo
}

function inserir($sql){

	if(mysql_query($sql)){
	MensagemAlert('Inserido com sucesso...');//echo "cadastro efetuado com sucesso";
	}
	else{
	MensagemAlert('Erro ao Inserir...');//echo "erro ao cadastrar";
	echo die (mysql_error());
	}

}

function alterar($sql){

		
	mysql_query($sql);
	
	if(mysql_affected_rows()){
	MensagemAlert('Alterado com sucesso');
	}
	else{
	MensagemAlert('ID InvÃ¡lido');
	echo $sql;
	die(mysql_error());
	}
	
}

function select($sql){

	require 'conecta.php';	

	if($res=mysql_query($sql)){
	//MensagemAlert('Consulta realizada com sucesso...');
	return $res;
	}
	else{
	MensagemAlert('Erro ao Consultar...');//echo "erro ao cadastrar";
	echo die (mysql_error());
	}

	mysql_close();
	
}

function estoqueNome($nome){

	$colunas = 6;
	
	$mov = new Mov_Medicamento();

	$lista = $mov->buscarEstoqueNome($nome);
	
	$total = $lista->rowCount(PDO::FETCH_ASSOC);
	
	// gera o loop com os resultados
	
		
		echo "<table id='' class='table table-condensed table-hover table-bordered table-striped'>";
			echo "<tr>";
			echo "<th colspan=$colunas align='center'>ESTOQUE ATUAL</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Codigo</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Quantidade</th>";
			echo "<th>Unidade</th>";
			echo "<th colspan=2>Alterar</th>";
			            
            echo "</tr>";
        foreach ($lista as $linha)
        {
			$cod = $linha['id_med'];
			$desc = strtoupper($linha['descricao']);
            $qtd = $linha['quant_estoque']>0?$linha['quant_estoque']:"-";
            $und = $linha['unidade'];
			$encript = base64_encode($cod);
						
            echo "<tr>";
            echo "<col width='8%'>";
           	echo "<col width='45%'>";
           	echo "<col width='12%'>";
           	echo "<col width='7%'>";
           	echo "<col width='14%'>";

			echo "<td>$cod</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$qtd</td>";
			echo "<td>$und</td>";
			echo "<td>
					<a href='alterar.php?id=$encript'>Editar</a>
				</td>";
			echo "<td>
					<a href='validade.php?id=$encript'>Validade</a>
				</td>";
						
			echo "</tr>";

        }

        echo "<tr>";
        	echo registros($total, $colunas);
        echo "</tr>";

        echo"</table>";
     
		echo "<p class='registros' align='center'>Registros: $total</p>";  
}

function entradasPeriodo($inicio, $fim){

	$colunas = 9;

	$inibd = datatobd($inicio);
	$fimbd = datatobd($fim);

	//$pag="buscarCheque.php&periodoini=".$inibd."&periodofim=".$fimbd;
	$pag = "periodo"."&periodoini=".datatoview($inibd)."&periodofim=".datatoview($fimbd);
	
	//MensagemAlert($inibd." - ".$fimbd);

    //$sql = "SELECT * FROM cheques where pgtodata >='$ini' and pgtodata <='$fim' order by id";
    //$sql = "SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, baixa FROM cheques where pgtodata between '$inibd' and '$fimbd' and cancelar is null order by id";
            
    // executa a query no banco de dados
    //$executar = mysql_query($sql);
               
    // conta o total de resultados encontrados
    //$total = mysql_num_rows($executar);

	$movimento = new Mov_Medicamento();

	$med = $movimento->entradasPeriodo($inibd, $fimbd);
	
	$total = $med->rowCount(PDO::FETCH_ASSOC);
		
    $valorTotal = 0;
	
        // gera o loop com os resultados

    if($total>0){

    echo "<div class='container'>";

    echo "<form action='excluirLista.php' method='post'>";
		
		echo "<table id='' class='table table-condensed table-bordered table-hover table-striped'>";
		echo "<tbody>";
			echo "<tr>";
			echo "<th colspan=$colunas>ENTRADAS - PERÃODO ($inicio -> $fim)</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Id</th>";
			echo "<th>Codigo</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Qtde</th>";
			echo "<th>UN</th>";
			echo "<th>Val</th>";
			echo "<th>Obs</th>";
			echo "<th>Data</th>";
			echo "<th>Alterar</th>";
			            
            echo "</tr>";
        foreach($med as $linha) 
        {
			$id_mov = $linha['id_mov'];
			$cod = $linha['id_med'];
			$desc = strtoupper($linha['descricao']);
            $qtd = $linha['quant_ent'];
            $und = $linha['unidade'];
			$val = $linha['validade'];
			$obs = $linha['obs'];
			$dt = $linha['data_real'];
			$encript = base64_encode($id_mov);
						
            echo "<tr>";
            echo "<col width='8%'>";
           	echo "<col width='8%'>";
           	echo "<col width='45%'>";
           	echo "<col width='12%'>";
           	echo "<col width='7%'>";
           	echo "<col width='7%'>";

           	echo "<td>$id_mov</td>";
			echo "<td>$cod</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$qtd</td>";
			echo "<td>$und</td>";
			echo "<td>$val</td>";
			echo "<td>$obs</td>";
			echo "<td>$dt</td>";
			echo "<td>
					<input class='btn btn-success' type='checkbox' name='listaexcluir[]' value='$encript'>
			     </td>";

            echo "</tr>";


        }
        

        echo "<tr>";
        	echo registros($total, $colunas);
        echo "</tr>";

        echo "</tbody>";

        echo"</table>";

        echo "<button type='submit' class='btn btn-danger btn-sm marginLeft' name='del' value='lista'>Excluir</button>";
        echo "<button type='submit' class='btn btn-success btn-sm marginLeft' name='edit' value='edit'>Editar</button>";

        echo "<a href='exportarMov.php' class='btn btn-success btn-sm marginLeft'>XLS</a>";
        
		echo "</form>";
       
	echo "</div>";
       
       }else{
       	echo "<div class='container'>";
       	echo "<table id='zebra' class='table'>";
       	echo "<tr>";
       	echo "<td>NÃ£o hÃ¡ dados para o perÃ­odo $inicio -> $fim</td>";
       	echo "</tr>";
       	echo "</table>";
       	echo "</div>";
       }

       }    

       function movsaidasPeriodo($inicio, $fim){

	$colunas = 9;

	$inibd = datatobd($inicio);
	$fimbd = datatobd($fim);

	//$pag="buscarCheque.php&periodoini=".$inibd."&periodofim=".$fimbd;
	$pag = "periodo"."&periodoini=".datatoview($inibd)."&periodofim=".datatoview($fimbd);
	
	//MensagemAlert($inibd." - ".$fimbd);

    //$sql = "SELECT * FROM cheques where pgtodata >='$ini' and pgtodata <='$fim' order by id";
    //$sql = "SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, baixa FROM cheques where pgtodata between '$inibd' and '$fimbd' and cancelar is null order by id";
            
    // executa a query no banco de dados
    //$executar = mysql_query($sql);
               
    // conta o total de resultados encontrados
    //$total = mysql_num_rows($executar);

	$movimento = new Mov_Medicamento();

	$med = $movimento->movsaidasPeriodo($inibd, $fimbd);
	
	$total = $med->rowCount(PDO::FETCH_ASSOC);
		
    $valorTotal = 0;
	
        // gera o loop com os resultados

    if($total>0){

	echo "<div class='container'>";

	echo "<form action='excluirLista.php' method='post'>";	

		echo "<table id='' class='table table-condensed table-bordered table-hover table-striped'>";
		echo "<tbody>";
			echo "<tr>";
			echo "<th colspan=$colunas>SAIDAS - PERÃODO ($inicio -> $fim)</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Id</th>";
			echo "<th>Codigo</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Qtde</th>";
			echo "<th>UN</th>";
			echo "<th>Val</th>";
			echo "<th>Obs</th>";
			echo "<th>Data</th>";
			echo "<th>Alterar</th>";
			            
            echo "</tr>";
        foreach($med as $linha) 
        {
			$id = $linha['id_mov'];
			$cod = $linha['id_med'];
			$desc = strtoupper($linha['descricao']);
            $qtd = $linha['quant_sai'];
            $und = $linha['unidade'];
			$val = $linha['validade'];
			$obs = $linha['obs'];
			$dt = $linha['data_real'];
			$encript = base64_encode($id);
			$encriptpg = base64_encode("listar_saidas.php");
						
            echo "<tr>";
            echo "<col width='8%'>";
            echo "<col width='8%'>";
           	echo "<col width='65%'>";
           	echo "<col width='10%'>";
           	echo "<col width='5%'>";
           	echo "<col width='7%'>";
           	echo "<col width='7%'>";

			echo "<td>$id</td>";
			echo "<td>$cod</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$qtd</td>";
			echo "<td>$und</td>";
			echo "<td>$val</td>";
			echo "<td>$obs</td>";
			echo "<td>$dt</td>";
			echo "<td>
					<input class='btn btn-success' type='checkbox' name='listaexcluir[]' value='$encript'>
			     </td>";

            echo "</tr>";


        }
        

        echo "<tr>";
        	echo registros($total, $colunas);
        echo "</tr>";

        echo "</tbody>";

        echo"</table>";

        echo "<button type='submit' class='btn btn-danger btn-sm marginLeft' name='del' value='lista'>Excluir</button>";
        echo "<button type='submit' class='btn btn-success btn-sm marginLeft' name='edit' value='edit'>Editar</button>";

        echo "<a href='exportarMov.php' class='btn btn-success btn-sm marginLeft'>XLS</a>";
        
		echo "</form>";
       
	echo "</div>";
       
       }else{
       	echo "<div class='container'>";
       	echo "<table id='zebra' class='table'>";
       	echo "<tr>";
       	echo "<td>NÃ£o hÃ¡ dados para o perÃ­odo $inicio -> $fim</td>";
       	echo "</tr>";
       	echo "</table>";
       	echo "</div>";
       }

       }    


function consumoPeriodo($inicio, $fim){

	$colunas = 4;

	$inibd = datatobd($inicio);
	$fimbd = datatobd($fim);

	//$pag="buscarCheque.php&periodoini=".$inibd."&periodofim=".$fimbd;
	$pag = "periodo"."&periodoini=".datatoview($inibd)."&periodofim=".datatoview($fimbd);
	
	//MensagemAlert($inibd." - ".$fimbd);

    //$sql = "SELECT * FROM cheques where pgtodata >='$ini' and pgtodata <='$fim' order by id";
    //$sql = "SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, baixa FROM cheques where pgtodata between '$inibd' and '$fimbd' and cancelar is null order by id";
            
    // executa a query no banco de dados
    //$executar = mysql_query($sql);
               
    // conta o total de resultados encontrados
    //$total = mysql_num_rows($executar);

	$movimento = new Mov_Medicamento();

	$med = $movimento->consPeriodo($inibd, $fimbd);
	
	$total = $med->rowCount(PDO::FETCH_ASSOC);
		
    $valorTotal = 0;
	
        // gera o loop com os resultados

    if($total>0){

		echo "<div class='container'>";
		echo "<table id='' class='table table-condensed table-bordered table-hover table-striped'>";
		echo "<tbody>";
			echo "<tr>";
			echo "<th colspan=$colunas>CONSUMO - PERÃODO ($inicio -> $fim)</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Codigo</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Quantidade</th>";
			echo "<th>Unidade</th>";
			
			            
            echo "</tr>";
        foreach($med as $linha) 
        {
			$cod = $linha['id_med'];
			$desc = strtoupper($linha['descricao']);
            $qtd = $linha['quant_consumo'];
            $und = $linha['unidade'];
			
						
            echo "<tr>";
            echo "<col width='8%'>";
           	echo "<col width='45%'>";
           	echo "<col width='12%'>";
           	echo "<col width='7%'>";
           	

			echo "<td>$cod</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$qtd</td>";
			echo "<td>$und</td>";
			
            echo "</tr>";


        }
        

        echo "<tr>";
        	echo registros($total, $colunas);
        echo "</tr>";

        echo "</tbody>";

        echo"</table>";

        echo "<a href='exportarMov.php' class='btn btn-success btn-sm marginLeft'>XLS</a>";
       
		echo "</div>";
       
       }else{
       	echo "<div class='container'>";
       	echo "<table id='zebra' class='table'>";
       	echo "<tr>";
       	echo "<td>NÃ£o hÃ¡ dados para o perÃ­odo $inicio -> $fim</td>";
       	echo "</tr>";
       	echo "</table>";
       	echo "</div>";
       }

       }     

function entPeriodo($inicio, $fim){

	$colunas = 4;

	$inibd = datatobd($inicio);
	$fimbd = datatobd($fim);

	//$pag="buscarCheque.php&periodoini=".$inibd."&periodofim=".$fimbd;
	$pag = "periodo"."&periodoini=".datatoview($inibd)."&periodofim=".datatoview($fimbd);
	
	//MensagemAlert($inibd." - ".$fimbd);

    //$sql = "SELECT * FROM cheques where pgtodata >='$ini' and pgtodata <='$fim' order by id";
    //$sql = "SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, baixa FROM cheques where pgtodata between '$inibd' and '$fimbd' and cancelar is null order by id";
            
    // executa a query no banco de dados
    //$executar = mysql_query($sql);
               
    // conta o total de resultados encontrados
    //$total = mysql_num_rows($executar);

	$movimento = new Mov_Medicamento();

	$med = $movimento->entPeriodo($inibd, $fimbd);
	
	$total = $med->rowCount(PDO::FETCH_ASSOC);
		
    $valorTotal = 0;
	
        // gera o loop com os resultados

    if($total>0){

		echo "<div class='container'>";
		echo "<table id='' class='table table-condensed table-bordered table-hover table-striped'>";
		echo "<tbody>";
			echo "<tr>";
			echo "<th colspan=$colunas>ENTRADAS - PERÃODO ($inicio -> $fim)</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Codigo</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Quantidade</th>";
			echo "<th>Unidade</th>";
			
			            
            echo "</tr>";
        foreach($med as $linha) 
        {
			$cod = $linha['id_med'];
			$desc = strtoupper($linha['descricao']);
            $qtd = $linha['quant_entrada'];
            $und = $linha['unidade'];
			
						
            echo "<tr>";
            echo "<col width='8%'>";
           	echo "<col width='45%'>";
           	echo "<col width='12%'>";
           	echo "<col width='7%'>";
           	

			echo "<td>$cod</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$qtd</td>";
			echo "<td>$und</td>";
			
            echo "</tr>";


        }
        

        echo "<tr>";
        	echo registros($total, $colunas);
        echo "</tr>";

        echo "</tbody>";

        echo"</table>";

        echo "<a href='exportarMov.php' class='btn btn-success btn-sm marginLeft'>XLS</a>";
       
		echo "</div>";
       
       }else{
       	echo "<div class='container'>";
       	echo "<table id='zebra' class='table'>";
       	echo "<tr>";
       	echo "<td>NÃ£o hÃ¡ dados para o perÃ­odo $inicio -> $fim</td>";
       	echo "</tr>";
       	echo "</table>";
       	echo "</div>";
       }

       }     

function validadesPeriodo($inicio, $fim){

	$colunas = 5;

	$inibd = datatobd($inicio);
	$fimbd = datatobd($fim);

	//$pag="buscarCheque.php&periodoini=".$inibd."&periodofim=".$fimbd;
	$pag = "periodo"."&periodoini=".datatoview($inibd)."&periodofim=".datatoview($fimbd);
	
	//MensagemAlert($inibd." - ".$fimbd);

    //$sql = "SELECT * FROM cheques where pgtodata >='$ini' and pgtodata <='$fim' order by id";
    //$sql = "SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, baixa FROM cheques where pgtodata between '$inibd' and '$fimbd' and cancelar is null order by id";
            
    // executa a query no banco de dados
    //$executar = mysql_query($sql);
               
    // conta o total de resultados encontrados
    //$total = mysql_num_rows($executar);

	$movimento = new Mov_Medicamento();

	$med = $movimento->valPeriodo($inibd, $fimbd);
	
	$total = $med->rowCount(PDO::FETCH_ASSOC);
		
    $valorTotal = 0;
	
        // gera o loop com os resultados

    if($total>0){

		echo "<div class='container'>";
		echo "<table id='' class='table table-condensed table-bordered table-hover table-striped'>";
		echo "<tbody>";
			echo "<tr>";
			echo "<th colspan=$colunas>VALIDADES - PERÃODO ($inicio -> $fim)</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Codigo</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Validade 1</th>";
			echo "<th>Validade 2</th>";
			echo "<th>Validade 3</th>";			
			            
            echo "</tr>";
        foreach($med as $linha) 
        {
			$cod = $linha['id'];
			$desc = strtoupper($linha['descricao']);
            $val1 = $linha['val1']<'2010-01-01'?'-':datatoview($linha['val1']);
            $val2 = $linha['val2']<'2010-01-01'?'-':datatoview($linha['val2']);
			$val3 = $linha['val3']<'2010-01-01'?'-':datatoview($linha['val3']);
						
            echo "<tr>";
            echo "<col width='8%'>";
           	echo "<col width='50%'>";
           	echo "<col width='15%'>";
           	echo "<col width='15%'>";
           	echo "<col width='15%'>";           	

			echo "<td>$cod</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$val1</td>";
			echo "<td>$val2</td>";
			echo "<td>$val3</td>";
			
            echo "</tr>";


        }
        

        echo "<tr>";
        	echo registros($total, $colunas);
        echo "</tr>";

        echo "</tbody>";

        echo"</table>";
       
		echo "</div>";
       
       }else{
       	echo "<div class='container'>";
       	echo "<table id='zebra' class='table'>";
       	echo "<tr>";
       	echo "<td>NÃ£o hÃ¡ dados para o perÃ­odo $inicio -> $fim</td>";
       	echo "</tr>";
       	echo "</table>";
       	echo "</div>";
       }

       }

function movPeriodo($inicio, $fim){

	$inibd = datatobd($inicio);
	$fimbd = datatobd($fim);

	//$pag="buscarCheque.php&periodoini=".$inibd."&periodofim=".$fimbd;
	$pag = "periodo"."&periodoini=".datatoview($inibd)."&periodofim=".datatoview($fimbd);
	
	//MensagemAlert($inibd." - ".$fimbd);

    //$sql = "SELECT * FROM cheques where pgtodata >='$ini' and pgtodata <='$fim' order by id";
    //$sql = "SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, baixa FROM cheques where pgtodata between '$inibd' and '$fimbd' and cancelar is null order by id";
            
    // executa a query no banco de dados
    //$executar = mysql_query($sql);
               
    // conta o total de resultados encontrados
    //$total = mysql_num_rows($executar);

	$mov_med = new Mov_Medicamento();

	$med = $mov_med->movPeriodo($inibd, $fimbd);
	
	$total = $med->rowCount(PDO::FETCH_ASSOC);
		
    $valorTotal = 0;
	
        // gera o loop com os resultados

    if($total>0){

		$col = 10;

	echo "<div class='container'>";

	echo "<form action='excluirLista.php' method='post'>";

		echo "<table id='' class='table table-condensed table-bordered table-striped table-hover'>";
		echo "<tbody>";
			echo "<tr>";
			echo "<th colspan=$col>Movimento - PERÃODO ($inicio -> $fim)</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Cod Med</th>";
			echo "<th>Cod Mov</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Entrada</th>";
			echo "<th>Saída</th>";
			echo "<th>Unidade</th>";
			echo "<th>Validade</th>";
			echo "<th>Obs</th>";
			echo "<th>Data</th>";
			echo "<th>Alterar</th>";
			
			            
            echo "</tr>";
        foreach($med as $linha) 
        {
			$id_med = $linha['id_med'];
			$id_mov = $linha['id_mov'];
			$desc = strtoupper($linha['descricao']);
            $qtd_ent = $linha['quant_ent'];
            $qtd_sai = $linha['quant_sai'];
            $und = $linha['unidade'];
            $val = $linha['validade'];
            $obs = $linha['obs'];
            $dt = $linha['data_real'];
			$encript = base64_encode($id_mov);
						
            echo "<tr>";
            echo "<col width='8%'>";
            echo "<col width='8%'>";
           	echo "<col width='45%'>";
           	echo "<col width='12%'>";
           	echo "<col width='7%'>";
           	echo "<col width='7%'>";
           	
           	echo "<td>$id_med</td>";
           	echo "<td>$id_mov</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$qtd_ent</td>";
			echo "<td>$qtd_sai</td>";
			echo "<td>$und</td>";
			echo "<td>$val</td>";
			echo "<td>$obs</td>";
			echo "<td>$dt</td>";
			echo "<td>
					<input class='btn btn-success' type='checkbox' name='listaexcluir[]' value='$encript'>
			     </td>";
			
            echo "</tr>";


        }

        echo "<tr>";
        echo "<td colspan=$col> Registros: $total</td>";
        echo "<tr>";
        echo "</tbody>";
        echo"</table>";
        
		echo "<button type='submit' class='btn btn-danger btn-sm marginLeft' name='del' value='lista'>Excluir</button>";
        echo "<button type='submit' class='btn btn-success btn-sm marginLeft' name='edit' value='edit'>Editar</button>";

        echo "<a href='exportarMov.php' class='btn btn-success btn-sm marginLeft'>XLS</a>";
        
	echo "</form>";

	echo "</div>";
		
       }else{
       	echo "<div class='container'>";
       	echo "<table id='zebra' class='table'>";
       	echo "<tr>";
       	echo "<td>NÃ£o hÃ¡ dados para o perÃ­odo $inicio -> $fim</td>";
       	echo "</tr>";
       	echo "</table>";
       	echo "</div>";
       }

       }       


function estoque_hoje(){

	$colunas = 11;

	$pagina = (isset($_GET['pagina']))? base64_decode($_GET['pagina']) : 1;

    //seta a quantidade de itens por pÃ¡gina, neste caso, 10 itens
    $registros = 20;


	$mov_med = new Mov_Medicamento();

	$mov = $mov_med->buscarHoje();
	
	$total = $mov->rowCount(PDO::FETCH_ASSOC);

	//calcula o nÃºmero de pÃ¡ginas arredondando o resultado para cima
    $numPaginas = ceil($total/$registros);

    //variavel para calcular o inÃ­cio da visualizaÃ§Ã£o com base na pÃ¡gina atual
    $inicio = ($registros*$pagina)-$registros;

    $mov = $mov_med->buscarPag($inicio, $registros);

    if($numPaginas == $pagina){
    	$total2 = $total;
    }else{
    	$total2 = $mov->rowCount(PDO::FETCH_ASSOC)*$pagina;
		}
	
	// gera o loop com os resultados

		
		echo "<table id='table-index' class='table table-condensed table-bordered table-striped table-hover'>";
		
		
        echo "<td colspan=$colunas align='center'>";
        echo "<ul class='pagination'>";
        $pagant = base64_encode($pagina>1?$pagina-1:1); // operador ternÃ¡rio
        $pagpro = base64_encode($pagina+1<=$numPaginas?$pagina+1:$numPaginas);
        $pag1 = base64_encode(1);
        echo "<li><a href='index.php?pagina=$pag1' title='Primeira PÃ¡gina'>Inicio</a></li>";
        echo "<li><a href='index.php?pagina=$pagant' title='PÃ¡gina Anterior'>Anterior</a></li>";
        
		for($i = 1; $i < $numPaginas + 1; $i++) {
			 $i2 = base64_encode($i);
             $pag = intval($pagina);
			 echo $pag===$i?"<li><a style='color:red; background-color:lightyellow;' href='index.php?pagina=$i2'><b>$i</b></a></li>":"<li><a href='index.php?pagina=$i2'>$i</a></li>";
                      
        }
        echo "<li><a href='index.php?pagina=$pagpro' title='PrÃ³xima PÃ¡gina'>Proxima</a></li>";
        $pagFinal = base64_encode($numPaginas);
        echo "<li><a href='index.php?pagina=$pagFinal' title='Ultima PÃ¡gina'>Fim</a></li>";

        echo "</ul>";
        
        echo "</td>";       
        

        echo "<tr>";
			echo "<th colspan=$colunas align='center'>ESTOQUE ATUAL</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th align='center'>Codigo</th>";
			echo "<th align='center'>Cod Novo</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Qtde</th>";
			echo "<th>UN</th>";
			echo "<th colspan=3>Validade</th>";
			echo "<th colspan=3>Alterar</th>";
			            
        echo "</tr>";

        foreach ($mov as $linha)
        {
			$cod = $linha['id_med'];
			$codnovo = $linha['codnovo'];
			$desc = strtoupper($linha['descricao']);
            $qtd = $linha['quant_estoque']>0?formatar_numero($linha['quant_estoque']):"-";
            $und = $linha['unidade'];
            if($qtd==0){
            	$val = "";
            	$val2 = "";
            	$val3 = "";
            }else{
            $val = $linha['val1']<'2010-01-01'?'':datavalidade($linha['val1']);
            $val2 = $linha['val2']<'2010-01-01'?'':datavalidade($linha['val2']);
            $val3 = $linha['val3']<'2010-01-01'?'':datavalidade($linha['val3']);
			}

			$encript = base64_encode($cod);
			$encpag = base64_encode($pagina);
						
            echo "<tr class=''>";
            echo "<col width='8%'>";
            echo "<col width='10%'>";
           	echo "<col width='50%'>";
           	echo "<col width='10%'>";
           	echo "<col width='5%'>";
           	echo "<col width='7%'>";
           	echo "<col width='7%'>";

			echo "<td>$cod</td>";
			echo "<td>$codnovo</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$qtd</td>";
			echo "<td>$und</td>";
			echo "<td>$val</td>";
			echo "<td>$val2</td>";
			echo "<td>$val3</td>";
			
			echo "<td>
					<a href='alterar.php?id=$encript&pagina=$encpag' target='_blank'>Editar</a>
				</td>";
			echo "<td>
					<a href='estoque_id.php?id=$encript&mov=$encript' target='_blank'>Mov</a>
				</td>";
			echo "<td>
					<a href='saida.php?id=$encript' target='_blank'>Saida</a>
				</td>";
			
			echo "</tr>";

        }
		echo "<td colspan=$colunas align='center'>";
        echo "<ul class='pagination'>";
        $pagant = base64_encode($pagina>1?$pagina-1:1); // operador ternÃ¡rio
        $pagpro = base64_encode($pagina+1<=$numPaginas?$pagina+1:$numPaginas);
        $pag1 = base64_encode(1);
        echo "<li><a href='index.php?pagina=$pag1' title='Primeira PÃ¡gina'>Inicio</a></li>";
        echo "<li><a href='index.php?pagina=$pagant' title='PÃ¡gina Anterior'>Anterior</a></li>";
        
		for($i = 1; $i < $numPaginas + 1; $i++) {
			 $i2 = base64_encode($i);
             $pag = intval($pagina);
			 echo $pag===$i?"<li><a style='color:red; background-color:lightyellow;' href='index.php?pagina=$i2'><b>$i</b></a></li>":"<li><a href='index.php?pagina=$i2'>$i</a></li>";
                      
        }
        echo "<li><a href='index.php?pagina=$pagpro' title='PrÃ³xima PÃ¡gina'>Proxima</a></li>";
        $pagFinal = base64_encode($numPaginas);
        echo "<li><a href='index.php?pagina=$pagFinal' title='Ultima PÃ¡gina'>Fim</a></li>";

        echo "</ul>";
        
        echo "</td>";  

        echo "Registros ->$total2/$total<br><br>";     

        echo"</table>"; 

       }     

function buscarValidades($id){

	$colunas = 9;

	$pag="medicamento.php";
	
    //$sql = "SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, baixa FROM cheques where numero = '$numero'";
            
    // executa a query no banco de dados
    //$executar = mysql_query($sql);
               
    // conta o total de resultados encontrados
    //$total = mysql_num_rows($executar);
	
	$med = new Medicamento();

	$lista = $med->buscarValId($id);
	
	$total = $lista->rowCount(PDO::FETCH_ASSOC);
	
        // gera o loop com os resultados
    if($total>0){
    			
		echo "<table id='' class='table table-condensed table-striped table-hover table-bordered'>";
			echo "<tr>";
			echo "<th colspan=$colunas>VALIDADES</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Cod Entrada</th>";
			echo "<th>Cod Medicamento</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Quantidade</th>";
			echo "<th>Unidade</th>";
			echo "<th>Validade</th>";
			echo "<th>Data</th>";
			echo "<th colspan=2>Alterar</th>";
			            
            echo "</tr>";
        foreach ($lista as $linha) 
        {
			$id = $linha['id_mov'];
			$cod = $linha['id_med'];
			$des = $linha['descricao'];
            $qtd = $linha['quantidade'];
			$uni = $linha['unidade'];
			$val = $linha['validade'];
			$dat = datatoview($linha['data_mov']);
			
			$encript_id = base64_encode($id);
			$encript_cod = base64_encode($cod);

            echo "<tr>";
            echo "<col width='10%'>";
           	echo "<col width='15%'>";
           	echo "<col width='45%'>";
           	echo "<col width='10%'>";
           	echo "<col width='5%'>";
           	echo "<col width='10%'>";
 
			echo "<td>$id</td>";
			echo "<td>$cod</td>";
			echo "<td class='text-left'>$des</td>";
			echo "<td>$qtd</td>";
			echo "<td>$uni</td>";
			echo "<td>$val</td>";
			echo "<td>$dat</td>";
			echo "<td>
					<a href='alterarValidade.php?id=$encript_id&codmed=$encript_cod'>Editar</a>					
				</td>";
			echo "<td>
					<a href='excluirMovimento.php?id=$encript_id&idmed=$encript_cod'>Excluir</a>					
				</td>";
			
            echo "</tr>";

        }
        	echo "<tr>";
        		echo registros($total, $colunas);
        	echo "</tr>";
        echo"</table>";
		
		
       }

       return $total;    
}

function estoqueId($id){

	$colunas = 5;

	$mov_med = new Mov_Medicamento();

	$mov = $mov_med->buscarEstoqueId($id);
	
	$total = $mov->rowCount(PDO::FETCH_ASSOC);
	
	// gera o loop com os resultados

		
		echo "<table id='' class='table table-condensed table-bordered table-hover table-striped'>";
			echo "<tr>";
			echo "<th colspan=$colunas align='center'>ESTOQUE ATUAL</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Codigo</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Quantidade</th>";
			echo "<th>Unidade</th>";
			echo "<th>Validade</th>";

			            
            echo "</tr>";
        foreach ($mov as $linha)
        {
			$cod = $linha['id_med'];
			$desc = strtoupper($linha['descricao']);
            $qtd = $linha['quant_estoque'];
            $und = $linha['unidade'];
            if($qtd==0){
            	$val = "";
            }else{
            $val = datavalidade($linha['validade']);
			}
			$encript = base64_encode($cod);
						
            echo "<tr>";
            echo "<col width='8%'>";
           	echo "<col width='45%'>";
           	echo "<col width='10%'>";
           	echo "<col width='5%'>";
           	echo "<col width='5%'>";
           	echo "<col width='15%'>";
           	

			echo "<td>$cod</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$qtd</td>";
			echo "<td>$und</td>";
			echo "<td>$val</td>";
									
			echo "</tr>";

        }
        	echo "<tr>";
        	echo "<td colspan=$colunas><b> Registros $total </b> </td>";
        	echo "</tr>";
        echo"</table>";
     
		
}

function entradasId($id){

	$colunas = 7;

	$mov_med = new Mov_Medicamento();

	$mov = $mov_med->buscarEntradasId($id);
	
	$total = $mov->rowCount(PDO::FETCH_ASSOC);

	$soma = 0;
	
	// gera o loop com os resultados

	echo "<form action='excluirLista.php' method='post'>";	

		echo "<table id='' class='table table-condensed table-bordered table-hover table-striped'>";
			echo "<tr>";
			echo "<th colspan=$colunas align='center' bgcolor='#00FF7F'>ENTRADAS</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Codigo</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Qtde</th>";
			echo "<th>UN</th>";
			echo "<th>Validade</th>";
			echo "<th>Entrada</th>";
			echo "<th>Alterar</th>";

			            
            echo "</tr>";
        foreach ($mov as $linha)
        {
			$id = $linha['id_mov'];
			$cod = $linha['id_med'];
			$desc = strtoupper($linha['descricao']);
            $qtd = $linha['quant_ent'];
            $und = $linha['unidade'];
            if($qtd==0){
            	$val = "";
            }else{
            $val = $linha['validade'];
			}
			$dt = datatoview($linha['data_real']);
			$encript = base64_encode($cod);
			$soma += $qtd;

			$encript_id = base64_encode($id);
			$encript_cod = base64_encode($cod);
						
            echo "<tr>";
            echo "<col width='8%'>";
           	echo "<col width='45%'>";
           	echo "<col width='10%'>";
           	echo "<col width='5%'>";
           	echo "<col width='5%'>";
           	echo "<col width='15%'>";
           	
			echo "<td>$cod</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$qtd</td>";
			echo "<td>$und</td>";
			echo "<td>$val</td>";
			echo "<td>$dt</td>";
			
			echo "<td>
					<input class='btn btn-success' type='checkbox' name='listaexcluir[]' value='$encript_id'>
			     </td>";
						
			echo "</tr>";

        }
        	echo "<tr>";
        	echo "<td colspan=$colunas><b> Total de Entradas: $soma $und </b> </td>";
        	echo "</tr>";

        	echo "<tr>";
        	echo "<td colspan=$colunas><b> Registros $total </b> </td>";
        	echo "</tr>";
        echo"</table>";

        echo "<button type='submit' class='btn btn-danger btn-sm marginLeft' name='del' value='lista'>Excluir</button>";
        echo "<button type='submit' class='btn btn-success btn-sm marginLeft' name='edit' value='edit'>Editar</button>";
 
        echo "</form>";
		
	}

function saidasId($id){

	$colunas = 7;

	$mov_med = new Mov_Medicamento();

	$mov = $mov_med->buscarSaidasId($id);
	
	$total = $mov->rowCount(PDO::FETCH_ASSOC);

	$soma = 0;
	
	// gera o loop com os resultados

	echo "<form action='excluirLista.php' method='post'>";	

		echo "<table id='' class='table table-condensed table-bordered table-hover table-striped'>";
			echo "<tr>";
			echo "<th colspan=$colunas align='center' bgcolor='#FF7256'>SAIDAS</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Codigo</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Quantidade</th>";
			echo "<th>Unidade</th>";
			echo "<th>Validade</th>";
			echo "<th>Saida</th>";
			echo "<th>Alterar</th>";
			            
            echo "</tr>";
        foreach ($mov as $linha)
        {
			$id = $linha['id_mov'];
			$cod = $linha['id_med'];
			$desc = strtoupper($linha['descricao']);
            $qtd = $linha['quant_sai'];
            $und = $linha['unidade'];
            $val = $linha['validade'];
            $dt = datatoview($linha['data_real']);
			$encript = base64_encode($cod);
			$soma += $qtd;

			$encript_id = base64_encode($id);
			$encript_cod = base64_encode($cod);
						
            echo "<tr>";
            echo "<col width='8%'>";
           	echo "<col width='45%'>";
           	echo "<col width='10%'>";
           	echo "<col width='5%'>";
           	echo "<col width='5%'>";
           	echo "<col width='15%'>";
           	
			echo "<td>$cod</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$qtd</td>";
			echo "<td>$und</td>";
			echo "<td>$val</td>";
			echo "<td>$dt</td>";
			
			echo "<td>
					<input class='btn btn-success' type='checkbox' name='listaexcluir[]' value='$encript_id'>
			     </td>";
									
			echo "</tr>";

        }
        	echo "<tr>";
        	echo "<td colspan=$colunas><b> Total de Saidas: $soma $und </b> </td>";
        	echo "</tr>";

        	echo "<tr>";
        	echo "<td colspan=$colunas><b> Registros $total </b> </td>";
        	echo "</tr>";
        echo"</table>";

    echo "<button type='submit' class='btn btn-danger btn-sm marginLeft' name='del' value='lista'>Excluir</button>";
    echo "<button type='submit' class='btn btn-success btn-sm marginLeft' name='edit' value='edit'>Editar</button>";
 
    echo "</form>";
		
	}



function estoqueIdValor($id){

	  
	$mov_med = new Mov_Medicamento();

	$lista = $mov_med->buscarEstoqueId($id);
	
	$total = $lista->rowCount(PDO::FETCH_ASSOC);
	
	foreach ($lista as $linha)
        {
			
            $qtd = $linha['quant_estoque'];
            
        }

    return $qtd;

       }     

function estoqueId_Lista($lista){

	$colunas = 7;

	$list = base64_decode($lista);

	$lis = unserialize($list);

	$mov_med = new Mov_Medicamento();

	echo "<table id='zebra' class='table table-condensed' table-striped table-hover table-bordered>";
			echo "<tr>";
			echo "<th colspan=$colunas align='center'>ESTOQUE ATUAL</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th align='center'>Codigo</th>";
			echo "<th class='text-left'>Descricao</th>";
			echo "<th>Quantidade</th>";
			echo "<th>Unidade</th>";
			echo "<th>Validade</th>";
			echo "<th colspan=2>Alterar</th>";
			            
            echo "</tr>";   

	foreach ($lis as $id) {
	

	$mov = $mov_med->buscarEstoqueId($id);
	
	$total = $mov->rowCount(PDO::FETCH_ASSOC);
	
	// gera o loop com os resultados

		
		foreach ($mov as $linha)
        {
			$cod = $linha['id_med'];
			$desc = strtoupper($linha['descricao']);
            $qtd = $linha['quant_estoque'];
            $und = $linha['unidade'];
            if($qtd==0){
            	$val = "";
            }else{
            $val = datavalidade($linha['validade']);
			}

			$encript = base64_encode($cod);
						
            echo "<tr>";
            echo "<col width='8%'>";
           	echo "<col width='45%'>";
           	echo "<col width='10%'>";
           	echo "<col width='5%'>";
           	echo "<col width='5%'>";
           	echo "<col width='15%'>";
           	

			echo "<td>$cod</td>";
			echo "<td class='text-left'>$desc</td>";
			echo "<td>$qtd</td>";
			echo "<td>$und</td>";
			echo "<td>$val</td>";
			
			echo "<td>
					<a href='alterar.php?id=$encript'>Editar</a>
				</td>";
			echo "<td>
					<a href='validade.php?id=$encript'>Validade</a>
				</td>";
			
			echo "</tr>";

        }
    }
    		$tam = sizeof($lis);
    		echo "<tr>";
        	echo "<td colspan=$colunas><b>Registros $tam</b></td>";
        	echo "</tr>";

        echo"</table>";
}



function chequeCredor($nome){

	$colunas = 10;

	$pag="credorBusca&credorBusca=".$nome;
		
	$pagamento = new Pagamento();

	$pagam = $pagamento->buscarCredor($nome);
	
	$total = $pagam->rowCount(PDO::FETCH_ASSOC);
	
	$valorTotal = 0;
	$valTot = 0;
	
        // gera o loop com os resultados
    if($total>0){
		
		echo "<table id='zebra' class='table table-condensed'>";
			echo '<tr>';
			echo '<th colspan=$colunas>PAGAMENTOS - BUSCAR CREDOR</th>';
			echo '</tr>';
			echo '<tr>';
			echo '<th>Codigo</th>';
			echo '<th>Credor</th>';
			echo '<th>Numero Cheque</th>';
			echo '<th>Valor</th>';
			echo '<th>OP</th>';
			echo '<th>Data</th>';
			echo '<th>Data Baixa</th>';
			echo "<th colspan=3>Alterar</th>";
			            
            echo '</tr>';
        foreach($pagam as $linha)
        {
			$cod = $linha['id'];
			$cre = primaiuscula($linha['credor']);
            $num = $linha['numero'];
            $val = $linha['valores'];
			$op = $linha['op'];
			$dt = $linha['pgtodata'];
			$dtBaixa = $linha['baixa'];
			$valTot = number_format($val,2,',','.');
			$valorTotal += $val;
						
            echo "<tr>";
            echo "<col width='10%'>";
           	echo "<col width='35%'>";
           	echo "<col width='18%'>";
           	echo "<col width='15%'>";
           	echo "<col width='7%'>";
           	echo "<col width='10%'>";
           	
			echo "<td align='center'>$cod</td>";
			echo "<td align='left'>$cre</td>";
			echo "<td align='center'>$num</td>";
			echo "<td align='right'>$valTot</td>";
			echo "<td align='center'>$op</td>";
			echo "<td align='center'>$dt</td>";
			echo "<td align='center'>$dtBaixa</td>";
			echo "<td align='center'>
					<a href='cancelarCheque.php?id=$cod'>Cancelar</a>					
				</td>";
			echo "<td align='center'>
					<a href='alterar.php?cod=$cod&pag=$pag'>Alterar</a>				
				</td>";
			echo "<td align='center'>
					<a href='baixarCheque.php?id=$cod&credor=$nome'>Baixar</a>					
				</td>";
            echo "</tr>";

        }
        echo"</table>";
		
       }
       $valorTotal = number_format($valorTotal,2,',','.');
       echo "<p class='registros' align='center'>Valor Total: $valorTotal</p>";
       echo "<p class='registros' align='center'>Registros: $total</p>"; 
       return $total;    
}

function buscarElgin(){

	//$hoje = date('Y-m-d');

	//$pag="buscarCheque&buscarCheque=".$numero;
	
    //$sql = "SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, baixa FROM cheques where numero = '$numero'";
            
    // executa a query no banco de dados
    //$executar = mysql_query($sql);
               
    // conta o total de resultados encontrados
    //$total = mysql_num_rows($executar);
	
	$elgin = new Elgin();

	$pagam = $elgin->buscarElgin();
	
	$total = $pagam->rowCount(PDO::FETCH_ASSOC);
	
        // gera o loop com os resultados
    if($total>0){
    			
		echo "<table id='zebra' class='table'>";
			echo "<tr>";
			echo "<th colspan=5>CADASTRO - ELGIN</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Codigo</th>";
			echo "<th>Fornecedor</th>";
			echo "<th>CÃ³digo Elgin</th>";
			echo "<th colspan=2>Alterar</th>";
			            
            echo "</tr>";
        foreach ($pagam as $linha) 
        {
			$cod = $linha['cod'];
			$cre = primaiuscula($linha['elgin_credor']);
            $num = $linha['elgin_cod'];
			
			//MensagemAlert('Data Baixa = '.$dtBaixa);

            echo "<tr>";
            echo "<col width='10%'>";
           	echo "<col width='35%'>";
           	echo "<col width='18%'>";
           	echo "<col width='15%'>";
           	echo "<col width='7%'>";
           	echo "<col width='10%'>";
 
			echo "<td align='center'>$cod</td>";
			echo "<td align='left'>$cre</td>";
			echo "<td align='center'>$num</td>";
			echo "<td align='center'>
					<a href='excluirElgin.php?id=$cod'>Excluir</a>
				</td>";
			echo "<td align='center'>
					<a href='alterarElgin.php?cod=$cod'>Alterar</a>					
				</td>";
			

        }
        echo"</table>";
		
		
       }

       echo "<p class='registros' align='center'>Registros: $total</p>"; 
       return $total;    
}


function buscarElginCredor($credor){

	//echo $credor;
	
	$elgin = new Elgin();

	$pagam = $elgin->buscarElginCredor($credor);
	
	$total = $pagam->rowCount(PDO::FETCH_ASSOC);
	
        // gera o loop com os resultados
    if($total>0){
    			
		echo "<table id='zebra' class='table'>";
			echo "<tr>";
			echo "<th colspan=5>CADASTRO - ELGIN</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<th>Codigo</th>";
			echo "<th>Fornecedor</th>";
			echo "<th>CÃ³digo Elgin</th>";
			echo "<th colspan=2>Alterar</th>";
			            
            echo "</tr>";
        foreach ($pagam as $linha) 
        {
			$cod = $linha['cod'];
			$cre = primaiuscula($linha['elgin_credor']);
            $num = $linha['elgin_cod'];
			
			//MensagemAlert('Data Baixa = '.$dtBaixa);

            echo "<tr>";
            echo "<col width='10%'>";
           	echo "<col width='35%'>";
           	echo "<col width='18%'>";
           	echo "<col width='15%'>";
           	echo "<col width='7%'>";
           	echo "<col width='10%'>";
 
			echo "<td align='center'>$cod</td>";
			echo "<td align='left'>$cre</td>";
			echo "<td align='center'>$num</td>";
			echo "<td align='center'>
					<a href='excluirElgin.php?id=$cod'>Excluir</a>
				</td>";
			echo "<td align='center'>
					<a href='alterarElgin.php?cod=$cod'>Alterar</a>					
				</td>";
			

        }
        echo"</table>";
		
		
       }

       echo "<p class='registros' align='center'>Registros: $total</p>"; 
       return $total;    
}



function datatoview($dataconv){
	$timestamp = strtotime($dataconv);
	$dtconvertida = date('d/m/Y',$timestamp);
	return $dtconvertida;
	echo $dtconvertida;
	}

function datatobd($data){
	$year = substr($data, -4);
	$month = substr($data,3,-5);
	$day = substr($data,0,2);
	return $year."-".$month."-".$day;
	}

function datadia($data){
	$day = substr($data,0,2);
	return $day;
	}

function datames($data){
	$month = substr($data,3,-5);
	return $month;
	}

function dataano($data){
	$year = substr($data, -4);
	return $year;
	}

function datavalidade($data){
	$year = substr($data,0, 4);
	$month = substr($data,5,-3);
	return $month."/".$year;
	}

function primaiuscula($nome){
	
	$loc = setlocale(LC_CTYPE, 'pt_BR');

		$frase = "$nome";
		$nova_fras = "";

		$palavras = str_word_count($frase, 1);
		$count_palavras = str_word_count($frase);

		for($i=0; $i < $count_palavras; $i++){

				switch ($palavras[$i]) {
					case 'ME':
						$palavra = 'ME';
						break;
					case 'LTDA':
						$palavra = 'LTDA';
						break;
					case 'JC':
						$palavra = 'JC';
						break;
					case 'JL':
						$palavra = 'JL';
						break;
					case 'SM':
						$palavra = 'SM';
						break;
					case 'RMC':
						$palavra = 'RMC';
						break;
					case 'BB':
						$palavra = 'BB';
						break;
					case 'CEF':
						$palavra = 'CEF';
						break;
					case 'SINDSPAM':
						$palavra = 'SINDSPAM';
						break;	
					case 'TRF':
						$palavra = 'TRF';
						break;	
					case 'DOS':
						$palavra = 'dos';
						break;
					default:
						$palavra = (strlen($palavras[$i]) > 2) ? (ucwords(strtolower($palavras[$i]))) : (strtolower($palavras[$i]));
						break;
				}

		        $nova_frase = ($i < $count_palavras) ? $palavra." " : $palavra;

		        $nova_fras = $nova_fras." ".$nova_frase;
		}

	return $nova_fras;	      
}

function primeiroNome($nome){
	
	$loc = setlocale(LC_CTYPE, 'pt_BR');

		$frase = "$nome";

		$palavras = str_word_count($frase, 1);
		

		    $palavra = (ucwords(strtolower($palavras[0])));


	return $palavra;	      
}

function formatar_numero($valor){
	$qtd = number_format($valor,0,'','.');
	return $qtd;
}

function moeda($get_valor) {  
                $source = array('.', ',');  
                $replace = array('', '.');  
                $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto  
                return $valor; //retorna o valor formatado para gravar no banco  
        }  

function criarCombo($sql, $id, $valor){
	
	while($linha=mysql_fetch_array($sql)){
		$chave = $linha[$id];
		$nome = $linha[$valor];
		$combo = $combo."<option value=\"$chave\">$nome</option>";
	}
	echo $combo;
}

?>	