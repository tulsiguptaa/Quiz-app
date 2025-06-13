function submitQuiz(event) {
  event.preventDefault(); // Prevent form from reloading the page
  console.log("Quiz submitted!");
}

const form_outer = document.querySelector('.form-outer');
const log_in = document.querySelectorAll('.log-in');
const sign_up = document.querySelector('.sign-up');
const register = document.querySelector('.form-box.Register');
const login = document.querySelector('.form-box.Login');
const infoLogin = document.querySelector('.info.Login');
const infoRegister = document.querySelector('.info.Register');

// Set initial state
login.style.display = "flex";
register.style.display = "none";
infoLogin.style.display = "flex";
infoRegister.style.display = "none";

// Sign Up click handler
sign_up.addEventListener('click', (e) => {
  e.preventDefault();
  login.style.display = "none";
  register.style.display = "flex";
  infoLogin.style.display = "none";
  infoRegister.style.display = "flex";
  form_outer.classList.add('active');
});

// Sign In click handler for all sign-in links
log_in.forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    register.style.display = "none";
    login.style.display = "flex";
    infoRegister.style.display = "none";
    infoLogin.style.display = "flex";
    form_outer.classList.remove('active');
  });
});
// navbar page;
let menu =document.querySelector('#menu-icon');
let navbar =document.querySelector('.navbar');

menu.onclick = () => {
  menu.classList.toggle('bx-x');
  navbar.classList.toggle('open');
}
