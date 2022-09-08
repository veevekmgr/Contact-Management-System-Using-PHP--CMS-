function validation() {
    var user = document.loginForm.user.value;
    var pass = document.loginForm.pass.value;

    if (user.length == "" && pass.length == "") {
        alert("UserName and Password is empty");
        return false;
    }
}