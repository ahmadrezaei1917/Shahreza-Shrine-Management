<?php include "Checklogin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>خانه</title>
  <?php include "Header.php"; ?>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>
    .swiper {
        height: 80vh; /* ارتفاع متناسب با ویوپورت */
        width: 100%;
        margin: 0 auto;
    }
    
    .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0px; /* فاصله از لبه */
    }
    
    .swiper-slide img {
        border-radius: 1rem;
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain; /* تغییر از cover به contain */
    }
    
    .container {
        padding-bottom: 0px; /* فاصله از پایین */
    }
</style>


 




<div class="container blur vh-100" style="border-radius: 1rem">
        <h1 class="text-center text-dark p-3">اطلاعیه‌ها</h1>
        
        <!-- اسلایدر Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- اسلاید 1 -->
                <div class="swiper-slide">
                    <img src="Pictures/Banner_6.jpg"  alt="اطلاعیه 1">
                </div>
                <!-- اسلاید 2 -->
                <div class="swiper-slide">
                    <img src="Pictures/Banner_7.jpg" alt="اطلاعیه 2">
                </div>
                <!-- اسلاید 3 -->
                <div class="swiper-slide">
                    <img src="Pictures/Banner_8.jpg" alt="اطلاعیه 3">
                </div>
            </div>
            <!-- دکمه‌های ناوبری -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- پاگینیشن -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- اضافه کردن Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            direction: 'horizontal',
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    </script>


  <?php include "Footer.php"; ?>