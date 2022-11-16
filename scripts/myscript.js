// Get the back to top button:
let mybutton = document.getElementById("myBtnTop");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

// Navigation and additional style for active page
const homePage = document.getElementById('homePage')
const hpLink = document.getElementById('HP')

const aboutPage = document.getElementById('aboutPage')
const abLink = document.getElementById('AB')

const postsPage = document.getElementById('postsPage')
const psLink = document.getElementById('PS')

const signupPage = document.getElementById('signupPage')
const suLink = document.getElementById('SU')

const createpostPage = document.getElementById('createpostPage')
const cpLink = document.getElementById('CP')

const uploadPage = document.getElementById('uploadPage')
const upLink = document.getElementById('UPL')

// For mobile menu
const pillsHomeTab = document.getElementById('pillsHomeTab')
const pillsAboutTab = document.getElementById('pillsAboutTab')
const pillsPostsTab = document.getElementById('pillsPostsTab')
const pillsCreatePostTab = document.getElementById('pillsCreatePostTab')
const pillsSignUpTab = document.getElementById('pillsSignUpTab')
const pillsUploadPostTab = document.getElementById('pillsUploadPostTab')

if (homePage) {
  hpLink.style.color = '#F7F7F7';
  pillsHomeTab.classList.add("active");
} else if (aboutPage) {
  abLink.style.color = '#F7F7F7';
  pillsAboutTab.classList.add("active");
} else if (postsPage) {
  psLink.style.color = '#F7F7F7';
  pillsPostsTab.classList.add("active");
} else if (signupPage) {
  suLink.style.color = '#F7F7F7';
  pillsSignUpTab.classList.add("active");
} else if (createpostPage) {
  cpLink.style.color = '#F7F7F7';
  pillsCreatePostTab.classList.add("active");
} else if (uploadPage) {
  upLink.style.color = '#F7F7F7';
  pillsUploadPostTab.classList.add("active");
} else {
  
}

function myFunction() {
  var element = document.getElementById("myDIV");
  element.classList.add("mystyle");
}