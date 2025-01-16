document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    let fontSize = 16;

    const toggleButton = document.getElementById("contrast-toggle");

    if (toggleButton) {
        if (localStorage.getItem("highContrast") === "true") {
            document.body.classList.add("high-contrast");
            console.log("Dodano klasę high-contrast na podstawie localStorage.");
        }

        toggleButton.addEventListener("click", function () {
            document.body.classList.toggle("high-contrast");
            const isHighContrast = document.body.classList.contains("high-contrast");
            localStorage.setItem("highContrast", isHighContrast);
        });
    }

    if (sessionStorage.getItem('fontSize')) {
        fontSize = parseInt(sessionStorage.getItem('fontSize'), 10);
        body.style.fontSize = fontSize + 'px';
    }


    document.getElementById('increaseFont').addEventListener('click', function () {
        fontSize += 2;
        body.style.fontSize = fontSize + 'px';
        sessionStorage.setItem('fontSize', fontSize); 
    });


    document.getElementById('decreaseFont').addEventListener('click', function () {
        fontSize = Math.max(12, fontSize - 2);
        body.style.fontSize = fontSize + 'px';
        sessionStorage.setItem('fontSize', fontSize);
    });

});
