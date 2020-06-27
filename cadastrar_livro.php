<?php
	include "base.php";
	include "conexao.php";
	$conexao = conexao();
	

	if (isset($_POST['submitLivro'])) {
		$nome = $_POST['inputNome'];
		$autor = $_POST['inputAutor'];
		$tema = $_POST['inputTema'];
		$data = $_POST['inputData'];
		$categoria = $_POST['inputCategoria'];
		$quantidade = $_POST['inputQtd'];

		$sql = "INSERT INTO livros(nome, autor, tema, data_publicacao, categoria_id, quantidade) VALUES ('$nome', '$autor', '$tema', '$data', '$categoria', '$quantidade')";

		if (mysqli_query($conexao, $sql)) {
			echo "<div class='alert alert-success' role='alert'>
  			Cadastro feito com sucesso! </div>";
		} else {
			echo mysqli_error($conexao);
		}
	}

	

	if (isset($_GET['id_edit'])){
		$id = $_GET['id_edit'];
		$sql = "SELECT * FROM livros WHERE id='$id'";
		$query = mysqli_query($conexao, $sql);
		$livro = mysqli_fetch_array($query);
	}

	if (isset($_POST['updateLivro'])) {
		$nome = $_POST['inputNome'];
		$autor = $_POST['inputAutor'];
		$tema = $_POST['inputTema'];
		$data = $_POST['inputData'];
		$categoria = $_POST['inputCategoria'];
		$quantidade = $_POST['inputQtd'];
		$id = $_POST['inputId'];


		$sql = "UPDATE livros SET nome='$nome', autor='$autor', tema='$tema', data_publicacao='$data',
				 categoria_id='$categoria', quantidade='$quantidade' WHERE id='$id'";

		if (mysqli_query($conexao, $sql)) {
			echo "<div class='alert alert-success' role='alert'>
  			Edição feita com sucesso! </div>";
		} else {
			echo mysqli_error($conexao);
		}
	}
	
	$sql = "SELECT * FROM categorias";
	$query_categorias = mysqli_query($conexao, $sql);
	
?>
<!doctype html>
<div class="container">
	
	<form method="POST" action="cadastrar_livro.php">
		<?php if (!isset($livro)) { ?>
			
			
			<div class="form-group row mt-4">
				<div class="col-6">
					<label for="nome">Digite o nome do livro:</label>
					<input type="text" class="form-control" id="nome" name="inputNome" required/>
				</div>
				<div class="col-4">
					<label for="autor">Digite o nome do autor:</label>
					<input type="text" class="form-control" id="autor" name="inputAutor" required/>
				</div>
			</div>
			
			<div class="form-group row mt-4">
				<div class="col-6">
					<label for="tema">Digite o tema do livro:</label>
					<input type="text" class="form-control" id="tema" name="inputTema" required/>
				</div>
				<div class="col-4">
					<label for="data">Digite a data de publicação:</label>
					<input type="date" class="form-control" id="data" name="inputData" required/>
				</div>
			</div>
			<div class="form-group row mt-4">
				<div class="col-6">
					<label for="artista">Escolha a categoria do livro:</label>
					<select type="text" class="form-control" id="tema" name="inputCategoria"/>
						<?php while ($categoria = mysqli_fetch_array($query_categorias)){ ?>
							<option value="<?= $categoria['id'] ?>"> <?= $categoria['nome'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-4">
					<label for="ano">Digite a quantidade de cópias:</label>
					<input type="number" class="form-control" id="qtd" name="inputQtd" required/>
				</div>
			</div>
			<input type="submit" class="btn btn-dark mt-3" name="submitLivro" value="Cadastrar"/>
		<?php } else { ?>
			
			<div class="form-group row mt-4">
				<div class="col-6">
					<label for="nome">Digite o nome do livro:</label>
					<input type="text" class="form-control" id="nome" name="inputNome" value="<?= $livro['nome']?>" required/>
				</div>
				<div class="col-4">
					<label for="autor">Digite o nome do autor:</label>
					<input type="text" class="form-control" id="autor" name="inputAutor" value="<?= $livro['autor']?>" required/>
				</div>
			</div>
			
			<div class="form-group row mt-4">
				<div class="col-6">
					<label for="tema">Digite o tema do livro:</label>
					<input type="text" class="form-control" id="tema" name="inputTema" value="<?= $livro['tema']?>" required/>
				</div>
				<div class="col-4">
					<label for="data">Digite a data de publicação:</label>
					<input type="date" class="form-control" id="data" name="inputData" value="<?= $livro['data_publicacao']?>" required/>
				</div>
			</div>
			<div class="form-group row mt-4">
				<div class="col-6">
					<label for="artista">Escolha a categoria do livro:</label>
					<select type="text" class="form-control" id="tema" name="inputCategoria"/>
						<?php while ($categoria = mysqli_fetch_array($query_categorias)){ ?>
							<option value="<?= $categoria['id'] ?>" <?php if($livro['categoria_id'] == $categoria['id']) { ?> selected <?php } ?>> <?= $categoria['nome'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-4">
					<label for="ano">Digite a quantidade de cópias:</label>
					<input type="number" class="form-control" id="qtd" name="inputQtd" value="<?= $livro['quantidade']?>" required/>
				</div>
			</div>
			<input type="hidden" value="<?= $livro['id']?>" name="inputId"/>
			<input type="submit" class="btn btn-dark mt-3" name="updateLivro" value="Editar"/>
			

		<?php } ?>
	</form>
	
	

</div>
