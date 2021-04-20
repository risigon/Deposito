<?php

include_once 'classeConexaoPDO.php';

class Medicamento{

	private $id;
	private $codnovo;
	private $descricao;
	private $unidade;
	private $val1;
	private $val2;
	private $val3;
	private $status;
		
	
	public function __construct (){
			
			$this->setAtributos(null,null, null,null, null, null, null, null);
			
	}
	
	public function setAtributos($id, $codnovo, $descricao, $unidade, $val1, $val2, $val3, $status){

			$this->id = $id;	
			$this->codnovo = $codnovo;
			$this->descricao = $descricao;
			$this->unidade = $unidade;
			$this->val1 = $val1;
			$this->val2 = $val2;
			$this->val3 = $val3;
			$this->status = $status;
	}

	
	public function getId(){
    return $this->id;
	}

	public function getCodnovo(){
    return $this->codnovo;
	}

	public function getDescricao(){
    return $this->descricao;
	}

	public function getUnidade(){
    return $this->unidade;
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

	
	public function salvar(Medicamento $medicamento){
	
	$conn = Conexao::getInstance();
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$id = $medicamento->getId();
	$codnovo = $medicamento->getCodnovo();
	$desc = $medicamento->getDescricao();
	$unid = $medicamento->getUnidade();
	$val1 = $medicamento->getVal1();
	$val2 = $medicamento->getVal2();
	$val3 = $medicamento->getVal3();
	$status = $medicamento->getStatus();

	
	$stmt = $conn->prepare("INSERT INTO medicamento (id, codnovo, descricao, unidade, val1, val2, val3, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bindValue(1,$id);
	$stmt->bindValue(2,$codnovo);
	$stmt->bindParam(3,$desc);
	$stmt->bindParam(4,$unid);
	$stmt->bindParam(5,$val1);
	$stmt->bindParam(6,$val2);
	$stmt->bindParam(7,$val3);
	$stmt->bindParam(8,$status);
			
	
	if($stmt->execute()){
		MensagemAlert ('Inserido com sucesso...');//echo "cadastro efetuado com sucesso";
		}
		else{
		MensagemAlert ('Erro ao Inserir...');//echo "erro ao cadastrar";
		echo die (mysql_error());
		}
	}
	
	public function excluirPgto(Medicamento $medicamento){
	
	$conn = Conexao::getInstance();

	$id = $medicamento->getid();
	
	$consulta = $conn -> prepare("delete from pagar where id=?");
	$consulta->bindValue(1,$id);

	if($consulta->execute()){
		MensagemAlert("Excluido com sucesso...");
	}else
	{
		MensagemAlert("Erro ao Excluir...");
	}

	}

	public function cancelarPgto(Medicamento $medicamento){
	
	$conn = Conexao::getInstance();

	$id = $medicamento->getId();
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
	
	$consulta = $conn -> prepare("SELECT * FROM medicamento where status='A' order by descricao");

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
	
	public function buscarCredor($nome){

	$conn = Conexao::getInstance();
	
	$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, 
	valores, date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where credor LIKE '%$nome%' and cancelar is null order by credor");

	$consulta->execute();
			
	return $consulta;  
	
	}
	
	public function buscarCredorTodos(){

	$conn = Conexao::getInstance();
	
	$consulta = $conn -> prepare("SELECT distinct credor FROM cheques order by credor");

	$consulta->execute();
			
	return $consulta;  
	
	}

	public function buscarValId($id){

	$conn = Conexao::getInstance();

        $conn -> exec("set names utf8");
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, valores, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar,
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where id=?");

	//$consulta = $conn -> prepare("SELECT id, descricao, unidade from medicamento where id=?");

	$consulta = $conn -> prepare("select id_mov, id_med, descricao, data_mov, sum(quant_ent+quant_sai) as quantidade, unidade, validade from medicamento med inner join mov_medicamento mov where med.id = ? and mov.id_med = med.id group by id_mov order by validade asc");
	$consulta->bindValue(1,($id));	

	$consulta->execute();
			
	return $consulta;  
	
	}

	public function buscarId($id){

	$conn = Conexao::getInstance();

        $conn -> exec("set names utf8");
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, valores, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar,
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where id=?");

	$consulta = $conn -> prepare("SELECT * from medicamento where id=?");
	$consulta->bindValue(1,($id));	

	$consulta->execute();
			
	return $consulta;  
	
	}

	public function existe($id){

	$conn = Conexao::getInstance();

        $conn -> exec("set names utf8");
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, valores, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar,
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where id=?");

	$consulta = $conn -> prepare("SELECT id from medicamento where id=?");
	$consulta->bindValue(1,($id));	

	$consulta->execute();

	foreach ($consulta as $row) {
		return $row['id'];  
	}
				
	}

	public function buscarHoje(){
	
	$conn = Conexao::getInstance();

        $conn -> exec("set names utf8");
	
	$consulta = $conn -> prepare("select id_mat, codnovo, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, unidade from medicamento med inner join movimento mov on (med.id=mov.id_mat) group by mov.id_mat");
	
	//$consulta->bindValue(1,($hoje));

	$consulta->execute();
			
	return $consulta;
		
	}

	public function pgtoPeriodo($inicio, $fim){

	try{
		
	$conn = Conexao::getInstance();   

        $conn -> exec("set names utf8"); 
	
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
	
	//Baixar medicamento atualizando a tabela cheques
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

        $conn -> exec("set names utf8");
	
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

public function atualizar(Medicamento $medicamento){
	
	$conn = Conexao::getInstance();

        $conn -> exec("set names utf8");
		
	$id = $medicamento->getId();
	$desc = $medicamento->getDescricao();
	$unid = $medicamento->getUnidade();
	$val1 = $medicamento->getVal1();
	$val2 = $medicamento->getVal2();
	$val3 = $medicamento->getVal3();
	$sta = $medicamento->getStatus();
	

	//MensagemAlert("Id -> ".$id."Desc ->".$desc);
	
	$stmt = $conn->prepare("UPDATE medicamento SET descricao = ?, unidade = ?, val1 = ?, val2 = ?, val3 = ?, status=? WHERE id = ?");						
	$stmt->bindValue(1,$desc);
	$stmt->bindParam(2,$unid);
	$stmt->bindParam(3,$val1);
	$stmt->bindParam(4,$val2);
	$stmt->bindParam(5,$val3);
	$stmt->bindParam(6,$sta);
	$stmt->bindParam(7,$id);

	if($stmt->execute()){
		return 1;
		}
		else{
		return 0;	
		}
	}
}

?>			