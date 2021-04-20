<?php
// Inclui a conexão

include_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){

$tipo = ucfirst($_SESSION['tipo']);     
$funcao = $_SESSION['funcao'];
$var1 = isset($_SESSION['var1'])?$_SESSION['var1']:'';
$var2 = isset($_SESSION['var2'])?$_SESSION['var2']:'';

/*if(empty($var1)){
	$titulo = $_SESSION['titulo'];
}elseif (empty($var2)) {
	$titulo = $_SESSION['titulo'].' - '.$var1;
}else{
	$titulo = $_SESSION['titulo'].' - '.datatoview($var1).' a '.datatoview($var2);
}*/
  
  $titulo = $_SESSION['titulo'].' - '.datatoview($var1);

// Nome do Arquivo do Excel que será gerado
$nomeArq = ' Material '.date('d/m/Y').".xls";
$arquivo = $nomeArq;
$valorTotal = 0;
$hoje = date('d/m/Y');

$tamColunas = count($_SESSION['colunas']);

$colarray = array();
for($i=1;$i<=$tamColunas;$i++){
		$colarray[$i] = $_SESSION['colunas']['col'.$i];
	}

// Criamos uma tabela HTML com o formato da planilha para excel

		$tabela = '<table border="1">';
		$tabela .= '<tr>';
		$tabela .= '<th colspan='.$tamColunas.' bgcolor="gray" align="center"><b>'.strtoupper($titulo).'</b></th>';
		$tabela .= '</tr>';
		$tabela .= '<tr>';
		for($i=1;$i<=$tamColunas;$i++){
			$tabela .= '<th>'.$_SESSION['colunas']['col'.$i].'</th>';
		}
							            
        $tabela .= '</tr>';

// Puxando dados do Banco de dados

$mat = new $tipo();

//echo $tipo, $funcao, $var1, $var2;

if(empty($_SESSION['var1'])){
	$lista = $mat->$funcao();
}elseif(empty($_SESSION['var2'])){
	$lista = $mat->$funcao($var1);
}else{
    $lista = $mat->$funcao($var1, $var2);
}


$total = $lista->rowCount(PDO::FETCH_ASSOC);

foreach ($lista as $linha)
        {

			//$cod = $linha['id_mat'];
			//$desc = strtoupper(utf8_decode($linha['descricao']));
            //$qest = $linha['quant_estoque'];
            //$uni = strtoupper($linha['unidade']);
			
						
            $tabela .= "<tr>";
            $tabela .= "<col width='8%'>";
           	$tabela .= "<col width=''>";
           	$tabela .= "<col width='12%'>";
           	$tabela .= "<col width='15%'>";
           	$tabela .= "<col width='7%'>";
           	$tabela .= "<col width='10%'>";
           	for($i=1;$i<=$tamColunas;$i++){
           		if(isset($_SESSION['validade'])&&$i>5){
           		                if($linha[$colarray[4]]>0){
           				$lin = $linha[$colarray[$i]]<'2010-01-01'?'':datavalidade($linha[$colarray[$i]]);
           				}else{
           				$lin = '';	
           				}
           		}else{
           			
           		$lin = $linha[$colarray[$i]];	
           		}
           		
           		
           		if($i===3){
           		$str = strtoupper($lin);
           		$tabela .= "<td align='left'>$str</td>";	
           		}else{
           			if($i===4){
           				$lin = number_format($linha[$colarray[$i]],0,',','.');
           				
           			}
				$tabela .= "<td align='center'>$lin</td>";
				}
			}
			
			//$tabela .= "<td align='left' width='300'>$desc</td>";
			//$tabela .= "<td align='center'>$qest</td>";
			//$tabela .= "<td align='center'>$uni</td>";
			
            $tabela .= "</tr>";

        }
        $tabela .="</table>";
       
		$tabela .= "<p class='registros' align='center'>Registros: $total</p>";  


$tabela .= "</table>";

//unset($_SESSION['validade']);

// Força o Download do Arquivo Gerado
header ('Cache-Control: no-cache, must-revalidate');
header ('Pragma: no-cache');
header('Content-Type: application/x-msexcel');
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
echo $tabela;

}else{
	echo "Acesso Restrito";
	echo "<meta http-equiv='refresh' content='3; url=../login.php'>";
}

?>