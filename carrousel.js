let current_slide = 0;
showSlide(current_slide);

function showSlide(n) {
    const slides = document.getElementsByClassName("slideshow_img");
    if (n >= slides.length) current_slide = 0;
    if (n < 0) current_slide = slides.length - 1;

    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slides[current_slide].style.display = "block";
}

function next() {
    current_slide++;
    showSlide(current_slide);
}

function previous() {
    current_slide--;
    showSlide(current_slide);
}
