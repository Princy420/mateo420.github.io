window.addEventListener('scroll', function() {
    const footer = document.querySelector('.footer');
    const footerPosition = footer.getBoundingClientRect().top;
    const screenPosition = window.innerHeight / 1.2;

    if (footerPosition < screenPosition) {
        footer.classList.add('visible');
    } else {
        footer.classList.remove('visible');
    }
});
