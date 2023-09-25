authWrapperClose.onclick = () => {
  authWrapper.style.display = 'none'
}
signInBtn.onclick = () => {
  authWrapper.style.display = 'flex'
}

authSignUpBtn.onclick = () => {
  loginFormBox.classList.add('active')
}
authSignInBtn.onclick = () => {
  loginFormBox.classList.remove('active')
}

btnSidebar.onclick = () => {
  sidebar.classList.toggle('is-open')
  console.log("KK")
}

window.addEventListener('scroll', function() {
  let header = document.querySelector('header');
  if (window.scrollY > 0) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});