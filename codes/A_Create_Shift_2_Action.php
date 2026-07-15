<?php
include "Checklogin.php";
include "Check_Admin.php";
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: A_Create_Shift_2.php?error=invalid_request");
    exit;
}

// دریافت اطلاعات از فرم
$shift_date = $_POST['shift_date'];
$shift_start1 = $_POST['shift_start1'];
$shift_end1 = $_POST['shift_end1'];
$shift1_max = (int)$_POST['shift1_max'];
$shift_start2 = $_POST['shift_start2'];
$shift_end2 = $_POST['shift_end2'];
$shift2_max = (int)$_POST['shift2_max'];
$shift_start3 = $_POST['shift_start3'];
$shift_end3 = $_POST['shift_end3'];
$shift3_max = (int)$_POST['shift3_max'];
$description = $_POST['description'] ?? null;
$created_by = $_SESSION['user_id'];

// اعتبارسنجی زمان شیفت‌ها
if (!validateShiftTime($shift_start1, $shift_end1) ||
    !validateShiftTime($shift_start2, $shift_end2) ||
    !validateShiftTime($shift_start3, $shift_end3)) {
    header("Location: A_Create_Shift_2.php?error=invalid_shift_time");
    exit;
}

// اعتبارسنجی تعداد کاربران
if ($shift1_max <= 0 || $shift2_max <= 0 || $shift3_max <= 0) {
    header("Location: A_Create_Shift_2.php?error=invalid_max_users");
    exit;
}

// شروع تراکنش
$pdo->beginTransaction();

try {
    // 1. بررسی وجود شیفت برای این تاریخ
    $stmt = $pdo->prepare("SELECT id FROM as_shifts WHERE shift_date = ?");
    $stmt->execute([$shift_date]);
    $existing_shift = $stmt->fetch();

    $deleted_registrations = 0;
    
    if ($existing_shift) {
        // 2. اگر شیفت وجود دارد، ابتدا ثبت‌نام‌های مرتبط را حذف کنید
        $stmt = $pdo->prepare("DELETE FROM as_user_shifts WHERE shift_id = ?");
        $stmt->execute([$existing_shift['id']]);
        $deleted_registrations = $stmt->rowCount();

        // 3. سپس شیفت موجود را حذف کنید
        $stmt = $pdo->prepare("DELETE FROM as_shifts WHERE id = ?");
        $stmt->execute([$existing_shift['id']]);
    }

    // 4. درج شیفت جدید
    $stmt = $pdo->prepare("INSERT INTO as_shifts 
                          (shift_date, shift_start1, shift_end1, shift_start2, shift_end2, 
                           shift_start3, shift_end3, description, max_users1, max_users2, 
                           max_users3, created_by) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([
        $shift_date,
        $shift_start1,
        $shift_end1,
        $shift_start2,
        $shift_end2,
        $shift_start3,
        $shift_end3,
        $description,
        $shift1_max,
        $shift2_max,
        $shift3_max,
        $created_by
    ]);


    // تأیید تراکنش
    $pdo->commit();

    header("Location: A_Defined_Shifts.php?success=shift_created&deleted_registrations=" . $deleted_registrations);
    exit;

} catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Database Error in A_Create_Shift_2_Action: " . $e->getMessage());
    header("Location: A_Create_Shift_2.php?error=database_error");
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
    error_log("Application Error in A_Create_Shift_2_Action: " . $e->getMessage());
    header("Location: A_Create_Shift_2.php?error=operation_failed");
    exit;
}

// تابع اعتبارسنجی زمان شیفت
function validateShiftTime($start, $end) {
    $start_time = strtotime($start);
    $end_time = strtotime($end);
    
    // بررسی اینکه زمان شروع قبل از زمان پایان باشد
    if ($start_time >= $end_time) {
        return false;
    }
    
    // بررسی اینکه حداقل 30 دقیقه فاصله داشته باشد
    $duration = ($end_time - $start_time) / 60; // مدت به دقیقه
    if ($duration < 30) {
        return false;
    }
    
    return true;
}

?>