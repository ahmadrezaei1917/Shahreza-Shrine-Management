<?php include "Checklogin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>مشاهده مشخصات</title>
  <?php include "Header.php"; ?>
  <style>
    .Font_Size {
      font-size: 20px;
    }

    @media print {
      /* *{
        visibility: hidden;
      } */

      .printable-form,
      .printable-form * {
        visibility: visible;
      }

      .printable-form {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        background: white !important;
      }

      .blur {
        background: none !important;
        backdrop-filter: none !important;
      }

      .text-light {
        color: #000 !important;
      }

      .border {
        border: 1px solid #000 !important;
      }

      .no-print {
        display: none !important;
      }
    }
  </style>

  <!--Main-->
  <?php include "connection.php";
  if (isset($_SESSION['user_type'])) {
    if (isset(($_GET['u_code']))) {
      if ($_SESSION['user_type'] === "پشتیبان" || $_SESSION['user_type'] === "مدیر آستان" || $_SESSION['user_type'] === "مسئول خادمین افتخاری" || $_SESSION['user_type'] === "مسئول فرهنگی آستان") {
        $u_code = $_GET['u_code'];
        $sql = "SELECT * FROM as_user WHERE u_code = :u_code";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':u_code' => $u_code]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
          die("کاربر مورد نظر یافت نشد!");
        }
      } elseif (isset($_SESSION['user_id'])) {
        $u_code = $_SESSION['user_id'];
        $sql = "SELECT * FROM as_user WHERE u_code = :u_code";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':u_code' => $u_code]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
          die("کاربر مورد نظر یافت نشد!");
        }
      }
    } elseif (isset($_SESSION['user_id'])) {
      $u_code = $_SESSION['user_id'];
      $sql = "SELECT * FROM as_user WHERE u_code = :u_code";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([':u_code' => $u_code]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$user) {
        die("کاربر مورد نظر یافت نشد!");
      }
    }
  } ?>
  <section>
    <div class="container py-6 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-12">
          <div class="blur card" style="border-radius: 1rem">
            <div class=" row g-0" style="border-radius: 1rem">
              <div class="col-md-12 col-lg-12 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-dark">

                  <form name="U_See_Details" action="Delete_User_Action.php" method="POST"
                    onsubmit="return confirmDelete()">
                    <div class="row">
                      <div class="col-md-3 col-1"></div>
                      <div class="mb-4 pb-1 text-center">
                        <span class="h1 mb-1">مشاهده مشخصات</span>



                        <div class="col-md-3 col-lg-4 col-1"></div>
                        <div class="row mt-3 justify-content-center">
                          <div class="col-12 col-lg-8 col-md-10">

                            <div class="col-12 col-lg-4 col-md-3 text-center">
                              <?php if (isset($_GET['success'])) {
                                if ($_GET['success'] == "deleted") { ?>
                                  <div class="alert alert-success mb-4 p-3 font-weight-bold" style="border-radius: 1rem">
                                    <i class="fas fa-check-circle"></i> کاربر با موفقیت حذف شد
                                  </div>
                              <?php }
                              } elseif (isset($_GET['error'])) {
                                if ($_GET['error'] == "database") { ?>
                                 <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                <i class="fas fa-times-circle"></i> خطایی رخ داده است!
                              </div>
                                <?php } elseif ($_GET['error'] == "not_found") { ?>
                                  <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                <i class="fas fa-times-circle"></i> کاربر پیدا نشد!
                              </div>
                                <?php }
                              } ?>
                            </div>
                          </div>
                        </div>


                          </div>
                          <!--Row 1-->
                          <div class="row">
                            <div class="pt-1 mb-3 col-lg-4 col-12 col-md-4 ">
                              <label class="form-label" for=""><i class="fas fa-id-card"></i> کد ملی / کد فیدا</label>
                              <input type="hidden" name="u_code" value="<?php echo htmlspecialchars($user['u_code']) ?>">
                              <p class=" w-100 form-control form-control-lg blur  border border-light text-center Font_Size"><?php echo htmlspecialchars($user['u_code']) ?>
                          </p>
                        </div>

                        <div class=" pt-1 mb-3 col-lg-4 col-12 col-md-4">
                                <label class="form-label" for=""><i class="fas fa-signature"></i> نام </label>
                              <p class=" w-100 form-control form-control-lg blur border border-light text-center Font_Size">
                                <?php echo htmlspecialchars($user['u_name']) ?>
                              </p>
                            </div>

                            <div class="pt-1 mb-3 col-lg-4 col-12 col-md-4">
                              <label class="form-label" for=""><i class="fas fa-signature"></i> نام خانوادگی</label>
                              <p class=" w-100 form-control form-control-lg blur border border-light text-center Font_Size">
                                <?php echo htmlspecialchars($user['u_family']) ?>
                              </p>
                            </div>
                          </div>
                          <!--Row 1-->

                          <!--Row 2-->
                          <div class="row">
                            <div class="pt-1 mb-3 col-lg-4 col-12 col-md-4">
                              <label class="form-label" for=""><i class="fas fa-signature"></i> نام پدر </label>
                              <p class=" w-100 form-control form-control-lg blur border border-light text-center Font_Size">
                                <?php echo htmlspecialchars($user['u_father_name']) ?>
                              </p>
                            </div>

                            <div class="pt-1 mb-3 col-lg-4 col-12 col-md-4">
                              <label class="form-label" for=""><i class="fas fa-phone"></i> شماره تماس </label>
                              <p class=" w-100 form-control form-control-lg blur border border-light text-center Font_Size">
                                <?php echo htmlspecialchars($user['u_phone']) ?>
                              </p>
                            </div>

                            <div class="pt-1 mb-3 col-lg-4 col-12 col-md-4">
                              <label class="form-label" for=""><i class="fas fa-phone"></i> شماره تماس مجازی </label>
                              <p class=" w-100 form-control form-control-lg blur border border-light text-center Font_Size">
                                <?php echo htmlspecialchars($user['u_virtual']) ?>
                              </p>
                            </div>
                          </div>
                          <!--Row 2-->

                          <!--Row 3-->
                          <div class="row justify-content-between">
                            <div class="pt-1 mb-3 col-lg-4 col-12 col-md-4">
                              <label class="form-label" for=""><i class="fas fa-graduation-cap"></i> مدرک تحصیلی</label>
                              <p class=" w-100 form-control form-control-lg blur border border-light text-center Font_Size">
                                <?php echo htmlspecialchars($user['u_education']) ?>
                              </p>
                            </div>

                            <div class="pt-1 mb-3 col-lg-4 col-12 col-md-4">
                              <label class="form-label" for=""><i class="fas bi-geo-alt-fill"></i> شهر محل زندگی </label>
                              <p class=" w-100 form-control form-control-lg blur border border-light text-center Font_Size">
                                <?php echo htmlspecialchars($user['u_city']) ?>
                              </p>
                            </div>

                            <div class="pt-1 mb-3 col-lg-4 col-12 col-md-4">
                              <label class="form-label" for=""><i class="fas fa-venus-mars"></i> جنسیت</label>
                              <p class=" w-100 form-control form-control-lg blur border border-light text-center Font_Size">
                                <?php echo htmlspecialchars($user['u_gender']) ?>
                              </p>
                            </div>
                          </div>
                          <!--Row 3-->

                          <!--Row 4-->

                          <div class="row justify-content-center">
                            <div class="pt-1 mb-3 col-lg-4 col-12 col-md-4">
                              <label class="form-label" for=""><i class="fas fa-globe"></i> تابعیت</label>
                              <p class=" w-100 form-control form-control-lg blur border border-light text-center Font_Size">
                                <?php echo htmlspecialchars($user['u_nation']) ?>
                              </p>
                            </div>

                            <div class="pt-1 mb-3 col-lg-4 col-12 col-md-4">
                              <label class="form-label" for=""><i class="fas fa-heart"></i> وضعیت تاهل</label>
                              <p class=" w-100 form-control form-control-lg blur border border-light text-center Font_Size">
                                <?php echo htmlspecialchars($user['u_marriage']) ?>
                              </p>
                            </div>

                            <div class="pt-1 mb-3 col-lg-4 col-12 col-md-4">
                              <label class="form-label" for=""><i class="fas fa-user-tag"></i> نوع کاربر</label>
                              <p class=" w-100 form-control form-control-lg blur border border-light text-center Font_Size">
                                <?php echo htmlspecialchars($user['u_type']) ?>
                              </p>
                            </div>

                          </div>

                          <!--Row 4-->

                          <!--Row 5-->



                          <!--Row 5-->
                          <!-- <div class="pt-1 my-4 no-print">
                        <button type="button" class="btn btn-dark btn-lg btn-block mb-3 col-md-4 col-lg-2 col-12"
                          onclick="printForm()">چاپ <i class="fas fa-print"></i></button>
                        <a href="<?php if (isset($_SESSION['user_type'])) {
                                    if (isset(($_GET['u_code']))) {
                                      if ($_SESSION['user_type'] === "پشتیبان" || $_SESSION['user_type'] === "مدیر آستان" || $_SESSION['user_type'] === "مسئول خادمین افتخاری" || $_SESSION['user_type'] === "مسئول فرهنگی آستان") {
                                        echo "U_Edit_Details.php?u_code=$u_code";
                                      } elseif (isset($_SESSION['user_id'])) {
                                        echo "U_Edit_Details.php";
                                      }
                                    } elseif (isset($_SESSION['user_id'])) {
                                      echo "U_Edit_Details.php";
                                    }
                                  } ?>">
                                  
                          <input name="Edit_details" type="button" value="تغییر اطلاعات"
                            class="btn btn-dark btn-lg btn-block mb-3 col-md-4 col-lg-2 col-12"></a>
                        <input type="submit" name="Delete" value="حذف حساب کاربری"
                          class="btn btn-dark btn-lg btn-block mb-3 col-md-4 col-lg-2 col-12"> -->
                          <div class="pt-1 my-4 no-print text-center">
                            <button type="button" class="btn btn-light blur btn-lg btn-block mb-3 col-md-4 col-lg-2 col-12 mx-2"
                              onclick="printForm()">
                              چاپ <i class="fas fa-print ml-2"></i>
                            </button>

                            <a href="<?php if (isset($_SESSION['user_type'])) {
                                        if (isset(($_GET['u_code']))) {
                                          if ($_SESSION['user_type'] === "پشتیبان" || $_SESSION['user_type'] === "مدیر آستان" || $_SESSION['user_type'] === "مسئول خادمین افتخاری" || $_SESSION['user_type'] === "مسئول فرهنگی آستان") {
                                            echo "U_Edit_Details.php?u_code=$u_code";
                                          } elseif (isset($_SESSION['user_id'])) {
                                            echo "U_Edit_Details.php";
                                          }
                                        } elseif (isset($_SESSION['user_id'])) {
                                          echo "U_Edit_Details.php";
                                        }
                                      } ?>">
                              <button name="Edit_details" type="button"
                                class="btn btn-light blur btn-lg btn-block mb-3 col-md-4 col-lg-2 col-12 mx-2">
                                تغییر اطلاعات <i class="fas fa-edit ml-2"></i>
                              </button>
                            </a>
                            <?php
                            if ($_SESSION['user_type'] === "پشتیبان" || $_SESSION['user_type'] === "مدیر آستان" || $_SESSION['user_type'] === "مسئول خادمین افتخاری" || $_SESSION['user_type'] === "مسئول فرهنگی آستان") {
                            ?>
                              <button type="submit" name="Delete"
                                class="btn btn-light blur btn-lg btn-block mb-3 col-md-4 col-lg-3 col-12 mx-2">
                                حذف حساب کاربری <i class="fas fa-trash-alt ml-2"></i>
                              </button>
                            <?php
                            } //end if
                            ?>
                          </div>
                  </form>

                  <script>
                    function confirmDelete() {
                      return confirm('آیا مطمئن هستید می‌خواهید حساب کاربری خود را حذف کنید؟ این عمل غیرقابل بازگشت است!');
                    }
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Main-->
  <script>
    function printForm() {
      window.print();
    }
  </script>
  <?php include "Footer.php"; ?>