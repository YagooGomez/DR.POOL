<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/vendor/autoload.php'; // Se usares Composer, senão usa require 'caminho_para/PHPMailer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $telefone = htmlspecialchars($_POST["telefone"]);
    $message = nl2br(htmlspecialchars($_POST["message"]));
    $recaptcha = $_POST["recaptcha_response"];

    // Verificação do reCAPTCHA v3 (se ativado)
    $recaptcha_secret = "6LfGTfUqAAAAACI2szoOyVzJdnfeEPpgQ6lHJmW5"; // Troca pelo teu Secret Key do reCAPTCHA
    $recaptcha_verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha");
    $recaptcha_response = json_decode($recaptcha_verify);
    
    if (!$recaptcha_response->success || $recaptcha_response->score < 0.5) {
        echo json_encode(["success" => false, "message" => "Falha na verificação reCAPTCHA."]);
        exit;
    }

    // Configuração do PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurar SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP (Gmail, Outlook, etc.)
        $mail->SMTPAuth = true;
        $mail->Username = 'tomas.fonseca2005@gmail.com'; // Teu email
        $mail->Password = 'gufb otap yzro nsjo'; // Tua senha ou senha de app
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        
        // Configuração do Email
        $mail->setFrom("tomas.fonseca2005@gmail.com", "Dr. Pool");
        $mail->addAddress("fernando.cabral@360elite.pt", "EU");
        $mail->addReplyTo($email, $name);
        
        $mail->isHTML(true);
        $mail->Subject = "Novo Contato de $name";
        $mail->Body = "
            <h2>Formulário de Contato</h2>
            <p><strong>Nome:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Telefone:</strong> $telefone</p>
            <p><strong>Mensagem:</strong><br> $message</p>
        ";

        $mail->send();
        echo json_encode(["success" => true, "message" => "Mensagem enviada com sucesso!"]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Erro ao enviar email: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Acesso inválido."]);
}
?>