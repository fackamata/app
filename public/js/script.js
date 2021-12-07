
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
// var img = document.getElementsByClassName('image_to_display');
// var img = document.getElementById("imgAnnonce");
var img = document.getElementsByClassName("image_to_display");
var modalImg = document.getElementById("img01");
console.log(img[0])
let source = img[0].getAttribute('data-url');
let alt = img[0].getAttribute('alt');
var captionText = document.getElementById("caption");
img[0].addEventListener("click", (ev) => {
	modal.style.display = "block";
	console.log(ev)
	modalImg.src = source;
	captionText.innerHTML = alt;
})
// img.onclick = function(){
// 		console.log('clicked')
		// modal.style.display = "block";
		// modalImg.src = this.src;
		// captionText.innerHTML = this.alt;

	// };


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}