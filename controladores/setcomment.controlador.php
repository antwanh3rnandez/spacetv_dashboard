<?php

require_once('../modelos/conexion.php');

$comment = $_GET['comment'];
$id = $_GET['id'];

$stmt = Conexion::conectar()->prepare("UPDATE peticiones SET comentario=:comentario WHERE id=:id");
$stmt->bindParam(':comentario', $comment);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    $export['data'] = "$comment";
    echo json_encode($export);
}else {
    print_r(Conexion::conectar()->errorInfo());
}

?>