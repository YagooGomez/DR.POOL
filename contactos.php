<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>dr pool®</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/Logotipos/Icons/DR Pool Small Logo.png" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="assets/css/variables.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="add-bkg">

<?php
include "./header.php";
?>



  <main id="main">
    <div class="main-container">
    <h1>Contactos</h1>


      <div class=left-container>
      <p style="color:white; text-decoration:none"><b>Visite-nos</b><br><br>
            <b>Morada:</b> Rua Monte Castelo 720-r/c-E<br>4460-055 Guifões GUIFÕES-Portugal<br><br>
            <b>Telefone:</b> 226007324<br>
            <b>Contacto Whatsapp:</b> +351 967 324 344<br>
            <b>Email:</b> drpool@drpool.pt</p>

            <div class="social">
              <a href="https://www.facebook.com/people/Dr-Pool/100077337159301/?ref=py_c"><img src="assets/img/Logotipos/Icons/FaceBook Branco.png" width="5%"></a> &nbsp;
              <a href="https://www.instagram.com/drpool-oficial/"><img src="assets/img/Logotipos/Icons/Instagram Branco.png" width="5%"></a>&nbsp;
              <a href="https://api.whatsapp.com/send?phone=00351967324344"><img src="assets/img/Logotipos/Icons/WhatsApp Branco.png" width="5%"></a>
            </div>

            <div class="map">
            <img src="assets/img/mapa.png" width="350px"><br><br>
            </div>
      </div>


      <div class="right-container">
      <form action="forms/contact.php" method="post" role="form" class="php-email-form">
             <div class="form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Nome" required><br>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
              </div>
              <div class="form-group col-md-6">
               <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone" required>
              </div>

            </div>
           
            <div class="form-group">
               <br>
              <textarea class="form-control" name="message" rows="5" placeholder="Mensagem" required></textarea>
            </div>
            <div>
                <input type="checkbox" id="cbox_news" name="cbox_news" value="News" checked>
                <label class="cbox_news" for="cbox_news"> Desejo receber materiais de marketing </label><br>

                <input type="checkbox" id="cbox_termos" name="cbox_termos" value="News" required>
                <label class="cbox_news" for="cbox_termos"> Eu concordo com <a href="termosecondicoes.php">Termos e Condições</a> e <a href="politicadeprivacidade.php">Politica de Privicidade</a> </label><br>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">A sua mensagem foi enviada. Obrigado!</div>
            </div>
              
            <div class="text-center">
          <?php
          require_once('recaptcha-php-1.11/recaptchalib.php');
          $publickey = "6LeMTRclAAAAAA4wneXU6unjeEadJm66jWCwfBIC"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>
                  <button id="send-with-captcha" type="submit" >Enviar</button>
            </div>
          </form>
      </div> 
    </div>

    <!--

          
        </td>
      </tr>
      <tr>
        <td colspan="2"><p style="text-align: center;"><br></p>
          <br><br><br></td></tr>
    </table> -->
   
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include "footer.php"
  ?>
 
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script>
                  function recaptchaCallback(){
                    const el = document.querySelector('#send-with-captcha');
                    el.classList.remove("disabled");
                    document.getElementById("send-with-captcha").removeAttribute("disabled");
                  }
    </script>


   <!-- Template Main JS File -->
   <script src="assets/js/main.js"></script>

</body>
<style>
  #p-h-s,#p-h-s a{
    color:white;
  }
</style>
</html>