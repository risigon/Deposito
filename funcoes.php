<?php

function MensagemAlert($parametro) {
echo '<script>alert("'.$parametro.'");</script>';
}
function nav($usuario){

$usuario = ucfirst($usuario);

$pag = <<< PAG
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <!--img src="http://placehold.it/150x50&text=Logo" alt=""-->
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                     
                    <li>
                        <a href="Material/">Material</a>
                    </li>
                    <li>
                        <a href="Medicamento/">Medicamento</a>
                    </li>
                     <li>
                        <a href="#">Bem-vindo, {$usuario}</a>
                    </li>
                     <li>
                        <a href="logout.php" title="{$usuario}">Sair</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
PAG;
echo $pag;
}

function sessao(){

session_start();

$usuario = isset($_SESSION["usuario"])?$_SESSION["usuario"]:"<meta http-equiv='refresh' content='0; url=login.php'>";

return $usuario;

}

function cabecalho(){
$pag = <<< PAG
    <meta charset="utf-8">
        
        <script type="text/javascript" src="masc.js"> </script>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/landing-page.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="estilo.css" type="text/css">
        
        <!-- Bibliotecas JQuery -->
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
PAG;
echo $pag;
}

?>		