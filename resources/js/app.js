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

// math equations
function renderAllMathPreviews(options = {}) {
    // Default options
    const defaultOptions = {
        delimiters: [
            { left: "$$", right: "$$", display: true },
            { left: "$", right: "$", display: false },
            { left: "\\(", right: "\\)", display: false },
            { left: "\\[", right: "\\]", display: true },
        ],
        throwOnError: false,
        output: "mathml",
    };

    // Merge user options with defaults
    const renderOptions = { ...defaultOptions, ...options };

    // Get all math preview elements
    const mathElements = [
        ...document.querySelectorAll(".math-preview:not(.katex-rendered)"),
    ];

    // Render each element
    mathElements.forEach((element) => {
        try {
            // Get original content and preserve spaces
            let originalText = element.innerHTML;

            // Replace all spaces (English and Bangla) with a temporary marker
            const spacedText = originalText
                .replace(/ /g, "␣") // English space
                .replace(/ /g, "␣") // &nbsp;
                .replace(/[\u200B-\u200D\uFEFF]/g, "␣"); // Zero-width and other spaces

            // Check if content is already wrapped in delimiters
            let mathText = spacedText.trim();
            if (!mathText.match(/^(\$|\\[()\[\]])/)) {
                mathText = `$$${mathText}$$`;
            }

            // Create temporary container
            const temp = document.createElement("div");
            temp.innerHTML = mathText;

            // Render with KaTeX
            renderMathInElement(temp, renderOptions);

            // Replace temporary markers with &nbsp; for proper rendering
            const renderedHTML = temp.innerHTML.replace(/␣/g, "&nbsp;");

            // Replace original content
            element.innerHTML = renderedHTML;
            element.classList.add("katex-rendered");
        } catch (error) {
            console.error("KaTeX rendering error:", error);
            element.style.color = "red";
            element.textContent = `Math Error: ${element.textContent}`;
        }
    });

    if (mathElements.length > 0) {
        console.debug(`Rendered ${mathElements.length} math expressions`);
    }
}
function cleanupMathPreviews(container = document) {
    container.querySelectorAll(".math-preview.katex-rendered").forEach((el) => {
        el.classList.remove("katex-rendered");
        // Store original content if not already stored
        if (!el.dataset.originalText) {
            el.dataset.originalText = el.textContent;
        }
        el.innerHTML = el.dataset.originalText;
    });
}
document.addEventListener("livewire:init", () => {
    renderAllMathPreviews();
    Livewire.hook("morph.updating", ({ el }) => {
        cleanupMathPreviews(el);
    });
    Livewire.hook("morph.updated", () => {
        setTimeout(() => {
            renderAllMathPreviews();
        }, 100);
    });
});
document.addEventListener('livewire:navigated', () => {
    renderAllMathPreviews();
})
document.addEventListener("DOMContentLoaded", () => {
    renderAllMathPreviews();
});

// windows
window.togglesubmenu = togglesubmenu;
window.showmenu = showmenu;
window.showFaq = showFaq;
window.toggleInput = toggleInput;
window.sidebarcollaps = sidebarcollaps;
window.toggleclass = toggleclass;
