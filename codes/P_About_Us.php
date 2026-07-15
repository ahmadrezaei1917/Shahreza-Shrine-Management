<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درباره ما</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
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

        .about-img {
            border-radius: 10px;
           
            margin-bottom: 20px;
            max-height: 300px;
            object-fit: cover;
        }

        .university-logo {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .about-section {
            background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            padding: 40px 0;
            border-radius: 10px;
            margin-top: 30px;
        }
    </style>
</head>

<body class="background">

    <!-- نوار ناوبری -->
    <nav class="navbar navbar-expand-lg align-items-center justify-content-center blur my-5 container"  style="border-radius: 1rem">
        <div class="container ">
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
                        <a class="nav-link active" href="P_About_Us.php">درباره ما</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="P_Contact_Us.php">تماس با ما</a>
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

    <!-- بخش اصلی درباره ما -->
    <div class="container my-5 text-dark">
        <div class="about-section">
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    <img src="pictures/University_Logo.png" alt="لوگوی دانشگاه" class="university-logo img-fluid">
                    <h2>دانشگاه ملی مهارت</h2>
                    <p>واحد شهرضا</p>
                </div>
                <div class="col-md-7">
                    <h1 class="mb-4">درباره ما</h1>
                    <p>هدف ما ارائه بهترین خدمات و اطلاعات به کاربران است. این پروژه با همکاری اساتید و دانشجویان
                        دانشگاه ملی مهارت توسعه یافته و در حال به روزرسانی مستمر است.</p>
                </div>
            </div>
        </div>

        <div class="row mt-5 about-section text-center">
            <div class="col-md-3">
                <img src="Pictures/Engineer_1.jpg" class="about-img img-fluid w-100">
                <h3>مهندس احمد رضایی</h3>
                <p>کارشناس بخش Front-End</p>
            </div>
            <div class="col-md-3">
                <img src="Pictures/Engineer_2.jpeg" class="about-img img-fluid w-100">
                <h3>مهندس بنیامین شکوهی</h3>
                <p>کارشناس بخش Back-End</p>
            </div>
            <div class="col-md-3">
                <img src="Pictures/Engineer_3.jpeg" class="about-img img-fluid w-100">

                <h3>دکتر محمد مهدی باغستانی</h3>
                <p>استاد راهنما</p>
            </div>
            
        </div>

        <div class="row mt-4 ">
            <div class="col-12 ">
                <div class="card blur text-dark">
                    <div class="card-body ">
                        <h3 class="card-title">تاریخچه سایت</h3>
                        <p class="card-text">این گروه مهندسی در سال 1404 با همکاری دانشگاه ملی مهارت تأسیس شد و از آن
                            زمان
                            تاکنون در حال توسعه و افزودن ویژگی‌های جدید بوده است. ما مفتخریم که توانسته‌ایم با پشتیبانی
                            دانشگاه شما، خدمات ارزشمندی به جامعه علمی کشور ارائه دهیم.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- پاورقی -->
    <footer class="text-center text-lg-start text-dark blur  container my-5"
      style="border-radius: 1rem"">
        <div class="container">
            <div class="row p-5">
                <div class="col-md-6">
                    <h5>تماس با ما</h5>
                    <p>آدرس : کیلومتر 5 جاده شهرضا اصفهان</p>
                    <p>تلفن: 09015578565-09140393871</p>
                    <p>ایمیل: ahmad.rezaei.1917@icloud.com-shokouhibenyamin@gamil.com</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>لینک‌های مفید</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">صفحه اصلی</a></li>
                        <li><a href="#" class="text-dark">درباره ما</a></li>
                        <li><a href="#" class="text-dark">تماس با ما</a></li>
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
</body>

</html>