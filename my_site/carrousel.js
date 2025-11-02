let current_slide = 0;

function showSlide(n) {
  const slides = document.querySelectorAll('.slideshow_img');
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

// Initialisation
document.addEventListener('DOMContentLoaded', () => showSlide(current_slide));
