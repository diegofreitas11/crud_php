<?php
	include "base.php";
	include "conexao.php";
	$conexao = conexao();
	if (isset($_POST['submitUsuario'])) {
		$nome = $_POST['inputNome'];
		$data = $_POST['inputData'];
		$grau = $_POST['inputGrau'];
		$endereco = $_POST['inputEndereco'];
		$tel = $_POST['inputTelefone'];
		$email = $_POST['inputEmail'];
		$genero = $_POST['inputGenero'];

		$sql = "INSERT INTO usuarios (nome, data_nascimento, grau_escolaridade, endereco, telefone, email, genero) 
			VALUES ('$nome', '$data', '$grau', '$endereco', '$tel', '$email', '$genero')";

		if (mysqli_query($conexao, $sql)) {
			echo "<div class='alert alert-success' role='alert'>
  			Cadastro feito com sucesso! </div>";
		} else {
			echo mysqli_error($conexao);
		}
	}

if (isset($_GET['id_edit'])){
		$id = $_GET['id_edit'];
		$sql = "SELECT * FROM usuarios WHERE id='$id'";
		$query = mysqli_query($conexao, $sql);
		$usuario = mysqli_fetch_array($query);
	}

	if (isset($_POST['updateUsuario'])) {
		$nome = $_POST['inputNome'];
		$data = $_POST['inputData'];
		$grau = $_POST['inputGrau'];
		$endereco = $_POST['inputEndereco'];
		$tel = $_POST['inputTelefone'];
		$email = $_POST['inputEmail'];
		$genero = $_POST['inputGenero'];
		$id = $_POST['inputId'];

		$sql = "UPDATE usuarios SET nome='$nome', data_nascimento='$data', grau_escolaridade='$grau', endereco='$endereco',
				 telefone='$tel', email='$email', genero='$genero' WHERE id='$id'";

		if (mysqli_query($conexao, $sql)) {
			echo "<div class='alert alert-success' role='alert'>
  			Edição feita com sucesso! </div>";
		} else {
			echo mysqli_error($conexao);
		}
	}
	
	$generos = ["masculino", "feminino", "outro"];

	
	
?>
<div class="container">
	<form method="POST" action="cadastrar_usuario.php">
		
		<?php if (!isset($usuario)) { ?>
			<div class="form-group row">
				<div class="col-6 mr-3">
					<label for="nome" class="mt-3">Digite o nome:</label>
					<input type="text" class="form-control" id="nome" name="inputNome" required/>
				</div>
				<div class="col-4">
					<label for="data" class="mt-3">Data de nascimento:</label>
					<input type="date" class="form-control" id="data" name="inputData" required/>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-4 mr-3">
					<label for="endereco" class="mt-3">Endereço:</label>
					<input type="text" class="form-control" id="endereco" name="inputEndereco" required/>
				</div>
				<div class="col-3">
					<label for="tel" class="mt-3">Telefone:</label>
					<input type="tel" class="form-control cpf-mask" id="tel" name="inputTelefone" required/>
				</div>
				<div class="col-3">
					<label for="email" class="mt-3">E-mail:</label>
					<input type="email" class="form-control" id="email" name="inputEmail" required/>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-5 mr-3">
					<label for="grau" class="mt-3">Grau de Escolaridade:</label>
					<input type="text" class="form-control" id="grau" name="inputGrau" required/>
				</div>
				<div class="col-5">
					<label for="genero" class="mt-3">Genero:</label>
					<select class="form-control" id="genero" name="inputGenero"/>
						<?php foreach($generos as $genero) { ?>
							<option value="<?= $genero ?>">
							 <?= $genero ?> </option>
						<?php } ?>
				
					</select>
				</div>
			</div>

			<input type="submit" class="btn btn-dark mt-3" name= "submitUsuario" value="Cadastrar"/>
			</div>
		<?php } else { ?>
			<div class="form-group row">
				<div class="col-6 mr-3">
					<label for="nome" class="mt-3">Digite o nome:</label>
					<input type="text" class="form-control" id="nome" name="inputNome" value="<?= $usuario['nome']?>" required/>
				</div>
				<div class="col-4">
					<label for="data" class="mt-3">Data de nascimento:</label>
					<input type="date" class="form-control" id="data" name="inputData" value="<?= $usuario['data_nascimento']?>" required/>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-4 mr-3">
					<label for="endereco" class="mt-3">Endereço:</label>
					<input type="text" class="form-control" id="endereco" name="inputEndereco" value="<?= $usuario['endereco']?>" required/>
				</div>
				<div class="col-3">
					<label for="tel" class="mt-3">Telefone:</label>
					<input type="tel" class="form-control" id="tel" minlength="9" maxlength="9" name="inputTelefone" value="<?= $usuario['telefone']?>" required/>
				</div>
				<div class="col-3">
					<label for="email" class="mt-3">E-mail:</label>
					<input type="email" class="form-control" id="email" name="inputEmail" value="<?= $usuario['email']?>" required/>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-5 mr-3">
					<label for="grau" class="mt-3">Grau de Escolaridade:</label>
					<input type="text" class="form-control" id="grau" name="inputGrau" value="<?= $usuario['grau_escolaridade']?>" required/>
				</div>
				<div class="col-5">
					<label for="genero" class="mt-3">Genero:</label>
					<select class="form-control" id="genero" name="inputGenero"/>
						<?php foreach($generos as $genero) { ?>
							<option value="<?= $genero ?>" <?php if($genero==$usuario['genero']){?> 
							 selected <?php } ?>><?= $genero ?> </option>
						<?php } ?>
				
					</select>
				</div>
				
			</div>

			<input type="hidden"  name="inputId" value="<?= $usuario['id']?>"/>
			<input type="submit" class="btn btn-dark" name="updateUsuario" value="Editar"/>
		<?php } ?>
		
	</form>
	<script>
		$(document).ready(function(){
	  		$("#tel").mask('0000-00000');
		
		});
	</script>
</div>
