<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./ca.png" type="image/png">
    <link rel="stylesheet" href="c.css">
    <title>Cadastrar Evento</title>
</head>
<body>
    <h1>Cadastro de Eventos</h1>
    <div class="body-content">
        <form action="" method="POST">
            <fieldset>
                <legend>Insira os dados do evento que deseja criar</legend>
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
                <input type="submit" value="Cadastrar Evento">
            </fieldset>
        </form>

        <center><h2>Eventos Cadastrados</h2></center>
        <?php
        $host = "localhost"; 
        $user = "root";
        $pass = "";
        $base = "agenda";
        $conexao = mysqli_connect($host, $user, $pass, $base);
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = mysqli_real_escape_string($conexao, $_POST["id"]);
            $nome = mysqli_real_escape_string($conexao, $_POST["nme"]);
            $data = mysqli_real_escape_string($conexao, $_POST["dte"]);
            $init = mysqli_real_escape_string($conexao, $_POST["hdi"]);
            $term = mysqli_real_escape_string($conexao, $_POST["hdt"]);
            $desc = mysqli_real_escape_string($conexao, $_POST["desc"]);
            $local = mysqli_real_escape_string($conexao, $_POST["lcl"]);
            $resp = mysqli_real_escape_string($conexao, $_POST["rese"]);

            $input = mysqli_query($conexao, "INSERT INTO eventos (id, nome_do_evento, data_do_evento, hora_de_inicio, hora_de_termino, desc_event, local_event, resp_event) VALUES ('$id', '$nome', '$data', '$init', '$term', '$desc', '$local', '$resp')");
        
            if ($input) {
                echo "<center><h2>Evento cadastrado com sucesso!</h2></center>";
            } else {
                echo "<p>Error: " . mysqli_error($conexao) . "</p>";
            }
        }

        $resu = mysqli_query($conexao, "SELECT * FROM eventos");

        if (mysqli_num_rows($resu) > 0) {
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
            echo "<p>Nenhum evento encontrado.</p>";
        }

        mysqli_close($conexao);
        ?>
        
    </div>
    <div><center class= "cen"><a href='index.php'>HOME</a></center></div>
    <footer>
        Copyright 2024 © - Events™ 
    </footer>
</body>
</html>
