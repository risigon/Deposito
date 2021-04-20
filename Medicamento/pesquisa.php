<?php
require_once 'funcoes.php';

$usuario = sessao();

unset($_SESSION['validade']);
			
if(isset($usuario)){
	?>
<!doctype>
<html>
	<head>
		<title>Pesquisa Medicamento</title>
		
		<?php echo cabecalho();?>

		<?php echo datepicker();?>

		
		<script>
		$(document).ready(function(){
		    $("#linkpesq2").click(function(){
		        $("#conteudo").fadeToggle(1000);
		        $(".linkpesq2").hide();
		    });
		    $("#linkpesq3").click(function(){
		        $("#conteudo2").fadeToggle(1000);
		        $(".linkpesq3").hide();
		    });
                $("#linkpesq4").click(function(){
		        $("#conteudo3").fadeToggle(1000);
		        $(".linkpesq4").hide();
		    });
            	$("#linkpesq5").click(function(){
		        $("#conteudo4").fadeToggle(1000);
		        $(".linkpesq5").hide();
		    });
			    $("#linkpesq6").click(function(){
			        $("#conteudo5").fadeToggle(1000);
			        $(".linkpesq6").hide();
			});
			    $("#linkpesq7").click(function(){
			        $("#conteudo6").fadeToggle(1000);
			        $(".linkpesq7").hide();
			});
			    $("#linkpesq8").click(function(){
			        $("#conteudo7").fadeToggle(1000);
			        $(".linkpesq8").hide();
			});
		});
		</script>

	</head>
		
	<body>
		
		<?php echo nav2() ?>



	<div class="container">
	<div class="row">
		<br><br><br><br><br>
		<div class="col-md-12">
	      <label for="text" class="btn btn-info container">Pesquisar Medicamento</label></br>
	    </div>
    </div>
    </br>
    </br>

    <div class="row">
    <div class="col-md-3" style="background-color:#ffcccc; border-radius: 5px;">
		<form enctype="multipart/form-data" name="cad" class="navbar-form" role="search" id="" action="estoque_id.php" method="post">
			<div class="input-group">
			<input id="" class="btn btn-default" type="number" name="id" placeholder="código"  size="10" maxlength="4" required autofocus />
			<span class="input-group-btn">
				<button class="btn btn-success" type="submit">Go!</button>
			</span>
			</div>
		</form>
		<a id="linkpesq2" class="text-warning" href="#">Consumo</a></br>
		<a id="linkpesq5" class="text-danger" href="#">Validades</a></br>		
		<a id="linkpesq3" class="text-warning" href="#">Descricao</a></br>
		<a id="linkpesq4" class="text-danger" href="#">Entradas</a></br>
		<a id="linkpesq6" class="text-warning" href="#">Movimento</a></br>
		<a id="linkpesq7" class="text-danger" href="#">Saidas</a></br>
		<a id="linkpesq8" class="text-warning" href="#">Entradas Somadas</a>
		</div>
		
	

		<div id="conteudo" class="col-md-4" style="display: none; background-color:#ffb3b3; border-radius: 5px;">
		<span class="text-danger">Consumo por Período</span></br>
			
		<form enctype="multipart/form-data" name="cad" class="navbar-form" role="search" id="" action="consumo.php" method="post">
			<div class="input-group">
			<input id="calendario" class="btn btn-default" type="text" name="dtini" placeholder="dt inicio"  size="10" maxlength="10" onkeypress="mascara( this, mdata);" required /> a 
			<input id="calendario2" class="btn btn-default" type="text" name="dtfim" placeholder="dt fim" size="10" maxlength="10" onkeypress="mascara( this, mdata);" required />
			<input id="" class="" type="hidden" name="periodo" value="periodo" required />
			<span class="input-group-btn">
				<button class="btn btn-success" type="submit">Go!</button>
			</span>
			</div>
		</form>
		</div>

		<div id="conteudo4" class="col-md-4" style="display: none; background-color:#ffb3b3; border-radius: 5px;">
		<span class="text-danger">Validades</span></br>
			
		<form enctype="multipart/form-data" name="cad" class="navbar-form" role="search" id="" action="validades.php" method="post">
			<div class="input-group">
			<input id="val" class="btn btn-default" type="text" name="dtini" placeholder="dt inicio"  size="10" maxlength="10" onkeypress="mascara( this, mdata);" required /> a 
			<input id="val2" class="btn btn-default" type="text" name="dtfim" placeholder="dt fim" size="10" maxlength="10" onkeypress="mascara( this, mdata);" required />
			<input id="" class="" type="hidden" name="periodo" value="periodo" required />
			<span class="input-group-btn">
				<button class="btn btn-success" type="submit">Go!</button>
			</span>
			</div>
		</form>
		</div>

		<div id="conteudo3" class="col-md-4" style="display: none; background-color:#ffb3b3; border-radius: 5px;">
		<span class="text-danger">Entradas por Período</span></br>
			
		<form enctype="multipart/form-data" name="cad" class="navbar-form" role="search" id="" action="listar_entradas.php" method="post">
			<div class="input-group">
			<input id="calendario3" class="btn btn-default" type="text" name="dtini" placeholder="dt ini"  size="10" maxlength="10" onkeypress="mascara( this, mdata);" required /> a 
			<input id="calendario4" class="btn btn-default" type="text" name="dtfim" placeholder="dt fim" size="10" maxlength="10" onkeypress="mascara( this, mdata);" required />
			<input id="" class="" type="hidden" name="periodo" value="periodo" required />
			<span class="input-group-btn">
				<button class="btn btn-success" type="submit">Go!</button>
			</span>
			</div>
		</form>
		</div>

		<div id="conteudo5" class="col-md-4" style="display: none; background-color:#ffb3b3; border-radius: 5px;">
		<span class="text-danger">Movimentação por Período</span></br>
			
		<form enctype="multipart/form-data" name="cad" class="navbar-form" role="search" id="" action="movimento.php" method="post">
			<div class="input-group">
			<input id="calendario5" class="btn btn-default" type="text" name="dtini" placeholder="dt ini"  size="10" maxlength="10" onkeypress="mascara( this, mdata);" required /> a 
			<input id="calendario6" class="btn btn-default" type="text" name="dtfim" placeholder="dt fim" size="10" maxlength="10" onkeypress="mascara( this, mdata);" required />
			<input id="" class="" type="hidden" name="periodo" value="periodo" required />
			<span class="input-group-btn">
				<button class="btn btn-success" type="submit">Go!</button>
			</span>
			</div>
		</form>
		</div>

		<div id="conteudo6" class="col-md-4" style="display: none; background-color:#ffb3b3; border-radius: 5px;">
		<span class="text-danger">Movimentação Saídas - Período</span></br>
			
		<form enctype="multipart/form-data" name="cad" class="navbar-form" role="search" id="" action="listar_saidas.php" method="post">
			<div class="input-group">
			<input id="calendario7" class="btn btn-default" type="text" name="dtini" placeholder="dt ini"  size="10" maxlength="10" onkeypress="mascara( this, mdata);" required /> a 
			<input id="calendario8" class="btn btn-default" type="text" name="dtfim" placeholder="dt fim" size="10" maxlength="10" onkeypress="mascara( this, mdata);" required />
			<input id="" class="" type="hidden" name="saidasperiodo" value="periodo" required />
			<span class="input-group-btn">
				<button class="btn btn-success" type="submit">Go!</button>
			</span>
			</div>
		</form>
		</div>

		<div id="conteudo7" class="col-md-4" style="display: none; background-color:#ffb3b3; border-radius: 5px;">
		<span class="text-danger">Entradas Somadas - Período</span></br>
			
		<form enctype="multipart/form-data" name="cad" class="navbar-form" role="search" id="" action="entradas_somadas.php" method="post">
			<div class="input-group">
			<input id="calendario9" class="btn btn-default" type="text" name="dtini" placeholder="dt ini"  size="10" maxlength="10" onkeypress="mascara( this, mdata);" required /> a 
			<input id="calendario10" class="btn btn-default" type="text" name="dtfim" placeholder="dt fim" size="10" maxlength="10" onkeypress="mascara( this, mdata);" required />
			<input id="" class="" type="hidden" name="entradassomadas" value="entradassoma" required />
			<span class="input-group-btn">
				<button class="btn btn-success" type="submit">Go!</button>
			</span>
			</div>
		</form>
		</div>

		<div id="conteudo2" class="col-md-4" style="display: none; background-color:#ff6666; border-radius: 5px;">
		<span class="text-danger">Buscar por Descrição</span></br>
		<form enctype="multipart/form-data" name="cad" class="navbar-form" role="search" id="" action="estoque_id.php" method="post">
			<div class="input-group">
			<input id="but2" class="btn btn-default" type="text" name="nome" placeholder="descrição"  size="30" maxlength="40" required />
			
			<input id="" class="" type="hidden" name="desc" value="credor" required />

			<span class="input-group-btn">
				<button class="btn btn-success" type="submit">Go!</button>
			</span>
			</div>

		</form>
		</div>

		

		</div>
		</div>
		
		
</body>
</html>
<?php
}else{
	echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}

?>
