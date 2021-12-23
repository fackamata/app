let links = document.getElementsByClassName('nav-link'); 

console.log(links)
for(let link in links){
    console.log(link)
    // link.addEventListener("click", () => {
    //     console.log(link)
    //     link.toggle("active");
    // })
};

function collapse() {
    var x = document.getElementById("navbar-collapse");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }