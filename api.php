<?php
// Función para verificar las credenciales
function autenticar($usuario, $contrasena) {
    // Aquí deberías verificar las credenciales en tu base de datos o sistema de autenticación
    // Por simplicidad, aquí asumimos que las credenciales son correctas si el usuario es "usuario" y la contraseña es "contrasena"
    if ($usuario === "usuario" && $contrasena === "contrasena") {
        return true;
    } else {
        return false;
    }
}
// Obtener datos de la solicitud
$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === 'POST') {
    $datos = json_decode(file_get_contents("php://input"), true);

    if (isset($datos['usuario']) && isset($datos['contrasena'])) {
        $usuario = $datos['usuario'];
        $contrasena = $datos['contrasena'];

        if (autenticar($usuario, $contrasena)) {
            $respuesta = array("mensaje" => "Autenticación satisfactoria");
        } else {
            $respuesta = array("error" => "Error en la autenticación");
        }
    } else {
        $respuesta = array("error" => "Datos incompletos");
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta);
} else {
    // Método no permitido
    header('HTTP/1.1 405 Method Not Allowed');
    header('Allow: POST');
}
?>
