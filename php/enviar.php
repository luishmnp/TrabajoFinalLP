<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // === 1. TU CORREO ELECTRÓNICO AQUÍ ===
    $destino = "luishmnp@gmail.com"; // Reemplaza por tu correo
    $asunto = "Nueva inscripción de curso - SENATI";

    // === 2. RECEPCIÓN Y LIMPIEZA DE DATOS ===
    $nombre           = htmlspecialchars($_POST['nombre'] ?? '');
    $segundo_nombre   = htmlspecialchars($_POST['segundo_nombre'] ?? '');
    $apellido         = htmlspecialchars($_POST['apellido'] ?? '');
    $fecha_nacimiento = htmlspecialchars($_POST['fecha_nacimiento'] ?? '');
    $genero           = htmlspecialchars($_POST['genero'] ?? '');
    $direccion_1      = htmlspecialchars($_POST['direccion_1'] ?? '');
    $direccion_2      = htmlspecialchars($_POST['direccion_2'] ?? '');
    $ciudad           = htmlspecialchars($_POST['ciudad'] ?? '');
    $estado_provincia = htmlspecialchars($_POST['estado_provincia'] ?? '');
    
    // Código Postal
    $codigo_postal = htmlspecialchars($_POST['codigo_postal'] ?? '');
    if ($codigo_postal === 'otro') {
        $codigo_postal = htmlspecialchars($_POST['codigo_postal_otro'] ?? 'Otro');
    }

    $email    = htmlspecialchars($_POST['email'] ?? '');
    $telefono = htmlspecialchars($_POST['telefono'] ?? '');
    
    // Cursos Anteriores, Empresa y Curso
    $cursos_anteriores = htmlspecialchars($_POST['cursos_anteriores'] ?? 'No');
    
    if ($cursos_anteriores === 'Si') {
        $empresa = htmlspecialchars($_POST['empresa_select'] ?? '');
        if ($empresa === 'otra') {
            $empresa = htmlspecialchars($_POST['empresa_otra'] ?? 'Otra empresa');
        }

        $curso = htmlspecialchars($_POST['cursos'] ?? '');
        if ($curso === 'otro') {
            $curso = htmlspecialchars($_POST['curso_otro'] ?? 'Otro curso');
        }
    } else {
        $empresa = "N/A (No ha llevado cursos previamente)";
        $curso   = "N/A (No aplica)";
    }

    $comentarios = htmlspecialchars($_POST['comentarios'] ?? 'Sin comentarios');

    // === 3. CONSTRUCCIÓN DEL CUERPO DEL CORREO ===
    $mensaje = "===========================================\n";
    $mensaje .= "        NUEVA INSCRIPCIÓN DE CURSO        \n";
    $mensaje .= "===========================================\n\n";
    
    $mensaje .= "DATOS DEL ALUMNO:\n";
    $mensaje .= "Nombre completo: $nombre $segundo_nombre $apellido\n";
    $mensaje .= "Fecha de nacimiento: $fecha_nacimiento\n";
    $mensaje .= "Género: $genero\n\n";

    $mensaje .= "DIRECCIÓN Y UBICACIÓN:\n";
    $mensaje .= "Dirección: $direccion_1 " . ($direccion_2 ? "($direccion_2)" : "") . "\n";
    $mensaje .= "Ciudad / Provincia: $ciudad / $estado_provincia\n";
    $mensaje .= "Código Postal: $codigo_postal\n\n";

    $mensaje .= "CONTACTO:\n";
    $mensaje .= "Email: $email\n";
    $mensaje .= "Teléfono: $telefono\n\n";

    $mensaje .= "HISTORIAL Y CURSOS:\n";
    $mensaje .= "¿Cursos anteriores?: $cursos_anteriores\n";
    $mensaje .= "Empresa: $empresa\n";
    $mensaje .= "Curso seleccionado: $curso\n\n";

    $mensaje .= "COMENTARIOS:\n";
    $mensaje .= "$comentarios\n\n";
    $mensaje .= "===========================================\n";

    // === 4. CABECERAS PARA EL ENVÍO DE CORREO ===
    $headers = "From: Formulario SENATI <no-reply@senati.edu.pe>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // === 5. INTENTO DE ENVÍO ===
    if (@mail($destino, $asunto, $mensaje, $headers)) {
        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Registro Procesado</title>
            <style>
                body { font-family: Arial, sans-serif; background: #f0f4f8; text-align: center; padding: 50px; }
                .card { background: white; max-width: 500px; margin: 0 auto; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
                h2 { color: #003366; }
                a { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #003366; color: white; text-decoration: none; border-radius: 6px; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h2>¡Inscripción registrada correctamente!</h2>
                <p>Los datos han sido procesados y enviados al correo del administrador.</p>
                <p><strong>Alumno:</strong> $nombre $apellido</p>
                <p><strong>Email:</strong> $email</p>
                <a href='inscripcion.html'>Volver al Formulario</a>
            </div>
        </body>
        </html>";
    } else {
        echo "<h2>Error al enviar el correo.</h2>";
        echo "<p>Si estás en un servidor local (Laragon), requiere configurar un servidor SMTP o habilitar Mail Catcher.</p>";
        echo "<br><a href='inscripcion.html'>Volver</a>";
    }

} else {
    header("Location: inscripcion.html");
    exit();
}
?>