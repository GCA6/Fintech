<?php
class Util {
    public static function rendimento($aporte_inicial, $periodo, $rendimento_mensal, $aporte_mensal)
    {
        $total = $aporte_inicial;
        $dados = array();
        for ($i = 1; $i <= $periodo; $i++) {
            $aporte = ($i == 1) ? 0 : $aporte_mensal;
            $rendimento = ($total + $aporte) * ($rendimento_mensal / 100);
            $total += $aporte + $rendimento;
            $dados[] = array('mes' => $i, 'inicial' => $aporte_inicial, 'aporte' => $aporte, 'rendimento' => $rendimento, 'total' => $total);
        }
        return array('dados' => $dados, 'total' => $total);
    }

}