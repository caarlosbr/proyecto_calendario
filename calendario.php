<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        /**
         * Programa que dado el mes y año almacenados en variables, escribir un programa que muestre el
         * calendario mensual correspondiente. Marcar el día actual en verde y los festivos
         * en rojo.
         *
         * @author Carlos Borreguero Redondo <a24boreca@iesgrancapitan.org>
         * @version 8.3.6
         * @date 2024-09-29
         */
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio5</title>
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

<?php
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    $diasSemana = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];

    $mesManual = 9;  
    $anioActual = date('Y'); 

    $festivos = [
        '1-1',   // 1 de enero-Año Nuevo
        '1-6',   // 6 de enero-Epifanía del Señor
        '3-29',  // 29 de marzo-Viernes Santo
        '5-1',   // 1 de mayo-Fiesta del Trabajo
        '8-15',  // 15 de agosto-Asunción de la Virgen
        '10-12', // 12 de octubre-Fiesta Nacional de España
        '11-1',  // 1 de noviembre Todos los Santos
        '12-6',  // 6 de diciembre-Día de la Constitución
        '12-25'  // 25 de diciembre-Navidad
    ];

    $diaActual = date('j');
    $mesActual = date('n');

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
    /* Esto lo he tenido que buscar, toma una fecha en forma de cadena, 
    ejemplo --> si hoy fuera 01/09/2024, genera en este caso "2024-09-01"
    */
    $primerDiaMes = date('N', strtotime("$anioActual-$mesManual-01"));


    $nombreMes = $meses[$mesManual - 1]; 
    echo "<h1>Calendario de $nombreMes $anioActual</h1>";

    echo "<table>";
    echo "<tr>";

    foreach ($diasSemana as $dia) {
        echo "<th>$dia</th>";
    }
    echo "</tr>";

    $dia = 1;
    echo "<tr>";

    for ($i = 1; $i < $primerDiaMes; $i++) {
        echo "<td class='vacio'></td>";
    }


    while ($dia <= $totalDiasMes) {

        $esFestivo = in_array("$mesManual-$dia", $festivos);


        $esHoy = ($dia == $diaActual && $mesManual == $mesActual);

        $clase = '';
        if ($esFestivo) {
            $clase = 'festivo';
        } elseif ($esHoy) {
            $clase = 'hoy';
        }

        echo "<td class='$clase'>$dia</td>";

        if (($primerDiaMes + $dia - 1) % 7 == 0) {
            echo "</tr><tr>";
        }

        $dia++;
    }

    while (($primerDiaMes + $dia - 2) % 7 != 0) {
        echo "<td class='vacio'></td>";
        $dia++;
    }

    echo "</tr>";
    echo "</table>";
?>

</body>
</html>
