
// ***************************************************************************
//
//	******************		Image Modal			******************************
//
// ***************************************************************************

var modal = document.getElementById("myModal");

var img = document.getElementsByClassName("image_to_display");
var modalImg = document.getElementById("img01");
let source = img[0].getAttribute('data-url');
let alt = img[0].getAttribute('alt');
var captionText = document.getElementById("caption");
let closeBtn = document.getElementsByClassName('close');

img[0].addEventListener("click", (ev) => {
	modal.style.display = "block";
	modalImg.src = source;
	captionText.innerHTML = alt;
})

// When the user clicks on the image, close the modal
modalImg.onclick = function() { 
  modal.style.display = "none";
}
// When the user clicks on the close button, close the modal
closeBtn[0].onclick = function() { 
  modal.style.display = "none";
}