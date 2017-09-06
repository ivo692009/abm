<?php
session_start();

if(!isset($_SESSION['username'])){
        echo 'Usted no esta Logeado';
        ?>
        <html><a href="../index.php">volver al inicio</a><br><br></html>
        <?php
        die();
}

require __DIR__ . '/usuario.php';
error_reporting(E_ALL);
ini_set("display_errors", true);
header('Content-Type: text/html; charset=UTF-8');

try {
    //Coneccion con la base de datos
    $pdo = new PDO('mysql:host=localhost;dbname=clientes_db', $usuario, $contraseña);

    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES UTF8");

    //Armado de SQL
    $sql = "SELECT * FROM nacionalidades";

    //preparamos un statement con el sql anterior
    $stmt = $pdo->prepare($sql);

    //especificamos la salida como un array
    $stmt->setFetchMode(PDO::FETCH_OBJ); //podria ser PDO::FETCH_OBJ
    //ejecutamos la consulta
    $stmt->execute();

    //recuperamos los datos en el array asoc.
    $n = $stmt->fetchAll();
} catch (PDOException $e) {
    echo 'Error de la coneccion a la BD:' . $e->getMessage();
}
