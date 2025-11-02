function setNav(current_path) {
    fetch("nav.html")
        .then(r => r.text())
        .then(html => {
            
            document.getElementById("main-nav").innerHTML = html;

            
            const navLinks = document.getElementById("main-nav").querySelectorAll("a");
            navLinks.forEach(child => {
                if (splitAtRoot(child.href) === current_path) {
                    child.classList.add("current_page");
                }
            });
        });
}

function splitAtRoot(url) {
    return url.split('/').slice(-1)[0];
}
