const password = document.getElementById('password').value;
const password2 = document.getElementById('password2').value;

if (password.value !== password2.value) {
    alert('Entered passwords do not match.');
}

