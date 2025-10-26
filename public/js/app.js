//TOOLTIPS
$(function () {
    $(document).tooltip();
});
/*SCREEN LOADING ANIMATOR
window.addEventListener("load", () => {
    const loader = document.getElementById("loading-screen");
    loader.style.display = "none";
});*/
// ┌─────────────────────────────┐
// │ REINIT THE JQUERY TABS      │
// └─────────────────────────────┘
//TABBALE
function initTabs() {
    const buttons = document.querySelectorAll(".tab-button");
    const contents = document.querySelectorAll(".tab-content");
    if (buttons.length === 0 || contents.length === 0) {
        console.warn("Tab elements not found — skipping tab init.");
        return;
    }

    buttons.forEach((button) => {
        button.addEventListener("click", () => {
            const target = button.dataset.tab;

            // Hide all content
            contents.forEach((content) => content.classList.add("hidden"));
            // Remove active from all buttons
            buttons.forEach((btn) =>
                btn.classList.remove("active", "bg-blue-300")
            );

            // Show selected tab
            document.getElementById(target).classList.remove("hidden");
            button.classList.add("active", "bg-blue-300");
        });
    });
}
initTabs();

function selectMate() {
    const selected = document.getElementById("breeder2");
    const img = document.getElementById("breeder-img");

    img.src = `/ponys/adult/${selected.value}.png`;
}

// ┌─────────────────────────────┐
// │ PARTIAL PAGE LOADER         │
// └─────────────────────────────┘

// PARTIAL PAGE LOADER WITH HISTORY SUPPORT
function loadPartial(url) {
    fetch(url, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            Accept: "application/json",
        },
    })
        .then((res) => {
            if (res.redirected) {
                window.location.href = res.url;
            }
            return res.text();
        })
        .then((html) => {
            document.getElementById("content-area").innerHTML = html;
            window.history.pushState({ html: html, url: url }, "", url);
            initTabs(); // reinitialize UI tabs
        })
        .catch((err) => console.error("Failed to load partial:", err));
}

// HANDLE BROWSER BACK/FORWARD
window.addEventListener("popstate", function (event) {
    if (event.state && event.state.html) {
        document.getElementById("content-area").innerHTML = event.state.html;
        initTabs(); // reinitialize UI tabs
    } else if (event.state && event.state.url) {
        // If only URL is stored, re-fetch the partial
        loadPartial(event.state.url);
    } else {
        // Optional: fallback to full reload
        location.reload();
    }
});
