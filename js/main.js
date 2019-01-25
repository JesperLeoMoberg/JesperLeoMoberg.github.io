function showRegister(){
  document.getElementById("gswipe-front").removeAttribute('class');
  document.getElementById("gswipe-login").removeAttribute('class');
  document.getElementById("gswipe-register").classList.add("front");
}
function showLogin(){
  document.getElementById("gswipe-front").removeAttribute('class');
  document.getElementById("gswipe-register").removeAttribute('class');
  document.getElementById("gswipe-login").classList.add("front");
}
function showFront(){
  document.getElementById("gswipe-login").removeAttribute('class');
  document.getElementById("gswipe-register").removeAttribute('class');
  document.getElementById("gswipe-front").classList.add("front");
}
