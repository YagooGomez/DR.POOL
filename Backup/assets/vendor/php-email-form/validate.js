document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#contact-form")

  form.addEventListener("submit", async (event) => {
    event.preventDefault()

    const loadingElement = form.querySelector(".loading")
    const errorElement = form.querySelector(".error-message")
    const successElement = form.querySelector(".sent-message")

    // Limpa mensagens anteriores
    errorElement.style.display = "none"
    successElement.style.display = "none"

    // Ativa o loading
    loadingElement.style.display = "block"

    // Captura dados do formulário
    const formData = new FormData(form)

    // Obtém o token do reCAPTCHA v3
    const recaptchaToken = await grecaptcha.execute('6LfGTfUqAAAAAK5rClY2Dz5ezrmi3eZN9kvrR0Ms', { action: 'submit' })
    formData.append('recaptcha_response', recaptchaToken)

    // Envia os dados via AJAX
    try {
      const response = await fetch('contactos.php', {
        method: 'POST',
        body: formData
      })

      const result = await response.json()

      if (result.success) {
        successElement.textContent = result.message
        successElement.style.display = "block"
        form.reset()
      } else {
        errorElement.textContent = result.message
        errorElement.style.display = "block"
      }
    } catch (error) {
      errorElement.textContent = "Erro ao enviar o formulário. Tente novamente mais tarde."
      errorElement.style.display = "block"
    } finally {
      loadingElement.style.display = "none"
    }
  })
})

grecaptcha.ready(function() {
  grecaptcha.execute('6LfGTfUqAAAAAK5rClY2Dz5ezrmi3eZN9kvrR0Ms', { action: 'submit' }).then(function(token) {
    document.getElementById('recaptchaResponse').value = token;
    console.log('reCAPTCHA Token:', token);
  });
});
