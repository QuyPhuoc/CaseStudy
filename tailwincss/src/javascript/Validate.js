function enableSubmitButton() {
    document.getElementById("submit-button").disabled = false;
}
function validateForm(event) {
    var response = grecaptcha.getResponse();
    if(response.length == 0) { 
        showAlert("Please verify you are not a robot.");
        event.preventDefault();
        return false;
    }
    return true;
}
function showAlert(message) {
    document.getElementById("alert").style.display = "block";
    document.getElementById("alertSpan").innerHTML = message;
    setTimeout(function(){ document.getElementById("alert").style.display = "none"; }, 3000);
}

function PasswordValidator() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("passwordconf").value;
    if(password != confirmPassword) {
        showAlert("Passwords do not match.");
        return false;
    }
    return true;
}

function validatePhone() {
    var phone = document.getElementById("phone").value;
    if(phone.length != 10) {
        showAlert("Phone number must be 10 digits.");
        return false;
    }
    return true;
}