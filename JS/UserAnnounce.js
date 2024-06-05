// FUNSTION SA SEE MORE AT SEE LESS 
document.addEventListener('DOMContentLoaded', function() {
  var PostTextcontainer = document.getElementById('containerForPostNa');
  var PotedNatextparagraph = PostTextcontainer.querySelector('.ditoMapupuntaYungPostText');
  var PostedNaspan = document.getElementById('spanForSeeMoreandSeeless');

  var wordCount = PotedNatextparagraph.textContent.split(/\s+/).length;
  if (wordCount > 40) {
      PostedNaspan.style.display = 'block'; // Display the span if word count > 40
  }

  PostedNaspan.addEventListener('click', function() {
      PostTextcontainer.classList.toggle('activeSeemoreandSeeless');
      PostedNaspan.textContent = PostTextcontainer.classList.contains('activeSeemoreandSeeless') ? 'See less' : 'See more';
  });
});


//FUNSTION SA SLIDING PICTURES 
let slideIndex = 1;
showSlide(slideIndex);

function changeSlide(n) {
showSlide(slideIndex += n);
}

function currentSlide(n) {
showSlide(slideIndex = n);
}

function showSlide(n) {
const slides = document.querySelectorAll('.ImagesInSlidingPosted img');
const dots = document.querySelectorAll('.dot');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

if (n > slides.length) {
  slideIndex = 1;
}
if (n < 1) {
  slideIndex = slides.length;
}
for (let i = 0; i < slides.length; i++) {
  slides[i].style.display = 'none';
}
for (let i = 0; i < dots.length; i++) {
  dots[i].className = dots[i].className.replace(' active', '');
}
slides[slideIndex - 1].style.display = 'block';
dots[slideIndex - 1].className += ' active';

// Hide or show navigation arrows based on slide position
if (slideIndex === 1) {
  prevButton.classList.add('hide');
  nextButton.classList.remove('hide');
} else if (slideIndex === slides.length) {
  prevButton.classList.remove('hide');
  nextButton.classList.add('hide');
} else {
  prevButton.classList.remove('hide');
  nextButton.classList.remove('hide');
}
}