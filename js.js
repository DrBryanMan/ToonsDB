// Add to header class for blur
window.onscroll = () => {
  let header = document.querySelector('header')
  window.scrollY > 0 ? header.classList.add('scrolled') : header.classList.remove('scrolled')
}

// Switch status of title buttons
const statusBtns = document.querySelectorAll('.list-buttons .status-btn')
statusBtns.forEach(btn => {
  // const isActive = btn.classList.contains('choosen')
  btn.onclick = (e) => {
    if (!e.target.classList.contains('choosen')) {
      statusBtns.forEach(el => {
        el.classList.remove('choosen')
        e.target.classList.add('choosen')
      })
    } else {
      e.target.classList.remove('choosen')
    }
  }
})

// Open sidebar
btnSidebar.onclick = () => {
  sidebar.classList.toggle('is-open')
}

// Auth window
signInBtn.onclick = () => {
  authWrapper.classList.add('is-visible')
}
authWrapperClose.onclick = () => {
  authWrapper.classList.remove('is-visible')
}

authSignUpBtn.onclick = () => {
  loginFormBox.classList.add('active')
}
authSignInBtn.onclick = () => {
  loginFormBox.classList.remove('active')
}