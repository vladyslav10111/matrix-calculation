// Restores the selected radio option based on the URL parameter when the page loads
window.addEventListener("load", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const selectedOption = urlParams.get("option");

    if (selectedOption) {
        const forms = document.querySelectorAll("form");

        forms.forEach(function (form) {
            const radioButtons = form.querySelectorAll('input[type="radio"]');

            radioButtons.forEach(function (radio) {
                if (radio.value === selectedOption) {
                    radio.checked = true;
                    radio.classList.add("selected-option");
                } else {
                    radio.classList.remove("selected-option");
                }
            });
        });
    }
});
