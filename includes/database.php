<?php /* conexion, no eliminar o tocar :) */
header('Content-Type: application/json');
$host = 'localhost';
$user = 'root';
$password = ''; 
$database = 'empresa';
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'No se pudo conectar a la base de datos: ' . $conn->connect_error]);
    exit;
}
?>
