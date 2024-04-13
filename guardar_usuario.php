<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = htmlspecialchars($username);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $mysqli = new mysqli('host', 'usuario', 'contraseña', 'nombre_bd');

    // Verificar la conexión
    if ($mysqli->connect_error) {
        die("Error en la conexión a la base de datos: " . $mysqli->connect_error);
    }

    // Preparar la consulta SQL para insertar los datos en la tabla de usuarios
    $sql = "INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("sss", $username, $email, $hashed_password);

    // Ejecutar la consulta
    if ($statement->execute()) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error al registrar usuario: " . $mysqli->error;
    }

    // Cerrar la conexión y liberar recursos
    $statement->close();
    $mysqli->close();
} else {
    // Redirigir si se intenta acceder directamente a este archivo sin enviar datos
    header("Location: registro.php");
    exit();
}
?>
