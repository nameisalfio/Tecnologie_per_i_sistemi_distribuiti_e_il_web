$(document).ready(function () {

  $(".hamburger").on('click', function () {
    $(".menu").toggleClass("menu--open");
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
      $('.header').fadeOut();
    } else {
      $('.header').fadeIn();
    }
  });

  $("a[href^='#']").on('click', function (event) {
    event.preventDefault();
    var target = this.hash;
    $('html, body').animate({
      scrollTop: $(target).offset().top
    }, 500);
  });

  ScrollReveal().reveal('.reveal', { distance: '100px', duration: 1000, easing: 'cubic-bezier(.215, .61, .355, 1)', interval: 400 });

  ScrollReveal().reveal('.zoom', { duration: 1000, easing: 'cubic-bezier(.215, .61, .355, 1)', interval: 150, scale: 0.65, mobile: false });

});