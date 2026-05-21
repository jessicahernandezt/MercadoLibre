const track = document.getElementById("track");
const dots = document.querySelectorAll(".dot");

let index = 0;
const totalSlides = dots.length;

// función para mover el carrusel
function moveSlide(i) {
    index = i;
    track.style.transform = "translateX(-" + (index * 100) + "%)";

    // actualizar dots
    dots.forEach(dot => dot.classList.remove("active"));
    dots[index].classList.add("active");
}

// evento en dots
dots.forEach(dot => {
    dot.addEventListener("click", () => {
        moveSlide(parseInt(dot.dataset.index));
    });
});

// autoplay
setInterval(() => {
    index++;
    if(index >= totalSlides){
        index = 0;
    }
    moveSlide(index);
}, 4000);

const btnNext = document.querySelector(".right");
const btnPrev = document.querySelector(".left");

btnNext.addEventListener("click", () => {
    index = (index + 1) % totalSlides;
    moveSlide(index);
});

btnPrev.addEventListener("click", () => {
    index = (index - 1 + totalSlides) % totalSlides;
    moveSlide(index);
});