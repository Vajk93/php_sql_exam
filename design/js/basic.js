//sticky 
window.onscroll = function() {
  let poz = window.scrollY;
  let menuHeader = document.querySelector('.navbarClass');
  let stickyMobile = document.querySelector('#mobileNavId');

  console.log(poz);
  if (poz > 65) {
    menuHeader.classList.add('sticky');
    stickyMobile.classList.add('stickyMobile');
  } else {
    menuHeader.classList.remove('sticky');
    stickyMobile.classList.remove('stickyMobile');
  }
}



// open mobil navbar
function toggleMobileNav() {
  let mobilToggleButton = document.getElementById('mobileNavId');

  if (mobilToggleButton.style.display === "none") {
    mobilToggleButton.style.display = "block";
  } else {
    mobilToggleButton.style.display = "none";
  }
}
