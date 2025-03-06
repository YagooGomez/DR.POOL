<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'forms/PHPMailer/src/Exception.php';
require 'forms/PHPMailer/src/PHPMailer.php';
require 'forms/PHPMailer/src/SMTP.php';

$name=$_POST["name"];
$email=$_POST["email"];
$telefone=$_POST["telemovel"];


$url="https://api.whatsapp.com/send?phone=whatsappphonenumber&text=urlencodedtext";
$msg = "Olá, \r\nO meu nome é $name e pretendia um orçamento. \r\n\r\n Contactos:\r\nTelefone:$telefone\r\nEmail:$email";
    $msg = str_replace("\r\n", urlencode("\r\n"), $msg); // note the double quotes

    $url="https://api.whatsapp.com/send?phone=351967324344&text=$msg'";
    
    if(checkDevice()=="PC"){
        $mense="Olá, chamo-me $name e gostaria de pedir um orçamento";
      
        $cont="Telemovel: $telefone <br> Email: $email";
        $corpo="<p style='font-size:21px;''>Mensagem:</p><p style='font-size:15px;'>".$mense."</p>
        <p style='font-size:21px;''>Meus Contactos:</p> <p style='font-size:15px;'><br>".$cont."</p>";
        EnviaEmail($corpo,$name,$email);
        header("Location: index.php");
    }
    else{
        header("Location: ".$url);
    }
    


    function checkDevice(){
            $useragent=$_SERVER['HTTP_USER_AGENT'];
            if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                return 'Mobile';
            else
                return 'PC';
    }

    function EnviaEmail($corpo,$name,$email){
            
            //Load Composer's autoloader
            require 'vendor/autoload.php';

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_OFF;                         //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'mail.360elite.pt';                   //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'saw@360elite.pt';                      //SMTP username
                $mail->Password   = 'EC.22AG.SAW*';                         //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('saw@360elite.pt', utf8_decode('Pedido de Orçamento'));
                $mail->addAddress('p.goncalves@criterios.pt');
               // $mail->addAddress('a035188@ipmaia.pt'); //testes
                //Add a recipient            
                //$mail->addCC('marketing@drpool.pt');
                //$mail->addBCC('bcc@example.com');
                
            /* //Attachments
                $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  */  //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Mensagem de '.$name.'('.$email.')';
                $mail->Body    = utf8_decode($corpo);


                $mail->send();
                //echo 'Message has been sent';
            } catch (Exception $e) {
                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            //echo $name." ".$email." ".$telefone." ".$message;

    }
?>