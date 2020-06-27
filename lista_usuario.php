<?php
	include "base.php";
	include "conexao.php";
	$conexao = conexao();

	if(isset($_GET['id_del'])){
		$id = $_GET['id_del'];
		$sql = "SELECT * FROM usuarios_livros WHERE usuario_id='$id'";
		$query = mysqli_query($conexao, $sql);
		if(mysqli_num_rows($query) == 0){
			$sql = "DELETE FROM usuarios WHERE id='$id'";
			if(mysqli_query($conexao, $sql)){
				echo "<div class='alert alert-info' role='alert'>
	  			Usuario deletado com sucesso. </div>";
			}else{
				echo mysqli_error($conexao);
			}
		}else{
			echo "<div class='alert alert-danger' role='alert'>
	  			Não é impossível fazer exclusão. O usuário tem livros emprestados. </div>";
		}
	}

	$sql = "SELECT * FROM usuarios";
	$query = mysqli_query($conexao, $sql);
	
?>
<div class="container">
	<table class="table mt-5">
		<tr>
			<th> Nome </th>
			<th> Data de Nascimento </th>
			<th> Grau de Escolaridade </th>
			<th> Endereço </th>
			<th> Telefone </th>
			<th> E-Mail </th>
			<th> Genero </th>
			<th>  </th>
			<th>  </th>
			
		</tr>
		<?php while ($usuario = mysqli_fetch_array($query)){ ?>
		<tr>
			<td> <?= $usuario['nome']?> </td>
			<td> <?= $usuario['data_nascimento'] ?></td>
			<td> <?= $usuario['grau_escolaridade']?> </td>
			<td> <?= $usuario['endereco']?> </td>
			<td> <?= $usuario['telefone']?> </td>
			<td> <?= $usuario['email']?> </td>
			<td> <?= $usuario['genero']?> </td>
			<td> <button class="btn btn-dark"><a href="cadastrar_usuario.php?id_edit=<?= $usuario['id']?>"">editar</a></button> </td>
			<td> <button class="btn btn-danger"><a href="lista_usuario.php?id_del=<?= $usuario['id']?>">deletar</a></button> </td>
		</tr>
		<?php
			}
		?>
	</table>
	<button class="btn btn-success btn-lg"><a href="cadastrar_usuario.php">Adicionar Usuario</button>
</div>
