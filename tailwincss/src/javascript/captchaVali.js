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