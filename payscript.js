const cardNumber = document.getElementById("card-number");
const cardHolderName = document.getElementById("card-holder-name");
const cardNameInput = document.getElementById("card-name-input");
const displayValidity = document.getElementById("validity");
const validityInput = document.getElementById("validity-input");
const cardNumberDisplay = document.querySelectorAll(".card-number-display");
const cvvInput = document.getElementById("cvv");
const cvvDisplay = document.getElementById("cvv-display");
let currentSpanIndex = 0;
cardNumber.addEventListener("input", () => {
  const inputNumber = cardNumber.value.replace(/\D/g, "");
  cardNumber.value = cardNumber.value.slice(0, 16).replace(/\D/g, "");
  for (let i = 0; i < cardNumberDisplay.length; i++) {
    if (i < inputNumber.length) {
      cardNumberDisplay[i].textContent = inputNumber[i];
    } else {
      cardNumberDisplay[i].textContent = "_";
    }
  }

  if (inputNumber.length <= cardNumberDisplay.length) {
    currentSpanIndex = inputNumber.length;
  } else {
    currentSpanIndex = cardNumberDisplay.length;
  }
});

cardNameInput.addEventListener("input", () => {
  if (cardNameInput.value.length < 1) {
    cardHolderName.innerText = "Your Name Here";
  } else if (cardNameInput.value.length > 30) {
    cardNameInput.value = cardNameInput.value.slice(0, 30);
  } else {
    cardHolderName.innerText = cardNameInput.value;
  }
});

validityInput.addEventListener("input", () => {
  const inputString = validityInput.value;
  if (inputString.length < 1) {
    displayValidity.innerText = "06/28";
    return false;
  }
  const parts = inputString.split("-");
  const year = parts[0].slice(2);
  const month = parts[1];

  //Final formatted string
  const formattedString = `${month}/${year}`;
  displayValidity.innerText = formattedString;
});

//cvv
cvvInput.addEventListener("input", () => {
  const userInput = cvvInput.value;
  const sanitizedInput = userInput.slice(0, 3);
  const numericInput = sanitizedInput.replace(/\D/g, "");
  cvvInput.value = numericInput;
  cvvDisplay.innerText = numericInput;
});

//Flip
cvvInput.addEventListener("click", () => {
  document.getElementById("card").style.transform = "rotateY(180deg)";
});
//Reflip card
document.addEventListener("click", () => {
  if (document.activeElement.id != "cvv") {
    document.getElementById("card").style.transform = "rotateY(0deg)";
  }
});

window.onload = () => {
  // Get today's date
  const today = new Date();
  const year = today.getFullYear();
  let month = today.getMonth() + 1;
  if (month < 10) month = "0" + month;
  let day = today.getDate();
  if (day < 10) day = "0" + day;

  // Set min date for the validity input
  validityInput.min = `${year}-${month}-${day}`;

  cvvInput.value = "";
  validityInput.value = "";
  cardNameInput.value = "";
  cardNumber.value = "";

  // Form submission handler
  const paymentForm = document.getElementById("payment-form");
  if (paymentForm) {
    paymentForm.addEventListener("submit", (e) => {
      // Validate all fields
      if (!cardNumber.value || cardNumber.value.length < 16) {
        alert("Please enter a valid 16-digit card number");
        e.preventDefault();
        return false;
      }
      if (!cardNameInput.value.trim()) {
        alert("Please enter cardholder name");
        e.preventDefault();
        return false;
      }
      if (!validityInput.value) {
        alert("Please select expiry date");
        e.preventDefault();
        return false;
      }
      if (!cvvInput.value || cvvInput.value.length < 3) {
        alert("Please enter a valid CVV");
        e.preventDefault();
        return false;
      }
      // If all validations pass, form submits naturally
    });
  }
};