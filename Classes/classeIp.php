<?php
include_once 'classeConexaoPDO.php';

class Ip{

	private $id;
	private $ip;
	private $status;
		
	
	public function __construct (){
			
			$this->setAtributos(null, null, null);
			
	}
	
	public function setAtributos($id, $ip, $status){

			$this->id = $id;	
			$this->ip = $ip;	
			$this->status = $status;
						
	}

	public function getId(){
    return $this->id;
	}

	public function getIp(){
    return $this->ip;
	}


	public function getStatus(){
    return $this->status;
	}


	public function salvar(Ip $ip){

		
	$conn = Conexao::getInstance();
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$ip_num = $ip->getIp();
	$status = $ip->getStatus();
			
	$stmt = $conn->prepare("INSERT INTO ip (id, ip, status) VALUES(?, ?, ?)");
	$stmt->bindValue(1,("000000"));
	$stmt->bindParam(2,$ip_num);
	$stmt->bindParam(3,$status);
				
	
	if($stmt->execute()){
		MensagemAlert ($ip_num.' Inserido com sucesso...');//echo "cadastro efetuado com sucesso";
		echo "<meta http-equiv='refresh' content='1;URL='login.php''/>";
		}
		else{
		MensagemAlert ('Erro ao Inserir...');//echo "erro ao cadastrar";
		echo die (mysql_error());
		}
	}

	public function buscar(){
	
	$conn = Conexao::getInstance();

    $conn -> exec("set names utf8");

    $_SESSION['tipo'] = 'Ip';
	$_SESSION['funcao'] = 'buscar';
	
	$consulta = $conn -> prepare("select ip from ip");

	//$consulta = $conn -> prepare("select id_mat, descricao, sum(mov.quant_ent - mov.quant_sai) as quant_estoque, unidade from material mat inner join movimento mov on (mat.id=mov.id_mat) group by mov.id_mat order by descricao");

	$consulta->execute();
			
	return $consulta;
		
	}

	public function validarUsuario(Usuario $usuario){

	$conn = Conexao::getInstance();
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$login = $usuario->getLogin();
	$senha = base64_encode($usuario->getSenha());

	//MensagemAlert($login." <-> ".$senha);

	$stmt = $conn->prepare("select id from usuarios where login=? and senha = ?");
	$stmt->bindValue(1,$login);
	$stmt->bindValue(2,$senha);

	$stmt->execute();

	$count = $stmt->rowCount();

	if($count>0){
		session_start();
		$_SESSION['usuario'] = $login;
		//include_once 'criarBanco.php';
		$link = isset($_SESSION['login'])?$_SESSION['login']:"../Deposito/";
      	echo "<meta http-equiv='refresh' content='0; url=$link'>";
		}
		else{
		MensagemAlert('Senha Inválida');
		/*echo "<div class=''>";
                echo "<span class='btn-block bg-warning text-center text-info text-uppercase'>Senha Inválida<span>";
                echo "</div>";*/
                echo "<meta http-equiv='refresh' content='0; url=login.php'>";
		}
	}

	public function buscarUsuario($login){

	$conn = Conexao::getInstance();
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $conn->prepare("select id from usuarios where login=?");
	$stmt->bindValue(1,$login);

	$stmt->execute();

	$count = $stmt->rowCount();

	if($count>0){
		return true;
	}else{
		return false;
	}

	}	

	}

?>