

$(document).ready(function(){
    $('#heroCarousel').owlCarousel({
        items:1,
        loop:false,
        autoplay:true,
        autoplayTimeout:5000,
        animateOut:'fadeOut',
        animateIn:'fadeIn',
        dots:true,
        nav:false
    });
      $('#testimonialCarousel').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        dots: false,
        nav: true,
        navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"]
    });
});

 const searchBtn = document.querySelector(".search-btn");
    const searchOverlay = document.getElementById("searchOverlay");
    const closeSearch = document.getElementById("closeSearch");

    searchBtn.addEventListener("click", (e) => {
      e.preventDefault();
      searchOverlay.style.display = "flex";
    });

    closeSearch.addEventListener("click", () => {
      searchOverlay.style.display = "none";
    });
