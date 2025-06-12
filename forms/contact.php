<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/vendor/autoload.php'; // Ajusta se necessário

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // ajusta se o .env estiver na raiz
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $telefone = htmlspecialchars($_POST["telefone"]);
    $message = nl2br(htmlspecialchars($_POST["message"]));

    // Configuração do PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurar SMTP
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USERNAME'];
        $mail->Password = $_ENV['SMTP_PASSWORD']; // Melhor não deixar no código
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'];

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        
        // Configuração do Email
        $mail->setFrom("drpool@drpool.pt", "Dr. Pool");
        $mail->addAddress("drpool@drpool.pt", "EU");
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
