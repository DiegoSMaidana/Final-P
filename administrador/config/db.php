<?php 
$host="localhost";
$db="ingresantes";
$usuario="root";
$contrasenia="";

try {
    $conexion=new PDO("mysql:host=$host;dbname=$db",$usuario,$contrasenia);
    //if($conexion){echo "Conectado .. a Sistema";}
} catch (Exception $ex) {
    echo $ex-> getMessage ();
    
}
?>