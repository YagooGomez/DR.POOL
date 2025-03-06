<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("configBD.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once('recaptcha-php-1.11/recaptchalib.php');
$privatekey = "6LdRAsUlAAAAADtCmODi80Okdg1wft9i4-6xTA10";
$resp = recaptcha_check_answer ($privatekey,
                              $_SERVER["REMOTE_ADDR"],
                              $_POST["recaptcha_challenge_field"],
                              $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
  // What happens when the CAPTCHA was entered incorrectly
  die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
       "(reCAPTCHA said: " . $resp->error . ")");
} else {
    $name=$_POST["name"];
    $email=$_POST["email"];
    $telefone=$_POST["telefone"];
    $message=$_POST["message"];
    
    if(isset($_POST['url']) && $_POST['url']==''){
       if(isset($_POST['cbox_news'])){
        //enviar para bd que quer receber newsletter
        $sql="INSERT INTO newsletters (nome,telefone,email) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss',$name,$telefone,$email);
        $stmt->execute(); 
    }
    
    $corpo="<p style='font-size:21px;''>Nome: <span style='font-size:15px;'>".$name."</span></p>
    <p style='font-size:21px;''>Email: <a style='font-size:15px href='mailto:'.$email.'><span style='font-size:15px;'></a>".$email."</span></p>
    <p style='font-size:21px;''>Telefone: <span style='font-size:15px;'>".$telefone."</span></p>
    <br><p style='font-size:21px;''>Mensagem:</p> <p style='font-size:15px;'>".$message."</p><br>";
    //echo $corpo;
    //Load Composer's autoloader
    require '../vendor/autoload.php';
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                         //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.360elite.pt';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'saw@360elite.pt';                      //SMTP username
        $mail->Password   = 'EC.22AG.SAW*';                         //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('saw@360elite.pt', utf8_decode('Contacto de: '.$name));
        //$mail->addAddress('p.goncalves@criterios.pt');
        $mail->addAddress('r.babo@360elite.pt'); //testes
         //Add a recipient            
        //$mail->addCC('marketing@drpool.pt');
        //$mail->addBCC('bcc@example.com');
        
       /* //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  */  //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = utf8_decode('Mensagem de '.$name.'('.$email.')');
        $mail->Body    = utf8_decode($corpo);
    
    
        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    //echo $name." ".$email." ".$telefone." ".$message;

    }

}

?>