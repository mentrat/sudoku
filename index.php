<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="resolver.php" method="post">
        <table>
            <?php
            function iterafondo($fondo){
                if($fondo == "fondo"){
                    return;
                } else {
                    return "fondo";
                }
            }


            $fondo = "fondo";
            for ($f = 0; $f < 9; $f++) {
                
                if($f % 3 == 0 && $f > 0){
                    $fondo = iterafondo($fondo);
                }
                echo "<tr>";
                for ($c = 0; $c < 9; $c++) {
                    if($c % 3 == 0 && $c > 0){
                        $fondo = iterafondo($fondo);
                    }
                    echo "<td><input class='{$fondo}' type='number' name='n[]' min='1' max='9'></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
        <div class="centrar">
            <input type="submit" value="Resolver">
        </div>
    </form>



</body>

</html>