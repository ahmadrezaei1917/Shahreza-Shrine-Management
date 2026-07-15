<?php include "Checklogin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>پنل کاربری</title>
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
                        <span class="h1 mb-1"> پنل کاربری</span>
                        <div class="col-md-4 col-3"></div>
                      </div>
                    </div>
                    <!--Row 1-->
                    <div class="row justify-content-center">
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="U_See_Details.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg w-100" type="button">
                            <i class="fas fa-id-card"></i> مشاهده مشخصات
                          </button>
                        </a>
                      </div>
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="U_Edit_Details.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg w-100" type="button">
                            <i class="fas fa-user-edit"></i> تغییر مشخصات
                          </button>
                        </a>
                      </div>
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="U_Select_Shift_Date.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg btn-block w-100" type="button">
                            <i class="fas fa-calendar-alt"></i> انتخاب شیفت
                          </button>
                        </a>
                      </div>
                    </div>
                    <!--Row 1-->
                    <!--Row 2-->
                    <div class="row justify-content-center">
                     
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="U_Shifts_History.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg w-100" type="button">
                            <i class="fas fa-history"></i> تاریخچه شیفت ها
                          </button>
                        </a>
                      </div>
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="U_Edit_Password.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg btn-block w-100" type="button">
                            <i class="fas fa-key"></i> تغییر رمز ورود
                          </button>
                        </a>
                      </div>
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="U_Message_To_Admin.php" class="text-reset">
                          <button class="btn btn-light blur btn-lg btn-block w-100" type="button">
                            <i class="fas fa-envelope"></i> پیام به مدیریت
                          </button>
                        </a>
                      </div>
                     
                    </div>
                    <!--Row 2-->
                    <!--Row 3-->
                    <div class="row justify-content-center">
                    <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="" class="text-reset">
                          <button class="btn btn-light blur btn-lg w-100" type="button">
                            <i class="fas fa-calendar-alt"></i> تعریف نشده 
                          </button>
                        </a>
                      </div>
                    
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="" class="text-reset">
                          <button class="btn btn-light blur btn-lg btn-block w-100" type="button">
                            <i class="fas fa-edit"></i>  تعریف نشده
                          </button>
                        </a>
                      </div>
                      <div class="pt-1 mb-4 col-lg-3 col-12 col-md-3">
                        <a href="" class="text-reset">
                          <button class="btn btn-light blur btn-lg btn-block w-100" type="button">
                            <i class="fas fa-bullhorn"></i>  تعریف نشده
                          </button>
                        </a>
                      </div>
                    </div>
                    <!--Row 3-->
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