<?php

$mysqli = new mysqli('localhost', 'root', '', 'crudDB') or die(mysqli_error($mysqli));

if (isset($_POST['salvar'])) {

    $nome = $_POST['nome'];
    $e_mail = $_POST['e_mail'];
    $telefone = $_POST['telefone'];
    $sexo = $_POST['sexo'];
    $dataNasc = $_POST['dataNasc'];
    $obs = $_POST['obs'];

    $mysqli->query("
        INSERT INTO data (nome, e_mail, telefone, sexo, dataNasc, obs) 
        VALUES ('$nome', '$e_mail', '$telefone', '$sexo', '$dataNasc', '$obs')"
    ) or die($mysqli->error);
}   