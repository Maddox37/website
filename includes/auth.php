<?php  /* solo entiendo un 2% del codigo :P */
header('Content-Type: application/json');
include_once "database.php";

$data = json_decode(file_get_contents("php://input"), true);
$action = $data['action'] ?? '';

if ($action === 'register') {
    $user = $conn->real_escape_string($data['user'] ?? '');
    $pass = $conn->real_escape_string($data['pass'] ?? '');
    $mail = $conn->real_escape_string($data['mail'] ?? '');

    if (!$user || !$pass || !$mail) {
        echo json_encode(['success' => false, 'message' => 'Campos incompletos']);
        exit;
    }

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuario (nombre, contraseña, email) VALUES ('$user', '$hashed_pass', '$mail')";
    if ($conn->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar usuario: ' . $conn->error]);
    }
    exit;
}

if ($action === 'login') {
    $user = $conn->real_escape_string($data['user'] ?? '');
    $pass = $data['pass'] ?? '';

    if (!$user || !$pass) {
        echo json_encode(['success' => false, 'message' => 'Campos incompletos']);
        exit;
    }

    $sql = "SELECT contraseña FROM usuario WHERE nombre = '$user' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['contraseña'])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Acción no válida']);
?>