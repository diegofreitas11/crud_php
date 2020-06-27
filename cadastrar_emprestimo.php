<?php
	include "base.php";
	include "conexao.php";
	$conexao = conexao();
	
	if(isset($_POST['submitEmprestimo'])){
		$id_usuario = $_POST['inputUsuario'];
		$id_livro = $_POST['inputLivro'];
		$sql = "SELECT * FROM usuarios_livros WHERE usuario_id='$id_usuario' and livro_id='$id_livro'";
		$query = mysqli_query($conexao, $sql);
		
		if(mysqli_num_rows($query)==0){
			$sql = "INSERT INTO usuarios_livros VALUES ('$id_usuario', '$id_livro')";

			if(mysqli_query($conexao, $sql)){
				$sql = "UPDATE livros SET quantidade=(quantidade-1) WHERE id='$id_livro'";
				if(mysqli_query($conexao, $sql)){
					$id_anterior = $id_usuario;
					echo "<div class='alert alert-success' role='alert'>
		  			Empréstimo registrado! </div>";
				}
			}else{
				echo mysqli_error($conexao);
			}
		}else{
			echo "<div class='alert alert-danger' role='alert'>
		  			Uma cópia desse livro já foi emprestada para esse usuário </div>";
		}
	}

	$sql = "SELECT * FROM livros WHERE quantidade > 0";
	$query_livros=mysqli_query($conexao, $sql);

	$sql = "SELECT * FROM usuarios";
	$query_usuarios = mysqli_query($conexao, $sql);
?>
<div class="container" id="container">
	<form method="POST" action="cadastrar_emprestimo.php">
		<?php if(mysqli_num_rows($query_livros) > 0){ ?>
			Selecione o livro:
			<select class="form-control form-control-lg mb-4" name="inputLivro">
				<option value=""> ---------- </option>
				<?php while ($livro = mysqli_fetch_array($query_livros)) { ?>
					<option value="<?= $livro['id']?>"> <?= $livro['nome']?> </option>
				<?php } ?>
			</select>
		<?php }else{ ?>
			<p>Nenhum livro disponível, <a href="cadastrar_livro.php" style="color:black;">cadastre um!</a></p>
		<?php } ?>
		<?php if(mysqli_num_rows($query_usuarios) > 0){ ?>
		Selecione o usuário:
		<select class="form-control form-control-lg mb-4" name="inputUsuario">
			<option value=""> ---------- </option>
			<?php while ($usuario = mysqli_fetch_array($query_usuarios)) { ?>
				<option value="<?= $usuario['id']?>"
				<?php if(isset($id_anterior) && $id_anterior==$usuario['id']) { ?>
					selected
				<?php } ?>
				> <?= $usuario['nome']?> </option>
			<?php } ?>
		</select>
		<?php }else{ ?>
			<p>Nenhum usuário disponível, <a href="cadastrar_usuario.php" style="color:black;">cadastre um!</a></p>
		<?php } ?>
		
		<?php if(mysqli_num_rows($query_livros) > 0 && mysqli_num_rows($query_usuarios) > 0) { ?>
			<input type="submit" class="btn btn-success mt-3" name="submitEmprestimo" value="Registrar Empréstimo"/>
		<?php } ?>
	</form>
</div>
