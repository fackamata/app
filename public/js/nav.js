const btnToggle = document.querySelector('.btn-toggle');
const links = document.querySelector('.links');

btnToggle.addEventListener('click', function() {
    links.classList.toggle('show-links')
})

// if window min-width 900px allways add .show-links
// window.addEventListener("resize", function() {
//     if (window.matchMedia("(max-width: 900px)").matches) {
//         btnToggle.style.display = 'block';
//         if(links.classList.contains('show-links')){
//             links.classList.remove('show-links')
//             // console.log('moins de block');
//         }
//     }else{
//         btnToggle.style.display = 'none';
//         if(links.classList.contains('show-links')){
//             links.classList.add('show-links')
//             console.log('plus de none');
//         }
//     }
// })

