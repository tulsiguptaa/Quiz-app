function submitQuiz(event) {
  event.preventDefault(); // Prevent form from reloading the page

  // Get form data and calculate score here
  console.log("Quiz submitted!");
}
// navbar page;
let menu =document.querySelector('#menu-icon');
let navbar =document.querySelector('.navbar');

menu.onclick = () => {
  menu.classList.toggle('bx-x');
  navbar.classList.toggle('open');
}
