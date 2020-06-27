<?php
	include "base.php";
	include "conexao.php";
	$conexao = conexao();

	
	if(isset($_GET['id_del'])){
		$id = $_GET['id_del'];
		$sql = "SELECT * FROM usuarios_livros WHERE livro_id='$id'";
		$query = mysqli_query($conexao, $sql);
		if(mysqli_num_rows($query) == 0){
			$sql = "DELETE FROM livros WHERE id='$id'";
			if(mysqli_query($conexao, $sql)){
				echo "<div class='alert alert-info' role='alert'>
	  			Livro excluido com sucesso! </div>";
			}else{
				echo mysqli_error($conexao);
			}
		}else{
			echo "<div class='alert alert-danger' role='alert'>
	  			Não é impossível fazer exclusão. Há cópias desse livro emprestadas. </div>";	
		}
	}

	$sql = "SELECT livros.*, categorias.nome as categoria FROM livros JOIN categorias on livros.categoria_id=categorias.id";
	$query = mysqli_query($conexao, $sql);
	
?>
<div class="container">
	<table class="table mt-5">
		<tr>
			<th> Nome </th>
			<th> Autor </th>
			<th> Tema </th>
			<th> Data </th>
			<th> Categoria </th>
			<th> Quantidade </th>
			<th>  </th>
			<th>  </th>
		</tr>
		<?php
        		while ($livro = mysqli_fetch_array($query)) {

            	?>
		<tr>
			<td> <?= $livro['nome']?> </td>
			<td> <?= $livro['autor']?> </td>
			<td> <?= $livro['tema']?> </td>
			<td> <?= $livro['data_publicacao']?> </td>
			<td> <?= $livro['categoria']?> </td>
			<td> <?= $livro['quantidade']?> </td>
			<td> <button class="btn btn-dark"><a href="cadastrar_livro.php?id_edit=<?= $livro['id']?>">editar</a> </button> </td>
			<td> <button class="btn btn-danger"><a href="lista_livro.php?id_del=<?= $livro['id']?>"">deletar</a></button> </td>
		</tr>
		
		<?php
			}
		?>
		
	</table>
	<button class="btn btn-success btn-lg"><a href="cadastrar_disco.php">Adicionar Livro</button>
</div>
