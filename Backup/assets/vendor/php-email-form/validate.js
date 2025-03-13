/**
 * PHP Email Form Validation - v3.6
 * URL: https://bootstrapmade.com/php-email-form/
 * Author: BootstrapMade.com
 */
;(() => {
  // Esta versão modificada do script não interfere com o reCAPTCHA v3
  // O processamento do formulário é feito pelo script personalizado no HTML

  const forms = document.querySelectorAll(".php-email-form")

  forms.forEach((form) => {
    // Adiciona os elementos de feedback se não existirem
    if (!form.querySelector(".loading")) {
      const loading = document.createElement("div")
      loading.classList.add("loading")
      loading.textContent = "Carregando..."
      form.appendChild(loading)
    }

    if (!form.querySelector(".error-message")) {
      const errorMessage = document.createElement("div")
      errorMessage.classList.add("error-message")
      form.appendChild(errorMessage)
    }

    if (!form.querySelector(".sent-message")) {
      const sentMessage = document.createElement("div")
      sentMessage.classList.add("sent-message")
      sentMessage.textContent = "Sua mensagem foi enviada. Obrigado!"
      form.appendChild(sentMessage)
    }
  })
})()

