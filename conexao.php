<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";

$conexao = new mysqli($servidor, $usuario,
$senha, "copa_arena");
$conexao->set_charset("utf8");
?>