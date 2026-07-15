<?php include "Checklogin.php"; ?>
<?php include "Check_Admin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ایجاد کاربر</title>
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
                  <form name="register_form" action="action.php" method="post">
                    <div class="row">
                      <div class="col-md-3 col-1"></div>
                      <div class="mb-4 pb-1 text-center">
                        <span class="h1 mb-1">تعریف کاربر جدید</span>

                        <div class="col-md-3 col-1"></div>
                      </div>

                      <div class="col-md-3 col-lg-4 col-1"></div>



                      <div class="row">
                        <div class="col-md-3 col-lg-4"></div>
                        <div class="col-12 col-lg-4 col-md-6 text-center">
                          <?php if (isset($_GET['success'])) {
                            if ($_GET['success'] == "user_created") {
                          ?>
                              <!-- پیام موفقیت ایجاد شیفت با استایل یکسان -->
                              <div class="alert alert-success mb-4 p-3 font-weight-bold" style="border-radius: 1rem">
                                <i class="fas fa-check-circle"></i> کاربر با موفقیت ثبت شد
                              </div>
                          <?php }
                          } ?>
                          <?php if (isset($_GET['error'])) {
                            if ($_GET['error'] == "user") { ?>
                              <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                <i class="fas fa-times-circle"></i> کاربر ثبت نشد!
                              </div>
                            <?php  } elseif ($_GET['error'] == "user_exists") { ?>
                              <div class="alert alert-warning mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                <i class="fas fa-exclamation-triangle"></i> کاربر قبلا ثبت شده است
                              </div>
                            <?php  } elseif ($_GET['error'] == "empty") { ?>
                              <div class="alert alert-warning mb-4 p-3 font-weight-bold" style="border-radius: 1rem">
                                <i class="fas fa-exclamation-triangle"></i>
                                لطفا همه مقادیر را پر کنید!
                              </div>
                          <?php }
                          } ?>
                        </div>
                        <div class="col-md-3 col-lg-4"></div>
                      </div>

                    </div>

                    <!--Row 1-->
                    <div class="row">
                      <div class="pt-1 mb-5 col-lg-3 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-id-card"></i> کد ملی / کد فیدا</label>
                        <input maxlength="12" type="text" name="u_code" id=""
                          class="blur w-100 form-control form-control-lg" required />
                      </div>

                      <div class="pt-1 mb-5 col-lg-3 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-lock"></i> رمز عبور</label>
                        <input type="password" name="u_password" id="" class="blur w-100 form-control form-control-lg"
                          required />
                      </div>

                      <div class="pt-1 mb-5 col-lg-3 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-signature"></i> نام</label>
                        <input type="text" name="u_name" id="" class="blur w-100 form-control form-control-lg"
                          required />
                      </div>

                      <div class="pt-1 mb-5 col-lg-3 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-signature"></i> نام خانوادگی</label>
                        <input type="text" name="u_family" id="" class="blur w-100 form-control form-control-lg"
                          required />
                      </div>
                    </div>
                    <!--Row 1-->

                    <!--Row 2-->
                    <div class="row">


                      <div class="pt-1 mb-5 col-lg-3 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-signature"></i> نام پدر</label>
                        <input type="text" name="u_father_name" id="" class="blur w-100 form-control form-control-lg"
                          required />
                      </div>

                      <div class="pt-1 mb-5 col-lg-3 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-phone"></i> شماره تماس</label>
                        <input maxlength="11" type="tel" name="u_phone" id=""
                          class="blur w-100 form-control form-control-lg" required />
                      </div>
                      <div class="pt-1 mb-5 col-lg-3 col-12 col-md-4">
                        <label class="form-label" for=""><i class="fas fa-phone"></i> شماره مجازی</label>
                        <input maxlength="11" type="tel" name="u_virtual" id=""
                          class="blur w-100 form-control form-control-lg" />
                      </div>

                      <div class="form-group pt-1 mb-5 col-lg-3 col-12 col-md-4">
                        <label class="form-label" for="exampleFormControlSelect1">
                          <i class="fas fa-graduation-cap"> مدرک تحصیلی</i></label>
                        <select name="u_education" class="form-control form-control-lg selectpicker blur w-100"
                          id="exampleFormControlSelect1" data-live-search="true" required>
                          <option value=""></option>
                          <option value="بی سواد">بی سواد</option>
                          <option value="در حال تحصیل">در حال تحصیل</option>
                          <option value="سیکل">سیکل</option>
                          <option value="دیپلم">دیپلم</option>
                          <option value="فوق دیپلم">فوق دیپلم</option>
                          <option value="لیسانس">لیسانس</option>
                          <option value="فوق لیسانس">فوق لیسانس</option>
                          <option value="دکترای تخصصی">دکترای تخصصی</option>
                        </select>
                      </div>
                    </div>
                    <!--Row 2-->

                    <!--Row 3-->
                    <div class="row justify-content-center">

                      <div class="pt-1 mb-3 col-lg-3 col-11 blur col-md-5 border border-light rounded-3 mx-3 mb-5">
                        <label class="form-label mx-3" for=""><i class="fas fa-venus-mars"></i> جنسیت</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="u_gender" id="Male" value="مرد" checked />
                          <label class="form-check-label mx-2" for="Male">
                            <i class="fas fa-male"></i> مرد
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="u_gender" id="Female" value="زن" />
                          <label class="form-check-label mx-2" for="Female">
                            <i class="fas fa-female"></i> زن
                          </label>
                        </div>
                      </div>

                      <div class="pt-1 mb-3 col-lg-3 blur col-11 col-md-5 border border-light rounded-3 mx-3 mb-5">
                        <label class="form-label mx-3" for=""><i class="fas fa-globe"></i> تابعیت</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="u_nation" id="" value="ایرانی" checked />
                          <label class="form-check-label mx-2" for="">
                            <i class="fas fa-flag"></i> ایرانی
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="u_nation" id="" value="اتباع خارجی" />
                          <label class="form-check-label mx-2" for="">
                            <i class="fas fa-flag"></i> اتباع خارجی
                          </label>
                        </div>
                      </div>

                      <div class="pt-1 mb-3 col-lg-3 col-11 col-md-5 blur border border-light rounded-3 mx-3 mb-5">
                        <label class="form-label mx-3" for=""><i class="fas fa-heart"></i> وضعیت تاهل</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="u_marriage" id="" value="متاهل" checked />
                          <label class="form-check-label mx-2" for="">
                            <i class="fas fa-ring"></i> متاهل
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="u_marriage" id="" value="مجرد" />
                          <label class="form-check-label mx-2" for="">
                            <i class="fas fa-user"></i> مجرد
                          </label>
                        </div>

                      </div>





                    </div>
                    <!--Row 3-->

                    <!--Row 4-->
                    <div class="row justify-content-center">



                      <div class="form-group pt-1 mb-4 col-lg-4 col-11 col-md-4 border border-light rounded-3 blur">
                        <label class="form-label" for=""><i class="bi bi-geo-alt-fill"></i>شهر محل زندگی </label>

                        <div class="col-lg-4 col-4 col-md-4 d-flex ir-select">
                          <label>استان</label>
                          <select required
                            class="blur col-lg-4 col-3 col-md-4 ir-province form-control m-2 selectpicker"
                            name="u_state"></select>
                          <label>شهر</label>
                          <select required class="blur col-lg-4 col-3 col-md-4 ir-city form-control m-2 selectpicker"
                            name="u_city"></select>
                        </div>
                        <!-- jQuery -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                        <!-- ir-city-select.js -->
                        <script src="js/ir-city-select.min.js"></script>
                      </div>

                      <div class="form-group col-lg-3 col-12 mb-4 col-md-3 mx-3 py-2">
                        <label for="exampleFormControlSelect1" class="form-label">
                          <i class="fas fa-user-tag"> نوع کاربر</i></label>
                        <select name="u_type" class="blur form-control form-control-lg selectpicker" id="exampleFormControlSelect1"
                          data-live-search="true" required>
                          <option value=""></option>
                          <?php
                          $user_type = $_SESSION['user_type'];
                          if ($user_type == "پشتیبان") {
                            echo "<option value='پشتیبان'>پشتیبان</option>
                                  <option value='مدیر آستان'>مدیر آستان</option>
                                  <option value='مسئول فرهنگی آستان'>مسئول فرهنگی آستان</option>
                                  <option value='مسئول خادمین افتخاری'>مسئول خادمین افتخاری</option>";
                          } elseif ($user_type == "مدیر آستان") {
                            echo "<option value='مدیر آستان'>مدیر آستان</option>
                                  <option value='مسئول فرهنگی آستان'>مسئول فرهنگی آستان</option>
                                  <option value='مسئول خادمین افتخاری'>مسئول خادمین افتخاری</option>";
                          } elseif ($user_type == "مسئول فرهنگی آستان") {
                            echo "<option value='مسئول فرهنگی آستان'>مسئول فرهنگی آستان</option>
                                  <option value='مسئول خادمین افتخاری'>مسئول خادمین افتخاری</option>";
                          } elseif ($user_type == "مسئول خادمین افتخاری") {
                            echo "<option value='مسئول خادمین افتخاری'>مسئول خادمین افتخاری</option>";
                          }
                          ?>
                          <option value="خادم افتخاری">خادم افتخاری</option>
                        </select>
                      </div>
                      <div class="pt-3 my-4 text-center col-md-4 col-lg-3 col-12">
                        <input name="register" type="submit" value="ثبت کاربر"
                          class="btn btn-light blur btn-lg btn-block col-md-4 w-100">

                        </button>
                      </div>
                    </div>

                    <!--Row 4-->

                    <!--Row 5-->

                    <div class="row justify-content-between">

                      <div class="form-group col-lg-2 col-11 col-md-3 mx-3 py-2">
                        <label hidden for="exampleFormControlSelect1"><i class="fas fa-star-and-crescent"></i>
                          دین</label>
                        <select hidden name="u_religion" class="blur form-control m-1 selectpicker"
                          id="exampleFormControlSelect1" data-live-search="true" required>
                          <!-- <option value=""></option> -->
                          <option value="اسلام">اسلام</option>
                          <option value="مسیحیت">مسیحیت</option>
                          <option value="یهودی">یهودی</option>
                          <option value="بودایی">بودایی</option>
                          <option value="هندو">هندو</option>
                        </select>
                      </div>

                      <div class="form-group col-lg-2 col-11 col-md-3 mx-3 py-2">
                        <label hidden for="exampleFormControlSelect1">
                          <i class="fas fa-pray"> مذهب </i></labelhidden>
                          <select hidden name="u_sect" class="blur form-control m-1 selectpicker"
                            id="exampleFormControlSelect1" data-live-search="true" required>
                            <!-- <option value=""></option> -->
                            <option value="شیعه">شیعه</option>
                            <option value="سنی">سنی</option>
                            <option value="اسمائیلی">اسمائیلی</option>
                            <option value="علوی">علوی</option>
                            <option value="حنفی">حنفی</option>
                          </select>
                      </div>
                    </div>
                    <!--Row 5-->

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