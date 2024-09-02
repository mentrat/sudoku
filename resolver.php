<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    function resolver($sudoku)
    {
        static $resuelto = false;
        for ($f = 0; $f < 9; $f++) {
            for ($c = 0; $c < 9; $c++) {
                if ($sudoku[$f][$c] == "") {
                    $encuentra = true;
                    for ($n = 1; $n <= 9; $n++) {
                        $encuentra = comprobar($sudoku, $f, $c, $n);
                        if ($encuentra == false) {
                            $sudoku[$f][$c] = $n;
                            $sudoku = resolver($sudoku);
                            if ($resuelto == true) {
                                return $sudoku;
                            }
                        }
                    }
                    $sudoku[$f][$c] = "";
                    return $sudoku;
                }
            }
        }
        $resuelto = true;
        return $sudoku;
    }

    function comprobar($sudoku, $fila, $columna, $numero)
    {
        //fila
        for ($c = 0; $c < 9; $c++) {
            if ($sudoku[$fila][$c] == $numero) {
                return true;
            }
        }

        //columna
        for ($f = 0; $f < 9; $f++) {
            if ($sudoku[$f][$columna] == $numero) {
                return true;
            }
        }

        //cuadrante
        $f1 = $fila - ($fila % 3);
        $c1 = $columna - ($columna % 3);
        for ($f = $f1; $f < $f1 + 3; $f++) {
            for ($c = $c1; $c < $c1 + 3; $c++) {
                if ($sudoku[$f][$c] == $numero) {
                    return true;
                }
            }
        }
        return false;
    }




    function pintarSudoku($sudoku, $sudokuResuelto)
    {
        function iterafondo($fondo)
        {
            if ($fondo == "fondo") {
                return;
            } else {
                return "fondo";
            }
        }
        echo "<table>";
        $fondo = "fondo";
        for ($f = 0; $f < 9; $f++) {
            if ($f % 3 == 0 && $f > 0) {
                $fondo = iterafondo($fondo);
            }
            echo "<tr>";
            for ($c = 0; $c < 9; $c++) {
                if ($c % 3 == 0 && $c > 0) {
                    $fondo = iterafondo($fondo);
                }
                $estaba = "";
                if ($sudoku[$f][$c] != "") {
                    $estaba = "estaba";
                }
                echo "<td class='{$fondo} {$estaba}'>{$sudokuResuelto[$f][$c]}</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }


    $sudoku = [];
    $fila = 0;
    $columna = 0;
    if (count($_POST) > 0) {
        $array = $_POST['n'];
        foreach ($array as $key => $value) {
            $sudoku[$fila][$columna++] = $value;
            if ($columna == 9) {
                $fila++;
                $columna = 0;
            }
        }
    }


    $sudokuResuelto = resolver($sudoku);
    pintarSudoku($sudoku, $sudokuResuelto);

    ?>


    <div class="centrar">
        <a href="index.php">Resolver Otro</a>
    </div>





</body>

</html>