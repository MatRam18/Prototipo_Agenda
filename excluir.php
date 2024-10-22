<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./del.png" type="image/png">
    <link rel="stylesheet" href="excluir.css">
    <title>Deletar Evento</title>
</head>
<body>
    <h1>Deletar Evento</h1>
    
    <form action="" method="POST">
        <fieldset>
            <legend>Deletar Evento</legend>
            <table>
                <tr>
                    <td>ID do Evento:</td>
                    <td><input type="number" name="delete_id" required /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="Deletar" value="Deletar" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

    <?php
    $host = "localhost"; 
    $user = "root";
    $pass = "";
    $base = "Agenda";
    $conexao = mysqli_connect($host, $user, $pass, $base);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Deletar'])) {
        $delete_id = $_POST["delete_id"];
        $delete_query = "DELETE FROM eventos WHERE id='$delete_id'";
        
        if (mysqli_query($conexao, $delete_query)) {
            echo "<p class='success-message'>Evento deletado com sucesso.</p>";
        } else {
            echo "<p>Erro ao deletar evento: " . mysqli_error($conexao) . "</p>";
        }
    }

    mysqli_close($conexao);
    ?>
    <center class= "cen"><a href='index.php'>HOME</a></center>
    <footer>
        Copyright 2024 © - Events™ 
    </footer>
</body>
</html>
