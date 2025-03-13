<?php
// Carregar variáveis de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Parâmetros do banco de dados
$servername = $_ENV['localhost'];
$username = $_ENV['DR.POOL'];
$password = $_ENV['DRPOOL54321'];
$dbname = $_ENV['drpool'];
$table = "contatos";

// Inicializar resposta
$response = [
    'success' => false,
    'message' => ''
];

// Verificar método POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    $response['message'] = 'Método de requisição inválido.';
    echo json_encode($response);
    exit;
}

// Capturar dados do formulário
$name = htmlspecialchars(trim($_POST['name'] ?? ''));
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$telefone = htmlspecialchars(trim($_POST['telefone'] ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));
$recaptcha_response = $_POST['recaptcha_response'] ?? '';
$date = date('Y-m-d H:i:s');

// Validar campos obrigatórios
if (empty($name) || empty($email) || empty($telefone) || empty($message)) {
    http_response_code(400);
    $response['message'] = 'Preencha todos os campos obrigatórios.';
    echo json_encode($response);
    exit;
}

// Verificar reCAPTCHA
$recaptcha_secret = $_ENV['6LdtifMqAAAAAHwp410W99DoQQtIKozSxxdIH9gs'];
$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_data = [
    'secret' => $recaptcha_secret,
    'response' => $recaptcha_response,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];

$recaptcha_options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($recaptcha_data)
    ]
];

$recaptcha_context = stream_context_create($recaptcha_options);
$recaptcha_result = json_decode(file_get_contents($recaptcha_url, false, $recaptcha_context));

// Verificar a pontuação do reCAPTCHA
if (!$recaptcha_result->success || $recaptcha_result->score < 0.5) {
    http_response_code(403);
    $response['message'] = 'Falha na verificação do reCAPTCHA.';
    echo json_encode($response);
    exit;
}

// Conectar ao banco de dados
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Inserir dados
    $stmt = $conn->prepare("INSERT INTO $table (nome, email, telefone, mensagem, data_envio) 
                            VALUES (:nome, :email, :telefone, :mensagem, :data_envio)");
    $stmt->execute([
        ':nome' => $name,
        ':email' => $email,
        ':telefone' => $telefone,
        ':mensagem' => $message,
        ':data_envio' => $date
    ]);

    $response['success'] = true;
    $response['message'] = 'Mensagem enviada com sucesso!';
} catch (PDOException $e) {
    http_response_code(500);
    $response['message'] = 'Erro ao salvar os dados: ' . $e->getMessage();
} finally {
    $conn = null;
}

// Resposta JSON
header('Content-Type: application/json');
echo json_encode($response);


// Importar as classes do PHPMailer
require 'php-email-form/src/PHPMailer.php';
require 'php-email-form/src/SMTP.php';
require 'php-email-form/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inicializar PHPMailer
$mail = new PHPMailer(true);

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP (Gmail, Outlook, etc.)
        $mail->SMTPAuth = true;
        $mail->Username = 'tomas.fonseca2005@gmail.com'; // Teu email
        $mail->Password = 'gufb otap yzro nsjo'; // Tua senha ou senha de app
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar o remetente e destinatário
        $mail->setFrom($email, $name); // Quem está enviando
        $mail->addAddress('tomas.fonseca2005@gmail.com'); // Para onde vai o e-mail

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Novo Contato de ' . $name;
        $mail->Body = "
            <h3>Nome: $name</h3>
            <p>Email: $email</p>
            <p>Telefone: $telefone</p>
            <p>Mensagem: $message</p>
        ";

        // Enviar o e-mail
        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Mensagem enviada com sucesso!']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Erro ao enviar o email: {$mail->ErrorInfo}"]);
    }
}

