    <?php
    include "Checklogin.php";
    include "Header.php";
    ?>

    <section>
        <div class="container py-3">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col col-xl-4">
                    <div class="blur card" style="border-radius: 1rem">
                        <div class=" row g-0" style="border-radius: 1rem">
                            <div class="col-md-12 col-lg-12 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-dark">
                                    <form method="post" action="U_Select_Shift.php">
                                    <div class="row">
                                          
                                                <div class="col-12 col-lg-12 col-md-6 text-center">
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
                                                        if ($_GET['error'] == "no_shifts") { ?>
                                                        <div class="alert alert-warning mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                                                <i class="fas fa-exclamation-triangle"></i> شیفتی در این تاریخ وجود نمیباشد.
                                                            </div>
                                                        <?php  } elseif ($_GET['error'] == "invalid_request") { ?>
                                                            <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                                                <i class="fas fa-times-circle"></i> درخواست نامعتبر است!
                                                            </div>
                                                        <?php  } elseif ($_GET['error'] == "invalid_shift") { ?>
                                                            <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                                                <i class="fas fa-times-circle"></i> شیفت نامعتبر است!
                                                            </div>
                                                    <?php } elseif ($_GET['error'] == "shift_not_found") { ?>
                                                            <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                                                <i class="fas fa-times-circle"></i> شیفت پیدا نشد!
                                                            </div>
                                                    <?php } elseif ($_GET['error'] == "full_capacity") { ?>
                                                            <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                                                <i class="fas fa-times-circle"></i> ظرفیت پر است!
                                                            </div>
                                                    <?php }
                                                    } ?>
                                                </div>
                                               
                                            </div>

                                        <div class="d-flex align-items-center mb-3 pb-1 text-center">
                                            <span class="h3 fw-bold mb-3 w-100">
                                                <i class="fas fa-business-time"></i> انتخاب تاریخ شیفت
                                            </span>


                                          

                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label pb-3" for="shift_date">
                                                <i class="fas fa-calendar-day"></i> تاریخ مورد نظر
                                            </label>
                                            <input type="date" id="shift_date" name="shift_date"
                                                class="blur form-control form-control-lg"
                                                min="<?php echo date('Y-m-d'); ?>" required />
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-light blur btn-lg btn-block mt-3 col-12" type="submit">
                                                <i class="fas fa-search"></i> جستجوی شیفت‌ها
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

    <?php include "Footer.php"; ?>