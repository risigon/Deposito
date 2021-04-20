<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>

  <?php 
  include 'funcoes.php';
  include_once 'Classes/classeUsuarios.php';

  cabecalho();

  session_start();

  if(isset($_SESSION['cadastro'])){
    $log = $_SESSION['cadastro']['login'];
    $ema = $_SESSION['cadastro']['email'];
  }else{
    $log = "";
    $ema = "";
  }
  
  ?>
<meta charset="utf-8">
<link href="css/login.css" rel="stylesheet">

</head>
<body>


<div class = "container">
  <div class="wrapper">
    <form action="" method="post" name="Login_Form" class="">       
        <h3 class="form-signin-heading">Cadastro - Usuários</h3>
        <hr class="colorgraph"><br>
        
        <label>Usuário:</label>
        <input type="text" class="form-control btn-default btn-block" name="login" placeholder="" value="<?php echo $log?>" maxlength="100" required autofocus="" />
        <br>

        <label>Senha:</label>
        <input type="password" class="form-control btn-default btn-block" name="senha" placeholder="" maxlength="50" required/>   

        <label>Confirmar Senha:</label>
        <input type="password" class="form-control btn-default btn-block" name="confsenha" placeholder="" maxlength="50" required/>               

        <label>Email:</label>
        <input type="email" class="form-control btn-default btn-block" name="email" placeholder="" value="<?php echo $ema?>" maxlength="100" required/>
        <br>

        <button class="btn btn-lg btn-success btn-block"  name="go" value="go" type="Submit">Salvar</button>        
        
    </form>     
  </div>
</div>


<?php 

//session_start();

//print_r ($_SESSION);

	if(isset($_POST['go'])){

    $acesso = "/Horas";
    $login = "login.php";

    $id = "000000";
		$log = $_POST['login'];
		$sen = $_POST['senha'];
    $confsenha = $_POST['confsenha'];
    $ema = $_POST['email'];

    $usuario = new Usuario();
    $usu = $usuario->buscarUsuario($log);
  
   if($usu){
    MensagemAlert("Usuário já Cadastrado");

    $_SESSION['cadastro']['login']=$log;
    $_SESSION['cadastro']['email']=$ema;
    exit;
    }

    if($confsenha !== $sen){
      MensagemAlert("Senha e Confirmar senhas n�o s�o iguais... Tente novamente...");
      $_SESSION['cadastro']['login']=$log;
      $_SESSION['cadastro']['email']=$ema;
      echo "<meta http-equiv='refresh' content='0; url=cadUsuario.php'>";
      exit;
    }

    
    isset($_SESSION['cadastro'])?session_unset($_SESSION['cadastro']):"";

    $usuario->setAtributos($id, $log, $sen, $ema);
    $usuario->salvar($usuario);

    echo "<meta http-equiv='refresh' content='0; url=$login'>";
  

	}

 ?>

</body>
</html>