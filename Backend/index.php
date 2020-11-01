<?php
include_once ("backheader.php");
?>

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <div class="movie-reel-img">
        <center><p>The cinema at home!</p></center>
    </div>


    <!-- Slideshow container -->
    <div class="slideshow-container">

        <!-- Full-width slides/quotes -->
        <div class="mySlides">
            <q>May the Force be with you.</q>
            <p class="author">- Star Wars, 1977</p>
        </div>

        <div class="mySlides">
            <q>My mama always said life was like a box of chocolates. You never know what you're gonna get.</q>
            <p class="author">- Forrest Gump, 1994</p>
        </div>

        <div class="mySlides">
            <q>Keep your friends close, but your enemies closer.</q>
            <p class="author">- The Godfather Part II, 1974</p>
        </div>

        <div class="mySlides">
            <q>Bond. James Bond.</q>
            <p class="author">- Dr. No, 1962</p>
        </div>

        <div class="mySlides">
            <q>They may take our lives, but they'll never take our freedom!</q>
            <p class="author">- Braveheart, 1995</p>
        </div>

    </div>

    <!-- Dots/bullets/indicators -->
    <div class="dot-container">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
    </div>

<?php
include_once ("footer.php");

echo "<script>
var slideIndex = 0;
showSlides();


function showSlides() {
  var i;
  var slides = document.getElementsByClassName('mySlides');
  var dots = document.getElementsByClassName('dot');
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = 'none';
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(' active', '');
  }
  slides[slideIndex-1].style.display = 'block';
  dots[slideIndex-1].className += ' active';
  setTimeout(showSlides, 5000);
}
</script>";
