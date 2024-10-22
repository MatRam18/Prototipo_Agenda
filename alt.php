<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./upd.png" type="image/png">
    <link rel="stylesheet" href="alt.css">
    <title>Atualizar Evento</title>
</head>
<body>
<div class="body-content">
    <h1>Atualizar Evento</h1>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
        echo "<p class='success-message'>Evento atualizado com sucesso!</p>";
    }
    ?>

    <form action="" method="POST">
        <fieldset>
            <legend>Insira os dados do evento que deseja atualizar</legend>
            <table>
                <tr>
                    <td>ID do Evento:</td>
                    <td><input type="number" name="id" required></td>
                </tr>
                <tr>
                    <td>Nome do Evento:</td>
                    <td><input type="text" name="nme" required></td>
                </tr>
                <tr>
                    <td>Data do Evento:</td>
                    <td><input type="date" name="dte" required></td>
                </tr>
                <tr>
                    <td>Horário de Início:</td>
                    <td><input type="time" name="hdi" required></td>
                </tr>
                <tr>
                    <td>Horário do Término:</td>
                    <td><input type="time" name="hdt" required></td>
                </tr>
                <tr>
                    <td>Descrição do Evento:</td>
                    <td><input type="text" name="desc" required></td>
                </tr>
                <tr>
                    <td>Local do Evento:</td>
                    <td><input type="text" name="lcl" required></td>
                </tr>
                <tr>
                    <td>Responsável pelo Evento:</td>
                    <td><input type="text" name="rese" required></td>
                </tr>
            </table>
            <input type="submit" name="update" value="Atualizar">
        </fieldset>
    </form>

    <center><h2>Eventos Cadastrados que podem ser atualizados ou já foram atualizados</h2></center>
    <div class="event-container">
        <?php
        $host = "localhost"; 
        $user = "root";
        $pass = "";
        $base = "Agenda";
        $conexao = mysqli_connect($host, $user, $pass, $base);

        if (!$conexao) {
            die("Conexão falhou: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
            $id = mysqli_real_escape_string($conexao, $_POST["id"]);
            $nome = mysqli_real_escape_string($conexao, $_POST["nme"]);
            $data = mysqli_real_escape_string($conexao, $_POST["dte"]);
            $init = mysqli_real_escape_string($conexao, $_POST["hdi"]);
            $term = mysqli_real_escape_string($conexao, $_POST["hdt"]);
            $desc = mysqli_real_escape_string($conexao, $_POST["desc"]);
            $local = mysqli_real_escape_string($conexao, $_POST["lcl"]);
            $resp = mysqli_real_escape_string($conexao, $_POST["rese"]);

            $update_query = "UPDATE eventos SET 
                nome_do_evento = '$nome', 
                data_do_evento = '$data', 
                hora_de_inicio = '$init', 
                hora_de_termino = '$term', 
                desc_event = '$desc', 
                local_event = '$local', 
                resp_event = '$resp' 
                WHERE id = '$id'";

            if (mysqli_query($conexao, $update_query)) {
            } else {
                echo "<p>Error: " . mysqli_error($conexao) . "</p>";
            }
        }

        $resu = mysqli_query($conexao, "SELECT * FROM eventos");
        
        if ($resu && mysqli_num_rows($resu) > 0) {
            while ($escrever = mysqli_fetch_array($resu)) {
                echo "<div class='event-card'>
                    <h2>{$escrever['nome_do_evento']}</h2>
                    <p><strong>Cód Evento:</strong> {$escrever['id']}</p>
                    <p><strong>Data:</strong> {$escrever['data_do_evento']}</p>
                    <p><strong>Horário:</strong> {$escrever['hora_de_inicio']} - {$escrever['hora_de_termino']}</p>
                    <p><strong>Descrição:</strong> {$escrever['desc_event']}</p>
                    <p><strong>Local:</strong> {$escrever['local_event']}</p>
                    <p><strong>Responsável:</strong> {$escrever['resp_event']}</p>
                </div>";
            }
        } else {
            echo "<p>Nenhum evento encontrado.</p>";
        }

        mysqli_close($conexao);
        ?>
    </div>

    <center class="cen"><a href='index.php'>HOME</a></center>
</div>
<footer>
     Copyright 2024 © - Events™ 
</footer>
</body>
</html>
