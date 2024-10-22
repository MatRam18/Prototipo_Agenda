<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./all.png" type="image/png">
    <title>Lista de Eventos</title>
    <link rel="stylesheet" href="list.css">
</head>
<body>
    <h1>Lista de Eventos</h1>

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

        $query = "SELECT * FROM eventos";
        $resu = mysqli_query($conexao, $query);

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

    <div class="cen"><a href='index.php'>HOME</a></div>
    <footer>
        Copyright 2024 © - Events™ 
    </footer>
</body>
</html>
