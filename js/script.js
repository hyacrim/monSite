// menu responsive code
var menu = document.querySelector('.menu');
var menu_tout = document.querySelector('.menu_tout');

menu_tout.onclick = function(){
   menu_tout.classList.toggle('active');
   menu.classList.toggle('responsive');
}

//site animation

const header = document.querySelector('header');
const title_span = document.querySelectorAll('.gauche h1 span');
const p = document.querySelector('.gauche p');
const a = document.querySelector('.gauche a');


window.addEventListener('load',()=>{
   
    const TL = gsap.timeline({paused: true});
    TL
    .staggerFrom(header , 2 , {y:-100 , opacity:0, ease: "power2.out"}, 0.1)
    .staggerFrom(title_span, 1 , {opacity:0, ease: "power2.out"}, 0.25)
    .staggerFrom(p, 1 , {opacity:0, ease: "power2.out"}, 0.5)
    .staggerFrom(a , 1 , {opacity:0, ease: "power2.out"}, 1)
    
    TL.play()
});







let glisseIndex = 1;
diaporamas(glisseIndex);

function changeimg(n) {
  diaporamas(glisseIndex += n);
}

function diaporamas(n) {
  let slides = document.getElementsByClassName("glisse");
  if (n > slides.length) {
    glisseIndex = 1;
  }
  if (n < 1) {
    glisseIndex = slides.length;
  }
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[glisseIndex - 1].style.display = "block";
}
