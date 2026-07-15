<?php include "Checklogin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>تغییر رمز عبور</title>
  <?php include "Header.php"; ?>

  <!--Main-->

  <div class="container py-6 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-4">
        <div class="blur card rounded-3">
          <div class=" row g-0 rounded-3">
            <div class="col-md-12 col-lg-12 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-dark">
                <form action="Edit_Password_Action.php" method="POST" name="edit_password_form">
                  <div class="d-flex align-items-center mb-3 pb-1 text-center">
                    <span class="h2 fw-bold mb-0 w-100">ویرایش رمز عبور</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px"></h5>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">
                      <i class="fas fa-lock"></i> رمز عبور فعلی
                    </label>
                    <input type="password" name="current_password" id="form2Example17"
                      class="blur form-control form-control-lg" required />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">
                      <i class="fas fa-lock"></i>رمز عبور جدید
                    </label>
                    <input type="password" name="new_password" id="form2Example27"
                      class="blur form-control form-control-lg" required />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">
                      <i class="fas fa-lock"></i>تکرار رمز عبور جدید
                    </label>
                    <input type="password" name="confirm_new_password" id="form2Example27"
                      class="blur form-control form-control-lg" required />
                  </div>

                  <div><?php if (isset($_GET['error'])) {
                          if ($_GET['error'] == "pass_does_not_match") { ?>
                        <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                          <i class="fas fa-times-circle"></i> رمز جدید با تکرار آن مطاقبت ندارد!
                        </div>
                      <?php } elseif ($_GET['error'] == "wrong_pass") { ?>
                        <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                          <i class="fas fa-times-circle"></i> رمز عبور فعلی اشتباه است!
                        </div>
                      <?php }
                        }
                        if (isset($_GET['success'])) {
                          if ($_GET['success'] == "password_changed") { ?>
                        <div class="alert alert-success mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                          <i class="fas fa-check-circle"></i> رمز با موفقیت عوض شد
                        </div>
                    <?php }
                        }
                    ?>
                  </div>

                  <div class="pt-1 mb-4">
                    <a href="Home.html">
                      <button class="btn btn-ligh blur btn-lg btn-block col-12 justify-content-center align-items-center"
                        type="submit" name="">
                        <i class="fas fa-check"></i> ثبت
                      </button>
                    </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Main-->

  <?php include "Footer.php"; ?>