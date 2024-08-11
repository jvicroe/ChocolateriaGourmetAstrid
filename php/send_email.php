<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = trim($_POST["number"]);
    $message = trim($_POST["message"]);

    // Validar los datos
    if (empty($name) OR empty($email) OR empty($number) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor completa el formulario correctamente.";
        exit;
    }

    // Configurar destinatario y asunto del correo
    $recipient = "chocolateriagourmetastrid@gmail.com"; // Reemplaza con tu correo electrónico
    $email_subject = "Nuevo mensaje de contacto: $subject";

    // Construir el contenido del correo
    $email_content = "Nombre Completo: $name\n";
    $email_content .= "Correo Electrónico: $email\n\n";
    $email_content = "Número Celular: $number\n";
    $email_content .= "¿Cómo te puedo ayudar:\n$message\n";

    // Construir los encabezados del correo
    $email_headers = "From: $name <$email>";

    // Enviar el correo
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Si el correo se envía correctamente
        http_response_code(200);
        echo "Gracias! Tu mensaje ha sido enviado.";
    } else {
        // Si el correo no se puede enviar
        http_response_code(500);
        echo "Ups! Algo salió mal y no pudimos enviar tu mensaje.";
    }

} else {
    http_response_code(403);
    echo "Hubo un problema con tu envío, por favor contáctanos por Whatsapp al 5531924241.";
}
?>