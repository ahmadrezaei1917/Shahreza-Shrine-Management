<?php
include "Checklogin.php";
include "Check_Admin.php";
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $shift_start1 = $_POST['shift_start1'];
    $shift_end1 = $_POST['shift_end1'];
    $shift1_max = $_POST['shift1_max'];

    $shift_start2 = $_POST['shift_start2'];
    $shift_end2 = $_POST['shift_end2'];
    $shift2_max = $_POST['shift2_max'];

    $shift_start3 = $_POST['shift_start3'];
    $shift_end3 = $_POST['shift_end3'];
    $shift3_max = $_POST['shift3_max'];

    $description = $_POST['description'];
    $created_by =  $_SESSION['user_id'];

    if ($shift1_max <= 0 || $shift2_max <= 0 || $shift3_max <= 0) {
        header("Location: A_Create_Shift.php?error=invalid_max_users");
        exit;
    }

    if (!validateShiftTime($shift_start1, $shift_end1) || !validateShiftTime($shift_start2, $shift_end2) || !validateShiftTime($shift_start3, $shift_end3)) {
        header("Location: A_Create_Shift.php?error=invalid_shift_time");
        exit;
    }

    // شروع تراکنش
    $pdo->beginTransaction();

    try {
        // ایجاد شیفت‌ها برای 30 روز آینده
        for ($i = 0; $i < 30; $i++) {
            $shift_date = date('Y-m-d', strtotime("+$i days"));

            // بررسی آیا برای این تاریخ قبلاً شیفت تعریف شده
            $stmt = $pdo->prepare("SELECT id FROM as_shifts WHERE shift_date = ?");
            $stmt->execute([$shift_date]);

            if ($stmt->fetch()) {
                continue; // اگر وجود دارد، از این تاریخ عبور کن
            }

            // درج شیفت جدید
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
        }

        $pdo->commit();

        header("Location: A_Create_Shift.php?success=shifts_created");
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();

        error_log("Error creating shifts: " . $e->getMessage());
        header("Location: A_Create_Shift.php?error=not_created");
        exit;
    }
}

function validateShiftTime($start, $end) {
    $start_time = strtotime($start);
    $end_time = strtotime($end);

    
    if ($start_time >= $end_time) {
        return false;
    }

    $duration = ($end_time - $start_time) / 60;
    if ($duration < 30) {
        return false;
    }

    return true;
}
