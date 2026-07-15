<?php include "Checklogin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>تغییر مشخصات</title>
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
                  <form name="Edit_Details_Form" action="Edit_Details_Action.php" method="POST">
                    <div class="row">
                      <div class="col-md-3 col-1"></div>
                      <div class="mb-4 pb-1 text-center">
                        <span class="h1 mb-1"> تغییر مشخصات </span>

                        <div class="col-md-3 col-1"></div>
                      </div>





                      <div class="col-md-3 col-lg-4 col-1"></div>

                      <div class="col-12 col-lg-4 col-md-3 text-center">
                        <?php if (isset($_GET['success'])) {
                          if ($_GET['success'] == "updated") { ?>
                          <div class="alert alert-success mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                <i class="fas fa-check-circle"></i> تغییرات با موفقیت ثبت شد
                              </div>
                          
                          <?php }
                        } elseif (isset($_GET['wrong'])) {
                          if ($_GET['wrong'] == "missing_field") { ?>
                           <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                <i class="fas fa-times-circle"></i> تغییرات ثبت نشد!
                              </div>
                          <?php } elseif ($_GET['wrong'] == "empty_field") { ?>
                            <div class="alert alert-warning mb-4 p-3 font-weight-bold" style="border-radius: 1rem">
                                <i class="fas fa-exclamation-triangle"></i> لطفا همه مقادیر را پر کنید!
                              </div>
                          <?php }
                        } elseif (isset($_GET['error'])) {
                          if ($_GET['error'] == "database") { ?>
                            <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                <i class="fas fa-times-circle"></i> خطایی رخ داده است!
                              </div>
                          <?php }
                        }  ?>
                      </div>
                      <div class="col-md-3 col-lg-4 col-1"></div>

                    </div>

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
                    <!--Row 1-->
                    <div class="row">
                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-id-card"></i> کد ملی / کد فیدا</label>
                        <input maxlength="12" type="text" name="u_code" id=""
                          value="<?php echo htmlspecialchars($user['u_code']) ?>"
                          class="blur w-100 form-control form-control-lg" required readonly />
                      </div>

                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-signature"></i> نام </label>
                        <input maxlength="40" type="text" name="u_name" id=""
                          value="<?php echo htmlspecialchars($user['u_name']) ?>"
                          class="blur w-100 form-control form-control-lg" required
                          <?php
                          if (isset($_SESSION['user_type'])) {
                            $allowed_types = ["پشتیبان", "مدیر آستان", "مسئول خادمین افتخاری", "مسئول فرهنگی آستان"];

                            if (!in_array($_SESSION['user_type'], $allowed_types)) {
                              echo "readonly";
                            }
                          } else {
                            header("location: login.php?error=user_type");
                            exit;
                          }
                          ?> />
                      </div>


                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-signature"></i> نام خانوادگی </label>
                        <input maxlength="40" type="text" name="u_family" id=""
                          value="<?php echo htmlspecialchars($user['u_family']) ?>"
                          class="blur w-100 form-control form-control-lg" required
                          <?php
                          if (isset($_SESSION['user_type'])) {
                            $allowed_types = ["پشتیبان", "مدیر آستان", "مسئول خادمین افتخاری", "مسئول فرهنگی آستان"];

                            if (!in_array($_SESSION['user_type'], $allowed_types)) {
                              echo "readonly";
                            }
                          } else {
                            header("location: login.php?error=user_type");
                            exit;
                          }
                          ?> />
                      </div>
                    </div>
                    <!--Row 1-->

                    <!--Row 2-->
                    <div class="row">
                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-signature"></i> نام پدر </label>
                        <input maxlength="40" type="text" name="u_father_name" id=""
                          value="<?php echo htmlspecialchars($user['u_father_name']) ?>"
                          class="blur w-100 form-control form-control-lg" required
                          <?php
                          if (isset($_SESSION['user_type'])) {
                            $allowed_types = ["پشتیبان", "مدیر آستان", "مسئول خادمین افتخاری", "مسئول فرهنگی آستان"];

                            if (!in_array($_SESSION['user_type'], $allowed_types)) {
                              echo "readonly";
                            }
                          } else {
                            header("location: login.php?error=user_type");
                            exit;
                          }
                          ?> />
                      </div>

                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-phone"></i> شماره تماس </label>
                        <input maxlength="11" type="text" name="u_phone" id=""
                          value="<?php echo htmlspecialchars($user['u_phone']) ?>"
                          class="blur w-100 form-control form-control-lg" required />
                      </div>

                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-phone"></i> شماره تماس مجازی</label>
                        <input maxlength="11" type="text" name="u_virtual" id=""
                          value="<?php echo htmlspecialchars($user['u_virtual']) ?>"
                          class="blur w-100 form-control form-control-lg" />
                      </div>
                    </div>
                    <!--Row 2-->

                    <!--Row 3-->
                    <div class="row">
                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-graduation-cap"></i> مدرک تحصیلی </label>
                        <input maxlength="40" type="text" name="u_education" id=""
                          value="<?php echo htmlspecialchars($user['u_education']) ?>"
                          class="blur w-100 form-control form-control-lg" required />
                      </div>

                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="bi bi-geo-alt-fill"></i> استان محل زندگی </label>
                        <input maxlength="100" type="text" name="u_state" id=""
                          value="<?php echo htmlspecialchars($user['u_state']) ?>"
                          class="blur w-100 form-control form-control-lg" required />
                      </div>


                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="bi bi-geo-alt-fill"></i> شهر محل زندگی </label>
                        <input maxlength="100" type="text" name="u_city" id=""
                          value="<?php echo htmlspecialchars($user['u_city']) ?>"
                          class="blur w-100 form-control form-control-lg" required />
                      </div>



                    </div>
                    <!--Row 3-->

                    <!--Row 4-->

                    <div class="row">



                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-venus-mars"></i> جنسیت </label>
                        <input maxlength="40" type="text" name="u_gender" id=""
                          value="<?php echo htmlspecialchars($user['u_gender']) ?>"
                          class="blur w-100 form-control form-control-lg" required
                          <?php
                          if (isset($_SESSION['user_type'])) {
                            $allowed_types = ["پشتیبان", "مدیر آستان", "مسئول خادمین افتخاری", "مسئول فرهنگی آستان"];

                            if (!in_array($_SESSION['user_type'], $allowed_types)) {
                              echo "readonly";
                            }
                          } else {
                            header("location: login.php?error=user_type");
                            exit;
                          }
                          ?> />
                      </div>

                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-globe"></i> تابعیت </label>
                        <input maxlength="40" type="text" name="u_nation" id=""
                          value="<?php echo htmlspecialchars($user['u_nation']) ?>"
                          class="blur w-100 form-control form-control-lg" required />
                      </div>


                      <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-heart"></i> وضعیت تاهل </label>
                        <input maxlength="40" type="text" name="u_marriage" id=""
                          value="<?php echo htmlspecialchars($user['u_marriage']) ?>"
                          class="blur w-100 form-control form-control-lg" required />
                      </div>



                      <!--Row 4-->

                      <!--Row 5-->

                      <div class="row">

                        <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                          <label class="form-label" for=""><i class="fas fa-user-tag"></i> نوع کاربر </label>
                          <input maxlength="40" type="text" name="u_type" id=""
                            value="<?php echo htmlspecialchars($user['u_type']) ?>"
                            class="blur w-100 form-control form-control-lg" required
                            <?php
                            if (isset($_SESSION['user_type'])) {
                              $allowed_types = ["پشتیبان"];

                              if (!in_array($_SESSION['user_type'], $allowed_types)) {
                                echo "readonly";
                              }
                            } else {
                              header("location: login.php?error=user_type");
                              exit;
                            }
                            ?> />
                        </div>



                        <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                          <label class="form-label" for=""><i class="fas fa-star-and-crescent"></i> دین </label>
                          <input maxlength="40" type="text" name="u_religion" id=""
                            value="<?php echo htmlspecialchars($user['u_religion']) ?>"
                            class="blur w-100 form-control form-control-lg" required />
                        </div>


                        <div class="pt-1 mb-4 col-lg-4 col-12 col-md-4">
                          <label class="form-label" for=""><i class="fas fa-pray"></i> مذهب </label>
                          <input maxlength="40" type="text" name="u_sect" id=""
                            value="<?php echo htmlspecialchars($user['u_sect']) ?>"
                            class="blur w-100 form-control form-control-lg" required />
                        </div>

                      </div>

                      <!--Row 5-->
                      <div class="pt-1 my-4 text-center">
                        <button class="btn btn-light blur col-12 col-md-3 col-lg-2" name="Edit_Details" type="submit">ثبت <i class="fas fa-save"></i></button>
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