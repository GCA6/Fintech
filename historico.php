<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>Fintech</title>
</head>

<body>
    <header>
        <h1> Desenvolvimento Web </h1>
        <h2> Histórico </h2>
    </header>

    <main>
        <form action="" method="post">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id">
            <input type="submit" value="Recuperar">
        </form>
        <?php
        require_once 'classes/autoloader.class.php';
        R::setup('mysql:host=127.0.0.1;dbname=fintech', 'root', '');

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $s = R::load('simulacao', $id);

            if ($s->id) {
        ?>
                <div class="dados" id="resultado">
                    <h3>ID: <?php echo $id; ?><h3>
                    <h3>Nome: <?php echo $s->cliente; ?></h3>
                    
                </div>

                <table>
                    <tr>
                        <th>Mês</th>
                        <th>Aplicação (R$)</th>
                        <th>Rendimento (R$)</th>
                        <th>Total (R$)</th>
                    </tr>
                    <?php
                    $valor_final = $s->aporte_inicial;
                    $mes = $s->periodo;
                    $rendimento = $s->rendimento;
                    $aporte_mensal = $s->aporte_mensal;

                    for ($i = 1; $i <= $mes; $i++) {
                        if ($i == 1) {
                            $rendimento_mes = number_format(($valor_final) * ($rendimento / 100), 2);
                            $valor_final = $valor_final + $rendimento_mes;
                            $aplicacao = $s->aporte_inicial;
                        } else {
                            $rendimento_mes = number_format(($valor_final + $aporte_mensal) * ($rendimento / 100), 2);
                            $aplicacao = $valor_final;
                            $valor_final = $valor_final + $aporte_mensal + $rendimento_mes;
                        }

                        echo "<tr><td>$i</td><td>$aplicacao</td><td>$rendimento_mes</td><td>$valor_final</td></tr>";
                    }
                    ?>
                </table>
        <?php
            } else {
                echo '<p class="id-invalida">ID de simulação inexistente.</p>';
            }
        }
        ?>
        <a class="icon_home" href="index.html"><i class="uil uil-estate"></i></a>
    </main>

    <footer>
        <p>&copy;2023 - GC&AT</p>
    </footer>
</body>

</html>
