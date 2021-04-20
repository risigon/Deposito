<?php 
  include 'funcoes.php';
  include 'Classes/classeUsuarios.php';
  include 'Classes/classeIp.php';
  
  cabecalho();
  
  $ip = new Ip();
  $list_ip = $ip->buscar();

  //$datasistema = date('Y-m-d');
  //$datasistema = '2019-02-22';

  $lis = array();

  foreach ($list_ip as $value) {
    //echo $value['ip'];
    array_push($lis, $value['ip']);
  }

  print_r($lis);

  $ipaddress = '';
  //$ipaddress = getHostByName(getHostName());  
  //$ipaddress = getHostByName($_SERVER['REMOTE_ADDR']);

    $ipaddress = $_SERVER['REMOTE_ADDR'];

  //$list_ip = array('31.170.164.33','189.103.23.153', '189.103.20.59', '189.99.8.197', '107.167.117.10','107.167.108.72', '107.167.112.74', '107.167.112.146', '107.167.112.147', '107.167.112.145');

  if(in_array($ipaddress, $lis)){
    session_start();
    include 'datasistema.php';
    $_SESSION['usuario'] = $ipaddress;
      //$datahj = new datetime($datasistema);
      //$_SESSION['datareal']=$datahj;

    $link = isset($_SESSION['login'])?$_SESSION['login']:"../Deposito/";
    echo "<meta http-equiv='refresh' content='0; url=$link'>";
    exit;
  }

  echo $ipaddress;
  //print_r ($list_ip);

  isset($_SESSION['usuario'])?session_unset():"";

  $usuario = new Usuario();

  $usu = "UsuÃ¡rio";

  //echo codificacao($usu); mostra a codificaÃ§Ã£o UTF8 ou ISO

  ?>

<!DOCTYPE html>
<html>
<head>

  <title>Acesso Depósito</title>
  <meta charset="utf-8">

  <link href="css/login.css" rel="stylesheet">

  <script type='application/javascript'>
    function getIP(json){
    document.write('My public IP address is: ', json.ip);    
    }

</script>

<script type='application/javascript' src='https://api.ipify.org?format=json&callback=getIP'></script>


</head>
<body>


<div class = "container">
  <div class="wrapper">
    <form action="" method="post" name="Login_Form" class="form-signin">       
        <h3 class="form-signin-heading">Digite seu Usuário e Senha</h3>
        <hr class="colorgraph"><br>
        
        <input type="text" class="form-control btn-default btn-block" name="login" placeholder="Usuário" value="<?php echo isset($_COOKIE['login'])?base64_decode($_COOKIE['login']):'';?>" required autofocus />
        <input type="password" class="form-control btn-default btn-block" name="senha" placeholder="Senha" required/>          
       
        <button class="btn btn-lg btn-success btn-block"  name="go" value="go" type="Submit">Entrar</button></br>
        <input type="checkbox" class="" name="lembrar" placeholder="" checked> Lembrar </br></br>

        <input type="checkbox" class="" name="addip" placeholder="" checked> Add Ip
        
        <a class="btn btn-block" href="cadUsuario.php">Cadastre-se</a>
        <span onload='getIP()'></span>
    </form>     
  </div>
</div>


<?php 

//session_start();

//print_r ($_SESSION);

  if(isset($_POST['go'])){

    
    $id = "";
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $email = "";

            
    $existe = $usuario->buscarUsuario($login);

    //MensagemAlert($existe);

    if($existe){

            if(!in_array($ipaddress, $lis)){
                 if(isset($_POST['addip'])){
                    $id_ip = '000000';
                    $ip_num = $ipaddress;
                    $status = 'A';

                    $ip->setAtributos($id_ip, $ip_num, $status);
                
                    $ip->salvar($ip);
                    }
               }
    }

    if(!$existe){
      MensagemAlert("Usuário Inválido");
      unset($_COOKIE['login']);
      setcookie('login', '', time() -3600, '/');
      echo "<meta http-equiv='refresh' content='0; url=login.php'>";
      exit;
    }else{
      if(isset($_POST['lembrar'])){
      setcookie('login', base64_encode($login), time() + (86400 * 3), "/");

    }else{
      unset($_COOKIE['login']);
      setcookie('login', '', time() -3600, '/');
    }

    $usuario->setAtributos($id, $login, $senha, $email);
    $valida = $usuario->validarUsuario($usuario);
    }

  }

 ?>

</body>
</html>