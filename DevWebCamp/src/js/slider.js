import Swiper from "swiper";
import { FreeMode, Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";

document.addEventListener("DOMContentLoaded", function() {

    if (document.querySelector(".slider")) {
        const opciones = {
            slidesPerView: 1,
            spaceBetween: 15,
            FreeMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            },
            modules: [FreeMode, Navigation],
                
        }
        Swiper.use([Navigation]);
        new Swiper(".slider", opciones);

    }
});