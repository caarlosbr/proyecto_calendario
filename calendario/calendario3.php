<?php
/**
 * Programa que muestra un calendario mensual. El mes y año se obtienen
 * desde un formulario. Los días festivos se resaltan con colores.
 * Cada día del calendario es un enlace que lleva a una función que muestra la fecha seleccionada.
 * 
 * @author Carlos Borreguero Redondo <a24boreca@iesgrancapitan.org>
 * @version 8.3.6
 * @date 2024-09-29
 */

include("conf/conf.php"); // Archivo de configuración que contiene los festivos

// Obtener el mes y el año del formulario, o usar el mes y año actual por defecto
$mesManual = isset($_POST['mes']) ? $_POST['mes'] : date('n');
$anioActual = isset($_POST['anio']) ? $_POST['anio'] : date('Y');

// Día actual
$diaActual = date('j');
$mesActual = date('n');

// Número de días del mes seleccionado
if ($mesManual == 1 || $mesManual == 3 || $mesManual == 5 || $mesManual == 7 || $mesManual == 8 || $mesManual == 10 || $mesManual == 12) {
    $totalDiasMes = 31; 
} elseif ($mesManual == 4 || $mesManual == 6 || $mesManual == 9 || $mesManual == 11) {
    $totalDiasMes = 30;
} elseif ($mesManual == 2) {
    if (($anioActual % 4 == 0 && $anioActual % 100 != 0) || ($anioActual % 400 == 0)) {
        $totalDiasMes = 29; 
    } else {
        $totalDiasMes = 28; 
    }
}

// Primer día del mes
$primerDiaMes = date('N', strtotime("$anioActual-$mesManual-01"));

$nombreMes = $meses[$mesManual - 1]; // Nombre del mes

// Función para mostrar la fecha seleccionada
function mostrarFecha($fecha) {
    echo "<h1>Has seleccionado la fecha: $fecha</h1>";
}

// Verificar si se ha enviado una fecha desde el enlace
if (isset($_GET['fecha'])) {
    $fechaSeleccionada = $_GET['fecha'];
    mostrarFecha($fechaSeleccionada);
    exit; // Salir después de mostrar la fecha
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <style>
        table {
            width: 90%;
            border-collapse: collapse;
            text-align: center;
        }
        th {
            background-color: #ddd;
        }
        th, td {
            border: 1px solid black;
            height: 50px;
        }
        td.vacio {
            border: none;
        }
        .festivo {
            background-color: red;
            color: white;
        }
        .hoy {
            background-color: green;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Formulario para seleccionar mes y año -->
    <form action="" method="post">
        <h3>Selecciona el mes y el año:</h3>
        <label for="mes">Mes</label>
        <input type="number" name="mes" min="1" max="12" value="<?= $mesManual ?>">    
        <label for="anio">Año</label>
        <input type="number" name="anio" value="<?= $anioActual ?>">
        <input type="submit" name="Enviar" value="Mostrar">
    </form>

    <!-- Mostrar el calendario -->
    <h1>Calendario de <?= $nombreMes ?> <?= $anioActual ?></h1>

    <table>
        <tr>
            <?php foreach ($diasSemana as $dia): ?>
                <th><?= $dia ?></th>
            <?php endforeach; ?>
        </tr>
        <tr>
        <?php
        $dia = 1;

        // Celda vacía si el primer día del mes no es lunes
        for ($i = 1; $i < $primerDiaMes; $i++) {
            echo "<td class='vacio'></td>";
        }

        // Crear el calendario
        while ($dia <= $totalDiasMes) {
            $fecha = "$mesManual-$dia";
            $esFestivo = in_array($fecha, $festivos);
            $esHoy = ($dia == $diaActual && $mesManual == $mesActual);
            $esDomingo = (date('N', strtotime("$anioActual-$mesManual-$dia")) == 7); // Comprobar si es domingo

            // Asignar clase de acuerdo a si es festivo, domingo o el día actual
            $clase = '';
            if ($esFestivo || $esDomingo) {
                $clase = 'festivo';
            } elseif ($esHoy) {
                $clase = 'hoy';
            }

            // Mostrar el día como enlace
            echo "<td class='$clase'><a href='?fecha=$dia-$mesManual-$anioActual'>$dia</a></td>";

            // Nueva fila después de cada domingo
            if (($primerDiaMes + $dia - 1) % 7 == 0) {
                echo "</tr><tr>";
            }

            $dia++;
        }

        // Rellenar celdas vacías al final de la tabla
        while (($primerDiaMes + $dia - 2) % 7 != 0) {
            echo "<td class='vacio'></td>";
            $dia++;
        }
        ?>
        </tr>
    </table>

</body>
</html>
