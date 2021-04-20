<?php
// Inclui a conexão

include_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){


// Nome do Arquivo do Excel que será gerado
$nomeArq = "Medicamentos ".date('d/m/Y').".xls";
$arquivo = $nomeArq;
$valorTotal = 0;

// Criamos uma tabela HTML com o formato da planilha para excel

		$tabela = '<table border="1">';
		$tabela .= '<tr>';
		$tabela .= '<th colspan="5" align="center">MEDICAMENTOS - ESTOQUE</th>';
		$tabela .= '</tr>';
		$tabela .= '<tr>';
		$tabela .= '<th align="center">Codigo</th>';
		$tabela .= '<th>Descricao</th>';
		$tabela .= '<th>QTDE</th>';
		$tabela .= '<th>UNID</th>';
		$tabela .= '<th>VAL</th>';
					            
        $tabela .= '</tr>';

// Puxando dados do Banco de dados
$mov = new Mov_Medicamento();

$lista = $mov->buscarHoje();

$total = $lista->rowCount(PDO::FETCH_ASSOC);

foreach ($lista as $linha)
        {
			$cod = $linha['id_med'];
			$desc = strtoupper(utf8_decode($linha['descricao']));
            $qest = $linha['quant_estoque'];
            $uni = strtoupper($linha['unidade']);
			if($qest==0){
				$val = "";
			}else{
			$val = datavalidade($linha['val1']);
			}
						
            $tabela .= "<tr>";
            $tabela .= "<col width='8%'>";
           	$tabela .= "<col width='40%'>";
           	$tabela .= "<col width='12%'>";
           	$tabela .= "<col width='15%'>";
           	$tabela .= "<col width='7%'>";
			$tabela .= "<td align='center'>$cod</td>";
			$tabela .= "<td align='left' width='300'>$desc</td>";
			$tabela .= "<td align='center'>$qest</td>";
			$tabela .= "<td align='center'>$uni</td>";
			$tabela .= "<td align='center'>$val</td>";
			
            $tabela .= "</tr>";

        }
        $tabela .="</table>";
        $valorTotal = number_format($valorTotal,2,',','.');
		$tabela .= "<p class='registros' align='left'>Registros: $total</p>";  


$tabela .= "</table>";

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