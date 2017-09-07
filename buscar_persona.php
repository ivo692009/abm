<?php 

	require "usuario.php";
	error_reporting(E_ALL);
	ini_set("display_errors", true);

	try {
	    //Coneccion a la base de datos
	    $pdo = new PDO('mysql:host=localhost;dbname=clientes_db', $usuario, $contraseña);
	    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $pdo->exec("SET NAMES UTF8");
	    //armamos el SQL
	    $sql = "SELECT * FROM `clientes` WHERE id=:id";
	    //preparamos un statement con el sql anterior
	    $stmt = $pdo->prepare($sql);
	    //especificamos la salida como un array
	    $stmt->setFetchMode(PDO::FETCH_OBJ); //podria ser PDO::FETCH_OBJ
	    //sustituimos los parametros con los valores reales
	    $stmt->bindParam(':id', $id);
	    //ejecutamos la consulta
	    $stmt->execute();
	     //recuperamos los datos en el array asoc.
		$persona = $stmt->fetchAll();
	} catch (PDOException $e) {
	    echo 'Error de la coneccion a la BD:' . $e->getMessage();
	    die();
	}