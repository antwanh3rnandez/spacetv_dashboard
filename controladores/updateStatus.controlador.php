<?php

require_once('../modelos/conexion.php');

$status = $_GET['status'];
$id = $_GET['id'];

$stmt = Conexion::conectar()->prepare("UPDATE peticiones SET estado=:estado WHERE id=:id");
$stmt->bindParam(':estado', $status);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    $export['data'] = "$status";
    echo json_encode($export);
}else {
    print_r(Conexion::conectar()->errorInfo());
}

?>