<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crudDB') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$nome = '';
$e_mail = '';
$telefone = '';
$sexo = 'Selecione';
$dataNasc = '';
$obs = '';

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

    $_SESSION['message'] = "Usuário cadastrado!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}   

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Usuário deletado!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $resultado = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

    $row = $resultado->fetch_array();
    $nome = $row['nome'];
    $e_mail = $row['e_mail'];
    $telefone = $row['telefone'];
    $sexo = $row['sexo'];
    $dataNasc = $row['dataNasc'];
    $obs = $row['obs'];
}

if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $e_mail = $_POST['e_mail'];
    $telefone = $_POST['telefone'];
    $sexo = $_POST['sexo'];
    $dataNasc = $_POST['dataNasc'];
    $obs = $_POST['obs'];

    $mysqli->query("
        UPDATE data SET
        nome='$nome',
        e_mail='$e_mail',
        telefone='$telefone',
        sexo='$sexo',
        dataNasc='$dataNasc',
        obs='$obs'
        WHERE id=$id"
    ) or die($mysqli->error);

    $_SESSION['message'] = "Usuário atualizado!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}