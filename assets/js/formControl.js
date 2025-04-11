document.addEventListener('DOMContentLoaded', function () {

    // Adds event listeners to radio buttons to update the URL and highlight the selected option
    const radioButtons = document.querySelectorAll('input[type="radio"][name="option"]');

    radioButtons.forEach(function (radio) {
        radio.addEventListener("change", function () {
            let selectedOption = document.querySelector('input[type="radio"][name="option"]:checked');

            if (selectedOption) {
                let currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set("option", selectedOption.value);
                window.history.pushState({}, "", currentUrl);

                radioButtons.forEach((btn) => btn.classList.remove("selected-option"));

                selectedOption.classList.add("selected-option");
            }
        });
    });

    // Handles the click event on the "calculate" button, submits the form if an option is selected
    document.addEventListener("click", function (event) {
        if (event.target && event.target.id === "calculate") {
            let selectedOption = document.querySelector('input[type="radio"][name^="option"]:checked');

            if (selectedOption) {
                document.getElementById("result-option").value = selectedOption.value;
            } else {
                alert("Please select an operation!");
                return;
            }

            event.target.closest("form").submit();
        }
    });
});

// Clears all numeric input fields in the matrix form
function clearMatrixForm() {
    const form = document.getElementById("matrix-form");

    const inputs = form.getElementsByTagName("input");

    for (let input of inputs) {
        if (input.type === "number") {
            input.value = '';
        }
    }
}

// Removes the "selected-option" class from all radio buttons when the clear button is clicked
document.getElementById("radio-clear2").addEventListener("click", function () {
    const radios = document.querySelectorAll("#main-form input[type='radio']");

    radios.forEach(function (radio) {
        radio.classList.remove("selected-option");
    });
});

// Prevents entering '.' or ',' in number input fields
const numberInputs = document.querySelectorAll('input[type="number"]');

numberInputs.forEach(input => {
    input.addEventListener('keydown', function(event) {
        if (event.key === '.' || event.key === ',') {
            event.preventDefault();
        }
    });
});
