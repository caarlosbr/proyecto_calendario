<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivo de configuración</title>
    <style>
        body{
            background:black;
            color: white;
            
        }
        a{
            padding: 15px;
            color:white;
            text-decoration: none;
        }
        ul,li{


        }
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
    
    <h1>DWES Carlos Borreguero Redondo</h1>
    <?php
        $aEjercicios = array (
            "calendario" => array (
                "calendario.php")
        );
        
    foreach ($aEjercicios as $proyectos => $proyecto){
        foreach ($proyecto as $ejercicio){
            echo "<li><a href='http://192.168.1.89/proyectos_dwes/$proyectos/$ejercicio'>$proyectos - $ejercicio</a></li><br>";                          
        }                  
    }

    ?>
</body>
</html>