<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./co.png" type="image/png">
    <link rel="stylesheet" href="consulta.css">
    <title>Encontrar Evento</title>
</head>
<body>
    <h1>Encontrar Evento</h1>
    
    <form action="" method="POST">
        <fieldset>
            <legend>Encontrar Evento</legend>
            <table>
                <tr>
                    <td>ID do Evento:</td>
                    <td><input type="number" name="id" required /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="Procurar" value="Procurar" />
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

    if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['Procurar'] === "Procurar") {
        $id = $_POST["id"];
        $query = "SELECT * FROM eventos WHERE id='$id'";
        $resu = mysqli_query($conexao, $query);

        if ($resu && mysqli_num_rows($resu) > 0) {
            echo "<div class='event-container'>";
            while ($escrever = mysqli_fetch_array($resu)) {
                echo "<div class='event-card'>
                    <h2>{$escrever['nome_do_evento']}</h2>
                    <p><strong>Cód Evento:</strong> {$escrever['id']}</p>
                    <p><strong>Data:</strong> {$escrever['data_do_evento']}</p>
                    <p><strong>Horário de Início:</strong> {$escrever['hora_de_inicio']}</p>
                    <p><strong>Horário de Término:</strong> {$escrever['hora_de_termino']}</p>
                    <p><strong>Descrição:</strong> {$escrever['desc_event']}</p>
                    <p><strong>Local:</strong> {$escrever['local_event']}</p>
                    <p><strong>Responsável:</strong> {$escrever['resp_event']}</p>
                </div>";
            }
            echo "</div>";
        } else {
            echo "<p>Evento não encontrado.</p>";
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