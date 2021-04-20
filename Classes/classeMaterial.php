<?php

include_once 'classeConexaoPDO.php';

class Material{

	private $id;
	private $descricao;
	private $unidade;
	private $codigo;
	private $val1;
	private $val2;
	private $val3;
	private $status;	
	
	public function __construct (){
			
			$this->setAtributos(null, null,null, null, null, null, null, null);
			
	}
	
	public function setAtributos($id, $descricao, $unidade, $codigo, $val1, $val2, $val3, $status){

			$this->id = $id;	
			$this->descricao = $descricao;
			$this->unidade = $unidade;
			$this->codigo = $codigo;
			$this->val1 = $val1;
			$this->val2 = $val2;
			$this->val3 = $val3;
			$this->status = $status;
	}

	
	public function getId(){
    return $this->id;
	}

	public function getDescricao(){
    return $this->descricao;
	}

	public function getUnidade(){
    return $this->unidade;
	}
	public function getCodigo(){
    return $this->codigo;
	}

	public function getVal1(){
    return $this->val1;
	}

	public function getVal2(){
    return $this->val2;
	}

	public function getVal3(){
    return $this->val3;
	}

	public function getStatus(){
    return $this->status;
	}

	
	public function salvar(Material $material){
	
	$conn = Conexao::getInstance();
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$id = $material->getId();
	$desc = $material->getDescricao();
	$unid = $material->getUnidade();
	$cod = $material->getCodigo();
	$status = $material->getStatus();


	
	$stmt = $conn->prepare("INSERT INTO material (id, descricao, unidade, codigo, status) VALUES(?, ?, ?, ?, ?)");
	$stmt->bindValue(1,("000000"));
	$stmt->bindParam(2,$desc);
	$stmt->bindParam(3,$unid);
	$stmt->bindParam(4,$cod);
	$stmt->bindParam(5,$status);
			
	
	if($stmt->execute()){
		MensagemAlert ('Inserido com sucesso...');//echo "cadastro efetuado com sucesso";
		echo "<meta http-equiv='refresh' content='1;URL='index.php''/>";
		}
		else{
		MensagemAlert ('Erro ao Inserir...');//echo "erro ao cadastrar";
		echo die (mysql_error());
		}
	}
	
	public function excluirPgto(Material $material){
	
	$conn = Conexao::getInstance();

	$id = $material->getid();
	
	$consulta = $conn -> prepare("delete from pagar where id=?");
	$consulta->bindValue(1,$id);

	if($consulta->execute()){
		MensagemAlert("Excluido com sucesso...");
	}else
	{
		MensagemAlert("Erro ao Excluir...");
	}

	}

	public function cancelarPgto(Material $material){
	
	$conn = Conexao::getInstance();

	$id = $material->getId();
	$canc = "SIM";

		
	$consulta = $conn -> prepare("update cheques set cancelar = :canc where id= :id");
	$consulta->bindValue(":canc",$canc);
	$consulta->bindValue(":id",$id);

	if($consulta->execute()){
		MensagemAlert("Cancelado com sucesso...");
	}else
	{
		MensagemAlert("Erro ao Cancelar...");
	}
			
		
	}
		
	public function buscar(){
	
	$conn = Conexao::getInstance();

    $conn -> exec("set names utf8");

    $_SESSION['tipo'] = 'Material';
	$_SESSION['funcao'] = 'buscar';
	
	$consulta = $conn -> prepare("select * from material order by descricao");

	//$consulta = $conn -> prepare("select id_mat, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, unidade from material mat inner join movimento mov on (mat.id=mov.id_mat) group by mov.id_mat order by descricao");

	$consulta->execute();
			
	return $consulta;
		
	}

	public function valPeriodo($inicio, $fim){
		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

	$sql = "SELECT * from material WHERE val1 between ? and ? order by descricao";
	//isset(session_start())?'':session_start();
	$_SESSION['titulo'] = 'Validades';
	$_SESSION['tipo'] = 'Material';
	$_SESSION['funcao'] = 'valPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;

        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'codigo';
	$_SESSION['colunas']['col2'] = 'descricao';
	$_SESSION['colunas']['col3'] = 'val1';
	$_SESSION['colunas']['col4'] = 'val2';
	$_SESSION['colunas']['col5'] = 'val3';
		
	$consulta = $conn -> prepare($sql);
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
		
	return $consulta;

	}


	public function buscarvalores($valores){

	$fixo = 50;

	$val1 = $valores - $fixo;
	$val2 = $valores + $fixo;
	
	$conn = Conexao::getInstance();
	
	$consulta = $conn -> prepare("SELECT id, credor, numero, valores, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, 
	cancelar FROM pagar where valores between '$val1' and '$val2'");

	$consulta->execute();
			
	return $consulta;  
	
	}

	public function buscarNumero($numero){

	$conn = Conexao::getInstance();
	
	$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, 
	valores, baixa FROM cheques where numero = '$numero'");

	$consulta->execute();
			
	return $consulta;  
	
	}
	
	public function VerificarNumero($numero, $op){

	$conn = Conexao::getInstance();
	
	$consulta = $conn -> prepare("SELECT numero, op FROM cheques where numero = '$numero' or op = $op");

	$consulta->execute();
			
	$count = $consulta->rowCount();
	
	//MensagemAlert($count);
	
	return $count;
	
	
	}
	
	public function existe($codigo){

	$conn = Conexao::getInstance();

        $conn -> exec("set names utf8");
	
	$consulta = $conn -> prepare("SELECT codigo from material where codigo=?");
	$consulta->bindValue(1,($codigo));

	$consulta->execute();	

	foreach ($consulta as $row){
		return $row['codigo'];
	}
	
	}
	
	public function buscarCredorTodos(){

	$conn = Conexao::getInstance();
	
	$consulta = $conn -> prepare("SELECT distinct credor FROM cheques order by credor");

	if($consulta->execute()){
		return $consulta;
	}else{
		return 0;
	}
			
	
	
	}

	public function buscarId($id){

	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, valores, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar,
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where id=?");

	$consulta = $conn -> prepare("SELECT * from material where id=?");
	$consulta->bindValue(1,($id));	

	$consulta->execute();
			
	return $consulta;  
	
	}

	public function buscarHoje($hoje){
	
	$conn = Conexao::getInstance();

    $conn -> exec("set names utf8");

    $_SESSION['titulo'] = 'Estoque Atual';
	$_SESSION['tipo'] = 'Material';
	$_SESSION['funcao'] = 'buscarHoje';
	$_SESSION['var1'] = $hoje;
	$_SESSION['validade'] = 'converter';

	unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_mat';
    $_SESSION['colunas']['col2'] = 'codigo';
	$_SESSION['colunas']['col3'] = 'descricao';
	$_SESSION['colunas']['col4'] = 'quant_estoque';
	$_SESSION['colunas']['col5'] = 'unidade';
	$_SESSION['colunas']['col6'] = 'val1';
	$_SESSION['colunas']['col7'] = 'val2';
	$_SESSION['colunas']['col8'] = 'val3';
	
	$consulta = $conn -> prepare("select id_mat, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, unidade, codigo, val1, val2, val3, status from material mat inner join movimento mov on (mat.id=mov.id_mat and mat.status='A') group by mov.id_mat order by descricao");
	
	//$consulta->bindValue(1,($hoje));

	$consulta->execute();
			
	return $consulta;
		
	}

	public function buscarPag($inicio, $registros){
	
	$conn = Conexao::getInstance();

    $conn -> exec("set names utf8");


	$consulta = $conn -> prepare("select id_mat, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, unidade, codigo, val1, val2, val3, status from material mat inner join movimento mov on (mat.id=mov.id_mat and mat.status='A') group by mov.id_mat order by descricao limit $inicio, $registros");
	
	//$consulta->bindValue(1,($hoje));

	$consulta->execute();
			
	return $consulta;
		
	}


	public function pgtoPeriodo($inicio, $fim){

	try{
		
	$conn = Conexao::getInstance();
	
	$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
			
	}catch(PDOException $e){
		throw new pdoDbException($e);
	}
		return $consulta;
	}
	
	//Baixar material atualizando a tabela cheques
	public function baixarPgto($cod, $hoje){

	$conn = Conexao::getInstance();
	
	$consulta = $conn -> prepare("UPDATE cheques SET baixa = ? WHERE id = ?");
	$consulta->bindValue(1,$hoje);
	$consulta->bindValue(2,$cod);
	
	if(!$consulta->execute()){			
		MensagemAlert("Erro ao Baixar");	
	}
	}

	//Fazer as baixas usando a tabela "baixa"
	/*
	public function baixarPgto($cod, $hoje){

	$conn = Conexao::getInstance();
	
	$consulta = $conn -> prepare("INSERT into baixa (cod, cod_credor, data_baixa) values (?,?,?)");
	$consulta->bindValue(1,"000000");
	$consulta->bindValue(2,$cod);
	$consulta->bindValue(3,$hoje);
	
	if(!$consulta->execute()){			
		MensagemAlert("Erro ao Baixar");	
	}
	}
	*/

	public function buscarPgtoBaixa($sit){

		$conn = Conexao::getInstance();
		
		if($sit=="aberto"){
			$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
			date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where baixa IS NULL and cancelar IS NULL order by id asc");
		}else if($sit=="efetuado"){
			$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
			baixa FROM cheques where baixa IS NOT NULL and cancelar IS NULL order by baixa desc, id asc");
		}
				
		if(!$consulta->execute()){			
			MensagemAlert("Erro..");	
		}
		
		return $consulta;
	}

public function atualizar(Material $material){
	
	$conn = Conexao::getInstance();

        $conn -> exec("set names utf8");
		
	$id = $material->getId();
	$desc = $material->getDescricao();
	$unid = $material->getUnidade();
	$cod = $material->getCodigo();
	$val1 = $material->getVal1();
	$val2 = $material->getVal2();
	$val3 = $material->getVal3();
	$status = $material->getStatus();
	

	//MensagemAlert("Classe Material Id -> ".$id."codigo ->".$cod."descricao".$desc);
	//MensagemAlert("Classe Material Val1 -> ".$val1);
	
	$stmt = $conn->prepare("UPDATE material SET descricao = ?, unidade = ?, codigo = ?, val1 = ?, val2 = ?, val3 = ?, status = ? WHERE id = ?");
	$stmt->bindValue(1,$desc);
	$stmt->bindParam(2,$unid);
	$stmt->bindParam(3,$cod);
	$stmt->bindParam(4,$val1);
	$stmt->bindParam(5,$val2);
	$stmt->bindParam(6,$val3);
	$stmt->bindParam(7,$status);
	$stmt->bindParam(8,$id);

	if($stmt->execute()){
		return 1;
		}
		else{
		return 0;	
		}
	}
}

?>