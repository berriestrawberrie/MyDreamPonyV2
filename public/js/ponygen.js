//TOOLTIPS
$(function () {
    $(document).tooltip();
});

//TEST
function loadNewContent() {
    fetch("/new-content")
        .then((response) => response.text())
        .then((html) => {
            document.getElementById("content-area").innerHTML = html;
        });
}

//LOAD THE PONY GENERATOR WITHOUT RELOAD
function loadPony(type) {
    fetch(`/ponygen/generate/${type}`)
        .then((response) => response.text())
        .then((html) => {
            document.getElementById("pony-gen").innerHTML = html;
        });
}

//ADD TRIGGER TO BUTTONS
document.querySelectorAll(".pony-button").forEach((button) => {
    button.addEventListener("click", () => {
        const type = button.dataset.type;
        loadPony(type);
        document.getElementById("content-area").classList.add("hidden");
        document.getElementById("gentitle").innerText = "Generator";
    });
});
