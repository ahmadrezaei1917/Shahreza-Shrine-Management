<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تماس با ما - گروه مهندسی آنتیک</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .blur {
            background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }

        .background {
            background-image: url(Pictures/About_Us.jpg);
            background-size: contain;
            background-attachment: fixed;
        }

        .contact-card {
            border-radius: 10px;
            transition: all 0.3s;
            height: 100%;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .contact-icon {
            font-size: 2rem;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        .map-container {
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
            min-height: 300px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
        }

        .btn-submit {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
        }
    </style>
</head>

<body class="background">

    <!-- نوار ناوبری -->
    <nav class="navbar navbar-expand-lg align-items-center justify-content-center blur my-5 container" style="border-radius: 1rem">
        <div class="container">
            <a class="navbar-brand" href="#">گروه مهندسی آنتیک</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">خانه</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="P_About_Us.php">درباره ما</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="P_Contact_Us.php">تماس با ما</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:history.back()">
                            <i class="fas fa-arrow-left"></i> برگشت
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- بخش اصلی تماس با ما -->
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="blur p-4 p-md-5" style="border-radius: 1rem;">
                    <h2 class="text-center mb-4">تماس با گروه مهندسی آنتیک</h2>
                    <p class="text-center text-dark mb-5">برای ارتباط با ما می‌توانید از راه‌های زیر استفاده کنید</p>
                    
                    <div class="row g-4 mb-5">
                        <!-- کارت تماس 1 -->
                        <div class="col-md-4">
                            <div class="contact-card bg-white p-4 h-100 text-center">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h4>تلفن تماس</h4>
                                <p class="text-dark">۰۹۰۱۵۵۷۸۵۶۵</p>
                                <p class="text-dark">۰۹۱۴۰۳۹۳۸۷۱</p>
                            </div>
                        </div>
                        
                        <!-- کارت تماس 2 -->
                        <div class="col-md-4">
                            <div class="contact-card bg-white p-4 h-100 text-center">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h4>ایمیل</h4>
                                <p class="text-dark">ahmad.rezaei.1917@icloud.com</p>
                                <p class="text-dark">shokouhibenyamin@gmail.com</p>
                            </div>
                        </div>
                        
                        <!-- کارت تماس 3 -->
                        <div class="col-md-4">
                            <div class="contact-card bg-white p-4 h-100 text-center">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4>آدرس</h4>
                                <p class="text-dark">کیلومتر 5 جاده شهرضا اصفهان - دانشگاه ملی مهارت واحد شهرضا</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        <!-- فرم تماس -->
                        <div class="col-lg-6">
                            <div class="bg-white p-4 h-100" style="border-radius: 1rem;">
                                <h4 class="mb-4">فرم ارتباط با ما</h4>
                                <form id="contactForm">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">نام کامل</label>
                                        <input type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">ایمیل</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">تلفن همراه</label>
                                        <input type="tel" class="form-control" id="phone" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">موضوع</label>
                                        <select class="form-select" id="subject" required>
                                            <option value="" selected disabled>انتخاب موضوع</option>
                                            <option value="پیشنهاد">پیشنهاد</option>
                                            <option value="انتقاد">انتقاد</option>
                                            <option value="همکاری">درخواست همکاری</option>
                                            <option value="سایر">سایر</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">پیام شما</label>
                                        <textarea class="form-control" id="message" rows="4" required></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-submit">
                                            <i class="fas fa-paper-plane"></i> ارسال پیام
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- نقشه -->
                        <div class="col-lg-6">
                            <div class="bg-white p-4 h-100" style="border-radius: 1rem;">
                                <h4 class="mb-4">موقعیت مکانی دانشگاه</h4>
                                <div class="map-container">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.789012345678!2d51.7890123456789!3d32.12345678901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzLCsDA3JzI0LjQiTiA1McKwNDcnMjQuNCJF!5e0!3m2!1sen!2sir!4v1234567890123!5m2!1sen!2sir" 
                                            width="100%" 
                                            height="100%" 
                                            style="border:0;" 
                                            allowfullscreen="" 
                                            loading="lazy" 
                                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="https://maps.google.com/?q=32.123456,51.789012" target="_blank" class="btn btn-outline-primary">
                                        <i class="fas fa-map-marked-alt"></i> مشاهده در نقشه بزرگتر
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- پاورقی -->
    <footer class="text-center text-lg-start text-dark blur container my-5" style="border-radius: 1rem">
        <div class="container">
            <div class="row p-5">
                <div class="col-md-6">
                    <h5>تماس با ما</h5>
                    <p>آدرس : کیلومتر 5 جاده شهرضا اصفهان</p>
                    <p>تلفن: 09015578565-09140393871</p>
                    <p>ایمیل: ahmad.rezaei.1917@icloud.com - shokouhibenyamin@gmail.com</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>لینک‌های مفید</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">صفحه اصلی</a></li>
                        <li><a href="P_About_Us.php" class="text-dark">درباره ما</a></li>
                        <li><a href="P_Contact_Us.php" class="text-dark">تماس با ما</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-3 pb-2">
                <p>کلیه حقوق این سایت متعلق به گروه مهندسی آنتیک می‌باشد. © ۱۴۰۳</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // اسکریپت ارسال فرم
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // نمایش پیام موفقیت
            alert('پیام شما با موفقیت ارسال شد. با تشکر از ارتباط شما');
            
            // ریست کردن فرم
            this.reset();
        });
    </script>
</body>

</html>