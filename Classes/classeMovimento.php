<?php

include_once 'classeConexaoPDO.php';

class Movimento{

	private $id_mov;
	private $id_mat;
	private $quant_ent;
	private $quant_sai;
	private $validade;
	private $data_mov;
	private $data_real;
	private $obs;	
	
	public function __construct (){
			
			$this->setAtributos(null, null,null,null,null,null,null, null);
			
	}
	
	public function setAtributos($id_mov, $id_mat,$quant_ent, $quant_sai, $validade, $data_mov, $data_real, $obs){

			$this->id_mov = $id_mov;	
			$this->id_mat = $id_mat;
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

	public function getId_mat(){
    return $this->id_mat;
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
	
	public function salvar(Movimento $movimento){
	
	$conn = Conexao::getInstance();
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$id_mov = $movimento->getId_mov();
	$id_mat = $movimento->getId_mat();
	$quant_ent = $movimento->getQuat_ent();
	$quant_sai = $movimento->getQuat_sai();
	$val = $movimento->getValidade();
	$data_mov = $movimento->getData_mov();
	$data_real = $movimento->getData_real();
	$obs = $movimento->getObs();

	
	$stmt = $conn->prepare("INSERT INTO movimento (id_mov, id_mat, quant_ent, quant_sai, validade, data_mov, data_real, obs) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bindValue(1,("000000"));
	$stmt->bindParam(2,$id_mat);
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
		MensagemAlert ('Erro ao Inserir...');//echo "erro ao cadastrar";
		echo die (mysql_error());
		}

	$conn = null;	

	}

	public function saveAll($mov){
	
	$movimento = new Movimento();

	foreach ($mov as $movimento) {
	
	$conn = Conexao::getInstance();
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$id_mov = $movimento->getId_mov();
	$id_mat = $movimento->getId_mat();
	$quant_ent = $movimento->getQuat_ent();
	$quant_sai = $movimento->getQuat_sai();
	$val = $movimento->getValidade();
	$data_mov = $movimento->getData_mov();
	$data_real = $movimento->getData_real();

	
	$stmt = $conn->prepare("INSERT INTO movimento (id_mov, id_mat, quant_ent, quant_sai, validade, data_mov, data_real) VALUES(?, ?, ?, ?, ?, ?, ?)");
	$stmt->bindValue(1,("000000"));
	$stmt->bindParam(2,$id_mat);
	$stmt->bindParam(3,$quant_ent);
	$stmt->bindParam(4,$quant_sai);
	$stmt->bindParam(5,$val);
	$stmt->bindParam(6,$data_mov);
	$stmt->bindParam(7,$data_real);
			
	
	if($stmt->execute()){
		//MensagemAlert ('Inserido com sucesso...');//echo "cadastro efetuado com sucesso";
		//echo "<meta http-equiv='refresh' content='1;URL='index.php''/>";
		}
		else{
		MensagemAlert ('Erro ao Inserir...');//echo "erro ao cadastrar";
		echo die (mysql_error());
		}
	}

	}
	
	public function excluirMov(Movimento $movimento){
		
	$conn = Conexao::getInstance();

	$id = $movimento->getId_mov();

	//MensagemAlert($id);
	
	$consulta = $conn -> prepare("delete from movimento where id_mov=?");
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
	
	$consulta = $conn -> prepare("SELECT * FROM cheques order by id");

	$consulta->execute();
			
	return $consulta;
		
	}

	public function buscarEstoqueId($idmat){

	$conn = Conexao::getInstance();
	
    $conn -> exec("set names utf8");

    $_SESSION['tipo'] = 'Movimento';
	$_SESSION['funcao'] = 'buscarEstoqueId';
	$_SESSION['var1'] = $idmat;
		
	$consulta = $conn -> prepare("SELECT id_mat, codigo, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, unidade, val1 from material mat, movimento mov where mat.id=mov.id_mat and id_mat=?");
	$consulta->bindValue(1,($idmat));	

	$consulta->execute();
			
	return $consulta;  
	
	}

	public function buscarEstoqueNome($nome){

	$conn = Conexao::getInstance();
	
    $conn -> exec("set names utf8");

    $_SESSION['tipo'] = 'Movimento';
	$_SESSION['funcao'] = 'buscarEstoqueNome';
	$_SESSION['var1'] = $nome;
		
	unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_mat';
	$_SESSION['colunas']['col2'] = 'codigo';
	$_SESSION['colunas']['col3'] = 'descricao';
	$_SESSION['colunas']['col4'] = 'quant_estoque';
	$_SESSION['colunas']['col5'] = 'unidade';
	
	
	$consulta = $conn -> prepare("SELECT id_mat, codigo, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, unidade from material mat, movimento mov where mat.id=mov.id_mat and descricao like ? group by id_mat");
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

    $conn -> exec("set names utf8");

    $_SESSION['tipo'] = 'Movimento';
	$_SESSION['funcao'] = 'buscarId';
	$_SESSION['var1'] = $id;
	
	//$consulta = $conn -> prepare("SELECT id, credor, numero, valores, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar,
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where id=?");

	$consulta = $conn -> prepare("SELECT id_mov, id_mat, quant_ent, quant_sai, data_mov, validade, data_real, obs from movimento where id_mov=?");
	$consulta->bindValue(1,($id));	

	$consulta->execute();
			
	return $consulta;  
	
	}

    public function buscarEntradasId($idmat){

	$conn = Conexao::getInstance();
	
    $conn -> exec("set names utf8");

    $_SESSION['titulo'] = 'Entradas Id';
	$_SESSION['tipo'] = 'Movimento';
	$_SESSION['funcao'] = 'buscarEntradasId';
	$_SESSION['var1'] = $idmat;
        $_SESSION['idmat'] = $idmat;
	$_SESSION['pg'] = 'estoque_id.php?id='.base64_encode($idmat).'&mov='.base64_encode($idmat);

    unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_mov';
	$_SESSION['colunas']['col2'] = 'id_mat';
	$_SESSION['colunas']['col3'] = 'descricao';
	$_SESSION['colunas']['col4'] = 'quant_ent';
	$_SESSION['colunas']['col5'] = 'dt_ent';
	$_SESSION['colunas']['col6'] = 'unidade';
	
	$consulta = $conn -> prepare("SELECT id_mat, id_mov, descricao, mov.quant_ent as quant_ent, mov.data_real as dt_ent, unidade from material mat, movimento mov where mat.id=mov.id_mat and id_mat=? having mov.quant_ent > 0 or mov.quant_ent < 0 order by mov.data_real");
	$consulta->bindValue(1,($idmat));	

	$consulta->execute();
			
	return $consulta;  
	
	}

    public function buscarSaidasId($idmat){

	$conn = Conexao::getInstance();
	
    $conn -> exec("set names utf8");

    $_SESSION['titulo'] = 'Saidas Id';
	$_SESSION['tipo'] = 'Movimento';
	$_SESSION['funcao'] = 'buscarSaidasId';
	$_SESSION['var1'] = $idmat;
        $_SESSION['idmat'] = $idmat;
	$_SESSION['pg'] = 'estoque_id.php?id='.base64_encode($idmat).'&mov='.base64_encode($idmat);

        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_mov';
	$_SESSION['colunas']['col2'] = 'id_mat';
	$_SESSION['colunas']['col3'] = 'descricao';
	$_SESSION['colunas']['col4'] = 'quant_sai';
	$_SESSION['colunas']['col5'] = 'dt_sai';
	$_SESSION['colunas']['col6'] = 'unidade';
	
	$consulta = $conn -> prepare("SELECT id_mat, id_mov, descricao, mov.quant_sai as quant_sai, mov.data_real as dt_sai, unidade, data_real from material mat, movimento mov where mat.id=mov.id_mat and id_mat=? having mov.quant_sai > 0 or mov.quant_sai < 0 order by mov.data_real");
	$consulta->bindValue(1,($idmat));	

	$consulta->execute();
			
	return $consulta;  
	
	}

	public function buscarHoje($hoje){
	
	$conn = Conexao::getInstance();

    $conn -> exec("set names utf8");
	
	$consulta = $conn -> prepare("select id_mat, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, unidade from movimento mat inner join movimento mov on (mat.id=mov.id_mat)");
	
	//$consulta->bindValue(1,($hoje));

	$consulta->execute();
			
	return $consulta;
		
	}

    public function entradasPeriodo($inicio, $fim){
		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

	$_SESSION['titulo'] = 'Entradas';
	$_SESSION['tipo'] = 'Movimento';
	$_SESSION['funcao'] = 'entradasPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;
        $_SESSION['pg'] = 'listar_entradas.php';

        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_mov';
	$_SESSION['colunas']['col2'] = 'codigo';
	$_SESSION['colunas']['col3'] = 'descricao';
	$_SESSION['colunas']['col4'] = 'quant_ent';
	$_SESSION['colunas']['col5'] = 'unidade';
	$_SESSION['colunas']['col6'] = 'validade';
	$_SESSION['colunas']['col7'] = 'data_real';
	

	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

	$consulta = $conn -> prepare("select id_mov, codigo, descricao, quant_ent, unidade, validade, obs, date_format(data_real,'%d/%m/%Y') as data_real from movimento mov, material mat WHERE mat.id=mov.id_mat and mov.data_real between ? and ? having mov.quant_ent>0 order by descricao");
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
			
	
		return $consulta;
	}


        public function movsaidasPeriodo($inicio, $fim){
		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

	$_SESSION['titulo'] = 'Saidas';
	$_SESSION['tipo'] = 'Movimento';
	$_SESSION['funcao'] = 'movsaidasPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;
	$_SESSION['pg'] = 'listar_saidas.php';

    unset($_SESSION['colunas']);

	
	$_SESSION['colunas']['col1'] = 'id_mov';
	$_SESSION['colunas']['col2'] = 'codigo';
	$_SESSION['colunas']['col3'] = 'descricao';
	$_SESSION['colunas']['col4'] = 'quant_sai';
	$_SESSION['colunas']['col5'] = 'unidade';
	$_SESSION['colunas']['col6'] = 'validade';
    $_SESSION['colunas']['col7'] = 'obs';
    $_SESSION['colunas']['col8'] = 'data_real';

	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

        $consulta = $conn -> prepare("select id_mov, codigo, descricao, quant_sai, unidade, validade, obs, date_format(data_real,'%d/%m/%Y') as data_real from movimento mov, material mat WHERE mat.id=mov.id_mat and mov.data_real between ? and ? having mov.quant_sai>0 order by descricao");
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
			
	
		return $consulta;
	}


	
	
	public function movPeriodo($inicio, $fim){

		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

	$_SESSION['titulo'] = 'Movimento';
	$_SESSION['tipo'] = 'Movimento';
	$_SESSION['funcao'] = 'movPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;
        $_SESSION['pg'] = "movimento.php";

        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_mat';
	$_SESSION['colunas']['col2'] = 'id_mov';
	$_SESSION['colunas']['col3'] = 'codigo';
	$_SESSION['colunas']['col4'] = 'descricao';
	$_SESSION['colunas']['col5'] = 'quant_ent';
	$_SESSION['colunas']['col6'] = 'quant_sai';
	$_SESSION['colunas']['col7'] = 'unidade';
	$_SESSION['colunas']['col8'] = 'validade';
	$_SESSION['colunas']['col9'] = 'data_real';

	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

	$consulta = $conn -> prepare("select id_mov, id_mat, codigo, descricao, quant_sai, quant_ent, unidade, obs, validade, date_format(data_real,'%d/%m/%Y') as data_real from movimento mov, material mat WHERE mat.id=mov.id_mat and mov.data_real between ? and ? order by descricao");
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
			
	
		return $consulta;
	}

	public function consPeriodo($inicio, $fim){

		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

	$_SESSION['titulo'] = 'Consumo';
	$_SESSION['tipo'] = 'Movimento';
	$_SESSION['funcao'] = 'consPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;

        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_mat';
	$_SESSION['colunas']['col2'] = 'codigo';
	$_SESSION['colunas']['col3'] = 'descricao';
	$_SESSION['colunas']['col4'] = 'quant_consumo';
	$_SESSION['colunas']['col5'] = 'unidade';

	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

	$consulta = $conn -> prepare("select id_mov, id_mat, codigo, descricao, sum(mov.quant_sai) as quant_consumo, unidade, obs from movimento mov, material mat WHERE mat.id=mov.id_mat and mov.data_real between ? and ? group by mov.id_mat having sum(mov.quant_sai)>0 order by descricao");
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
			
	
		return $consulta;
	}

	public function entPeriodo($inicio, $fim){

		
	$conn = Conexao::getInstance();

	$conn -> exec("set names utf8");

	$_SESSION['titulo'] = 'Entradas';
	$_SESSION['tipo'] = 'Movimento';
	$_SESSION['funcao'] = 'entPeriodo';
	$_SESSION['var1'] = $inicio;
	$_SESSION['var2'] = $fim;

        unset($_SESSION['colunas']);

	$_SESSION['colunas']['col1'] = 'id_mat';
	$_SESSION['colunas']['col2'] = 'codigo';
	$_SESSION['colunas']['col3'] = 'descricao';
	$_SESSION['colunas']['col4'] = 'quant_entrada';
	$_SESSION['colunas']['col5'] = 'unidade';

	//$consulta = $conn -> prepare("SELECT id, credor, numero, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar, valores, 
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where pgtodata between ?  and ? and cancelar is null order by id");

	$consulta = $conn -> prepare("select id_mov, id_mat, codigo, descricao, sum(mov.quant_ent) as quant_entrada, unidade, obs from movimento mov, material mat WHERE mat.id=mov.id_mat and mov.data_real between ? and ? group by mov.id_mat having sum(mov.quant_ent)>0 order by descricao");
	$consulta->bindValue(1,$inicio);
	$consulta->bindValue(2,$fim);

	$consulta->execute();
			
	
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

public function atualizar(Movimento $movimento){
	
	$conn = Conexao::getInstance();

        $conn -> exec("set names utf8");
		
	$id_mov = $movimento->getId_mov();
	$id_mat = $movimento->getId_mat();
	$qtd_ent = $movimento->getQuat_ent();
	$qtd_sai = $movimento->getQuat_sai();
	$val = $movimento->getValidade();
	$obs = $movimento->getObs();
	$dt_real = $movimento->getData_real();
	

	//MensagemAlert("Id -> ".$id."Desc ->".$desc);
	
	$stmt = $conn->prepare("UPDATE movimento SET id_mat = ?, quant_ent = ?, quant_sai = ?, validade = ?, obs = ?, data_real = ? WHERE id_mov = ?");						
	$stmt->bindValue(1,$id_mat);
	$stmt->bindParam(2,$qtd_ent);
	$stmt->bindParam(3,$qtd_sai);
	$stmt->bindParam(4,$val);
	$stmt->bindParam(5,$obs);
	$stmt->bindParam(6,$dt_real);
	$stmt->bindParam(7,$id_mov);

	if($stmt->execute()){
		return 1;
		}
		else{
		return 0;	
		}
	}
}

?>