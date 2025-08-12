<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'No autenticado']);
    exit;
}
include_once "database.php";
$data = json_decode(file_get_contents("php://input"), true);

$nombre = $conn->real_escape_string($data['nombre'] ?? '');
$descripcion = $conn->real_escape_string($data['descripcion'] ?? '');
$imagen = $conn->real_escape_string($data['imagen'] ?? '');
$precio = floatval($data['precio'] ?? 0);
$empresa = $conn->real_escape_string($data['empresa'] ?? '');
$cantidad = intval($data['cantidad'] ?? 0);
$usuario_id = intval($_SESSION['user_id']);

if ($nombre && $descripcion && $imagen && $precio && $empresa && $cantidad) {
    $sql = "INSERT INTO productos (nombre, descripcion, imagen, precio, empresa, cantidad, usuario_id)
            VALUES ('$nombre', '$descripcion', '$imagen', $precio, '$empresa', $cantidad, $usuario_id)";
    if ($conn->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Faltan campos']);
}
?>