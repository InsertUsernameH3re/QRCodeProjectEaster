function Cookie_Create(){
    document.cookie = "email=" + document.getElementById("email").value + "@purkynka.cz" + "; expires=" + "Mon, 11 April 2022 23:59:59 CET; Secure";
}

function SendEmail() {
    Email.send({
        Host: "smtp.seznam.cz",
        Username: "michal.spitz@seznam.cz",
        Password: "password",
        To: 'michal.spitz@gmail.com',
        From: "michal.spitz@seznam.cz",
        Subject: "This is the subject",
        Body: "And this is the body"
    }).then(
        message => alert(message)
    );
}
