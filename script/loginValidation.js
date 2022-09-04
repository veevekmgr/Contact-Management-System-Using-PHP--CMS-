function validation() {
    var user = document.loginForm.user.value;
    var pass = document.loginForm.pass.value;

    if (user.length == "" && pass.length == "") {
        alert("UserName and Password is empty");
        return false;
    } else {
        if (user.length == "") {
            alert("Username is empty");
            return false;
        }
        if (pass.length == "") {
            alert("Password is empty");
            return false;
        }
    }
}