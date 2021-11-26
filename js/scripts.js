/*!
* Start Bootstrap - Agency v7.0.10 (https://startbootstrap.com/theme/agency)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-agency/blob/master/LICENSE)
*/
//
// Scripts
// 
// Select all links with hashes

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            offset: 74,
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});
function mouseover(id, enter) {
    if (enter) {
        document.getElementById(id).src = ('assets/img/team/' + id + '.jpg');
    } else {
        document.getElementById(id).src = ('assets/img/team/' + id + '_blur.jpg');
    }

}
const setPrice = function (x, price) {
    var pickup_date = new Date($('#pickup' + x).val());
    var dropoff_date = new Date($('#dropoff' + x).val());
    var diffTime = Math.abs(dropoff_date - pickup_date);
    var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
    if (!(diffDays >= 0)) {
        diffDays = 0
    }

    var totalPrice = diffDays * price;
    var out = (Math.round(totalPrice * 100) / 100).toFixed(2);
    document.getElementById("price" + x).value = out;
}