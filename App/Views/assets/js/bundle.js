 // Get the modal
 var modal = document.getElementById("myModal");

 // Get the button that opens the modal
 var btn = document.getElementById("myBtn");

 // Get the <span> element that closes the modal
 var span = document.getElementById('close');

 // When the user clicks the button, open the modal 
 btn.onclick = function() {
     modal.style.display = "block";
     document.getElementById('overlay').style.display="none";
 }

 // When the user clicks on <span> (x), close the modal
 span.onclick = function() {
     modal.style.display = "none";
     document.getElementById('overlay').style.display="block";
 }

 // When the user clicks anywhere outside of the modal, close it
 window.onclick = function(event)
 {
     if (event.target == modal) {
         modal.style.display = "none";
     }
 }
         
const slideNumber = document.getElementById('slideNumber');

let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
 showSlides(slideIndex += n);
}

function currentSlide(n) {
 showSlides(slideIndex = n);
}

function showSlides(n) {

 let i;
 let slides = document.getElementsByClassName("mySlides");
 //let dots = document.getElementsByClassName("dot");
 if (n > slides.length) {slideIndex = 1}    
 if (n < 1) {slideIndex = slides.length}
 for (i = 0; i < slides.length; i++)
 {
   slides[i].style.display = "none";  
 }
 /**for (i = 0; i < dots.length; i++) {
   //dots[i].className = dots[i].className.replace(" active", "");
 }**/
 slides[slideIndex-1].style.display = "block";  
 slideNumber.innerHTML = '0'+slideIndex;
 //dots[slideIndex-1].className += " active";
}


function Rotator() {
       setTimeout(function () {
         
           plusSlides(1);
           Rotator();
       }, 6500);
}
Rotator();

