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

?>

