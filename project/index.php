<!doctype html>
<html lang="pt-br">

    <head>
        <title>Superbiz Proj</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style>
            .form-group {width: 500px};
        </style>

    </head>

    <body>

        <?php require_once 'process.php' ?>

        <?php
            
            if (isset($_SESSION['message'])): ?>

            <div class="alert alert-<?=$_SESSION['msg_type']?>">

            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?> 
            </div>
            <?php endif ?>

        <div class="container">

            <?php
                $mysqli = new mysqli('localhost','root','','crudDB') or die(mysqli_error($mysqli));
                $resultado = $mysqli->query("SELECT * FROM data") or die($mysqli->error);

                if (isset($_POST['busca']) && ($_POST['busca'] != '')):
                    $busca = $_POST['busca'];
                    $resultado = $mysqli->query(
                        "SELECT * FROM data WHERE (nome LIKE '%".$busca."%') OR (e_mail LIKE '%".$busca."%')"
                    ) or die($mysqli->error);
                ?>
                    <h1>Resultados da busca:</h1>
                    <a href="index.php" class="navbar-link">Voltar</a>      
                <?php endif; ?>

                <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nomes</th>
                                <th>E-mails</th>
                                <th>Telefones</th>
                                <th colspan="2">Opções</th>
                            </tr>
                        </thead>

                <?php
                    while ($row = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['e_mail']; ?></td>
                            <td><?php echo $row['telefone']; ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id']; ?>"
                                class="btn btn-info">Editar</a>
                                <a href="process.php?delete=<?php echo $row['id']; ?>" 
                                class="btn btn-danger">Apagar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </table>
                </div>

                <?php

                function pre_r($array) {
                    echo '<pre>';
                    print_r($array);
                    echo '</pre>';
                }
            ?>

            <div class="row justify-content-center">
                <form action="index.php" method="POST">
                    <div class="form-group">
                        <label for="busca">Pesquisa:</label>
                        <input type="text" name="busca" class="form-control" placeholder="Busque por nome ou email.">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </div>

            <div class="row justify-content-center">
                <form action="process.php" method="POST">
                    <input type="hidden" name="id" value=<?php echo $id; ?>>
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" class="form-control" 
                            value="<?php echo $nome; ?>" placeholder="Insira seu nome.">
                    </div>
                    <div class="form-group">
                        <label for="e_mail">E-mail:</label>
                        <input type="email" name="e_mail" class="form-control" 
                            value="<?php echo $e_mail; ?>" placeholder="Insira seu e-mail.">
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" class="form-control" 
                            value="<?php echo $telefone; ?>" placeholder="Insira seu telefone.">
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select name="sexo" id="sexo" class="form-control">
                            <option value="<?php echo $sexo; ?>"><?php echo $sexo; ?></option>
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dataNasc">Data de Nascimento</label>
                        <input type="date" name="dataNasc" class="form-control" 
                            value="<?php echo $dataNasc; ?>">

                    </div>
                    <div class="form-group">
                        <label for="obs">Observações:</label>
                        <input type="text" name="obs" class="form-control" 
                            value="<?php echo $obs; ?>" placeholder="Insirir observações.">
                    </div>
                    <div class="form-group">
                    <?php 
                    if ($update == true):
                    ?>
                        <button type="submit" name="atualizar"class="btn btn-info">Atualizar</button>
                    <?php else: ?>
                        <button type="submit" name="salvar"class="btn btn-primary">Salvar</button>
                    <?php endif; ?>
                    </div>
                </form>
            </div>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </div>
    </body>

</html>