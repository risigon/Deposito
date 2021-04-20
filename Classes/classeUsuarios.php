<?php
include_once 'classeConexaoPDO.php';

class Usuario{

	private $id;
	private $login;
	private $senha;
	private $email;
	
	
	public function __construct (){
			
			$this->setAtributos(null, null, null, null);
			
	}
	
	public function setAtributos($id, $login, $senha, $email){

			$this->id = $id;	
			$this->login = $login;	
			$this->senha = $senha;
			$this->email = $email;
			
	}

	public function getId(){
    return $this->id;
	}

	public function getLogin(){
    return $this->login;
	}

	public function getSenha(){
    return $this->senha;
	}

	public function getEmail(){
    return $this->email;
	}

	public function salvar(Usuario $usuario){

		
	$conn = Conexao::getInstance();
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$login = $usuario->getLogin();
	$senha = base64_encode($usuario->getSenha());
	$email = $usuario->getEmail();
		
	$stmt = $conn->prepare("INSERT INTO usuarios (id, login, senha, email) VALUES(?, ?, ?, ?)");
	$stmt->bindValue(1,("000000"));
	$stmt->bindParam(2,$login);
	$stmt->bindParam(3,$senha);
	$stmt->bindParam(4,$email);
			
	
	if($stmt->execute()){
		MensagemAlert ($login.' Inserido com sucesso...');//echo "cadastro efetuado com sucesso";
		echo "<meta http-equiv='refresh' content='1;URL='login.php''/>";
		}
		else{
		MensagemAlert ('Erro ao Inserir...');//echo "erro ao cadastrar";
		echo die (mysql_error());
		}
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