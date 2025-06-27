import "./bootstrap";
import "remixicon/fonts/remixicon.css";

// toggel sub-menu
function togglesubmenu(e) {
    let submenu = e.parentElement.parentElement.children[1];

    if (submenu.classList.contains("hidden")) {
        submenu.classList.remove("hidden");
    } else {
        submenu.classList.add("hidden");
    }
}

// menu show
function showmenu() {
    let menuoverly = document.getElementById("menuoverly");
    let menu = document.getElementById("menu");

    if (menuoverly.classList.contains("opacity-0")) {
        menuoverly.classList.remove("opacity-0");
        menuoverly.classList.remove("pointer-events-none");
    } else {
        menuoverly.classList.add("opacity-0");
        menuoverly.classList.add("pointer-events-none");
    }

    if (menu.classList.contains("-translate-x-full")) {
        menu.classList.remove("-translate-x-full");
    } else {
        menu.classList.add("-translate-x-full");
    }
}

// manage faq
function showFaq(e) {
    let ele = e.parentElement.children[1];
    if (ele.classList.contains("hidden")) {
        ele.classList.remove("hidden");
    } else {
        ele.classList.add("hidden");
    }
}

// toggleInput
function toggleInput(e) {
    let ele = e.parentElement.children[0];
    let icon = e.children[0];

    if (ele.getAttribute("type") == "password") {
        ele.setAttribute("type", "text");
    } else {
        ele.setAttribute("type", "password");
    }

    if (icon.classList.contains("ri-eye-line")) {
        icon.classList.remove("ri-eye-line");
        icon.classList.add("ri-eye-off-line");
    } else {
        icon.classList.remove("ri-eye-off-line");
        icon.classList.add("ri-eye-line");
    }
}

// sidebar collaps
function sidebarcollaps() {
    let ele = document.getElementById("sidebar");

    if (ele.classList.contains("-left-full")) {
        ele.classList.remove("-left-full");
        ele.classList.add("-left-0");
    } else {
        ele.classList.add("-left-full");
    }
}

// toggle class
function toggleclass(target, classes) {
    let ele = document.querySelector(target);
    if (!ele) return;

    const allPresent = classes.every((cls) => ele.classList.contains(cls));
    if (allPresent) {
        classes.forEach((cls) => ele.classList.remove(cls));
    } else {
        classes.forEach((cls) => ele.classList.add(cls));
    }
}

// windows
window.togglesubmenu = togglesubmenu;
window.showmenu = showmenu;
window.showFaq = showFaq;
window.toggleInput = toggleInput;
window.sidebarcollaps = sidebarcollaps;
window.toggleclass = toggleclass;
