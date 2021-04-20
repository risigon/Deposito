<?php

include_once 'classeConexaoPDO.php';

class Mov_Medicamento{

	private $id_mov;
	private $id_med;
	private $codnovo;
	private $quant_ent;
	private $quant_sai;
	private $validade;
	private $data_mov;
	private $data_real;
	private $obs;
		
	
	public function __construct (){
			
			$this->setAtributos(null, null, null,null,null,null,null,null, null);
			
	}
	
	public function setAtributos($id_mov, $id_med, $codnovo, $quant_ent, $quant_sai, $validade, $data_mov, $data_real, $obs){

			$this->id_mov = $id_mov;	
			$this->id_med = $id_med;
			$this->codnovo = $codnovo;
			$this->quant_ent = $quant_ent;
			$this->quant_sai = $quant_sai;
			$this->validade = $validade;
			$this->data_mov = $data_mov;
			$this->data_real = $data_real;
			$this->obs = $obs;

	}

	
	public function getId_mov(){
    return $this->id_mov;
	}

	public function getId_med(){
    return $this->id_med;
	}

	public function getCodnovo(){
    return $this->codnovo;
	}

	public function getQuat_ent(){
    return $this->quant_ent;
	}

	public function getQuat_sai(){
    return $this->quant_sai;
	}

	public function getValidade(){
    return $this->validade;
	}

	public function getData_mov(){
    return $this->data_mov;
	}

	public function getData_real(){
    return $this->data_real;
	}

	public function getObs(){
    return $this->obs;
	}

	
	public function salvar(Mov_Medicamento $movimento){
	
	$conn = Conexao::getInstance();
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$id = $movimento->getId_mov();
	$id_med = $movimento->getId_med();
	$quant_ent = $movimento->getQuat_ent();
	$quant_sai = $movimento->getQuat_sai();
	$val = $movimento->getValidade();
	$data_mov = $movimento->getData_mov();
	$data_real = $movimento->getData_real();
	$obs = $movimento->getObs();

	$conn->beginTransaction();
	
	$stmt = $conn->prepare("INSERT INTO mov_medicamento (id_mov, id_med, quant_ent, quant_sai, validade, data_mov, data_real, obs) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bindValue(1,("000000"));
	$stmt->bindParam(2,$id_med);
	$stmt->bindParam(3,$quant_ent);
	$stmt->bindParam(4,$quant_sai);
	$stmt->bindParam(5,$val);
	$stmt->bindParam(6,$data_mov);
	$stmt->bindParam(7,$data_real);
	$stmt->bindParam(8,$obs);
			
	
	if($stmt->execute()){
		//MensagemAlert ('Inserido com sucesso...');//echo "cadastro efetuado com sucesso";
		//echo "<meta http-equiv='refresh' content='1;URL='index.php''/>";
		}
		else{
		$conn->rollBack();
		MensagemAlert ('Erro ao Inserir...');//echo "erro ao cadastrar";
		echo die (mysql_error());
		}
	$conn->commit();

	$conn = null;

	}

	public function consPeriodo($inicio, $fim){

		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

	$sql = "SELECT id_med, descricao, sum(mov.quant_sai) as quant_consumo, unidade from mov_medicamento mov, medicamento med WHERE med.id=mov.id_med and mov.data_real between ? and ? group by mov.id_med having sum(mov.quant_sai)>0 order by descricao";
	//isset(session_start())?'':session_start();
	$_SESSION['titulo'] = 'Consumo';
	$_SESSION['tipo'] = 'Mov_Medicamento';
	$_SESSION['funcao'] = 'consPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;

        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_med';
	$_SESSION['colunas']['col2'] = 'descricao';
	$_SESSION['colunas']['col3'] = 'quant_consumo';
	$_SESSION['colunas']['col4'] = 'unidade';
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

	$consulta = $conn -> prepare($sql);
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
			
	
		return $consulta;
	}

	public function entPeriodo($inicio, $fim){

		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

	$sql = "SELECT id_med, descricao, sum(mov.quant_ent) as quant_entrada, unidade from mov_medicamento mov, medicamento med WHERE med.id=mov.id_med and mov.data_real between ? and ? group by mov.id_med having sum(mov.quant_ent)>0 order by descricao";
	//isset(session_start())?'':session_start();
	$_SESSION['titulo'] = 'Entrada';
	$_SESSION['tipo'] = 'Mov_Medicamento';
	$_SESSION['funcao'] = 'entPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;

        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_med';
	$_SESSION['colunas']['col2'] = 'descricao';
	$_SESSION['colunas']['col3'] = 'quant_entrada';
	$_SESSION['colunas']['col4'] = 'unidade';
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

	$consulta = $conn -> prepare($sql);
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
			
	
		return $consulta;
	}

	public function valPeriodo($inicio, $fim){
		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

        $sql = "SELECT * from medicamento WHERE val1 between ? and ? and status = ? order by val1";
	//isset(session_start())?'':session_start();
	$_SESSION['titulo'] = 'Validades';
	$_SESSION['tipo'] = 'Mov_Medicamento';
	$_SESSION['funcao'] = 'valPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;

        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id';
	$_SESSION['colunas']['col2'] = 'descricao';
	$_SESSION['colunas']['col3'] = 'val1';
	$_SESSION['colunas']['col4'] = 'val2';
	$_SESSION['colunas']['col5'] = 'val3';
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

	$consulta = $conn -> prepare($sql);
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);
        $consulta->bindValue(3,'A');

	$consulta->execute();
		
	return $consulta;

	}

    public function entradasPeriodo($inicio, $fim){

		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

	$sql = "SELECT id_med, id_mov, descricao, quant_ent, unidade, validade, obs, date_format(data_real,'%d/%m/%Y') as data_real from mov_medicamento mov, medicamento med WHERE med.id=mov.id_med and mov.data_real between ? and ? having mov.quant_ent>0 order by descricao";
	//isset(session_start())?'':session_start();
	$_SESSION['titulo'] = 'Entradas';
	$_SESSION['tipo'] = 'Mov_Medicamento';
	$_SESSION['funcao'] = 'entradasPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;
        $_SESSION['pg'] = 'listar_entradas.php';
        
        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_med';
	$_SESSION['colunas']['col2'] = 'descricao';
	$_SESSION['colunas']['col3'] = 'quant_ent';
	$_SESSION['colunas']['col4'] = 'unidade';
	$_SESSION['colunas']['col5'] = 'validade';
	$_SESSION['colunas']['col6'] = 'obs';
	$_SESSION['colunas']['col7'] = 'data_real';

	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

	$consulta = $conn -> prepare($sql);
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
			
	
		return $consulta;
	}

	public function movsaidasPeriodo($inicio, $fim){

		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

	$sql = "SELECT id_med, id_mov, descricao, quant_sai, unidade, validade, obs, date_format(data_real,'%d/%m/%Y') as data_real from mov_medicamento mov, medicamento med WHERE med.id=mov.id_med and mov.data_real between ? and ? having mov.quant_sai>0 order by descricao";
	//isset(session_start())?'':session_start();
	$_SESSION['titulo'] = 'Saidas';
	$_SESSION['tipo'] = 'Mov_Medicamento';
	$_SESSION['funcao'] = 'movsaidasPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;
	$_SESSION['pg'] = 'listar_saidas.php';
        
        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_med';
	$_SESSION['colunas']['col2'] = 'descricao';
	$_SESSION['colunas']['col3'] = 'quant_sai';
	$_SESSION['colunas']['col4'] = 'unidade';
	$_SESSION['colunas']['col5'] = 'validade';
	$_SESSION['colunas']['col6'] = 'obs';
	$_SESSION['colunas']['col7'] = 'data_real';

	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

	$consulta = $conn -> prepare($sql);
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
			
	
		return $consulta;
	}
	
	public function movPeriodo($inicio, $fim){

		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

	$sql = "SELECT id_med, id_mov, descricao, quant_ent, quant_sai, unidade, validade, obs, date_format(data_real,'%d/%m/%Y') as data_real from mov_medicamento mov, medicamento med WHERE med.id=mov.id_med and mov.data_real between ? and ? order by descricao";
	//isset(session_start())?'':session_start();
	$_SESSION['titulo'] = 'Movimento';
	$_SESSION['tipo'] = 'Mov_Medicamento';
	$_SESSION['funcao'] = 'movPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;
	$_SESSION['pg'] = 'movimento.php';

        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_med';
	$_SESSION['colunas']['col2'] = 'descricao';
	$_SESSION['colunas']['col3'] = 'quant_ent';
	$_SESSION['colunas']['col4'] = 'quant_sai';
	$_SESSION['colunas']['col5'] = 'unidade';
	$_SESSION['colunas']['col6'] = 'validade';
	$_SESSION['colunas']['col7'] = 'obs';
	$_SESSION['colunas']['col8'] = 'data_real';

	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

	$consulta = $conn -> prepare($sql);
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
			
	
		return $consulta;
	}
	
	public function excluirMov(Mov_Medicamento $movimento){
		
	$conn = Conexao::getInstance();

	$id = $movimento->getId_mov();

	//MensagemAlert($id);
	
	$consulta = $conn -> prepare("delete from mov_medicamento where id_mov=?");
	$consulta->bindValue(1,$id);

	$consulta->execute();
		
	}

	public function cancelarPgto(Movimento $movimento){
	
	$conn = Conexao::getInstance();

	$id = $movimento->getId();
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
	
	$consulta = $conn -> prepare("select id_med, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, val1 as validade, unidade from medicamento med inner join mov_medicamento mov on (med.id=mov.id_med) group by med.id order by descricao");

	$consulta->execute();
			
	return $consulta;
		
	}

	public function buscarEstoqueNome($nome){

	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");
	
	$consulta = $conn -> prepare("SELECT id_med, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, unidade from medicamento med, mov_medicamento mov where med.id=mov.id_med and descricao like ? group by id_med");
	$consulta->bindValue(1,("%$nome%"));	

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

	public function buscarId($id){

	$conn = Conexao::getInstance();
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, valores, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar,
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where id=?");

	$consulta = $conn -> prepare("SELECT id_mov, id_med, quant_ent, quant_sai, validade, data_mov, data_real, obs from mov_medicamento where id_mov=?");
	$consulta->bindValue(1,($id));	

	$consulta->execute();
			
	return $consulta;  
	
	}

	public function buscarEstoqueId($idmed){

	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, valores, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar,
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where id=?");

	$consulta = $conn -> prepare("SELECT id_med, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, val1 as validade, unidade from medicamento med, mov_medicamento mov where med.id=mov.id_med and id_med=?");
	$consulta->bindValue(1,($idmed));	

	$consulta->execute();
			
	return $consulta;  
	
	}

        
        public function buscarEntradasId($idmed){

	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, valores, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar,
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where id=?");

	$consulta = $conn -> prepare("SELECT id_med, id_mov, descricao, mov.quant_ent as quant_ent, mov.data_real as data_real, validade, unidade from medicamento med, mov_medicamento mov where med.id=mov.id_med and id_med=? having quant_ent>0 or quant_ent<0 order by data_mov");
	$consulta->bindValue(1,($idmed));	

	$consulta->execute();
			
	return $consulta;  
	
	}

	public function buscarSaidasId($idmed){

	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

		
	//$consulta = $conn -> prepare("SELECT id, credor, numero, valores, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar,
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where id=?");

	$consulta = $conn -> prepare("SELECT id_med, id_mov, descricao, mov.quant_sai as quant_sai, mov.data_real as data_real, validade, unidade from medicamento med, mov_medicamento mov where med.id=mov.id_med and id_med=? having quant_sai>0 or quant_sai<0 order by data_mov");
	$consulta->bindValue(1,($idmed));	

	$consulta->execute();
			
	return $consulta;  
	
	}

	public function buscarHoje(){
	
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

	$_SESSION['titulo'] = 'Estoque Atual';
	$_SESSION['tipo'] = 'Mov_Medicamento';
	$_SESSION['funcao'] = 'buscarHoje';
	$_SESSION['validade'] = 'converter';

	unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_med';
	$_SESSION['colunas']['col2'] = 'codnovo';
	$_SESSION['colunas']['col3'] = 'descricao';
	$_SESSION['colunas']['col4'] = 'quant_estoque';
	$_SESSION['colunas']['col5'] = 'unidade';
	$_SESSION['colunas']['col6'] = 'val1';
	$_SESSION['colunas']['col7'] = 'val2';
	$_SESSION['colunas']['col8'] = 'val3';
	
	$consulta = $conn -> prepare("select id_med, codnovo, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, val1, val2, val3, unidade from medicamento med inner join mov_medicamento mov on (med.id=mov.id_med) where med.status='A' group by med.id order by descricao");
	
	//$consulta->bindValue(1,($hoje));

	$consulta->execute();
			
	return $consulta;
		
	}

	public function buscarPag($inicio, $registros){
	
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");
	
	$consulta = $conn -> prepare("select id_med, codnovo, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, val1, val2, val3, unidade from medicamento med inner join mov_medicamento mov on (med.id=mov.id_med) where med.status='A' group by med.id order by descricao limit $inicio, $registros");
	
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
	
	//Baixar movimento atualizando a tabela cheques
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

public function atualizar(Mov_Medicamento $movimento){
	
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");
		
	$id = $movimento->getId_mov();
	$id_med = $movimento->getId_med();
	$val = $movimento->getValidade();
	$obs = $movimento->getObs();
	$qtd_ent = $movimento->getQuat_ent();
	$qtd_sai = $movimento->getQuat_sai();
	$dt_real = $movimento->getData_real();
	
	

	//MensagemAlert("Id -> ".$id."Validade ->".$val);
	
	$stmt = $conn->prepare("UPDATE mov_medicamento SET id_med = ?, validade = ?, obs = ?, quant_ent = ?, quant_sai = ?, data_real = ? WHERE id_mov = ?");						
	$stmt->bindValue(1,$id_med);
	$stmt->bindValue(2,$val);
	$stmt->bindParam(3,$obs);
	$stmt->bindParam(4,$qtd_ent);
	$stmt->bindParam(5,$qtd_sai);
	$stmt->bindParam(6,$dt_real);
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