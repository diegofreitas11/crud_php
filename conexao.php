<?php
    function conexao()
    {
        $servidor = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'crud_php';
        $con = mysqli_connect($servidor,$usuario,$senha,$banco);
        mysqli_set_charset($con,"utf8");
        return $con;
    }
?>
