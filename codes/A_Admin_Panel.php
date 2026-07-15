<?php include "Checklogin.php"; ?>
<?php include "Check_Admin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>پنل مدیریت</title>
  <?php include "Header.php"; ?>

  <!--Main-->
  <section>
    <div class="container py-6 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-12">
          <div class="blur card" style="border-radius: 1rem">
            <div class=" row g-0" style="border-radius: 1rem">
              <div class="col-md-12 col-lg-12 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-dark">
                  <form>
                    <div class="row">
                      <div class="col-md-4 col-3"></div>
                      <div class="mb-5 pb-1 col-md-4 text-center col-6">
                        <span class="h1 mb-1 w-100">پنل مدیریت</span>
                        <div class="col-md-4 col-3"></div>
                      </div>
                    </div>
                    <!--Row 1-->
                    <div class="row justify-content-center">
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="A_Create_User.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg w-100" type="button">
                            <i class="fas fa-user-plus"></i> تعریف کاربر جدید
                          </button>
                        </a>
                      </div>
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="A_See_Users.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg w-100" type="button">
                            <i class="fas fa-users"></i> مشاهده کاربران
                          </button>
                        </a>
                      </div>
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="A_Create_Shift.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg w-100" type="button">
                            <i class="fas fa-calendar-plus"></i> تعریف شیفت
                          </button>
                        </a>
                      </div>
                    </div>
                    <!--Row 1-->
                    <!--Row 2-->

                    <div class="row justify-content-center">
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="A_Create_Shift_2.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg btn-block w-100" type="button">
                            <i class="fas fa-calendar-plus"></i> تعریف شیفت مناسبتی
                          </button>
                        </a>
                      </div>
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="A_See_Shifts.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg btn-block w-100" type="button">
                            <i class="fas fa-calendar-alt"></i> شیفت های انتخابی کاربران
                          </button>
                        </a>
                      </div>
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="U_See_Details.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg btn-block w-100" type="button">
                            <i class="fas fa-user"></i> اطلاعات شخصی
                          </button>
                        </a>
                      </div>

                    </div>
                    <!--Row 2-->
                    <!--Row 3-->

                    <div class="row justify-content-center">
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="A_Defined_shifts.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg btn-block w-100" type="button">
                          <i class="fas fa-calendar-alt"></i>  شیفت های تعریف شده
                          </button>
                        </a>
                      </div>
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="A_New_Notice.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg btn-block w-100" type="button">
                            <i class="fas fa-bullhorn"></i>اطلاعیه جدید
                          </button>
                        </a>
                      </div>
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="A_Notice_History.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg btn-block w-100" type="button">
                            <i class="fas fa-bullhorn"></i> تاریخچه اطلاعیه ها
                          </button>
                        </a>
                      </div>
                      <!--Row 3-->

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Main-->

  <?php include "Footer.php"; ?>