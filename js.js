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