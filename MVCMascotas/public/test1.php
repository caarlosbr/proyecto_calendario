<?php
/**
 * Archivo test para pruebas
 * @author  Carlos Borreguero Redondo
 */

// Requerimos los archivo de configuracion, y la clase Mascotas
require_once("../app/conf/config.php");
require_once("../app/Models/Mascotas.php");

// Creamos mascotas sin utilizar el patron de diseño
$mascota1 = new Mascotas();
$mascota2 = new Mascotas();

// Creamos mascotas utilizando el Singleton
$mascota3 = Mascotas::getInstancia();
$mascota = Mascotas::getInstancia();

// De esa forma solo se ha creado un objeto
$mascota -> setNombre("Rocky");
$mascota -> setPeso("24");
$mascota -> setRaza("Bichon Maltes");

$mascota->set();

$mascota -> get(30);




