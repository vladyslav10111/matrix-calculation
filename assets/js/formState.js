// Disables the form by adding a "blocked" parameter to the URL and applying a CSS class
function disableForm() {
    let url = new URL(window.location.href);
    url.searchParams.set("blocked", "true");
    window.history.pushState({}, '', url);
    document.getElementById("main-form").classList.add("disabled-form");
}

// Checks if the form should be disabled when the page loads
document.addEventListener("DOMContentLoaded", function () {
    let url = new URL(window.location.href);
    if (url.searchParams.get("blocked") === "true") {
        document.getElementById("main-form").classList.add("disabled-form");
    }
});

// Unblocks the form by removing the "blocked" parameter from the URL and removing the CSS class
function unblockForm() {
    let url = new URL(window.location.href);
    url.searchParams.delete("blocked");
    window.history.pushState({}, '', url);
    document.getElementById("main-form").classList.remove("disabled-form");
}
