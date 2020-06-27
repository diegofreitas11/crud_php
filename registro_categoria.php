<?php
	include "base.php";
	include "conexao.php";
	$conexao = conexao();
	if (isset($_POST['submitCategoria'])) {
		$nome = $_POST['inputNome'];
		
		$sql = "INSERT INTO categorias (nome) VALUES ('$nome')";

		if (mysqli_query($conexao, $sql)) {
			echo "<div class='alert alert-success' role='alert'>
  			Cadastro feito com sucesso! </div>";
		} else {
			echo mysqli_error($conexao);
		}
	}

	if (isset($_GET['id_edit'])) {
		$id = $_GET['id_edit'];
		$sql = "SELECT * FROM categorias WHERE id='$id'";
		$query = mysqli_query($conexao, $sql);
		$categoria = mysqli_fetch_array($query);
	}
	
	if (isset($_POST['updateCategoria'])) {
		$nome = $_POST['inputNome'];
		$id = $_POST['inputId'];
		
		$sql = "UPDATE categorias SET nome='$nome' WHERE id='$id'";

		if (mysqli_query($conexao, $sql)) {
			echo "<div class='alert alert-success' role='alert'>
  			Edição feita com sucesso! </div>";
		} else {
			echo mysqli_error($conexao);
		}
	}

	if(isset($_GET['id_del'])){
		$id = $_GET['id_del'];
		$sql = "SELECT * FROM livros WHERE categoria_id='$id'";
		$query = mysqli_query($conexao, $sql);
		if(mysqli_num_rows($query) == 0){
			$sql = "DELETE FROM categorias WHERE id='$id'";
			if(mysqli_query($conexao, $sql)){
				echo "<div class='alert alert-info' role='alert'>
	  			Categoria deletado com sucesso. </div>";
			}else{
				echo mysqli_error($conexao);
			}
		}else{
			echo "<div class='alert alert-danger' role='alert'>
	  			Não é impossível fazer exclusão. A categoria é usada em alguns registros de livro </div>";
		}
	}

	$sql = "SELECT * FROM categorias";
	$query = mysqli_query($conexao, $sql);
?>

<div class="container">
	<form method="POST" action="registro_categoria.php">
		
		<?php if (!isset($categoria)) { ?>
				
			<label for="nome" class="mt-3">Digite o nome:</label>
			<input type="text" class="form-control" id="nome" name="inputNome"/>
			<input type="submit" class="btn btn-dark mt-3" name= "submitCategoria" value="Cadastrar"/>
			
		<?php } else { ?>
			<label for="nome" class="mt-3">Digite o nome:</label>
			<input type="text" class="form-control" id="nome" name="inputNome" value="<?= $categoria['nome'] ?>"/>
			<input type="hidden" name="inputId" value="<?= $categoria['id'] ?>"/>
			<input type="submit" class="btn btn-dark mt-3" name= "updateCategoria" value="Editar"/>
			
		<?php } ?>
		
	</form>

	<table class="table mt-5">
		<tr>
			<th> ID </th>
			<th> Nome </th>
			<th>  </th>
			<th>  </th>
			
		</tr>
		<?php while ($categoria = mysqli_fetch_array($query)){ ?>
		<tr>
			<td> <?= $categoria['id']?> </td>
			<td> <?= $categoria['nome']?> </td>
			<td> <button class="btn btn-dark"><a href="registro_categoria.php?id_edit=<?= $categoria['id']?>"">editar</a></button> </td>
			<td> <button class="btn btn-danger"><a href="registro_categoria.php?id_del=<?= $categoria['id']?>">deletar</a></button> </td>
		</tr>
		<?php
			}
		?>
	</table>
</div>
