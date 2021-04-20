<?php
include_once 'classeConexaoPDO.php';

class Datareal{

	private $id;
	private $datareal;
	
		
	
	public function __construct (){
			
			$this->setAtributos(null, null);
			
	}
	
	public function setAtributos($id, $datareal){

			$this->id = $id;	
			$this->datareal = $datareal;	
			
						
	}

	public function getId(){
    return $this->id;
	}

	public function getDatareal(){
    return $this->datareal;
	}


	
	public function salvar(Datareal $datareal){

		
	$conn = Conexao::getInstance();
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$datarl = $datareal->getDatareal();
				
	$stmt = $conn->prepare("INSERT INTO datareal (id, datareal) VALUES(?, ?)");
	$stmt->bindValue(1,("000000"));
	$stmt->bindParam(2,$datarl);
	
				
	
	if($stmt->execute()){
		MensagemAlert ($datarl.' Inserido com sucesso...');//echo "cadastro efetuado com sucesso";
		echo "<meta http-equiv='refresh' content='1;URL='login.php''/>";
		}
		else{
		MensagemAlert ('Erro ao Inserir...');//echo "erro ao cadastrar";
		echo die (mysql_error());
		}
	}

	public function buscarDatareal(){

	$conn = Conexao::getInstance();

    $conn -> exec("set names utf8");

    $_SESSION['tipo'] = 'Datareal';
	$_SESSION['funcao'] = 'buscarDataral';
		
	//$consulta = $conn -> prepare("SELECT id, credor, numero, valores, op, date_format(pgtodata,'%d/%m/%Y') as pgtodata, cancelar,
	//date_format(baixa,'%d/%m/%Y') as baixa FROM cheques where id=?");

	$consulta = $conn -> prepare("SELECT data_real from datareal where id=1");
		

	$consulta->execute();
			
	return $consulta;  
	
	}

	public function atualizar(Datareal $datareal){
	
	$conn = Conexao::getInstance();

    $conn -> exec("set names utf8");
		
	$id = $datareal->getId();
	$dt_real = $datareal->getDatareal();
	

	//MensagemAlert("Id -> ".$id."Desc ->".$desc);
	
	$stmt = $conn->prepare("UPDATE datareal SET id = ?, datareal = ? WHERE id = ?");						
	$stmt->bindValue(1,$id);
	$stmt->bindParam(2,$dt_real);
	
	if($stmt->execute()){
		return 1;
		}
		else{
		return 0;	
		}
	}	

	}

?>