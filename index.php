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


</head>

<body>

  
<?php
include_once('header.php')
?>


  <main id="main">

    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
      <div class="container-md" data-aos="fade-in">
        <div class="row">
          <div class="col-12">
            <div class="swiper sliderFeaturedPosts">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/drpool/clark-tai-nq18MYhxdGs-unsplash-scaled.webp');">
                    <div class="img-bg-inner">
                     
                      <h3>Manutenção, instalação, reparação, construção de piscinas e tratamento de água de piscinas?</h3>
                       <h1>Conte com a dr pool</h1>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/drpool/inground-pool-construction-scaled.webp');">
                    <div class="img-bg-inner">
                     
                      <h3>Manutenção, instalação, reparação, construção de piscinas e tratamento de água de piscinas?</h3>
                       <h1>Conte com a dr pool</h1>
                    </div>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/drpool/547.webp');">
                    <div class="img-bg-inner">
                     
                      <h3>Manutenção, instalação, reparação, construção de piscinas e tratamento de água de piscinas?</h3>
                       <h1>Conte com a dr pool</h1>
                    </div>
                  </a>
                </div>
              </div>
              <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
              </div>
              <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Hero Slider Section -->
    
    <div class="container-or">
      <div class="t-1">
        <h1>ORÇAMENTOS GRATUITOS</h1>
      </div>
      <div class="t-2">
        <h5>Fale com um especialista agora</h5>
      </div>
      <form action="orcamento.php" method="POST">
        <input class="input-txt" id="name" name="name" type="text" placeholder="Nome" required/>
        <input class="input-txt" id="email" name="email" type="email" placeholder="Email" required/>
        <input class="input-txt" id="telemovel" name="telemovel" type="text" placeholder="Telemóvel" required/>
        <input class="sub-but" type="submit" value="Receber Informações" required/>
      </form>
        
    </div>
          

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-legal">
     

        <div style="text-align: center;">
          <h2 style="color:#00aad7;">VISITE-NOS NAS NOSSAS REDES SOCIAIS</h2>

          <a href="https://www.facebook.com/people/Dr-Pool/100077337159301/?ref=py_c"><img src="assets/img/Logotipos/Icons/FaceBook Azul.png"></a>
          &nbsp;&nbsp;&nbsp;
          <a href="https://www.instagram.com/drpool_oficial/"><img src="assets/img/Logotipos/Icons/Instagram Azul.png"></a>
   

      </div>
    </div>



   <section id="contact" class="contact">
    <div class="footer-content">
      <div class="container">
        <div class="row gy-4">

          <div class="col-md-4">
            <div class="info-item">
              <img src ="assets/img/locationIcon.png" width="60px" height="65px">
              <h3>Morada</h3>
              <address>Rua Monte Castelo 720-r/c-E<br>4460-055 Guifões GUIFÕES Portugal</address>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-4">
            <div class="info-item info-item-borders">
            
              <img src ="assets/img/phoneIcon.png" width="60px" height="60px">
              <h3>Telefone</h3>
              <p class="color-white"><a href="tel:+351226007324">226 007 324</a></p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-4">
            <div class="info-item">
             <img src ="assets/img/emailIcon.png" width="60px" height="60px">
              <h3>Email</h3>
              <p class="color-white"><a href="mailto:info@example.com">drpool.drpool.pt</a></p>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="form mt-5">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
             <div class="form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Nome" required>
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
              <textarea class="form-control" name="message" rows="5" placeholder="Mensagem" required></textarea>
            </div>
            <div>
                <input class="check-newsletter" type="checkbox" id="cbox_news" name="cbox_news" value="News" checked>
                <label class="l-newsletter" for="cbox_news"> Desejo receber materiais de marketing </label><br>

                <input class="check-termos-condicoes" type="checkbox" id="cbox_termos" name="cbox_termos" value="News" required>
                <label class="l-termos-condicoes" for="cbox_termos"> Eu concordo com <a href="termosecondicoes.php" class="t-bold">Termos e Condições</a> e <a href="politicadeprivacidade.php" class="t-bold">Politica de Privicidade</a> </label><br>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">A sua mensagem foi enviada. Obrigado!</div>
            </div>
              <p class="antispam">Leave this empty: <input type="text" name="url"/></p>
            <div class="text-center"><button type="submit">Enviar</button></div>
          </form>
           
        </div>

      </div>
      </div>
    </div>

    </section>

  </footer>
  <?php
  include "footer.php"
  ?>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>