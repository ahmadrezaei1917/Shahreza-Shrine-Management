<?php include "Checklogin.php"; ?>
<?php include "Check_Admin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ایجاد شیفت مناسبتی</title>

  <!-- استایل تقویم شمسی فقط یک بار -->
  <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">

  <!-- jQuery فقط یک بار و حتما قبل از پلاگین -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- پلاگین تقویم شمسی -->
  <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>

  <!-- استایل و اسکریپت‌های دیگر مثل flatpickr برای ساعت -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <?php include "Header.php"; ?>
</head>




  <!--Main-->
  <section>
    <div class="container py-6 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-10 col-lg-8 col-xl-7">
          <div class="blur card" style="border-radius: 1rem">
            <div class=" row g-0" style="border-radius: 1rem">
              <div class="col-md-12 col-lg-12 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-dark">
                  <form name="Create_Shift_2_form" action="A_Create_Shift_2_Action.php" method="POST">
                    <div class="d-flex align-items-center mb-3 pb-1 text-center">
                      <div class="container">
                        <div class="container">
                          <span class="h2 fw-bold mb-0 w-100 d-block text-center">
                            <i class="fas fa-calendar-plus"></i> ایجاد شیفت مناسبتی
                          </span>

                          <div class="row mt-3 justify-content-center">
                            <div class="col-12 col-lg-8 col-md-10">
                              <?php
                              if (isset($_GET['error'])) {
                                if ($_GET['error'] == "invalid_request") {
                                  ?>
                                  <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center"
                                    style="border-radius: 1rem">
                                    <i class="fas fa-times-circle"></i> درخواست نامعتبر است!
                                  </div>
                                  <?php
                                } elseif ($_GET['error'] == "invalid_max_users") {
                                  ?>
                                  <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center"
                                    style="border-radius: 1rem">
                                    <i class="fas fa-times-circle"></i> حداکثر خادم افتخاری نامعتبر است!
                                  </div>
                                  <?php
                                } elseif ($_GET['error'] == "database_error") {
                                  ?>
                                  <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center"
                                    style="border-radius: 1rem">
                                    <i class="fas fa-times-circle"></i> خطا در ارتباط با پایگاه داده!
                                  </div>
                                  <?php
                                } elseif ($_GET['error'] == "operation_failed") {
                                  ?>
                                  <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center"
                                    style="border-radius: 1rem">
                                    <i class="fas fa-times-circle"></i> خطا در اجرای عملیات!
                                  </div>
                                  <?php
                                }
                              }
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-12">
                        <div data-mdb-input-init class="form-outline mb-4">
                          <label class="form-label" for="shiftDate">
                            <i class="fas fa-calendar-day"></i> تاریخ
                          </label>
                          
                         <input type="date" name="shift_date" id="shiftDate" class="blur form-control form-control-lg" required />

                        </div>
                      </div>
                    </div>

                    <!-- Shift 1 -->
                    <div class="row">
                      <div class="col-12 col-md-4 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <label class="form-label" for="shift_start1">
                            <i class="fas fa-clock"></i> شروع شیفت اول
                          </label>
                          <input type="time" id="shift_start1" class="time-picker blur form-control form-control-lg"
                            name="shift_start1" required />
                        </div>
                      </div>
                      <div class="col-12 col-md-4 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <label class="form-label" for="shift_end1">
                            <i class="fas fa-clock"></i> پایان شیفت اول
                          </label>
                          <input type="time" id="shift_end1" class="time-picker blur form-control form-control-lg" name="shift_end1"
                            required />
                        </div>
                      </div>
                      <div class="col-12 col-md-4 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <label class="form-label" for="shift1_max">
                            <i class="fas fa-clock"></i> حداکثر خادم شیفت اول
                          </label>
                          <input type="number" id="shift1_max" class="blur form-control form-control-lg"
                            name="shift1_max" value="1" required />
                        </div>
                      </div>
                    </div>

                    <!-- Shift 2 -->
                    <div class="row">
                      <div class="col-12 col-md-4 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <label class="form-label" for="shift_start2">
                            <i class="fas fa-clock"></i> شروع شیفت دوم
                          </label>
                          <input type="time" id="shift_start2" class="time-picker blur form-control form-control-lg"
                            name="shift_start2" required />
                        </div>
                      </div>
                      <div class="col-12 col-md-4 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <label class="form-label" for="shift_end2">
                            <i class="fas fa-clock"></i> پایان شیفت دوم
                          </label>
                          <input type="time" id="shift_end2" class="time-picker blur form-control form-control-lg" name="shift_end2"
                            required />
                        </div>
                      </div>
                      <div class="col-12 col-md-4 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <label class="form-label" for="shift2_max">
                            <i class="fas fa-clock"></i> حداکثر خادم شیفت دوم
                          </label>
                          <input type="number" id="shift2_max" class="blur form-control form-control-lg"
                            name="shift2_max" value="1" required />
                        </div>
                      </div>
                    </div>

                    <!-- Shift 3 -->
                    <div class="row">
                      <div class="col-12 col-md-4 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <label class="form-label" for="shift_start3">
                            <i class="fas fa-clock"></i> شروع شیفت سوم
                          </label>
                          <input type="time" id="shift_start3" class="time-picker blur form-control form-control-lg"
                            name="shift_start3" required />
                        </div>
                      </div>
                      <div class="col-12 col-md-4 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <label class="form-label" for="shift_end3">
                            <i class="fas fa-clock"></i> پایان شیفت سوم
                          </label>
                          <input type="time" id="shift_end3" class="time-picker blur form-control form-control-lg" name="shift_end3"
                            required />
                        </div>
                      </div>
                      <div class="col-12 col-md-4 mb-4">
                        <div data-mdb-input-init class="form-outline">
                          <label class="form-label" for="shift3_max">
                            <i class="fas fa-clock"></i> حداکثر خادم شیفت سوم
                          </label>
                          <input type="number" id="shift3_max" class="blur form-control form-control-lg"
                            name="shift3_max" value="1" required />
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <div class="form-group mb-4">
                          <label class="pb-2" for="shiftDescription">توضیحات(اختیاری)</label>
                          <textarea name="description" class="blur form-control form-control-lg" id="shiftDescription"
                            rows="3"></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="pt-1 mb-4 text-center">
                      <button name="Create_Shift_2_Button" type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-light blur btn-lg btn-block mt-3 col-12 col-md-6 col-lg-3" type="button">
                        <i class="fas fa-save"></i> ثبت شیفت
                      </button>
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

  <script>
    flatpickr(".time-picker", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: true  // اجبار به حالت ۲۴ ساعته
    });
  </script>
 

  
  <?php include "Footer.php"; ?>