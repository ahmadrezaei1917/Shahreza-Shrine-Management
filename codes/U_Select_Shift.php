<?php
include "Checklogin.php";
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['shift_date'])) {
    header("Location: U_Select_Shift_Date.php?error=invalid_request");
    exit;
}

$shift_date = $_POST['shift_date'];
$user_id = $_SESSION['user_id'];

// بررسی وجود شیفت برای تاریخ انتخاب شده
$stmt = $pdo->prepare("SELECT * FROM as_shifts WHERE shift_date = ?");
$stmt->execute([$shift_date]);
$shift = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$shift) {
    header("Location: U_Select_Shift_Date.php?error=no_shifts&date=" . urlencode($shift_date));
    exit;
}

// بررسی آیا کاربر قبلاً برای این تاریخ شیفت انتخاب کرده
$stmt = $pdo->prepare("SELECT * FROM as_user_shifts 
                      WHERE user_id = ? AND shift_id = ?");
$stmt->execute([$user_id, $shift['id']]);
$already_registered = $stmt->fetch();

include "Header.php";
?>

<section>
    <div class="container py-6 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-6">
                <div class="blur card" style="border-radius: 1rem">
                    <div class=" row g-0" style="border-radius: 1rem">
                        <div class="col-md-12 col-lg-12 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-dark">
                                <form method="post" action="Register_Shift_Action.php">
                                    <input type="hidden" name="shift_id" value="<?php echo $shift['id']; ?>">
                                    <input type="hidden" name="shift_date" value="<?php echo $shift_date; ?>">

                                    <div class="d-flex align-items-center mb-3 pb-1 text-center">
                                        <span class="h2 fw-bold mb-0 w-100">
                                            <i class="fas fa-business-time"></i> انتخاب شیفت برای
                                            <?php echo persian_date($shift_date); ?>
                                        </span>

                                        <div class="row mt-3 justify-content-center">
                                            <div class="col-12 col-lg-8 col-md-10">
                                                <?php
                                                if (isset($_GET['error'])) {
                                                    if ($_GET['error'] == "database_error") { ?>
                                                        <div class="alert alert-danger mb-4 p-3 font-weight-bold text-center" style="border-radius: 1rem">
                                                            <i class="fas fa-times-circle"></i> خطا در ارتباط با پایگاه داده!
                                                        </div>
                                                <?php }
                                                } ?>
                                            </div>
                                        </div>

                                    </div>

                                    <?php if ($already_registered): ?>
                                        <div class="alert alert-warning">
                                            شما قبلاً برای این تاریخ شیفت انتخاب کرده‌اید.
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <label for="shift_number">
                                            <i class="fas fa-clock"></i> شیفت‌های موجود:
                                        </label>

                                        <?php
                                        // نمایش شیفت‌های موجود
                                        $shifts_available = [
                                            1 => ['start' => $shift['shift_start1'], 'end' => $shift['shift_end1'], 'max' => $shift['max_users1']],
                                            2 => ['start' => $shift['shift_start2'], 'end' => $shift['shift_end2'], 'max' => $shift['max_users2']],
                                            3 => ['start' => $shift['shift_start3'], 'end' => $shift['shift_end3'], 'max' => $shift['max_users3']]
                                        ];

                                        foreach ($shifts_available as $num => $shift_info):
                                            // تعداد ثبت‌نام‌های این شیفت
                                            $stmt = $pdo->prepare("SELECT COUNT(*) FROM as_user_shifts 
                                                                WHERE shift_id = ? AND shift_number = ?");
                                            $stmt->execute([$shift['id'], $num]);
                                            $registered_count = $stmt->fetchColumn();

                                            $available = ($registered_count < $shift_info['max']);
                                        ?>
                                            <div class="shift-option mb-3 p-3" style="border-radius: 0.5rem; background: rgba(255,255,255,0.1);">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="shift_number" id="shift<?php echo $num; ?>"
                                                        value="<?php echo $num; ?>"
                                                        <?php if (!$available) echo 'disabled'; ?>>
                                                    <label class="form-check-label" for="shift<?php echo $num; ?>">
                                                        شیفت <?php echo $num; ?>:
                                                        <?php echo substr($shift_info['start'], 0, 5); ?> تا <?php echo substr($shift_info['end'], 0, 5); ?>
                                                        (<?php echo ($shift_info['max'] - $registered_count); ?> ظرفیت خالی)
                                                    </label>
                                                    <?php if (!$available): ?>
                                                        <span class="badge bg-danger">تکمیل ظرفیت</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-dark btn-lg btn-block mt-3 col-12" type="submit"
                                            <?php //if ($already_registered) echo 'disabled'; 
                                            ?>>
                                            <i class="fas fa-check"></i> ثبت انتخاب
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

<?php
include "Footer.php";

// تابع تبدیل تاریخ میلادی به شمسی
function persian_date($date)
{
    // اینجا باید کد تبدیل تاریخ میلادی به شمسی قرار گیرد
    return $date;
}
?>