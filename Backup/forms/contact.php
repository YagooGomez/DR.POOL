<?php
// Database connection parameters
$servername = "localhost";
$username = "DR.POOL"; // Replace with your database username
$password = "DRPOOL54321"; // Replace with your database password
$dbname = "drpool";
$table = "contatos";

// Initialize response array
$response = [
    'success' => false,
    'message' => ''
];

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate reCAPTCHA
    $recaptcha_response = $_POST['recaptcha_response'];
    $recaptcha_secret = '6LdtifMqAAAAAHwp410W99DoQQtIKozSxxdIH9gs'; // Replace with your actual secret key
    
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
    $recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
    $recaptcha_json = json_decode($recaptcha_result);
    
    // If reCAPTCHA verification failed
    if (!$recaptcha_json->success || $recaptcha_json->score < 0.5) {
        $response['message'] = 'Falha na verificação do reCAPTCHA. Por favor, tente novamente.';
        echo json_encode($response);
        exit;
    }
    
    // Get form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    $date = date('Y-m-d H:i:s');
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($telefone) || empty($message)) {
        $response['message'] = 'Por favor, preencha todos os campos obrigatórios.';
        echo json_encode($response);
        exit;
    }
    
    // Connect to database
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO $table (nome, email, telefone, mensagem, data_envio) 
                               VALUES (:nome, :email, :telefone, :mensagem, :data_envio)");
        
        // Bind parameters
        $stmt->bindParam(':nome', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':mensagem', $message);
        $stmt->bindParam(':data_envio', $date);
        
        // Execute query
        $stmt->execute();
        
        // Send success response
        $response['success'] = true;
        $response['message'] = 'Mensagem enviada com sucesso! Obrigado pelo contato.';
    } catch(PDOException $e) {
        $response['message'] = 'Erro ao salvar os dados: ' . $e->getMessage();
    }
    
    // Close connection
    $conn = null;
} else {
    $response['message'] = 'Método de requisição inválido.';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>

