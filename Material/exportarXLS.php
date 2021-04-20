<?php
// Inclui a conexão

include_once 'funcoes.php';

$usuario = sessao();

if(isset($_SESSION['usuario'])){


// Nome do Arquivo do Excel que será gerado
$nomeArq = "Materiais ".date('d/m/Y').".xls";
$arquivo = $nomeArq;
$valorTotal = 0;
$hoje = date('d/m/Y');

// Criamos uma tabela HTML com o formato da planilha para excel

		$tabela = '<table border="1">';
		$tabela .= '<tr>';
		$tabela .= '<th colspan="4" align="center">MATERIAIS - ESTOQUE</th>';
		$tabela .= '</tr>';
		$tabela .= '<tr>';
		$tabela .= '<th align="center">Codigo</th>';
		$tabela .= '<th>Descricao</th>';
		$tabela .= '<th>QTD</th>';
		$tabela .= '<th>UNID</th>';
							            
        $tabela .= '</tr>';

// Puxando dados do Banco de dados
$mat = new Material();

$lista = $mat->buscarHoje($hoje);

$total = $lista->rowCount(PDO::FETCH_ASSOC);

foreach ($lista as $linha)
        {
			$cod = $linha['id_mat'];
			$desc = strtoupper(utf8_decode($linha['descricao']));
            $qest = formatar_numero($linha['quant_estoque']);
            $uni = strtoupper($linha['unidade']);
			
						
            $tabela .= "<tr>";
            $tabela .= "<col width='8%'>";
           	$tabela .= "<col width=''>";
           	$tabela .= "<col width='12%'>";
           	$tabela .= "<col width='15%'>";
           	$tabela .= "<col width='7%'>";
           	$tabela .= "<col width='10%'>";
			$tabela .= "<td align='center'>$cod</td>";
			$tabela .= "<td align='left' width='300'>$desc</td>";
			$tabela .= "<td align='center'>$qest</td>";
			$tabela .= "<td align='center'>$uni</td>";
			
            $tabela .= "</tr>";

        }
        $tabela .="</table>";
       
		$tabela .= "<p class='registros' align='center'>Registros: $total</p>";  


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