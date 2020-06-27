<?php
	include "base.php";
	include "conexao.php";
	$conexao = conexao();
	if(isset($_GET['id_livro'])){
		$id_livro = $_GET['id_livro'];
		$id_usuario = $_GET['id_usuario'];
		$sql = "DELETE FROM usuarios_livros WHERE usuario_id='$id_usuario' and livro_id='$id_livro'";
		if(mysqli_query($conexao, $sql)){
			$sql = "UPDATE livros SET quantidade=(quantidade+1) WHERE id='$id_livro'";
			if(mysqli_query($conexao, $sql)){
				echo "<div class='alert alert-info' role='alert'>
	  			Devolução registrada! </div>";
			}			
		}else{
			echo mysqli_error($conexao);
		}
	}
	
	$sql = "SELECT usuarios_livros.*, usuarios.nome as usuario, livros.nome as livro
		FROM usuarios_livros JOIN usuarios ON usuarios_livros.usuario_id=usuarios.id 
		JOIN livros ON usuarios_livros.livro_id=livros.id";
	$query = mysqli_query($conexao, $sql);
	
?>

<div class="container">
	<table class="table mt-5">
		<?php if (mysqli_num_rows($query) > 0) { ?>
			<?php while ($lista = mysqli_fetch_array($query)) { ?>
				<tr>
					<td><?= $lista['usuario'] ?> está com <?= $lista['livro'] ?></td>
					<td><button class="btn btn-dark">
					<a href="index.php?id_livro=<?= $lista['livro_id']?>&id_usuario=<?= $lista['usuario_id']?>">
					 Registrar Devolução </a></button></td>
				</tr>
			<?php } ?>
		<?php }else{ ?>
			<p>Nenhum empréstimo registrado.</p>
		<?php } ?>
	</table>
</div>

