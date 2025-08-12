<?php
session_start();
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

    $sql = "SELECT id, contraseña FROM usuario WHERE nombre = '$user' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['contraseña'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $user;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
    }
    exit;
}

// Verificar sesión
if ($action === 'check_session') {
    if (isset($_SESSION['user_id'])) {
        echo json_encode(['logged_in' => true, 'user' => $_SESSION['user_name']]);
    } else {
        echo json_encode(['logged_in' => false]);
    }
    exit;
}

// Cerrar sesión
if ($action === 'logout') {
    session_destroy();
    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Acción no válida']);
?>