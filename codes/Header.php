<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <link rel="icon" type="image/x-icon" href="Pictures/Favicon.ico">
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/bootstrap.rtl.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
</head>
<style>
  .blur {
   background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px); 
  }
 
  .background {
    background-image: url(Pictures/3.jpg);
    background-size: contain;
    background-attachment: fixed;
  }
  @font-face {
      font-family: 'nazanin';
      src: url('Fonts/BNazanin.ttf') format('truetype'),
          
      font-style: normal;
      font-weight: normal;
    }

    .some-element {
      font-family: 'nazanin', sans-serif;
    }
</style>

<body dir="rtl" class="background">

  <nav class="navbar navbar-expand-lg align-items-center justify-content-center blur my-5 container"
    style="border-radius: 1rem">
    <div class="container-fluid">
      <a class="navbar-brand text-dark d-flex align-items-center" href="">
        <img src="Pictures/Logo.png" alt="Logo" style="height: 50px;" class="me-2">
        <h6 class="m-0">آستان مقدس امامزاده شاهرضا (ع)</h6>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-flex justify-content-between align-items-center">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link text-dark" href="Home.php">
                <i class="fas fa-home"></i> خانه
              </a>
            </li>

            <?php if (isset($_SESSION['user_type'])) {
              if ($_SESSION['user_type'] === "پشتیبان" || $_SESSION['user_type'] === "مدیر آستان" || $_SESSION['user_type'] === "مسئول خادمین افتخاری" || $_SESSION['user_type'] === "مسئول فرهنگی آستان") {
                echo '<li class="nav-item">
              <a class="nav-link text-dark" href="A_Admin_Panel.php">
                <i class="fas fa-user-cog"></i> پنل مدیریت
              </a>
            </li>';
              }
            }
            ?>
            <?php if (isset($_SESSION['user_type'])) {
              if ($_SESSION['user_type'] === "خادم افتخاری") {
                echo '<li class="nav-item">
                  <a class="nav-link text-dark" href="U_User_Panel.php">
                  <i class="fas fa-user"></i> پنل کاربری
                  </a>
                </li>';
              }
            }
            ?>
            <li class="nav-item">
              <a class="nav-link text-dark" href="javascript:history.back()">
                <i class="fas fa-arrow-left"></i> برگشت
              </a>
            </li>
            <li class="nav-item d-lg-none" id="closeMenuButton">
              <a class="nav-link text-dark" href="">
                <i class="fas fa-window-close"></i> بستن
              </a>
            </li>
            <li class="nav-item" style="border-radius: 1rem;">
              <a class="nav-link text-dark" href="logout.php">
                <i class="fas fa-sign-out-alt"></i> خروج
              </a>
            </li>
            <li class="col-12 d-block d-lg-none">
              <a class="nav-link text-dark" style="border-radius: 1rem;" href="U_See_Details.php">
                <i class="fas fa-user"></i>
                <?php echo $_SESSION['user_type'] . " : " . $_SESSION['user_name'] . " " . $_SESSION['u_family']; ?>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-2 d-none d-lg-block">
      <a class="nav-link text-dark p-2" style="border-radius: 1rem;" href="U_See_Details.php">
        <i class="fas fa-user"></i>
        <?php echo $_SESSION['user_type'] . " : " . $_SESSION['user_name'] . " " . $_SESSION['u_family']; ?>
      </a>

    </div>
  </nav>
  <script>
    const navbarCollapse = document.getElementById('navbarSupportedContent');
    const closeMenuButton = document.getElementById('closeMenuButton');

    closeMenuButton.addEventListener('click', function () {
      navbarCollapse.classList.remove('show');
    });
  </script>