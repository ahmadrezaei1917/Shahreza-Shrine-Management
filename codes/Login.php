<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>login</title>
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
    background-image: url(Pictures/Login.jpg);
    background-size: cover;
    background-attachment: fixed;
  }
</style>

<body dir="rtl" class="background">
  <section class="vh-100">
    <div class="container py-6 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-4">
          <div class="blur card" style="border-radius: 1rem">
            <div class=" row g-0" style="border-radius: 1rem">
              <div class="col-md-12 col-lg-12 d-flex align-items-center" style="border-radius: 1rem">
                <div class="card-body p-4 p-lg-5 text-dark" style="border-radius: 1rem">
                  <form name="login_form" action="Action.php" method="post">

                    <?php if (isset($_SESSION['login']) and $_SESSION['login'] === true): ?>
                      <div class="justify-content-center align-items-center text-center">
                        <span class="h4 my-5 fw-bold text-center justify-content-center">شما از قبل وارد شده اید</span>
                        <a href="Home.php">
                          <button
                            class="btn btn-dark btn-lg my-5 btn-block col-12 justify-content-center align-items-center"
                            type="button">
                            خانه
                          </button>
                        </a>
                      </div>
                    <?php else: ?>
                      <div class="d-flex align-items-center mb-3 pb-1 text-center">
                        <span class="h2 fw-bold mb-0 w-100">سامانه خادم یار</span>

                      </div>
                      <div class="d-flex align-items-center mb-3 pb-1 text-center">
                        <span class="h6 fw-bold mb-0 w-100">آستان مقدس امامزاده شاهرضا (ع)</span>
                      </div>
                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px"></h5>

                      <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">
                          <i class="fas fa-user"></i> نام کاربری
                        </label>
                        <input type="text" id="form2Example17" name="u_code" class=" form-control form-control-lg"
                          required />
                      </div>

                      <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">
                          <i class="fas fa-lock"></i> رمز عبور
                        </label>
                        <input type="password" id="form2Example27" name="u_password" class=" form-control form-control-lg"
                          required />
                      </div>

                      <div><?php if (isset($_GET['error'])) {
                        if ($_GET['error'] == "wrong_credentials") { ?>
                            <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                              <i class="fas fa-times-circle"></i> نام کاربری یا رمز عبور اشتباه است!
                            </div>
                          <?php } elseif ($_GET['error'] == "unauthorized") { ?>
                            <div class="alert alert-warning mb-4 p-3 font-weight-bold text-center"
                              style="border-radius: 1rem">
                              <i class="fas fa-exclamation-triangle"></i> لطفا ابتدا وارد شوید!
                            </div>
                          <?php }
                      } ?>
                      </div>
                      <div class="pt-1 mb-4">
                        <a href="Home.php">
                          <button class="btn btn-dark btn-block col-12 justify-content-center align-items-center"
                            type="submit" name="login">
                            <i class="fas fa-sign-in-alt"></i> ورود
                          </button>
                        </a>
                      </div>



                    <?php endif; ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="js/bootstrap.min.js"></script>
</body>

</html>