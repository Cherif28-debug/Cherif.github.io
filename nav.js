// NAVIGATION 
function setNav(current_path) {
    fetch("nav.html")
        .then(response => response.text())
        .then(html => {
            // Injecte le HTML du menu dans la page
            document.getElementById("main-nav").innerHTML = html;

            // Sélectionne tous les liens du menu
            const navLinks = document.getElementById("main-nav").querySelectorAll("a");

            // Met la classe current_page sur le lien correspondant
            navLinks.forEach(link => {
                if (getFileName(link.href) === current_path) {
                    link.classList.add("current_page");
                } else {
                    link.classList.remove("current_page");
                }
            });
        })
        .catch(error => console.error("Erreur lors du chargement du menu :", error));
}

// Fonction utilitaire pour recuperer uniquement le nom du fichier d'une URL
function getFileName(url) {
    return url.split('/').pop();
}

// CARROUSEL 
let current_slide = 0;
showSlide(current_slide);

function showSlide(n) {
    const slides = document.querySelectorAll('.slideshow_img');
    if (slides.length === 0) return; // securite si pas d'images
    if (n >= slides.length) current_slide = 0;
    if (n < 0) current_slide = slides.length - 1;
    slides.forEach(slide => slide.style.display = 'none');
    slides[current_slide].style.display = 'block';
}

function next() {
    current_slide++;
    showSlide(current_slide);
}

function previous() {
    current_slide--;
    showSlide(current_slide);
}
