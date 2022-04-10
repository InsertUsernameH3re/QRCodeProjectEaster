let elapsed = 0;

function Cookie_Get() {
    let registration = document.cookie;
    registration = registration.split("; ")
    if (registration[registration.indexOf("registered=true")] == "registered=true") {
        const old = document.getElementById("form").remove();
        const newer = document.createElement("h1");
        newer.innerHTML = "You have already registered";
        document.getElementById("wrap").appendChild(newer);  
    }
}

function backgroundColor() {
    if (document.body.contains(document.getElementById("success"))) {
        document.body.style.backgroundColor = "green";
    } else {
        document.body.style.backgroundColor = "red";
    }
}

function timer() {
    var cook = document.cookie = "been=false";
    let elapsed = 0;
    setInterval(timeCounter, 1000);
}

function timeCounter() {
    elapsed++;
    var time = document.cookie = "time=" + elapsed;
}
