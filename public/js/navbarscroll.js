const nav = document.getElementById('principalNav');

window.addEventListener('scroll', () => {
    if (window.scrollY  > 10)
    {
        nav.classList.add('fixed-top');
        nav.classList.add('bg-light');
    }
    else
    {
        nav.classList.remove('fixed-top');
        nav.classList.remove('bg-light');
    }
})