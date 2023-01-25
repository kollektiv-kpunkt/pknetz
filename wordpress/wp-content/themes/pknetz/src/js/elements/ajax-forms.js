if (document.querySelector(".pkn-ajax-form")) {
  document.querySelectorAll(".pkn-ajax-form").forEach((form) => {
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      let formData = new FormData(form);
      let url = form.action;
      let method = form.method;
      let loader = createLoader();
      try {
        let response = await fetch(url, {
          method: method,
          body: formData,
        });
        let data = await response.json();
        removeLoader(loader);
        switch (form.dataset.successAction) {
          case "showBilling":
            if (data.status === "success") {
              let billingForm = document.querySelector(".pkn-billing-form");
              billingForm.querySelector("input[name='email']").value = data.email;
              data.billing = decodeURI(data.billing);
              if (data.billing && data.billing !== "null") {
                billingForm.querySelector("label").innerHTML = "Stimmt diese Rechnungsadresse?";
                billingForm.querySelector("textarea").value = decodeURI(data.billing);
                billingForm.querySelector("button[type='submit']").innerHTML = "Adresse bestätigen";
              }
              billingForm.style.maxHeight = billingForm.scrollHeight + "px";
              form.style.maxHeight = form.scrollHeight + "px";
              setTimeout(() => {
                form.style.maxHeight = "0px";
              }, 100);
              setTimeout(() => {
                form.remove();
                billingForm.style.maxHeight = "none";
              }, 600);
            }
            break;
          case "finishSignup":
            if (data.status === "success") {
              form.remove();
              let successMessage = document.querySelector(".pkn-event-signup-success");
              successMessage.classList.remove("hidden");
            }
            break;
          default:
            if (data.status === "success") {
              form.reset();
              let messageElement = document.createElement("div");
              messageElement.classList.add("pkn-ajax-form-message", "pkn-ajax-form-message-success");
              messageElement.innerHTML = data.message;
              form.appendChild(messageElement);
              setTimeout(() => {
                messageElement.remove();
              }, 5000);
            }
            break;
        }
      } catch (error) {
        console.log(error);
      }
    });
  });
}

const createLoader = () => {
  let loader = document.createElement("div");
  loader.classList.add("pkn-form-loader");
  loader.innerHTML = `
  <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
  `;
  document.body.appendChild(loader);
  setTimeout(() => {
    loader.style.opacity = 1;
  }, 100);
  return loader;
}

const removeLoader = (loader) => {
  loader.style.opacity = 0;
  setTimeout(() => {
    loader.remove();
  }, 500);
}