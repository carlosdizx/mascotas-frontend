<?php
include_once("index.php");

// Consulta todos los registros de la tabla mascotas de un usuario dado su id
if (isset($_GET["all_propietario"])){
    $id = $_GET["all_propietario"];
    $query = "SELECT m.id,m.nombre,m.edad,m.procedimiento,m.raza,m.ruta_foto,tm.nombre as tipo
FROM mascotas m INNER JOIN tipo_mascotas tm on m.tipo = tm.id
WHERE m.dueño = '$id'";
    $sql = mysqli_query($conexionBD,$query );
    if (!$sql){
        echo json_encode([["mensaje"=>"No hay datos"]]);
    }
    else{
        $mascotas = mysqli_fetch_all($sql,MYSQLI_ASSOC);
        echo json_encode([$mascotas]);
    }
}

//Insertar una nueva mascota
if (isset($_GET["insertar"])){
    $imagen	=	$_FILES['imagen']['name'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $raza = $_POST['raza'];
    $procedimiento = $_POST['procedimiento'];
    $tipo = $_POST['tipo'];
    $dueño = $_POST['dueño'];

    $target_dir="C:/xampp/htdocs/mascotas/img/";
    $target_file=$target_dir.basename($imagen);
    move_uploaded_file($_FILES['imagen']['tmp_name'],$target_file);

    $query = "INSERT INTO mascotas (nombre, ruta_foto, edad, raza, procedimiento, tipo, dueño)
            VALUES ('$nombre','$target_file','$edad','$raza','$procedimiento','$tipo','$dueño');";

    $sql = mysqli_query($conexionBD,$query);
    if (!$sql){
        echo json_encode(["mensaje"=>"No se puede registrar, ".$conexionBD->error]);
        exit();
    }
    else {
        echo json_encode(["mensaje"=>"registro exitoso"]);
    }
}