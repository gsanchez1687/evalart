<?php
function imprimirX($n) {
    if ($n == 0) {
        echo "ERROR";
        return;
    }

    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            if ($j == $i || $j == ($n - $i - 1)) {
                echo "X";
            } else {
                echo "_";
            }
        }
        echo "\n";
    }
}
$n = 5;
imprimirX($n);


$myArray = array(1,2,2,4,5,6,7,8,8,8);

$long = $myArray[0];
$longestLength = 1;
$current = $myArray[0];
$currentLength = 1;

for ($i = 1; $i < count($myArray); $i++) {
    if ($myArray[$i] == $current) {
        $currentLength++;
    } else {
        if ($currentLength > $longestLength) {
            $long = $current;
            $longestLength = $currentLength;
        }
        $current = $myArray[$i];
        $currentLength = 1;
    }
}

if ($currentLength > $longestLength) {
    $long = $current;
    $longestLength = $currentLength;
}

echo "Longest: $longestLength\n";
echo "Number: $long\n";


function encontrarCaminoMinimo($array) {
    // Convertimos el array unidimensional a una matriz 3x3
    $matriz = [];
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            $matriz[$i][$j] = $array[$i * 3 + $j];
        }
    }
    
    // Función para encontrar el mínimo camino
    function camino($matriz, $fila, $columna, $cache) {
        if ($columna == 2) { // Si estamos en la última columna
            return [$matriz[$fila][$columna], [$matriz[$fila][$columna]]];
        }
        
        if (isset($cache[$fila][$columna])) {
            return $cache[$fila][$columna];
        }
        
        $movimientos = [];
        if ($fila > 0) $movimientos[] = [$fila - 1, $columna + 1]; // Arriba a la derecha
        $movimientos[] = [$fila, $columna + 1]; // Derecha
        if ($fila < 2) $movimientos[] = [$fila + 1, $columna + 1]; // Abajo a la derecha
        
        $minSum = PHP_INT_MAX;
        $minCamino = [];
        
        foreach ($movimientos as $movimiento) {
            list($suma, $camino) = camino($matriz, $movimiento[0], $movimiento[1], $cache);
            $suma += $matriz[$fila][$columna];
            
            if ($suma < $minSum) {
                $minSum = $suma;
                $minCamino = array_merge([$matriz[$fila][$columna]], $camino);
            }
        }
        
        return $cache[$fila][$columna] = [$minSum, $minCamino];
    }
    
    $resultado = [PHP_INT_MAX, []];
    
    for ($i = 0; $i < 3; $i++) {
        list($suma, $camino) = camino($matriz, $i, 0, []);
        if ($suma < $resultado[0]) {
            $resultado = [$suma, $camino];
        }
    }
    
    // Imprimimos la ruta con la menor suma
    echo implode(' ', $resultado[1]);
}

$myArray = array(1, 2, 9, 2, 5, 3, 5, 1, 5);
encontrarCaminoMinimo($myArray);


function checkQuestionMark($string) {
    $longitud = strlen($string);
    $num = [];
    for ($i = 0; $i < $longitud; $i++) {
        if (is_numeric($string[$i])) {
            $actual = intval($string[$i]);
            if (!empty($num)) {
                foreach ($num as $preview) {
                    if ($actual + $preview['numero'] == 10) {
                        $signosInterrogacion = substr_count($string, '?', $preview['posicion'] + 1, $i - $preview['posicion'] - 1);
                        if ($signosInterrogacion != 3) {
                            return "false";
                        }
                    }
                }
            }
            $num[] = ['numero' => $actual, 'posicion' => $i];
        }
    }
    
    foreach ($num as $preview) {
        foreach ($num as $actual) {
            if ($actual['posicion'] > $preview['posicion'] && $actual['numero'] + $preview['numero'] == 10) {
                return "true";
            }
        }
    }
    
    return "false";
}

echo checkQuestionMark("aa6?9");
echo "\n";
echo checkQuestionMark("acc?7??sss?3rr1??????5");
echo "\n";
echo checkQuestionMark("arrb6???4xxbl5???eee5");


function sumMinMaxMatriz($matriz) {
    $min = $matriz[0][0];
    $max = $matriz[0][0];
    foreach ($matriz as $fila) {
        foreach ($fila as $numero) {
            if ($numero < $min) {
                $min = $numero;
            }
            if ($numero > $max) {
                $max = $numero;
            }
        }
    }
    $suma = $min + $max;
    echo "La suma del número mínimo y máximo es: " . $suma;
}

// Ejemplo de uso
$matriz = [
    [2, 5, 4],
    [6, 2, 11],
    [10, 22, 45]
];
echo "\n";
sumMinMaxMatriz($matriz);



function calcularComision($ventas, $meta) {
    $cumplimiento = ($ventas / $meta) * 100;
    $Comision = 0;

    if ($cumplimiento <= 100) {
        $Comision = $cumplimiento;
    } else {
        if ($cumplimiento > 120 && $cumplimiento <= 125) {
            $Comision = 102;
        } elseif ($cumplimiento > 125 && $cumplimiento <= 130) {
            $Comision = 103;
        } elseif ($cumplimiento > 130 && $cumplimiento <= 149) {
            $Comision = 104;
        } elseif ($cumplimiento > 149) {
            $Comision = 105;
        }
    }

    $comisionFinal = ($Comision / 100) * $ventas;
    return $comisionFinal;
}
echo calcularComision(100, 80);


//SELECT e.nombre, COUNT(p.id) AS partidos_visitante
//FROM equipos.equipos e
//JOIN equipos.partidos p ON e.id = p.equipo_visitante
//GROUP BY e.nombre
//HAVING COUNT(p.id) > 5;

?>