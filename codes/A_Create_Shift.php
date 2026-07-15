<?php include "Checklogin.php"; ?>
<?php include "Check_Admin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ایجاد شیفت</title>
  <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
  <?php include "Header.php"; ?>

  <!--Main-->
  <section>
    <div class="container py-6 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-9">
          <div class="blur card" style="border-radius: 1rem">
            <div class=" row g-0" style="border-radius: 1rem">
              <div class="col-md-12 col-lg-12 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-dark">
                  <form name="Create_Shift_form" action="Create_Shift_Action.php" method="POST">
                     <div class="col-12 row mt-3 justify-content-center">
                        <div class="col-12 col-lg-8 col-md-10">
                          <?php
                          if (isset($_GET['success'])) {
                            if ($_GET['success'] == "shifts_created") {
                              ?>
                              <div class="alert alert-success mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                <i class="fas fa-check-circle"></i> شیفت با موفقیت ایجاد شد
                              </div>
                              <?php
                            }
                          } elseif (isset($_GET['error'])) {
                            if ($_GET['error'] == "invalid_max_users") { ?>
                              <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center"
                                style="border-radius: 1rem">
                                <i class="fas fa-times-circle"></i> حداکثر خادم افتخاری نامعتبر است!
                              </div>
                            <?php } elseif ($_GET['error'] == "invalid_shift_time") { ?>
                              <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center"
                                style="border-radius: 1rem">
                                <i class="fas fa-times-circle"></i>ساعت شیفت نامعتبر است!
                              </div>
                            <?php } elseif ($_GET['error'] == "not_created") { ?>
                              <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center"
                                style="border-radius: 1rem">
                                <i class="fas fa-times-circle"></i> شیفت ایجاد نشد!
                              </div>
                            <?php }
                          }
                          ?>
                        </div>
                      </div>
                    <div class="col-12 d-flex align-items-center mb-3 pb-1 text-center">
                      <span class="h2 fw-bold mt-4 mb-5 w-100">
                        <i class="fas fa-calendar-plus"></i> تعریف شیفت
                      </span>
                    </div>
                    <div class="row">
                      <!--Row 1-->
                      <div data-mdb-input-init class="form-outline mb-4 col-12 col-md-4 col-lg-4">
                        <label class="form-label" for="form2Example17">
                          <i class="fas fa-clock"></i> شروع شیفت اول
                        </label>
                        <input type="time" id="form2Example17" class="time-picker blur form-control form-control-lg"
                          name="shift_start1" required />
                      </div>
                      <div data-mdb-input-init class="form-outline mb-4 col-12 col-md-4 col-lg-4">
                        <label class="form-label" for="form2Example17">
                          <i class="fas fa-clock"></i> پایان شیفت اول
                        </label>
                        <input type="time" id="form2Example17" class="time-picker blur form-control form-control-lg"
                          name="shift_end1" required />
                      </div>
                      <div data-mdb-input-init class="form-outline mb-4 col-12 col-md-4  col-lg-4">
                        <label class="form-label" for="form2Example17">
                          <i class="fas fa-clock"></i> حداکثر خادم شیفت اول
                        </label>
                        <input type="number" id="form2Example17" class="blur form-control form-control-lg"
                          name="shift1_max" value="1" required />
                      </div>
                    </div>
                    <!--Row 1-->
                    <!--Row 2-->
                    <div class="row">
                      <div data-mdb-input-init class="form-outline mb-4  col-12 col-md-4 col-lg-4">
                        <label class="form-label" for="form2Example17">
                          <i class="fas fa-clock"></i> شروع شیفت دوم
                        </label>
                        <input type="time" id="form2Example17" class="time-picker blur form-control form-control-lg"
                          name="shift_start2" required />
                      </div>
                      <div data-mdb-input-init class="form-outline mb-4 col-12 col-md-4 col-lg-4">
                        <label class="form-label" for="form2Example17">
                          <i class="fas fa-clock"></i> پایان شیفت دوم
                        </label>
                        <input type="time" id="form2Example17" class="time-picker blur form-control form-control-lg"
                          name="shift_end2" required />
                      </div>
                      <div data-mdb-input-init class="form-outline mb-4 col-12 col-md-4 col-lg-4">
                        <label class="form-label" for="form2Example17">
                          <i class="fas fa-clock"></i> حداکثر خادم شیفت دوم
                        </label>
                        <input type="number" id="form2Example17" class="blur form-control form-control-lg"
                          name="shift2_max" value="1" required />
                      </div>
                    </div>
                    <!--Row 2-->
                    <!--Row 3-->
                    <div class="row">
                      <div data-mdb-input-init class="form-outline mb-4 col-12 col-md-4 col-lg-4">
                        <label class="form-label" for="form2Example17">
                          <i class="fas fa-clock"></i> شروع شیفت سوم
                        </label>
                        <input type="time" id="form2Example17" class="time-picker blur form-control form-control-lg"
                          name="shift_start3" required />
                      </div>
                      <div data-mdb-input-init class="form-outline mb-4 col-12 col-md-4 col-lg-4">
                        <label class="form-label" for="form2Example17">
                          <i class="fas fa-clock"></i> پایان شیفت سوم
                        </label>
                        <input type="time" id="form2Example17" class="time-picker blur form-control form-control-lg"
                          name="shift_end3" required />
                      </div>
                      <div data-mdb-input-init class="form-outline mb-4 col-12 col-md-4 col-lg-4">
                        <label class="form-label" for="form2Example17">
                          <i class="fas fa-clock"></i> حداکثر خادم شیفت سوم
                        </label>
                        <input type="number" id="form2Example17" class="blur form-control form-control-lg"
                          name="shift3_max" value="1" required />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="pb-2" for="exampleFormControlTextarea1">توضیحات(اختیاری)</label>
                      <textarea name="description" class="blur form-control form-control-lg"
                        id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="pt-1 mb-4 text-center">
                      <button data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-light blur btn-lg btn-block mt-5 col-12 col-md-6 col-lg-4" type="submit"
                        name="Create_Shift">
                        <i class="fas fa-save"></i> ثبت شیفت تا آخر ماه
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