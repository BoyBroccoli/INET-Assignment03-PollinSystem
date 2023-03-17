const form = document.querySelector("form");
const email = document.getElementById("email");
const userName = document.getElementById("userName");
const fName = document.getElementById("fName");
const lName = document.getElementById("lName");
const password = document.getElementById('password').value;
const password2 = document.getElementById('password2').value;

email.addEventListener("input", (event) => {

    if (email.validity.valid) {
        emailError.textContent = "";
        emailError.className = "error"
    } else {
        showError();
    }
});

function showError() {
    if (email.validity.valueMissing) {

        emailError.textContent = "You need to enter an email address.";
    } else if (email.validy.typeMismatch) {

        emailError.textContent = "Entered value needs to be an email address.";
    } else if (email.validity.tooShort) {

        emailError.textContent = "Email should be at least 5 characters";
    }

    emailError.className = "error active.";
}




if (password.value !== password2.value) {
    alert('Entered passwords do not match.');
}

