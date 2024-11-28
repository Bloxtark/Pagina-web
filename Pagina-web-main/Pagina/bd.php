<?php
// Configuración de la base de datos
$host = "localhost"; // Cambia esto si tu servidor no es localhost
$user = "tu_usuario"; // Tu usuario de MySQL
$password = "tu_contraseña"; // Tu contraseña de MySQL
$dbname = "correos_db"; // Nombre de la base de datos

// Conexión a la base de datos
$conn = new mysqli($host, $user, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"];

    if (!empty($correo)) {
        $stmt = $conn->prepare("INSERT INTO correos (correo) VALUES (?)");
        $stmt->bind_param("s", $correo);

        if ($stmt->execute()) {
            echo "Correo guardado exitosamente.";
        } else {
            echo "Error al guardar el correo: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "El campo de correo está vacío.";
    }
}

$conn->close();
?>