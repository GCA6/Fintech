<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
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
            if ($s->id) { $valor_final = $aporte_inicial;
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
                    
                    
    
                    // $meses[] = $i;
                    // $aplicacao[] = number_format($aporte_mensal, 2, ',', '.');
                    // $rendimento_total[] = number_format($rendimento_mes, 2, ',', '.');
                    // $total[] = number_format($valor_final, 2, ',', '.');
    
                    echo "<tr><td>$i</td><td>$aplicacao</td><td>$rendimento_mes</td><td>$valor_final</td></tr>";
                }
                echo '</table>';}}


        ?>

        <a class="icon_home" href="index.html"><i class="uil uil-estate"></i></a>
    </main>

    <footer>
        <p>&copy;2023 - GC&AT</p>
    </footer>
</body>

</html>