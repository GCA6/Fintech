<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <title>Fintech - Simulação de Investimento</title>
</head>

<body>
    <header>
        <h1>Desenvolvimento Web</h1>
        <h2>Simulação de Investimento</h2>
    </header>
    <main>
        <?php
        require_once 'classes/autoloader.class.php';
        R::setup('mysql:host=127.0.0.1;dbname=fintech', 'root', '');


        if (
            isset($_GET['cliente'])
            && isset($_GET['aporte_inicial'])
            && isset($_GET['aporte_mensal'])
            && isset($_GET['rendimento'])
            && isset($_GET['periodo'])
        ) {
            $cliente = $_GET['cliente'];
            $aporte_inicial = floatval($_GET['aporte_inicial']);
            $aporte_mensal = floatval($_GET['aporte_mensal']);
            $rendimento = floatval($_GET['rendimento']);
            $periodo = floatval($_GET['periodo']);




            $valor_final = $aporte_inicial;
            echo '<table>';
            echo '<tr><th>Mês</th><th>Aplicação (R$)</th><th>Rendimento (R$)</th><th>Total (R$)</th></tr>';
            for ($i = 1; $i <= $periodo; $i++) {
                if($i == 1){
                    $rendimento_mes = number_format (($valor_final) * ($rendimento / 100), 2);
                    
                    $valor_final = $valor_final + $rendimento_mes;
                    $aplicacao = $aporte_inicial;
                    
                }
                else{
                    $rendimento_mes = number_format (($valor_final + $aporte_mensal) * ($rendimento / 100), 2);
                    $aplicacao = $valor_final;
                    $valor_final = $valor_final + $aporte_mensal + $rendimento_mes;
                    
                }
                

                echo "<tr><td>$i</td><td>$aplicacao</td><td>$rendimento_mes</td><td>$valor_final</td></tr>";
            }
            echo '</table>';


   
        } else {
            echo '<p>Preencha o formulário de simulação corretamente.</p>';
        }
        $s = R::dispense('simulacao');

        $s->cliente = $cliente;
        $s->aporte_inicial = number_format($aporte_inicial, 2, '.', '');
        $s->aporte_mensal = number_format($aporte_mensal, 2, '.', '');
        $s->rendimento = number_format($rendimento, 2, '.', '');
        $s->periodo = $periodo;
        $s = Util::rendimento($aporte_inicial, $aporte_mensal, $rendimento, $periodo);

        $id = R::store($s);
        $feedback_message = "A simulação foi salva sob o ID: $id";



        R::close();
        ?>

        <a class="icon_home" href="index.html"><i class="uil uil-estate"></i></a>
    </main>
    <footer>
        <p>&copy;2023 - GC&AT</p>
    </footer>
</body>

</html>