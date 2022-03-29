function Cookie_Get() {
    let registration = document.cookie;
    registration = registration.split(";")
    if (registration[0] == "registered=true") {
        const old = document.getElementById("form").remove();
        const newer = document.createElement("h1");
        newer.innerHTML = "You have already registered";
        document.getElementById("wrap").appendChild(newer);  
    }
}

function login() {
    let registration = document.cookie;
    registration = registration.split(";")
    if (registration[1] == "logged=false") {
        const old = document.getElementById("form").remove();
        const newer = document.createElement("h1");
        newer.innerHTML = "You have already registered";
        document.getElementById("wrap").appendChild(newer);  
    }
}
