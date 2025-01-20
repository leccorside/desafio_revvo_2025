$(document).ready(function () {
    let currentIndex = 0;
    const slides = $(".slide");
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.removeClass("active");
        slides.eq(index).addClass("active");
        $(".slides").css("transform", `translateX(-${index * 100}%)`);
    }

    $(".next").click(function () {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    });

    $(".prev").click(function () {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        showSlide(currentIndex);
    });

    showSlide(currentIndex);
});
